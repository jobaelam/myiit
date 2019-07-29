@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    {{-- <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li> --}}
    <li class="active"><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
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
      <a href="#">
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
            {{$benchmark->hasName->name}}
            <small>Files</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box">
                <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover unselectable align-middle" style="table-layout:fixed;">
                          <thead>
                            <tr class="active" disabled>
                              <th>Name</th>
                              <th width="10%">Type</th>
                              <th width="10%">Date Added</th>
                              <th width="10%">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                               @foreach($files as $file)
                                @if($file->viewType == 3 AND Auth::user()->dept_id == $department OR $file->viewType == 1 AND Auth::user()->dept_id == $department AND (Auth::user()->type == 1 OR $area->head == Auth::user()->id OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4))
                                    <tr class="table-row">
                                      <td>{{$file->fileName}}</td>
                                      <td>{{$file->fileType}}</td>
                                      <td>{{date('M d, Y',strtotime($file->created_at))}}</td>
                                      <td>
                                          <button type="button" value="{{$file->id}}" class="open btn btn-group btn-default btn-s">Open</button>
                                          <button type="button" value="{{$file->id}}" class="del btn btn-group btn-danger btn-s">Delete</button>
                                      </td> 
                                    </tr>
                                @elseif($file->viewType == 2 OR Auth::user()->type == 1)
                                  <tr class="table-row">
                                      <td>{{$file->fileName}}</td>
                                      <td>{{$file->fileType}}</td>
                                      <td>{{date('M d, Y',strtotime($file->created_at))}}</td>
                                      <td>
                                        @if(Auth::user()->type == 1 OR $area->head == Auth::user()->id OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4 AND $department == Auth::user()->dept_id)
                                          <button type="button" value="{{$file->id}}" class="open btn btn-group btn-default btn-s">Open</button>
                                          <button type="button" value="{{$file->id}}" class="del btn btn-group btn-danger btn-s">Delete</button>
                                        @else
                                          @if(in_array($file->id, $fileView))
                                            @foreach($views as $view)
                                              @if($view->fileId == $file->id AND $view->isApproved == 1)
                                                <button type="button" value="{{$file->id}}" class="open btn btn-group btn-default btn-s">Open</button>
                                                <button type="button" value="{{$file->id}}" class="del btn btn-group btn-danger btn-s">Delete</button>
                                              @elseif($view->fileId == $file->id AND $view->isApproved == 0)
                                                <button class="request btn btn-block btn-success btn-s" disabled style="width: 100%">Pending</button>
                                              @endif
                                            @endforeach
                                          @else
                                            <button value="{{$file->id}}" class="request btn btn-block btn-warning btn-s" style="width: 100%">Request</button>
                                          @endif
                                        @endif
                                      </td> 
                                  </tr>
                                @endif
                               @endforeach
                          </tbody>
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        <a href="/accreditation/{{$agency}}/department/{{$department}}/areas/{{$area->id}}/parameters/{{$parameter}}/bench" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                        @if($area->head == Auth::user()->id OR Auth::user()->type == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4 AND Auth::user()->dept_id == $department)
                          <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus-circle"><span> Upload File</span></i>
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
                    <h4 class="modal-title">Upload File</h4>
                  </div>
                  <div class="modal-body">
                        <form action="/insertFile" method="POST" id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input name="benchmark" type="hidden" value="{{$benchmark->id}}">
                            <input name="parameter" type="hidden" value="{{$parameter}}">
                            <input name="agency" type="hidden" value="{{$agency}}">
                            <input name="access" type="hidden" value="{{$area->id}}">
                            <input name="userId" type="hidden" value="{{Auth::user()->id}}">
                            <div class="form-group">                  
                                <label for="file">Upload File</label>
                                <input multiple="multiple" type="file" name="uploadFile">
                            </div>
                            <div class="form-group">                  
                              <select name='view' class="form-control" value="">
                                @foreach($type as $types)
                                    <option value="{{$types->id}}">{{$types->name}}</option>
                                @endforeach
                              </select>
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
            <div class="modal fade" id="delete-file">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">      
                    <form action="" method="POST" id="deleteForm">
                        @csrf
                        <input type="hidden" name="deleteId" id="deleteId" value="">
                        <h3 id="deleteMessage"></h3>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-danger pull-right" value="Delete">
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
    // $('#edit').click(function() {
    //     $('.del').toggle();
    //     $(this).text(function(i, text){
    //         return text === "Edit" ? "Cancel" : "Edit";
    //     })
    // });
    $('.request').click(function() {
      var file = $(this).val();
      console.log(file);
      $.post('/requestFile', {_token:"{{csrf_token()}}",file: file, user:'{{Auth::user()->id}}'}, function(data){
        window.location.reload();
      })
    })

    $('.open').click(function() {
      var open = $(this).val();
      $.get('/openFile', {file:open, access: "{{$area->id}}"},function(data){
        // window.open('/storage/files/'+data);
        window.open('http://docs.google.com/gview?url=https://myiit.pagekite.me/storage/files/'+data+'&embedded=true/');
      })
    })

    $('.del').click(function() {
      // $('#delete-file').modal();
      var del = $(this).val();
      $.get('/deleteFile', {file:del, access: "{{$area->id}}"},function(data){
        console.log(data);
        document.location.reload(true)
      })
    })  
  });
</script>
@endsection
