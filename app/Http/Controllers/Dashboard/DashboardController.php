<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pinjaman;
use App\AnggotaKelompok;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pinjaman' => Pinjaman::all()->count(),
            'anggota'  => AnggotaKelompok::all()->count(),
            'user'     => User::all()->count(),
        ];

        return view('direktur.dashboard.index', $data);
    }
}
