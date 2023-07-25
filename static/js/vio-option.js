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
        function setListItemStatus(pageName) {
            $(".setting_list button").removeClass('active')
            $(".setting_list button[page='" + pageName + "']").addClass('active')
        }
        vio.action('get_option_page_manager', {
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
    selectMedia(cssSelector) {
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
function addToJsonList(inputId) {
    const input = document.getElementById(inputId);
    const select = input.parentNode.querySelector('.option-select');
    const selectedItemsContainer = input.parentNode.querySelector('.selected-items ul');
    const selectedValue = select.value;
    const selectedText = select.options[select.selectedIndex].text;

    if (selectedValue !== '') {
        // 将选中的选项添加到JSON数组中
        const jsonData = JSON.parse(input.value);
        jsonData.push(selectedValue);
        input.value = JSON.stringify(jsonData);

        // 在界面上添加到已选项的列表中
        const listItem = document.createElement('li');
        listItem.textContent = selectedText;
        listItem.innerHTML += '<button type="button" onclick="moveItemUp(\'' + inputId + '\', \'' + selectedValue + '\')">↑</button> ';
        listItem.innerHTML += '<button type="button" onclick="moveItemDown(\'' + inputId + '\', \'' + selectedValue + '\')">↓</button> ';
        listItem.innerHTML += '<button type="button" onclick="deleteItem(\'' + inputId + '\', \'' + selectedValue + '\')">X</button> ';
        selectedItemsContainer.appendChild(listItem);

        // 清空下拉选择框
        select.value = '';
    }
}

function moveItemUp(inputId, field) {
    const input = document.getElementById(inputId);
    const jsonData = JSON.parse(input.value);
    const index = jsonData.indexOf(field);

    if (index > 0) {
        // 交换元素位置
        [jsonData[index], jsonData[index - 1]] = [jsonData[index - 1], jsonData[index]];
        input.value = JSON.stringify(jsonData);

        // 重新渲染列表
        renderList(inputId);
    }
}

function moveItemDown(inputId, field) {
    const input = document.getElementById(inputId);
    const jsonData = JSON.parse(input.value);
    const index = jsonData.indexOf(field);

    if (index < jsonData.length - 1) {
        // 交换元素位置
        [jsonData[index], jsonData[index + 1]] = [jsonData[index + 1], jsonData[index]];
        input.value = JSON.stringify(jsonData);

        // 重新渲染列表
        renderList(inputId);
    }
}

function deleteItem(inputId, field) {
    const input = document.getElementById(inputId);
    const jsonData = JSON.parse(input.value);

    // 删除选中项
    const index = jsonData.indexOf(field);
    if (index !== -1) {
        jsonData.splice(index, 1);
        input.value = JSON.stringify(jsonData);

        // 重新渲染列表
        renderList(inputId);
    }
}

function renderList(inputId) {
    const input = document.getElementById(inputId);
    const jsonData = JSON.parse(input.value);
    const selectedItemsContainer = input.parentNode.querySelector('.selected-items ul');

    // 清空已选项的列表
    selectedItemsContainer.innerHTML = '';

    // 重新渲染列表
    jsonData.forEach(field => {
        const listItem = document.createElement('li');
        listItem.textContent = document.querySelector(`.consider_${inputId} option[value="${field}"]`).firstChild.textContent;
        listItem.innerHTML += '<button type="button" onclick="moveItemUp(\'' + inputId + '\', \'' + field + '\')">↑</button>';
        listItem.innerHTML += '<button type="button" onclick="moveItemDown(\'' + inputId + '\', \'' + field + '\')">↓</button>';
        listItem.innerHTML += '<button type="button" onclick="deleteItem(\'' + inputId + '\', \'' + field + '\')">X</button>';
        selectedItemsContainer.appendChild(listItem);
    });
}

function toggleMenu(){
    document.querySelector(".setting_list").classList.toggle("show")
}