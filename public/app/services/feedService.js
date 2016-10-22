angular.module('internal').service('feedService', function($http) {

  return like = function(feedId) {
    return $http.post('/feed/' + feedId + '/like').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  return unlike = function(feedId) {
    return $http.post('/feed/' + feedId + '/unlike').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  return dislike = function(feedId) {
    return $http.post('/feed/' + feedId + '/dislike').then(
      function success(response) {
        return response.data;
      },
      function error(response) {
        console.error(response);
      }
    );
  };

  return undislike = function(feedId) {
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
