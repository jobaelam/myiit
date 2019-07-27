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
      Departments
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body table-responsive">
                <table class="table table-bordered table-hover unselectable" style="table-layout:fixed;">
                  <thead>
                    <tr class="active" disabled>
                      <th>Departments</th>
                      <th>Chairperson</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($departments as $department)
                     <tr value="{{$department->id}}" class="table-row">
                        <td>{{$department->name}}</td>
                        <td>
                          Prof. {{$chairPersons->where('dept_id', $department->id)->first()->first_name}} {{$chairPersons->where('dept_id', $department->id)->first()->last_name}}
                        </td>
                     </tr>
                   @endforeach
                  </tbody>
                </table>
                <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                @if( Auth::user()->id == 1)
                  <a href="/accreditation/" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                @else
                  <a href="/accreditation/{{$agency}}/department/{{Auth::user()->dept_id}}/areas" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                @endif
        </div>
      </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
      $(document).ready(function() {
        $('.table-row:has(td)').click(function() 
        {
            var rowId = $(this).attr('value');
            window.location.href={{$agency}}+"/department/"+rowId+"/areas";
        });
        });
</script>
@endsection