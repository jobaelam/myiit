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
            <small>Areas</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="box">
                <div class="box-header with-border">
                  <select name="department" id="department" class="form-control" style="width: auto;">
                    <option value="">View All Area</option>
                    @foreach($departments as $dept)
                        <option value="{{$dept->id}}">{{$dept->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="box-body table-responsive">
                        <table id="area" class="table table-hover" style="table-layout:fixed;">
                          <tr>
                            <th>Area</th>
                            <th>Department</th>
                            <th>Head</th>
                            @if( Auth::user()->id == 1)
                              <th width="5%">Action</th>
                            @endif
                          </tr>
                          @if(count($areas) > 0)
                             @foreach($areas as $area)
                                <tr value="{{$area->id}}" class="table-row">
                                  <td>{{$area->hasArea->name}}</td>
                                  <script>console.log('{{$area->hasArea->name}}')</script>
                                  <td>{{$area->hasDepartment->name}}</td>
                                  @if($area->head == null)
                                    <td>Not Yet Assigned</td>
                                  @else
                                    <td>Prof. {{$area->headUser->first_name}} {{$area->headUser->last_name}}</td>
                                  @endif
                                  @if( Auth::user()->id == 1)
                                    <td>
                                      <button class="del btn-xs btn-danger" hidden><i class="fa fa-remove"></i></button>
                                    </td> 
                                  @endif
                                </tr>
                             @endforeach
                          @else
                          <tr><td>No Areas Available</td></tr>
                          @endif
                        </table>
                        <hr style="padding: 0px; margin: 0px; padding-bottom: 10px">
                        <a href="/accreditation" class="btn btn-default"><i class="fa fa-arrow-left"><span> Return</span></i></a>
                        @if( Auth::user()->id == 1)
                        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-default">
                          <i class="fa fa-plus-circle"><span> Add Area</span></i>
                        </button>
                        <button id="edit" type="button" class="btn btn-default pull-right" style="margin-right:1rem">Edit</button>
                        @endif
                        
                </div>
                 
            </div>
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                  </div>
                  <div class="modal-body">
                        <form action="" method="POST" id="myForm">
                            @csrf
                            <input name="agency_id" type="hidden" value="{{$agency->id}}">
                            <div class="form-group">                  
                                <label for="name">Area</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Area Number">
                            </div>
                            <div class="form-group">                  
                                <label for="desc">Description</label>
                                <input id="desc" name="desc" type="textArea" class="form-control" placeholder="Description">
                            </div>
                            {{-- <div class="form-group">                  
                                <label for="head">Department</label>
                                <select name="department" id="department" class="form-control @error('dept') is-invalid @enderror">
                                    <option value="" disabled selected>--Select Department--</option>
                                    @foreach($departments as $dept)
                                        <option value="{{$dept->id}}">{{$dept->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">                  
                                <label for="head">Head</label>
                                <select name="head" id="head" class="form-control @error('head') is-invalid @enderror">
                                    <option value="" disabled selected>--Select Head--</option>
                                </select>
                            </div> --}}
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
  </div>
<!-- jQuery 3 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
        $(document).ready(function() {
          $('.table-row:has(td)').click(function() {
              var val = $(this).attr('value');
               window.location.href="/files/"+val;
          });

          $('#edit').click(function() {
              $('.del').toggle();
              $(this).text(function(i, text){
                  return text === "Edit" ? "Cancel" : "Edit";
              })
          });

          $('#department').change(function(e)
          {
              $('#area').empty();
              var department = $(this).val();
              var agency = {{$agency->id}};
              console.log(department,agency);
              $.get('/showArea',{department:department, agency: agency},function(data)
              {
                if({{Auth::user()->id}} == 1){
                var display = '<th width="5%">Action</th></tr>';
                } else {
                var display = '</tr>';
                }
                $('#area').append('<tr><th>Area</th><th>Department</th><th>Head</th>'+display);   
                console.log(data);
                if(data.length >= 0){
                  console.log(data);
                  // for(var i = 0; i < data.length; i++){
                  //   console.log(data[i]['head']);
                    // if(data[i]['head'] == null){
                    //   var head = '<td>Not Yet Assigned</td>';
                    // } else{
                    //   var head = '<td>Prof. '+data[i]['head']['first_name']+' '+data[i]['id']['head']['last_name']+'</td>'
                    // }

                  //   // if({{Auth::user()->id}} == 1){
                  //   //   var action = '<td><button class="del btn-xs btn-danger" hidden><i class="fa fa-remove"></i></button></td></tr>';
                  // }

                  //   var display = '<tr value="'+data[i]['id']+'" class="table-row">'
                  //   '<td>'+data[i]['area']+'</td>'+
                  //   '<td>'+data[i]['department']+'</td>'+head;
                  //   $('#area').append(display);
                  // }
                }      
                // else
                //   $('#area').append('<tr><td>No Areas Available</td></tr>');
                // }
              });
          });

          $('#myForm').submit(function(e)
          {
              e.preventDefault();
              $('#modal-default').modal('hide');
              form = $(this).serialize();
              console.log(form);
              insertArea();
          });

          function insertArea()
          {
            $.post('/insertArea', form, function(data){
              console.log(data);
              //window.location.href="/areas/{{$agency->id}}";
            })
        } 
});
</script>
@endsection
