<nav id="sidebarMenu" class="sidebar d-md-block bg-primary collapse text-white" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="user-avatar lg-avatar mr-4">
                    <img src="{{ Storage::url('public/' . auth()->user()->image) }}"
                        class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h6">Hi, {{ auth()->user()->name }}</h2>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
        
          document.getElementById('logout-form').submit();"
                        class="btn btn-secondary text-dark btn-xs"><span class="mr-2"><span
                                class="fas fa-sign-out-alt"></span></span>Sign Out</a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" class="fas fa-times" data-toggle="collapse" data-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation"></a>
            </div>
        </div>
        <ul class="nav flex-column">
            {{-- Sidebar Anggota Kelompok --}}
            @can('isKelompok')
                <li class="nav-item">
                    <a href="{{ route('dashboard.anggota_kelompok') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pinjaman.index') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                        <span>Pinjaman</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="{{ route('pengajuan-kelompok.create') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                        <span>Pengajuan Kelompok</span>
                    </a>
                </li> --}}


                {{-- Sidebar Admin --}}
            @elsecan('isAdmin')
                <li class="nav-item">
                    <a href="{{ route('dashboard.admin') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#submenu-app-user">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-user"></span></span>
                            User
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level {{ Request::route()->getName() == 'user.index' ||
                    Request::route()->getName() == 'user.create' ||
                    Request::route()->getName() == 'user.show'
                        ? 'show'
                        : '' }} collapse"
                        role="list" id="submenu-app-user" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li class="nav-item {{ Request::route()->getName() == 'user.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.index') }}"><span>Data User</span></a>
                            </li>
                            <li class="nav-item {{ Request::route()->getName() == 'user.create' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('user.create') }}"><span>Tambah User</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#submenu-app-kelompok">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                            Kelompok
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level {{ Request::route()->getName() == 'admin.kelompok.index' ? 'show' : '' }} collapse"
                        role="list" id="submenu-app-kelompok" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li
                                class="nav-item {{ Request::route()->getName() == 'admin.kelompok.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('kelompok.index') }}"><span>Data
                                        Kelompok</span></a>
                            </li>
                            <li class="nav-item {{ Request::route()->getName() == 'kelompok.create' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('kelompok.create') }}"><span>Tambah Kelompok</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#pinjaman-app">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-table"></span></span>
                            Pinjaman
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level {{ Request::route()->getName() == 'admin.show.pinjaman' || Request::route()->getName() == 'admin.create.pinjaman' ? 'show' : '' }} collapse"
                        role="list" id="pinjaman-app" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li
                                class="nav-item {{ Request::route()->getName() == 'admin.show.pinjaman' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.show.pinjaman') }}"><span>Data
                                        Pinjaman</span></a>
                            </li>
                            <li
                                class="nav-item {{ Request::route()->getName() == 'admin.create.pinjaman' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.create.pinjaman') }}"><span>Tambah
                                        Pinjaman</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- Sidebar Direktur --}}
            @elsecan('isDirektur')
                <li class="nav-item {{ request()->is('direktur') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.direktur') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('direktur/pinjaman-ketua*') ? 'active' : '' }}">
                    <a href="{{ route('pengajuan-kelompok.index') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-database"></span></span>
                        <span>Pinjaman</span>
                    </a>
                </li>

                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#submenu-app-kelompok">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                            Kelompok
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>
                    <div class="multi-level {{ Request::route()->getName() == 'pengajuan-kelompok' ? 'show' : '' }} collapse"
                        role="list" id="submenu-app-kelompok" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li
                                class="nav-item {{ Request::route()->getName() == 'pengajuan-kelompok' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('kelompok.index') }}"><span>Data
                                        Kelompok</span></a>
                            </li>
                            <li
                                class="nav-item {{ Request::route()->getName() == 'pengajuan-kelompok' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('pengajuan-kelompok.index') }}"><span>Pengajuan
                                        Kelompok</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endcan
        </ul>
    </div>
</nav>
