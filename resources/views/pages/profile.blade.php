@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
</ul>
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Main content -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-default">

<div class="panel-body">
{{-- <div class="pp-info">
<div class="pp-img-wrapper pull-left"><img src="{{Auth::user()->profile_image}}" class="img-responsive"></div>
<div class="pp-text">
<h3 class="text-white">{{Auth::user()->fullName()}}</h3>
<h4 class="text-white">{{Auth::user()->department->name}}</h4>
<br>
<p class="text-white">Join On:<br>{{Auth::user()->joinOn()}}</p>
</div>  
</div> 
<hr> --}}
<div class="row">
<div class="col-lg-6">
<h4>{{Auth::user()->hasType->name}} Data</h4>
<table class="table table-bordered table-condensed">
<tbody>
<tr>
<td class="active" colspan="2"><strong>Personal</strong></td>
</tr>
<tr>
<td class="warning">{{Auth::user()->hasType->name}} ID No.</td>
<td>{{Auth::user()->id}}</td>
</tr>
<tr>
<td class="warning">Name</td>
<td>{{Auth::user()->fullName()}}</td>
</tr>
<tr>
<td class="warning">Gender</td>
<td>M</td>
</tr>
<tr>
<td class="warning">Civil Status </td>
<td>Single</td>
</tr>
<tr>
<td class="warning">Citizenship </td>
 <td></td>
</tr>
<tr>
<td class="warning">Religion </td>
<td></td>
</tr>
<tr>
<td class="warning">Ethnic Group </td>
<td></td>
</tr>
<tr>
<td class="warning">Date of Birth</td>
<td></td>
</tr>
<tr>
<td class="warning">Place of Birth</td>
<td></td>
</tr>
<tr>
<td class="warning">Name of Father</td>
<td></td>
</tr>
<tr>
<td class="warning">Name of Mother</td>
<td></td>
</tr>
<tr>
<td class="warning">Address of Parents</td>
<td></td>
</tr>
<tr>
<td class="warning">Name of Spouse</td>
<td></td>
</tr>
<tr>
<td class="warning">Permanent Address</td>
<td></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
    <!-- /.content -->
    </div>
@endsection
