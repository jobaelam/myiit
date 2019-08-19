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
            Parameters
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box">
                <div class="box-body table-responsive">
                        <table id="area" class="table table-bordered table-hover unselectable align-middle" style="table-layout:fixed;">
                          <thead>
                            <tr class="active" disabled>
                              <th>Name</th>
                              <th style="width: 25%">Status</th>
                              <th width=10%>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($parameters as $parameter)                          
                                <tr value="{{$parameter->id}}" class="table-row">
                                  <td>{{$parameter->name}}</td>
                                  <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-success" data-toggle="tooltip" title="{{100*$parameter->status}}%" style="width: {{100*$parameter->status}}%"></div>
                                    </div>
                                  </td>
                                  <td>
                                  @if(Auth::user()->id == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4 OR $access->head == Auth::user()->id)
                                      <button type="button" class="edit btn btn-group btn-default btn-s">Edit</button>
                                      <button type="button" class="del btn btn-group btn-danger btn-s">Delete</button>
                                  @else
                                        @if(in_array($parameter->id, $parameterView)) 
                                          @foreach($views as $view)
                                            <script type="text/javascript">console.log('{{$view->parameterId == $parameter->id AND $view->isApproved == 1}}')</script> 
                                            @if($view->parameterId == $parameter->id AND $view->isApproved == 1)
                                              <button type="button" class="open btn btn-block btn-success btn-s" disabled>Verified</button>
                                            @elseif($view->parameterId == $parameter->id AND $view->isApproved == 0)
                                              <button class="request btn btn-block btn-info btn-s" disabled style="width: 100%">Pending</button>
                                            @endif
                                          @endforeach
                                        @else
                                          <button value="{{$parameter->id}}" class="request btn btn-block btn-warning btn-s">Request</button>
                                        @endif
                                  @endif
                                  </td>
                                </tr>
                             @endforeach
                          </tbody>
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        @if($department == Auth::user()->dept_id AND Auth::user()->type == 4 OR Auth::user()->type == 3 OR Auth::user()->type == 2 OR Auth::user()->type == 1 OR $access->head == Auth::user()->id)
                          <a href="/accreditation/{{$agency->id}}/department/{{$department}}/areas" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-parameter">
                            <i class="fa fa-circle-plus"><span> Add Parameter</span></i></button>
                        @else
                          <a href="/accreditation/{{$agency->id}}/department/{{$department}}/areas" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                        @endif 
                </div>
            </div>
            <div class="modal fade" id="add-parameter">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Add Parameter</h4>
                  </div>
                  <div class="modal-body">      
                    <form action="" method="POST" id="addForm">
                        @csrf
                        <input type="hidden" name="accessId" value="{{$access->id}}">
                        <div class="form-group">                  
                          <label for="name">Name</label>
                          <input id="name" name="name" type="text" class="form-control" placeholder="Parameter Name">
                        </div>
                        @error('name')
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
            <div class="modal fade" id="edit-parameter">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Parameter Name</h4>
                  </div>
                  <div class="modal-body">      
                    <form action="" method="POST" id="editForm">
                        @csrf
                        <input type="hidden" name="editId" id="editId" value="">
                        <div class="form-group">                  
                          <label for="editName">Name</label>
                          <input id="editName" name="editName" type="text" class="form-control" value="">
                        </div>
                        @error('editName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-primary pull-right" value="Save Changes">
                        </div>
                    </form>              
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="delete-parameter">
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
      var editClicked, deleteClicked, updateClicked, requestClicked;
      $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.edit').click(function() {
          editClicked = true;
        });

        $('.del').click(function(){
          deleteClicked = true;
        })

        $('.request').click(function(){
          requestClicked = true;
        })

        $('.table-row:has(td)').click(function() 
        {
            var rowId = $(this).attr('value');
            var editName = $(this).find('td:eq(0)').text();
            var request = $(this).find('.request').text();
            if(editClicked){
              console.log(rowId);
              $('#editId').val(rowId);
              $('#editName').val(editName);
              $('#edit-parameter').modal();
              editClicked = false;
            } else if(deleteClicked){
              $('#deleteId').val(rowId);
              $('#deleteMessage').html('Do you want to delete "'+editName+'"?');
              $('#delete-parameter').modal();
              deleteClicked = false;
            }else if(requestClicked){
               $.post('/requestParameter', {_token:"{{csrf_token()}}",access: rowId, user:'{{Auth::user()->id}}'}, function(data){
                window.location.reload();
               })
              requestClicked = false;
            }else {
              if(request != 'Request'){
                if (request != 'Pending') {
                  window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department}}+"/areas/"+{{$access->id}}+"/parameters/"+rowId+"/bench";
                }
              }
            } 
        });

        $('#deleteForm').submit(function(e)
        {
            e.preventDefault();
            var deleteForm = $(this).serialize();
            $.post('/deleteParameter', deleteForm, function(data){
              window.location.reload();
            })
        });

        $('#editForm').submit(function(e)
        {
            e.preventDefault();
            var editForm = $(this).serialize();
            $.post('/editParameter', editForm, function(data){
              //console.log(data);
              window.location.reload();
            })
        });

        $('#addForm').submit(function(e)
        {
            e.preventDefault();
            $('#notAvailable').remove();
            var addForm = $(this).serialize();
            if ($('#name').val() == '') {
                alert("Enter a Valid Input");
            }else{
              $.post('/insertParameter', addForm, function(data){
                window.location.reload();
              })
            };
        });
      });
</script>
@endsection
