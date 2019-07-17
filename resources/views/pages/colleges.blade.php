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
    Accreditaion
    <small>Agency</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body table-responsive">
                <table class="table table-hover" style="table-layout:fixed;">
                  <tr>
                    <th>Colleges</th>
                    <th>No. Department/s</th>
                  </tr>
                 @foreach($colleges as $college)
	                 <tr value="{{$college->id}}" class="table-row">
	                    <td>{{$college->name}}</td>
	                    <td>
	                    	{{count($departments->where('college_id', $college->id))}}
	                    </td>
	                 </tr>
                 @endforeach

                </table>
        </div>
      </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
      var editClicked, deleteClicked;
      $(document).ready(function() {
        $('.table-row:has(td)').click(function() 
        {
          if('{{Auth::user()->type}}' == 1){
            window.location.href="agency/"+rowId+"/colleges";
          } else if('{{Auth::user()->type}}' == 4 || '{{Auth::user()->type}}' == 5){
            window.location.href="areas/"+rowId;
          }
        });
</script>
@endsection