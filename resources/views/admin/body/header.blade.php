
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('admin.mainfilter.index')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend/assets') }}/images/logo.png" alt="logo-sm" >
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('backend/assets') }}/images/logo.png" alt="logo-dark" >
                                </span>
                </a>

                <a href="{{route('admin.mainfilter.index')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('backend/assets') }}/images/logo.png" alt="logo-sm-light">
                                </span>
                    <span class="logo-lg">
                                    <img src="{{ asset('backend/assets') }}/images/logo.png" alt="logo-light">
                                </span>
                </a>
            </div>



            <!-- App Search-->



        </div>

        <div class="d-flex">


            <div class="mt-3">
                <h4 class="font-size-16 mb-2"style="color:white;">{{ Auth::user()->email }}</h4>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <h3>                      <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">


                       {{ trans('global.logout') }}

                    </a></h3>





            </div>




            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>



    </div>
</header>
