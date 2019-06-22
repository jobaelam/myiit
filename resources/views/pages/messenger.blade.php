@extends('layouts.app')

@section('sidebar')
<ul class="sidebar-menu" data-widget="tree">
    <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
    <li><a href="/accreditation"><i class="fa fa-book"></i> <span>Accreditation</span></a></li>
</ul>
@endsection

@section('content')

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
            <div class="col-md-2">
    
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
                    @if(count($chats) > 0)
                        @foreach($chats as $chat)
                        @csrf
                            {{-- @if($user->fullName() != 'Admin Admin') --}}
                                <li value="{{$chat->id}}" ><a href="#"><span>{{$chat->hasUser2->first_name}}</span> </a></li>
                            {{-- @endif --}}
                        @endforeach
                     @endif
                     @if(count($chats2) > 0)
                        @foreach($chats2 as $chat)
                        @csrf
                            {{-- @if($user->fullName() != 'Admin Admin') --}}
                                <li value="{{$chat->id}}" ><a href="#"><span>{{$chat->hasUser1->first_name}}</span> </a></li>
                            {{-- @endif --}}
                        @endforeach
                     @endif
                    {{-- @if(count($users) > 0)
                        @foreach($users as $user)
                            @if($user->fullName() != 'Admin Admin')
                                <li value="{{$user->id}}"><a href="#"><span>{{$user->fullName()}}</span> </a></li>
                            @endif
                        @endforeach
                     @endif --}}
                </ul>
                </div>
            </div>

            <div class="box box-solid collapsed-box">
                <div class="box-header with-border">
                <h3 class="box-title">Group</h3>
                <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
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
                                {{-- @if($user->fullName() != 'Admin Admin') --}}
                                    <li value="{{$user->id}}" ><a href="#"><span>{{$user->first_name}}</span> </a></li>
                                {{-- @endif --}}
                            @endforeach
                         @endif
                    </ul>
                    </div>
                <!-- /.box-body -->
            </div>
            </div>
            <!-- /.col -->

            <div class="col-md-6">
            <!-- DIRECT CHAT PRIMARY -->
            <div class="box box-primary direct-chat direct-chat-primary">
                <div id='h3name' class="box-header with-border">
                <h3 id='h3name' class="box-title">Direct Chat</h3>
    
                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">

                </div>
                <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>
                    <div class="input-group">                    
                        <input id="text" type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                                <button type="reset" onClick="sendMessage();" class="btn btn-primary btn-flat">Send</button>
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
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script>
var user,chat;

$(document).ready(function()
{   
    $('#text').val('');
    $("li").click(function(){
    if (!$(this).hasClass("active")) {
    // Remove the class from anything that is active
    $("li.active").removeClass("active");
    $('div.direct-chat-msg').remove();
    $('#text').val('');
    // $("li.active").removeAttr("disabled");
    $(this).addClass("active").attr("disabled");    
    // $(this).attr("disabled");
    user = {{Auth::user()->id}};
    chat = $(this).attr('value');
    $("#text").keyup(function(e) {
        if (e.keyCode == 13){            
             
        }
        else{isTyping();}
    });
    retrieveExistingMessages();
    pullData();
    }; 
    });
    
});

function pullData()
{
    retrieveChatMessages();
    retrieveTypingStatus();
    setTimeout(pullData,1500);
}

function retrieveExistingMessages()
{  
    $.post('/retrieveExistingMessages', {_token:"{{csrf_token()}}",user: user, chat: chat}, function(data)
    {
        for (i = 0; i < data.length; i++) { 
        if(data[i]['user'] == "{{Auth::user()->first_name}}"){
            var message = '<div class="direct-chat-msg right">' +
            '<div class="direct-chat-info clearfix">'+
            '<span class="direct-chat-name pull-right">'+data[i]['user']+'</span>'+
            '<span class="direct-chat-timestamp pull-left">23 Jan 2:00 pm</span>'+
            '</div>'+
            '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
            '<div class="direct-chat-text">'+data[i]['message']+'</div>'+
            '</div>';
            $('div.direct-chat-messages').append(message);
        }else{
            var message = '<div class="direct-chat-msg">' +
            '<div class="direct-chat-info clearfix">'+
            '<span class="direct-chat-name pull-left">'+data[i]['user']+'</span>'+
            '<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>'+
            '</div>'+
            '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
            '<div class="direct-chat-text">'+data[i]['message']+'</div>'+
            '</div>';
            $('div.direct-chat-messages').append(message);
        }
        }
    });
}

function retrieveChatMessages()
{   
    $.post('/retrieveChatMessages', {_token:"{{csrf_token()}}",user: user, chat: chat}, function(data)
    {
        if(data.length > 0){
            console.log(data);
            var message = '<div class="direct-chat-msg">' +
            '<div class="direct-chat-info clearfix">'+
            '<span class="direct-chat-name pull-left">'+data[0]['sender']+'</span>'+
            '<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>'+
            '</div>'+
            '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
            '<div class="direct-chat-text">'+data[0]['message']+'</div>'+
            '</div>';
            $('div.direct-chat-messages').append(message);
        }
    });
}

function retrieveTypingStatus()
{
    $.post('/retrieveTypingStatus', {_token:"{{csrf_token()}}",user: user, chat: chat}, function(data)
    {
        if (data.length > 0)
            $('#typingStatus').html(data+' is typing');
        else
            $('#typingStatus').html('');
    });
}

function sendMessage()
{
    var text = $('#text').val();
    if (text.length > 0)
    {
        $.post('/sendMessage', {_token:"{{csrf_token()}}",user: user, chat: chat, text: text }, function(data)
        {
            // if (data.length > 0){
                var message = '<div class="direct-chat-msg right">' +
                '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-right">'+data['user']+'</span>'+
                '<span class="direct-chat-timestamp pull-left">23 Jan 2:00 pm</span>'+
                '</div>'+
                '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
                '<div class="direct-chat-text">'+data['message']+'</div>'+
                '</div>';
                $('div.direct-chat-messages').append(message);
                $('#text').val('');
                notTyping();
            // }
        });
    }
}

function isTyping()
{
    $.post('/isTyping', {_token:"{{csrf_token()}}",user: user, chat: chat});
}

function notTyping()
{
    $.post('/notTyping', {_token:"{{csrf_token()}}",user: user, chat: chat});
}

// function displayUserChat()
// {
//     '<div class="box box-primary direct-chat direct-chat-primary">'+
//     '<div class="box-header with-border">'+
//     '<h3 class="box-title">Direct Chat</h3>'+
//     '<div class="box-tools pull-right">'+
//     '<span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>'+
//     '<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>'+
//     '</div></div>'+
//     '<div class="box-body">'+
//     '<div class="direct-chat-messages">'+
//     '<div class="direct-chat-msg right">' +
//     '<div class="direct-chat-info clearfix">'+
//     '<span class="direct-chat-name pull-right">'+data[i]['user']+'</span>'+
//     '<span class="direct-chat-timestamp pull-left">23 Jan 2:00 pm</span>'+
//     '</div>'+
//     '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
//     '<div class="direct-chat-text">'+data[i]['message']+'</div>'+
//     '</div></div></div>'+
//     '<div class="box-footer">'+
//     '<div id="typingStatus" class="col-lg-12" style="padding: 15px"></div>'+
//     '<div class="input-group">'+
//     ' <input id="text" type="text" name="message" placeholder="Type Message ..." class="form-control">'+
//     '<span class="input-group-btn">'+
//     '<button type="submit" class="btn btn-primary btn-flat">Send</button>'+
//     '</span></div></div></div>'
// }
// </script>
@endsection
