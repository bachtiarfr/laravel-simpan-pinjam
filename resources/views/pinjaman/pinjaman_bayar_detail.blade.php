@extends('layouts.app')

@section('title', 'Detail Pinjaman')

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

                            <li class="breadcrumb-item"><a href="../kelompok">Kelompok</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                    <h2 class="h4">Edit User</h2>
                    <p class="mb-0">Ubah data user.</p>
                </div>
            </div>
            <div class="card border-light components-section shadow-sm">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-4 col-sm-6">
                            <h4>Detail Pinjaman</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jumlah Pinjaman</th>
                                        <td>{{ $data_pinjaman->nominal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bayar Pokok </th>
                                        <td>{{ $data_pinjaman->bayar_pokok }}%</td>
                                    </tr>
                                    <tr>
                                        <th>Jangka Waktu</th>
                                        <td>{{ $data_pinjaman->jangka_waktu }} bulan</td>
                                    </tr>
                                    <tr>
                                        <th>Bagi hasil</th>
                                        <td>{{ $data_pinjaman->bagi_hasil }}% ( {{ $data_pinjaman->hasil_bagi }} )</td>
                                    </tr>
                                    <tr>
                                        <th>Perbulan</th>
                                        <td>{{ $data_pinjaman->bayar_perbulan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>{{ $data_pinjaman->total }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pinjaman</th>
                                        <td>{{ $data_pinjaman->status }}</td>
                                    </tr>
                                    <tr>
                                        <th>Keterangan</th>
                                        <td>-</td>
                                    </tr>
                                </thead>
                            </table>
                            <br>

                        </div>
                    </div>

                    <form
                        action="{{ route('pinjaman.bayar.post', ['id' => $data_pinjaman->id, 'bayarpinjamid' => $detail_pinjaman->id]) }}"
                        method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                            <input type="text"
                                class="form-control {{ $errors->first('tanggal_jatuh_tempo') ? 'is-invalid' : '' }}"
                                id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo"
                                value="{{ date('d-m-Y', strtotime($detail_pinjaman->jatuh_tempo)) }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('tanggal_jatuh_tempo') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_bayar">Tanggal Pembayaran</label>
                            <input type="text"
                                class="form-control {{ $errors->first('tanggal_bayar') ? 'is-invalid' : '' }}"
                                id="tanggal_bayar" name="tanggal_bayar" value="{{ date('d-m-Y', strtotime('now')) }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('tanggal_bayar') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="telat">Telat (hari)</label>

                            <input type="text" class="form-control {{ $errors->first('telat') ? 'is-invalid' : '' }}"
                                id="telat" name="telat" readonly value="{{ $telat_hari }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('telat') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="denda">Denda</label>
                            <input type="text" class="form-control {{ $errors->first('denda') ? 'is-invalid' : '' }}"
                                id="denda" name="denda" readonly value="{{ $denda }}">
                            <div class="invalid-feedback">
                                {{ $errors->first('denda') }}
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="textarea">Keterangan</label>
                            <textarea class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" placeholder="Tulis keterangan..."
                                id="keterangan" name="keterangan" rows="4"></textarea>
                            <div class="invalid-feedback">
                                {{ $errors->first('keterangan') }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-secondary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
