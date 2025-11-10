<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stage;

class StageController extends Controller
{
    public function index()
    {
        $stages = Stage::all();
        return view('leads.index', compact('stages'));
    }

    public function store(Request $request)
{
          $request->validate([
        'stage_name' => 'required|string|max:255|unique:lead_stages,name',
        'color' => 'required|string|max:7', // hex code like #ff0000
    ]);

    $stage = Stage::create([
        'name' => $request->stage_name,
        'color' => $request->color,
    ]);

    return response()->json([
        'success' => true,
        'stage_id' => $stage->id,
        'stage_name' => $stage->name,
        'color' => $stage->color,
        'message' => 'Stage added successfully!'
    ]);
}
}

