@extends('layouts.app')

@section('title', 'Tambah Kelompok')

@section('content')

    <div class="row">
        <div class="col-12 mb-4">
            <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap py-4">
                <div class="d-block mb-md-0 mb-4">
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

                            @can('isDirektur')
                                <li class="breadcrumb-item"><a href="../">Direktur</a></li>
                            @elsecan('isAdmin')
                                <li class="breadcrumb-item"><a href="../">Admin</a></li>
                            @elsecan('isKelompok')
                                <li class="breadcrumb-item"><a href="../">Anggota</a></li>
                            @endcan

                            <li class="breadcrumb-item"><a href="../kelompok">Kelompok</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Tambah Kelompok</h2>
                    <p class="mb-0">daftar kelompok baru.</p>
                </div>
            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <form action="{{ route('kelompok.store') }}" method="post">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="jenis_kelompok">Jenis Kelompok</label>
                                    {{-- <input type="text" class="form-control {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}" id="anggota_id" name="anggota_id"> --}}
                                    <select
                                        class="form-select {{ $errors->first('jenis_kelompok_id') ? 'is-invalid' : '' }}"
                                        name="jenis_kelompok_id" id="jenis_kelompok_id">
                                        <option value=""></option>
                                        @foreach ($jenis_kelompok as $jk)
                                            <option value="{{ $jk->id }}">{{ $jk->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jenis_kelompok_id') }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="ktp">No. KTP</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('no_ktp') ? 'is-invalid' : '' }}"
                                        id="no_ktp" name="no_ktp" value="{{ old('no_ktp') }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('no_ktp') }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_kelompok">Nama Kelompok</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('nama_kelompok') ? 'is-invalid' : '' }}"
                                        id="nama_kelompok" name="nama_kelompok" value="{{ old('nama_kelompok') }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_kelompok') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="telepon">Telepon</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('telepon') ? 'is-invalid' : '' }}"
                                        id="telepon" name="telepon" value="{{ old('telepon') }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('telepon') }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="user_id">Nama Ketua Kelompok</label>
                                    {{-- <input type="text" class="form-control {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}" id="anggota_id" name="anggota_id"> --}}
                                    <select class="form-select {{ $errors->first('user_id') ? 'is-invalid' : '' }}"
                                        name="user_id" id="user_id">
                                        <option value=""></option>
                                        @foreach ($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama_user }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('user_id') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="textarea">Alamat</label>
                                <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" placeholder="Tulis alamat lengkap..."
                                    id="alamat" name="alamat" rows="4">{{ old('alamat') }}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('alamat') }}
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            {{-- <input type="submit" value="Simpan"> --}}
                            <button type="submit" class="btn btn-secondary text-dark">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
