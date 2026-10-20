<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Product::with([
            'category',
            'subcategory',
            'brand',
            'images',
            'relatedProducts',
            'variants.size',
            'variants.color',
        ])->latest();


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                /*
                |--------------------------------------------------------------------------
                | Product fields
                |--------------------------------------------------------------------------
                */

                $q->where('products.title', 'like', "%{$search}%")
                    ->orWhere('products.slug', 'like', "%{$search}%")
                    ->orWhere(
                        'products.short_description',
                        'like',
                        "%{$search}%"
                    );


                /*
                |--------------------------------------------------------------------------
                | Category
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('category', function ($category) use ($search) {

                    $category->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | Subcategory
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('subcategory', function ($subcategory) use ($search) {

                    $subcategory->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | Brand
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('brand', function ($brand) use ($search) {

                    $brand->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | Variant Size
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('variants.size', function ($size) use ($search) {

                    $size->where(
                        'name',
                        'like',
                        "%{$search}%"
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | Variant Color
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('variants.color', function ($color) use ($search) {

                    $color->where(function ($colorQuery) use ($search) {

                        $colorQuery->where(
                            'name',
                            'like',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'code',
                            'like',
                            "%{$search}%"
                        );

                    });

                });

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if (
            $request->filled('status') &&
            $request->status !== 'all'
        ) {

            $query->where(
                'products.status',
                $request->status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {

            $query->where(
                'products.category_id',
                $request->category_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Subcategory Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('subcategory_id')) {

            $query->where(
                'products.subcategory_id',
                $request->subcategory_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Brand Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('brand_id')) {

            $query->where(
                'products.brand_id',
                $request->brand_id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Color Filter
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Colors are now connected through product_variants.
        |
        */

        if ($request->filled('color_id')) {

            $query->whereHas(
                'variants.color',
                function ($color) use ($request) {

                    $color->where(
                        'colors.id',
                        $request->color_id
                    );

                }
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $products = $query
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Dropdown Data
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('status', true)
            ->orderBy('name')
            ->get();


        $subcategories = SubCategory::where('status', true)
            ->orderBy('name')
            ->get();


        $brands = Brand::where('status', true)
            ->orderBy('name')
            ->get();


        $colors = Color::where('status', true)
            ->where('is_delete', false)
            ->orderBy('name')
            ->get();


        $sizes = Size::where('status', true)
            ->where('is_delete', false)
            ->orderBy('name')
            ->get();


        $allProducts = Product::orderBy('title')
            ->get([
                'id',
                'title',
            ]);


        return view(
            'admin.admin.product',
            compact(
                'products',
                'categories',
                'subcategories',
                'brands',
                'colors',
                'sizes',
                'allProducts'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:products,slug',
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'nullable',
                'integer',
                'exists:sub_categories,id',
            ],

            'brand_id' => [
                'nullable',
                'integer',
                'exists:brands,id',
            ],


            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            'old_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'new_price' => [
                'required',
                'numeric',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Descriptions
            |--------------------------------------------------------------------------
            */

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'additional_information' => [
                'nullable',
                'string',
            ],

            'shipping_and_returns' => [
                'nullable',
                'string',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'boolean',
            ],


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'images' => [
                'nullable',
                'array',
                'max:10',
            ],

            'images.*' => [
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:10240',
            ],


            /*
            |--------------------------------------------------------------------------
            | Related Products
            |--------------------------------------------------------------------------
            */

            'related_products' => [
                'nullable',
                'array',
            ],

            'related_products.*' => [
                'integer',
                'exists:products,id',
            ],

        ]);


        DB::transaction(function () use (
            $validated,
            $request,
            &$product
        ) {

            /*
            |--------------------------------------------------------------------------
            | Create Product
            |--------------------------------------------------------------------------
            */

            $product = Product::create([

                'title' => $validated['title'],

                'slug' => $validated['slug'],

                'category_id' => $validated['category_id'],

                'subcategory_id' =>
                    $validated['subcategory_id'] ?? null,

                'brand_id' =>
                    $validated['brand_id'] ?? null,

                'old_price' =>
                    $validated['old_price'] ?? null,

                'new_price' =>
                    $validated['new_price'],

                'short_description' =>
                    $validated['short_description'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'additional_information' =>
                    $validated['additional_information'] ?? null,

                'shipping_and_returns' =>
                    $validated['shipping_and_returns'] ?? null,

                'status' =>
                    $validated['status'],

                'created_by' =>
                    Auth::id(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store(
                        'products',
                        'public'
                    );


                    $product->images()->create([

                        'image' => $path,

                    ]);

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Related Products
            |--------------------------------------------------------------------------
            */

            $relatedProducts = collect(
                $validated['related_products'] ?? []
            )
                ->filter(
                    fn ($id) => $id != $product->id
                )
                ->unique()
                ->values()
                ->toArray();


            $product->relatedProducts()->sync(
                $relatedProducts
            );

        });


        return redirect()
            ->route('admin.product')
            ->with(
                'success',
                'Product created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Product $product
    ) {

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:products,slug,' . $product->id,
            ],

            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            'subcategory_id' => [
                'nullable',
                'integer',
                'exists:sub_categories,id',
            ],

            'brand_id' => [
                'nullable',
                'integer',
                'exists:brands,id',
            ],


            /*
            |--------------------------------------------------------------------------
            | Pricing
            |--------------------------------------------------------------------------
            */

            'old_price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'new_price' => [
                'required',
                'numeric',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Descriptions
            |--------------------------------------------------------------------------
            */

            'short_description' => [
                'nullable',
                'string',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'additional_information' => [
                'nullable',
                'string',
            ],

            'shipping_and_returns' => [
                'nullable',
                'string',
            ],


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'status' => [
                'required',
                'boolean',
            ],


            /*
            |--------------------------------------------------------------------------
            | Images to Delete
            |--------------------------------------------------------------------------
            */

            'delete_images' => [
                'nullable',
                'array',
            ],

            'delete_images.*' => [
                'integer',
                'exists:product_images,id',
            ],


            /*
            |--------------------------------------------------------------------------
            | New Images
            |--------------------------------------------------------------------------
            */

            'images' => [
                'nullable',
                'array',
                'max:10',
            ],

            'images.*' => [
                'image',
                'mimes:jpeg,png,jpg,webp',
                'max:10240',
            ],


            /*
            |--------------------------------------------------------------------------
            | Related Products
            |--------------------------------------------------------------------------
            */

            'related_products' => [
                'nullable',
                'array',
            ],

            'related_products.*' => [
                'integer',
                'exists:products,id',
            ],

        ]);


        DB::transaction(function () use (
            $validated,
            $request,
            $product
        ) {

            /*
            |--------------------------------------------------------------------------
            | Update Product
            |--------------------------------------------------------------------------
            */

            $product->update([

                'title' =>
                    $validated['title'],

                'slug' =>
                    $validated['slug'],

                'category_id' =>
                    $validated['category_id'],

                'subcategory_id' =>
                    $validated['subcategory_id'] ?? null,

                'brand_id' =>
                    $validated['brand_id'] ?? null,

                'old_price' =>
                    $validated['old_price'] ?? null,

                'new_price' =>
                    $validated['new_price'],

                'short_description' =>
                    $validated['short_description'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'additional_information' =>
                    $validated['additional_information'] ?? null,

                'shipping_and_returns' =>
                    $validated['shipping_and_returns'] ?? null,

                'status' =>
                    $validated['status'],

            ]);


            /*
            |--------------------------------------------------------------------------
            | Delete Selected Images
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['delete_images'])) {

                $images = $product
                    ->images()
                    ->whereIn(
                        'id',
                        $validated['delete_images']
                    )
                    ->get();


                foreach ($images as $image) {

                    if ($image->image) {

                        Storage::disk('public')
                            ->delete($image->image);

                    }


                    $image->delete();

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Add New Images
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store(
                        'products',
                        'public'
                    );


                    $product->images()->create([

                        'image' => $path,

                    ]);

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Related Products
            |--------------------------------------------------------------------------
            */

            $relatedProducts = collect(
                $validated['related_products'] ?? []
            )
                ->filter(
                    fn ($id) => $id != $product->id
                )
                ->unique()
                ->values()
                ->toArray();


            $product->relatedProducts()->sync(
                $relatedProducts
            );

        });


        return redirect()
            ->route('admin.product')
            ->with(
                'success',
                'Product updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {

            /*
            |--------------------------------------------------------------------------
            | Delete Image Files
            |--------------------------------------------------------------------------
            */

            $product->load('images');


            foreach ($product->images as $image) {

                if ($image->image) {

                    Storage::disk('public')
                        ->delete($image->image);

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Delete Product
            |--------------------------------------------------------------------------
            |
            | product_variants will be deleted automatically because:
            |
            | product_variants.product_id
            | -> cascadeOnDelete()
            |
            */

            $product->delete();

        });


        return redirect()
            ->route('admin.product')
            ->with(
                'success',
                'Product deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PRODUCT VARIANT
    |--------------------------------------------------------------------------
    */

    public function storeVariant(
        Request $request,
        Product $product
    ) {

        $validated = $request->validate([

            'size_id' => [
                'required',
                'integer',
                'exists:sizes,id',
            ],

            'color_id' => [
                'required',
                'integer',
                'exists:colors,id',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Make sure Size is active
        |--------------------------------------------------------------------------
        */

        $sizeExists = Size::where('id', $validated['size_id'])
            ->where('status', true)
            ->where('is_delete', false)
            ->exists();


        if (!$sizeExists) {

            return back()
                ->withInput()
                ->withErrors([

                    'size_id' =>
                        'The selected size is not available.',

                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Make sure Color is active
        |--------------------------------------------------------------------------
        */

        $colorExists = Color::where('id', $validated['color_id'])
            ->where('status', true)
            ->where('is_delete', false)
            ->exists();


        if (!$colorExists) {

            return back()
                ->withInput()
                ->withErrors([

                    'color_id' =>
                        'The selected color is not available.',

                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Check Duplicate
        |--------------------------------------------------------------------------
        */

        $exists = ProductVariant::where(
                'product_id',
                $product->id
            )
            ->where(
                'size_id',
                $validated['size_id']
            )
            ->where(
                'color_id',
                $validated['color_id']
            )
            ->exists();


        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([

                    'variant' =>
                        'This size and color combination already exists for this product.',

                ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Create Variant
        |--------------------------------------------------------------------------
        */

        ProductVariant::create([

            'product_id' =>
                $product->id,

            'size_id' =>
                $validated['size_id'],

            'color_id' =>
                $validated['color_id'],

        ]);


        return redirect()
            ->route('admin.product')
            ->with(
                'success',
                'Product variant added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PRODUCT VARIANT
    |--------------------------------------------------------------------------
    */

    public function destroyVariant(
        ProductVariant $variant
    ) {

        $variant->delete();


        return redirect()
            ->route('admin.product')
            ->with(
                'success',
                'Product variant deleted successfully.'
            );
    }
}
