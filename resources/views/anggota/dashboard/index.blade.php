@extends('layouts.app')

@section('title', 'Halaman Dashboard Anggota')
@section('content')


    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-4 mb-md-0">
                </div>
            </div>
        </div>

        {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}


        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <h4 class="font-weight-light text-center">👋 Selamat Datang </h4>
        <h4 class="font-weight-bold text-center">{{ auth()->user()->name }}</h4>


        <div class="row justify-content-center my-5">
            <div class="col-12 col-sm-6 col-xl-4 mb-4">
                <div class="card border-light shadow-sm">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span
                                        class="fas fa-money-bill-wave"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h5>Pinjaman Saat Ini</h5>
                                    <h5 class="mb-1">{{ $total_pinjaman_saat_ini }}</h5>
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
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span
                                        class="fas fa-landmark"></span></div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h5>Total Pinjaman</h5>
                                    <h5 class="mb-1">{{ $total_pinjaman }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
