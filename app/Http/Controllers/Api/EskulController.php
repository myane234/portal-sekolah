<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Eskul;

class EskulController extends Controller
{
    public function index()
    {
        $items = Eskul::orderBy('name')->get()->map(fn($e) => [
            'id'          => $e->id,
            'name'        => $e->name,
            'slug'        => $e->slug,
            'description' => $e->description,
            'logo'        => $e->logo_url,
        ]);

        return response()->json($items)->header('Access-Control-Allow-Origin', '*');
    }
}
