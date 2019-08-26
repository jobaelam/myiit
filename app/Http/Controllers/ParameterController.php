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
            'AccHead' => Department::find($department)->head,
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
            'AccHead' => Department::find($department)->head,
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

        // $benchmark = Benchmark::where('parameterId',$params);
        $totalBenchStatus = null;
        $benches = Benchmark::where('parameterId', $params)->get();
        foreach($benches as $bench){
            $totalBenchStatus = $totalBenchStatus + $bench->status;
        }
        $ParameterStatus = Parameter::find($params);
        $ParameterStatus->status = $totalBenchStatus/(count($benches));
        $ParameterStatus->save();

        //AccessArea Total Status
        $totalParameterStatus = null;
        $parameters = Parameter::where('accessId', $ParameterStatus->accessId)->get();
        foreach($parameters as $parameter){
            $totalParameterStatus = $totalParameterStatus + $parameter->status;
        } 
        $AccessStatus = AccessArea::find($ParameterStatus->accessId);
        $AccessStatus->status = $totalParameterStatus/(count($parameters));
        $AccessStatus->save();

        //Department Total Status
        $totalDepartmentStatus = null;
        $AccessAreas = AccessArea::where('departmentId',$AccessStatus->departmentId)->get();
        foreach($AccessAreas as $Access){
            $totalDepartmentStatus = $totalDepartmentStatus + $Access->status;
        } 
        $DepartmentStatus = Department::find($AccessStatus->departmentId);
        $DepartmentStatus->status = $totalDepartmentStatus/(count($AccessAreas));
        $DepartmentStatus->save();
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
        $benchmark = Benchmark::find($request->bench);
        //$benchmark->status = 1;
        $benchmark->update(['status' => 1]);
        //Parameter Total Status
        $totalBenchStatus = null;
        $benches = Benchmark::where('parameterId', $benchmark->parameterId)->get();
        foreach($benches as $bench){
            $totalBenchStatus = $totalBenchStatus + $bench->status;
        }
        $ParameterStatus = Parameter::find($benchmark->parameterId);
        $ParameterStatus->status = $totalBenchStatus/(count($benches));
        $ParameterStatus->save();

        //AccessArea Total Status
        $totalParameterStatus = null;
        $parameters = Parameter::where('accessId', $ParameterStatus->accessId)->get();
        foreach($parameters as $parameter){
            $totalParameterStatus = $totalParameterStatus + $parameter->status;
        } 
        $AccessStatus = AccessArea::find($ParameterStatus->accessId);
        $AccessStatus->status = $totalParameterStatus/(count($parameters));
        $AccessStatus->save();

        //Department Total Status
        $totalDepartmentStatus = null;
        $AccessAreas = AccessArea::where('departmentId',$AccessStatus->departmentId)->get();
        foreach($AccessAreas as $Access){
            $totalDepartmentStatus = $totalDepartmentStatus + $Access->status;
        } 
        $DepartmentStatus = Department::find($AccessStatus->departmentId);
        $DepartmentStatus->status = $totalDepartmentStatus/(count($AccessAreas));
        $DepartmentStatus->save();
        
        // $totalAreaStatus = null;
        // $AccessAreas = AccessArea::all();
        // $Areas = Area::where('agency_id',$request->agency)->get();
        // foreach($Areas as $area){
        //     foreach($AccessAreas as $Access){
        //         if($area->id == $Access->areaId){
        //             $totalAreaStatus = $totalAreaStatus + $Access->status;
        //         }
        //     } 
        // } 
        // $AgencyStatus = Agency::find($request->agency);
        // $AgencyStatus->status = $totalAreaStatus/(count($AccessAreas));
        // $AgencyStatus->save();
    }

    public function unDone(Request $request){
        $benchmark = Benchmark::find($request->bench);
        //$benchmark->status = 1;
        $benchmark->update(['status' => 0]);
        //Parameter Total Status
        $totalBenchStatus = null;
        $benches = Benchmark::where('parameterId', $benchmark->parameterId)->get();
        foreach($benches as $bench){
            $totalBenchStatus = $totalBenchStatus + $bench->status;
        }
        $ParameterStatus = Parameter::find($benchmark->parameterId);
        $ParameterStatus->status = $totalBenchStatus/(count($benches));
        $ParameterStatus->save();

        //AccessArea Total Status
        $totalParameterStatus = null;
        $parameters = Parameter::where('accessId', $ParameterStatus->accessId)->get();
        foreach($parameters as $parameter){
            $totalParameterStatus = $totalParameterStatus + $parameter->status;
        } 
        $AccessStatus = AccessArea::find($ParameterStatus->accessId);
        $AccessStatus->status = $totalParameterStatus/(count($parameters));
        $AccessStatus->save();

        //Department Total Status
        $totalDepartmentStatus = null;
        $AccessAreas = AccessArea::where('departmentId',$AccessStatus->departmentId)->get();
        foreach($AccessAreas as $Access){
            $totalDepartmentStatus = $totalDepartmentStatus + $Access->status;
        } 
        $DepartmentStatus = Department::find($AccessStatus->departmentId);
        $DepartmentStatus->status = $totalDepartmentStatus/(count($AccessAreas));
        $DepartmentStatus->save();
    }
}
