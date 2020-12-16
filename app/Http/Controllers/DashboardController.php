<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Antrian;
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
        $tes = Antrian::all();
        
        $antrian = Antrian::paginate(5);
        return view('admin/dashboard', compact('antrian'));
    }

    
}
