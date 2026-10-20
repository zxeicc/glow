@extends('admin.layouts.app')

@section('style')

    <style>

        .edit-user-card {

            max-width: 700px;

            margin: 30px auto;

            border: 1px solid var(--app-border);

            border-radius: 16px;

            overflow: hidden;

            background: rgba(255, 255, 255, .78);

            box-shadow:
                0 12px 35px rgba(15, 23, 42, .07);

            backdrop-filter: blur(16px);

            -webkit-backdrop-filter: blur(16px);

        }


        .edit-user-card .card-header {

            padding: 1.15rem 1.35rem;

            background: transparent;

            border-bottom:
                1px solid var(--app-border);

        }


        .edit-user-card .card-title {

            margin: 0;

            color: var(--app-text);

            font-size: 1rem;

            font-weight: 700;

        }


        .edit-user-card .card-body {

            padding: 1.5rem 1.35rem;

        }


        .edit-user-card .form-label {

            margin-bottom: .5rem;

            color: var(--app-text);

            font-size: .88rem;

            font-weight: 600;

        }


        .edit-user-card .form-control,
        .edit-user-card .form-select {

            min-height: 44px;

            padding: .6rem .8rem;

            border-radius: 10px;

            background: rgba(255, 255, 255, .72);

            border:
                1px solid var(--app-border);

            color: var(--app-text);

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                background .2s ease;

        }


        .edit-user-card .form-control:hover,
        .edit-user-card .form-select:hover {

            border-color:
                rgba(37, 99, 235, .25);

        }


        .edit-user-card .form-control:focus,
        .edit-user-card .form-select:focus {

            background:
                rgba(255, 255, 255, .95);

            border-color:
                var(--app-primary);

            box-shadow:
                0 0 0 3px rgba(37, 99, 235, .10);

        }


        .edit-user-card .card-footer {

            padding: 1rem 1.35rem;

            background: transparent;

            border-top:
                1px solid var(--app-border);

        }


        .edit-user-card .btn {

            min-height: 40px;

            padding:
                .5rem 1rem;

        }


        .edit-user-card .btn-secondary {

            background:
                transparent;

            border-color:
                var(--app-border);

            color:
                var(--app-muted);

        }


        .edit-user-card .btn-secondary:hover {

            background:
                rgba(100, 116, 139, .08);

            border-color:
                #cbd5e1;

            color:
                var(--app-text);

        }


        .edit-user-card .btn-primary {

            box-shadow:
                0 5px 14px rgba(37, 99, 235, .16);

        }


        /* =====================================================
           DARK MODE
        ===================================================== */

        [data-bs-theme="dark"] .edit-user-card {

            background:
                rgba(17, 24, 39, .78);

            box-shadow:
                0 12px 35px rgba(0, 0, 0, .20);

        }


        [data-bs-theme="dark"] .edit-user-card .form-control,
        [data-bs-theme="dark"] .edit-user-card .form-select {

            background:
                rgba(15, 23, 42, .55);

            border-color:
                var(--app-border);

            color:
                var(--app-text);

        }


        [data-bs-theme="dark"] .edit-user-card .form-control:focus,
        [data-bs-theme="dark"] .edit-user-card .form-select:focus {

            background:
                rgba(15, 23, 42, .8);

            border-color:
                #60a5fa;

        }


        [data-bs-theme="dark"] .edit-user-card .btn-secondary:hover {

            background:
                rgba(255, 255, 255, .06);

            border-color:
                #475569;

            color:
                #f8fafc;

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 575.98px) {

            .edit-user-card {

                margin:
                    20px .5rem;

                border-radius:
                    14px;

            }


            .edit-user-card .card-body {

                padding:
                    1.15rem;

            }


            .edit-user-card .card-header,
            .edit-user-card .card-footer {

                padding:
                    1rem 1.15rem;

            }

        }

    </style>

@endsection


@section('content')

    <div class="content-wrapper">

        <main class="app-main">

            <div class="app-content-header">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-sm-6">

                            <h1 class="mb-0 fs-3">
                                Edit User
                            </h1>

                        </div>

                    </div>

                </div>

            </div>


            <div class="app-content">

                <div class="container-fluid">

                    <div class="card edit-user-card">

                        <div class="card-header">

                            <h3 class="card-title">
                                Edit User
                            </h3>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('admin.user.update', $user->id) }}"
                        >

                            @csrf

                            <div class="card-body">

                                {{-- Name --}}

                                <div class="mb-3">

                                    <label
                                        for="name"
                                        class="form-label"
                                    >
                                        Full name
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                    >

                                </div>


                                {{-- Email --}}

                                <div class="mb-3">

                                    <label
                                        for="email"
                                        class="form-label"
                                    >
                                        Email address
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                    >

                                </div>


                                {{-- Role --}}

                                <div class="mb-3">

                                    <label
                                        for="role"
                                        class="form-label"
                                    >
                                        Role
                                    </label>

                                    <select
                                        name="role"
                                        id="role"
                                        class="form-select"
                                    >

                                        <option
                                            value="user"
                                            {{ $user->role === 'user' ? 'selected' : '' }}
                                        >
                                            User
                                        </option>

                                        <option
                                            value="editor"
                                            {{ $user->role === 'editor' ? 'selected' : '' }}
                                        >
                                            Editor
                                        </option>

                                        <option
                                            value="admin"
                                            {{ $user->role === 'admin' ? 'selected' : '' }}
                                        >
                                            Admin
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="card-footer d-flex justify-content-between">

                                <a
                                    href="{{ route('admin.list') }}"
                                    class="btn btn-secondary"
                                >
                                    Cancel
                                </a>


                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Update User
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </main>

    </div>

@endsection