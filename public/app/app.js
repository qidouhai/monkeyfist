angular.module('dropzone', []).directive('dropzone', function () {
    return function (scope, element, attrs) {
        var config, dropzone;

        config = scope[attrs.dropzone];

        // create a Dropzone for the element with the given options
        dropzone = new Dropzone(element[0], config.options);

        // bind the given event handlers
        angular.forEach(config.eventHandlers, function (handler, event) {
            dropzone.on(event, handler);
        });
    };
});

var app = angular.module("internal", ['ngRoute', 'ngSanitize', 'ui.select', 'dropzone', 'luegg.directives']);

app.config(function ($routeProvider, $locationProvider) {
    $routeProvider
            .when("/dashboard", {
                templateUrl: "/app/templates/dashboard.php",
                controller: "DashboardController",
                resolve: {
                    login: checkLogin
                }
            })
            .when("/", {
                templateUrl: "/app/templates/dashboard.php",
                controller: "DashboardController",
                resolve: {
                    login: checkLogin
                }
            })
            .when("/feed/:id", {
                templateUrl: "/app/templates/feed.php",
                controller: "FeedController",
                resolve: {
                    login: checkLogin
                }
            })
            .when("/profile/:id", {
                templateUrl: "/app/templates/profile.php",
                controller: "ProfileController",
                resolve: {
                    login: checkLogin
                }
            })
            .when("/messenger/:conversationId", {
                templateUrl: "/app/templates/messenger.php",
                controller: "MessengerController",
                resolve: {
                    login: checkLogin
                }
            })
            .when("/messenger", {
                templateUrl: "/app/templates/messenger.php",
                controller: "MessengerController",
                resolve: {
                    login: checkLogin
                }
            });

    $locationProvider.html5Mode(true);
});

let checkLogin = function ($q, $http, $rootScope) {
    let deferred = $q.defer();

    $http.get('/user').success(function (user) {
        if (user.id) {
            $rootScope.user = user;
            deferred.resolve();
        } else {
            deferred.resolve();
        }
    });

    return deferred.promise;
};
