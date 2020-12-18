<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antrian;
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
        $antrianAll = Antrian::paginate(5);
        $antrianMenunggu = Antrian::where([['user_id',$id],['status','Menunggu']])->paginate(5);
        $antrianDilewati = Antrian::where([['user_id',$id],['status','Dilewati']])->paginate(5);
        $antrianAction = Antrian::where('status','Dipanggil')->get();
        return view('admin/dashboard', compact('antrianAll','antrianMenunggu','antrianDilewati','antrianAction'));
    }

    
}
