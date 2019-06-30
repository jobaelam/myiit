var user,chat;
function pullData()
{
    retrieveChatMessages();
    retrieveTypingStatus();
    setTimeout(pullData,1500);
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
            '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
            '<div class="direct-chat-text">'+data[i]['message']+'</div>'+
            '</div>';
            $('div.direct-chat-messages').append(message);
        }else{
            var message = '<div class="direct-chat-msg">' +
            '<div class="direct-chat-info clearfix">'+
            '<span class="direct-chat-name pull-left">'+data[i]['user']+'</span>'+
            '<span class="direct-chat-timestamp pull-right">'+data[i]['timeStamp']+'</span>'+
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
    $.post('/retrieveChatMessages', {_token:"{{csrf_token()}}",user1: user1, user2: user2}, function(data)
    {
        if(data.length > 0){
            console.log(data);
            var message = '<div class="direct-chat-msg">' +
            '<div class="direct-chat-info clearfix">'+
            '<span class="direct-chat-name pull-left">'+data[0]['sender']+'</span>'+
            '<span class="direct-chat-timestamp pull-right">'+data[0]['timeStamp']+'</span>'+
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
            '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
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