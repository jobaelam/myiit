<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
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

    public function index(){
        return view('pages.index');
    }

    public function accreditation(){
        return view('pages.accreditation');
    }

    public function messenger(){
        return view('pages.messenger');
    }

    public function profile(){
        return view('pages.profile');
    }
}
