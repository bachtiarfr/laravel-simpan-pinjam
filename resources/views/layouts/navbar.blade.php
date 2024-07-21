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


                {{-- Sidebar Pegawai --}}
            @elsecan('isAdmin')
                <li class="nav-item">
                    <a href="{{ route('dashboard.pegawai') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#submenu-app-user">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-user"></span></span>
                            Data Master
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
                            <li class="nav-item {{ Request::route()->getName() == 'show.user' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('show.user') }}"><span>Data User</span></a>
                            </li>
                            <li class="nav-item {{ Request::route()->getName() == 'show.pegawai' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('show.pegawai') }}"><span>Data Pegawai</span></a>
                            </li>
                            <li class="nav-item {{ Request::route()->getName() == 'show.direktur' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('show.direktur') }}"><span>Data Direktur</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <span class="nav-link collapsed d-flex justify-content-between align-items-center"
                        data-toggle="collapse" data-target="#submenu-app-kelompok">
                        <span>
                            <span class="sidebar-icon"><span class="fas fa-users"></span></span>
                            Data Anggota
                        </span>
                        <span class="link-arrow"><span class="fas fa-chevron-right"></span></span>
                    </span>

                    <div class="multi-level {{ request()->is('admin/kelompok*') ? 'show' : '' }} collapse" role="list"
                        id="submenu-app-kelompok" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li
                                class="nav-item {{ Request::route()->getName() == 'admin.show.uep.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.show.uep.index') }}"><span>Kelompok
                                        UEP</span></a>
                            </li>
                            <li
                                class="nav-item {{ Request::route()->getName() == 'admin.show.spp.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.show.spp.index') }}"><span>Kelompok
                                        SPP</span></a>
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
                    <div class="multi-level {{ Request::route()->getName() == 'pegawai.show.pinjaman' || Request::route()->getName() == 'pegawai.create.pinjaman' ? 'show' : '' }} collapse"
                        role="list" id="pinjaman-app" aria-expanded="false">
                        <ul class="flex-column nav">
                            <li
                                class="nav-item {{ Request::route()->getName() == 'pegawai.show.pinjaman' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('pegawai.show.pinjaman') }}"><span>Data
                                        Pinjaman</span></a>
                            </li>
                            <li
                                class="nav-item {{ Request::route()->getName() == 'pegawai.create.pinjaman' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('pegawai.create.pinjaman') }}"><span>Tambah
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

                <li class="nav-item {{ request()->is('direktur/pinjaman') ? 'active' : '' }}">
                    <a href="{{ route('pinjaman.list') }}" class="nav-link">
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
                                <a class="nav-link" href="{{ route('pengajuan.kelompok') }}"><span>Pengajuan
                                        Kelompok</span></a>
                            </li>
                            <li
                                class="nav-item {{ Request::route()->getName() == 'direktur.show.uep.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('direktur.show.uep.index') }}"><span>Kelompok
                                        UEP</span></a>
                            </li>
                            <li
                                class="nav-item {{ Request::route()->getName() == 'direktur.show.spp.index' ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('direktur.show.spp.index') }}"><span>Kelompok
                                        SPP</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="{{ route('export.pinjaman') }}" class="nav-link">
                        <span class="sidebar-icon"><span class="fas fa-chart-pie"></span></span>
                        <span>Export Laporan</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</nav>
