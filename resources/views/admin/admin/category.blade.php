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
                                Categories
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

                                    <li class="breadcrumb-item active" aria-current="page">
                                        Categories
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
                                                List Categories
                                            </h3>

                                        </div>

                                        <div class="col-12 col-md-8">

                                            <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                                {{-- Search / Filter --}}

                                                <form method="GET" action="{{ route('admin.category') }}"
                                                    class="d-flex flex-wrap gap-2">

                                                    {{-- Search --}}

                                                    <div class="input-group input-group-sm w-auto">

                                                        <span class="input-group-text">

                                                            <i class="bi bi-search" aria-hidden="true"></i>

                                                        </span>

                                                        <input type="search" name="search" id="category-search"
                                                            class="form-control" placeholder="Search categories"
                                                            value="{{ request('search') }}" aria-label="Search categories"
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


                                                {{-- Add Category --}}

                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modal-add-category">

                                                    <i class="bi bi-plus-lg me-1"></i>

                                                    New Category

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>


                                {{-- =========================
                                    Card Body
                                ========================== --}}

                                <div class="card-body p-0">

                                    <div class="table-responsive">

                                        <table class="table table-hover align-middle m-0">

                                            <thead>

                                                <tr>

                                                    <th scope="col">
                                                        Name
                                                    </th>

                                                    <th scope="col">
                                                        Slug
                                                    </th>

                                                    <th scope="col">
                                                        Meta Title
                                                    </th>

                                                    <th scope="col">
                                                        Meta Description
                                                    </th>

                                                    <th scope="col">
                                                        Meta Keyword
                                                    </th>

                                                    <th scope="col">
                                                        Created By
                                                    </th>

                                                    <th scope="col">
                                                        Status
                                                    </th>

                                                    <th scope="col">
                                                        Created Date
                                                    </th>

                                                    <th scope="col" class="text-end">
                                                        Actions
                                                    </th>

                                                </tr>

                                            </thead>


                                            <tbody>

                                                @forelse ($categories as $category)
                                                    <tr>

                                                        {{-- Name --}}

                                                        <td>

                                                            <span class="fw-medium">
                                                                {{ $category->name }}
                                                            </span>

                                                        </td>


                                                        {{-- Slug --}}

                                                        <td>
                                                            {{ $category->slug }}
                                                        </td>


                                                        {{-- Meta Title --}}

                                                        <td>
                                                            {{ $category->meta_title ?? '-' }}
                                                        </td>


                                                        {{-- Meta Description --}}

                                                        <td>
                                                            {{ $category->meta_description ?? '-' }}
                                                        </td>


                                                        {{-- Meta Keyword --}}

                                                        <td>
                                                            {{ $category->meta_keyword ?? '-' }}
                                                        </td>


                                                        {{-- Created By --}}

                                                        <td>
                                                            {{ $category->creator?->name ?? 'Unknown' }}
                                                        </td>


                                                        {{-- Status --}}

                                                        <td>

                                                            @if ($category->status)
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
                                                            {{ $category->created_at->format('Y-m-d') }}
                                                        </td>


                                                        {{-- Actions --}}

                                                        <td class="text-end">

                                                            <div
                                                                class="d-flex justify-content-end align-items-center gap-2">

                                                                {{-- Edit --}}

                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-secondary"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-edit-category"
                                                                    data-edit-url="{{ route('admin.category.update', $category->id) }}"
                                                                    data-category-name="{{ $category->name }}"
                                                                    data-category-slug="{{ $category->slug }}"
                                                                    data-category-status="{{ $category->status }}"
                                                                    data-category-meta-title="{{ $category->meta_title }}"
                                                                    data-category-meta-description="{{ $category->meta_description }}"
                                                                    data-category-meta-keyword="{{ $category->meta_keyword }}">
                                                                    <i class="bi bi-pencil"></i>
                                                                </button>


                                                                {{-- Delete --}}

                                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-category"
                                                                    data-delete-url="{{ route('admin.category.delete', $category->id) }}"
                                                                    data-category-name="{{ $category->name }}">

                                                                    <i class="bi bi-trash"></i>

                                                                </button>

                                                            </div>

                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>

                                                        <td colspan="9" class="text-center py-4">

                                                            <div class="text-muted">
                                                                No categories found.
                                                            </div>

                                                        </td>

                                                    </tr>
                                                @endforelse

                                            </tbody>

                                        </table>

                                    </div>

                                </div>


                                {{-- =========================
                                    Card Footer
                                ========================== --}}

                                <div class="card-footer clearfix">

                                    {{ $categories->appends(request()->query())->links() }}

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =====================================================
                        Add Category Modal
                    ====================================================== --}}

                    <div class="modal fade" id="modal-add-category" tabindex="-1"
                        aria-labelledby="modal-add-category-label" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">

                                <form method="POST" action="{{ route('admin.addcategory') }}">

                                    @csrf


                                    {{-- Header --}}

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="modal-add-category-label">
                                            Add New Category
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>


                                    {{-- Body --}}

                                    <div class="modal-body">


                                        {{-- Name --}}

                                        <div class="mb-3">

                                            <label for="category-name" class="form-label">
                                                Category Name
                                            </label>

                                            <input type="text" name="name" id="category-name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Category name" required>

                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>


                                        {{-- Slug --}}

                                        <div class="mb-3">

                                            <label for="category-slug" class="form-label">
                                                Slug
                                            </label>

                                            <input type="text" name="slug" id="category-slug"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                value="{{ old('slug') }}" placeholder="category-slug" required>

                                            @error('slug')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>


                                        {{-- Status --}}

                                        <div class="mb-3">

                                            <label for="category-status" class="form-label">
                                                Status
                                            </label>

                                            <select name="status" id="edit-category-status"
                                                class="form-select @error('status') is-invalid @enderror">

                                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>

                                                <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
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

                                        <div class="mb-3">

                                            <label for="meta-title" class="form-label">
                                                Meta Title
                                            </label>

                                            <input type="text" name="meta_title" id="meta-title"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                value="{{ old('meta_title') }}" placeholder="Meta title">

                                            @error('meta_title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>


                                        {{-- Meta Description --}}

                                        <div class="mb-3">

                                            <label for="meta-description" class="form-label">
                                                Meta Description
                                            </label>

                                            <textarea name="meta_description" id="meta-description"
                                                class="form-control @error('meta_description') is-invalid @enderror" rows="3"
                                                placeholder="Meta description">{{ old('meta_description') }}</textarea>

                                            @error('meta_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>


                                        {{-- Meta Keyword --}}

                                        <div class="mb-3">

                                            <label for="meta-keyword" class="form-label">
                                                Meta Keyword
                                            </label>

                                            <input type="text" name="meta_keyword" id="meta-keyword"
                                                class="form-control @error('meta_keyword') is-invalid @enderror"
                                                value="{{ old('meta_keyword') }}"
                                                placeholder="keyword1, keyword2, keyword3">

                                            @error('meta_keyword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- Footer --}}

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Add Category
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>
                    {{-- =====================================================
                        Edit Category Modal
                    ====================================================== --}}
                    <div class="modal fade" id="modal-edit-category" tabindex="-1"
                        aria-labelledby="modal-edit-category-label" aria-hidden="true">

                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-edit-category-label">
                                        Edit Category
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>

                                <form id="edit-category-form" method="POST">

                                    @csrf

                                    <div class="modal-body">

                                        <div class="row">

                                            {{-- Name --}}
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    Name
                                                </label>

                                                <input type="text" class="form-control" id="edit-category-name"
                                                    name="name" value="{{ old('name', $category->name) }}" required>
                                            </div>

                                            {{-- Slug --}}
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    Slug
                                                </label>

                                                <input type="text" class="form-control" id="edit-category-slug"
                                                    name="slug" value="{{ old('slug', $category->slug) }}"required>
                                            </div>

                                            {{-- Status --}}
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    Status
                                                </label>

                                                <select name="status" id="category-status"
                                                    class="form-select @error('status') is-invalid @enderror">

                                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                                        Active
                                                    </option>

                                                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>

                                                </select>
                                            </div>

                                            {{-- Meta Title --}}
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    Meta Title
                                                </label>

                                                <input type="text" class="form-control" id="edit-category-meta-title"
                                                    name="meta_title"value="{{ old('meta_title', $category->meta_title) }}">
                                            </div>

                                            {{-- Meta Description --}}
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Meta Description
                                                </label>

                                                <textarea name="meta_description">{{ old('meta_description', $category->meta_description) }}</textarea>
                                            </div>

                                            {{-- Meta Keyword --}}
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Meta Keyword
                                                </label>

                                                <input type="text" class="form-control"
                                                    id="edit-category-meta-keyword"
                                                    name="meta_keyword"value="{{ old('Meta Keyword', $category->meta_keyword) }}">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            Update Category
                                        </button>

                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    {{-- =====================================================
                        Delete Category Modal
                    ====================================================== --}}

                    <div class="modal fade" id="modal-delete-category" tabindex="-1"
                        aria-labelledby="modal-delete-category-label" aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">


                                {{-- Header --}}

                                <div class="modal-header">

                                    <h5 class="modal-title" id="modal-delete-category-label">
                                        Delete Category
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>


                                {{-- Body --}}

                                <div class="modal-body">

                                    Are you sure you want to delete

                                    <strong id="delete-category-name"></strong>?

                                </div>


                                {{-- Footer --}}

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>


                                    <form id="delete-category-form" method="POST">

                                        @csrf

                                        <button type="submit" class="btn btn-danger">
                                            Delete Category
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
        document.addEventListener('DOMContentLoaded', function() {

            const editModal = document.getElementById('modal-edit-category');

            const editForm = document.getElementById('edit-category-form');

            const nameInput = document.getElementById('edit-category-name');
            const slugInput = document.getElementById('edit-category-slug');
            const statusInput = document.getElementById('edit-category-status');

            const metaTitleInput =
                document.getElementById('edit-category-meta-title');

            const metaDescriptionInput =
                document.getElementById('edit-category-meta-description');

            const metaKeywordInput =
                document.getElementById('edit-category-meta-keyword');


            editModal.addEventListener('show.bs.modal', function(event) {

                const button = event.relatedTarget;

                const editUrl =
                    button.getAttribute('data-edit-url');

                const name =
                    button.getAttribute('data-category-name');

                const slug =
                    button.getAttribute('data-category-slug');

                const status =
                    button.getAttribute('data-category-status');

                const metaTitle =
                    button.getAttribute('data-category-meta-title');

                const metaDescription =
                    button.getAttribute('data-category-meta-description');

                const metaKeyword =
                    button.getAttribute('data-category-meta-keyword');


                // تحديد URL الخاص بالتحديث
                editForm.setAttribute('action', editUrl);


                // تعبئة البيانات
                nameInput.value = name ?? '';

                slugInput.value = slug ?? '';

                statusInput.value = status ?? '';

                metaTitleInput.value = metaTitle ?? '';

                metaDescriptionInput.value =
                    metaDescription ?? '';

                metaKeywordInput.value =
                    metaKeyword ?? '';

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const deleteModal = document.getElementById('modal-delete-category');

            const deleteForm = document.getElementById('delete-category-form');

            const categoryName = document.getElementById('delete-category-name');


            deleteModal.addEventListener('show.bs.modal', function(event) {

                const button = event.relatedTarget;

                const deleteUrl = button.getAttribute('data-delete-url');

                const name = button.getAttribute('data-category-name');


                // Show category name
                categoryName.textContent = name;


                // Set form action
                deleteForm.setAttribute('action', deleteUrl);

            });

        });
    </script>
@endsection
