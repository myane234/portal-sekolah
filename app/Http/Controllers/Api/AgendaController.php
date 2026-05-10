<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $items = Agenda::orderBy('date', 'asc')->get()->map(fn($a) => [
            'id'          => $a->id,
            'title'       => $a->title,
            'description' => $a->description,
            'date'        => $a->date?->format('d M Y'),
            'date_raw'    => $a->date?->toDateString(),
            'time'        => $a->time,
            'location'    => $a->location,
        ]);

        return response()->json($items)->header('Access-Control-Allow-Origin', '*');
    }
}
