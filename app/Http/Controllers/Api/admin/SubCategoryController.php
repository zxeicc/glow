<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    /**
     * Create a new SubCategory.
     */
    public function Addsubcategory(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:sub_categories,slug',
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'meta_keyword' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        // Authenticated user
        $validated['created_by'] = $request->user()->id;

        // New SubCategory is not deleted
        $validated['is_delete'] = false;

        SubCategory::create($validated);

        return redirect()
            ->route('admin.subcategory')
            ->with('success', 'SubCategory created successfully.');
    }

    /**
     * Update a SubCategory.
     */
    public function update(Request $request, int $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $validated = $request->validate([
            'category_id' => [
                'required',
                'exists:categories,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_categories', 'slug')
                    ->ignore($subcategory->id),
            ],

            'status' => [
                'required',
                'boolean',
            ],

            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'meta_keyword' => [
                'nullable',
                'string',
                'max:255',
            ],
        ]);

        $subcategory->update($validated);

        return redirect()
            ->route('admin.subcategory')
            ->with('success', 'SubCategory updated successfully.');
    }

    /**
     * Soft delete a SubCategory using is_delete flag.
     */
    public function deleted(int $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $subcategory->update([
            'is_delete' => true,
        ]);

        return redirect()
            ->route('admin.subcategory')
            ->with('success', 'SubCategory deleted successfully.');
    }
}
