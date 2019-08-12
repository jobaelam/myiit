<?php

namespace App\Http\Controllers;

use App\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\AccessArea;
use App\Log;

class AgenciesController extends Controller
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
    public function index()
    {
        $data = array(
            'title' => 'Accreditation Agencies',
            'agencies' => Agency::all(),
            'request' => AccessArea::where('head', Auth::user()->id)->first()
        );
        return view('pages.accreditation')->with($data);
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
            'name' => $name,
            'desc' => $desc
        );
        $Agency = new Agency();
        $Agency->create($data);
        
        if(Auth::user()->type !=1){
            $log = Auth::user()->first_name.' '.Auth::user()->last_name.' added Agency '.$name.' ('.$desc.')';
        }else{
            $log = Auth::user()->first_name.' added Agency '.$name.' ('.$desc.')';
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function show(Agency $agency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function edit(Agency $agency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $editId = $request->editId;
        $editName = $request->editName;
        $editDesc = $request->editDesc;
        $oldName = Agency::find($editId)->name;
        $oldDesc = Agency::find($editId)->desc;

        Agency::find($editId)->update(array(
            'name' => $editName,
            'desc' => $editDesc
        ));
        if(Auth::user()->type !=1){
            $log = Auth::user()->first_name.' '.Auth::user()->last_name.' edited agency '.$oldName.' ('.$oldDesc.') to '.$editName.' ('.$editDesc.')';
        }else{
            $log = Auth::user()->first_name.' edited agency '.$oldName.' ('.$oldDesc.') to '.$editName.' ('.$editDesc.')';
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agency  $agency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Agency::find($request->deleteId)->name;
        if(Auth::user()->type !=1){
            $log = Auth::user()->first_name.' '.Auth::user()->last_name.' deleted agency '.$delete;
        }else{
            $log = Auth::user()->first_name.' deleted agency '.$delete;
        }

        $logs = new Log;
        $logs->record = $log;
        $logs->save();

        Agency::find($request->deleteId)->delete();
    }
}
