/* confirmationDialog begins */
/**
 * jQuery UI confirmation dialog.
 * @param {String} text
 * @param {Object} userConfig
 * @constructor
 */
function ConfirmationDialog(text, userConfig) {
    var defaultConfig = {
        captionOk: 'OK',
        captionCancel: 'Anuluj',
        title: 'Potwierdzenie',
        onOk: null,
        onCancel: null,
        dialogOptions: {
            modal: true,
            resizable: false,
            buttons: [
                {text: getLabelOk, click: callbackOk },
                {text: getLabelCancel, click: callbackCancel}
            ]
        }
    };
    var message = text;
    var config = {};

    var elementId;
    var $_div;
    var self = this;

    $.extend(true, config, defaultConfig, userConfig);

    function getLabelOk() {
        return config.captionOk;
    }

    function getLabelCancel() {
        return config.captionCancel;
    }

    function callbackOk() {
        self.close();

        if (typeof config.onOk == 'function') {
            config.onOk();
        }

        return true;
    }

    function callbackCancel() {
        self.close();

        if (typeof config.onCancel == 'function') {
            config.onCancel();
        }

        return false;
    }

    /**
     * Adds div with question to html
     */
    function init() {
        $.extend(true, config, defaultConfig, userConfig);

        elementId = 'confirmation_' + randomString();
        $_div = $('<div></div>');
        $_div.attr('title', config.title);
        $_div.attr('id', elementId);
        $_div.append(message);
        $('body').append($_div);
    }

    function randomString() {
        var chars = 'abcdefghijklmnopqrstuvwxyz'.split('');
        var output = new String;

        for (var i = 0; i < 16; i++) {
            output += chars[Math.floor((Math.random() * chars.length))];
        }

        return output;
    }

    this.show = function() {
        $_div.dialog(config.dialogOptions);
    }

    this.close = function() {
        $('#' + elementId).dialog('close');
    }

    this.destroy = function() {
        $_div.remove()
    }

    init();
}
/* confirmationDialog ends */
