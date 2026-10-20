<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => [
                'required',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
        ]);

        Color::create([
            'name' => $validated['name'],
            'code' => strtoupper($validated['code']),
            'created_by' => Auth::id(),
            'status' => $request->boolean('status'),
            'is_delete' => false,
        ]);

        return back()->with('success', 'Color added successfully.');
    }


    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'code' => [
                'required',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
        ]);

        $color->update([
            'name' => $validated['name'],
            'code' => strtoupper($validated['code']),
            'status' => $request->boolean('status'),
        ]);

        return back()->with('success', 'Color updated successfully.');
    }


    public function destroy(Color $color)
    {
        $color->update([
            'is_delete' => true,
            'status' => false,
        ]);

        return back()->with('success', 'Color deleted successfully.');
    }
}
