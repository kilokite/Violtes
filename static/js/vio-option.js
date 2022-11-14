'use strict';

let vio = {
    action(action, data = {}, callback) {
        data.action = action;
        jQuery.post(ajaxurl, {
            action: 'vio_ajax',
            data: data,
        },
            function (response) {
                callback(response);
            }
        )
}
}