@extends('layouts.app')

@section('title', 'Edit Pengaturan')

@section('content')

    @if (session('status'))
        @push('scripts')
            <script>
                swal({
                    title: "Good job!",
                    text: "{{ session('status') }}",
                    icon: "success",
                    button: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

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
                                <li class="breadcrumb-item"><a href="../">Pegawai</a></li>
                            @elsecan('isKelompok')
                                <li class="breadcrumb-item"><a href="../">Anggota</a></li>
                            @endcan
                            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Pengaturan Pinjaman</h2>
                    <p class="mb-0">Anda dapat melihat atau mengubah nilai pinjaman.</p>
                </div>
            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pengaturan.update', ['id' => $pengaturan->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label for="waktu_pinjaman">Waktu Pinjaman (Bulan)</label>
                                    <input type="number"
                                        class="form-control {{ $errors->first('waktu_pinjaman') ? 'is-invalid' : '' }}"
                                        id="waktu_pinjaman" name="waktu_pinjaman" value="{{ $pengaturan->waktu_pinjaman }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('waktu_pinjaman') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="max_pinjaman">Maksimum Pinjaman</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('max_pinjaman') ? 'is-invalid' : '' }}"
                                        id="max_pinjaman" name="max_pinjaman" value="{{ $pengaturan->max_pinjaman }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('max_pinjaman') }}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="jasa_pinjam">Jasa Pinjam (%)</label>
                                    <input type="number"
                                        class="form-control {{ $errors->first('jasa_pinjam') ? 'is-invalid' : '' }}"
                                        id="jasa_pinjam" name="jasa_pinjam" value="{{ $pengaturan->jasa_pinjam }}">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jasa_pinjam') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
