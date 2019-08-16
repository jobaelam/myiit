@extends('layouts.app')

@section('sidebar')
    <ul class="sidebar-menu" data-widget="tree">
        {{-- <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li> --}}
        <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
        <li><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
        @if($request != null OR Auth::user()->type == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4)
        <li class="active treeview open">
          <a href="#">
            <i class="fa fa-hourglass-o"></i> <span>Requests</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/request"><i class="fa fa-flag">    </i> Parameter </a>
            </li>
            <li><a href="/request/file"><i class="fa fa-files-o">
                </i> File</a>
            </li>
          </ul>
        </li>
        <li>
        @endif
    </ul>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Area Requests
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
                            <th>Requests</th>
                            @if(Auth::user()->type == 1)
                                <th>Department</th>
                            @endif
                            <th width="20%">Date</th>
                            <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @foreach($request as $req)
                            @if($req != null)
                                @if($req->isApproved == 0)
                                 <tr class="table-row">
                                    <td><b>Prof. {{$req->hasUser->first_name}} {{$req->hasUser->last_name}}</b> request to access <b>{{$req->access->hasArea->name}}</b>
                                    @if(Auth::user()->type == 1)
                                        <td>{{$req->access->hasDepartment->name}}</td>
                                    @endif
                                    </td>
                                    <td>{{$req->created_at}}</td>
                                    <td>
                                          <button type="button" value="{{$req->id}}" class="approve btn btn-default btn-s">Accept</button>
                                          <button type="button" value="{{$req->id}}" class="decline btn btn-danger btn-s">Decline</button>      
                                    </td>
                                 </tr>
                                @endif
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
    <script>
    $(document).ready(function() {
        $('.approve').click(function() {
            var req = $(this).val();
            $.get('/approveRequest', {req: req}, function(){
                window.location.href="/request";
            })
        })

        $('.decline').click(function() {
            var req = $(this).val();
            $.get('/declineRequest', {req: req}, function(){
                window.location.href="/request";
            })
        })
    })
    </script>
@endsection