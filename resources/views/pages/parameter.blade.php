@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li class="active"><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
    <li><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
    @if($request != null OR Auth::user()->id == 1 OR Auth::user()->id == 2 OR Auth::user()->id == 3)
    <li><a href="/request"><i class="fa fa-flag"></i> <span>Requests</span></a></li>
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
                              @if(count($parameters) > 0)
                                @if(Auth::user()->id == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR $access->head == Auth::user()->id)
                                  <th width=10%>Action</th>
                                @endif
                              @endif
                            </tr>
                          </thead>
                          <tbody>
                            @forelse($parameters as $parameter)                            
                                <tr value="{{$parameter->id}}" class="table-row">
                                  <td>{{$parameter->name}}</td>
                                  
                                  @if(Auth::user()->id == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR $access->head == Auth::user()->id)
                                    <td>
                                      <button type="button" class="edit btn btn-group btn-default btn-s">Edit</button>
                                      <button type="button" class="del btn btn-group btn-danger btn-s">Delete</button>
                                    </td>
                                  @endif
                                </tr>
                             @empty
                              <tr><td>No Parameters Available</td></tr>
                             @endforelse
                          </tbody>
                        </table>s
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        @if($department->id = Auth::user()->dept_id AND Auth::user()->id == 4 OR Auth::user()->id == 3 OR Auth::user()->id == 2 OR Auth::user()->id == 1 OR $access->head == Auth::user()->id)
                          <a href="/accreditation/{{$agency->id}}/department/{{$department->id}}/areas" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-parameter">
                            <i class="fa fa-circle-plus"><span> Add Parameter</span></i></button>
                        @else
                          <a href="/accreditation/{{$agency->id}}/department/{{$department->id}}/areas" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
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
        $('.table').DataTable();
        $('.edit').click(function() {
          editClicked = true;
        });

        $('.del').click(function(){
          deleteClicked = true;
        })

        $('.table-row:has(td)').click(function() 
        {
            var rowId = $(this).attr('value');
            var editName = $(this).find('td:eq(0)').text();
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
            }else {
                  window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas/"+{{$access->id}}+"/parameters/"+rowId+"/files";
            } 
        });

        $('#deleteForm').submit(function(e)
        {
            e.preventDefault();
            var deleteForm = $(this).serialize();
            $.post('/deleteParameter', deleteForm, function(data){
              window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas/"+{{$access->id}}+"/parameters";
            })
        });

        $('#editForm').submit(function(e)
        {
            e.preventDefault();
            var editForm = $(this).serialize();
            $.post('/editParameter', editForm, function(data){
              window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas/"+{{$access->id}}+"/parameters";
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
                window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas/"+{{$access->id}}+"/parameters";
              })
            };
        });
      });
</script>
@endsection
