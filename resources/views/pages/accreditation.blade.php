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
    Accreditation
    <small>Agencies</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
    <li><i class="fa fa-book"></i> Accreditation</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body table-responsive">
                <table class="table table-hover">
                  <tr>
                    <th>Agencies</th>
                    <th>Description</th>
                    <th style="width: 25%">Status</th>
                  </tr>
                  @if(count($agencies) > 0)
                     @foreach($agencies as $agency)
                     <tr value="{{$agency->id}}" class="table-row">
                        <td>{{$agency->name}}</td>
                        <td>{{$agency->desc}}</td>
                        <td>
                            <div class="progress progress-xs">
                                <div class="progress-bar progress-bar-success" style="width: {{$agency->status}}%"></div>
                            </div>
                        </td>
                      </tr>
                     @endforeach
                  @else
                      <tr id="notAvailable"><td>No Agency Available</td></tr>
                  @endif
                </table>
                <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                @if( Auth::user()->id == 1)
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                  <i class="fa fa-plus-circle"><span> Add Agency</span></i>
                </button>
                @endif
        </div>
         
      </div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agency Details</h4>
          </div>
          <div class="modal-body">      
            <form action="/accreditation" method="POST" id="myForm">
                @csrf
                <div class="form-group">                  
                  <label for="name">Agency</label>
                  <input id="name" name="name" type="text" class="form-control" placeholder="Agency Name">
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="form-group">                  
                  <label for="desc">Description</label>
                  <input id="desc" name="desc" type="textArea" class="form-control" placeholder="Description">
                </div>
                @error('desc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <input type="submit" class="btn btn-primary pull-right" value="Save">
                </div>
            </form>              
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
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
            var val = $(this).attr('value');
            console.log(val);
            window.location.href="/areas/"+val;
        });

        $('#myForm').submit(function(e)
        {
            e.preventDefault();
            $('#modal-default').modal('hide');
            $('#notAvailable').remove();
            form = $(this).serialize();
            if (form == "") {
                alert("Enter a Valid Input");
                return false;
            }else{
            insertAgency();
            };
        });

        function insertAgency()
        {
          $.post('/insertAgency', form, function(data){
            console.log(data);
            window.location.href="accreditation";
            // var displayAgency = '<tr value="'+data['id']+'" class="table-row">'+
            // '<td>'+data['name']+'</td>'+
            // '<td>'+data['desc']+'</td>'+
            // '<td>'+
            // '<div class="progress progress-xs">'+
            // '<div class="progress-bar progress-bar-success" style="width: '+data['status']+'%"></div>'+
            // '</div></td></tr>'
            // $('table.table').append(displayAgency);
          })
        } 
      });

</script>
@endsection