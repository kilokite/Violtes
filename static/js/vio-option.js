'use strict';

let vio = {
    //awkward
    action(action, data = {}, callback) {
        data.action = action;
        jQuery.post(ajaxurl, {
            action: 'vio_ajax',
            data: data,
        },
            function (response) {
                callback(JSON.parse(response));
            }
        )
    },
    optionGo(name = 'content') {
        vio.action('get_option_page', {
            name: name,
        }, (data) => {
            $('.vio-option-container').html(data.return)
            $("form").submit(function (e) {
                e.preventDefault();
                let optionClass = $(this).attr('option_class');
                let items = $(this).serializeArray();
                items = items.reduce((obj, currentValue) => {
                    if ($('#' + currentValue.name).attr('type') == 'checkbox') {
                        if (currentValue.value == "true") {
                            currentValue.value = 1
                        } else {
                            currentValue.value = 0
                            }
                    }
                    obj[currentValue.name] = currentValue.value
                    return obj
                }, {})
                console.log({ optionClass, items })
                vio.action('set_option', { optionClass, items }, data => {
                    if (data.return) {
                        alert('保存成功')
                    }
                })
            })
        })
    }
}

document.addEventListener('DOMContentLoaded', function () {
    $(".setting_list button").click(function () {
        vio.optionGo($(this).attr("page"))
    })
})

vio.optionGo('test')