angular.module('internal').service('msgService', function ($resource) {
    
    let httpPost = {query: {method: 'POST'}};

    /**
     * Returns resource to get user conversations.
     * @returns {Conversation[]}
     */
    this.getConversations = function () {
        return $resource('/conversation');
    };

    /**
     * Returns resource to search a conversation.
     * @param {Object} requestBody request content
     * @returns {Number} conversation id
     */
    this.searchConversation = function (requestBody) {
        return $resource('/conversation/search', requestBody, httpPost);
    };

    /**
     * Returns resource to create a conversation.
     * @param {Object} requestBody request content
     * @returns {Number} conversation id
     */
    this.createConversation = function (requestBody) {
        return $resource('/conversation', requestBody, httpPost);
    };

    /**
     * Returns resource to send a message.
     * @param {Object} requestBody request content
     * @returns {String} status
     */
    this.sendMessage = function (requestBody) {
        return $resource('/message', requestBody, httpPost);
    };

    /**
     * Returns resource to get user's messages of a conversation.
     * @param {Number} conversationId id of conversation to get messages of
     * @returns {Object}
     */
    this.getMessages = function (conversationId) {
        return $resource('/conversation/' + conversationId);
    };

    /**
     * Returns resource to get amount of conversations containing unread
     * messages.
     * @returns {Number} amount of conversations with unread messages
     */
    this.getUnreadConversations = function () {
        return $resource('conversation/unread');
    };

    /**
     * Returns resource to update last_read attribute of conversation.
     * @param {Number} participantId id of current user
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.updateLastRead = function (participantId, requestBody) {
        return $resource('/participant/' + participantId + '/updatelastread', requestBody, httpPost);
    };

});
