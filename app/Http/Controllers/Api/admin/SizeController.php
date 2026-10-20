<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        Size::create([
            'name' => $validated['name'],
            'created_by' => Auth::id(),
            'status' => $request->boolean('status'),
            'is_delete' => false,
        ]);

        return back()->with('success', 'Size added successfully.');
    }


    public function update(Request $request, Size $size)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        $size->update([
            'name' => $validated['name'],
            'status' => $request->boolean('status'),
        ]);

        return back()->with('success', 'Size updated successfully.');
    }


    public function destroy(Size $size)
    {
        $size->update([
            'is_delete' => true,
            'status' => false,
        ]);

        return back()->with('success', 'Size deleted successfully.');
    }
}
