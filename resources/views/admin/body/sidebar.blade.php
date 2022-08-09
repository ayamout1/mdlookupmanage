
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">

            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->email }}</h4>
                <a class="dropdown-item text-danger" href="{{route('admin.logout')}}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>





            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{route('mainfilter.list')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Vendor Lookup</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-layout-3-line"></i>
                        <span>Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="/vendors" class="">Vendor Management</a>

                        </li>
                        <li>
                            <a href="/engines" class="">Engine Management</a>

                        </li>
                        <li>
                            <a href="/products" class="">Products Management</a>

                        </li>
                        <li>
                            <a href="/brands" class="">Brands Management</a>

                        </li>
                        <li>
                            <a href="/services" class="">Services Management</a>

                        </li>
                        <li>
                            <a href="/contacts" class="">Contact Management</a>

                        </li>

                    </ul>
                </li>


            </ul></div>
        <!-- Sidebar -->
    </div>
</div>
