<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Anggota;
use App\JenisKelompok;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnggotaController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = Anggota::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('anggota.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('anggota.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('pengurus', function ($item) {
                    return $item->pengurus == 'pengurus'
                        ? '<span class="text-success">' . $item->pengurus . '</span>'
                        : '<span class="text-warning">' . $item->pengurus . '</span>';
                })
                ->rawColumns(['action', 'pengurus'])
                ->make();
        }

        return view('admin.member.anggota_index');
    }

    public function create()
    {
        $jenis_kelompok = JenisKelompok::all();
        return view('admin.member.anggota_create', compact('jenis_kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:anggota|digits:16',
            'nama_anggota' => 'required|string|max:100',
            'alamat' => 'required|max:200',
            'kota' => 'required|max:20',
            'telepon' => 'required|max:12',
            'jenis_kelompok_id' => 'required|numeric',
        ]);



        $anggota = new Anggota;
        $anggota->no_ktp = $request->no_ktp;
        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->alamat = $request->alamat;
        $anggota->kota = $request->kota;
        $anggota->telepon = $request->telepon;
        $anggota->jenis_kelompok_id = $request->jenis_kelompok_id;
        $anggota->save();


        //TODO add redirect to anggota list and has notification
        return redirect()->route('anggota.create')->with(['status' => 'Data Anggota Berhasil Ditambahkan']);
    }

    public function show(Anggota $anggota)
    {
        //
    }

    public function edit($anggotum)
    {
        $anggota = Anggota::Find($anggotum);
        return view('admin.member.anggota_show', compact('anggota'));
    }

    public function update(Request $request, $anggotum)
    {
        $request->validate([
            'no_ktp' => 'required|digits:16|unique:anggota,no_ktp,' . $anggotum,
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'pengurus' => 'required'
        ]);

        $anggota = Anggota::findOrFail($anggotum);
        $data = $request->all();

        $anggota->update($data);
        return redirect()->route('anggota.index')->with(['status' => 'Data Berhasil Diubah']);
    }

    public function destroy($anggotum)
    {
        $anggota = Anggota::findOrFail($anggotum);
        $anggota->forceDelete();
        return redirect()->route('anggota.index')
            ->with(['status' => 'Data unit Berhasil Dihapus']);
    }
}
