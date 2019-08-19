@extends('layouts.app')

@section('sidebar')
    <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="active"><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li> --}}
        <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
        <li><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
        @if($request != null OR Auth::user()->type == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4)
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
        @if(Auth::user()->type == 1)
        <li>
          <a href="/logs">
            <i class="fa fa-list"></i> <span>Logs</span>
          </a>
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