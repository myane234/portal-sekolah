<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eskul;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EskulController extends Controller
{
    public function index()
    {
        $items = Eskul::latest()->get();
        return view('admin.eskul.index', compact('items'));
    }

    public function create()
    {
        return view('admin.eskul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = $request->only(['name', 'description']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('eskul', 'public');
        }

        Eskul::create($data);
        return redirect()->route('admin.eskul.index')->with('success', 'Eskul berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $item = Eskul::findOrFail($id);
        return view('admin.eskul.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $item = Eskul::findOrFail($id);
        $data = $request->only(['name', 'description']);
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('logo')) {
            if ($item->logo && !str_starts_with($item->logo, 'http')) {
                Storage::disk('public')->delete($item->logo);
            }
            $data['logo'] = $request->file('logo')->store('eskul', 'public');
        }

        $item->update($data);
        return redirect()->route('admin.eskul.index')->with('success', 'Eskul berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $item = Eskul::findOrFail($id);
        if ($item->logo && !str_starts_with($item->logo, 'http')) {
            Storage::disk('public')->delete($item->logo);
        }
        $item->delete();
        return redirect()->route('admin.eskul.index')->with('success', 'Eskul berhasil dihapus!');
    }
}
