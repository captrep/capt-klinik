<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokterController extends Controller
{
    public function index(User $user)
    {
        $dokter = User::where('role','dokter')->paginate(5);
        return view('admin/dokter/list', compact('dokter'));
    }

    public function create()
    {
        return view('admin/dokter/create');
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
            'role' => 'dokter',
            'foto' => $foto
        ]);

        return redirect(route('dokter'))->withSuccess('Data Berhasil Ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin/dokter/edit', compact('user'));
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
        return redirect(route('dokter'))->withSuccess('Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $fotodokter = User::find($id)->foto;
        \Storage::delete($fotodokter);
        User::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Data Berhasil Dihapus!');
    }
    
}
