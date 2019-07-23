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
            {{$parameter->name}}
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
                          <tr class="active">
                            <th>Name</th>
                            <th width="10%">View</th>
                            <th width="10%">Type</th>
                            <th width="10%">Date Added</th>
                            <th width="10%">Action</th>
                          </tr>
                          @if(count($files) > 0)
                             @foreach($files as $file)
                              @if($file->viewType == 2 OR $area->head == Auth::user()->id OR Auth::user()->id == 1)
                                  <tr value="{{$file->id}}" class="table-row">
                                    <td>{{$file->fileName}}</td>
                                    <td>{{$file->viewType}}</td>
                                    <td>{{$file->fileType}}</td>
                                    <td>{{date('M d, Y',strtotime($file->created_at))}}</td>
                                    <td>
                                      @if(Auth::user()->id == 1 OR $area->head == Auth::user()->id)
                                        <button type="button" class="download btn-xsm btn-default"  style="width: 55%">Download</button>
                                        <button type="button" class="del btn-xsm btn-danger"  style="width: 40%">Delete</button>
                                      @else
                                        <button class="request btn-xs btn-warning" style="width: 100%">Request</button>
                                      @endif
                                    </td> 
                                  </tr>
                              @elseif($file->viewType == 3 AND $area->departmentId == Auth::user()->dept_id)
                                <tr value="{{$file->id}}" class="table-row">
                                    <td>{{$file->fileName}}</td>
                                    <td>{{$file->fileType}}</td>
                                    <td>{{date('M d, Y',strtotime($file->created_at))}}</td>
                                    <td>
                                      
                                    </td> 
                                </tr>
                              @else
                                
                              @endif
                             @endforeach
                          @else
                          <tr><td>No File Available</td></tr>
                          @endif
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        <a href="/accreditation/{{$agency}}/department/{{$department}}/area/{{$area->id}}/parameters" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
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
                            <input name="parameter" type="hidden" value="{{$parameter->id}}">
                            <input name="agency" type="hidden" value="{{$agency}}">
                            <input name="access" type="hidden" value="{{$area->id}}">
                            <input name="userId" type="hidden" value="{{Auth::user()->id}}">
                            <div class="form-group">                  
                                <label for="file">Upload File</label>
                                <input type="file" name="uploadFile">
                            </div>
                            <div class="form-group">
                              <select name='view'>
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
            <div class="modal fade" id="edit-file">
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

    // $('.edit').click(function() {
    //       editClicked = true;
    //     });
        var deleteClicked, updateClicked, requestClicked;
        $('.del').click(function(){
          deleteClicked = true;
        })

        $('.update').click(function(){
          updateClicked = true;
        })

        $('.request').click(function(){
          requestClicked = true;
        })

        $('.table-row:has(td)').click(function() 
        {
            var rowId = $(this).attr('value');
            var editName = $(this).find('td:eq(0)').text();
            var request = $(this).find('.request').text();
            // if(editClicked){
            //   console.log(rowId);
            //   $('#editId').val(rowId);
            //   $('#editName').val(editName);
            //   $('#edit-file').modal();
            //   editClicked = false;
            // } else 
            if(deleteClicked){
              $('#deleteId').val(rowId);
              $('#deleteMessage').html('Do you want to delete "'+editName+'"?');
              $('#delete-file').modal();
              deleteClicked = false;
            }else if(requestClicked){
               $.post('/requestArea', {_token:"{{csrf_token()}}",access: rowId, user:'{{Auth::user()->id}}',department: '{{$department}}', agency: '{{$agency}}'}, function(data){
                window.location.href="/accreditation/"+{{$agency}}+"/department/"+{{$department}}+"/areas";
               })
              requestClicked = false;
            }else {
                  window.location.href="area/"+rowId+"/parameters/";
            } 
        });

        $('#deleteForm').submit(function(e)
        {
            e.preventDefault();
            var deleteForm = $(this).serialize();
            $.post('/deleteArea', deleteForm, function(data){
              //window.location.href="/accreditation/"+{{$agency}}+"/department/"+{{$department}}+"/areas";
            })
        });

        $('#updateHead').submit(function(e)
        {
            e.preventDefault();
            var editForm = $(this).serialize();
            $.post('/editAreaHead', editForm, function(data){
              console.log(data);
              window.location.href="/accreditation/"+{{$agency}}+"/department/"+{{$department}}+"/areas";
            })
        });

        $('#listDepartments').submit(function(e)
        {
            e.preventDefault();
            var select = $('#curHead').val();
            console.log(select);
            window.location.href="/accreditation/"+{{$agency}}+"/department/"+select+"/areas";
        });

        // $('#editForm').submit(function(e)
        // {
        //     e.preventDefault();
        //     var editForm = $(this).serialize();
        //     $.post('/editArea', editForm, function(data){
        //       window.location.href="/accreditation/"+{{$agency}}+"/department/"+{{$department}}+"/areas";
        //     })
        // });

        $('#addForm').submit(function(e)
        {

            e.preventDefault();
            $('#notAvailable').remove();
            var addForm = $(this).serialize();
            if ($('#name').val() == '' || $('#desc').val() == '') {
                alert("Enter a Valid Input");
            }else{
              $.post('/insertArea', addForm, function(data){
                window.location.href="/accreditation/"+{{$agency}}+"/department/"+{{$department}}+"/area/"+{{$area->id}}+"/parameters/"+{{$parameter->id}}+"/files";
              })
            };
        });
  });
</script>
@endsection
