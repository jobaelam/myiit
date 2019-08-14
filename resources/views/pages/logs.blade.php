@extends('layouts.app')

@section('sidebar')
    <ul class="sidebar-menu" data-widget="tree">
        {{-- <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li> --}}
        <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
        <li><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
        <li class="treeview open">
          <a href="#">
            <i class="fa fa-hourglass-o"></i> <span>Requests</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/request"><i class="fa fa-flag"></i> Parameter</a></li>
            <li><a href="/request/file"><i class="fa fa-files-o"></i> File</a></li>
          </ul>
        </li>
        <li>
        <li class="active">
          <a href="/logs">
            <i class="fa fa-list"></i> <span>Logs</span>
          </a>
        </li>
    </ul>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Logs
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover unselectable align-middle" style="table-layout:fixed;">
                        <thead>
                            <tr class="active" disabled>
                            <th>Logs</th>
                            <th width="10%">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($logs as $log)
                            @if($log != null)
                             <tr class="table-row">
                                <td>{{$log->record}}</td>
                                <td>{{$log->created_at}}</td>
                             </tr>
                            @endif
                         @endforeach
                         </tbody>
                        </table>
                </div>
              </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- jQuery 3 -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
@endsection