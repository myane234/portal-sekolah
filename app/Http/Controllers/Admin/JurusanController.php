<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function index()
    {
        $items = Jurusan::latest()->get();
        return view('admin.jurusan.index', compact('items'));
    }

    public function create()
    {
        return view('admin.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $data = $request->only(['name']);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('jurusan', 'public');
        }

        Jurusan::create($data);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $item = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
        ]);

        $item = Jurusan::findOrFail($id);
        $data = $request->only(['name']);

        if ($request->hasFile('logo')) {
            if ($item->logo && !str_starts_with($item->logo, 'http')) {
                Storage::disk('public')->delete($item->logo);
            }
            $data['logo'] = $request->file('logo')->store('jurusan', 'public');
        }

        $item->update($data);

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $item = Jurusan::findOrFail($id);

        if ($item->logo && !str_starts_with($item->logo, 'http')) {
            Storage::disk('public')->delete($item->logo);
        }

        $item->delete();

        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus!');
    }
}
