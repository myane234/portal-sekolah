<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function index()
    {
        $items = Jurusan::orderBy('name')->get()->map(fn($jurusan) => [
            'id'          => $jurusan->id,
            'name'        => $jurusan->name,
            'logo'        => $jurusan->logo_url,
            'created_at'  => $jurusan->created_at?->toDateTimeString(),
            'updated_at'  => $jurusan->updated_at?->toDateTimeString(),
        ]);

        return response()->json($items)->header('Access-Control-Allow-Origin', '*');
    }
}
