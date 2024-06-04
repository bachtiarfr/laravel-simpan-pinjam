<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengaturan;
use Yajra\DataTables\Facades\DataTables;


class PengaturanController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = Pengaturan::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '    <div class="btn-group">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-sm">
                            <span class="fas fa-ellipsis-h icon-dark"></span>
                        </span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                        <a class="dropdown-item" href="' . route('pengaturan.edit', $item->id) . '"><span class="fas fa-eye mr-2"></span>Details</a>
                        <form action="' . route('pengaturan.destroy', $item->id) . '" method="POST">
                                            ' . method_field('delete') . csrf_field() . '
                                            <button type="submit" class="dropdown-item text-danger">
                                            <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                            </button>
                                        </form>
                    </div>
                </div>';
                })
                ->editColumn('waktu_pinjaman', function ($item) {
                    return $item->waktu_pinjaman . " Bulan";
                })
                ->editColumn('max_pinjaman', function ($item) {
                    return "Rp." . number_format($item->max_pinjaman, 0, ',', '.');
                })
                ->editColumn('jasa_pinjam', function ($item) {
                    return $item->jasa_pinjam . " %";
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }

        return view('pengaturan.index');
    }



    public function show()
    {
        $pengaturan = Pengaturan::select('*')->first();
        return view('pengaturan.index', compact('pengaturan'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'waktu_pinjaman' => 'required|numeric',
            'max_pinjaman' => 'required|numeric',
            'jasa_pinjam' => 'required|numeric'
        ]);

        $data = $request->all();

        Pengaturan::where('id', $id)->update([
            'waktu_pinjaman' => $request->waktu_pinjaman,
            'max_pinjaman' => $request->max_pinjaman,
            'jasa_pinjam' => $request->jasa_pinjam,
        ]);

        return redirect()->route('pengaturan.show')
            ->with(['status' => 'Data Simpanan Berhasil Diupdate']);
    }
}
