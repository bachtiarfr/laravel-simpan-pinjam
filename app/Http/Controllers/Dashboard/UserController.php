<?php

namespace App\Http\Controllers\Dashboard;

use App\AnggotaKelompok;
use App\Direktur;
use App\Http\Controllers\Controller;
use App\Pegawai;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\{Storage, Hash};
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function showUser()
    {
        if (request()->ajax()) {
            $query = User::query()->where('roles', '=', 'kelompok');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return 
                    '
                            <form action="' . route('user.delete', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <div class="btn-group">
                                    <a class="btn btn-primary mr-1 mb-1 btn-sm" href="' . route('user.detail', $item->id) . '">
                                    Detail
                                    </a>
                                    <button class="btn btn-primary mr-1 mb-1 btn-sm" type="submit">
                                        Hapus
                                    </button>
                                    </div>
                            </form>
                    ';
                })
                ->editColumn('roles', function ($item) {
                    return $item->roles == 'kelompok'
                        ? '<span>' . 'anggota' . '</span>'
                        : '<span>' . $item->roles . '</span>';
                })
                ->rawColumns(['action', 'roles'])
                ->make();
        }

        return view('admin.user.index');
    }

    public function showPegawai()
    {
        if (request()->ajax()) {
            $query = User::query()->where('roles', '=', 'pegawai');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return 
                    '
                            <form action="' . route('pegawai.delete', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <div class="btn-group">
                                    <a class="btn btn-primary mr-1 mb-1 btn-sm" href="' . route('user.detail', $item->id) . '">
                                    Detail
                                    </a>
                                    <button class="btn btn-primary mr-1 mb-1 btn-sm" type="submit">
                                        Hapus
                                    </button>
                                    </div>
                            </form>
                    ';
                })
                ->editColumn('roles', function ($item) {
                    return '<span class="text-warning">' . $item->roles . '</span>';
                })
                ->rawColumns(['action', 'roles'])
                ->make();
        }

        return view('admin.user.index');
    }

    public function showDirektur()
    {
        if (request()->ajax()) {
            $query = User::query()->where('roles', '=', 'direktur');

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return 
                    '
                            <form action="' . route('direktur.delete', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <div class="btn-group">
                                    <a class="btn btn-primary mr-1 mb-1 btn-sm" href="' . route('user.detail', $item->id) . '">
                                    Detail
                                    </a>
                                    <button class="btn btn-primary mr-1 mb-1 btn-sm" type="submit">
                                        Hapus
                                    </button>
                                    </div>
                            </form>
                    ';
                })
                ->editColumn('roles', function ($item) {
                    return '<span class="text-warning">' . $item->roles . '</span>';
                })
                ->rawColumns(['action', 'roles'])
                ->make();
        }

        return view('admin.user.index');
    }


    public function create()
    {
        return view('admin.user.user_create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nama_user'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3',
            'roles'                 => 'nullable|string|in:pegawai,direktur,kelompok'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('show.user')
            ->with(['status' => 'Data User Berhasil Ditambahkan']);
    }

    public function storeDirektur(Request $request)
    {

        $request->validate([
            'nama_user'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
 
        $new_user = User::create([
            'nama_user' => $data['nama_user'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'roles'     => 'direktur'
        ]);

        Direktur::create([
            'nama_direktur' => $data['nama_user'],
            'user_id' => $new_user['id'],
            'email' => $data['email']
        ]);

        return redirect()->route('show.direktur')
            ->with(['status' => 'Data Direktur Berhasil Ditambahkan']);
    }


    public function storePegawai(Request $request)
    {

        $request->validate([
            'nama_pegawai'          => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3',
            'jenis_kelamin'         => 'required|string|in:laki-laki,perempuan',
            'jabatan'               => 'required|min:3',
            'no_hp'                 => 'required',
            'roles'                 => 'nullable|string|in:pegawai,direktur,anggota'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
 
        $new_user = User::create([
            'nama_user' => $data['nama_pegawai'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'roles'     => 'pegawai'
        ]);

        Pegawai::create([
            'user_id' => $new_user['id'],
            'nama_pegawai' => $data['nama_pegawai'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'jabatan' => $data['jabatan'],
            'no_hp' => $data['no_hp']
        ]);
  
        return redirect()->route('show.pegawai')
            ->with(['status' => 'Data Pegawai Berhasil Ditambahkan']);
    }


    public function detail($id)
    {
        $user = User::select('*')->where('id', '=', $id)->first();
        return view('admin.user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('ketua.user.show', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email,' . $id,
            'password'              => 'sometimes|nullable|min:3',
            'konfirmasi_password'   => 'sometimes|same:password|nullable|min:3',
            'roles'                 => 'nullable|string|in:admin,anggota'
        ]);

        $data = $request->all();
        $user = User::findOrFail($id);


        if ($request->input('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data = Arr::except($data, ['password']);
        }

        $user->update($data);
        return redirect()->route('user.index')->with(['status' => 'Data User ' . $user->name . '  Berhasil Diubah']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('show.user')->with(['status' => 'Data User ' . $user->name . ' Berhasil Dihapus']);
    }

    public function addPegawai()
    {
        return view('admin.user.pegawai_create');
    }

    public function addDirektur()
    {
        return view('admin.user.direktur_create');
    }

    public function pegawaiDelete($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $user = User::findOrFail($pegawai['user_id']);
        $user->delete();
        $pegawai->delete();
        return redirect()->route('show.pegawai.index')->with(['status' => 'Data Pegawai ' . $user->name . ' Berhasil Dihapus']);
    }

    public function direkturDelete($id)
    {
        $direktur = Direktur::findOrFail($id);
        $user = User::findOrFail($direktur['user_id']);
        $user->delete();
        $direktur->delete();
        return redirect()->route('show.direktur.index')->with(['status' => 'Data Direktur ' . $user->name . ' Berhasil Dihapus']);
    }

    public function userDelete($id)
    {
        $user = User::findOrFail($id);
        $kelompok = AnggotaKelompok::where('user_id', '=', $id)->first();
        $kelompok->delete();
        $user->delete();
        
        return redirect()->route('show.user')->with(['status' => 'Data User ' . $user->name . ' Berhasil Dihapus']);
    }
}
