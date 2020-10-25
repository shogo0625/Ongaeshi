<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anniversary;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()) {
            $anniversaries = \App\Anniversary::getAnniversariesDependingOnTime('future', 5);

            $gifts = \App\Gift::getGiftsForTimeline();

            return view('home')->with([
                'anniversaries' => $anniversaries,
                'gifts' => $gifts,
            ]);
        } else {
            return view('home');
        }
    }
}
