angular.module('internal').service('feedService', function($http) {

  this.like = function(feedId) {
    return $http.post('/feed/' + feedId + '/like').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  this.unlike = function(feedId) {
    return $http.post('/feed/' + feedId + '/unlike').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  this.dislike = function(feedId) {
    return $http.post('/feed/' + feedId + '/dislike').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  this.undislike = function(feedId) {
    return $http.post('/feed/' + feedId + '/undislike').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

});
