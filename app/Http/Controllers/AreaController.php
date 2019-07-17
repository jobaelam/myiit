<?php

namespace App\Http\Controllers;

use App\Area;
use App\AccessArea;
use App\Agency;
use App\User;
use App\Department;
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
        $agency = $request->agency; 
        $department = $request->department;
        $areas = array();
        $access = AccessArea::where('departmentId', $department)->distinct()->get();
        $data = array(
            'title' => Agency::find($agency)->name,
            'agency' => Agency::find($agency),
            'areas' => $areas,
            'users' => User::all(),
            'department' => Department::find($department),
            'departments' => Department::all(),
            'access' => $access,
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
        $agency_id = $request->agencyId;
        $name = $request->name;
        $desc = $request->desc;
        $data = array(
            'agency_id' => $agency_id,
            'name' => $name,
            'desc' => $desc,
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
}
