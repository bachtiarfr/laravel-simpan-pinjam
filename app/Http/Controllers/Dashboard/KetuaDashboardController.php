<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Pinjaman;
use App\Kelompok;
use App\User;

class KetuaDashboardController extends Controller
{
    public function index()
    {

        $data = [
            'total_pinjaman' => 'Rp ' . number_format(Pinjaman::sum('total'), 0, ',', '.'),
            'pinjaman' => Pinjaman::all()->count(),
            'pinjaman_lunas' => Pinjaman::all()->where('status', 'lunas')->count(),
            'kelompok'  => Kelompok::all()->count(),
            'user'     => User::all()->count(),
            'butuh_verifikasi'     => Kelompok::all()->where('approval_status', 'waiting')->count(),
            'terverifikasi'     => Kelompok::all()->where('approval_status', 'approved')->count(),
        ];

        return view('ketua.dashboard.index', $data);
    }
}
