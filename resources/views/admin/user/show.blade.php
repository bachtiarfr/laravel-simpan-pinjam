@extends('layouts.app')

@section('title', 'Data User')

@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="#">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                    </path>
                                </svg>
                            </a>
                        </li>

                        @can('isDirektur')
                            <li class="breadcrumb-item"><a href="../">Direktur</a></li>
                        @elsecan('isAdmin')
                            <li class="breadcrumb-item"><a href="../">Pegawai</a></li>
                        @elsecan('isKelompok')
                            <li class="breadcrumb-item"><a href="../">Anggota</a></li>
                        @endcan

                        <li class="breadcrumb-item"><a href="../../dataUser">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
                <h2 class="h4 text-primary">Informasi User</h2>
                <p class="text-secondary mb-0">Detail Informasi User.</p>
            </div>
        </div>
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <h2 class="h5 text-secondary mb-4">Informasi Umum</h2>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h5 class="text-dark">Nama</h5>
                        <p class="text-muted">{{ $user->nama_user }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-dark">Email</h5>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="text-dark">Roles</h5>
                        <p class="text-muted">{{ $user->roles == 'kelompok' ? 'Ketua Kelompok' : $user->roles }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
