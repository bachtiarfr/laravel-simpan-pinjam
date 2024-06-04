@extends('layouts.app')

@section('title', 'Edit User')

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
                    <h2 class="h4">Edit User</h2>
                    <p class="mb-0">Ubah data user.</p>
                </div>
            </div>
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">

                            <div class="col-sm-6">
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" id="name"
                                        name="name" value="{{ $user->name }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="email">Email</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                        id="email" name="email" value="{{ $user->email }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>


                                <div class="mb-4">
                                    <label>Roles</label>
                                    <select name="roles" required class="form-control">
                                        <option value="{{ $user->roles }}">Biarkan default jika tidak diubah</option>
                                        <option value="admin">Admin</option>
                                        <option value="ketua">Ketua</option>
                                    </select>
                                </div>

                                <!-- End of Form -->
                            </div>

                            <div class="col-sm-6">
                                <!-- Form -->
                                <div class="mb-4">
                                    <label for="password">Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                        name="password" id="password" value="" placeholder="Password">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="password">Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                                        name="konfirmasi_password" id="password" value=""
                                        placeholder="Konfirmasi Password">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('konfirmasi_password') }}
                                    </div>
                                </div>
                                <!-- End of Form -->
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
