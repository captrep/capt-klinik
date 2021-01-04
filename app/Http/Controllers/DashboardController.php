<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antrian;
use App\User;
use App\Pasien;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Antrian $antrian)
    {
        $id = Auth::user()->id;
        $pasien = Pasien::where('status','Belum Aktif')->orderBy('created_at','DESC')->paginate(10);
        $antrianAll = Antrian::paginate(10);
        $antrianMenunggu = Antrian::where([['user_id',$id],['status','Menunggu']])->paginate(10);
        $antrianDilewati = Antrian::where([['user_id',$id],['status','Dilewati']])->paginate(10);
        $antrianAction = Antrian::where([['user_id',$id],['status','Dipanggil']])->orWhere([['user_id',$id],['status','Diperiksa']])->first();
        $antrianSelesai = Antrian::where([['user_id',$id],['status','Selesai']])->paginate(10);
        $totalDokter = User::where('role','dokter')->count();
        $totalStaff = User::where('role','staff')->count();
        $totalPasien = Pasien::count();
        $admin = [
            'totalDokter' => $totalDokter, 
            'totalPasien' => $totalPasien, 
            'totalStaff' => $totalStaff,
            'antrian' => $antrianAll->count()];
            


        return view('admin/dashboard', compact('antrianAll','antrianMenunggu','antrianDilewati','antrianAction','antrianSelesai','pasien','admin'));  
    }

    public function bukaPraktek()
    {
        $dokter = User::find(Auth::user()->id);
        $dokter->status = 'Buka';
        $dokter->save();
        return redirect(route('dashboard'))->withSuccess('Praktek dibuka');
    }

    public function tutupPraktek()
    {
        $dokter = User::find(Auth::user()->id);
        $dokter->status = 'Tutup';
        $dokter->save();
        return redirect(route('dashboard'))->withSuccess('Praktek ditutup');
    }

    public function clearCache()
    {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::Call('view:clear');
        return "dah beres";
    }

    public function storageLink()
    {
        Artisan::call('storage:link');
        return "sukses";
    }

    
}
