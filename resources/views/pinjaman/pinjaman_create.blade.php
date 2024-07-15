@extends('layouts.app')

@section('title', 'Tambah Pinjaman')

@section('content')

    @if ($message = Session::get('success'))
        @push('scripts')
            <script>
                swal({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    button: false,
                    timer: 3000
                });
            </script>
        @endpush
    @endif

    @if ($message = Session::get('error'))
        @push('scripts')
            <script>
                swal({
                    title: "Gagal!",
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
                            <li class="breadcrumb-item"><a href="../pinjaman">Pinjaman</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Buat Pinjaman</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Buat Pinjaman</h2>
                    <p class="mb-0">Catat pinjaman yang diajukan kelompok.</p>
                </div>
            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <form action="{{ route('pinjaman.store') }}" method="post">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <label for="id_kelompok">ID Kelompok</label>
                                    <select class="form-select {{ $errors->first('id_kelompok') ? 'is-invalid' : '' }}"
                                        name="id_kelompok" id="id_kelompok">
                                        <option value=""></option>
                                        @foreach ($data_kelompok as $kelompok)
                                            <option value="{{ $kelompok->id }}">{{ $kelompok->nama_kelompok }} -
                                                {{ $kelompok->no_ktp }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('id_kelompok') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="nominal">Jumlah</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('nominal') ? 'is-invalid' : '' }}"
                                        id="nominal" name="nominal" autocomplete="off">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nominal') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="bagi_hasil">Bagi Hasil (%)</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('bagi_hasil') ? 'is-invalid' : '' }}"
                                        id="bagi_hasil" name="bagi_hasil" value="20" disabled readonly>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('bagi_hasil') }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <label for="nama_kelompok">Nama Kelompok</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('nama_kelompok') ? 'is-invalid' : '' }}"
                                        id="nama_kelompok" name="nama_kelompok">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_kelompok') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="jangka_waktu">Jangka Waktu (Bulan)</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('jangka_waktu') ? 'is-invalid' : '' }}"
                                        id="jangka_waktu" name="jangka_waktu" value="" autocomplete="off">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('jangka_waktu') }}
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="perbulan">Perbulan</label>
                                    <input type="text"
                                        class="form-control {{ $errors->first('perbulan') ? 'is-invalid' : '' }}"
                                        id="perbulan" name="perbulan">
                                    <div class="invalid-feedback">
                                        {{ $errors->first('perbulan') }}
                                    </div>
                                </div>

                            </div>

                            <div class="col-sm-12">
                                <div class="my-4">
                                    <label for="textarea">Keterangan</label>
                                    <textarea class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" placeholder="Tulis keterangan..."
                                        id="keterangan" name="keterangan" rows="4"></textarea>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('keterangan') }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            document.getElementById("id_kelompok").addEventListener("change", function(e) {
                let get_kelompok = this.options[this.selectedIndex].text.slice(0, -6);
                document.getElementById("nama_kelompok").value = get_kelompok;
            });

            const nominal = document.getElementById('nominal');
            const jangka_waktu = document.getElementById('jangka_waktu');

            nominal.addEventListener('keyup', updatePerbulan);
            jangka_waktu.addEventListener('keyup', updatePerbulan);

            function updatePerbulan() {
                const pinjam = parseFloat(nominal.value) || 0;
                const waktu = parseFloat(jangka_waktu.value) || 0;

                if (pinjam > 0 && waktu > 0) {
                    const bagi_hasil = 20 / 100;
                    const pokok = pinjam / waktu;
                    const bagiHasil = bagi_hasil * pinjam;
                    const total = pokok + bagiHasil;
                    document.getElementById('perbulan').value = total.toFixed(2);
                } else {
                    document.getElementById('perbulan').value = 0;
                }
            }
        </script>
    @endpush
