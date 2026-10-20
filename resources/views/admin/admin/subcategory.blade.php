@extends('admin.layouts.app')

@section('style')
@endsection

@section('content')

<div class="content-wrapper">


<main class="app-main" id="main" tabindex="-1">

    {{-- =========================
        Content Header
    ========================== --}}
    <div class="app-content-header">
        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <h1 class="mb-0 fs-3">
                        SubCategories
                    </h1>
                </div>

                <div class="col-sm-6">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb float-sm-end">

                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>

                            <li class="breadcrumb-item active">
                                SubCategories
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>
    </div>


    {{-- =========================
        App Content
    ========================== --}}
    <div class="app-content">

        <div class="container-fluid">

            {{-- Messages --}}
            @include('admin.layouts._message')


            <div class="row">

                <div class="col-12">

                    <div class="card mb-4">


                        {{-- =========================
                            Card Header
                        ========================== --}}
                        <div class="card-header">

                            <div class="row g-2 align-items-center">

                                <div class="col-12 col-md-4">

                                    <h3 class="card-title">
                                        List SubCategories
                                    </h3>

                                </div>


                                <div class="col-12 col-md-8">

                                    <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                        {{-- Search --}}
                                        <form method="GET" action="{{ route('admin.subcategory') }}"
                                                    class="d-flex flex-wrap gap-2">

                                                    {{-- Search --}}

                                                    <div class="input-group input-group-sm w-auto">

                                                        <span class="input-group-text">

                                                            <i class="bi bi-search" aria-hidden="true"></i>

                                                        </span>

                                                        <input type="search" name="search" id="subcategory-search"
                                                            class="form-control" placeholder="Search subcategories"
                                                            value="{{ request('search') }}" aria-label="Search subcategories"
                                                            style="width: 180px">

                                                    </div>


                                                    {{-- Status --}}

                                                    <select name="status" class="form-select form-select-sm w-auto"
                                                        aria-label="Filter by status">

                                                        <option value="all"
                                                            {{ request('status', 'all') === 'all' ? 'selected' : '' }}>
                                                            All
                                                        </option>

                                                        <option value="1"
                                                            {{ request('status') === '1' ? 'selected' : '' }}>
                                                            Active
                                                        </option>

                                                        <option value="0"
                                                            {{ request('status') === '0' ? 'selected' : '' }}>
                                                            Inactive
                                                        </option>

                                                    </select>


                                                    {{-- Search Button --}}

                                                    <button type="submit" class="btn btn-sm btn-primary">

                                                        <i class="bi bi-search me-1"></i>

                                                        Search

                                                    </button>

                                                </form>


                                        {{-- Add --}}
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal-add-subcategory"
                                        >

                                            <i class="bi bi-plus-lg me-1"></i>

                                            New SubCategory

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- =========================
                            Table
                        ========================== --}}
                        <div class="card-body p-0">

                            <div class="table-responsive">

                                <table class="table table-hover align-middle m-0">

                                    <thead>

                                        <tr>

                                            <th>
                                                Category
                                            </th>

                                            <th>
                                                Name
                                            </th>

                                            <th>
                                                Slug
                                            </th>

                                            <th>
                                                Meta Title
                                            </th>

                                            <th>
                                                Meta Description
                                            </th>

                                            <th>
                                                Meta Keyword
                                            </th>

                                            <th>
                                                Created By
                                            </th>

                                            <th>
                                                Status
                                            </th>

                                            <th>
                                                Created Date
                                            </th>

                                            <th class="text-end">
                                                Actions
                                            </th>

                                        </tr>

                                    </thead>


                                    <tbody>

                                        @forelse ($subcategories as $subcategory)

                                            <tr>


                                                {{-- Category --}}
                                                <td>

                                                    <span class="fw-medium">

                                                        {{ $subcategory->category?->name ?? 'Unknown' }}

                                                    </span>

                                                </td>


                                                {{-- Name --}}
                                                <td>

                                                    <span class="fw-medium">

                                                        {{ $subcategory->name }}

                                                    </span>

                                                </td>


                                                {{-- Slug --}}
                                                <td>

                                                    {{ $subcategory->slug }}

                                                </td>


                                                {{-- Meta Title --}}
                                                <td>

                                                    {{ $subcategory->meta_title ?? '-' }}

                                                </td>


                                                {{-- Meta Description --}}
                                                <td>

                                                    {{ $subcategory->meta_description ?? '-' }}

                                                </td>


                                                {{-- Meta Keyword --}}
                                                <td>

                                                    {{ $subcategory->meta_keyword ?? '-' }}

                                                </td>


                                                {{-- Created By --}}
                                                <td>

                                                    {{ $subcategory->creator?->name ?? 'Unknown' }}

                                                </td>


                                                {{-- Status --}}
                                                <td>

                                                    @if ($subcategory->status)

                                                        <span class="badge text-bg-success">
                                                            Active
                                                        </span>

                                                    @else

                                                        <span class="badge text-bg-secondary">
                                                            Inactive
                                                        </span>

                                                    @endif

                                                </td>


                                                {{-- Created Date --}}
                                                <td>

                                                    {{ $subcategory->created_at?->format('Y-m-d') ?? '-' }}

                                                </td>


                                                {{-- Actions --}}
                                                <td class="text-end">

                                                    <div class="d-flex justify-content-end gap-2">


                                                        {{-- Edit --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-outline-secondary"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-edit-subcategory"

                                                            data-edit-url="{{ route('admin.subcategory.update', $subcategory->id) }}"

                                                            data-subcategory-category-id="{{ $subcategory->category_id }}"
                                                            data-subcategory-name="{{ $subcategory->name }}"
                                                            data-subcategory-slug="{{ $subcategory->slug }}"
                                                            data-subcategory-status="{{ $subcategory->status }}"

                                                            data-subcategory-meta-title="{{ $subcategory->meta_title }}"
                                                            data-subcategory-meta-description="{{ $subcategory->meta_description }}"
                                                            data-subcategory-meta-keyword="{{ $subcategory->meta_keyword }}"
                                                        >

                                                            <i class="bi bi-pencil"></i>

                                                        </button>


                                                        {{-- Delete --}}
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-outline-danger"

                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-delete-subcategory"

                                                            data-delete-url="{{ route('admin.subcategory.delete', $subcategory->id) }}"

                                                            data-subcategory-name="{{ $subcategory->name }}"
                                                        >

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </div>

                                                </td>

                                            </tr>

                                        @empty

                                            <tr>

                                                <td
                                                    colspan="10"
                                                    class="text-center py-4"
                                                >

                                                    <div class="text-muted">

                                                        No Subcategories found.

                                                    </div>

                                                </td>

                                            </tr>

                                        @endforelse

                                    </tbody>

                                </table>

                            </div>

                        </div>


                        {{-- =========================
                            Pagination
                        ========================== --}}
                        <div class="card-footer clearfix">

                            {{ $subcategories->appends(request()->query())->links() }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                ADD SUBCATEGORY MODAL
            ====================================================== --}}
            <div
                class="modal fade"
                id="modal-add-subcategory"
                tabindex="-1"
                aria-hidden="true"
            >

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">


                        <form
                            method="POST"
                            action="{{ route('admin.addsubcategory') }}"
                        >

                            @csrf


                            {{-- Header --}}
                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Add New SubCategory
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                ></button>

                            </div>


                            {{-- Body --}}
                            <div class="modal-body">

                                <div class="row">


                                    {{-- Category --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="add-category-id"
                                            class="form-label"
                                        >
                                            Category
                                        </label>

                                        <select
                                            name="category_id"
                                            id="add-category-id"
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


                                    {{-- Name --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="add-name"
                                            class="form-label"
                                        >
                                            SubCategory Name
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            id="add-name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}"
                                            placeholder="SubCategory name"
                                            required
                                        >


                                        @error('name')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>


                                    {{-- Slug --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="add-slug"
                                            class="form-label"
                                        >
                                            Slug
                                        </label>

                                        <input
                                            type="text"
                                            name="slug"
                                            id="add-slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug') }}"
                                            placeholder="subcategory-slug"
                                            required
                                        >


                                        @error('slug')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>


                                    {{-- Status --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="add-status"
                                            class="form-label"
                                        >
                                            Status
                                        </label>

                                        <select
                                            name="status"
                                            id="add-status"
                                            class="form-select @error('status') is-invalid @enderror"
                                            required
                                        >

                                            <option
                                                value="1"
                                                {{ old('status', '1') == '1' ? 'selected' : '' }}
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


                                        @error('status')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>


                                    {{-- Meta Title --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="add-meta-title"
                                            class="form-label"
                                        >
                                            Meta Title
                                        </label>

                                        <input
                                            type="text"
                                            name="meta_title"
                                            id="add-meta-title"
                                            class="form-control @error('meta_title') is-invalid @enderror"
                                            value="{{ old('meta_title') }}"
                                            placeholder="Meta title"
                                        >


                                        @error('meta_title')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>


                                    {{-- Meta Keyword --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="add-meta-keyword"
                                            class="form-label"
                                        >
                                            Meta Keyword
                                        </label>

                                        <input
                                            type="text"
                                            name="meta_keyword"
                                            id="add-meta-keyword"
                                            class="form-control @error('meta_keyword') is-invalid @enderror"
                                            value="{{ old('meta_keyword') }}"
                                            placeholder="keyword1, keyword2, keyword3"
                                        >


                                        @error('meta_keyword')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

                                    </div>


                                    {{-- Meta Description --}}
                                    <div class="col-md-12 mb-3">

                                        <label
                                            for="add-meta-description"
                                            class="form-label"
                                        >
                                            Meta Description
                                        </label>

                                        <textarea
                                            name="meta_description"
                                            id="add-meta-description"
                                            class="form-control @error('meta_description') is-invalid @enderror"
                                            rows="3"
                                            placeholder="Meta description"
                                        >{{ old('meta_description') }}</textarea>


                                        @error('meta_description')

                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>

                                        @enderror

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
                                    Add SubCategory
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                EDIT SUBCATEGORY MODAL
            ====================================================== --}}
            <div
                class="modal fade"
                id="modal-edit-subcategory"
                tabindex="-1"
                aria-hidden="true"
            >

                <div class="modal-dialog modal-lg">

                    <div class="modal-content">


                        <form
                            id="edit-subcategory-form"
                            method="POST"
                        >

                            @csrf


                            {{-- Header --}}
                            <div class="modal-header">

                                <h5 class="modal-title">
                                    Edit SubCategory
                                </h5>

                                <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                ></button>

                            </div>


                            {{-- Body --}}
                            <div class="modal-body">

                                <div class="row">


                                    {{-- Category --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="edit-category-id"
                                            class="form-label"
                                        >
                                            Category
                                        </label>

                                        <select
                                            name="category_id"
                                            id="edit-category-id"
                                            class="form-select"
                                            required
                                        >

                                            <option value="">
                                                Select Category
                                            </option>

                                            @foreach ($categories as $category)

                                                <option
                                                    value="{{ $category->id }}"
                                                >
                                                    {{ $category->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>


                                    {{-- Name --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="edit-name"
                                            class="form-label"
                                        >
                                            SubCategory Name
                                        </label>

                                        <input
                                            type="text"
                                            name="name"
                                            id="edit-name"
                                            class="form-control"
                                            required
                                        >

                                    </div>


                                    {{-- Slug --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="edit-slug"
                                            class="form-label"
                                        >
                                            Slug
                                        </label>

                                        <input
                                            type="text"
                                            name="slug"
                                            id="edit-slug"
                                            class="form-control"
                                            required
                                        >

                                    </div>


                                    {{-- Status --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="edit-status"
                                            class="form-label"
                                        >
                                            Status
                                        </label>

                                        <select
                                            name="status"
                                            id="edit-status"
                                            class="form-select"
                                            required
                                        >

                                            <option value="1">
                                                Active
                                            </option>

                                            <option value="0">
                                                Inactive
                                            </option>

                                        </select>

                                    </div>


                                    {{-- Meta Title --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="edit-meta-title"
                                            class="form-label"
                                        >
                                            Meta Title
                                        </label>

                                        <input
                                            type="text"
                                            name="meta_title"
                                            id="edit-meta-title"
                                            class="form-control"
                                        >

                                    </div>


                                    {{-- Meta Keyword --}}
                                    <div class="col-md-6 mb-3">

                                        <label
                                            for="edit-meta-keyword"
                                            class="form-label"
                                        >
                                            Meta Keyword
                                        </label>

                                        <input
                                            type="text"
                                            name="meta_keyword"
                                            id="edit-meta-keyword"
                                            class="form-control"
                                        >

                                    </div>


                                    {{-- Meta Description --}}
                                    <div class="col-12 mb-3">

                                        <label
                                            for="edit-meta-description"
                                            class="form-label"
                                        >
                                            Meta Description
                                        </label>

                                        <textarea
                                            name="meta_description"
                                            id="edit-meta-description"
                                            class="form-control"
                                            rows="3"
                                        ></textarea>

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
                                    Update SubCategory
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                DELETE SUBCATEGORY MODAL
            ====================================================== --}}
            <div
                class="modal fade"
                id="modal-delete-subcategory"
                tabindex="-1"
                aria-hidden="true"
            >

                <div class="modal-dialog">

                    <div class="modal-content">


                        <div class="modal-header">

                            <h5 class="modal-title">
                                Delete SubCategory
                            </h5>

                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                            ></button>

                        </div>


                        <div class="modal-body">

                            Are you sure you want to delete

                            <strong id="delete-subcategory-name"></strong>?

                        </div>


                        <div class="modal-footer">

                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Cancel
                            </button>


                            <form
                                id="delete-subcategory-form"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >
                                    Delete SubCategory
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

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
    | EDIT SUBCATEGORY
    |--------------------------------------------------------------------------
    */

    const editModal =
        document.getElementById('modal-edit-subcategory');

    const editForm =
        document.getElementById('edit-subcategory-form');

    const editCategory =
        document.getElementById('edit-category-id');

    const editName =
        document.getElementById('edit-name');

    const editSlug =
        document.getElementById('edit-slug');

    const editStatus =
        document.getElementById('edit-status');

    const editMetaTitle =
        document.getElementById('edit-meta-title');

    const editMetaDescription =
        document.getElementById('edit-meta-description');

    const editMetaKeyword =
        document.getElementById('edit-meta-keyword');


    if (editModal && editForm) {

        editModal.addEventListener(
            'show.bs.modal',
            function (event) {

                const button = event.relatedTarget;

                if (!button) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | Get Data
                |--------------------------------------------------------------------------
                */

                const editUrl =
                    button.getAttribute('data-edit-url');

                const categoryId =
                    button.getAttribute(
                        'data-subcategory-category-id'
                    );

                const name =
                    button.getAttribute(
                        'data-subcategory-name'
                    );

                const slug =
                    button.getAttribute(
                        'data-subcategory-slug'
                    );

                const status =
                    button.getAttribute(
                        'data-subcategory-status'
                    );

                const metaTitle =
                    button.getAttribute(
                        'data-subcategory-meta-title'
                    );

                const metaDescription =
                    button.getAttribute(
                        'data-subcategory-meta-description'
                    );

                const metaKeyword =
                    button.getAttribute(
                        'data-subcategory-meta-keyword'
                    );


                /*
                |--------------------------------------------------------------------------
                | Form Action
                |--------------------------------------------------------------------------
                */

                editForm.setAttribute(
                    'action',
                    editUrl
                );


                /*
                |--------------------------------------------------------------------------
                | Fill Form
                |--------------------------------------------------------------------------
                */

                editCategory.value =
                    categoryId ?? '';

                editName.value =
                    name ?? '';

                editSlug.value =
                    slug ?? '';

                editStatus.value =
                    status ?? '1';

                editMetaTitle.value =
                    metaTitle ?? '';

                editMetaDescription.value =
                    metaDescription ?? '';

                editMetaKeyword.value =
                    metaKeyword ?? '';

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | DELETE SUBCATEGORY
    |--------------------------------------------------------------------------
    */

    const deleteModal =
        document.getElementById(
            'modal-delete-subcategory'
        );

    const deleteForm =
        document.getElementById(
            'delete-subcategory-form'
        );

    const deleteName =
        document.getElementById(
            'delete-subcategory-name'
        );


    if (deleteModal && deleteForm) {

        deleteModal.addEventListener(
            'show.bs.modal',
            function (event) {

                const button =
                    event.relatedTarget;

                if (!button) {
                    return;
                }


                const deleteUrl =
                    button.getAttribute(
                        'data-delete-url'
                    );

                const name =
                    button.getAttribute(
                        'data-subcategory-name'
                    );


                /*
                |--------------------------------------------------------------------------
                | Form Action
                |--------------------------------------------------------------------------
                */

                deleteForm.setAttribute(
                    'action',
                    deleteUrl
                );


                /*
                |--------------------------------------------------------------------------
                | Name
                |--------------------------------------------------------------------------
                */

                if (deleteName) {

                    deleteName.textContent =
                        name ?? '';

                }

            }
        );

    }

});

</script>

@endsection
