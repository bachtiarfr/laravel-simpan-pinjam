@extends('layouts.app')

@section('title', 'Data Pinjaman')

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
                            @elsecan('isPegawai')
                                <li class="breadcrumb-item"><a href="../">Pegawai</a></li>
                            @elsecan('isKelompok')
                                <li class="breadcrumb-item"><a href="../">Anggota</a></li>
                            @endcan
                            <li class="breadcrumb-item active" aria-current="page">Pinjaman</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Pinjaman</h2>
                    <p class="mb-0">Daftar semua pinjaman yang diajukan kelompok.</p>
                </div>



                <div class="btn-toolbar mb-md-0 mb-2">
                    @can('isDirektur')
                        <div class="btn-group ms-lg-3 ms-2">
                            <a href="{{ route('pinjaman.pdf') }}" class="btn btn-sm btn-outline-gray-600">Export PDF</a>
                            <a href="{{ route('pinjaman.excel') }}" class="btn btn-sm btn-outline-gray-600">Export Excel</a>
                        </div>
                    @endcan
                </div>

                {{-- <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group">
                        <a href="{{ route('pinjaman.pdf') }}" class="btn btn-sm btn-outline-danger">Export PDF</a>
                        <a href="{{ route('pinjaman.excel') }}" class="btn btn-sm btn-outline-success">Export Excel</a>
                    </div>
                </div> --}}
            </div>
            <div class="card border-light components-section shadow-sm">

                <div class="card-body">
                    <div class="row">
                        <table class="table-hover table" id="pinjamanTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Kelompok</th>
                                    <th>Nominal</th>
                                    <th>Jangka Waktu</th>
                                    <th>Bagi Hasil</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        <footer class="footer section py-2">

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        // AJAX DataTable
        var datatable = $('#pinjamanTable').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            columns: [{
                    "data": 'id',
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'kelompok',
                    name: 'kelompok.nama_kelompok'
                },
                {
                    data: 'nominal',
                    name: 'nominal'
                },
                {
                    data: 'jangka_waktu',
                    name: 'jangka_waktu'
                },
                {
                    data: 'bagi_hasil',
                    name: 'bagi_hasil'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '15%'
                },
            ],

        });
    </script>
@endpush
