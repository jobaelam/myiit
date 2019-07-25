@extends('layouts.app')

@section('sidebar')
    <ul class="sidebar-menu" data-widget="tree">
        <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
        <li><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
        @if($request != null OR Auth::user()->id == 1 OR Auth::user()->id == 2 OR Auth::user()->id == 3)
        <li class="active"><a href="/request"><i class="fa fa-flag"></i> <span>Requests</span></a></li>
        @endif
    </ul>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Requests
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
                            <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @forelse($request as $req)
                            @if($req->isApproved == 0)
                             <tr class="table-row">
                                <td><b>Prof. {{$req->hasUser->first_name}} {{$req->hasUser->last_name}}</b> request to access <b>{{$req->access->hasArea->name}}</b></td>
                                <td>
                                      <button type="button" value="{{$req->id}}" class="approve btn btn-default btn-s">Accept</button>
                                      <button type="button" value="{{$req->id}}" class="decline btn btn-danger btn-s">Decline</button>      
                                </td>
                             </tr>
                            @endif
                         @empty
                            <tr><td>No Pending Request</td></tr>
                         @endforelse
                         </tbody>
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
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
            $('.table').DataTable();
        })

        $('.approve').click(function() {
            var req = $(this).val();
            $.get('/approveRequest', {req: req}, function(){
                window.location.href="/request";
            })
        })
    </script>
@endsection