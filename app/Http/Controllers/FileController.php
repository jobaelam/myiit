<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Area;
use App\User;

class FileController extends Controller
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
        $files = File::where(array(
            'areaId' => $id
        ))->get();
        $data = array(
            'title' => Area::find($id)->name,
            'areas' => Area::find($id),
            'files' => $files,
            'users' => User::all()
        );
        return view('pages.files')->with($data);
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
        //$Area = Area::where('agency_id', $agency_id)->where('name', $name)->first();
        return $Agency;
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
}
