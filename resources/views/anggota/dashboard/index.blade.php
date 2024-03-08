@extends('layouts.app')

@section('title','Halaman Dashboard Anggota')
@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Halaman Dashboard</li>
        </ol>
    </nav>

</div>

<div class="container">
    <div class="row justify-content-center">

        @if ($kelompok_data == null)
        <div class="alert alert-secondary" role="alert">
            Anda belum terverifikasi untuk melakukan pinjaman, harap selesaikan pengajuan kelompok
        </div>
        @endif

        @if ($kelompok_data != null && $kelompok_data->approval_status == 'reject')
        <div class="alert alert-secondary" role="alert">
            Pengajuan kelompok anda di tolak karena
            {{$kelompok_data->approval_reason}}
        </div>
        @endif

        @if (session('status'))
        <div class="alert alert-success text-dark" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                <h1>Selamat Datang {{ auth()->user()->name }}</h1>

            </div>
        </div>
    </div>
</div>

@endsection