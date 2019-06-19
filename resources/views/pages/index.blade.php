@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li class="active"><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
</ul>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Dashboard
    <small>Home</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection