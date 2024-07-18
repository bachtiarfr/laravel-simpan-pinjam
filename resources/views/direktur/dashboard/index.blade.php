@extends('layouts.app')

@section('title', 'Direktur - Halaman Dashboard ')
@section('content')

    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap py-4">
                <div class="d-block mb-md-0 mb-4">
                    {{-- <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
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
                            <li class="breadcrumb-item"><a href="../">Direktur</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User</li>
                        </ol>
                    </nav>
                    <h2 class="h4">User</h2>
                    <p class="mb-0">Data user yang telah terdaftar.</p> --}}
                </div>
            </div>
            {{-- <div class="card bg-yellow-100 border-0 shadow">
                <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                    <div class="d-block mb-3 mb-sm-0">
                        <div class="fs-5 fw-normal mb-2">Sales Value</div>
                        <h2 class="fs-3 fw-extrabold">$10,567</h2>
                        <div class="small mt-2">
                            <span class="fw-normal me-2">Yesterday</span>
                            <span class="fas fa-angle-up text-success"></span>
                            <span class="text-success fw-bold">10.57%</span>
                        </div>
                    </div>
                    <div class="d-flex ms-auto">
                    </div>
                </div>
                <div class="card-body p-2">
                    <div class="ct-chart-sales-value ct-double-octave"></div>
                </div>
            </div> --}}
        </div>

        <h4 class="font-weight-light text-center">👋 Selamat Datang </h4>
        <h4 class="font-weight-bold text-center">{{ auth()->user()->name }}</h4>

        <div class="row justify-content-center my-5">
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
                                        class="fas fa-money-bill-wave"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Total Pinjaman</h2>
                                    <h6 class="mb-1">{{ $total_pinjaman }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
                                        class="fas fa-landmark"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Pinjaman</h2>
                                    <h6 class="mb-1">{{ $pinjaman }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
                                        class="fas fa-coins"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Pinjaman Lunas</h2>
                                    <h6 class="mb-1">{{ $pinjaman_lunas }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
                                        class="fas fa-users"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Kelompok</h2>
                                    <h6 class="mb-1">{{ $kelompok }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
                                        class="fas fa-user-plus"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Butuh Verifikasi</h2>
                                    <h6 class="mb-1">{{ $butuh_verifikasi }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
                                        class="fas fa-user-check"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h5">Terverifikasi</h2>
                                    <h6 class="mb-1">{{ $terverifikasi }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
