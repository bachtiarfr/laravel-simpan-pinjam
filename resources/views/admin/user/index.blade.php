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
                        <li class="breadcrumb-item"><a href="../admin">Admin</a></li>
                        @if (Route::is('show.user'))
                            <li class="breadcrumb-item active text-primary" aria-current="page">User</li>
                        @else
                            <li class="breadcrumb-item active text-primary" aria-current="page">Pegawai</li>
                        @endif
                    </ol>
                </nav>

                @if (Route::is('show.user'))
                    <h2 class="h4 text-primary">User</h2>
                    <p class="text-secondary mb-0">Data user yang telah terdaftar.</p>
                @else
                    <h2 class="h4 text-primary">Pegawai</h2>
                    <p class="text-secondary mb-0">Data pegawai yang telah terdaftar.</p>
                @endif
            </div>
        </div>
        <div class="card border-light shadow-sm">
            <div class="card-body">
                <table class="table-hover table-striped table" id="userTable">
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
            </div>
            <footer class="footer section py-2"></footer>
        </div>
        <div class="py-4">
            @if (Route::is('show.user'))
                <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
            @endif

            @if (Route::is('show.pegawai'))
                <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Pegawai</a>
            @endif

            @if (Route::is('show.direktur'))
                <a href="{{ route('direktur.create') }}" class="btn btn-primary">Tambah Direktur</a>
            @endif
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
