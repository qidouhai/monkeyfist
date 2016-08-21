var app = angular.module("internal");

app.controller("NavbarController", function($scope, $http, $routeParams) {

	$scope.items = [];

    $scope.search = function(term) {
    	if(term.trim() != '') {
    		$http.get('/search/' + term).then(
	    		function(response) {
	    			let result = [];

	    			for(let i = 0; i < response.data.items.length; i++) {
	    				result = result.concat(
	    					response.data.items[i].children.map(function(obj) {
	    						obj.type = response.data.items[i].type;
	    						return obj;
	    					})
	    				);
	    			}
	    			$scope.items = result;
	    		}, function() {
	    			console.log(response);
	    		});
    	}
    };

    $scope.groupFN = function(item) {
    	if(item.type == 'user') {
    		return 'Users';	
    	}
    	if(item.type == 'feed') {
    		return 'Feeds';
    	}
    }
});