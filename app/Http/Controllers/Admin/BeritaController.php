<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    public function index()
    {
        $items = Berita::latest()->get();
        return view('admin.berita.index', compact('items'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'category' => 'required|in:berita,prestasi,eskul',
            'date'     => 'nullable|date',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'category', 'sub_category', 'date']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('berita', 'public');
        }

        Berita::create($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $item = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required',
            'category' => 'required|in:berita,prestasi,eskul',
            'date'     => 'nullable|date',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $item = Berita::findOrFail($id);
        $data = $request->only(['title', 'excerpt', 'content', 'category', 'sub_category', 'date']);

        if ($request->hasFile('image')) {
            if ($item->image && !str_starts_with($item->image, 'http')) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('berita', 'public');
        }

        $item->update($data);
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $item = Berita::findOrFail($id);
        if ($item->image && !str_starts_with($item->image, 'http')) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
