<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Chat;
use App\Chat_Message;
use App\College;
use App\Department;
use App\AccessArea;
use App\AreaView;

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
        $data = array(
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );
        return view('pages.index')->with($data);
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
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );
        
        return view('pages.messenger')->with($data);
    }

    public function departments(Request $request){
        $data = array(
            'departments' => Department::all(),
            'chairPersons' => User::where('type',4)->get(),
            'agency' => $request->agencyId,
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );
        return view('pages.departments')->with($data);
    }

    public function profile(){
        $data = array(
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );
        return view('pages.profile')->with($data);
    }

    public function request(){
        $access = AccessArea::where('head', Auth::user()->id)->first();
        if(Auth::user()->id == 1){
            $data = array(
                'request' => AreaView::all()
            );
        }else{
            $data = array(
                'request' => AreaView::where('accessId', $access->id)->get()
            );
        }
        return view('pages.request')->with($data);
    }

    public function displayRequest(Request $request){
        $access = AccessArea::where('head',$request->user)->first();
        if($access != null)
            $data = AreaView::where([['accessId', $access->id],['isApproved', 0]])->get();
        else
            $data = null;
        return $data;
    }

    public function approveRequest(Request $request){
        AreaView::find($request->req)->update(array(
            'isApproved' => 1
        ));
    }
}
