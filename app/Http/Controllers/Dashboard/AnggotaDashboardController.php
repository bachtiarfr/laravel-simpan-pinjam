<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Kelompok;

class AnggotaDashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $kelompok_data = Kelompok::select('*')->where('user_id', '=', $user_id)->first();
        return view('anggota.dashboard.index', compact('kelompok_data'));
    }

    public function profile()
    {
        return view('anggota.dashboard.profile');
    }
}
