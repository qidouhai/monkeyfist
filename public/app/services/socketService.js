angular.module('internal').factory('socketService', function ($rootScope, msgService) {
    let socket = io('http://localhost:3000');
    
    $rootScope.notifications = {
        messenger: {
            conversations: []
        }
    };    
    let lastMessage = null;
    
    msgService.getUnreadConversations().query(function(response) {
        $rootScope.notifications.messenger.conversations = response;
    });
    
    socket.on('messenger-channel:' + $rootScope.user.id, function(data) {
        if($.inArray(data.conversation_id, $rootScope.notifications.messenger.conversations) === -1 && (data.user_id !== $rootScope.user.id))
            $rootScope.notifications.messenger.conversations.push(data.conversation_id);
        lastMessage = data;
        $rootScope.$apply();
    });

    return {
        getMessage: function() {
            return lastMessage;
        },
        on: function (eventName, callback) {
            socket.off(eventName);
            socket.on(eventName, function () {
                let args = arguments;
                $rootScope.$apply(function () {
                    callback.apply(socket, args);
                });
            });
        },
        emit: function (eventName, data, callback) {
            socket.emit(eventName, data, function () {
                var args = arguments;
                $rootScope.$apply(function () {
                    if (callback) {
                        callback.apply(socket, args);
                    }
                });
            });
        }
    };
});