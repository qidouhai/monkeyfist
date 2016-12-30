'use strict';

function SettingsFactory() {
    this.currentSelection = null;

    SettingsFactory.prototype.init = function () {
        // hide modal bodies
        $('#settingsModal_account').hide();
        $('#settingsModal_account_name').hide();
        $('#settingsModal_account_email').hide();
        $('#settingsModal_account_password').hide();
        $('#settingsModal_account_image').hide();

        $('#settingsModal_privacy').hide();
        $('#settingsModal_notification').hide();
    };

    SettingsFactory.prototype.reset = function () {
        this.init();

        $('#settingsModal_overview').show();
    };

    SettingsFactory.prototype.selectSettingGroup = function (selection) {
        switch (selection) {
            case 'account':
                this.currentSelection = new AccountSettings();
                break;
            case 'privacy':
                this.currentSelection = new PrivacySettings();
                break;
            case 'notification':
                this.currentSelection = new NotificationSettings();
                break;
        }
        this.currentSelection.init();
    };

    SettingsFactory.prototype.selectSetting = function (setting) {
        this.currentSelection.select(setting);
    };

    SettingsFactory.prototype.next = function () {

    };

    // move one step back, the step given as parameter represents the
    // step the function is called from (overview is step=0)
    SettingsFactory.prototype.back = function (step) {
        this.currentSelection.back(step);
    };

    SettingsFactory.prototype.submit = function () {

    };

    SettingsFactory.prototype.close = function () {
        this.reset();
        $('#settingsModal').modal('hide');
    };

    this.init();
}

function AccountSettings() {

    AccountSettings.prototype.init = function () {
        $('#settingsModal_account').show();

        $('#settingsModal_overview').hide();
        $('#settingsModal_account_name').hide();
        $('#settingsModal_account_email').hide();
        $('#settingsModal_account_password').hide();
        $('#settingsModal_account_image').hide();
    };

    AccountSettings.prototype.select = function (selection) {
        switch (selection) {
            case 'name':
                this.displayNameSettings();
                break;
            case 'email':
                this.displayEmailSettings();
                break;
            case 'password':
                this.displayPasswordSettings();
                break;
            case 'image':
                this.displayImageSettings();
                break;
        }
    };

    AccountSettings.prototype.back = function (step) {
        if (step === 1)
            settingsFactory.reset();
        else
            this.init();
    };

    AccountSettings.prototype.displayNameSettings = function () {
        $('#settingsModal_account').hide();
        $('#settingsModal_account_name').show();
    };

    AccountSettings.prototype.displayEmailSettings = function () {
        $('#settingsModal_account').hide();
        $('#settingsModal_account_email').show();
    };

    AccountSettings.prototype.displayPasswordSettings = function () {
        $('#settingsModal_account').hide();
        $('#settingsModal_account_password').show();
    };
    
    AccountSettings.prototype.displayImageSettings = function() {
        $('#settingsModal_account').hide();
        $('#settingsModal_account_image').show();
    };
}

function NotificationSettings() {

    NotificationSettings.prototype.init = function () {
        $('#settingsModal_notification').show();

        $('#settingsModal_overview').hide();

        // init toggle inputs
        $('#input_notifyMessage').bootstrapToggle();
        $('#input_notifyFriendRequest').bootstrapToggle();
        $('#input_notifyComment').bootstrapToggle();
        $('#input_notifyFeed').bootstrapToggle();
    };

    NotificationSettings.prototype.back = function () {
        settingsFactory.reset();
    };
}

function PrivacySettings() {
    PrivacySettings.prototype.init = function () {
        $('#settingsModal_privacy').show();

        $('#settingsModal_overview').hide();

        // init toggle inputs
        let toggleOptions = {on: 'public', off: 'private'};
        $('#input_privacy_feed').bootstrapToggle(toggleOptions);
        $('#input_privacy_collection').bootstrapToggle(toggleOptions);
    };

    PrivacySettings.prototype.back = function () {
        settingsFactory.reset();
    };
}
