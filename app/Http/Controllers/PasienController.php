<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exports\PasienExport;
use Illuminate\Http\Request;
use App\Pasien;
use App\Testimonial;
use Maatwebsite\Excel\Facades\Excel;

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

    public function exportExcel()
    {
        return Excel::download(new PasienExport, 'ListPasien.xlsx');
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
        
        $checkData = Pasien::where('notkp',$request()->noktp);
        dd($checkData);
        if (request()->noktp) {
            # code...
        }

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

        $checkData = Pasien::where('noktp',$request->noktp)->first();
        if ($checkData == TRUE) {
            session()->flash('duplicate');
        }else{
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
        }
        return redirect(route('register.pasien'));
    }

    public function konfirmasi($pasien)
    {
        $pasien = Pasien::find($pasien);
        $pasien->status = 'Aktif';
        $pasien->save();
        return redirect(route('dashboard'))->withSuccess('Pasien berhasil dikonfirmasi');
    }

    public function testimonial()
    {
        return view('testimonial');
    }

    public function listTestimonial(Testimonial $testimonial)
    {
        $testimonial = Testimonial::orderBy('created_at','DESC')->paginate(5);
        return view('admin/testimonial/list', compact('testimonial'));
    }

    public function destroyTestimonial($id)
    {
        Testimonial::where('id',$id)->delete();
        return redirect()->back()->withSuccess('Data Berhasil Dihapus!');
    }

    public function storeTestimonial(Request $request)
    {
        request()->validate([
            'noktp' => 'required|numeric',
            'testi' => 'required|string|max:200',
        ],[
            'noktp.required' => 'No ktp wajib diisi dong',
            'noktp.numeric' => 'Isinya pake angka dong, ini kan no ktp bukan no celana',
            'testi.required' => 'Isi testimonialnya dong kalo ngga apa yg mau ditampilin yakan',
            'testi.string' => 'Isi testimonial menggunakan huruf dan angka',
            'testi.max' => 'Jangan melebihi 200 karakter',
        ]);
        $checkPasien = Pasien::where('noktp',$request->noktp)->first();
        if ($checkPasien == TRUE) {
            $getIdPasien = Pasien::where('noktp',$request->noktp)->pluck('id')->first();
            $checkData = Testimonial::where('pasien_id',$getIdPasien)->first();
            $pasien = Pasien::find($getIdPasien);
            if ($checkData == TRUE) {
                session()->flash('duplicate');
            }elseif ($pasien->status == 'Belum Aktif') {
                session()->flash('inactive');
            }else{
                Testimonial::Create([
                    'pasien_id' => $getIdPasien,
                    'testi' => $request->testi,
                ]);
                session()->flash('success');
            }
        }else{
            session()->flash('notregist');
        }
        return redirect(route('isi.testimonial'));
    }

    public function konfirmasiBayar()
    {
        return view('konfirmasiBayar');
    }

    public function storeKonfirmasiBayar(Request $request)
    {
        request()->validate([
            'noktp' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ],[
            'noktp.required' => 'No ktp wajib diisi dong',
            'noktp.numeric' => 'Isinya pake angka dong, ini kan no ktp bukan no celana',
            'foto.image' => 'Uploadnya harus gambar dong (format :jpg/png/jpeg)',
            'foto.max' => 'Size gambarnya kegedean nih, pake gambar dibawah 2mb aja yaa',
        ]);
        $checkPasien = Pasien::where('noktp',$request->noktp)->first();
        if ($checkPasien == TRUE) {
            $getIdPasien = Pasien::where('noktp',$request->noktp)->pluck('id')->first();
            $pasien = Pasien::find($getIdPasien);
            if ($pasien->status == 'Aktif'){
                session()->flash('confirmed');
            }elseif ($pasien->buktitrf != NULL) {
                session()->flash('duplicate');
            }else{
                $storeFoto = request()->file('foto')->store("images/buktitrf");
                $pasien->buktitrf = $storeFoto; 
                $pasien->save();
                session()->flash('success');
            }
        }else{
            session()->flash('notregist');
        }
        return redirect(route('konfirmasi.bayar'));
    }
}
