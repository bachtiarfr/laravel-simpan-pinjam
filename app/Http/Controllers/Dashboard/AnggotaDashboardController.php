<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Rules\UserOldPassword;
use Illuminate\Support\Facades\Hash;

class AnggotaDashboardController extends Controller
{
    public function index()
    {
        return view('anggota.dashboard.index');
    }

    public function profile()
    {
        return view('anggota.dashboard.profile');
    }
}
