@extends('layouts.app')

@section('title', 'Tambah Pengaturan')

@section('content')

@if (session('success'))
@push('scripts')
<script>
    swal({
        title: "Good job!",
        text: "{{ session('success') }}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif


<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Pengaturan</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('pengaturan.store') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-5 col-sm-6">
                            <div class="mb-3">
                                <label for="waktu_pinjaman">Waktu Pinjaman (Bulan)</label>
                                <input type="number"
                                    class="form-control {{ $errors->first('waktu_pinjaman') ? 'is-invalid' : '' }}"
                                    id="waktu_pinjaman" name="waktu_pinjaman" value="{{ old('waktu_pinjaman')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('waktu_pinjaman')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="max_pinjaman">Maksimum Pinjaman</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('max_pinjaman') ? 'is-invalid' : '' }}"
                                    id="max_pinjaman" name="max_pinjaman" value="{{ old('max_pinjaman')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('max_pinjaman')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jasa_pinjam">Jasa Pinjam (%)</label>
                                <input type="number"
                                    class="form-control {{ $errors->first('jasa_pinjam') ? 'is-invalid' : '' }}"
                                    id="jasa_pinjam" name="jasa_pinjam" value="{{ old('jasa_pinjam')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('jasa_pinjam')}}
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
