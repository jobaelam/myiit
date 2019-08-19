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
use App\Log;
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
            'request' => AccessArea::where('head', Auth::user()->id)->first(),
            'AccHead' => Department::find($department)->head,
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
        $name = $request->name;
        $desc = $request->desc;
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

        if(Auth::user()->type != 1){

            $log = Auth::user()->first_name.' '.Auth::user()->last_name.' added Area '.$name.' ('.$desc.')';
        } else {

            $log = Auth::user()->first_name.' added Area '.$name.' ('.$desc.')';
        
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();
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
        $accessArea = AccessArea::find($editId);
        $oldName = Area::find($accessArea->areaId)->name;
        $oldDesc = Area::find($accessArea->areaId)->desc;
        $access = AccessArea::find($editId)->first()->areaId;
        Area::find($access)->update(array(
            'name' => $editName,
            'desc' => $editDesc
        ));
        if(Auth::user()->type !=1){
            $log = Auth::user()->first_name.' '.Auth::user()->last_name.' edited Area '.$oldName.' ('.$oldDesc.') to '.$editName.' ('.$editDesc.')';
        }else{
            $log = Auth::user()->first_name.' edited Area '.$oldName.' ('.$oldDesc.') to '.$editName.' ('.$editDesc.')';
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();

        
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
        $areaHead = AccessArea::find($editId)->head;
        $oldFName = User::where('id',$areaHead)->value('first_name');
        $oldLName = User::where('id',$areaHead)->value('last_name');
        $newFName = User::where('id',$editHead)->value('first_name');
        $newLName = User::where('id',$editHead)->value('last_name');
        AccessArea::find($editId)->update(array(
            'head' => $editHead
        ));
        if(Auth::user()->type !=1){
            $log = Auth::user()->first_name.''.Auth::user()->last_name.' changed Area Head Mr/Mrs/Ms '.$oldFName.' '.$oldLName.' to '.$newFName.' '.$newLName.'';
        }else{
            $log = Auth::user()->first_name.' changed Area Head Mr/Mrs/Ms '.$oldFName.' '.$oldLName.' to '.$newFName.' '.$newLName.'';
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
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
        //bari ang e return aning $head kay number haha
        $head = $request->accHead;

        $accHeadId = Department::find($dept)->head;
        $oldAccFHead = User::where('id',$accHeadId)->value('first_name');
        $oldAccLHead = User::where('id',$accHeadId)->value('first_name');
        $newAccFHead = User::where('id',$head)->value('first_name');
        $newAccLHead = User::where('id',$head)->value('first_name');
        Department::find($dept)->update(
            ['head' => $head]
        );
        if(Auth::user()->type !=1){
            $log = Auth::user()->first_name.''.Auth::user()->last_name.' changed Accreditation Head Mr/Mrs/Ms '.$oldAccFHead.' '.$oldAccLHead.' to '.$newAccFHead.' '.$newAccLHead.'';
        }else{
            $log = Auth::user()->first_name.' changed Accreditation Head Mr/Mrs/Ms '.$oldAccHead.' '.$oldAccLHead.' to '.$newAccFHead.''.$newAccLHead.'';
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();
    }


}
