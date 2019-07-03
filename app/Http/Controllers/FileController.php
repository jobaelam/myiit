<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
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

    public function download(Request $request)
    {
        $File = File::find($request->val);
        //return public_path();
        $File = Storage::download('public/files/'.auth()->user()->first_name.'/'.$File['fileName']);
        return $File;
        //$header = ['Content-Type: application/txt'];
        // return response()->download(public_path().'/app/public/'.auth()->user()->first_name.'/' . $File['fileName']);
        // $id = $request->id;
        // $files = File::where(array(
        //     'areaId' => $id
        // ))->get();
        // $data = array(
        //     'title' => Area::find($id)->name,
        //     'areas' => Area::find($id),
        //     'files' => $files,
        //     'users' => User::all()
        // );
        // return view('pages.files')->with($data);
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

        if($request->hasFile('uploadFile') && $request->file('uploadFile')->isValid()){
            $filenameWithExt = $request->uploadFile->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->uploadFile->getClientOriginalExtension();  
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->uploadFile->storeAs('public/files/'.auth()->user()->first_name,$fileNameToStore);
        }

        $File = new File;
        $File->filename = $fileNameToStore;
        $File->filetype = $extension;
        $File->userId = $request->userId;
        $File->areaId = $request->areaId;
        $File->save();
        return redirect('/files/'.$request->areaId);
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
