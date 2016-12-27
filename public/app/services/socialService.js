angular.module("internal").service('socialService', function ($resource) {

    // dummy objects for different http methods
    let httpPost = {query: {method: 'POST'}};

    /**
     * Returns resource to get friends and friend requests of user.
     * @returns {Object}
     */
    this.list = function () {
        return $resource('/user/social');
    };

    /**
     * Returns resource to get single friend.
     * @param {Number} friendId id of friend
     * @returns {Friend}
     */
    this.getFriend = function (friendId) {
        return $resource('/friend/' + friendId);
    };

    /**
     * Returns resource to get friends of user.
     * @returns {Object}
     */
    this.getFriends = function () {
        return $resource('/user/friends');
    };

    /**
     * Returns resource to send friend request to single user.
     * @param {Number} userId id of user to send request to.
     * @returns {FriendRequest}
     */
    this.sendFriendRequest = function (userId) {
        return $resource('/user/friends/request/' + userId, {}, httpPost);
    };

    /**
     * Returns resource to get all friends of a friend.
     * @param {Number} id id of user to get friends of.
     * @returns {User[]}
     */
    this.getFriendsOfFriend = function (id) {
        return $resource('/user/' + id + '/friends');
    };

    /**
     * Returns resource to answer friend request.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.answerFriendRequest = function (requestBody) {
        return $resource('/user/friends', requestBody, httpPost);
    };

    /**
     * Returns resource to withdraw friend request.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.withdrawRequest = function (requestBody) {
        return $resource('/user/friends/withdraw', requestBody, httpPost);
    };

    /**
     * Returns resource to remove friend.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.removeFriend = function (requestBody) {
        return $resource('/user/friends/remove', requestBody, httpPost);
    };

});
