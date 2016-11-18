var app = angular.module("internal");

app.controller("MessengerController", function ($scope, $routeParams, $rootScope, $window, msgService, socketService) {

    $scope.conversations;

    // stores the current conversation
    $scope.currentConversation = {
        'id': null,
        'participants': null,
        'messages': null
    };
    // stores participant representing the current user in the current conversation
    $scope.currentParticipant = -1;

    $scope.setConversation = function (conversationId) {
        $scope.getMessages(conversationId);
        $routeParams.conversationId = conversationId;
    };

    $scope.getConversations = function () {
        msgService.getConversations().then(function (response) {
            $scope.conversations = response;
            $scope.conversations.sort(compareConversations);
        });
    };

    $scope.getMessages = function (conversationId) {
        msgService.getMessages(conversationId).then(function (response) {
            if (response.exists && response.member) {
                $scope.currentConversation.id = response.data.id;
                $scope.currentConversation.participants = response.data.participants;
                $scope.currentConversation.messages = response.data.messages;
                $scope.currentParticipant = $scope.currentConversation.participants[indexOfParticipant($scope.user.id)];
                // remove this conversation from unreadconversations array
                $rootScope.notifications.messenger.conversations.splice($.inArray(conversationId, $rootScope.notifications.messenger.conversations),1);
                // update last read attribute of participant
                msgService.updateLastRead($scope.currentParticipant.id, {last_read: moment().toISOString()});
            }
        });
    };

    $scope.submitMessage = function () {
        let input = $('#message_input_field').val().trim();
        if (input !== '') {
            msgService.sendMessage({conversation_id: $scope.currentConversation.id, body: input}).then(function (response) {
                console.log(response);
            });
        }
        $('#message_input_field').val('');
    };

    socketService.on('messenger-channel:' + $scope.user.id, function (data) {
        if (Number(data.conversation_id) === Number($scope.currentConversation.id)) {
            $scope.currentConversation.messages.push(data);
        }
        // if new message arrives, trigger notification (unless message is sent in current conversation)
        if($.inArray(data.conversation_id, $rootScope.notifications.messenger.conversations) === -1 && data.conversation_id !== $scope.currentConversation.id) {
            $rootScope.notifications.messenger.conversations.push(data.conversation_id);
        }
        // update last_message attribute of current conversation and resort conversations
        $scope.conversations[indexOfConversation(data.conversation_id)].last_message = data.created_at;
        $scope.conversations.sort(compareConversations);
    });
    
    // when user leaves messenger, update last_read attribute
    $scope.$on('$locationChangeStart', function() {
        if($scope.currentParticipant !== -1)
            msgService.updateLastRead($scope.currentParticipant.id, {last_read: moment().toISOString()});
    });

    // load user's conversations
    $scope.getConversations();
    // check if a conversation is selected
    if ($routeParams.conversationId)
        $scope.getMessages(parseInt($routeParams.conversationId));

    // comparison function for conversations (sorts by last message)
    function compareConversations(a,b) {
        if(moment(a.last_message) > moment(b.last_message))
            return -1;
        if(moment(a.last_message) < moment(b.last_message))
            return 1;
        return 0;
    }
    
    /**
     * Search the index of the conversation in the
     * conversation array.
     * @param {Number} conversationId
     * @returns {Number} index of conversation, else -1
     */
    function indexOfConversation(conversationId) {
        for(let i = 0; i < $scope.conversations.length; i++) {
            if(Number(conversationId) === Number($scope.conversations[i].id))
                return i;
        }
        return -1;
    }
 
    /**
     * Search the index of the current user in 
     * the participant array of the current
     * conversation.
     * @param {Number} userId
     * @returns {Number} index of user, else -1
     */
    function indexOfParticipant(userId) {
        for(let i = 0; i < $scope.currentConversation.participants.length; i++) {
            if(Number(userId) === Number($scope.currentConversation.participants[i].user_id))
                return i;
        }
        return -1;
    }

    // position textarea at page bottom
    angular.element(document).ready(function () {
        let sidebar_height = $('#messenger_sidebar').height();
        let input_height = $('.message_input_wrapper').height();
        let message_wrapper_height = sidebar_height - input_height - 92;

        $('.message_wrapper').css('height', message_wrapper_height);
    });

});