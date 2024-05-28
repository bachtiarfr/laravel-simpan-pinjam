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
            <li class="breadcrumb-item active" aria-current="page">Data Kelompok</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
                <br>
                @can('isKetua')
                <table class="table table-hover table-striped" id="KetuaShowKelompokData">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. kTP</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Jenis Kelompok</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                @elsecan('isAdmin')
                  <table class="table table-hover table-striped" id="AdminShowKelompokData">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. kTP</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Jenis Kelompok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                @endcan
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
                data: 'approval_status',
                name: 'approval_status',
                // render: 'function (){ return "icikiwir" }',
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

    var datatable = $('#AdminShowKelompokData').DataTable({
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
                data: 'approval_status',
                name: 'approval_status',
                // render: 'function (){ return "icikiwir" }',
            },
        ]
    });

</script>
@endpush
