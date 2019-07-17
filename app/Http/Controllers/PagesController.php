<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Chat;
use App\Chat_Message;
use App\College;
use App\Department;

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
        $user = Auth::user()->id;
        $data = array(
            'users' => User::all(),
            'chats' => Chat::where('user1', $user)->get(),
            'chats2' => Chat::where('user2', $user)->get(),
        );
        
        return view('pages.messenger')->with($data);
    }

    public function departments(Request $request){
        $data = array(
            'departments' => Department::all(),
            'chairPersons' => User::where('type',4)->get(),
            'agency' => $request->agencyId
        );
        return view('pages.departments')->with($data);
    }

    public function profile(){
        return view('pages.profile');
    }
}
