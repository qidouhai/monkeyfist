angular.module('internal').service('feedService', function ($http, $location, $routeParams, $rootScope) {
    
    // amount of feeds to query with each request
    let querySize = 4;
    
    // feeds requested on user dashboard
    let dashboardFeedList = [];
    // more dashboard feeds available?
    let moreDashboardFeeds = true;
    
    // feeds requested on profile page
    let userFeedList = [];
    // id of last visited profile
    let userId = null;
    // more user feeds available?
    let moreUserFeeds = true;
    
    /**
     * Returns the list of feeds.
     * If user is on profile page, user feeds are returned,
     * else dashboard feeds.
     * @returns {Array} feeds
     */
    this.feeds = function() {
        if($location.url().includes('profile')) {
            return angular.copy(userFeedList);
        } else {
           return angular.copy(dashboardFeedList); 
        }        
    };
    
    /**
     * True if there are more feeds to request,
     * false if not.
     * @returns {Boolean}
     */
    this.moreFeeds = function() {
        if($location.url().includes('profile')) {
            return angular.copy(moreUserFeeds);
        } else {
           return angular.copy(moreDashboardFeeds); 
        }  
    };
    
    /**
     * Queries more user or more dashboard feeds,
     * depending on the url the user is currently on.
     */
    this.getFeeds = function () {
        if($location.url().includes('profile')) {
            if($routeParams.id !== userId) {
                userId = $routeParams.id;
                userFeedList = [];
            }
            return getUserFeeds();
        } else {
            return getDashboardFeeds();
        }
    };
    
    // called from getFeeds() -> queries more user feeds
    let getUserFeeds = function() {
        return $http.get('/user/' + $routeParams.id + '/feeds/skip/' + userFeedList.length + '/take/' + querySize).then(function (response) {
            userFeedList.push.apply(userFeedList,response.data);
            moreUserFeeds = response.data.length >= querySize;
        });
    };
    
    // called from getFeeds() -> queries more dashboard feeds
    let getDashboardFeeds = function() {
        return $http.get('/feeds/skip/' + dashboardFeedList.length + '/take/' + querySize).then(function (response) {
            dashboardFeedList.push.apply(dashboardFeedList,response.data);
            moreDashboardFeeds = response.data.length >= querySize;
        });
    };
    
    /**
     * Sends a post feed request to the server and,
     * if succesful, appends the post to the feed lists.
     * @param {Object} requestBody
     */
    this.addPost = function(requestBody) {
        return $http.post('/feed', requestBody).then(function (response) {
            dashboardFeedList.splice(0,0,response.data);
            userFeedList.splice(0,0,response.data);
        });
    };
    
    /**
     * Sends a remove feed request to the server and,
     * if succesful, removes the feed from the lists.
     * @param {Number} feedId
     */
    this.removeFeed = function(feedId) {
        return $http.delete('/feed/' + feedId).then(function (response) {
            dashboardFeedList.splice(findFeedIndex(feedId, dashboardFeedList), 1);
            userFeedList.splice(findFeedIndex(feedId, userFeedList), 1);
        });
    };
    
    /**
     * Sends a post comment request to the server and,
     * if successful, updates the lists.
     * @param {Number} feedId
     * @param {Object} comment
     */
    this.addComment = function(feedId, comment) {
        return $http.post('/feed/' + feedId + '/comment', comment).then(function (response) {
            let dbFeed = findFeed(feedId, dashboardFeedList);
            let urFeed = findFeed(feedId, userFeedList);
            if(dbFeed !== null)
                dbFeed.comments.push(response.data);
            if(urFeed !== null)
                urFeed.comments.push(response.data);
        });
    };

    /**
     * Adds a like to the given feed.
     * @param {Number} feedId
     */
    this.like = function (feedId) {
        return $http.post('/feed/' + feedId + '/like').then(function (response) {
            let dbFeed = findFeed(feedId, dashboardFeedList);
            if(dbFeed !== null) {
                dbFeed.likes = dbFeed.likes === null ? {count: 1} : dbFeed.likes.count+1;
                dbFeed.votes[0] = {feed_id: feedId, id: $rootScope.user.id, like: 1};
            }
            let urFeed = findFeed(feedId, userFeedList);
            if(urFeed !== null) {
                urFeed.likes = urFeed.likes === null ? {count: 1} : urFeed.likes.count+1;
                urFeed.votes[0] = {feed_id: urFeed, id: $rootScope.user.id, like: 1};
            }
        });
    };

    /**
     * Removes a like from the given feed.
     * @param {Number} feedId
     */
    this.unlike = function (feedId) {
        return $http.post('/feed/' + feedId + '/unlike').then(function (response) {
            let dbFeed = findFeed(feedId, dashboardFeedList);
            if(dbFeed !== null) {
                dbFeed.likes.count--;
                dbFeed.votes = [];
            }
            let urFeed = findFeed(feedId, userFeedList);
            if(urFeed !== null) {
                urFeed.likes.count--;
                urFeed.votes = [];
            }
        });
    };

    /**
     * Adds a dislike to the given feed.
     * @param {Number} feedId
     */
    this.dislike = function (feedId) {
        return $http.post('/feed/' + feedId + '/dislike').then(function (response) {
            let dbFeed = findFeed(feedId, dashboardFeedList);
            if(dbFeed !== null) {
                dbFeed.dislikes = dbFeed.dislikes === null ? {count: 1} : dbFeed.dislikes.count+1;
                dbFeed.votes[0] = {feed_id: feedId, id: $rootScope.user.id, like: 0};
            }
            let urFeed = findFeed(feedId, userFeedList);
            if(urFeed !== null) {
                urFeed.dislikes = urFeed.dislikes === null ? {count: 1} : urFeed.dislikes.count+1;
                urFeed.votes[0] = {feed_id: urFeed, id: $rootScope.user.id, like: 0};
            }
        });
    };

    /**
     * Removes a dislike from the given feed.
     * @param {Number} feedId
     */
    this.undislike = function (feedId) {
        return $http.post('/feed/' + feedId + '/undislike').then(function (response) {
            let dbFeed = findFeed(feedId, dashboardFeedList);
            if(dbFeed !== null) {
                dbFeed.dislikes.count--;
                dbFeed.votes = [];
            }
            let urFeed = findFeed(feedId, userFeedList);
            if(urFeed !== null) {
                urFeed.dislikes.count--;;
                urFeed.votes = [];
            }
        });
    };
    
    // search and return feed index in array
    let findFeedIndex = function(feedId, feedList) {
        for(let x = 0; x < feedList.length; x++) {
            if(feedList[x].id === feedId)
                return x;
        }
        return -1;
    };
    
    // search and return feed in array
    let findFeed = function(feedId, feedList) {
        for(let x = 0; x < feedList.length; x++) {
            if(feedList[x].id === feedId)
                return feedList[x];
        }
        return null;
    };

});
