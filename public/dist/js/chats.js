var username,chat;

$(document).ready(function()
{
    $("li").click(function(){
  // If this isn't already active
  if (!$(this).hasClass("active")) {
    // Remove the class from anything that is active
    $("li.active").removeClass("active");
    // And make this active
    $(this).addClass("active");}
        chat = $(this).attr('value');
    
    pullData();

    $(document).keyup(function(e) {
        if (e.keyCode == 13)
            sendMessage();
        else
            isTyping();
    });

    });
    
});

function pullData()
{
    retrieveChatMessages();
    retrieveTypingStatus();
    // setTimeout(pullData,3000);
}

function retrieveChatMessages()
{   
    $.get('/retrieveChatMessages/'+chat, function(data)
    {
        // if (data.length > 0)
        console.log(data);
        // $('div.direct-chat-msg').append('<div class="direct-chat-text">'+data+'</div>');
    });
}

function retrieveTypingStatus()
{
    $.post('/retrieveTypingStatus', {username: username}, function(username)
    {
        if (username.length > 0)
            $('#typingStatus').html(username+' is typing');
        else
            $('#typingStatus').html('');
    });
}

function sendMessage()
{
    var text = $('#text').val();
    if (text.length > 0)
    {
        alert(chat+''+text);
        $.post('/sendMessage', {chat: chat, text: text }, function(data)
        {
            // $('#chat-window').append('<br><div style="text-align: right">'+text+'</div><br>');
            // $('#text').val('');
            console.log(data)
            notTyping();
        });
    }
}

function isTyping()
{
    $.post('/isTyping', {_token:"{{csrf_token()}}",username: username},function(){
        alert('lol');
    });
}

function notTyping()
{
    $.post('/notTyping', {username: username});
}