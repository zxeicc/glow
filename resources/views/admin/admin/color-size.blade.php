@extends('admin.layouts.app')

@section('content')


<div class="content-wrapper">

    <main class="app-main" id="main" tabindex="-1">

        {{-- =========================
            Page Header
        ========================== --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="mb-0 fs-3">
                            Colors & Sizes
                        </h1>

                        <p class="text-muted mb-0">
                            Manage product colors and sizes
                        </p>
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
                                    Colors & Sizes
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

                {{-- =========================
                    Success Message
                ========================== --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle me-2"></i>

                        {{ session('success') }}

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>
                    </div>
                @endif


                {{-- =========================
                    Validation Errors
                ========================== --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">

                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>

                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="alert">
                        </button>

                    </div>
                @endif


                {{-- =========================
                    Colors & Sizes
                ========================== --}}
                <div class="row g-4">

                    {{-- =========================================================
                        COLORS
                    ========================================================== --}}
                    <div class="col-lg-6">

                        <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden ">

                            {{-- Card Header --}}
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">

                                <div>
                                    <h5 class="mb-0">
                                        <i class="bi bi-palette me-2"></i>
                                        Colors
                                    </h5>

                                    <small class="text-muted">
                                        Manage product colors
                                    </small>
                                </div>

                                <button type="button"
                                    class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addColorModal"style="margin-inline-start: auto;">

                                    <i class="bi bi-plus-lg me-1"></i>
                                    Add Color

                                </button>

                            </div>


                            {{-- Colors Table --}}
                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table class="table table-hover align-middle mb-0">

                                        <thead>
                                            <tr>

                                                <th class="ps-3">
                                                    #
                                                </th>

                                                <th>
                                                    Color
                                                </th>

                                                <th>
                                                    Code
                                                </th>

                                                <th>
                                                    Status
                                                </th>

                                                <th class="text-end pe-3">
                                                    Actions
                                                </th>

                                            </tr>
                                        </thead>


                                        <tbody>

                                            @forelse($colors as $color)

                                                <tr>

                                                    <td class="ps-3">
                                                        {{ $color->id }}
                                                    </td>


                                                    {{-- Color --}}
                                                    <td>

                                                        <div class="d-flex align-items-center gap-2">

                                                            <span
                                                                class="rounded-circle border d-inline-block"
                                                                style="
                                                                    width: 28px;
                                                                    height: 28px;
                                                                    background-color: {{ $color->code }};
                                                                ">
                                                            </span>

                                                            <span>
                                                                {{ $color->name }}
                                                            </span>

                                                        </div>

                                                    </td>


                                                    {{-- Code --}}
                                                    <td>

                                                        <code>
                                                            {{ $color->code }}
                                                        </code>

                                                    </td>


                                                    {{-- Status --}}
                                                    <td>

                                                        @if ($color->status)

                                                            <span class="badge bg-success">
                                                                Active
                                                            </span>

                                                        @else

                                                            <span class="badge bg-secondary">
                                                                Inactive
                                                            </span>

                                                        @endif

                                                    </td>


                                                    {{-- Actions --}}
                                                    <td class="text-end pe-3">

                                                        {{-- Edit --}}
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editColorModal{{ $color->id }}"
                                                            title="Edit Color">

                                                            <i class="bi bi-pencil"></i>

                                                        </button>


                                                        {{-- Delete --}}
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteColorModal{{ $color->id }}"
                                                            title="Delete Color">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="5"
                                                        class="text-center text-muted py-4">

                                                        <i class="bi bi-palette fs-3 d-block mb-2"></i>

                                                        No colors found.

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- =========================================================
                        SIZES
                    ========================================================== --}}
                    <div class="col-lg-6">

                        <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">

                            {{-- Card Header --}}
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">

                                <div>

                                    <h5 class="mb-0">
                                        <i class="bi bi-rulers me-2"></i>
                                        Sizes
                                    </h5>

                                    <small class="text-muted">
                                        Manage product sizes
                                    </small>

                                </div>


                                <button type="button"
                                    class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#addSizeModal" style="margin-inline-start: auto;">

                                    <i class="bi bi-plus-lg me-1"></i>
                                    Add Size

                                </button>

                            </div>


                            {{-- Sizes Table --}}
                            <div class="card-body p-0">

                                <div class="table-responsive">

                                    <table class="table table-hover align-middle mb-0">

                                        <thead>

                                            <tr>

                                                <th class="ps-3">
                                                    #
                                                </th>

                                                <th>
                                                    Size
                                                </th>

                                                <th>
                                                    Status
                                                </th>

                                                <th class="text-end pe-3">
                                                    Actions
                                                </th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                            @forelse($sizes as $size)

                                                <tr>

                                                    <td class="ps-3">
                                                        {{ $size->id }}
                                                    </td>


                                                    {{-- Size --}}
                                                    <td>

                                                        <span class="badge bg-light text-dark border px-3 py-2">
                                                            {{ $size->name }}
                                                        </span>

                                                    </td>


                                                    {{-- Status --}}
                                                    <td>

                                                        @if ($size->status)

                                                            <span class="badge bg-success">
                                                                Active
                                                            </span>

                                                        @else

                                                            <span class="badge bg-secondary">
                                                                Inactive
                                                            </span>

                                                        @endif

                                                    </td>


                                                    {{-- Actions --}}
                                                    <td class="text-end pe-3">

                                                        {{-- Edit --}}
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editSizeModal{{ $size->id }}"
                                                            title="Edit Size">

                                                            <i class="bi bi-pencil"></i>

                                                        </button>


                                                        {{-- Delete --}}
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteSizeModal{{ $size->id }}"
                                                            title="Delete Size">

                                                            <i class="bi bi-trash"></i>

                                                        </button>

                                                    </td>

                                                </tr>

                                            @empty

                                                <tr>

                                                    <td colspan="4"
                                                        class="text-center text-muted py-4">

                                                        <i class="bi bi-rulers fs-3 d-block mb-2"></i>

                                                        No sizes found.

                                                    </td>

                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            EDIT COLOR MODALS
        ========================================================== --}}

        @foreach ($colors as $color)

            <div class="modal fade"
                id="editColorModal{{ $color->id }}"
                tabindex="-1"
                aria-labelledby="editColorLabel{{ $color->id }}"
                aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form action="{{ route('admin.color.update', $color->id) }}"
                            method="POST">

                            @csrf

                            <div class="modal-header">

                                <h5 class="modal-title"
                                    id="editColorLabel{{ $color->id }}">

                                    <i class="bi bi-palette me-2"></i>

                                    Edit Color

                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>


                            <div class="modal-body">

                                {{-- Name --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        Color Name
                                    </label>

                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ $color->name }}"
                                        required>

                                </div>


                                {{-- Code --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        Color Code
                                    </label>

                                    <div class="input-group">

                                        <input type="color"
                                            class="form-control form-control-color"
                                            value="{{ $color->code }}"
                                            oninput="this.nextElementSibling.value=this.value">

                                        <input type="text"
                                            name="code"
                                            class="form-control"
                                            value="{{ $color->code }}"
                                            required>

                                    </div>

                                </div>


                                {{-- Status --}}
                                <div class="form-check form-switch">

                                    <input type="checkbox"
                                        name="status"
                                        value="1"
                                        class="form-check-input"
                                        {{ $color->status ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Active
                                    </label>

                                </div>

                            </div>


                            <div class="modal-footer">

                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button type="submit"
                                    class="btn btn-primary">

                                    <i class="bi bi-check-lg me-1"></i>

                                    Save Changes

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach


        {{-- =========================================================
            DELETE COLOR MODALS
        ========================================================== --}}

        @foreach ($colors as $color)

            <div class="modal fade"
                id="deleteColorModal{{ $color->id }}"
                tabindex="-1"
                aria-labelledby="deleteColorLabel{{ $color->id }}"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="deleteColorLabel{{ $color->id }}">

                                <i class="bi bi-trash me-2"></i>

                                Delete Color

                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                            </button>

                        </div>


                        <div class="modal-body text-center">

                            {{-- Color Preview --}}
                            <div class="mb-3">

                                <span class="rounded-circle border d-inline-block"
                                    style="
                                        width: 60px;
                                        height: 60px;
                                        background-color: {{ $color->code }};
                                    ">
                                </span>

                            </div>


                            {{-- Color Name --}}
                            <h5 class="mb-2">
                                {{ $color->name }}
                            </h5>


                            {{-- Confirmation --}}
                            <p class="text-muted mb-1">
                                Are you sure you want to delete this color?
                            </p>

                            <small class="text-muted">
                                This color will no longer be available for new variants.
                            </small>

                        </div>


                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>


                            <form action="{{ route('admin.color.delete', $color->id) }}"
                                method="POST">

                                @csrf

                                <button type="submit"
                                    class="btn btn-danger">

                                    <i class="bi bi-trash me-1"></i>

                                    Delete Color

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach


        {{-- =========================================================
            EDIT SIZE MODALS
        ========================================================== --}}

        @foreach ($sizes as $size)

            <div class="modal fade"
                id="editSizeModal{{ $size->id }}"
                tabindex="-1"
                aria-labelledby="editSizeLabel{{ $size->id }}"
                aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <form action="{{ route('admin.size.update', $size->id) }}"
                            method="POST">

                            @csrf

                            <div class="modal-header">

                                <h5 class="modal-title"
                                    id="editSizeLabel{{ $size->id }}">

                                    <i class="bi bi-rulers me-2"></i>

                                    Edit Size

                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>

                            </div>


                            <div class="modal-body">

                                {{-- Size Name --}}
                                <div class="mb-3">

                                    <label class="form-label">
                                        Size Name
                                    </label>

                                    <input type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ $size->name }}"
                                        required>

                                </div>


                                {{-- Status --}}
                                <div class="form-check form-switch">

                                    <input type="checkbox"
                                        name="status"
                                        value="1"
                                        class="form-check-input"
                                        {{ $size->status ? 'checked' : '' }}>

                                    <label class="form-check-label">
                                        Active
                                    </label>

                                </div>

                            </div>


                            <div class="modal-footer">

                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">

                                    Cancel

                                </button>

                                <button type="submit"
                                    class="btn btn-primary">

                                    <i class="bi bi-check-lg me-1"></i>

                                    Save Changes

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach


        {{-- =========================================================
            DELETE SIZE MODALS
        ========================================================== --}}

        @foreach ($sizes as $size)

            <div class="modal fade"
                id="deleteSizeModal{{ $size->id }}"
                tabindex="-1"
                aria-labelledby="deleteSizeLabel{{ $size->id }}"
                aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="deleteSizeLabel{{ $size->id }}">

                                <i class="bi bi-trash me-2"></i>

                                Delete Size

                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                            </button>

                        </div>


                        <div class="modal-body text-center">

                            {{-- Icon --}}
                            <div class="mb-3">

                                <div class="d-inline-flex align-items-center justify-content-center border rounded-circle"
                                    style="
                                        width: 60px;
                                        height: 60px;
                                    ">

                                    <i class="bi bi-rulers fs-4"></i>

                                </div>

                            </div>


                            {{-- Size Name --}}
                            <h5 class="mb-2">
                                {{ $size->name }}
                            </h5>


                            {{-- Confirmation --}}
                            <p class="text-muted mb-1">
                                Are you sure you want to delete this size?
                            </p>

                            <small class="text-muted">
                                This size will no longer be available for new variants.
                            </small>

                        </div>


                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>


                            <form action="{{ route('admin.size.delete', $size->id) }}"
                                method="POST">

                                @csrf

                                <button type="submit"
                                    class="btn btn-danger">

                                    <i class="bi bi-trash me-1"></i>

                                    Delete Size

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        @endforeach


        {{-- =========================================================
            ADD COLOR MODAL
        ========================================================== --}}

        <div class="modal fade"
            id="addColorModal"
            tabindex="-1"
            aria-labelledby="addColorLabel"
            aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="{{ route('admin.color.store') }}"
                        method="POST">

                        @csrf

                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="addColorLabel">

                                <i class="bi bi-palette me-2"></i>

                                Add Color

                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                            </button>

                        </div>


                        <div class="modal-body">

                            {{-- Color Name --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Color Name
                                </label>

                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Example: Black"
                                    required>

                            </div>


                            {{-- Color Code --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Color Code
                                </label>

                                <div class="input-group">

                                    <input type="color"
                                        class="form-control form-control-color"
                                        value="#000000"
                                        oninput="this.nextElementSibling.value=this.value">

                                    <input type="text"
                                        name="code"
                                        class="form-control"
                                        value="#000000"
                                        placeholder="#000000"
                                        required>

                                </div>

                            </div>


                            {{-- Status --}}
                            <div class="form-check form-switch">

                                <input type="checkbox"
                                    name="status"
                                    value="1"
                                    class="form-check-input"
                                    checked>

                                <label class="form-check-label">
                                    Active
                                </label>

                            </div>

                        </div>


                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>

                            <button type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-plus-lg me-1"></i>

                                Add Color

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =========================================================
            ADD SIZE MODAL
        ========================================================== --}}

        <div class="modal fade"
            id="addSizeModal"
            tabindex="-1"
            aria-labelledby="addSizeLabel"
            aria-hidden="true">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form action="{{ route('admin.size.store') }}"
                        method="POST">

                        @csrf

                        <div class="modal-header">

                            <h5 class="modal-title"
                                id="addSizeLabel">

                                <i class="bi bi-rulers me-2"></i>

                                Add Size

                            </h5>

                            <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                            </button>

                        </div>


                        <div class="modal-body">

                            {{-- Size Name --}}
                            <div class="mb-3">

                                <label class="form-label">
                                    Size Name
                                </label>

                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="Example: M"
                                    required>

                            </div>


                            {{-- Status --}}
                            <div class="form-check form-switch">

                                <input type="checkbox"
                                    name="status"
                                    value="1"
                                    class="form-check-input"
                                    checked>

                                <label class="form-check-label">
                                    Active
                                </label>

                            </div>

                        </div>


                        <div class="modal-footer">

                            <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">

                                Cancel

                            </button>

                            <button type="submit"
                                class="btn btn-primary">

                                <i class="bi bi-plus-lg me-1"></i>

                                Add Size

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </main>

</div>


@endsection
