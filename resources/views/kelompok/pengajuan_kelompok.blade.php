@extends('layouts.app')

@section('title', 'Data Pengajuan')

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
                            <li class="breadcrumb-item active" aria-current="page">Kelompok</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Pengajuan Kelompok</h2>
                    <p class="mb-0">Daftar user yang mengajukan kelompok.</p>
                </div>
            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <br>

                    <table class="table-hover table-striped table" id="KetuaShowKelompokData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Ketua Kelompok</th>
                                <th>Dokumen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
                <footer class="footer section py-2">
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // AJAX DataTable
        var datatable = $('#KetuaShowKelompokData').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'file_dokumen',
                    name: 'file_dokumen'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '20%',
                },
            ]
        });

        var datatable = $('#DirekturShowPengajuanKelompokData').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'file_dokumen',
                    name: 'file_dokumen'
                },
            ]
        });
    </script>
@endpush


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action={{ route('approval.pengajuan.kelompok') }} method="post">
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
