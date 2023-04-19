<?php
include_once 'option-component.php';
?>
<h2>一个测试页</h2>
<p>将会在这里测试一个设置表单的样式，功能</p>
<p>一个页面可以有多个表单</p>
<form action="post" option_class="test">
    <h2>输入框</h2>
    <?php vio_option_component_input('test','input',"一个测试输入框")?>
    <h2>复选框</h2>
    <?php vio_option_component_switch('test','select','一个简简单单的复选框')?>
    <h2>下拉菜单</h2>
    <button type="submit">save</button>
</form>