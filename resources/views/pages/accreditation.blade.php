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
    Accreditaion
    <small>Agency</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-body table-responsive">
                <table class="table table-hover" style="table-layout:fixed;">
                  <tr>
                    <th>Agencies</th>
                    <th>Description</th>
                    <th style="width: 25%">Status</th>
                    @if( Auth::user()->id == 1)
                      <th width=10%>Action</th>
                    @endif
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
                        @if( Auth::user()->id == 1)
                          <td>
                            <button type="button" class="edit btn-xsm btn-default"  style="width: 45%">Edit</button>
                            <button type="button" class="del btn-xsm btn-danger"  style="width: 50%">Delete</button>
                          </td> 
                        @endif
                      </tr>
                     @endforeach
                  @else
                      <tr id="notAvailable"><td>No Agency Available</td></tr>
                  @endif
                </table>
                <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                @if( Auth::user()->id == 1)
                  <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#add-agency">
                    <i class="fa fa-plus-circle"><span> Add Agency</span></i>
                  </button>
                @endif
        </div>
      </div>
    <div class="modal fade" id="add-agency">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Agency Details</h4>
          </div>
          <div class="modal-body">      
            <form action="" method="POST" id="addForm">
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
    <div class="modal fade" id="edit-agency">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Details</h4>
          </div>
          <div class="modal-body">      
            <form action="" method="POST" id="editForm">
                @csrf
                <input type="hidden" name="editId" id="editId" value="">
                <div class="form-group">                  
                  <label for="editName">Agency</label>
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
    <div class="modal fade" id="delete-agency">
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
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
      var editClicked, deleteClicked;
      $(document).ready(function() {
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
            var editDesc = $(this).find('td:eq(1)').text();
            if(editClicked){
              $('#editId').val(rowId);
              $('#editName').val(editName);
              $('#editDesc').val(editDesc);
              $('#edit-agency').modal();
              editClicked = false;
            } else if(deleteClicked){
              $('#deleteId').val(rowId);
              $('#deleteMessage').html('Do you want to delete "'+editName+'"?');
              $('#delete-agency').modal();
              deleteClicked = false;
            }else {
              if('{{Auth::user()->type}}' == 1){
                //window.location.href="agency/"+rowId+"/colleges";
                window.location.href="/accreditation/"+rowId;
              } else if('{{Auth::user()->type}}' == 4 || '{{Auth::user()->type}}' == 5){
                window.location.href="/accreditation/"+rowId+"/department/"+{{Auth::user()->dept_id}}+"/areas";
              }
            } 
        });

        $('#deleteForm').submit(function(e)
        {
            e.preventDefault();
            var deleteForm = $(this).serialize();
            $.post('/deleteAgency', deleteForm, function(data){
              window.location.href="accreditation";
            })
        });

        $('#editForm').submit(function()
        {
            var editForm = $(this).serialize();
            $.post('/editAgency', editForm, function(){
              window.location.href="accreditation";
            })
        });

        $('#addForm').submit(function(e)
        {
            e.preventDefault();
            $('#notAvailable').remove();
            var addForm = $(this).serialize();
            if ($('#name').val() == '' || $('#desc').val() == '') {
                alert("Enter a Valid Input");
            }else{
              $.post('/insertAgency', addForm, function(){
                window.location.href="accreditation";
              })
            };
        });
      });
</script>
@endsection