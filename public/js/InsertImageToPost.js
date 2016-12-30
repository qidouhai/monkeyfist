'use strict';

function InsertImageFactory() {
    this.currentMethod = null;
    this.dropzone = null;

    InsertImageFactory.prototype.init = function () {
        // hide modal bodies
        $('#insertImageModal_imageURL').hide();
        $('#insertImageModal_uploadImage').hide();
        $('#insertImageModal_submit').hide();
    };

    InsertImageFactory.prototype.reset = function () {
        $('#insertImageModal_imageURL').hide();
        $('#insertImageModal_uploadImage').hide();
        $('#insertImageModal_submit').hide();

        $('#insertImageModal_selection').show();
    };

    InsertImageFactory.prototype.select = function (method) {
        switch (method) {
            case 'imageURL':
                this.currentMethod = new InsertImageFromURL();
                break;
            case 'uploadImage':
                this.currentMethod = new UploadImage();
                break;
            case 'uploadVideo':
                this.currentMethod = new uploadVideo();
                break;
        }
        this.currentMethod.init();
        $('#insertImageModal_submit').show();
    };

    InsertImageFactory.prototype.next = function () {
        this.currentMethod.next();
    };

    InsertImageFactory.prototype.back = function () {
        this.currentMethod.back();
    };

    InsertImageFactory.prototype.insert = function (input) {
        let text = $('#post_content');
        text.val(text.val() + input);
        $('#insertImageModal').modal('hide');
        this.reset();
    };
}

function InsertImageFromURL() {
    this.steps = ['insertLink'];
    this.currentStep = null;

    InsertImageFromURL.prototype.init = function () {
        $('#insertImageModal_imageURL').show();
        $('#insertImageModal_selection').hide();
        this.currentStep = 0;
    };

    InsertImageFromURL.prototype.next = function () {
        if (this.steps[this.currentStep] == 'insertLink') {
            let link = '<img src="' + $('#inputImageURL').val() + '" >';
            insertImageFactory.insert(link);
        }
    };

    InsertImageFromURL.prototype.back = function () {
        if (this.steps[this.currentStep] == 'insertLink') {
            insertImageFactory.reset();
        }
    };
}

function UploadImage() {
    this.steps = ['upload'];
    this.currentStep = null;

    UploadImage.prototype.init = function () {
        $('#insertImageModal_uploadImage').show();
        $('#insertImageModal_selection').hide();
        this.currentStep = 0;
    };

    UploadImage.prototype.next = function () {
        if (this.steps[this.currentStep] == 'upload') {

        }
    };

    UploadImage.prototype.back = function () {
        if (this.steps[this.currentStep] == 'upload') {

        }
    };
}