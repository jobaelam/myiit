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
            {{$agency->name}}
            <small>{{$department->name}}</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box">
                <div class="box-body table-responsive">
                        <table id="area" class="table table-hover" style="table-layout:fixed;">
                          <tr>
                            <th>Area</th>
                            <th>Description</th>
                            <th>Head</th>
                            <th width=10%>Action</th>
                          </tr>
                          @if(count($access) > 0)
                             @foreach($access as $entry)
                              @if($entry->hasArea->hasAgency->id == $agency->id)
                                <tr value="{{$entry->id}}" class="table-row">
                                  <td>{{$entry->hasArea->name}}</td>
                                  <td>{{$entry->hasArea->desc}}</td>
                                  @if($entry->head == null)
                                    <td>
                                      Not Yet Assigned
                                  @else
                                    <td>
                                      {{$entry->headUser->first_name}} {{$entry->headUser->last_name}} 
                                  @endif
                                    @if(Auth::user()->id == 1)
                                      <button type="button" class="update" style="border: none;">Edit</button>
                                    @endif
                                    </td>
                                  <td>
                                    @if(Auth::user()->id == 1)
                                      <button type="button" class="edit btn-xsm btn-default"  style="width: 45%">Edit</button>
                                      <button type="button" class="del btn-xsm btn-danger"  style="width: 50%">Delete</button>
                                    @elseif($entry->head == Auth::user()->id)
                                      <button type="button" class="btn-xsm btn-default"  style="width: 100%">Member</button>
                                    @else
                                      <button class="request btn-xs btn-warning" style="width: 100%">Request</button>
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
                        @if( Auth::user()->id == 1)
                          <a href="/accreditation/{{$agency->id}}" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                          <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#add-area">
                            <i class="fa fa-circle-plus"><span> Add Area</span></i></button>
                        @else
                          <a href="/accreditation/" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                        @endif 
                        <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#departments">
                            <i class="fa fa-list-ul"><span> Departments</span></i></button>
                </div>
            </div>
            <div class="modal fade" id="add-area">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Area Details</h4>
                  </div>
                  <div class="modal-body">      
                    <form action="" method="POST" id="addForm">
                        @csrf
                        <input type="hidden" name="agencyId" value="{{$agency->id}}">
                        <div class="form-group">                  
                          <label for="name">Area</label>
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
            <div class="modal fade" id="update-head">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Head</h4>
                  </div>
                  <div class="modal-body">      
                    <form method="POST" id="updateHead">
                        @csrf
                        <input type="hidden" name="editHeadId" id="editHeadId" value="">
                        <div class="form-group">                  
                          <label for="head">Head</label>
                          <select id="editHead" name="editHead" type="textArea" class="form-control" value="">
                            <option id="currentHead" disabled selected>--Select Faculty--</option>
                            @foreach($users as $user)
                              @if($user->dept_id == $department->id AND $user->id != 1)
                                <option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        @error('editDesc')
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
            <div class="modal fade" id="edit-area">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Area Details</h4>
                  </div>
                  <div class="modal-body">      
                    <form method="POST" id="editForm">
                        @csrf
                        <input type="hidden" name="editId" id="editId" value="">
                        <div class="form-group">                  
                          <label for="editName">Area</label>
                          <input id="editName" name="editName" type="text" class="form-control" value="">
                        </div>
                        @error('editName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group">                  
                          <label for="editDesc">Description</label>
                          <input id="editDesc" name="editDesc" type="textArea" class="form-control" value="">
                        </div>
                        @error('editDesc')
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
            <div class="modal fade" id="delete-area">
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
            <div class="modal fade" id="departments">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Departments</h4>
                  </div>
                  <div class="modal-body">      
                    <form action="" method="POST" id="listDepartments">
                        @csrf
                        <div class="form-group">                  
                          <select id="curHead" name="curHead" type="textArea" class="form-control" value="">
                            <option disabled selected>{{$department->name}}</option>
                            @foreach($departments as $dept)
                              @if($dept->id != $department->id)
                                <option value="{{$dept->id}}">{{$dept->name}}</option>
                              @endif
                            @endforeach
                          </select>
                        </div>
                        @error('editDesc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <input type="submit" class="btn btn-primary pull-right" value="Select">
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
      var editClicked, deleteClicked, updateClicked;
      $(document).ready(function() {
        $('.edit').click(function() {
          editClicked = true;
        });

        $('.del').click(function(){
          deleteClicked = true;
        })

        $('.update').click(function(){
          updateClicked = true;
        })

        $('.table-row:has(td)').click(function() 
        {
            var rowId = $(this).attr('value');
            var editName = $(this).find('td:eq(0)').text();
            var editDesc = $(this).find('td:eq(1)').text();
            var editHead = $(this).find('td:eq(2)').text();
            if(editClicked){
              console.log(rowId);
              $('#editId').val(rowId);
              $('#editName').val(editName);
              $('#editDesc').val(editDesc);
              $('#edit-area').modal();
              editClicked = false;
            } else if(deleteClicked){
              $('#deleteId').val(rowId);
              $('#deleteMessage').html('Do you want to delete "'+editName+'"?');
              $('#delete-area').modal();
              deleteClicked = false;
            } else if(updateClicked){
              $('#editHeadId').val(rowId);
              $('#currentHead').val(editHead);
              $('#update-head').modal();
              deleteClicked = false;
            }else {
              if('{{Auth::user()->type}}' == 1){
                //window.location.href="agency/"+rowId+"/colleges";
                //window.location.href="/accreditation/"+rowId;
              } else if('{{Auth::user()->type}}' == 4 || '{{Auth::user()->type}}' == 5){
                //window.location.href="/accreditation/"+rowId+"/department/"+{{Auth::user()->dept_id}}+"/areas";
              }
            } 
        });

        $('#deleteForm').submit(function(e)
        {
            e.preventDefault();
            var deleteForm = $(this).serialize();
            $.post('/deleteArea', deleteForm, function(data){
              //window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas";
            })
        });

        $('#updateHead').submit(function(e)
        {
            e.preventDefault();
            var editForm = $(this).serialize();
            $.post('/editAreaHead', editForm, function(data){
              console.log(data);
              window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas";
            })
        });

        $('#listDepartments').submit(function(e)
        {
            e.preventDefault();
            var select = $('#curHead').val();
            window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+select+"/areas";
        });

        $('#editForm').submit(function(e)
        {
            e.preventDefault();
            var editForm = $(this).serialize();
            // $.post('/editArea', editForm, function(data){
            //   console.log(data);
            //   window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas";
            // })
        });

        $('#addForm').submit(function(e)
        {

            e.preventDefault();
            $('#notAvailable').remove();
            var addForm = $(this).serialize();
            if ($('#name').val() == '' || $('#desc').val() == '') {
                alert("Enter a Valid Input");
            }else{
              $.post('/insertArea', addForm, function(data){
                window.location.href="/accreditation/"+{{$agency->id}}+"/department/"+{{$department->id}}+"/areas";
              })
            };
        });
      });
</script>
@endsection
