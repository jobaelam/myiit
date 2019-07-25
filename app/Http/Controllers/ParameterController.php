<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Area;
use App\AreaView;
use App\AccessArea;
use App\Agency;
use App\User;
use App\Department;
use App\Parameter;


class ParameterController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $agency = $request->agency; 
        $department = $request->department;
        $access = $request->access;
        $data = array(
            'title' => Agency::find($agency)->name,
            'agency' => Agency::find($agency),
            'area' => Area::where(AccessArea::find($access)->areaId),
            'department' => Department::find($department),
            'access' => AccessArea::find($access),
            'parameters' => Parameter::where('accessId', $access)->get(),
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );

        return view('pages.parameter')->with($data);
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    	$access = $request->accessId;
    	$name = $request->name;

    	Parameter::create(array(
    		'accessId' => $access,
    		'name' => $name
    	));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $editId = $request->editId;
        $editName = $request->editName;
        Parameter::where('id',$editId)->update([
        	'name' => $editName
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Parameter::find($request->deleteId)->delete();
    }
}
