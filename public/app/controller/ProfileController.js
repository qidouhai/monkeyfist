var app = angular.module("internal");

app.controller("ProfileController", function($scope, $route, $http, $routeParams, $location, msgService, settingService) {

	$(".modal-backdrop").hide();

	settingsFactory = new SettingsFactory();

	$http.get('/friend/' + $routeParams.id).success(function(response) {
		$scope.info = response;
	});

	$scope.sendMessage = function(userId) {
		msgService.searchConversation({participants:[$scope.user.id, userId]}).then(function(response) {
			$location.url('messenger/' + response.conversation_id);
		});
	}

	$scope.sendFriendRequest = function() {
		let id = $routeParams.id;
		$http.post('/user/friends/request/' + id).then(
			function success(response) {
				if(response.data) {
					$scope.info.relation.status = "requested";
					$scope.info.relation.requestedByMe = true;
				}
			}, function error(response) {
				console.log(response);
			});
	};

	$scope.answerFriendRequest = function(answer) {
		let id = $routeParams.id;
		if(answer) {
			$http.post('/user/friends/' + id).then(
				function(response) {
					// as this is only for the profile page,
					// there is no need for a deny option
					acceptFriendRequest(response);
				}, function(response) {
					handleError(response);
				});
		}
	};

	$scope.submitSettingName = function() {
		let prename = $('#input_prename').val().trim();
		let lastname = $('#input_lastname').val().trim();

		if(prename == '' || lastname == '' || (prename == $scope.user.prename && lastname == $scope.user.lastname)) {
			console.log('Both fields have to be completed!');
			//TODO: add proper error handling here (incl. server responses)
		} else {
			settingService.setNames({'prename': prename, 'lastname': lastname}).then(function(response) {
				$('#settingsModal').modal('hide');
				console.log(response);
				$route.reload();
			})
		}
	};

	$scope.submitSettingEmail = function() {
		let email = $('#input_newEmail').val().trim();
		if(email == '' || email == $scope.user.email) {
			console.log('Both fields have to be completed!');
			//TODO: add proper error handling here (incl. server responses)
		} else {
			settingService.setEmail({'email':email}).then(function(response) {
				$('#settingsModal').modal('hide');
				console.log(response);
				$route.reload();
			})
		}
	};

	$scope.submitSettingPassword = function() {
		let pw1 = $('#input_newPassword1').val().trim();
		let pw2 = $('#input_newPassword2').val().trim();

		if(pw1 != pw2 || pw1 == '' || pw2 == '') {
			console.log('Both fields have to be completed!');
			//TODO: add proper error handling here (incl. server responses)
		} else {
			settingService.setPassword({'pw1': pw1, 'pw2': pw2}).then(function(response) {
				$('#settingsModal').modal('hide');
				console.log(response);
				$route.reload();
			})
		}
	};

	function acceptFriendRequest(response) {
		$scope.info.relation.status = 'friend';
		$scope.info.relation.friends = true;
	};

});
