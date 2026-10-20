<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Addcategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:categories,slug',
            ],

            'status' => ['required', 'boolean'],

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

        // Take the authenticated user's ID.
        $validated['created_by'] = $request->user()->id;

        // New categories are not deleted.
        $validated['is_delete'] = false;

        Category::create($validated);

        return redirect()
            ->route('admin.category')
            ->with('success', 'Category created successfully.');
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,

            'status' => 'required|boolean',

            'meta_title' => 'nullable|string|max:255',

            'meta_description' => 'nullable|string',

            'meta_keyword' => 'nullable|string|max:255',
        ]);

        $category->update($validated);

        return redirect()
            ->route('admin.category')
            ->with('success', 'Category updated successfully.');
    }

    public function deleted(int $id)
{
    $category = Category::findOrFail($id);

    if ($category->subCategories()->exists()) {
        return redirect()
            ->route('admin.category')
            ->with('error', 'Cannot delete this category because it has subcategories.');
    }

    $category->update([
        'is_delete' => true,
    ]);

    return redirect()
        ->route('admin.category')
        ->with('success', 'Category deleted successfully.');
}
}
