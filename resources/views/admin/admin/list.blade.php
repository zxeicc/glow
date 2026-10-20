@extends('admin.layouts.app')
@section('style')
@endsection
@section('content')
    <div class="content-wrapper">
        <main class="app-main" id="main" tabindex="-1">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    @include('admin.layouts._message')
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="mb-0 fs-3">Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <!--begin::Card-->
                            <div class="card mb-4">
                                <!--begin::Card Header-->
                                <div class="card-header">
                                    <div class="row g-2 align-items-center">
                                        <div class="col-12 col-md-4">
                                            <h3 class="card-title">User Directory</h3>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="d-flex flex-wrap justify-content-md-end gap-2">

                                                <form method="GET" action="{{ route('admin.user.search') }}"
                                                    class="d-flex flex-wrap gap-2">

                                                    {{-- Search --}}
                                                    <div class="input-group input-group-sm w-auto">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-search" aria-hidden="true"></i>
                                                        </span>

                                                        <input type="search" name="search" id="user-search"
                                                            class="form-control" placeholder="Search users"
                                                            value="{{ request('search') }}" aria-label="Search users"
                                                            style="width: 180px">
                                                    </div>

                                                    {{-- Role --}}
                                                    <select name="role" class="form-select form-select-sm w-auto"
                                                        aria-label="Filter by role">
                                                        <option value="all"
                                                            {{ request('role', 'all') === 'all' ? 'selected' : '' }}>
                                                            All roles
                                                        </option>

                                                        <option value="admin"
                                                            {{ request('role') === 'admin' ? 'selected' : '' }}>
                                                            Admin
                                                        </option>

                                                        <option value="editor"
                                                            {{ request('role') === 'editor' ? 'selected' : '' }}>
                                                            Editor
                                                        </option>

                                                        <option value="user"
                                                            {{ request('role') === 'user' ? 'selected' : '' }}>
                                                            User
                                                        </option>
                                                    </select>

                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-search me-1"></i>
                                                        Search
                                                    </button>

                                                </form>

                                                {{-- Add User --}}
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modal-add-user">
                                                    <i class="bi bi-person-plus-fill me-1" aria-hidden="true"></i>
                                                    New user
                                                </button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card Header-->
                                <!--begin::Card Body-->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle m-0" role="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Role</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Created</th>
                                                    <th class="text-end" scope="col">Actions</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <img src="./assets/img/user1-128x128.jpg" alt=""
                                                                    class="img-size-32 rounded-circle me-2">
                                                                <span class="fw-medium">{{ $user->name }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            <span class="badge text-bg-danger"> {{ $user->role }} </span>
                                                        </td>
                                                        <td>
                                                            <span class="badge text-bg-success">{{ $user->status }}</span>
                                                        </td>
                                                        <td>{{ $user->created_at }}</td>
                                                        <td class="text-end">
                                                            <div class="d-flex align-items-center gap-2">


                                                                <button type="button" class="btn btn-outline-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-delete-user"
                                                                    data-user-id="{{ $user->id }}"
                                                                    aria-label="Delete {{ $user->name }}">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                                <form action="{{ route('admin.user.edit', $user->id) }}"
                                                                    method="GET"><button type="submit"
                                                                        class="btn btn-outline-secondary"
                                                                        aria-label="Edit Alexander Pierce">
                                                                        <i class="bi bi-pencil" aria-hidden="true"> </i>
                                                                    </button></form>
                                                            </div>
                                                        </td>







                                    </div>

                                    </tr>
                                    @endforeach
                                    </tbody>

                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!--end::Card Body-->
                            <!--begin::Card Footer-->
                            <div class="card-footer clearfix">
                                {{ $users->links() }}
                            </div>
                            {{-- <div class="card-footer clearfix">
                    <div class="float-start pt-1 fs-7 text-body-secondary">
                      {{ $users->links() }}
                    </div>
                    <ul class="pagination pagination-sm m-0 float-end">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous"> « </a>
                      </li>
                      <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">2</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">3</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">4</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#">5</a>
                      </li>
                      <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next"> » </a>
                      </li>
                    </ul>
                  </div> --}}
                            <!--end::Card Footer-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!-- /.col -->
                </div>
                <!--end::Row-->

                <!--begin::Add User Modal-->
                <div class="modal fade" id="modal-add-user" tabindex="-1" aria-labelledby="modal-add-user-label"
                    aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('admin.adduser') }}">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-add-user-label">Add new user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="new-user-name" class="form-label"> Full name <span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <input type="text" name="name" class="form-control" method="POST"
                                            id="new-user-name" placeholder="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new-user-email" class="form-label"> Email address <span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <input type="email" name="email" class="form-control" id="new-user-email"
                                            placeholder="name@example.com" required>
                                        <div class="form-text">The invitation will be sent to this address.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="new-user-role" class="form-label"> Role </label>
                                        <select id="new-user-role" name="role" class="form-select">
                                            <option value="user">User</option>
                                            <option value="editor">Editor</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="new-user-welcome"
                                            checked="">
                                        <label class="form-check-label" for="new-user-welcome">
                                            Send a welcome email with login details
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Send invitation</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Add User Modal-->

                <!--begin::Delete User Modal-->

                <!-- Delete User Modal -->
                <div class="modal fade" id="modal-delete-user" tabindex="-1" aria-labelledby="modal-delete-user-label"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="modal-delete-user-label">
                                    Delete user
                                </h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>

                            <div class="modal-body">
                                Are you sure you want to delete this user?
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                                <form id="delete-user-form" method="POST">
                                    @csrf

                                    <button type="submit" class="btn btn-danger">
                                        Delete user
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Delete User Modal-->
            </div>
            <!--end::Container-->
    </div>
    <!--end::App Content-->
    </main>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modal-delete-user');
            const form = document.getElementById('delete-user-form');
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const userId = button.getAttribute('data-user-id');
                form.action = "{{ url('/admin/list/delete') }}/" + userId;
            });
        });
    </script>
@endsection
