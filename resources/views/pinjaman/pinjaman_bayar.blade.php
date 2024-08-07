@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')

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

                                <li class="breadcrumb-item active" aria-current="page">Detail Pinjaman</li>
                            </ol>
                        </nav>
                        <h2 class="h4">Detail Pinjaman</h2>
                        <p class="mb-0">Detail dan histori pinjaman.</p>
                    </div>
                </div>
                <div class="card border-light components-section shadow-sm">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <h4>Detail Pinjaman</h4>
                                <table class="table-bordered table">
                                    <tbody>
                                        <tr>
                                            <th>Jumlah Pinjaman</th>
                                            <td>@currency($data_pinjaman->nominal)</td>
                                        </tr>
                                        <tr>
                                            <th>Bayar Pokok</th>
                                            <td>@currency($data_pinjaman->bayar_pokok)</td>
                                        </tr>
                                        <tr>
                                            <th>Jangka Waktu</th>
                                            <td>{{ $data_pinjaman->jangka_waktu }} bulan</td>
                                        </tr>
                                        <tr>
                                            <th>Perbulan</th>
                                            <td>@currency($data_pinjaman->bayar_perbulan)</td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>@currency($data_pinjaman->total)</td>
                                        </tr>
                                        <tr>
                                            <th>Status Pinjaman</th>
                                            <td>
                                                @if ($data_pinjaman->status != 'lunas')
                                                    <span class="text-danger">BELUM LUNAS</span>
                                                @else
                                                    <span class="text-success">LUNAS</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Keterangan</th>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <h4>Histori Pembayaran Angsuran</h4>

                        <table class="table-hover table-bordered table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Nominal</th>
                                    <th>Denda</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail_pinjaman as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->jatuh_tempo }}</td>
                                        <td>{{ $data->tanggal_bayar ?? '-' }}</td>
                                        <td>@currency($data->nominal)</td>
                                        <td>@currency($data->denda)</td>
                                        <td>{{ $data->keterangan ?? '-' }}</td>
                                        <td>
                                            @if (!$data->tanggal_bayar)
                                                @can('isAdmin')
                                                    <a href="{{ route('pinjaman.bayar.detail', ['id' => $data_pinjaman->id, 'bayarpinjamid' => $data->id]) }}"
                                                        class="btn btn-sm btn-primary">Bayar</a>
                                                @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3">
                                        <h4>Total</h4>
                                    </td>
                                    <td>
                                        <h5>@currency($total_bayar)</h5>
                                    </td>
                                    <td>
                                        @if ($count_sudah_bayar == $data_pinjaman->jangka_waktu)
                                            <button class="btn btn-sm btn-success" type="button">LUNAS</button>
                                        @endif
                                    </td>
                                    <td colspan="2"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
