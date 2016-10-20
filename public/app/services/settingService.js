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

});
