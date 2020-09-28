<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anniversary;

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
        $anniversaries = Anniversary::select()
            ->where('user_id', auth()->id())
            ->orderBy('updated_at', "DESC")
            ->get();

        return view('home')->with([
            'anniversaries' => $anniversaries,
        ]);
    }
}
