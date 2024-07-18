@extends('layouts.app')

@section('title', 'Data User')

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
                            <li class="breadcrumb-item"><a href="../pegawai">Pegawai</a></li>

                            @if (Route::is('user.index'))
                                <li class="breadcrumb-item active" aria-current="page">User</li>
                            @elseif (Route::is('show.direktur.index'))
                                <li class="breadcrumb-item active" aria-current="page">Direktur</li>
                            @elseif (Route::is('show.pegawai.index'))
                                <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
                            @endif
                        </ol>
                    </nav>

                    @if (Route::is('user.index'))
                        <h2 class="h4">User</h2>
                        <p class="mb-0">Data user yang telah terdaftar.</p>
                    @elseif (Route::is('show.direktur.index'))
                        <h2 class="h4">Direktur</h2>
                        <p class="mb-0">Data direktur yang telah terdaftar.</p>
                    @elseif (Route::is('show.admin.index'))
                        <h2 class="h4">Admin</h2>
                        <p class="mb-0">Data admin yang telah terdaftar.</p>
                    @endif
                </div>
            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <div class="row">

                        <table class="table-hover table" id="userTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Roles</th>
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
        var datatable = $('#userTable').DataTable({
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
                    data: 'nama_user',
                    name: 'nama_user'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'roles',
                    name: 'roles'
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
