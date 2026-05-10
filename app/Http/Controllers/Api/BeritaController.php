<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::latest();

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by sub_category (untuk eskul)
        if ($request->filled('sub_category')) {
            $query->where('sub_category', $request->sub_category);
        }

        // Search
        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function($builder) use ($q) {
                $builder->where('title', 'like', "%{$q}%")
                        ->orWhere('excerpt', 'like', "%{$q}%")
                        ->orWhere('content', 'like', "%{$q}%");
            });
        }

        $items = $query->get()->map(fn($b) => [
            'id'           => $b->id,
            'title'        => $b->title,
            'excerpt'      => $b->excerpt,
            'content'      => $b->content,
            'category'     => $b->category,
            'sub_category' => $b->sub_category,
            'date'         => $b->date?->format('d M Y'),
            'date_raw'     => $b->date?->toDateString(),
            'image'        => $b->image_url,
        ]);

        return response()->json($items)->header('Access-Control-Allow-Origin', '*');
    }

    public function show($id)
    {
        $b = Berita::findOrFail($id);

        return response()->json([
            'id'           => $b->id,
            'title'        => $b->title,
            'excerpt'      => $b->excerpt,
            'content'      => $b->content,
            'category'     => $b->category,
            'sub_category' => $b->sub_category,
            'date'         => $b->date?->format('d M Y'),
            'image'        => $b->image_url,
        ])->header('Access-Control-Allow-Origin', '*');
    }
}
