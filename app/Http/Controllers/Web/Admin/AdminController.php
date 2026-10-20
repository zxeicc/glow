<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
class AdminController extends Controller
{
    public function list()
    {
        $data['header_title'] = 'Users';
        $users = User::orderBy('role')->paginate(10);
        return view('admin.admin.list', $data, compact('users'));
    }

    public function edit(int $id)
    {
        $data['header_title'] = 'Edit';
        $user = User::findOrFail($id);
        return view('admin.layouts.edit', compact('user'));
    }

    public function search(Request $request)
    {
        $data['header_title'] = 'Users';

        $query = User::query();
        //search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        //filter by role
        if ($request->filled('role') && $request->role !== 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        return view('admin.admin.list', compact('users'), $data);
    }

    public function showcategory(Request $request)
    {
        $data['header_title'] = 'Category';
        $query = Category::where('is_delete', false)
            ->with('creator');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->status !== null && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $categories = $query
            ->latest()
            ->paginate(10);

        return view('admin.admin.category', $data,compact('categories'));
    }
    public function showsubcategory(Request $request)
{
    $data['header_title'] = 'SubCategory';
    $query = SubCategory::where('is_delete', false)
        ->with(['creator', 'category']);

    // Search
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%")
                ->orWhereHas('category', function ($categoryQuery) use ($search) {
                    $categoryQuery->where('name', 'like', "%{$search}%");
                });
        });
    }

    // Status filter
    if ($request->status !== null && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    $subcategories = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    // Categories for Add/Edit form
    $categories = Category::where('is_delete', false)
        ->orderBy('name')
        ->get();

    return view(
        'admin.admin.subcategory',$data,
        compact('subcategories', 'categories')
    );
}
   public function showColorSize()
    {
        $colors = Color::where('is_delete', false)
            ->orderBy('name')
            ->get();

        $sizes = Size::where('is_delete', false)
            ->orderBy('name')
            ->get();

        return view(
            'admin.admin.color-size',
            compact('colors', 'sizes')
        );
    }
}
