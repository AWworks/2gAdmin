<header class="main-header">
    <a href="#" class="logo">
        <!-- Logo -->
        <span class="logo-mini">
               <img src="{{asset('assets/dist/img/mini-logo.png')}}" alt="">
               </span>
        <span class="logo-lg">
               <img src="{{asset('assets/logo1.png')}}" alt="" style="margin-top:13px;height:31px;">
               </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <a href="{{--{{ URL::asset('#') }}--}}#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <!-- Sidebar toggle button-->
            <span class="sr-only">Toggle navigation</span>
            <span class="pe-7s-angle-left-circle"></span>
        </a>

        <ul class="nav navbar-nav">
            <li class="dropdown dropdown-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('assets/dist/img/avatar5.png')}}" class="img-circle" width="45" height="45"
                         alt="user"></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i> {{--User Profile--}}
                            @if(!is_null(Auth::user()))
                            {{Auth::user()->email}}
                                @endif
                        </a>
                    </li>
                    <li><a href="{{route('logout')}}"
                           onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>

        </ul>

    </nav>
</header>

