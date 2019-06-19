@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li class="active"><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
</ul>
@endsection

@section('content')
<input type="hidden" id="id" name="id" value="{{Auth::user()->id}}">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Messeger
        {{-- <small>Home</small> --}}
        </h1>
        <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
    
            <div class="box box-solid">
                <div class="box-header with-border">
                <h3 class="box-title">Private</h3>
    
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
                </div>
                <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    @if(count($users) > 0)
                        @foreach($users as $user)
                            @if($user->fullName() != 'Admin Admin')
                                <li value="{{$user->id}}"><a href="#"><span>{{$user->fullName()}}</span> </a></li>
                            @endif
                        @endforeach
                     @endif
                </ul>
                </div>
            </div>

            <div class="box box-solid">
                <div class="box-header with-border">
                <h3 class="box-title">Group</h3>
                <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                    </div>
                    <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                                    <li class="active"><a href="#"> Group Chat<span class="label label-primary pull-right"></span></a></li>
                    </ul>
                    </div>
                <!-- /.box-body -->
            </div>
            </div>
            <!-- /.col -->
            <div class="col-md-6">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Direct Chat</h3>
    
                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                    <i class="fa fa-comments"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                    {{-- <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                    </div> --}}
                    <!-- /.direct-chat-info -->
                    {{-- <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img --> --}}
                    <div class="direct-chat-text">
                        
                    </div>
                    <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
    
                    {{-- <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                    </div>
                    <!-- /.direct-chat-info -->
                    <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        You better believe it!
                    </div>
                    <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg --> --}}
                </div>
                <!--/.direct-chat-messages-->
    
                <!-- Contacts are loaded here -->
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                    <li>
                        <a href="#">
                        <img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">
    
                        <div class="contacts-list-info">
                                <span class="contacts-list-name">
                                Count Dracula
                                <small class="contacts-list-date pull-right">2/28/2015</small>
                                </span>
                            <span class="contacts-list-msg">How have you been? I was...</span>
                        </div>
                        <!-- /.contacts-list-info -->
                        </a>
                    </li>
                    <!-- End Contact Item -->
                    </ul>
                    <!-- /.contatcts-list -->
                </div>
                <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                <form action="#" method="post">
                    <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-flat">Send</button>
                        </span>
                    </div>
                </form>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
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
