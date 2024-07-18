@extends('layouts.app')

@section('title', 'Tambah User')

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
                            <li class="breadcrumb-item"><a href="../">Pegawai</a></li>
                            <li class="breadcrumb-item"><a href="../user">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Tambah User</h2>
                    <p class="mb-0">Menambahkan user baru dengan role.</p>
                </div>

            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-5 col-sm-6">

                                <div class="mb-3">
                                    <label for="nama_user">Nama Lengkap</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('nama_user') ? 'is-invalid' : '' }}"
                                        id="nama_user" name="nama_user" value="{{ old('nama_user') }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_user') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email"
                                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                        id="email" name="email" value="{{ old('email') }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                        name="password" id="password" value="{{ old('password') }}" placeholder="Password">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password">Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                                        name="konfirmasi_password" id="password" value="{{ old('konfirmasi_password') }}"
                                        placeholder="Password">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('konfirmasi_password') }}
                                    </div>
                                </div>

                                <input name="roles" value="user" hidden>

                            </div>


                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
