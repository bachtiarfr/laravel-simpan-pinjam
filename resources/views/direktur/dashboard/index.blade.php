@extends('layouts.app')

@section('title', 'Direktur - Halaman Dashboard')

@section('content')

    @if ($message = Session::get('success'))
        @push('scripts')
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ $message }}",
                    icon: "success",
                    button: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

    @if ($message = Session::get('error'))
        @push('scripts')
            <script>
                swal({
                    title: "Gagal!",
                    text: "{{ $message }}",
                    icon: "error",
                    button: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap py-4">
                    <div class="d-block mb-md-0 mb-4">
                        {{-- Uncomment and modify breadcrumb navigation if needed --}}
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
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav> --}}
                        <h2 class="h4">Dashboard</h2>
                        <p class="mb-0">Selamat datang, {{ auth()->user()->name }}!</p>
                    </div>
                </div>
            </div>

            <h4 class="font-weight-light text-center">👋 Selamat Datang </h4>
            <h4 class="font-weight-bold text-center">{{ auth()->user()->name }}</h4>

            <div class="row justify-content-center my-5">
                @foreach ([['Total Pinjaman', 'fas fa-money-bill-wave', $total_pinjaman], ['Pinjaman', 'fas fa-landmark', $pinjaman], ['Pinjaman Lunas', 'fas fa-coins', $pinjaman_lunas], ['Kelompok', 'fas fa-users', $kelompok], ['Butuh Verifikasi', 'fas fa-user-plus', $butuh_verifikasi], ['Terverifikasi', 'fas fa-user-check', $terverifikasi]] as $card)
                    <div class="col-12 col-sm-6 col-xl-4 mb-4">
                        <div class="card border-light shadow-sm">
                            <div class="card-body">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div
                                        class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                                        <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded">
                                            <span class="{{ $card[1] }}"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h5">{{ $card[0] }}</h2>
                                            <h6 class="mb-1">{{ $card[2] }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
