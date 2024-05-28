<nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark pl-0 pr-2 pb-0">
    <div class="container-fluid px-0">
        <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
            <div class="d-flex">
                <!-- Search form -->
                {{-- <form class="navbar-search form-inline" id="navbar-search-main">
                    <div class="input-group input-group-merge search-bar">
                        <span class="input-group-text" id="topbar-addon"><span class="fas fa-search"></span></span>
                        <input type="text" class="form-control" id="topbarInputIconLeft" placeholder="Search"
                            aria-label="Search" aria-describedby="topbar-addon">
                    </div>
                </form> --}}
            </div>
            <!-- Navbar links -->
            <ul class="navbar-nav align-items-center">
                @can('isAnggota')
                <li class="nav-item dropdown">
                    <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder"
                                src="{{ ImageUrl(auth()->user()->image) }}">
                            <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt text-danger"></span>
                            Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                @elsecan('isAdmin')
                <li class="nav-item dropdown">
                    <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder"
                                src="{{ ImageUrl(auth()->user()->image) }}">
                            <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt text-danger"></span>
                            Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                @elsecan('isKetua')
                <li class="nav-item dropdown">
                    <a class="nav-link pt-1 px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media d-flex align-items-center">
                            <img class="user-avatar md-avatar rounded-circle" alt="Image placeholder"
                                src="{{ ImageUrl(auth()->user()->image) }}">
                            <div class="media-body ml-2 text-dark align-items-center d-none d-lg-block">
                                <span class="mb-0 font-small font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-right mt-2">
                        <a class="dropdown-item font-weight-bold" href=""><span class="far fa-user-circle"></span>My
                            Profile</a>
                        <a class="dropdown-item font-weight-bold" href="#"><span class="fas fa-cog"></span>Settings</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item font-weight-bold" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                            <span class="fas fa-sign-out-alt text-danger"></span>
                            Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endcan

            </ul>
        </div>
    </div>
</nav>