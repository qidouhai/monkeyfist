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
    io.emit(channel, message.data);
});
http.listen(3333, function(){
    console.log('Listening on Port 3333');
});