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
                                Brands
                            </h1>

                        </div>

                        <div class="col-sm-6">

                            <nav aria-label="breadcrumb">

                                <ol class="breadcrumb float-sm-end">

                                    <li class="breadcrumb-item">
                                        <a href="#">
                                            Home
                                        </a>
                                    </li>

                                    <li class="breadcrumb-item active"
                                        aria-current="page">
                                        Brands
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
                                                List Brands
                                            </h3>

                                        </div>


                                        <div class="col-12 col-md-8">

                                            <div class="d-flex flex-wrap justify-content-md-end gap-2">


                                                {{-- Search / Filter --}}
                                                <form method="GET"
                                                      action="{{ route('admin.brand') }}"
                                                      class="d-flex flex-wrap gap-2">


                                                    {{-- Search --}}
                                                    <div class="input-group input-group-sm w-auto">

                                                        <span class="input-group-text">

                                                            <i class="bi bi-search"
                                                               aria-hidden="true">
                                                            </i>

                                                        </span>

                                                        <input type="search"
                                                               name="search"
                                                               id="brand-search"
                                                               class="form-control"
                                                               placeholder="Search brands"
                                                               value="{{ request('search') }}"
                                                               aria-label="Search brands"
                                                               style="width: 180px">

                                                    </div>


                                                    {{-- Status Filter --}}
                                                    <select name="status"
                                                            class="form-select form-select-sm w-auto"
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
                                                    <button type="submit"
                                                            class="btn btn-sm btn-primary">

                                                        <i class="bi bi-search me-1"></i>

                                                        Search

                                                    </button>

                                                </form>


                                                {{-- Add Brand Button --}}
                                                <button type="button"
                                                        class="btn btn-sm btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal-add-brand">

                                                    <i class="bi bi-plus-lg me-1"></i>

                                                    New Brand

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
                                                        Logo
                                                    </th>

                                                    <th scope="col">
                                                        Name
                                                    </th>

                                                    <th scope="col">
                                                        Slug
                                                    </th>

                                                    <th scope="col">
                                                        Description
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

                                                    <th scope="col"
                                                        class="text-end">
                                                        Actions
                                                    </th>

                                                </tr>

                                            </thead>


                                            <tbody>

                                                @forelse ($brands as $brand)

                                                    <tr>


                                                        {{-- Logo --}}
                                                        <td>

                                                            @if ($brand->logo)

                                                                <img
                                                                    src="{{ asset('storage/' . $brand->logo) }}"
                                                                    alt="{{ $brand->name }}"
                                                                    width="50"
                                                                    height="50"
                                                                    class="rounded object-fit-cover">

                                                            @else

                                                                <div
                                                                    class="bg-light rounded d-flex align-items-center justify-content-center"
                                                                    style="width: 50px; height: 50px;">

                                                                    <i class="bi bi-image text-muted fs-4"></i>

                                                                </div>

                                                            @endif

                                                        </td>


                                                        {{-- Name --}}
                                                        <td>

                                                            <span class="fw-medium">

                                                                {{ $brand->name }}

                                                            </span>

                                                        </td>


                                                        {{-- Slug --}}
                                                        <td>

                                                            {{ $brand->slug }}

                                                        </td>


                                                        {{-- Description --}}
                                                        <td>

                                                            @if ($brand->description)

                                                                <span title="{{ $brand->description }}">

                                                                    {{ \Illuminate\Support\Str::limit($brand->description, 50) }}

                                                                </span>

                                                            @else

                                                                -

                                                            @endif

                                                        </td>


                                                        {{-- Created By --}}
                                                        <td>

                                                            {{ $brand->creator?->name ?? 'Unknown' }}

                                                        </td>


                                                        {{-- Status --}}
                                                        <td>

                                                            @if ($brand->status)

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

                                                            {{ $brand->created_at?->format('Y-m-d') }}

                                                        </td>


                                                        {{-- Actions --}}
                                                        <td class="text-end">

                                                            <div class="d-flex justify-content-end align-items-center gap-2">


                                                                {{-- Edit Button --}}
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-sm btn-outline-secondary"

                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-edit-brand"

                                                                    data-edit-url="{{ route('admin.brand.update', $brand->id) }}"

                                                                    data-brand-name="{{ $brand->name }}"

                                                                    data-brand-slug="{{ $brand->slug }}"

                                                                    data-brand-description="{{ $brand->description }}"

                                                                    data-brand-status="{{ $brand->status }}"

                                                                    data-brand-logo="{{ $brand->logo }}">

                                                                    <i class="bi bi-pencil"></i>

                                                                </button>


                                                                {{-- Delete Button --}}
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-sm btn-outline-danger"

                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-brand"

                                                                    data-delete-url="{{ route('admin.brand.delete', $brand->id) }}"

                                                                    data-brand-name="{{ $brand->name }}">

                                                                    <i class="bi bi-trash"></i>

                                                                </button>


                                                            </div>

                                                        </td>

                                                    </tr>

                                                @empty

                                                    <tr>

                                                        <td colspan="8"
                                                            class="text-center py-4">

                                                            <div class="text-muted">

                                                                No brands found.

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

                                    {{ $brands->appends(request()->query())->links() }}

                                </div>

                            </div>

                        </div>

                    </div>



                    {{-- =====================================================
                        ADD BRAND MODAL
                    ====================================================== --}}
                    <div class="modal fade"
                         id="modal-add-brand"
                         tabindex="-1"
                         aria-labelledby="modal-add-brand-label"
                         aria-hidden="true">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">


                                <form method="POST"
                                      action="{{ route('admin.addbrand') }}"
                                      enctype="multipart/form-data">

                                    @csrf


                                    {{-- Header --}}
                                    <div class="modal-header">

                                        <h5 class="modal-title"
                                            id="modal-add-brand-label">

                                            Add New Brand

                                        </h5>

                                        <button type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close">
                                        </button>

                                    </div>


                                    {{-- Body --}}
                                    <div class="modal-body">

                                        <div class="row">


                                            {{-- Name --}}
                                            <div class="col-md-6 mb-3">

                                                <label for="brand-name"
                                                       class="form-label">

                                                    Brand Name

                                                </label>

                                                <input
                                                    type="text"
                                                    name="name"
                                                    id="brand-name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}"
                                                    placeholder="Brand name"
                                                    required>

                                                @error('name')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                @enderror

                                            </div>


                                            {{-- Slug --}}
                                            <div class="col-md-6 mb-3">

                                                <label for="brand-slug"
                                                       class="form-label">

                                                    Slug

                                                </label>

                                                <input
                                                    type="text"
                                                    name="slug"
                                                    id="brand-slug"
                                                    class="form-control @error('slug') is-invalid @enderror"
                                                    value="{{ old('slug') }}"
                                                    placeholder="brand-slug"
                                                    required>

                                                @error('slug')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                @enderror

                                            </div>


                                            {{-- Logo --}}
                                            <div class="col-md-6 mb-3">

                                                <label for="brand-logo"
                                                       class="form-label">

                                                    Logo

                                                </label>

                                                <input
                                                    type="file"
                                                    name="logo"
                                                    id="brand-logo"
                                                    class="form-control @error('logo') is-invalid @enderror"
                                                    accept="image/*">

                                                @error('logo')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                @enderror

                                            </div>


                                            {{-- Status --}}
                                            <div class="col-md-6 mb-3">

                                                <label for="brand-status"
                                                       class="form-label">

                                                    Status

                                                </label>

                                                <select
                                                    name="status"
                                                    id="brand-status"
                                                    class="form-select @error('status') is-invalid @enderror">

                                                    <option value="1"
                                                        {{ old('status', 1) == 1 ? 'selected' : '' }}>

                                                        Active

                                                    </option>

                                                    <option value="0"
                                                        {{ old('status') === '0' ? 'selected' : '' }}>

                                                        Inactive

                                                    </option>

                                                </select>

                                                @error('status')

                                                    <div class="invalid-feedback">

                                                        {{ $message }}

                                                    </div>

                                                @enderror

                                            </div>


                                            {{-- Description --}}
                                            <div class="col-md-12 mb-3">

                                                <label for="brand-description"
                                                       class="form-label">

                                                    Description

                                                </label>

                                                <textarea
                                                    name="description"
                                                    id="brand-description"
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    rows="4"
                                                    placeholder="Brand description">{{ old('description') }}</textarea>

                                                @error('description')

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
                                            data-bs-dismiss="modal">

                                            Cancel

                                        </button>

                                        <button
                                            type="submit"
                                            class="btn btn-primary">

                                            Add Brand

                                        </button>

                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>



                    {{-- =====================================================
                        EDIT BRAND MODAL
                    ====================================================== --}}
                    <div class="modal fade"
                         id="modal-edit-brand"
                         tabindex="-1"
                         aria-labelledby="modal-edit-brand-label"
                         aria-hidden="true">

                        <div class="modal-dialog modal-lg">

                            <div class="modal-content">


                                <div class="modal-header">

                                    <h5 class="modal-title"
                                        id="modal-edit-brand-label">

                                        Edit Brand

                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>

                                </div>


                                {{-- IMPORTANT:
                                     POST only
                                     No @method('PUT')
                                --}}
                                <form
                                    id="edit-brand-form"
                                    method="POST"
                                    action=""
                                    enctype="multipart/form-data">

                                    @csrf


                                    <div class="modal-body">

                                        <div class="row">


                                            {{-- Name --}}
                                            <div class="col-md-6 mb-3">

                                                <label
                                                    for="edit-brand-name"
                                                    class="form-label">

                                                    Name

                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="edit-brand-name"
                                                    name="name"
                                                    required>

                                            </div>


                                            {{-- Slug --}}
                                            <div class="col-md-6 mb-3">

                                                <label
                                                    for="edit-brand-slug"
                                                    class="form-label">

                                                    Slug

                                                </label>

                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    id="edit-brand-slug"
                                                    name="slug"
                                                    required>

                                            </div>


                                            {{-- Logo --}}
                                            <div class="col-md-6 mb-3">

                                                <label
                                                    for="edit-brand-logo"
                                                    class="form-label">

                                                    Logo

                                                </label>

                                                <input
                                                    type="file"
                                                    class="form-control"
                                                    id="edit-brand-logo"
                                                    name="logo"
                                                    accept="image/*">


                                                <div class="mt-2">

                                                    <img
                                                        id="edit-brand-logo-preview"
                                                        src=""
                                                        alt="Brand Logo"
                                                        width="60"
                                                        height="60"
                                                        class="rounded object-fit-cover d-none">

                                                </div>

                                            </div>


                                            {{-- Status --}}
                                            <div class="col-md-6 mb-3">

                                                <label
                                                    for="edit-brand-status"
                                                    class="form-label">

                                                    Status

                                                </label>

                                                <select
                                                    name="status"
                                                    id="edit-brand-status"
                                                    class="form-select">

                                                    <option value="1">
                                                        Active
                                                    </option>

                                                    <option value="0">
                                                        Inactive
                                                    </option>

                                                </select>

                                            </div>


                                            {{-- Description --}}
                                            <div class="col-md-12 mb-3">

                                                <label
                                                    for="edit-brand-description"
                                                    class="form-label">

                                                    Description

                                                </label>

                                                <textarea
                                                    class="form-control"
                                                    id="edit-brand-description"
                                                    name="description"
                                                    rows="4"></textarea>

                                            </div>


                                        </div>

                                    </div>


                                    <div class="modal-footer">

                                        <button
                                            type="button"
                                            class="btn btn-secondary"
                                            data-bs-dismiss="modal">

                                            Cancel

                                        </button>

                                        <button
                                            type="submit"
                                            class="btn btn-primary">

                                            Update Brand

                                        </button>

                                    </div>


                                </form>

                            </div>

                        </div>

                    </div>



                    {{-- =====================================================
                        DELETE BRAND MODAL
                    ====================================================== --}}
                    <div class="modal fade"
                         id="modal-delete-brand"
                         tabindex="-1"
                         aria-labelledby="modal-delete-brand-label"
                         aria-hidden="true">

                        <div class="modal-dialog">

                            <div class="modal-content">


                                {{-- Header --}}
                                <div class="modal-header">

                                    <h5 class="modal-title"
                                        id="modal-delete-brand-label">

                                        Delete Brand

                                    </h5>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>

                                </div>


                                {{-- Body --}}
                                <div class="modal-body">

                                    Are you sure you want to delete

                                    <strong id="delete-brand-name"></strong>?

                                </div>


                                {{-- Footer --}}
                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal">

                                        Cancel

                                    </button>


                                    {{-- IMPORTANT:
                                         POST only
                                         No @method('DELETE')
                                    --}}
                                    <form
                                        id="delete-brand-form"
                                        method="POST"
                                        action="">

                                        @csrf

                                        <button
                                            type="submit"
                                            class="btn btn-danger">

                                            Delete Brand

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

    {{-- =====================================================
        EDIT BRAND JAVASCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const editModal =
                document.getElementById('modal-edit-brand');

            const editForm =
                document.getElementById('edit-brand-form');

            const nameInput =
                document.getElementById('edit-brand-name');

            const slugInput =
                document.getElementById('edit-brand-slug');

            const descriptionInput =
                document.getElementById('edit-brand-description');

            const statusInput =
                document.getElementById('edit-brand-status');

            const logoInput =
                document.getElementById('edit-brand-logo');

            const logoPreview =
                document.getElementById('edit-brand-logo-preview');


            if (!editModal || !editForm) {
                return;
            }


            editModal.addEventListener(
                'show.bs.modal',
                function (event) {

                    const button =
                        event.relatedTarget;


                    if (!button) {
                        return;
                    }


                    const editUrl =
                        button.getAttribute('data-edit-url');

                    const name =
                        button.getAttribute('data-brand-name');

                    const slug =
                        button.getAttribute('data-brand-slug');

                    const description =
                        button.getAttribute('data-brand-description');

                    const status =
                        button.getAttribute('data-brand-status');

                    const logo =
                        button.getAttribute('data-brand-logo');


                    // Set POST URL
                    editForm.setAttribute(
                        'action',
                        editUrl
                    );


                    // Fill inputs
                    nameInput.value =
                        name ?? '';

                    slugInput.value =
                        slug ?? '';

                    descriptionInput.value =
                        description ?? '';

                    statusInput.value =
                        status ?? '1';


                    // Logo preview
                    if (logo) {

                        logoPreview.src =
                            "{{ asset('storage') }}/" + logo;

                        logoPreview.classList.remove(
                            'd-none'
                        );

                    } else {

                        logoPreview.src = '';

                        logoPreview.classList.add(
                            'd-none'
                        );

                    }


                    // Reset file input
                    logoInput.value = '';

                }
            );

        });

    </script>



    {{-- =====================================================
        DELETE BRAND JAVASCRIPT
    ====================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const deleteModal =
                document.getElementById('modal-delete-brand');

            const deleteForm =
                document.getElementById('delete-brand-form');

            const brandName =
                document.getElementById('delete-brand-name');


            if (!deleteModal || !deleteForm) {
                return;
            }


            deleteModal.addEventListener(
                'show.bs.modal',
                function (event) {

                    const button =
                        event.relatedTarget;


                    if (!button) {
                        return;
                    }


                    const deleteUrl =
                        button.getAttribute('data-delete-url');

                    const name =
                        button.getAttribute('data-brand-name');


                    // Show brand name
                    brandName.textContent =
                        name ?? '';


                    // Set POST URL
                    deleteForm.setAttribute(
                        'action',
                        deleteUrl
                    );

                }
            );

        });

    </script>

@endsection
