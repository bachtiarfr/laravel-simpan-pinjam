@extends('layouts.app')

@section('title', 'Pengajuan Kelompok')

@section('content')

@if(session('error'))
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

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Kelompok</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Kelompok</li>
        </ol>
    </nav>

</div>

@if ($kelompok != null && $kelompok->approval_status == 'waiting')
<div class="alert alert-secondary text-white" role="alert">
    Anda telah melakukan pengajuan, silahkan tunggu admin untuk memverifikasi pengajuan anda
</div>
@endif

@if ($kelompok != null && $kelompok->approval_status == 'approved')
<div class="alert alert-success text-white" role="alert">
    Pengajuan kelompok anda telah di verifikasi oleh admin
</div>
@endif

@if ($kelompok != null && $kelompok->approval_status == 'reject')
<div class="alert alert-danger text-white" role="alert">
    Pengajuan kelompok anda di tolak oleh admin karena:
    {{$kelompok->approval_reason}}
</div>
@endif

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('pengajuan-kelompok.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-5 col-sm-6">
                            <div class="mb-3">
                                <label for="ktp">No. KTP</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('no_ktp') ? 'is-invalid' : '' }}" id="no_ktp"
                                    name="no_ktp" value="{{  $kelompok != null ? $kelompok->no_ktp : old('no_ktp')  }}"
                                    {{$kelompok !=null && $kelompok->approval_status == 'waiting' ||
                                $kelompok->approval_status == 'approved' ? 'disabled' : null
                                }}>
                                <div class="invalid-feedback">
                                    {{$errors->first('no_ktp')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_kelompok">Nama Kelompok</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_kelompok') ? 'is-invalid' : '' }}"
                                    id="nama_kelompok" name="nama_kelompok"
                                    value="{{  $kelompok != null ? $kelompok->nama_kelompok : old('nama_kelompok')  }}"
                                    {{$kelompok !=null && $kelompok->approval_status == 'waiting' ||
                                $kelompok->approval_status == 'approved' ? 'disabled' : null
                                }}>
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_kelompok')}}
                                </div>
                            </div>
                            <div class="my-3">
                                <label for="textarea">Alamat</label>
                                <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}"
                                    placeholder="Tulis alamat lengkap..." id="alamat" name="alamat" rows="4" {{$kelompok
                                    !=null ? 'disabled' : null
                                    }}>{{ $kelompok != null ? $kelompok->alamat : old('alamat')}}</textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('alamat')}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <div class="mb-3">
                                <label for="telepon">Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fas fa-phone"></span></span>
                                    <input type="text"
                                        class="form-control {{ $errors->first('telepon') ? 'is-invalid' : '' }}"
                                        id="telepon" name="telepon" {{$kelompok !=null && $kelompok->approval_status ==
                                    'waiting' || $kelompok->approval_status == 'approved' ? 'disabled' : null }}
                                    value="{{ $kelompok != null ? $kelompok->telepon : old('telepon')}}">
                                    <div class="invalid-feedback">
                                        {{$errors->first('telepon')}}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="jenis_kelompok">Jenis Kelompok</label>
                                {{-- <input type="text"
                                    class="form-control {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}"
                                    id="anggota_id" name="anggota_id"> --}}
                                <select
                                    class="form-select {{ $errors->first('jenis_kelompok_id') ? 'is-invalid' : '' }}"
                                    name="jenis_kelompok_id" id="jenis_kelompok_id" {{$kelompok !=null &&
                                    $kelompok->approval_status == 'waiting' || $kelompok->approval_status == 'approved'
                                    ? 'disabled' :
                                    null }}>
                                    <option value="{{ $kelompok != null ? $kelompok->jenis_kelompok : ''}}"
                                        selected="selected">
                                    </option>
                                    @foreach ($jenis_kelompok as $jk)
                                    <option value="{{ $jk->id }}">{{ $jk->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('jenis_kelompok_id')}}
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="file">Syarat Administrasi</label>
                                <input type="file" name="file" id="file" {{$kelompok !=null &&
                                    $kelompok->approval_status == 'waiting' || $kelompok->approval_status == 'approved'
                                ? 'disabled' : null }}>
                                <div class="invalid-feedback">
                                    {{$errors->first('file')}}
                                </div>
                            </div>

                            <div class="mb-3">
                                {{-- <input type="submit" value="Simpan"> --}}
                                <button type="submit" class="btn btn-secondary text-dark" {{$kelompok !=null &&
                                    $kelompok->approval_status == 'waiting' || $kelompok->approval_status == 'approved'
                                    ? 'disabled' : null }}>Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection