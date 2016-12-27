angular.module('internal').service('feedService', function ($location, $resource, $routeParams) {

    // dummy objects for different http methods
    let httpPost = {query: {method: 'POST'}};
    let httpDelete = {query: {method: 'DELETE'}};

    /**
     * Return resource for user feeds.
     * @param {Number} userId id of current user
     * @param {Number} skip amount of feeds to skip
     * @param {Number} take amount of feeds to return
     * @returns {Feed[]}
     */
    this.getFeeds = function (skip = 0, take = 4) {
        if ($location.url().includes('profile'))
            return $resource('/user/' + $routeParams.id + '/feeds/skip/' + skip + '/take/' + take);
        else
            return $resource('/feeds/skip/' + skip + '/take/' + take);
    };

    /**
     * Returns resource to save single feed.
     * @param {Object} requestBody the feed content.
     * @returns {Feed}
     */
    this.addFeed = function (requestBody) {
        return $resource('/feed', requestBody, httpPost);
    };

    /**
     * Return resource to remove single feed.
     * @param {Number} feedId id of feed to remove
     * @returns {Object}
     */
    this.removeFeed = function (feedId) {
        return $resource('/feed/' + feedId, {}, httpDelete);
    };

    /**
     * Returns resource to add a comment to a feed.
     * @param {Number} feedId if of feed to comment
     * @param {Number} comment comment content
     * @returns {Comment}
     */
    this.addComment = function (feedId, comment) {
        return $resource('/feed/' + feedId + '/comment', comment, httpPost);
    };

    /**
     * Return resource to like a single feed.
     * @param {Number} feedId id of feed to like
     * @returns {Like}
     */
    this.like = function (feedId) {
        return $resource('/feed/' + feedId + '/like', {}, httpPost);
    };

    /**
     * Return resource to unlike a single feed.
     * @param {Number} feedId id of feed to unlike
     * @returns {Like}
     */
    this.unlike = function (feedId) {
        return $resource('/feed/' + feedId + '/unlike', {}, httpPost);
    };

    /**
     * Return resource to dislike a single feed.
     * @param {Number} feedId id of feed to dislike
     * @returns {Dislike}
     */
    this.dislike = function (feedId) {
        return $resource('/feed/' + feedId + '/dislike', {}, httpPost);
    };

    /**
     * Return resource to undislike a single feed.
     * @param {Number} feedId id of feed to undislike
     * @returns {Dislike}
     */
    this.undislike = function (feedId) {
        return $resource('/feed/' + feedId + '/undislike', {}, httpPost);
    };

});