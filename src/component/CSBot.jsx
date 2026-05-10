import { useMemo, useState } from "react";
import useSEO from "../hooks/useSEO";
import { askGroq, getGroqBotStatus } from "../utils/groqBot";

const initialMessages = [
  {
    role: "assistant",
    text: "Halo! Saya CS bot SMKN 2 Jakarta. Tanyakan apa saja tentang eskul, berita, agenda, atau informasi sekolah.",
  },
];

export default function CSBot() {
  const [messages, setMessages] = useState(initialMessages);
  const [input, setInput] = useState("");
  const [pending, setPending] = useState(false);
  const [error, setError] = useState(null);
  const [statusNote, setStatusNote] = useState(null);

  useSEO(
    "CS Bot",
    "Layanan chatbot CS SMKN 2 Jakarta menggunakan Groq dan model llama-3.3-70b-versatile dengan rotasi API otomatis."
  );

  const status = useMemo(() => getGroqBotStatus(), [messages, error, pending]);

  const handleSend = async (event) => {
    event.preventDefault();
    if (!input.trim()) return;

    const userMessage = { role: "user", text: input.trim() };
    setMessages((current) => [...current, userMessage]);
    setInput("");
    setPending(true);
    setError(null);
    setStatusNote("Menghubungkan ke Groq API...");

    try {
      const text = await askGroq(input.trim());
      const botMessage = { role: "assistant", text };
      setMessages((current) => [...current, botMessage]);
      setStatusNote("Respon berhasil diterima dari backend.");
    } catch (err) {
      setError(err.message || "Terjadi kesalahan saat memproses permintaan.");
      setStatusNote("API backend bermasalah, silakan coba lagi dalam 1 menit.");
    } finally {
      setPending(false);
    }
  };

  return (
    <main className="max-w-5xl mx-auto px-6 mt-8 mb-12">
      <div className="bg-white rounded-2xl shadow-sm p-6">
        <div className="flex flex-col gap-2 md:flex-row md:items-center md:justify-between mb-6">
          <div>
            <h1 className="text-2xl font-bold text-gray-900">CS Bot SMKN 2 Jakarta</h1>
            <p className="text-gray-600 mt-1">Gunakan fitur ini untuk bertanya seputar sekolah, berita, agenda, dan ekstrakurikuler.</p>
          </div>
        </div>

        <div className="grid gap-4 md:grid-cols-[1fr_260px]">
          <section className="space-y-4">
            <div className="rounded-3xl border border-gray-200 bg-gray-50 p-4 min-h-[420px] overflow-y-auto">
              {messages.map((msg, index) => (
                <div key={index} className={`mb-4 ${msg.role === "assistant" ? "text-left" : "text-right"}`}>
                  <div className={`inline-block rounded-3xl px-5 py-4 ${msg.role === "assistant" ? "bg-white text-gray-900 shadow-sm" : "bg-blue-600 text-white"}`}>
                    <p className="whitespace-pre-wrap break-words">{msg.text}</p>
                  </div>
                  <div className="mt-1 text-xs text-gray-500">{msg.role === "assistant" ? "CS Bot" : "Anda"}</div>
                </div>
              ))}
            </div>

            <form onSubmit={handleSend} className="flex flex-col gap-3">
              <textarea
                rows={4}
                placeholder="Ketik pertanyaan Anda..."
                className="w-full rounded-3xl border border-gray-200 p-4 text-sm outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-100"
                value={input}
                onChange={(e) => setInput(e.target.value)}
                disabled={pending}
              />
              <div className="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <span className="text-sm text-gray-500">{pending ? "Mengirim..." : "Tulis pertanyaan dan tekan Kirim."}</span>
                <button
                  type="submit"
                  className="inline-flex items-center justify-center rounded-full bg-blue-600 px-6 py-3 text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60"
                  disabled={pending}
                >
                  Kirim
                </button>
              </div>
            </form>

            {error && (
              <div className="rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                {error}
              </div>
            )}
          </section>
        </div>
      </div>
    </main>
  );
}
