@extends('layouts.app')

@section('title', 'Data Anggota')

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

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent p-0">
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
                        <li class="breadcrumb-item active text-primary" aria-current="page">Kelompok</li>
                    </ol>
                </nav>
                <h2 class="h4 text-primary">Kelompok</h2>
                <p class="text-secondary mb-0">Daftar semua kelompok yang dapat mengajukan peminjaman.</p>
            </div>
        </div>
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <table class="table-hover table-striped table" id="ShowKelompokData">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. KTP</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Jenis Kelompok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <footer class="footer section py-2"></footer>
        </div>
        <div class="py-4">
            <a href="{{ route('kelompok.create') }}" class="btn btn-primary">Tambah Kelompok</a>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // AJAX DataTable
        var datatable = $('#ShowKelompokData').DataTable({
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
                    data: 'no_ktp',
                    name: 'no_ktp'
                },
                {
                    data: 'nama_kelompok',
                    name: 'nama_kelompok'
                },
                {
                    data: 'telepon',
                    name: 'telepon'
                },
                {
                    data: 'jenis_kelompok',
                    name: 'jenis_kelompok'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '20%'
                },
            ]
        });
    </script>
@endpush
