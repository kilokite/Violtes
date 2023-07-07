<?php
include_once 'option-component.php';
?>
<div class="setting-card">
    <h2>Tips</h2>
    <p>将会在这里测试一个设置表单的样式，功能</p>
    <p>一个页面可以有多个表单</p>
</div>

<form action="post" option_class="test">
    <h2>测试</h2>
    <h3>输入框</h3>
    <?php vio_option_component_input('test', 'input', "一个测试输入框") ?>
    <h3>复选框</h3>
    <?php vio_option_component_switch('test', 'select', '一个简简单单的复选框') ?>
    <h3>下拉菜单</h3>
    <? vio_option_component_select('test', 'switch', '选择一个字母', [['小笼包汤圆', 'h'], ['菠萝披萨', 'y'], ['仰望星空派', 'z']]) ?>
    <h3>媒体选择</h3>
    <?php vio_option_component_input('test', 'img_url', "选择一张图片",'','media') ?>
    <button type="submit">save</button>
</form>