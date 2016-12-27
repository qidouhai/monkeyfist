angular.module("internal").service('settingService', function ($resource) {

    let httpPost = {query: {method: 'POST'}};

    /**
     * Return resource to change user name.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.setNames = function (requestBody) {
        return $resource('/settings/account/names', requestBody, httpPost);
    };

    /**
     * Return resource to change user email.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.setEmail = function (requestBody) {
        return $resource('/settings/account/email', requestBody, httpPost);
    };

    /**
     * Return resource to change user password.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.setPassword = function (requestBody) {
        return $resource('/settings/account/password', requestBody, httpPost);
    };

    /**
     * Return resource to query user notification settings.
     * @returns {NotificationSettings}
     */
    this.getNotifications = function () {
        return $resource('/settings/notifications');
    };

    /**
     * Return resource to change user notification settings.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.setNotifications = function (requestBody) {
        return $resource('/settings/notifications', requestBody, httpPost);
    };

    /**
     * Return resource to query user privacy settings.
     * @returns {PrivacySettings}
     */
    this.getPrivacy = function () {
        return $resource('/settings/privacy');
    };

    /**
     * Return resource to change privacy settings.
     * @param {Object} requestBody request content
     * @returns {Object}
     */
    this.setPrivacy = function (requestBody) {
        return $resource('/settings/privacy', requestBody, httpPost);
    };

});
