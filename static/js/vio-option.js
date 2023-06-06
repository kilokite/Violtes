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
        function setListItemStatus(pageName){
            $(".setting_list button").removeClass('active')
            $(".setting_list button[page='"+pageName+"']").addClass('active')
        }
        vio.action('get_option_page', {
            name,
        }, (data) => {
            localStorage.setItem('vio_option_page', name)
            setListItemStatus(name)
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
    },
    selectMedia(cssSelector){
        var frame = wp.media({
            title: '选择图片',
            button: {
                text: '选择图片'
            },
            multiple: false  // Set to true to allow multiple files to be selected
        });
        frame.on('select', function () {
            var attachment = frame.state().get('selection').first().toJSON();
            $(cssSelector).val(attachment.url)
        });
        frame.open();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    $(".setting_list button").click(function () {
        let page = $(this).attr("page")
        vio.optionGo(page)
    })
})

vio.optionGo(localStorage.getItem('vio_option_page'))