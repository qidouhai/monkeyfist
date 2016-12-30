var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();
redis.subscribe('messenger-channel', function(err, count) {
});
redis.on('message', function(channel, message) {
    console.log('Broadcasting on channel: ' + channel + ': ' + message);
    message = JSON.parse(message);
    
    message.data.message.author = getMessageAuthor(message);
    for(var i = 0; i < message.data.participants.length; i++) {
    	io.emit(channel + ':' + message.data.participants[i].user_id, message.data.message);
    }

    // io.emit(channel, message.data);
});
http.listen(3000, function(){
    console.log('Listening on Port 3000');
});

// add the user_id of the message author to the message
function getMessageAuthor(message) {
    let author = message.data.message.participant; // participant id
    
    for(let i = 0; i < message.data.participants.length; i++) {
        if(message.data.participants[i].id === author) {
            return message.data.participants[i].user;
        }
    }
    return null;
}