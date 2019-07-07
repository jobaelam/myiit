<?php

namespace App\Http\Controllers;

use App\Area;
use App\Agency;
use App\User;
use App\Department;
use Illuminate\Http\Request;

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
        $id = $request->id;
        $areas = Area::where(array(
            'agency_id' => $id
        ))->get();
        $data = array(
            'title' => Agency::find($id)->name,
            'agency' => Agency::find($id),
            'areas' => $areas,
            'users' => User::all(),
            'departments' => Department::all()
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
        $agency_id = $request->agency_id;
        $name = $request->name;
        $desc = $request->desc;
        $head = $request->head;
        $data = array(
            'agency_id' => $agency_id,
            'name' => $name,
            'desc' => $desc,
            'head' => $head,
        );
        Area::create($data);
        $Area = Area::where('agency_id', $agency_id)->where('name', $name)->first();
        return $Area;
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
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
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
        $department = $request->department;
        $user = User::where('dept_id', $department)->get();
        return $user;
    }
}
