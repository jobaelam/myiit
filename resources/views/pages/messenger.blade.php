@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    {{-- <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li> --}}
    <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
    <li class="active"><a href="/messenger"><i class="fa fa-inbox"></i> <span>Message</span></a></li>
    @if($request != null OR Auth::user()->type == 1 OR Auth::user()->type == 2 OR Auth::user()->type == 3 OR Auth::user()->type == 4)
    <li class="treeview">
      <a href="#">
        <i class="fa fa-hourglass-o"></i> <span>Requests</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/request"><i class="fa fa-flag"></i> Parameter</a></li>
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
        Message
        </h1>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-2">
    
            <div class="box box-solid collapsed-box">
                <div class="box-header with-border">
                <h3 class="box-title">Inbox</h3>
    
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
                </div>
                <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    @if(count($chats) > 0)
                        @foreach($chats as $chat)
                        @csrf
                            <li value="{{$chat->user2}}" ><a href="#"><span>{{$chat->hasUser2->first_name}}</span> </a></li>
                            <span class="label label-primary pull-right">12</span>
                        @endforeach
                     @endif
                     @if(count($chats2) > 0)
                        @foreach($chats2 as $chat)
                        @csrf
                            <li value="{{$chat->user1}}" ><a href="#"><span>{{$chat->hasUser1->first_name}}</span> </a></li>
                        @endforeach
                     @endif
                </ul>
                </div>
            </div>

            {{-- <div class="box box-solid collapsed-box">
                <div class="box-header with-border">
                <h3 class="box-title">Group</h3>
                <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        
                    </ul>
                    </div>
                <!-- /.box-body -->
            </div> --}}

            <div class="box box-solid collapsed-box">
                <div class="box-header with-border">
                <h3 class="box-title">All Contacts</h3>
                <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        @if(count($users) > 0)
                            @foreach($users as $user)
                            @csrf
                                @if(Auth::user()->id != $user->id and $user->id != 1)
                                    <li value="{{$user->id}}" ><a href="#"><span>{{$user->first_name}}</span> </a></li>
                                @endif
                            @endforeach
                         @endif
                    </ul>
                    </div>
                <!-- /.box-body -->
            </div>
            </div>
            <!-- /.col -->

            <div id="chatBox" class="col-md-6" hidden>
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box table-responsive direct-chat direct-chat-primary">
                <div id='h3name' class="box-header with-border">
                <h3 id='h3name' class="box-title">Direct Chat</h3>
    
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages"></div>
                <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                    <div class="input-group">                    
                        <input id="text" type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="reset" onClick="sendMessage()" class="btn btn-primary btn-flat">Send</button>
                            </span>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
            </div>

            <div class="col-md-2">
    
            
            </div>
            <!-- /.col -->
          
            </div>
            <!-- /.col -->
        </div>
        {{-- <div class="box">
            <div class="col-lg-4 col-lg-offset-4">
                <h1 id="greeting">Hello, <span id="username">{{Auth::user()->id}}</span></h1>
        
                <div id="chat-window" class="col-lg-12">
        
                </div>
                <div class="col-lg-12">
                    <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                    <input type="text" id="text" class="form-control col-lg-12" autofocus="" onblur="notTyping()">
                </div>
            </div>
        </div> --}}
    </section>
    <!-- /.content -->
    </div>
@endsection
