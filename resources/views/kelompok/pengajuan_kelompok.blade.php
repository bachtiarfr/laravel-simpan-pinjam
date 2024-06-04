@extends('layouts.app')

@section('title', 'Pengajuan Kelompok')

@section('content')

    @if (session('error'))
        @push('scripts')
            <script>
                swal({
                    title: "Sorry",
                    text: "{{ session('error') }}",
                    icon: "error",
                    button: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

    @if ($kelompok != null && $approval_status == 'waiting')
        <div class="alert alert-secondary text-white" role="alert">
            Anda telah melakukan pengajuan, silahkan tunggu admin untuk memverifikasi pengajuan anda
        </div>
    @endif

    @if ($kelompok != null && $approval_status == 'approved')
        <div class="alert alert-success text-white" role="alert">
            Pengajuan kelompok anda telah di verifikasi oleh admin
        </div>
    @endif

    @if ($kelompok != null && $approval_status == 'reject')
        <div class="alert alert-danger text-white" role="alert">
            Pengajuan kelompok anda di tolak oleh admin karena:
            {{ $kelompok->approval_reason }}
        </div>
    @endif

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
                            <li class="breadcrumb-item active" aria-current="page">Pengajuan Kelompok</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Pengajuan Kelompok</h2>
                    <p class="mb-0">Pengajuan data kelompok untuk dapat memulai peminjaman.</p>
                </div>
            </div>
            <div class="card border-light shadow-sm components-section">
                <div class="card-body">
                    <form action="{{ route('pengajuan-kelompok.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-lg-5 col-sm-6">
                                <div class="mb-3">
                                    <label for="ktp">No. KTP</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('no_ktp') ? 'is-invalid' : '' }}"
                                        id="no_ktp" name="no_ktp"
                                        value="{{ $kelompok != null ? $kelompok->no_ktp : old('no_ktp') }}"
                                        {{ ($kelompok != null && $approval_status == 'waiting') || $approval_status == 'approved' ? 'disabled' : null }}>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('no_ktp') }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_kelompok">Nama Kelompok</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('nama_kelompok') ? 'is-invalid' : '' }}"
                                        id="nama_kelompok" name="nama_kelompok"
                                        value="{{ $kelompok != null ? $kelompok->nama_kelompok : old('nama_kelompok') }}"
                                        {{ ($kelompok != null && $approval_status == 'waiting') || $approval_status == 'approved' ? 'disabled' : null }}>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_kelompok') }}
                                    </div>
                                </div>
                                <div class="my-3">
                                    <label for="textarea">Alamat</label>
                                    <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" placeholder="Tulis alamat lengkap..."
                                        id="alamat" name="alamat" rows="4">{{ $kelompok != null ? $kelompok->alamat : old('alamat') }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('alamat') }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-sm-6">
                                <div class="mb-3">
                                    <label for="nama_kelompok">Telepon</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('telepon') ? 'is-invalid' : '' }}"
                                        id="telepon" name="telepon"
                                        {{ ($kelompok != null && $approval_status == 'waiting') || $approval_status == 'approved' ? 'disabled' : null }}
                                        value="{{ $kelompok != null ? $kelompok->telepon : old('telepon') }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('telepon') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="jenis_kelompok">Jenis Kelompok</label>
                                    {{-- <input type="text"
                                    class="form-control {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}"
                                    id="anggota_id" name="anggota_id"> --}}
                                    <select
                                        class="form-select {{ $errors->first('jenis_kelompok_id') ? 'is-invalid' : '' }}"
                                        name="jenis_kelompok_id" id="jenis_kelompok_id"
                                        {{ ($kelompok != null && $approval_status == 'waiting') || $approval_status == 'approved' ? 'disabled' : null }}>
                                        <option value="{{ $kelompok != null ? $kelompok->jenis_kelompok : '' }}"
                                            selected="selected">
                                            {{ $kelompok != null ? $kelompok->jenis_kelompok : '' }}
                                        </option>
                                        @foreach ($jenis_kelompok as $jk)
                                            <option value="{{ $jk->id }}">{{ $jk->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jenis_kelompok_id') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="file">Syarat Administrasi</label>
                                    <input type="file" name="file" id="file"
                                        {{ ($kelompok != null && $approval_status == 'waiting') || $approval_status == 'approved' ? 'disabled' : null }}>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('file') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    {{-- <input type="submit" value="Simpan"> --}}
                                    <button type="submit" class="btn btn-primary"
                                        {{ ($kelompok != null && $approval_status == 'waiting') || $approval_status == 'approved' ? 'disabled' : null }}>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
