<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function about()
    {
        return view('front.about');
    }

    public function clients()
    {
        return view('front.clients');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function events()
    {
        return view('front.events');
    }
}
