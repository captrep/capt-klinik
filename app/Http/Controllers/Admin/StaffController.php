<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(User $user)
    {
        $staff = User::where('role','staff')->paginate(5);
        return view('admin/staff/list', compact('staff'));
    }

    public function create()
    {
        return view('admin/staff/create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|string',
            'username' => 'required|string|min:6|alpha_num',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users',
            'jabatan' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        if (request()->file('foto')) {
            $foto = request()->file('foto')->store("images/users");
        }else{
            $foto = null;
        }
        User::Create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'role' => 'staff',
            'foto' => $foto
        ]);

        return redirect(route('staff'))->withSuccess('Data Berhasil Ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin/staff/edit', compact('user'));
    }

    public function update(User $user)
    {
        $attr =  request()->validate([
            'name' => 'required|string',
            'username' => 'required|string|min:6|alpha_num',
            'email' => 'required|string|email|max:255',
            'jabatan' => 'required|string',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        if (request()->file('foto')) {
            \Storage::delete($user->foto);
            $foto = request()->file('foto')->store("images/users");
        }else{
            $foto = $user->foto;
        }

        $attr['foto'] = $foto;
        $user->update($attr);
        return redirect()->route('staff')->withSuccess('Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $fotostaff = User::where('id',$id)->pluck('foto');
        foreach ($fotostaff as $foto) {
            $foto = $foto;
        }
        \Storage::delete($foto);
        User::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Data Berhasil Dihapus!');
    }
}
