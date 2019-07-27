<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\FileView;
use App\Area;
use App\AccessArea;
use App\User;
use App\Benchmark;
use App\FileViewType;
use App\Parameter;

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
        $filesView = FileView::where('user', Auth::user()->id)->distinct()->get('fileId');
        if(count($filesView) > 0){
            foreach($filesView as $file){
                $fileView[] = $file->fileId; 
            };
        }else{
            $fileView = array();
        }
        $department = $request->department;
        $areaAccess = $request->area;
        $parameter = $request->parameter;
        $benchmark = $request->benchmark;
        $agency = $request->agency;
        $files = File::where(array(
            'benchmarkId' => $benchmark,
        ))->get();
        $data = array(
            'area' => AccessArea::find($areaAccess),
            'access' => Area::find(AccessArea::find($areaAccess)->areaId),
            'files' => $files,
            'department' => $department,
            'agency' => $agency,
            'parameter' => $parameter,
            'benchmark' => Benchmark::find($benchmark),
            'type' => FileViewType::all(),
            'users' => User::all(),
            'fileView' => $fileView,
            'views' => FileView::where('user', Auth::user()->id)->get(),
            'request' => AccessArea::where('head', Auth::user()->id)->first()
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
        if($request->hasFile('uploadFile') && $request->file('uploadFile')->isValid()){
            $filenameWithExt = $request->uploadFile->getClientOriginalName();
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            $extension = $request->uploadFile->getClientOriginalExtension();  
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->uploadFile->storeAs('public/files/',$fileNameToStore);
        }

        $File = new File;
        $File->filename = $fileNameToStore;
        $File->filetype = $extension;
        $File->viewType = $request->view;
        $File->userId = $request->userId;
        $File->benchmarkId = $request->benchmark;
        $File->save();
        return redirect('/accreditation/'.$request->agency.'/department/'.AccessArea::find(Parameter::find($request->parameter)->accessId)->departmentId.'/areas/'.$request->access.'/parameters/'.$request->parameter.'/bench/'.$request->benchmark.'/files');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return File::find($request->file)->fileName;
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
    public function destroy(Request $request)
    {
        File::find($request->file)->delete();
    }

    public function request(Request $request){
        $file = $request->file;
        $user = $request->user;
        $view = new FileView;
        $view->fileId = $file;
        $view->user = $user;
        $view->isApproved = false;
        $view->save();
        // return redirect('/accreditation/'.$request->agency.'/department/'.$request->department.'/areas');
    }
}
