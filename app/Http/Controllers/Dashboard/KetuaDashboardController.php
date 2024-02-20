<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pinjaman;
use App\Kelompok;
use App\User;

class KetuaDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'pinjaman' => Pinjaman::all()->count(),
            'kelompok'  => Kelompok::all()->count(),
            'user'     => User::all()->count(),
        ];

        return view('ketua.dashboard.index', $data);
    }
}
