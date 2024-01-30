<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('dashboard') }}">
            <span class="align-middle">Job Listing</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('applyjobs') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">Jobs
                    </span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('showjsapplication') }}">
                    <i class="align-middle" data-feather="book"></i> <span class="align-middle">My Application
                    </span>
                </a>
            </li>


    </div>
</nav>
