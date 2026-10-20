@extends('admin.layouts.app')


@section('style')

<style>

    .variant-color {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .color-preview {
        inline-size: 20px;
         block-size: 20px;
        border-radius: 50%;
        border: 1px solid #dee2e6;
        display: inline-block;
        flex-shrink: 0;
    }

    .variant-table td {
        vertical-align: middle;
    }

</style>

@endsection



@section('content')

<div class="content-wrapper">

    <main class="app-main" id="main" tabindex="-1">


        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="app-content-header">

            <div class="container-fluid">

                <div class="row">

                    <div class="col-sm-6">

                        <h1 class="mb-0 fs-3">
                            Products
                        </h1>

                    </div>


                    <div class="col-sm-6">

                        <nav aria-label="breadcrumb">

                            <ol class="breadcrumb float-sm-end">

                                <li class="breadcrumb-item">

                                    <a href="{{ route('admin.dashboard') }}">
                                        Home
                                    </a>

                                </li>

                                <li class="breadcrumb-item active">
                                    Products
                                </li>

                            </ol>

                        </nav>

                    </div>

                </div>

            </div>

        </div>



        {{-- ========================================================= --}}
        {{-- CONTENT --}}
        {{-- ========================================================= --}}

        <div class="app-content">

            <div class="container-fluid">

                @include('admin.layouts._message')



                {{-- ================================================= --}}
                {{-- PRODUCT LIST --}}
                {{-- ================================================= --}}

                <div class="row">

                    <div class="col-12">

                        <div class="card mb-4">


                            {{-- ================================================= --}}
                            {{-- CARD HEADER --}}
                            {{-- ================================================= --}}

                            <div class="card-header">

                                <div class="row g-2 align-items-center">


                                    <div class="col-12 col-md-4">

                                        <h3 class="card-title">
                                            List Products
                                        </h3>

                                    </div>



                                    <div class="col-12 col-md-8">

                                        <div
                                            class="d-flex justify-content-md-end gap-2"
                                        >


                                            {{-- Search --}}

                                            <form
                                                method="GET"
                                                action="{{ route('admin.product') }}"
                                                class="d-flex flex-wrap gap-2"
                                                id="product-search-form"
                                            >

                                                <div
                                                    class="input-group input-group-sm w-auto"
                                                >

                                                    <span class="input-group-text">

                                                        <i
                                                            class="bi bi-search"
                                                            aria-hidden="true"
                                                        ></i>

                                                    </span>


                                                    <input
                                                        type="search"
                                                        name="search"
                                                        id="product-search"
                                                        class="form-control"
                                                        placeholder="Search products..."
                                                        value="{{ request('search') }}"
                                                        aria-label="Search products"
                                                        style="inline-size: 180px"
                                                    >

                                                </div>



                                                {{-- Status --}}

                                                <select
                                                    name="status"
                                                    class="form-select form-select-sm w-auto"
                                                    aria-label="Filter by status"
                                                >

                                                    <option
                                                        value="all"
                                                        {{ request('status', 'all') === 'all' ? 'selected' : '' }}
                                                    >
                                                        All
                                                    </option>


                                                    <option
                                                        value="1"
                                                        {{ request('status') === '1' ? 'selected' : '' }}
                                                    >
                                                        Active
                                                    </option>


                                                    <option
                                                        value="0"
                                                        {{ request('status') === '0' ? 'selected' : '' }}
                                                    >
                                                        Inactive
                                                    </option>

                                                </select>



                                                {{-- Search Button --}}

                                                <button
                                                    type="submit"
                                                    class="btn btn-sm btn-primary"
                                                >

                                                    <i class="bi bi-search me-1"></i>

                                                    Search

                                                </button>



                                                {{-- Clear --}}

                                                @if(
                                                    request()->filled('search') ||
                                                    request('status', 'all') !== 'all'
                                                )

                                                    <a
                                                        href="{{ route('admin.product') }}"
                                                        class="btn btn-sm btn-outline-secondary"
                                                    >

                                                        <i class="bi bi-x-lg me-1"></i>

                                                        Clear

                                                    </a>

                                                @endif

                                            </form>



                                            {{-- New Product --}}

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-add-product"
                                            >

                                                <i class="bi bi-plus-lg me-1"></i>

                                                New Product

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            {{-- ================================================= --}}
                            {{-- PRODUCT TABLE --}}
                            {{-- ================================================= --}}

                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table
                                        class="table table-hover align-middle m-0"
                                    >

                                        <thead>

                                            <tr>

                                                <th>
                                                    Image
                                                </th>

                                                <th>
                                                    Title
                                                </th>

                                                <th>
                                                    Category
                                                </th>

                                                <th>
                                                    SubCategory
                                                </th>

                                                <th>
                                                    Brand
                                                </th>

                                                <th>
                                                    Price
                                                </th>

                                                <th>
                                                    Status
                                                </th>

                                                <th>
                                                    Created
                                                </th>

                                                <th class="text-end">
                                                    Actions
                                                </th>

                                            </tr>

                                        </thead>



                                        <tbody>

                                            @forelse ($products as $product)

                                                <tr>


                                                    {{-- Image --}}

                                                    <td>

                                                        @if ($product->images->first())

                                                            <img
                                                                src="{{ asset('storage/' . $product->images->first()->image) }}"
                                                                alt="{{ $product->title }}"
                                                                width="55"
                                                                height="55"
                                                                class="rounded object-fit-cover"
                                                            >

                                                        @else

                                                            <div
                                                                class="bg-light rounded d-flex align-items-center justify-content-center"
                                                                style="inline-size:55px;block-size:55px "
                                                            >

                                                                <i
                                                                    class="bi bi-image text-muted fs-4"
                                                                ></i>

                                                            </div>

                                                        @endif

                                                    </td>



                                                    {{-- Title --}}

                                                    <td>

                                                        <span class="fw-medium">
                                                            {{ $product->title }}
                                                        </span>

                                                    </td>



                                                    {{-- Category --}}

                                                    <td>

                                                        {{ $product->category?->name ?? '-' }}

                                                    </td>



                                                    {{-- SubCategory --}}

                                                    <td>

                                                        {{ $product->subcategory?->name ?? '-' }}

                                                    </td>



                                                    {{-- Brand --}}

                                                    <td>

                                                        {{ $product->brand?->name ?? '-' }}

                                                    </td>



                                                    {{-- Price --}}

                                                    <td>

                                                        @if ($product->old_price)

                                                            <div
                                                                class="text-muted text-decoration-line-through small"
                                                            >

                                                                {{ $product->old_price }}

                                                            </div>

                                                        @endif


                                                        <strong>
                                                            {{ $product->new_price }}
                                                        </strong>

                                                    </td>



                                                    {{-- Status --}}

                                                    <td>

                                                        @if ($product->status)

                                                            <span
                                                                class="badge text-bg-success"
                                                            >
                                                                Active
                                                            </span>

                                                        @else

                                                            <span
                                                                class="badge text-bg-secondary"
                                                            >
                                                                Inactive
                                                            </span>

                                                        @endif

                                                    </td>



                                                    {{-- Created --}}

                                                    <td>

                                                        {{ $product->created_at?->format('Y-m-d') }}

                                                    </td>



                                                    {{-- Actions --}}

                                                    <td class="text-end">

                                                        <div
                                                            class="d-flex justify-content-end gap-2"
                                                        >


                                                            {{-- Variants --}}

                                                            <button
                                                                type="button"
                                                                class="btn btn-sm btn-outline-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-variants-{{ $product->id }}"
                                                                title="Manage Variants"
                                                            >

                                                                <i class="bi bi-palette"></i>

                                                            </button>



                                                            {{-- Edit --}}

                                                            <button
                                                                type="button"
                                                                class="btn btn-sm btn-outline-secondary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-product-{{ $product->id }}"
                                                                title="Edit Product"
                                                            >

                                                                <i class="bi bi-pencil"></i>

                                                            </button>



                                                            {{-- Delete --}}

                                                            <button
                                                                type="button"
                                                                class="btn btn-sm btn-outline-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modal-delete-product-{{ $product->id }}"
                                                                title="Delete Product"
                                                            >

                                                                <i class="bi bi-trash"></i>

                                                            </button>

                                                        </div>

                                                    </td>

                                                </tr>


                                            @empty

                                                <tr>

                                                    <td
                                                        colspan="9"
                                                        class="text-center py-4"
                                                    >

                                                        <span class="text-muted">
                                                            No products found.
                                                        </span>

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>



                            {{-- ================================================= --}}
                            {{-- PAGINATION --}}
                            {{-- ================================================= --}}

                            <div class="card-footer clearfix">

                                {{ $products->links() }}

                            </div>

                        </div>

                    </div>

                </div>



                {{-- ========================================================= --}}
                {{-- ADD PRODUCT MODAL --}}
                {{-- ========================================================= --}}

                <div
                    class="modal fade"
                    id="modal-add-product"
                    tabindex="-1"
                    aria-labelledby="modal-add-product-label"
                    aria-hidden="true"
                >

                    <div class="modal-dialog modal-xl">

                        <div class="modal-content">

                            <form
                                method="POST"
                                action="{{ route('admin.addproduct') }}"
                                enctype="multipart/form-data"
                            >

                                @csrf


                                <div class="modal-header">

                                    <h5
                                        class="modal-title"
                                        id="modal-add-product-label"
                                    >
                                        Add New Product
                                    </h5>


                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>

                                </div>



                                <div class="modal-body">

                                    <div class="row">


                                        {{-- BASIC INFORMATION --}}

                                        <div class="col-12">

                                            <h6 class="fw-bold mb-3">
                                                Basic Information
                                            </h6>

                                        </div>



                                        {{-- Title --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-title"
                                                class="form-label"
                                            >
                                                Product Title
                                            </label>


                                            <input
                                                type="text"
                                                name="title"
                                                id="product-title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title') }}"
                                                placeholder="Product title"
                                                required
                                            >


                                            @error('title')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- Slug --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-slug"
                                                class="form-label"
                                            >
                                                Slug
                                            </label>


                                            <input
                                                type="text"
                                                name="slug"
                                                id="product-slug"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                value="{{ old('slug') }}"
                                                placeholder="product-slug"
                                                required
                                            >


                                            @error('slug')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- Category --}}

                                        <div class="col-md-4 mb-3">

                                            <label
                                                for="product-category"
                                                class="form-label"
                                            >
                                                Category
                                            </label>


                                            <select
                                                name="category_id"
                                                id="product-category"
                                                class="form-select @error('category_id') is-invalid @enderror"
                                                required
                                            >

                                                <option value="">
                                                    Select Category
                                                </option>


                                                @foreach ($categories as $category)

                                                    <option
                                                        value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                    >

                                                        {{ $category->name }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            @error('category_id')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- SubCategory --}}

                                        <div class="col-md-4 mb-3">

                                            <label
                                                for="product-subcategory"
                                                class="form-label"
                                            >
                                                SubCategory
                                            </label>


                                            <select
                                                name="subcategory_id"
                                                id="product-subcategory"
                                                class="form-select @error('subcategory_id') is-invalid @enderror"
                                            >

                                                <option value="">
                                                    Select SubCategory
                                                </option>


                                                @foreach ($subcategories as $subcategory)

                                                    <option
                                                        value="{{ $subcategory->id }}"
                                                        data-category="{{ $subcategory->category_id }}"
                                                        {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}
                                                    >

                                                        {{ $subcategory->name }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            @error('subcategory_id')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- Brand --}}

                                        <div class="col-md-4 mb-3">

                                            <label
                                                for="product-brand"
                                                class="form-label"
                                            >
                                                Brand
                                            </label>


                                            <select
                                                name="brand_id"
                                                id="product-brand"
                                                class="form-select @error('brand_id') is-invalid @enderror"
                                            >

                                                <option value="">
                                                    Select Brand
                                                </option>


                                                @foreach ($brands as $brand)

                                                    <option
                                                        value="{{ $brand->id }}"
                                                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}
                                                    >

                                                        {{ $brand->name }}

                                                    </option>

                                                @endforeach

                                            </select>


                                            @error('brand_id')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- VARIANT INFORMATION --}}

                                        <div class="col-12 mb-3">

                                            <div class="alert alert-info mb-0">

                                                <div
                                                    class="d-flex align-items-start"
                                                >

                                                    <i
                                                        class="bi bi-info-circle me-2 mt-1"
                                                    ></i>


                                                    <div>

                                                        <strong>
                                                            Product Variants
                                                        </strong>


                                                        <div class="small mt-1">

                                                            Sizes and colors are managed
                                                            separately.


                                                            After creating the product,
                                                            use the


                                                            <strong>
                                                                Variants
                                                            </strong>


                                                            button to add Size + Color
                                                            combinations.

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>



                                        {{-- PRICING --}}

                                        <div class="col-12">

                                            <h6 class="fw-bold mb-3 mt-2">
                                                Pricing
                                            </h6>

                                        </div>



                                        {{-- Old Price --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-old-price"
                                                class="form-label"
                                            >
                                                Old Price
                                            </label>


                                            <input
                                                type="number"
                                                name="old_price"
                                                id="product-old-price"
                                                class="form-control"
                                                value="{{ old('old_price') }}"
                                                min="0"
                                                step="0.01"
                                                placeholder="0.00"
                                            >

                                        </div>



                                        {{-- New Price --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-new-price"
                                                class="form-label"
                                            >
                                                New Price
                                            </label>


                                            <input
                                                type="number"
                                                name="new_price"
                                                id="product-new-price"
                                                class="form-control @error('new_price') is-invalid @enderror"
                                                value="{{ old('new_price') }}"
                                                min="0"
                                                step="0.01"
                                                placeholder="0.00"
                                                required
                                            >


                                            @error('new_price')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- IMAGES --}}

                                        <div class="col-12">

                                            <h6 class="fw-bold mb-3 mt-2">
                                                Product Images
                                            </h6>

                                        </div>



                                        <div class="col-12 mb-3">

                                            <label
                                                for="product-images"
                                                class="form-label"
                                            >
                                                Images
                                            </label>


                                            <input
                                                type="file"
                                                name="images[]"
                                                id="product-images"
                                                class="form-control @error('images') is-invalid @enderror"
                                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                                multiple
                                            >


                                            <div class="form-text">

                                                You can select multiple images.
                                                Maximum 10MB per image.

                                            </div>


                                            @error('images')

                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>

                                            @enderror


                                            @error('images.*')

                                                <div class="text-danger small mt-1">
                                                    {{ $message }}
                                                </div>

                                            @enderror

                                        </div>



                                        {{-- Image Preview --}}

                                        <div class="col-12 mb-3">

                                            <div
                                                id="product-image-preview"
                                                class="d-flex flex-wrap gap-2"
                                            ></div>

                                        </div>



                                        {{-- PRODUCT INFORMATION --}}

                                        <div class="col-12">

                                            <h6 class="fw-bold mb-3 mt-2">
                                                Product Information
                                            </h6>

                                        </div>



                                        {{-- Short Description --}}

                                        <div class="col-12 mb-3">

                                            <label
                                                for="product-short-description"
                                                class="form-label"
                                            >
                                                Short Description
                                            </label>


                                            <textarea
                                                name="short_description"
                                                id="product-short-description"
                                                class="form-control"
                                                rows="3"
                                                placeholder="Short product description"
                                            >{{ old('short_description') }}</textarea>

                                        </div>



                                        {{-- Description --}}

                                        <div class="col-12 mb-3">

                                            <label
                                                for="product-description"
                                                class="form-label"
                                            >
                                                Description
                                            </label>


                                            <textarea
                                                name="description"
                                                id="product-description"
                                                class="form-control"
                                                rows="5"
                                                placeholder="Full product description"
                                            >{{ old('description') }}</textarea>

                                        </div>



                                        {{-- Additional Information --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-additional-information"
                                                class="form-label"
                                            >
                                                Additional Information
                                            </label>


                                            <textarea
                                                name="additional_information"
                                                id="product-additional-information"
                                                class="form-control"
                                                rows="5"
                                                placeholder="Additional information"
                                            >{{ old('additional_information') }}</textarea>

                                        </div>



                                        {{-- Shipping --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-shipping"
                                                class="form-label"
                                            >
                                                Shipping & Returns
                                            </label>


                                            <textarea
                                                name="shipping_and_returns"
                                                id="product-shipping"
                                                class="form-control"
                                                rows="5"
                                                placeholder="Shipping and returns information"
                                            >{{ old('shipping_and_returns') }}</textarea>

                                        </div>



                                        {{-- Status --}}

                                        <div class="col-md-6 mb-3">

                                            <label
                                                for="product-status"
                                                class="form-label"
                                            >
                                                Status
                                            </label>


                                            <select
                                                name="status"
                                                id="product-status"
                                                class="form-select"
                                            >

                                                <option
                                                    value="1"
                                                    {{ old('status', 1) == 1 ? 'selected' : '' }}
                                                >
                                                    Active
                                                </option>


                                                <option
                                                    value="0"
                                                    {{ old('status') === '0' ? 'selected' : '' }}
                                                >
                                                    Inactive
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>



                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Cancel
                                    </button>


                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Add Product

                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>



                {{-- ========================================================= --}}
                {{-- PRODUCT MODALS --}}
                {{-- ========================================================= --}}

                @foreach ($products as $product)


                    {{-- ===================================================== --}}
                    {{-- VARIANTS MODAL --}}
                    {{-- ===================================================== --}}

                    <div
                        class="modal fade"
                        id="modal-variants-{{ $product->id }}"
                        tabindex="-1"
                        aria-labelledby="modal-variants-label-{{ $product->id }}"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">


                                {{-- Header --}}

                                <div class="modal-header">

                                    <div>

                                        <h5
                                            class="modal-title"
                                            id="modal-variants-label-{{ $product->id }}"
                                        >
                                            Product Variants
                                        </h5>


                                        <small class="text-muted">
                                            {{ $product->title }}
                                        </small>

                                    </div>


                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>

                                </div>



                                {{-- Body --}}

                                <div class="modal-body">


                                    {{-- ================================================= --}}
                                    {{-- ADD VARIANT --}}
                                    {{-- ================================================= --}}

                                    <div class="card border mb-4">

                                        <div class="card-header">

                                            <h6 class="mb-0">

                                                <i
                                                    class="bi bi-plus-circle me-1"
                                                ></i>

                                                Add Variant

                                            </h6>

                                        </div>


                                        <div class="card-body">

                                            <form
                                                method="POST"
                                                action="{{ route('admin.product.variant.store', $product->id) }}"
                                            >

                                                @csrf


                                                <div
                                                    class="row g-3 align-items-end"
                                                >


                                                    {{-- Size --}}

                                                    <div class="col-md-5">

                                                        <label
                                                            class="form-label"
                                                            for="variant-size-{{ $product->id }}"
                                                        >
                                                            Size
                                                        </label>


                                                        <select
                                                            name="size_id"
                                                            id="variant-size-{{ $product->id }}"
                                                            class="form-select"
                                                            required
                                                        >

                                                            <option value="">
                                                                Select Size
                                                            </option>


                                                            @foreach ($sizes as $size)

                                                                @if (
                                                                    $size->status &&
                                                                    !$size->is_delete
                                                                )

                                                                    <option
                                                                        value="{{ $size->id }}"
                                                                    >

                                                                        {{ $size->name }}

                                                                    </option>

                                                                @endif

                                                            @endforeach

                                                        </select>

                                                    </div>



                                                    {{-- Color --}}

                                                    <div class="col-md-5">

                                                        <label
                                                            class="form-label"
                                                            for="variant-color-{{ $product->id }}"
                                                        >
                                                            Color
                                                        </label>


                                                        <select
                                                            name="color_id"
                                                            id="variant-color-{{ $product->id }}"
                                                            class="form-select"
                                                            required
                                                        >

                                                            <option value="">
                                                                Select Color
                                                            </option>


                                                            @foreach ($colors as $color)

                                                                @if (
                                                                    $color->status &&
                                                                    !$color->is_delete
                                                                )

                                                                    <option
                                                                        value="{{ $color->id }}"
                                                                    >

                                                                        {{ $color->name }}

                                                                        -

                                                                        {{ $color->code }}

                                                                    </option>

                                                                @endif

                                                            @endforeach

                                                        </select>

                                                    </div>



                                                    {{-- Add --}}

                                                    <div class="col-md-2">

                                                        <button
                                                            type="submit"
                                                            class="btn btn-primary w-100"
                                                        >

                                                            <i
                                                                class="bi bi-plus-lg"
                                                            ></i>

                                                            Add

                                                        </button>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>



                                    {{-- ================================================= --}}
                                    {{-- EXISTING VARIANTS --}}
                                    {{-- ================================================= --}}

                                    <div>

                                        <div
                                            class="d-flex justify-content-between align-items-center mb-3"
                                        >

                                            <h6 class="fw-bold mb-0">
                                                Existing Variants
                                            </h6>


                                            <span
                                                class="badge text-bg-secondary"
                                            >

                                                {{ $product->variants->count() }}

                                            </span>

                                        </div>



                                        <div class="table-responsive">

                                            <table
                                                class="table table-hover align-middle variant-table"
                                            >

                                                <thead>

                                                    <tr>

                                                        <th>
                                                            #
                                                        </th>

                                                        <th>
                                                            Size
                                                        </th>

                                                        <th>
                                                            Color
                                                        </th>

                                                        <th>
                                                            Code
                                                        </th>

                                                        <th>
                                                            Created
                                                        </th>

                                                        <th class="text-end">
                                                            Action
                                                        </th>

                                                    </tr>

                                                </thead>



                                                <tbody>

                                                    @forelse ($product->variants as $variant)

                                                        <tr>


                                                            {{-- ID --}}

                                                            <td>
                                                                {{ $variant->id }}
                                                            </td>



                                                            {{-- Size --}}

                                                            <td>

                                                                {{ $variant->size?->name ?? '-' }}

                                                            </td>



                                                            {{-- Color --}}

                                                            <td>

                                                                @if ($variant->color)

                                                                    <span
                                                                        class="variant-color"
                                                                    >

                                                                        <span
                                                                            class="color-preview"
                                                                            style="background-color: {{ $variant->color->code }}"
                                                                        ></span>


                                                                        {{ $variant->color->name }}

                                                                    </span>

                                                                @else

                                                                    -

                                                                @endif

                                                            </td>



                                                            {{-- Code --}}

                                                            <td>

                                                                <code>
                                                                    {{ $variant->color?->code ?? '-' }}
                                                                </code>

                                                            </td>



                                                            {{-- Created --}}

                                                            <td>

                                                                {{ $variant->created_at?->format('Y-m-d') ?? '-' }}

                                                            </td>



                                                            {{-- Delete --}}

                                                            <td class="text-end">

                                                                <button
                                                                    type="button"
                                                                    class="btn btn-sm btn-outline-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-variant-{{ $variant->id }}"
                                                                    title="Delete Variant"
                                                                >

                                                                    <i
                                                                        class="bi bi-trash"
                                                                    ></i>

                                                                </button>

                                                            </td>

                                                        </tr>


                                                    @empty

                                                        <tr>

                                                            <td
                                                                colspan="6"
                                                                class="text-center text-muted py-4"
                                                            >

                                                                <i
                                                                    class="bi bi-box-seam fs-3 d-block mb-2"
                                                                ></i>

                                                                No variants added yet.

                                                            </td>

                                                        </tr>

                                                    @endforelse

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>



                                {{-- Footer --}}

                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Close
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- ===================================================== --}}
                    {{-- DELETE VARIANT MODALS --}}
                    {{-- IMPORTANT: OUTSIDE VARIANTS MODAL --}}
                    {{-- ===================================================== --}}

                    @foreach ($product->variants as $variant)

                        <div
                            class="modal fade"
                            id="modal-delete-variant-{{ $variant->id }}"
                            tabindex="-1"
                            aria-labelledby="modal-delete-variant-label-{{ $variant->id }}"
                            aria-hidden="true"
                        >

                            <div
                                class="modal-dialog modal-dialog-centered"
                            >

                                <div class="modal-content">


                                    <form
                                        method="POST"
                                        action="{{ route('admin.product.variant.delete', $variant->id) }}"
                                    >

                                        @csrf


                                        {{-- Header --}}

                                        <div class="modal-header">

                                            <h5
                                                class="modal-title"
                                                id="modal-delete-variant-label-{{ $variant->id }}"
                                            >
                                                Delete Variant
                                            </h5>


                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"
                                            ></button>

                                        </div>



                                        {{-- Body --}}

                                        <div class="modal-body">

                                            <div class="text-center">


                                                <i
                                                    class="bi bi-exclamation-triangle text-danger fs-1"
                                                ></i>


                                                <h5 class="mt-3">
                                                    Are you sure?
                                                </h5>


                                                <p class="text-muted mb-2">

                                                    You are about to delete this
                                                    variant:

                                                </p>


                                                <div class="fw-bold">

                                                    {{ $variant->size?->name ?? '-' }}

                                                    /

                                                    {{ $variant->color?->name ?? '-' }}

                                                </div>



                                                @if ($variant->color)

                                                    <div
                                                        class="mt-2 d-flex justify-content-center align-items-center gap-2"
                                                    >

                                                        <span
                                                            class="color-preview"
                                                            style="background-color: {{ $variant->color->code }}"
                                                        ></span>


                                                        <code>
                                                            {{ $variant->color->code }}
                                                        </code>

                                                    </div>

                                                @endif



                                                <div
                                                    class="alert alert-warning mt-3 mb-0"
                                                >

                                                    <i
                                                        class="bi bi-info-circle me-1"
                                                    ></i>

                                                    This action cannot be undone.

                                                </div>

                                            </div>

                                        </div>



                                        {{-- Footer --}}

                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Cancel
                                            </button>


                                            <button
                                                type="submit"
                                                class="btn btn-danger"
                                            >

                                                <i
                                                    class="bi bi-trash me-1"
                                                ></i>

                                                Delete Variant

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @endforeach



                    {{-- ===================================================== --}}
                    {{-- EDIT PRODUCT MODAL --}}
                    {{-- ===================================================== --}}

                    <div
                        class="modal fade"
                        id="modal-edit-product-{{ $product->id }}"
                        tabindex="-1"
                        aria-labelledby="modal-edit-product-label-{{ $product->id }}"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-xl">

                            <div class="modal-content">

                                <form
                                    method="POST"
                                    action="{{ route('admin.product.update', $product->id) }}"
                                    enctype="multipart/form-data"
                                >

                                    @csrf


                                    {{-- Header --}}

                                    <div class="modal-header">

                                        <h5
                                            class="modal-title"
                                            id="modal-edit-product-label-{{ $product->id }}"
                                        >
                                            Edit Product
                                        </h5>


                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>

                                    </div>



                                    {{-- Body --}}

                                    <div class="modal-body">

                                        <div class="row">


                                            {{-- BASIC INFORMATION --}}

                                            <div class="col-12">

                                                <h6 class="fw-bold mb-3">
                                                    Basic Information
                                                </h6>

                                            </div>



                                            {{-- Title --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    Product Title
                                                </label>


                                                <input
                                                    type="text"
                                                    name="title"
                                                    class="form-control"
                                                    value="{{ $product->title }}"
                                                    required
                                                >

                                            </div>



                                            {{-- Slug --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    Slug
                                                </label>


                                                <input
                                                    type="text"
                                                    name="slug"
                                                    class="form-control"
                                                    value="{{ $product->slug }}"
                                                    required
                                                >

                                            </div>



                                            {{-- Category --}}

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Category
                                                </label>


                                                <select
                                                    name="category_id"
                                                    class="form-select edit-category"
                                                    data-product="{{ $product->id }}"
                                                    required
                                                >

                                                    <option value="">
                                                        Select Category
                                                    </option>


                                                    @foreach ($categories as $category)

                                                        <option
                                                            value="{{ $category->id }}"
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}
                                                        >

                                                            {{ $category->name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>



                                            {{-- SubCategory --}}

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    SubCategory
                                                </label>


                                                <select
                                                    name="subcategory_id"
                                                    class="form-select edit-subcategory"
                                                    data-product="{{ $product->id }}"
                                                >

                                                    <option value="">
                                                        Select SubCategory
                                                    </option>


                                                    @foreach ($subcategories as $subcategory)

                                                        <option
                                                            value="{{ $subcategory->id }}"
                                                            data-category="{{ $subcategory->category_id }}"
                                                            {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}
                                                        >

                                                            {{ $subcategory->name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>



                                            {{-- Brand --}}

                                            <div class="col-md-4 mb-3">

                                                <label class="form-label">
                                                    Brand
                                                </label>


                                                <select
                                                    name="brand_id"
                                                    class="form-select"
                                                >

                                                    <option value="">
                                                        Select Brand
                                                    </option>


                                                    @foreach ($brands as $brand)

                                                        <option
                                                            value="{{ $brand->id }}"
                                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}
                                                        >

                                                            {{ $brand->name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>



                                            {{-- VARIANT NOTE --}}

                                            <div class="col-12 mb-3">

                                                <div class="alert alert-info mb-0">

                                                    <div
                                                        class="d-flex align-items-start"
                                                    >

                                                        <i
                                                            class="bi bi-info-circle me-2 mt-1"
                                                        ></i>


                                                        <div>

                                                            <strong>
                                                                Product Variants
                                                            </strong>


                                                            <div class="small mt-1">

                                                                Sizes and colors are
                                                                managed separately
                                                                from the product.

                                                                Use the

                                                                <strong>
                                                                    Variants
                                                                </strong>

                                                                button to add or remove
                                                                Size + Color combinations.

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>



                                            {{-- PRICING --}}

                                            <div class="col-12">

                                                <h6 class="fw-bold mb-3 mt-2">
                                                    Pricing
                                                </h6>

                                            </div>



                                            {{-- Old Price --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    Old Price
                                                </label>


                                                <input
                                                    type="number"
                                                    name="old_price"
                                                    class="form-control"
                                                    value="{{ $product->old_price }}"
                                                    min="0"
                                                    step="0.01"
                                                >

                                            </div>



                                            {{-- New Price --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    New Price
                                                </label>


                                                <input
                                                    type="number"
                                                    name="new_price"
                                                    class="form-control"
                                                    value="{{ $product->new_price }}"
                                                    min="0"
                                                    step="0.01"
                                                    required
                                                >

                                            </div>



                                            {{-- CURRENT IMAGES --}}

                                            <div class="col-12 mb-3">

                                                <label class="form-label">
                                                    Current Images
                                                </label>


                                                <div
                                                    class="d-flex flex-wrap gap-3"
                                                >

                                                    @forelse ($product->images as $image)

                                                        <div
                                                            class="position-relative"
                                                        >

                                                            <img
                                                                src="{{ asset('storage/' . $image->image) }}"
                                                                width="100"
                                                                height="100"
                                                                class="rounded object-fit-cover border"
                                                                alt="{{ $product->title }}"
                                                            >


                                                            <div
                                                                class="form-check mt-1"
                                                            >

                                                                <input
                                                                    type="checkbox"
                                                                    class="form-check-input"
                                                                    name="delete_images[]"
                                                                    value="{{ $image->id }}"
                                                                    id="delete-image-{{ $image->id }}"
                                                                >


                                                                <label
                                                                    class="form-check-label small"
                                                                    for="delete-image-{{ $image->id }}"
                                                                >
                                                                    Delete
                                                                </label>

                                                            </div>

                                                        </div>

                                                    @empty

                                                        <span class="text-muted">
                                                            No images
                                                        </span>

                                                    @endforelse

                                                </div>

                                            </div>



                                            {{-- New Images --}}

                                            <div class="col-12 mb-3">

                                                <label class="form-label">
                                                    Add New Images
                                                </label>


                                                <input
                                                    type="file"
                                                    name="images[]"
                                                    class="form-control"
                                                    accept="image/jpeg,image/png,image/jpg,image/webp"
                                                    multiple
                                                >


                                                <div class="form-text">

                                                    Maximum 10MB per image.

                                                </div>

                                            </div>



                                            {{-- PRODUCT INFORMATION --}}

                                            <div class="col-12 mb-3">

                                                <label class="form-label">
                                                    Short Description
                                                </label>


                                                <textarea
                                                    name="short_description"
                                                    class="form-control"
                                                    rows="3"
                                                >{{ $product->short_description }}</textarea>

                                            </div>



                                            {{-- Description --}}

                                            <div class="col-12 mb-3">

                                                <label class="form-label">
                                                    Description
                                                </label>


                                                <textarea
                                                    name="description"
                                                    class="form-control"
                                                    rows="5"
                                                >{{ $product->description }}</textarea>

                                            </div>



                                            {{-- Additional Information --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    Additional Information
                                                </label>


                                                <textarea
                                                    name="additional_information"
                                                    class="form-control"
                                                    rows="5"
                                                >{{ $product->additional_information }}</textarea>

                                            </div>



                                            {{-- Shipping --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    Shipping & Returns
                                                </label>


                                                <textarea
                                                    name="shipping_and_returns"
                                                    class="form-control"
                                                    rows="5"
                                                >{{ $product->shipping_and_returns }}</textarea>

                                            </div>



                                            {{-- Status --}}

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">
                                                    Status
                                                </label>


                                                <select
                                                    name="status"
                                                    class="form-select"
                                                >

                                                    <option
                                                        value="1"
                                                        {{ $product->status ? 'selected' : '' }}
                                                    >
                                                        Active
                                                    </option>


                                                    <option
                                                        value="0"
                                                        {{ !$product->status ? 'selected' : '' }}
                                                    >
                                                        Inactive
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>



                                    {{-- Footer --}}

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cancel
                                        </button>


                                        <button
                                            type="submit"
                                            class="btn btn-primary"
                                        >

                                            <i
                                                class="bi bi-check-lg me-1"
                                            ></i>

                                            Update Product

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>



                    {{-- ===================================================== --}}
                    {{-- DELETE PRODUCT MODAL --}}
                    {{-- ===================================================== --}}

                    <div
                        class="modal fade"
                        id="modal-delete-product-{{ $product->id }}"
                        tabindex="-1"
                        aria-labelledby="modal-delete-product-label-{{ $product->id }}"
                        aria-hidden="true"
                    >

                        <div
                            class="modal-dialog modal-dialog-centered"
                        >

                            <div class="modal-content">

                                <form
                                    method="POST"
                                    action="{{ route('admin.product.delete', $product->id) }}"
                                >

                                    @csrf


                                    {{-- Header --}}

                                    <div class="modal-header">

                                        <h5
                                            class="modal-title"
                                            id="modal-delete-product-label-{{ $product->id }}"
                                        >
                                            Delete Product
                                        </h5>


                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>

                                    </div>



                                    {{-- Body --}}

                                    <div class="modal-body">

                                        <div class="text-center">

                                            <i
                                                class="bi bi-exclamation-triangle text-danger fs-1"
                                            ></i>


                                            <h5 class="mt-3">
                                                Are you sure?
                                            </h5>


                                            <p class="text-muted mb-0">

                                                You are about to delete:

                                                <strong>
                                                    {{ $product->title }}
                                                </strong>

                                            </p>


                                            <p class="text-muted small">

                                                This action cannot be undone.

                                            </p>

                                        </div>

                                    </div>



                                    {{-- Footer --}}

                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal"
                                        >
                                            Cancel
                                        </button>


                                        <button
                                            type="submit"
                                            class="btn btn-danger"
                                        >

                                            <i
                                                class="bi bi-trash me-1"
                                            ></i>

                                            Delete Product

                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </main>

</div>

@endsection



@section('script')

<script>

document.addEventListener('DOMContentLoaded', function () {


    /*
    |--------------------------------------------------------------------------
    | Slug Generator
    |--------------------------------------------------------------------------
    */

    const titleInput =
        document.getElementById('product-title');

    const slugInput =
        document.getElementById('product-slug');


    if (titleInput && slugInput) {

        let slugManuallyChanged =
            slugInput.value.length > 0;


        slugInput.addEventListener('input', function () {

            slugManuallyChanged = true;

        });


        titleInput.addEventListener('input', function () {

            if (slugManuallyChanged) {
                return;
            }


            let slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');


            slugInput.value = slug;

        });

    }



    /*
    |--------------------------------------------------------------------------
    | Category → SubCategory - Add Product
    |--------------------------------------------------------------------------
    */

    const categoryInput =
        document.getElementById('product-category');

    const subcategoryInput =
        document.getElementById('product-subcategory');


    if (categoryInput && subcategoryInput) {

        function filterSubcategories() {

            const categoryId =
                categoryInput.value;


            const options =
                subcategoryInput.querySelectorAll('option');


            options.forEach(function (option) {

                if (!option.value) {

                    option.hidden = false;

                    return;

                }


                const optionCategory =
                    option.getAttribute('data-category');


                option.hidden =
                    optionCategory !== categoryId;

            });


            const selected =
                subcategoryInput.options[
                    subcategoryInput.selectedIndex
                ];


            if (
                selected &&
                selected.value &&
                selected.hidden
            ) {

                subcategoryInput.value = '';

            }

        }


        categoryInput.addEventListener(
            'change',
            filterSubcategories
        );


        filterSubcategories();

    }



    /*
    |--------------------------------------------------------------------------
    | Category → SubCategory - Edit Product
    |--------------------------------------------------------------------------
    */

    document
        .querySelectorAll('.edit-category')
        .forEach(function (categorySelect) {


            const productId =
                categorySelect.getAttribute('data-product');


            const subcategorySelect =
                document.querySelector(
                    '.edit-subcategory[data-product="' +
                    productId +
                    '"]'
                );


            if (!subcategorySelect) {
                return;
            }


            function filterEditSubcategories() {

                const categoryId =
                    categorySelect.value;


                const options =
                    subcategorySelect.querySelectorAll('option');


                options.forEach(function (option) {

                    if (!option.value) {

                        option.hidden = false;

                        return;

                    }


                    const optionCategory =
                        option.getAttribute('data-category');


                    option.hidden =
                        optionCategory !== categoryId;

                });


                const selected =
                    subcategorySelect.options[
                        subcategorySelect.selectedIndex
                    ];


                if (
                    selected &&
                    selected.value &&
                    selected.hidden
                ) {

                    subcategorySelect.value = '';

                }

            }


            categorySelect.addEventListener(
                'change',
                filterEditSubcategories
            );


            filterEditSubcategories();

        });



    /*
    |--------------------------------------------------------------------------
    | Image Preview
    |--------------------------------------------------------------------------
    */

    const imageInput =
        document.getElementById('product-images');

    const preview =
        document.getElementById('product-image-preview');


    if (imageInput && preview) {

        imageInput.addEventListener('change', function () {

            preview.innerHTML = '';


            const files =
                Array.from(this.files);


            files.forEach(function (file) {

                if (!file.type.startsWith('image/')) {
                    return;
                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        const wrapper =
                            document.createElement('div');


                        wrapper.style.width = '100px';

                        wrapper.style.height = '100px';


                        const img =
                            document.createElement('img');


                        img.src =
                            event.target.result;


                        img.alt =
                            file.name;


                        img.className =
                            'rounded object-fit-cover w-100 h-100';


                        wrapper.appendChild(img);

                        preview.appendChild(wrapper);

                    };


                reader.readAsDataURL(file);

            });

        });

    }



    /*
    |--------------------------------------------------------------------------
    | Empty Search Prevention
    |--------------------------------------------------------------------------
    */

    const searchForm =
        document.getElementById('product-search-form');

    const searchInput =
        document.getElementById('product-search');


    if (searchForm && searchInput) {

        searchForm.addEventListener('submit', function () {

            const search =
                searchInput.value.trim();


            if (search === '') {

                searchInput.disabled = true;

            }

        });

    }

});

</script>

@endsection
