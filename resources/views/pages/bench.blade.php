@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li class="active"><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
    <li><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
    @if($request != null OR Auth::user()->id == 1 OR Auth::user()->id == 2 OR Auth::user()->id == 3 OR Auth::user()->id == 4)
    <li class="treeview">
      <a href="#">
        <i class="fa fa-hourglass-o"></i> <span>Requests</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/request"><i class="fa fa-flag"></i> Area</a></li>
        <li><a href="/request/file"><i class="fa fa-files-o"></i> File</a></li>
      </ul>
    </li>
    @endif
</ul>
@endsection

@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Parameters
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box">
                <div class="box-body table-responsive">
                        <table id="area" class="table table-bordered table-hover unselectable align-middle" style="table-layout:fixed;">
                          <thead>
                            <tr class="active" disabled>
                              <th>Name</th>
                              <th width="10%">File</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($bench as $benchmark)                            
                                <tr value="{{$benchmark->id}}" class="table-row">
                                  <td>{{$benchmark->hasName->name}}</td>
                                  <td>{{count($benchmark->hasFiles)}}</td>
                                </tr>
                             @endforeach
                          </tbody>
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        @if($department == Auth::user()->dept_id AND Auth::user()->type == 4 OR Auth::user()->type == 3 OR Auth::user()->type == 2 OR Auth::user()->type == 1 OR $access->head == Auth::user()->id)
                          <a href="/accreditation/{{$agency->id}}/department/{{$department}}/areas/{{$access->id}}/parameters" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-parameter">
                            <i class="fa fa-circle-plus"><span> Add Parameter</span></i></button>
                        @else
                          <a href="/accreditation/{{$agency->id}}/department/{{$department}}/areas/{{$access}}/parameters" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                        @endif 
                </div>
            </div>
    </section>
  </div>
<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
      var editClicked, deleteClicked, updateClicked, requestClicked;
      $(document).ready(function() {
        $('.table-row:has(td)').click(function() 
        {
            var rowId = $(this).attr('value');
            window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department}}+"/areas/"+{{$access->id}}+"/parameters/"+{{$parameters->id}}+"/bench/"+rowId+"/files";
        });
      });
</script>
@endsection
