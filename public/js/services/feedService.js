/**
 * Created by Axel on 19.03.2017.
 */
angular.module('internal').service('feedService', function($location,$resource) {

    var httpPost = {query: {method: 'POST'}};
    var httpDelete = {query: {method: 'DELETE'}};


    /**
     * Return resource for user feeds.
     */
    this.getFeeds = function(skip = 0, take = 4) {
        return $resource('/api/feeds/skip/' + skip + '/take/' + take);
    }

    /**
     * Return resource to save single feed.
     */
    this.addFeed = function(requestBody) {
        return $resource('/api/feeds', requestBody, httpPost);
    }

    /**
     * Return resource to remove single feed
     */
    this.removeFeed = function(feedId) {
        return $resource('/api/feeds/' + feedId, {}, httpDelete);
    }

    /**
     * Return resource to add a comment to a feed
     */
    this.addComment = function(feedId, comment) {
        return $resource('/api/feeds/' + feedId + '/comment', comment, httpPost);
    }
});