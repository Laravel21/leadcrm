<?php

namespace App\Http\Controllers;
use App\Models\Source;

use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index()
    {
        $sources = Source::all();
        return view('leads.index',compact('sources'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_source' => 'required|string|max:255|unique:sources,lead_source',
        ]);

        $source = Source::create([
            'lead_source' =>$request->lead_source,
        ]);

        return response()->json([
            'success' => true,
            'lead_source' => $source->lead_source,
            'message' => 'Source Name added successfully!'
        ]);
    }
}
