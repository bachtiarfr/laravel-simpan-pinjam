<?php

namespace App\Http\Controllers\Dashboard;

use App\AnggotaKelompok;
use App\Http\Controllers\Controller;
use App\Pinjaman;
use App\User;
use App\DokumenAdministrasi;

class DirekturDashboardController extends Controller
{
    public function index()
    {

        $data = [
            'total_pinjaman' => 'Rp ' . number_format(Pinjaman::sum('total'), 0, ',', '.'),
            'pinjaman' => Pinjaman::all()->count(),
            'pinjaman_lunas' => Pinjaman::all()->where('status', 'lunas')->count(),
            'kelompok'  => AnggotaKelompok::all()->count(),
            'user'     => User::all()->count(),
            'butuh_verifikasi'     => DokumenAdministrasi::all()->where('status_persetujuan', 'menunggu')->count(),
            'terverifikasi'     => DokumenAdministrasi::all()->where('status_persetujuan', 'disetujui')->count(),
        ];

        return view('ketua.dashboard.index', $data);
    }
}
