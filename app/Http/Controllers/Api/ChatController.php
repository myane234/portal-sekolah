<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Eskul;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    protected int $suspendSeconds = 60;
    protected string $stateCacheKey = 'groq_api_key_states';
    protected string $indexCacheKey = 'groq_api_next_index';

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $keys = $this->getApiKeys();
        if (empty($keys)) {
            return response()->json(['message' => 'GROQ_API_KEYS belum diset.'], 500);
        }

        $keyStates = $this->loadKeyStates($keys);
        $index = $this->getAvailableIndex($keyStates);

        if ($index < 0) {
            return response()->json([
                'message' => 'Semua API key Groq sedang ditangguhkan. Coba lagi nanti.',
            ], 503);
        }

        $apiKey = $keyStates[$index]['key'];

        // Ambil data berita, eskul, dan agenda dari database
        $dataContext = $this->buildDataContext();
        
        Log::info('Groq chat request started', [
            'model' => $this->getModel(),
            'message_length' => strlen($request->input('message')),
            'api_key_masked' => $this->formatKey($apiKey),
            'data_context_length' => strlen($dataContext),
        ]);

        // --- PENDEKATAN BARU: LANGSUNG TEMBAK API GROQ PAKAI LARAVEL HTTP ---
        try {
            $response = Http::withoutVerifying()
                ->withToken($apiKey)
                ->timeout(60)
                ->post($this->getApiUrl() . '/chat/completions', [
                    'model' => $this->getModel(),
                    'messages' => [
                        // System prompt dengan data sekolah
                        [
                            'role' => 'system', 
                            'content' => $this->buildSystemPrompt($dataContext)
                        ],
                        [
                            'role' => 'user', 
                            'content' => $request->input('message')
                        ],
                    ],
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $payload = $response->json();
                $text = $payload['choices'][0]['message']['content'] ?? null;

                if (!$text) {
                    throw new \Exception('Format respons dari Groq tidak sesuai.');
                }

                Log::info('Groq chat succeeded', [
                    'model' => $this->getModel(),
                    'api_key_masked' => $this->formatKey($apiKey),
                    'response_length' => strlen($text),
                ]);

                // Sukses! Lanjut ke API Key berikutnya untuk rotasi
                $this->advanceIndex($index, count($keyStates));
                Cache::forever($this->stateCacheKey, $keyStates);

                return response()->json([
                    'text' => $text,
                    'usedKey' => $this->formatKey($apiKey),
                ]);
            }

            // Jika gagal
            $errorText = $response->json('error.message') ?? 'HTTP Error ' . $response->status();
            Log::error('Groq API Error', [
                'response' => $response->json(),
                'api_key_masked' => $this->formatKey($apiKey),
            ]);
            $this->suspendKey($keyStates, $index, $errorText);

            return response()->json([
                'message' => 'Tidak dapat memproses permintaan dari Groq.',
                'error' => $errorText,
            ], 502);

        } catch (\Exception $e) {
            Log::error('Groq Connection Error', [
                'error' => $e->getMessage(),
                'api_key_masked' => $this->formatKey($apiKey),
            ]);
            $this->suspendKey($keyStates, $index, $e->getMessage());

            return response()->json([
                'message' => 'Koneksi ke server Groq terputus.',
                'error' => $e->getMessage(),
            ], 502);
        }
    }

    protected function buildDataContext(): string
    {
        $berita = Berita::latest('date')->limit(10)->get();
        $eskul = Eskul::all();
        $agenda = Agenda::latest('date')->limit(10)->get();

        $context = "\n📰 BERITA TERBARU:\n";
        foreach ($berita as $b) {
            $context .= "- {$b->title} ({$b->date}): {$b->excerpt}\n";
        }

        $context .= "\n🎭 EKSTRAKURIKULER:\n";
        foreach ($eskul as $e) {
            $context .= "- {$e->name}: {$e->description}\n";
        }

        $context .= "\n📅 JADWAL & AGENDA:\n";
        foreach ($agenda as $a) {
            $context .= "- {$a->title} ({$a->date} {$a->time}) di {$a->location}: {$a->description}\n";
        }

        return $context;
    }

    protected function buildSystemPrompt(string $dataContext): string
    {
        return "Kamu adalah CS bot SMKN 2 Jakarta yang ramah, membantu, dan memberikan informasi seputar sekolah.\n" .
               "Gunakan data berikut untuk menjawab pertanyaan dengan akurat dan relevan.\n" .
               "Jika pertanyaan tidak ada di data yang diberikan, katakan dengan jujur.\n" .
               $dataContext;
    }

    protected function getApiKeys(): array
    {
        return collect(explode(',', env('GROQ_API_KEYS', '')))
            ->map(fn ($key) => trim($key))->filter()->values()->all();
    }

    protected function getApiUrl(): string
    {
        // Pastikan URL base-nya benar
        return rtrim(env('GROQ_API_URL', 'https://api.groq.com/openai/v1'), '/');
    }

    protected function getModel(): string
    {
        return env('GROQ_MODEL', 'llama-3.3-70b-versatile');
    }

    protected function loadKeyStates(array $keys): array
    {
        $states = Cache::get($this->stateCacheKey, []);
        return collect($keys)->map(fn ($key) => [
            'key' => $key,
            'suspended_until' => collect($states)->firstWhere('key', $key)['suspended_until'] ?? 0,
            'last_error' => collect($states)->firstWhere('key', $key)['last_error'] ?? null,
        ])->all();
    }

    protected function getAvailableIndex(array $states): int
    {
        $now = now()->timestamp;
        $start = Cache::get($this->indexCacheKey, 0);
        $total = count($states);
        if ($total === 0) return -1;

        for ($i = 0; $i < $total; $i++) {
            $idx = ($start + $i) % $total;
            if ($states[$idx]['suspended_until'] <= $now) return $idx;
        }
        return -1;
    }

    protected function suspendKey(array $states, int $index, string $errorText): array
    {
        $states[$index]['suspended_until'] = now()->addSeconds($this->suspendSeconds)->timestamp;
        $states[$index]['last_error'] = $errorText;
        Cache::forever($this->stateCacheKey, $states);
        return $states;
    }

    protected function advanceIndex(int $currentIndex, int $total): void
    {
        Cache::forever($this->indexCacheKey, ($currentIndex + 1) % $total);
    }

    protected function formatKey(string $key): string
    {
        return empty($key) ? '(no-key)' : (strlen($key) <= 10 ? $key : substr($key, 0, 4) . '...' . substr($key, -4));
    }
}