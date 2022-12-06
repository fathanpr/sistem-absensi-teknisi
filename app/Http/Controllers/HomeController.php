<?php

namespace App\Http\Controllers;

use App\Models\Atm;
use App\Models\User;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
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
    public function index()
    {
        return view('absen.create', [
            'teknisis' => User::all(),
            'atms' => Atm::all(),
            'absens' => Absen::with('atm')->orderBy('created_at', 'desc')->get(),
            'tanggal' => Carbon::now()->isoFormat('dddd, D MMM Y'),
        ]);
    }
}
