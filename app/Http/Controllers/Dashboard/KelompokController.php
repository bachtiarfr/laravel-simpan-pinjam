<?php

namespace App\Http\Controllers\Dashboard;

use App\AnggotaKelompok;
use App\Http\Controllers\Controller;
use App\JenisKelompok;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelompokController extends Controller
{

    public function showUEP()
    {
        if (request()->ajax()) {
            $query = AnggotaKelompok::select('anggota_kelompok.id', 'anggota_kelompok.no_ktp', 'anggota_kelompok.nama_kelompok', 'anggota_kelompok.alamat', 'anggota_kelompok.telepon', 'anggota_kelompok.deleted_at', 'jenis_kelompok.name AS jenis_kelompok', 'dokumen_administrasi.status_persetujuan')
            ->join('jenis_kelompok', 'jenis_kelompok.id', '=', 'anggota_kelompok.jenis_kelompok_id')
            ->join('dokumen_administrasi', 'anggota_kelompok.user_id', '=', 'dokumen_administrasi.user_id')
            ->where('jenis_kelompok_id', '=', 1);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return  $item->status_persetujuan == 'disetujui' ? '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1 btn-sm" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('kelompok.detail', $item->id) . '">
                                        Detail
                                    </a>
                                    <form action="' . route('kelompok.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>' : '
                    <a class="btn btn-secondary mr-1 mb-1 btn-sm" href=""><span>Detail</span></a>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('kelompok.kelompok_index');
    }

    public function showSPP()
    {
        if (request()->ajax()) {
            $query = AnggotaKelompok::select('anggota_kelompok.id', 'anggota_kelompok.no_ktp', 'anggota_kelompok.nama_kelompok', 'anggota_kelompok.alamat', 'anggota_kelompok.telepon', 'anggota_kelompok.deleted_at', 'jenis_kelompok.name AS jenis_kelompok', 'dokumen_administrasi.status_persetujuan')
            ->join('jenis_kelompok', 'jenis_kelompok.id', '=', 'anggota_kelompok.jenis_kelompok_id')
            ->join('dokumen_administrasi', 'anggota_kelompok.user_id', '=', 'dokumen_administrasi.user_id')
            ->where('jenis_kelompok_id', '=', 2);            

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return 
                        '<form action="' . route('kelompok.destroy', $item->id) . '" method="POST">
                        ' . method_field('delete') . csrf_field() . '
                        <div class="btn-group">
                        <a class="btn btn-primary mr-1 mb-1 btn-sm" href="' . route('kelompok.detail', $item->id) . '">
                        Detail
                        </a>
                        <button class="btn btn-primary mr-1 mb-1 btn-sm" type="submit">
                            Hapus
                        </button>
                        </div>
                        </form>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('kelompok.kelompok_index');
    }

    public function detail($k)
    {
        $kelompok = AnggotaKelompok::select('anggota_kelompok.id', 'anggota_kelompok.no_ktp', 'anggota_kelompok.nama_kelompok', 'anggota_kelompok.alamat', 'anggota_kelompok.telepon', 'anggota_kelompok.deleted_at', 'jenis_kelompok.name AS jenis_kelompok', 'dokumen_administrasi.status_persetujuan', 'dokumen_administrasi.path', 'users.nama_user AS nama_ketua_kelompok')
        ->join('jenis_kelompok', 'jenis_kelompok.id', '=', 'anggota_kelompok.jenis_kelompok_id')
        ->join('dokumen_administrasi', 'anggota_kelompok.user_id', '=', 'dokumen_administrasi.user_id')
        ->join('users', 'anggota_kelompok.user_id', '=', 'users.id')
        ->where('anggota_kelompok.id', '=', $k)->first();

        return view('kelompok.kelompok_show', compact('kelompok'));
    }


    public function create()
    {
        $jenis_kelompok = JenisKelompok::all();
        $users = User::select('users.id', 'users.nama_user')->where('roles', '=', 'kelompok')
        ->join('dokumen_administrasi', 'dokumen_administrasi.user_id', '=', 'users.id')
        ->where('dokumen_administrasi.status_persetujuan', '=', 'disetujui');
        return view('kelompok.kelompok_create', compact('jenis_kelompok', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:anggota_kelompok|digits:16',
            'nama_kelompok' => 'required|string|max:100',
            'alamat' => 'required|max:200',
            'telepon' => 'required|max:12',
            'user_id' => 'required|numeric',
            'jenis_kelompok_id' => 'required|numeric' ,
        ]);


        $cek_kelompok = AnggotaKelompok::find($request->id_kelompok);

        if ($cek_kelompok) {
            return redirect()->route('pinjaman.create')->with(['error' => 'Ketua kelompok sudah pernah mendaftarkan kelompok']);
        }


        $kelompok = new AnggotaKelompok();
        $kelompok->no_ktp = $request->no_ktp;
        $kelompok->nama_kelompok = $request->nama_kelompok;
        $kelompok->alamat = $request->alamat;
        $kelompok->telepon = $request->telepon;
        $kelompok->user_id = $request->user_id;
        $kelompok->jenis_kelompok_id = $request->jenis_kelompok_id;
        $kelompok->save();


        //TODO add redirect to kelompok list and has notification
        return redirect()->route('kelompok.index')->with(['status' => 'Data kelompok berhasil ditambahkan']);
    }

    public function destroy($k)
    {
        $kelompok = AnggotaKelompok::findOrFail($k);
        $kelompok->forceDelete();
        return redirect()->route('kelompok.index')
            ->with(['status' => 'Data Kelompok Berhasil Dihapus']);
    }

    public function pengajuan_kelompok()
    {
        return view('kelompok.pengajuan_kelompok');
    }

    




}
