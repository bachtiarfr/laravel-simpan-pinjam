@extends('layouts.app')

@section('title', 'Data kelompok')

@section('content')

    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
                <div class="d-block mb-4 mb-md-0">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
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

                            @can('isKetua')
                                <li class="breadcrumb-item"><a href="../">Direktur</a></li>
                            @elsecan('isAdmin')
                                <li class="breadcrumb-item"><a href="../">Admin</a></li>
                            @elsecan('isAnggota')
                                <li class="breadcrumb-item"><a href="../">Anggota</a></li>
                            @endcan

                            <li class="breadcrumb-item"><a href="../kelompok">Kelompok</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Edit Kelompok</h2>
                    <p class="mb-0">Ubah data.</p>
                </div>
            </div>
            <div class="card border-light shadow-sm components-section">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="card card-body bg-white border-light shadow-sm mb-4">
                                <h2 class="h5 mb-4">Informasi Umum</h2>
                                <form action="{{ route('kelompok.update', [$kelompok->id]) }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div>
                                                <label for="no_ktp">No. KTP</label>
                                                <input
                                                    class="form-control {{ $errors->first('no_ktp') ? 'is-invalid' : '' }}"
                                                    name="no_ktp" type="text" value="{{ $kelompok->no_ktp }}" required>
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('no_ktp') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div>
                                                <label for="nama_kelompok">Nama Kelompok</label>
                                                <input
                                                    class="form-control {{ $errors->first('nama_kelompok') ? 'is-invalid' : '' }}"
                                                    name="nama_kelompok" type="text"
                                                    value="{{ $kelompok->nama_kelompok }}" required>
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('nama_kelompok') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                    </div>
                                    <div class="row">
                                        <div class="col-md mb-3">
                                            <label for="textarea">Alamat</label>
                                            <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" name="alamat" rows="4">{{ $kelompok->alamat }}</textarea>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('alamat') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div>
                                            <label for="telepon">Telepon</label>
                                            <input class="form-control {{ $errors->first('telepon') ? 'is-invalid' : '' }}"
                                                name="telepon" type="text" value="{{ $kelompok->telepon }}" required>
                                            <div class="invalid-feedback">
                                                {{ $errors->first('telepon') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card border-light text-center p-0">


                                        <div class="profile-cover rounded-top my-3">
                                            <iframe class="rounded"
                                                src="{{ asset('/docs/' . $kelompok['document_administrations']) }}"
                                                height="200"></iframe>
                                        </div>
                                        <div class="card-body pb-5">
                                            <h4 class="h3">{{ $kelompok['document_administrations'] }}</h4>
                                            <a class="btn btn-sm btn-primary mr-2"
                                                href="{{ asset('/docs/' . $kelompok['document_administrations']) }}"
                                                target="_blank"> <span class="fas fa-download mr-1"></span> Download</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
