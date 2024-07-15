@extends('layouts.app')

@section('title', 'Halaman Dashboard Anggota')
@section('content')


    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap py-4">
                <div class="d-block mb-md-0 mb-4">
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
        <h4 class="font-weight-bold text-center">{{ auth()->user()->nama_user }}</h4>

        @if ($status_pengajuan == null || $status_pengajuan['status_persetujuan'] == 'ditolak')
            <div class="row justify-content-center my-5">
                <div class="col-1 col-sm-10">
                    <div class="card card-body mb-4 border-0 shadow">
                        <h2 class="h5">Unggah file dokumen administrasi</h2>
                        <p class="text-grey">Anda harus mengunggah file dokumen administrasi untuk keperluan verifikasi,
                            Agar
                            dapat melakukan
                            pinjaman</p>


                        <form action="{{ route('pengajuan-kelompok.store') }}" method="post" enctype="multipart/form-data"
                            class="row justify-content-center">
                            @csrf
                            <input name="file" type="file">

                            <button type="submit" class="btn btn-secondary text-dark col-sm-2">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        @elseif ($status_pengajuan['status_persetujuan'] == 'menunggu')
            <div class="alert alert-success text-center text-white" role="alert">
                Anda telah mengirimkan file dokumen administrasi silahkan tunggu beberapa saat untuk di verifikasi oleh
                direktur
            </div>
        @elseif ($status_pengajuan['status_persetujuan'] == 'disetujui')
            <div></div>
    </div>
    @endif
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
                            class="col-12 col-xl-5 text-xl-center mb-xl-0 d-flex align-items-center justify-content-xl-center mb-3">
                            <div class="icon icon-shape icon-md icon-shape-blue mr-sm-0 mr-4 rounded"><span
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
