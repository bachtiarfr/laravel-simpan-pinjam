<?php

namespace App\Http\Controllers\Dashboard;

use App\AnggotaKelompok;
use App\BayarPinjaman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Pinjaman;
use App\DokumenAdministrasi;

class AnggotaKelompokDashboardController extends Controller
{
    public function index()
    {

        $user_id = Auth::user()->id;
        $kelompok = AnggotaKelompok::select('*')->where('user_id', '=', $user_id)->first();
        $status_pengajuan = DokumenAdministrasi::select('*')->where('user_id', '=', $user_id)->first();

        $data = [
            'total_pinjaman_saat_ini' => 0,
            'total_pinjaman' => 0,
            'status_pengajuan' => '',
        ];

        if ($kelompok != null) {
            $pinjaman_saat_ini = Pinjaman::all()->where('id_kelompok', '=', $kelompok->id)->where('status', '=', 'pending');

            $data = [
                'total_pinjaman_saat_ini' => 'Rp ' . number_format($pinjaman_saat_ini->sum('total'), 0, ',', '.'),
                'total_pinjaman' => 'Rp ' . number_format(Pinjaman::all()->where('id_kelompok', '=', $kelompok->id)->sum('total'), 0, ',', '.'),
                'status_pengajuan' => $status_pengajuan,
            ];
        }
        

        return view('anggota.dashboard.index', $data);
    }

    public function profile()
    {
        return view('anggota.dashboard.profile');
    }
}
