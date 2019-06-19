var username,user2;

$(document).ready(function()
{
    $("li").click(function(){
  // If this isn't already active
  if (!$(this).hasClass("active")) {
    // Remove the class from anything that is active
    $("li.active").removeClass("active");
    // And make this active
    $(this).addClass("active");}
        user2 = $(this).attr('value');
    username = $('#id').val();
    
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
    $.get('/retrieveChatMessages/'+username+'/'+user2, function(data)
    {
        console.log(data);
        // if (data.length > 0)
        //  $('#direct-chat-text').append('<div class="direct-chat-text">'+data+'</div>');
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
        $.post('sendMessage', {text: text, username: username}, function()
        {
            $('#chat-window').append('<br><div style="text-align: right">'+text+'</div><br>');
            $('#text').val('');
            notTyping();
        });
    }
}

function isTyping()
{
    alert(username);
    $.post('/isTyping', {_token:"{{csrf_token()}}",username: username},function(){
        alert('lol');
    });
}

function notTyping()
{
    $.post('/notTyping', {username: username});
}