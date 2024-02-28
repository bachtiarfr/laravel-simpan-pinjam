<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Kelompok;
use App\JenisKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengajuanKelompokController extends Controller
{

    public function create()
    {
        $jenis_kelompok = JenisKelompok::all();
        return view('kelompok.pengajuan_kelompok', compact('jenis_kelompok'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:png,jpg,jpeg|max:2048',
            'no_ktp' => 'required|unique:kelompok|digits:16',
            'nama_kelompok' => 'required|string|max:100',
            'alamat' => 'required|max:200',
            'telepon' => 'required|max:12',
            'jenis_kelompok_id' => 'required|numeric',
        ]);

        $fileName = time().'.'.$request->file->extension();  

        $request->file->move(public_path('docs'), $fileName);

        $kelompok = new Kelompok;
        $kelompok->no_ktp = $request->no_ktp;
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->approved = false;
        $kelompok->alamat = $request->alamat;
        $kelompok->telepon = $request->telepon;
        $kelompok->user_id = Auth::user()->id;
        $kelompok->jenis_kelompok_id = $request->jenis_kelompok_id;
        $kelompok->document_administrations = $fileName;
        $kelompok->save();

        //TODO add redirect to kelompok list and has notification
        return redirect()->route('dashboard.anggota')->with(['status' => 'Data kelompok berhasil di ajukan']);
    }
}
