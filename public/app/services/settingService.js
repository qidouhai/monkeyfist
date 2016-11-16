angular.module("internal").service('settingService', function($http) {

  this.setNames = function(requestBody) {
    return $http.post('/settings/account/names', requestBody).then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  this.setEmail = function(requestBody) {
    return $http.post('/settings/account/email', requestBody).then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  this.setPassword = function(requestBody) {
    return $http.post('/settings/account/password', requestBody).then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };
  
  this.getNotifications = function() {
      return $http.get('/settings/notifications').then(
        function success(response) {
            return response.data;
        },
        function error(response) {
            console.error(response);
        }
    );
  };
  
  this.setNotifications = function(requestBody) {
      return $http.post('/settings/notifications', requestBody).then(
        function success(response) {
            return response.data;
        },
        function error(response) {
            console.error(response);
        }
    );
  };
  
  this.getPrivacy = function() {
      return $http.get('/settings/privacy').then(
        function success(response) {
            return response.data;
        },
        function error(response) {
            console.error(response);
        }
    );
  };
  
  this.setPrivacy = function(requestBody) {
      return $http.post('/settings/privacy', requestBody).then(
        function success(response) {
            return response.data;
        },
        function error(response) {
            console.error(response);
        }
    );
  };

});
