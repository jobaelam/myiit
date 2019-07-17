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
            {{$areas->name}}
            <small>Files</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box">
                {{-- <div class="box-header with-border">
                    <h3 class="box-title">
                        Agencies
                    </h3>
                </div> --}}
                <div class="box-body table-responsive">
                        <table class="table table-hover" style="table-layout:fixed;">
                          <tr>
                            <th>Name</th>
                            <th width="10%">Type</th>
                            <th width="10%">Date Added</th>
                            <th width="5%">Action</th>
                          </tr>
                          @if(count($files) > 0)
                             @foreach($files as $file)
                              @if($file->areaId == $areas->id)
                                <tr value="{{$file->id}}" class="table-row">
                                  <td>{{$file->fileName}}</td>
                                  <td>{{$file->fileType}}</td>
                                  <td>{{date('M d, Y',strtotime($file->created_at))}}</td>
                                  <td>
                                    
                                    @if(Auth::user()->id == 1 OR $areas->head == Auth::user()->id)
                                      <button class="download btn-xs btn-deafult centered"><i class="fa fa-download"></i></button>
                                      <button class="delete btn-xs btn-danger centered"><i class="fa fa-remove" data-toggle="modal" data-target="#modal-remove"></i></button>
                                    @else
                                      <button class="request btn-xs btn-warning centered">Request</button>
                                    @endif
                                  </td> 
                                </tr>
                              @endif
                             @endforeach
                          @else
                          <tr><td>No Areas Available</td></tr>
                          @endif
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        <a href="/areas/{{$areas->id}}" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                          <i class="fa fa-plus-circle"><span> Upload File</span></i>
                        </button>                        
                </div>                 
            </div>
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload File</h4>
                  </div>
                  <div class="modal-body">
                        <form action="/insertFile" method="POST" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input name="areaId" type="hidden" value="{{$areas->id}}">
                            <input name="userId" type="hidden" value="{{Auth::user()->id}}">
                            <div class="form-group">                  
                                <label for="file">Upload File</label>
                                <input type="file" name="uploadFile">
                            </div>
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
            <div class="modal fade" id="modal-remove">
              <div class="modal-dialog ">
                <div class="modal-content">
                  <div class="modal-body">
                    <form action="/deleteFile" method="POST" id="myForm">
                        @csrf
                        <h3>Do you want to delete this file?</h3>
                        <div class="modal-footer">
                          <input type="submit" class="btn btn-danger centered" value="Yes">
                          <button type="button" class="btn btn-default pull-center" style="margin-right:1rem" data-dismiss="modal">No</button>
                        </div>
                    </form>   
                  </div>
                                          
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
    </section>
  </div>
<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.table-row:has(td)').click(function() {
        var val = $(this).attr('value');
        $.post('/downloadFile', {_token:"{{csrf_token()}}",val: val}, function(data){
        console.log(data);
        //window.location.href="/areas/{{$areas->id}}";
      })
    });

    $('#edit').click(function() {
        $('.del').toggle();
        $(this).text(function(i, text){
            return text === "Edit" ? "Cancel" : "Edit";
        })
    });

    $('.request').click(function(){
      console.log('request');
    });
  });
</script>
@endsection
