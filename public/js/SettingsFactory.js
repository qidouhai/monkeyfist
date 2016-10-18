'use strict';

function SettingsFactory() {
  this.currentSelection = null;

  SettingsFactory.prototype.init = function() {
    // hide modal bodies
    $('#settingsModal_account').hide();
    $('#settingsModal_account_name').hide();
    $('#settingsModal_account_email').hide();
    $('#settingsModal_account_password').hide();
  }

  SettingsFactory.prototype.reset = function() {
    this.init();

    $('#settingsModal_overview').show();
  }

  SettingsFactory.prototype.selectSettingGroup = function(selection) {
    switch (selection) {
      case 'account':
        this.currentSelection = new AccountSettings();
        break;
      case 'privacy':
        this.currentSelection = new PrivacySettings();
        break;
      case 'notifications':
        this.currentSelection = new NotificationSettings();
        break;
    }
    this.currentSelection.init();
  }

  SettingsFactory.prototype.selectSetting = function(setting) {
    this.currentSelection.select(setting);
  }

  SettingsFactory.prototype.next = function() {

  }

  // move one step back, the step given as parameter represents the
  // step the function is called from (overview is step=0)
  SettingsFactory.prototype.back = function(step) {
    this.currentSelection.back(step);
  }

  SettingsFactory.prototype.submit = function() {

  }

  this.init();
}

function AccountSettings() {

  AccountSettings.prototype.init = function () {
    $('#settingsModal_account').show();

    $('#settingsModal_overview').hide();
    $('#settingsModal_account_name').hide();
    $('#settingsModal_account_email').hide();
    $('#settingsModal_account_password').hide();
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
    }
  };

  AccountSettings.prototype.back = function (step) {
    if(step == 1)
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
}
