@extends('layouts.app')

@section('content')
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
    <div class="pull-left image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>Alexander Pierce</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
        <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
    </ul>
</section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Messeger
        {{-- <small>Home</small> --}}
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="box" id='app'>
            <chat-app :user="{{ auth()->user() }}"></chat-app>
        </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
