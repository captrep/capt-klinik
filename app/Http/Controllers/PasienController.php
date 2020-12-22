<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;

class PasienController extends Controller
{
    public function index(Pasien $pasien, Request $request)
    {
        $keyword = $request->get('search');
        if ($keyword) {   
            $pasien = Pasien::where('nama', 'like', '%'.$keyword.'%')->orderBy('created_at','DESC')->paginate(5);
        }else{
            $pasien = Pasien::orderBy('created_at','DESC')->paginate(5);
        }
        return view('admin/pasien/list', compact('pasien'));
    }

    public function search(Request $request)
    {
        
        
        return view('admin/pasien/list', compact('pasien'));
    }

    public function create()
    {
        return view('admin/pasien/create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required|string',
            'umur' => 'required|numeric|max:100',
            'noktp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required|numeric',
            'status' => 'required',
        ]);

        Pasien::Create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'noktp' => $request->noktp,
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'status' => $request->status,
        ]);

        return redirect(route('pasien'))->withSuccess('Data Berhasil Ditambahkan!');
    }

    public function edit(Pasien $pasien)
    {
        return view('admin/pasien/edit', compact('pasien'));
    }

    public function update(Pasien $pasien)
    {
        $attr =  request()->validate([
            'nama' => 'required|string',
            'umur' => 'required|numeric|max:100',
            'noktp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required|numeric',
            'status' => 'required',
        ]);

        $pasien->update($attr);
        return redirect(route('pasien'))->withSuccess('Data Berhasil Diubah!');
    }

    public function destroy($id)
    {
        Pasien::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Data Berhasil Dihapus!');
    }

    public function register()
    {
        return view('register');
    }

    public function storelanding(Request $request)
    {
        request()->validate([
            'nama' => 'required|string',
            'umur' => 'required|numeric|max:100',
            'noktp' => 'required|numeric',
            'jenkel' => 'required',
            'alamat' => 'required|string',
            'nohp' => 'required|numeric',
        ],[
            'nama.required' => 'Namanya diisi dong, kalo ngga ntar mau dipanggil hey aja?',
            'umur.required' => 'Umurnya diisi dong, kalo ngga ya gimana ya',
            'umur.numeric' => 'Masa isi umur ga pake angka?',
            'umur.max' => 'Maaf kami hanya menerima pasien dengan umur < 100',
            'noktp.required' => 'No ktp wajib diisi dong',
            'noktp.numeric' => 'Isinya pake angka dong, ini kan no ktp bukan no celana',
            'jenkel.required' => 'Jenis kelaminnya dipilih dulu, ntar kami bingung dong heyy',
            'alamat.required' => 'Alamatnya diisi dulu, ntar kami bingung dong heyy',
            'nohp.required' => 'No hpnya diisi dulu, ntar kami bingung dong heyy',
            'nohp.numeric' => 'Isi pake angka dong hey, ini nomer hp bukan nomer celana'
        ]);
        
        Pasien::Create([
            'nama' => $request->nama,
            'umur' => $request->umur,
            'noktp' => $request->noktp,
            'jenkel' => $request->jenkel,
            'alamat' => $request->alamat,
            'nohp' => $request->nohp,
            'status' => 'Belum Aktif',
        ]);
        
        session()->flash('success');
        return redirect(route('register.pasien'))->withSuccess('Data Berhasil Diubah!');
    }

    public function konfirmasi($pasien)
    {
        $pasien = Pasien::find($pasien);
        $pasien->status = 'Aktif';
        $pasien->save();
        return redirect(route('dashboard'))->withSuccess('Pasien berhasil dikonfirmasi');
    }
}
