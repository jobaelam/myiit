<?php

namespace App\Http\Controllers;

use App\Area;
use App\AreaView;
use App\AccessArea;
use App\Agency;
use App\User;
use App\Department;
use App\Parameter;
use App\ParameterView;
use App\ParameterName;
use App\File;
use App\Benchmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
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
        $areasView = AreaView::where('user', Auth::user()->id)->distinct()->get('accessId');
        if(count($areasView) > 0){
            foreach($areasView as $area){
                $areaView[] = $area->accessId; 
            };
        }else{
            $areaView = array();
        }
        $agency = $request->agency; 
        $department = $request->department;
        $areas = array();
        $access = AccessArea::where('departmentId', $department)->get();
        $data = array(
            'title' => Agency::find($agency)->name,
            'agency' => Agency::find($agency),
            'areas' => $areas,
            'users' => User::all(),
            'department' => Department::find($department),
            'departments' => Department::all(),
            'access' => $access,
            'allview' => AccessArea::all(),
            'areaView' => $areaView,
            'views' => AreaView::where('user', Auth::user()->id)->get(),
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );

        return view('pages.area')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'agency_id' => $request->agencyId,
            'name' => $name = $request->name,
            'desc' => $request->desc,
        );
        $area = Area::create($data)->id;
        $departments = Department::all();
        foreach($departments as $department){
            $datas = array(
                'areaId' => $area,
                'departmentId' => $department->id,
            );
            AccessArea::create($datas);
        }

        // if(Auth::user()->type !=1){
        //     $log = Auth::user()->first_name.' '.Auth::user()->last_name.' from '.Auth::user()->department->name.' added '.$name.' ('.$request->desc.')';
        // }else{
        //     $log = Auth::user()->first_name.' added '.$name.' ('.$request->desc.')';
        // }

        // $logs = new Log;
        // $logs->record = $log;
        // $logs->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editId = $request->editId;
        $editName = $request->editName;
        $editDesc = $request->editDesc;
        $access = AccessArea::find($editId)->first()->areaId;
        Area::find($access)->update(array(
            'name' => $editName,
            'desc' => $editDesc
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
        $editId = $request->editHeadId;
        $editHead = $request->editHead;
        AccessArea::find($editId)->update(array(
            'head' => $editHead
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }

    public function showAreaHead(Request $request)
    {
        // $access = AccessArea::find($request->deleteId)->first()->id;
        // Area::find($access)->delete();
    }

    public function request(Request $request){
        $access = $request->access;
        $user = $request->user;
        $view = new AreaView;
        $view->accessId = $access;
        $view->user = $user;
        $view->isApproved = false;
        $view->save();
        // return redirect('/accreditation/'.$request->agency.'/department/'.$request->department.'/areas');
    }

    public function changeAccHead(Request $request){
        $dept = $request->department;
        $head = $request->accHead;
        Department::find($dept)->update(
            ['head' => $head]
        );
    }


}
