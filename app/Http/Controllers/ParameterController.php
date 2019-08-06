<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $parametersView = ParameterView::where('user', Auth::user()->id)->distinct()->get('parameterId');
        if(count($parametersView) > 0){
            foreach($parametersView as $parameter){
                $parameterView[] = $parameter->parameterId; 
            };
        }else{
            $parameterView = array();
        }
        $agency = $request->agency; 
        $department = $request->department;
        $access = $request->access;
        $data = array(
            'title' => Agency::find($agency)->name,
            'agency' => Agency::find($agency),
            'area' => Area::where(AccessArea::find($access)->areaId),
            'department' => $department,
            'access' => AccessArea::find($access),
            'parameterView' => $parameterView,
            'parameters' => Parameter::where('accessId', $access)->get(),
            'views' => ParameterView::where('user', Auth::user()->id)->get(),
            'request' => AccessArea::where('head', Auth::user()->id)->first(),
        );

        return view('pages.parameter')->with($data);
    }

        public function bench(Request $request)
    {
        $agency = $request->agency; 
        $department = $request->department;
        $access = $request->access;
        $parameter = $request->parameter;
        $data = array(
            'title' => Agency::find($agency)->name,
            'agency' => Agency::find($agency),
            'department' => $department,
            'access' => AccessArea::find($access),
            'parameters' => Parameter::find($parameter)->first(),
            'bench' => Benchmark::where('parameterId', $parameter)->get(),
            'request' => AccessArea::where('head', Auth::user()->id)->first(),
        );

        return view('pages.bench')->with($data);
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
    	$params = Parameter::create(array(
    		'accessId' => $access,
    		'name' => $name,
    	))->id;

        $parameterName = ParameterName::all();
        foreach($parameterName as $names){
            $benchmark = array(
                'parameterId' => $params,
                'nameId' => $names->id
            );
            Benchmark::create($benchmark);
        }
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

    public function request(Request $request){
        $access = $request->access;
        $user = $request->user;
        $view = new ParameterView;
        $view->parameterId = $access;
        $view->user = $user;
        $view->isApproved = false;
        $view->save();
        // return redirect('/accreditation/'.$request->agency.'/department/'.$request->department.'/areas');
    }

    public function done(Request $request){
        //bari akong gisulat tanan equivalent query niya sa php artisan tinker
        //para ma gets nakog ayo

        //finds every primary key ID in benchmark
        //Benchmark->pluck('id');
        $benchmark = Benchmark::find($request->bench);
        // $benchmark->status = 1;
        //if done is clicked, status is updated to 1 from 0
        $benchmark->update(['status' => 1]);

        
        //same as $benchmark::where('parameterId',($parameter->pluck('id')))->get();
        //which gets all benchmark where parameterId and bench id are connected
        // $benches = Benchmark::where('parameterId', $request->parameter)->get();
        // //same as $parameter::where('id',($benchmark->pluck('parameterId')))->get();
        // //gets the parameter in where you click 'done' button example the parameter "student"
        // $ParameterStatus = Parameter::find($benchmark->parameterId);

        // //so this one changes the status of parameter where 'done' button is clicked
        // $ParameterStatus->status = ($ParameterStatus->status) + (($benchmark->status)/(count($benches)));

        // + ($benchmark->status)/(count($benches));
        //save in parameter status the total percentage of the last parameter clicked
        $benchmark->save();

        //this query gets all parameters that is connected to the accessId
        //same as $parameter::where('accessId',($areaaccess->pluck('id')))->get();
        //so when you count(parameters) you get the total number of parameters
        // $parameters = Parameter::where('accessId', $request->access)->get();

        // // //real problem starts here
        // // pluck() and sum() wont work 
        // $AccessStatus = AccessArea::find($ParameterStatus->accessId);
        // // // $parameterTotal = DB::table('parameters')->where('accessId',($benchmark->pluck('parameterId')))->sum('status');
        // //$parameterTotal = Parameter::where('accessId',$benchmark->parameterId)->sum('status');

        // $AccessStatus->status = (($AccessStatus->status)/(count($parameters)));
        // // // + (($ParameterStatus->status)/(count($parameters)));
        // $AccessStatus->save();


        // // //get all data with the same areaId but different departments
        // // $AreaCount = AccessArea::where('areaId',$request->department)->get();

        // $AgencyStatus = Agency::find($request->agency);

        // $AgencyStatus->status = ($AccessStatus->status) ;
        // // + (($AccessStatus->status)/(count($AreaCount)));
        // $AgencyStatus->save();
    }

    public function unDone(Request $request){
        $benchmark = Benchmark::find($request->bench);
        $benchmark->update(['status' => 0]);
        $benchmark->save();
    }


    // public function calculateParamStat(){
    //     $benchmark = Benchmark::find($request->bench);
    //     $parameter = Parameter::find($request->benchmark);
    //     $parameterTotal = Parameter::where('parameterId',$benchmark->pluck('id'))->sum('status');
    //     $paramCounts = Parameter::where('parameterId',$benchmark->pluck('id'))->get());
    //     $counter = count($paramCounts);

    //     $parameter->status = $paramCounts / $counter;
    //     $parameter->save();
    //     return $parameter->status;
    // }
}
