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
use App\FileView;
use App\File;
use App\Parameter;


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
        
        if(Auth::user()->type == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3){
            $data = array(
                'request' => AreaView::all()
            );
        }elseif(Auth::user()->type == 4){
            $access = AccessArea::where('departmentId', Auth::user()->dept_id)->get();
            foreach($access as $ass){
                $datas[] = AreaView::where('accessId', $ass->id)->first();
            };
            $data = array(
                'request' => $datas
            );
            
        }else{
            $access = AccessArea::where('head', Auth::user()->id)->first();
            $data = array(
                'request' => AreaView::where('accessId', $access->id)->get()
            );
        }
        return view('pages.request')->with($data);
    }

    public function requestFile(){
            $data = array(
                'request' => FileView::all()
            );
        return view('pages.requestfile')->with($data);
    }

    public function displayRequest(Request $request){
        $access = AccessArea::where('head',$request->user)->first();
        if(Auth::user()->type == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3){
            $area = AreaView::all();
            $file = FileView::all();
        }elseif($access != null){
            $parameter = Parameter::where('accessId', $access->id)->first();
            $fileview = File::where('parameterId', $parameter->id)->first();
            $area = AreaView::where([['accessId', $access->id],['isApproved', 0]])->get();
            $file = FileView::where([['fileId', $fileview->id],['isApproved', 0]])->get();
        }else{
            $area = array();
            $file = array();
        }
        return array($area,$file);
    }

    public function approveRequest(Request $request){
        AreaView::find($request->req)->update(array(
            'isApproved' => 1
        ));
    }

    public function declineRequest(Request $request){
        AreaView::find($request->req)->update(array(
            'isApproved' => 2
        ));
    }

    public function approveRequestFile(Request $request){
        FileView::find($request->req)->update(array(
            'isApproved' => 1
        ));
    }

    public function declineRequestFile(Request $request){
        FileView::find($request->req)->update(array(
            'isApproved' => 2
        ));
    }
}
