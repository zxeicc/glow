<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow modern-sidebar" data-bs-theme="dark">

    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">

        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">

            <!--begin::Brand Image-->
            <img src="{{ url('assets/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->

            <!--begin::Brand Text-->
            <span class="brand-text fw-light">
                Ecommerce
            </span>
            <!--end::Brand Text-->

        </a>
        <!--end::Brand Link-->

    </div>
    <!--end::Sidebar Brand-->


    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">

        <nav class="mt-2" aria-label="Main navigation">

            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <!-- User -->
                <li class="nav-item">
                    <a href="{{ url('admin/list') }}" class="nav-link @if (Request::segment(2) == 'list') active @endif">
                        <i class="nav-icon bi bi-person"></i>
                        <p>User</p>
                    </a>
                </li>


                <!-- Product -->
                <li class="nav-item">
                    <a href="{{ url('admin/product') }}"
                        class="nav-link @if (Request::segment(2) == 'product') active @endif">
                        <i class="nav-icon bi bi-box-seam"></i>
                        <p>Product</p>
                    </a>
                </li>


                <!-- Category -->
                <li class="nav-item">
                    <a href="{{ url('admin/category') }}"
                        class="nav-link @if (Request::segment(2) == 'category') active @endif">
                        <i class="nav-icon bi bi-tags"></i>
                        <p>Category</p>
                    </a>
                </li>

                <!-- SubCategory -->
                <li class="nav-item">
                    <a href="{{ url('admin/subcategory') }}"
                        class="nav-link @if (Request::segment(2) == 'subcategory') active @endif">
                        <i class="nav-icon bi bi-tag"></i>
                        <p>SubCategory</p>
                    </a>
                </li>
                {{-- brand --}}
                <li class="nav-item">
                    <a href="{{ url('admin/brand') }}" class="nav-link @if (Request::segment(2) == 'brand') active @endif">
                        <i class="nav-icon bi bi-bookmark"></i>
                        <p>Brand</p>
                    </a>
                </li>
                {{-- color & size --}}
                <li class="nav-item">
                    <a href="{{ route('admin.color-size') }}" class="nav-link">

                        <i class="nav-icon bi bi-palette"></i>

                        <p>
                            Colors & Sizes
                        </p>

                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->

        </nav>

    </div>
    <!--end::Sidebar Wrapper-->

</aside>
<!--end::Sidebar-->
