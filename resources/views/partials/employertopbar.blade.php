

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>



    <div class="navbar-collapse collapse">

        <ul class="navbar-nav navbar-align">
            {{-- <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="ti-menu"></i></a></li> --}}
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            {{-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-search"></i></a> --}}

            {{-- </li> --}}

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    @if (Auth::user()->picture)
                    <img src="{{ asset('template/img/employerphotos/' . Auth::user()->picture) }}"
                        class="avatar img-fluid rounded me-1" alt="{{ Auth::user()->name }}" /> <span
                        class="text-dark">{{ Auth::user()->name }}</span>
                @else
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}"
                        class="avatar img-fluid rounded me-1" alt="Placeholder avatar" /> <span
                        class="text-dark">{{ Auth::user()->name }}</span>
                @endif
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('employerprofile') }}">
                        <i class="align-middle me-1" data-feather="user"></i> Profile
                    </a>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="align-middle me-1"
                                data-feather="log-out"></i> Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
