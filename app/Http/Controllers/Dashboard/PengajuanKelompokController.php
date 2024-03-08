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
        $kelompok = Kelompok::select('kelompok.id', 'kelompok.approval_status','kelompok.approval_reason','kelompok.no_ktp', 'kelompok.nama_kelompok', 'kelompok.alamat', 'kelompok.telepon', 'kelompok.deleted_at', 'jenis_kelompok.name AS jenis_kelompok', 'kelompok.approval_status')->join('jenis_kelompok', 'jenis_kelompok.id', '=', 'kelompok.jenis_kelompok_id')->where('user_id','=',Auth::user()->id)->first();
        //  Kelompok::all()->where('user_id','=',Auth::user()->id)->first();
        return view('kelompok.pengajuan_kelompok', compact('jenis_kelompok','kelompok'));
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
        $kelompok->approval_status = 'waiting';
        $kelompok->approval_reason = '';
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
