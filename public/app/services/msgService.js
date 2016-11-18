angular.module('internal').service('msgService', function($http) {

	this.getConversations = function() {
            return $http.get('/conversation').then(
                    function success(response) {
                            return response.data;
                    },
                    function error(response) {
                            console.log(response);
                    }
            );
	};

	this.searchConversation = function(requestBody) {
            return $http.post('/conversation/search', requestBody).then(
                    function success(response) {
                            return response.data;
                    },
                    function error(response) {
                            console.log(response);
                    }
            );
	};

	this.createConversation = function(requestBody) {
            return $http.post('/conversation', requestBody).then(
                    function success(response) {
                            return response.data;
                    },
                    function error(response) {
                            console.log(response);
                    }
            );
	};

	this.sendMessage = function(requestBody) {
            return $http.post('/message', requestBody).then(
                    function success(response) {
                            return response.data;
                    },
                    function error(response) {
                            console.log(response);
                    }
            );
	};

	this.getMessages = function(conversationId) {
            return $http.get('/conversation/' + conversationId).then(
                    function success(response) {
                            return response.data;
                    },
                    function error(response) {
                            console.log(response);
                    }
            );
	};
        
        /**
         * Queries the amount of conversations that contain
         * messages not yet read by the current user.
         * @returns Number
         */
        this.getUnreadConversations = function() {
            return $http.get('/conversation/unread').then(
                    function success(response) {
                        return response.data;
                    },
                    function error(response) {
                        console.error(response);
                    }
            );
        };

});
