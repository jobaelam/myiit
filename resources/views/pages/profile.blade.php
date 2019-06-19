@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
</ul>
@endsection

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>
        Profile
        {{-- <small>Home</small> --}}
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="box">
            Profile
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
