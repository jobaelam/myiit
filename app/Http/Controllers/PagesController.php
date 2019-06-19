<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Chat;
use App\Chat_Message;

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
        $data = array(
            'users' => User::all(),
            'chats' => Chat::where('user2', '==', Auth::user()->id)->get(),
        );
        
        return view('pages.messenger')->with($data);
    }

    public function profile(){
        return view('pages.profile');
    }
}
