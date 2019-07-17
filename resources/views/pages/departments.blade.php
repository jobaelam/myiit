@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li class="active"><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
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
                <table class="table table-hover" style="table-layout:fixed;">
                  <tr>
                    <th>Departments</th>
                    <th>Chairperson</th>
                  </tr>
                 @foreach($departments as $department)
	                 <tr value="{{$department->id}}" class="table-row">
	                    <td>{{$department->name}}</td>
	                    <td>
	                    	Prof. {{$chairPersons->where('dept_id', $department->id)->first()->first_name}} {{$chairPersons->where('dept_id', $department->id)->first()->first_name}}
	                    </td>
	                 </tr>
                 @endforeach
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
            window.location.href="/accreditation/"+{{$agency}}+"/department/"+rowId+"/areas";
        });
        });
</script>
@endsection