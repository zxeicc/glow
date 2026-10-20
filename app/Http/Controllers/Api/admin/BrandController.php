<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display all brands.
     */
    public function index(Request $request)
    {
        $query = Brand::with('creator')
            ->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->status !== null && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $brands = $query->paginate(10);

        return view('admin.admin.brand', compact('brands'));
    }

    /**
     * Store a new brand.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:brands,name',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:brands,slug',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:10240',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        // Upload logo
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')
                ->store('brands', 'public');
        }

        // User who created the brand
        $validated['created_by'] = Auth::id();

        $brand = Brand::create($validated);

        return redirect()
            ->route('admin.brand')
            ->with('success', 'Brand created successfully.');
    }

    /**
     * Update an existing brand.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:brands,name,' . $brand->id,
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:brands,slug,' . $brand->id,
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:2048',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        // Replace old logo
        if ($request->hasFile('logo')) {

            if ($brand->logo) {
                Storage::disk('public')->delete($brand->logo);
            }

            $validated['logo'] = $request->file('logo')
                ->store('brands', 'public');
        }

        $brand->update($validated);

        return redirect()
            ->route('admin.brand')
            ->with('success', 'Brand updated successfully.');
    }

    /**
     * Delete brand.
     */
    public function destroy(Brand $brand)
    {
        // Delete logo
        if ($brand->logo) {
            Storage::disk('public')->delete($brand->logo);
        }

        $brand->delete();

        return redirect()
            ->route('admin.brand')
            ->with('success', 'Brand deleted successfully.');
    }
}
