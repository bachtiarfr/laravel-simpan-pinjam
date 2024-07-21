@extends('layouts.app')

@section('title', 'Data Kelompok')

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
                            <li class="breadcrumb-item"><a href="../">Admin</a></li>
                        @elsecan('isKelompok')
                            <li class="breadcrumb-item"><a href="../">Anggota</a></li>
                        @endcan

                        <li class="breadcrumb-item"><a href="../kelompok">Kelompok</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h2 class="h4 text-primary">Informasi Kelompok</h2>
                <p class="text-secondary mb-0">Detail Informasi Kelompok.</p>
            </div>
        </div>
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="card border-light mb-4 shadow-sm">
                            <div class="card-body">
                                <h2 class="h5 text-secondary mb-4">Informasi Umum</h2>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="no_ktp" class="form-label">No. KTP</label>
                                        <p class="h5 text-dark">{{ $kelompok->no_ktp }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_kelompok" class="form-label">Nama Kelompok</label>
                                        <p class="h5 text-dark">{{ $kelompok->nama_kelompok }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <p class="h5 text-dark">{{ $kelompok->alamat }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_ketua_kelompok" class="form-label">Nama Ketua Kelompok</label>
                                        <p class="h5 text-dark">{{ $kelompok->nama_ketua_kelompok }}</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status_persetujuan" class="form-label">Status Persetujuan</label>
                                        <p class="h5 text-dark">{{ $kelompok->status_persetujuan }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card border-light text-center shadow-sm">
                            <div class="profile-cover rounded-top my-3">
                                <iframe class="rounded" src="{{ asset('/docs/' . $kelompok['path']) }}"
                                    height="200"></iframe>
                            </div>
                            <div class="card-body">
                                <h4 class="h3 text-dark">{{ $kelompok['path'] }}</h4>
                                <a class="btn btn-sm btn-primary"
                                    href="{{ asset('/docs/' . $kelompok['document_administrations']) }}" target="_blank">
                                    <span class="fas fa-download mr-1"></span> Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
