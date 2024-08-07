@extends('layouts.app')

@section('title', 'Data kelompok')

@section('content')

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <div class="py-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                <li class="breadcrumb-item"><a href="#">Kelompok</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Kelompok</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <div class="row">

                        <div class="col-12 col-xl-8">
                            <div class="card card-body border-light mb-4 bg-white shadow-sm">
                                <h2 class="h5 mb-4">Informasi Umum</h2>
                                {{-- <form> --}}
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div>
                                            <label for="no_ktp">No. KTP</label>
                                            <input class="form-control {{ $errors->first('no_ktp') ? 'is-invalid' : '' }}"
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
                                                name="nama_kelompok" type="text" value="{{ $kelompok->nama_kelompok }}"
                                                required>
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
                                    <a class="btn btn-success btn-lg" href={{ route('approve.kelompok', $kelompok->id) }}>
                                        Setujui
                                    </a>
                                    <button class="btn btn-secondary btn-lg" data-toggle="modal"
                                        data-target="#exampleModal">Tolak</button>
                                </div>
                                {{--
                            </form> --}}
                            </div>
                        </div>
                        <div class="col-12 col-xl-4">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card border-light p-0 text-center">
                                        <div class="profile-cover rounded-top"
                                            style="background-image: url('{{ public_path('assets/docs/' . $kelompok['document_administrations']) }}')">
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


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action={{ route('reject.kelompok', $kelompok->id) }} method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Penolakan pengajuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">

                            <div class="my-3">
                                <label for="textarea">Alasan</label>
                                <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                                    placeholder="Tulis alasan kenapa pengajuan ditolak..." id="alasan" name="alasan" rows="4">{{ old('alasan') }}</textarea>
                                <div class="invalid-feedback">
                                    {{ $errors->first('alasan') }}
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary p-2">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
