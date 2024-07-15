<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\{Storage, Hash};
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = User::query();

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return   '<div class="btn-group">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-sm">
                            <span class="fas fa-ellipsis-h icon-dark"></span>
                        </span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                        <a class="dropdown-item" href="' . route('user.edit', $item->id) . '"><span class="fas fa-eye mr-2"></span>Details</a>
                        <form action="' . route('user.destroy', $item->id) . '" method="POST">
                                            ' . method_field('delete') . csrf_field() . '
                                            <button type="submit" class="dropdown-item text-danger">
                                            <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                            </button>
                                        </form>
                    </div>
                </div>';
                })
                ->editColumn('roles', function ($item) {
                    return $item->roles == 'admin'
                        ? '<span class="text-warning">' . $item->roles . '</span>'
                        : '<span class="text-success">' . $item->roles . '</span>';
                })
                ->rawColumns(['action', 'roles'])
                ->make();
        }

        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nama_user'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:3',
            'konfirmasi_password'   => 'required|same:password|min:3',
            'roles'                 => 'nullable|string|in:admin,anggota'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);


        User::create($data);
        return redirect()->route('user.index')
            ->with(['status' => 'Data User Berhasil Ditambahkan']);
    }


    public function show($id)
    {
        //
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
        return redirect()->route('user.index')->with(['status' => 'Data User ' . $user->name . ' Berhasil Dihapus']);
    }
}
