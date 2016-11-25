angular.module('internal').factory('socketService', function ($rootScope) {
    let socket = io('http://monkeytest.ddns.net:3000');

    return {
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