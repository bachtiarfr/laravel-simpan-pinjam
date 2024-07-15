<?php

namespace App\Http\Controllers\Dashboard;

use App\AnggotaKelompok;
use App\Http\Controllers\Controller;
use App\JenisKelompok;
use App\DokumenAdministrasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PengajuanKelompokController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = DokumenAdministrasi::select('dokumen_administrasi.id', 'dokumen_administrasi.path AS file_dokumen', 'dokumen_administrasi.user_id', 'dokumen_administrasi.status_persetujuan', 'dokumen_administrasi.alasan_persetujuan', 'users.nama_user AS user_name')
                ->join('users', 'dokumen_administrasi.user_id', '=', 'users.id')
                ->where('dokumen_administrasi.status_persetujuan', '=', 'menunggu');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return 
                        '<button id="buttonModal" class="btn btn-secondary mr-1 mb-1 btn-sm" data-toggle="modal" data-target="#exampleModal" data-dokumen-id="'. $item->id. '" data-dokumen-path="'. $item->file_dokumen. '"><span>Detail</span></button>';
                })
                ->rawColumns(['file_dokumen','action'])
                ->make();
        }

        return view('kelompok.pengajuan_kelompok');
    }

    public function approval(Request $request){

        $request->validate([
            'id_pengajuan' => 'required',
            'alasan' => 'required|string',
            'status_persetujuan' => 'required',
        ]);
        

        $dokumen = DokumenAdministrasi::findOrFail($request->id_pengajuan);

        if (!$dokumen) {
            return redirect()->route('pengajuan-kelompok.index')->with(['error' => 'Dokument tidak terdaftar']);
        }

        $data = [
            "alasan_persetujuan" => $request->alasan,
            'status_persetujuan' => $request->status_persetujuan,
        ];

        $dokumen->update($data);

        return redirect()->route('pengajuan-kelompok.index')->with(['status' => 'Pengajuan kelompok berhasil diperbarui']);
    }

    public function create()
    {
        $jenis_kelompok = JenisKelompok::all();
        $kelompok = AnggotaKelompok::select('anggota_kelompok.id', 'anggota_kelompok.status_persetujuan','anggota_kelompok.alasan_persetujuan','anggota_kelompok.no_ktp', 'anggota_kelompok.nama_kelompok', 'anggota_kelompok.alamat', 'anggota_kelompok.telepon', 'anggota_kelompok.deleted_at', 'jenis_kelompok.name AS jenis_kelompok', 'anggota_kelompok.status_persetujuan')->join('jenis_kelompok', 'jenis_kelompok.id', '=', 'anggota_kelompok.jenis_kelompok_id')->where('user_id','=',Auth::user()->id)->first();
        $approval_status = false ;
        if ($kelompok != null) {
            $approval_status = $kelompok->approval_status;
        }
        
        return view('kelompok.pengajuan_kelompok', compact('jenis_kelompok','kelompok', 'approval_status'));
    }

    public function store(Request $request)
    {
           
        $fileName = time().'.'.$request->file->extension();  

        $request->file->move(public_path('docs'), $fileName);

        $dokumen = [
            "path" => $fileName,
            "user_id" => Auth::user()->id,
            "alasan_persetujuan" => "",
            "status_persetujuan" => "menunggu",
        ];

        DokumenAdministrasi::create($dokumen);

        //TODO add redirect to kelompok list and has notification
        return redirect()->route('dashboard.anggota_kelompok')->with(['status' => 'Data kelompok berhasil di ajukan']);
    }
}
