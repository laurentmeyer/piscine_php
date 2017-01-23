(new window.User).login()
.then(function()
{
    console.log("------");
    (new window.Lobby()).start(function()
    {
        console.log("END OF LOBBY PROCESS")
    });
})
.catch(function()
{
    console.log("non");
    // window.location.reload();
})

curr_chat = {};

var fill_chat = function(msg)
{
    document.querySelector('.chat-list').innerHTML = '';
    axios.get('/api/chat/chat.php')
    .then(function(content)
    {
        if(content.data == curr_chat)
            return;

        var i = Object.keys(content.data).length - 1;
        while(i)
        {
            var li = document.createElement('li');
        
            li.innerText = Object.keys(content.data[i])[0] + ' : ' + content.data[i][Object.keys(content.data[i])];
            
            document.querySelector('.chat-list').appendChild(li);
            i--;
        }
        if(msg)
        {
           var li = document.createElement('li');
           li.innerText = "moi : " + msg;
           document.querySelector('.chat-list').appendChild(li);
        }
    });
}

document.querySelector('#chat').addEventListener('submit',function(ev)
{
    ev.preventDefault();
    ev.stopPropagation();
    
    var msgBox = document.querySelector("#msg");
    var msg = msgBox.value;
    msgBox.value = "";
    
    
    var params = new URLSearchParams();
    params.append('msg',msg);

    console.log("sent:",msg);
    axios.post('/api/chat/speak.php',params)
    .then(function(res)
    {
        fill_chat(msg);
    });
});

fill_chat();

setInterval(function()
{
    fill_chat();
},15000);

axios.get('/api/user/classement.php').then(function(res)
{
    var div = document.createElement('div');
    
    
    div.innerHTML   = "meilleur joueur : " + res.data[0].joueur + '<br>' 
                    + "second : " + res.data[1].joueur + '<br>'
                    + "troisième :" + res.data[2].joueur + '';
    
    document.querySelector('.user_connect').appendChild(div);
    console.log(res.data[0]);
})