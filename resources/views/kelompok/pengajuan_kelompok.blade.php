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

    <div class="container mt-4">
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
                                <li class="breadcrumb-item active" aria-current="page">Pengajuan Kelompok</li>
                            </ol>
                        </nav>
                        <h2 class="h4">Pengajuan Kelompok</h2>
                        <p class="mb-0">Daftar user yang mengajukan kelompok.</p>
                    </div>
                </div>
                <div class="card border-light components-section shadow-sm">
                    <div class="card-body">
                        <table class="table-hover table-striped table" id="ShowKelompokData">
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
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('approval.pengajuan.kelompok') }}" method="post">
                    @csrf
                    <input type="hidden" id="id_pengajuan" name="id_pengajuan">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Dokumen Pengajuan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-4">
                                <embed id="documentEmbed" src="" width="600" height="500" alt="pdf"
                                    class="rounded border" />
                                <div class="my-3">
                                    <label for="alasan">Alasan</label>
                                    <textarea class="form-control {{ $errors->first('alasan') ? 'is-invalid' : '' }}"
                                        placeholder="Tulis alasan penolakan / disetujui terkait pengajuan ini..." id="alasan" name="alasan"
                                        rows="4">{{ old('alasan') }}</textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('alasan') }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="aksi_id">Aksi</label>
                                    <select
                                        class="form-select {{ $errors->first('status_persetujuan') ? 'is-invalid' : '' }}"
                                        name="status_persetujuan" id="aksi_id">
                                        <option value="">Pilih Aksi</option>
                                        <option value="disetujui">Setuju</option>
                                        <option value="ditolak">Tolak</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('status_persetujuan') }}
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary p-2">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const documentEmbed = document.getElementById('documentEmbed');

            // Function to attach event listeners
            function attachEventListeners() {
                document.querySelectorAll('button[data-toggle="modal"]').forEach(button => {
                    button.addEventListener('click', function() {
                        const documentId = this.getAttribute('data-dokumen-id');
                        const documentPath = this.getAttribute('data-dokumen-path');
                        const documentUrl = `{{ asset('docs') }}/${documentPath}`;

                        document.getElementById('id_pengajuan').value = documentId;

                        // Update the embed source
                        documentEmbed.setAttribute('src', documentUrl);
                    });
                });
            }

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
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'file_dokumen',
                        name: 'file_dokumen',
                        render: function(data) {
                            return `<a href="{{ asset('docs') }}/${data}" target="_blank">Lihat Dokumen</a>`;
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%',
                    },
                ],
                drawCallback: function() {
                    // Attach event listeners after DataTables has finished rendering
                    attachEventListeners();
                }
            });

            // Initial attachment of event listeners
            attachEventListeners();
        });
    </script>
@endpush
