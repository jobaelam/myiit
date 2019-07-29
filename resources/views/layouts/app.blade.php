<!DOCTYPE html>
<html>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name', 'My.IIT')}} | Dashboard</title>
  <link rel="icon" type="image/png" href="/dist/logo/msuiit.png" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" type="text/css" href="/css/unselectable.css">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
  {{-- <link rel="stylesheet" href="/dist/css/chats.css"> --}}
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>My</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>My.IIT</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span id="unreadMessagesNumber" class="label label-success"></span>
            </a>
            <ul class="dropdown-menu">
              <li id="unreadMessagesHeader" class="header">
                You have no message yet.
              </li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul id="listOfMessages" class="menu"></ul>
              </li>
              <li class="footer"><a href="/messenger">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              {{-- <span class="requestCount label label-warning"></span> --}}
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <span class="requestCount">0</span> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      {{-- <i class="fa fa-users text-aqua"></i> 5 new members joined today --}}
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="/request">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{Auth::user()->profile_image}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->first_name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{Auth::user()->profile_image}}" class="img-circle" alt="User Image">

                <p>
                    @if(Auth::user()->first_name == 'Admin' OR Auth::user()->first_name == 'Admin')
                    {{Auth::user()->first_name}} 
                    @else
                    {{Auth::user()->fullName()}}
                    @endif
                  @if(Auth::user()->id != 1)
                  <small>{{Auth::user()->hasType->name}}</small>
                  @endif
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="text-center">
                  <button class="btn btn-block btn-default" disabled><i class="fa fa-envelope"></i> {{Auth::user()->email}}</button>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Sign out') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
        

        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
            <div class="pull-left image">
                <img src="{{Auth::user()->profile_image}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                  @if(Auth::user()->first_name == 'Admin' OR Auth::user()->first_name == 'Admin')
                  {{Auth::user()->first_name}} 
                  @else
                  {{Auth::user()->fullName()}}
                  @endif
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            </div>
            @yield('sidebar')
        </section>
        <!-- /.sidebar -->
        </aside>

        @yield('content')

    <footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
    </footer>
    
    </div>
    <!-- ./wrapper -->
    
    <!-- jQuery 3 -->
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="/bower_components/moment/min/moment.min.js"></script>
    <script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- DataTables -->
    <script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <script src="/dist/js/demo.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script>
    var user1,user2;
    var count = 0;

    $(document).ready(function()
    {   
        $('.table').DataTable({
          "order": [],
        });
        $('#text').val('');
        user1 = {{Auth::user()->id}};
        displayMessages();
        displayRequest();
        $('div.box ul li').click(function(){
            if (!$(this).hasClass("active")) {
                $('li.active').removeClass("active");
                $('div.direct-chat-msg').remove();
                $('#chatBox').show();
                $('#text').val('');
                $(this).addClass("active").attr("disabled");  
                user2 = $(this).attr('value');
                notTyping();  
                console.log(user2);
                $("#text").keyup(function(e) {
                        isTyping();
                });
                if(user2 != null){
                retrieveExistingMessages();
                pullData(); 
                }
            }; 
        });

    });

    function pullData()
    {
        retrieveChatMessages();
        retrieveTypingStatus();
        setTimeout(pullData,1500);
    }

    function displayMessages()
    {  
      $.get('/displayMessages', {_token:"{{csrf_token()}}",user1: user1}, function(data)
      {
          for (i = 0; i < data.length && i < 5; i++) { 
            if(data[i]['unread'] == 0 && data[i]['sender'] != '{{Auth::user()->id}}'){
              ++count;
              var message = '<li><a href="#">'+
                '<div class="pull-left">'+
                '<img src="'+data[i]['profilePicture']+'" class="img-circle" alt="User Image">'+
                '</div><h4><b>'+data[i]['user']+'</b><small>'+data[i]['timeStamp']+'</small></h4>'+
                '<p><b>'+data[i]['message']+'</b></p></a></li>';
                $('#listOfMessages').append(message);
            } else {
              var message = '<li><a href="#">'+
                '<div class="pull-left">'+
                '<img src="'+data[i]['profilePicture']+'" class="img-circle" alt="User Image">'+
                '</div><h4>'+data[i]['user']+'<small>'+data[i]['timeStamp']+'</small></h4>'+
                '<p><b>'+data[i]['message']+'</b></p></a></li>';
                $('#listOfMessages').append(message);
            }
          }
          if(count > 0){
            $('#unreadMessagesNumber').html(count);
            $('#unreadMessagesHeader').html('You have '+count+' new messages');            
          } else {
            $('#unreadMessagesHeader').html('You have no new messages'); 
          }
        });
    }

    function displayRequest()
    {  
      $.get('/displayRequest', {_token:"{{csrf_token()}}",user: user1}, function(data)
      {
        //console.log(data.length);
        // if(data.length > 0)
        //   for(var j = 0;data[0].length > j; j++){
        //      console.log(data[0].length);
        //   }
        //   for(var j = 0;data[1].length > j; j++){
        //      console.log(data[1].length);
        //      var file = data[1][j].length;
        //   }
          $('.requestCount').html(data[0].length + data[1].length);
      });
    }

    function retrieveExistingMessages()
    {  
        $.post('/retrieveExistingMessages', {_token:"{{csrf_token()}}",user1: user1, user2: user2}, function(data)
        {
            for (i = 0; i < data.length; i++) { 
            if(data[i]['user'] == "{{Auth::user()->first_name}}"){
                var message = '<div class="direct-chat-msg right">' +
                '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-right">'+data[i]['user']+'</span>'+
                '<span class="direct-chat-timestamp pull-left">'+data[i]['timeStamp']+'</span>'+
                '</div>'+
                '<img class="direct-chat-img" src="'+data[i]['profilePicture']+'" alt="Message User Image">'+
                '<div class="direct-chat-text">'+data[i]['message']+'</div>'+
                '</div>';
                $('div.direct-chat-messages').append(message);
            }else{
                var message = '<div class="direct-chat-msg">' +
                '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-left">'+data[i]['user']+'</span>'+
                '<span class="direct-chat-timestamp pull-right">'+data[i]['timeStamp']+'</span>'+
                '</div>'+
                '<img class="direct-chat-img" src="'+data[i]['profilePicture']+'" alt="Message User Image">'+
                '<div class="direct-chat-text">'+data[i]['message']+'</div>'+
                '</div>';
                $('div.direct-chat-messages').append(message);
            }
            }
        });
    }

    function retrieveChatMessages()
    {   
        $.post('/retrieveChatMessages', {_token:"{{csrf_token()}}",user1: user1, user2: user2}, function(data)
        {
            if(data.length > 0){
                console.log(data);
                var message = '<div class="direct-chat-msg">' +
                '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-left">'+data[0]['sender']+'</span>'+
                '<span class="direct-chat-timestamp pull-right">'+data[0]['timeStamp']+'</span>'+
                '</div>'+
                '<img class="direct-chat-img" src="'+data[i]['profilePicture']+'" alt="Message User Image">'+
                '<div class="direct-chat-text">'+data[0]['message']+'</div>'+
                '</div>';
                $('div.direct-chat-messages').append(message);
            }
        });
    }

    function retrieveTypingStatus()
    {
        $.post('/retrieveTypingStatus', {_token:"{{csrf_token()}}",user1: user1, user2: user2}, function(data)
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
            $.post('/sendMessage', {_token:"{{csrf_token()}}",user1: user1, user2: user2, text: text}, function(data)
            {
                console.log(data);
                var message = '<div class="direct-chat-msg right">' +
                '<div class="direct-chat-info clearfix">'+
                '<span class="direct-chat-name pull-right">'+data['sender']+'</span>'+
                '<span class="direct-chat-timestamp pull-left">'+data['timeStamp']+'</span>'+
                '</div>'+
                '<img class="direct-chat-img" src="'+data['profilePicture']+'" alt="Message User Image">'+
                '<div class="direct-chat-text">'+data['message']+'</div>'+
                '</div>';
                $('div.direct-chat-messages').append(message);
                $('#text').val('');
                notTyping();
            });
        }
    }

    function isTyping()
    {
        $.post('/isTyping', {_token:"{{csrf_token()}}",user1: user1, user2: user2});
    }

    function notTyping()
    {
        $.post('/notTyping', {_token:"{{csrf_token()}}",user1: user1, user2: user2});
    }
    </script>
    </body>
    </html>
    