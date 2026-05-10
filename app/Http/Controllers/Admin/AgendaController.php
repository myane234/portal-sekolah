<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $items = Agenda::orderBy('date', 'asc')->get();
        return view('admin.agenda.index', compact('items'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'date'     => 'required|date',
            'time'     => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Agenda::create($request->only(['title', 'description', 'date', 'time', 'location']));
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $item = Agenda::findOrFail($id);
        return view('admin.agenda.edit', compact('item'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title'    => 'required|string|max:255',
            'date'     => 'required|date',
            'time'     => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $item = Agenda::findOrFail($id);
        $item->update($request->only(['title', 'description', 'date', 'time', 'location']));
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        Agenda::destroy($id);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus!');
    }
}
