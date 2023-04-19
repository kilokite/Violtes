<?php

/**
 * 表单组件输入框
 */
function vio_option_component_input($class, $item, $introduce, $placeholder = '')
{
?>
    <div class="vio-item-input option-component">
        <label for="<?php echo $item ?>"><?php echo $introduce ?></label>
        <p><input type="text" name="<?php echo $item ?>" id="<?php echo $item ?>" placeholder="<?php echo $placeholder ?>" value="<?php vio_option($class, $item) ?>"></p>
    </div>
<?php
}

/**
 * 表单组件 复选框
 */
function vio_option_component_switch($class, $item, $introduce)
{
    ?>
    <div class="vio-item-switch option-component">
        <label for="<?php echo $item?>"><?php echo $introduce?></label>
        <input type="hidden" name="<?php echo $item?>" value="false">
        <input type="checkbox" name="<?php echo $item?>" id="<?php echo $item?>" value="true" <?php if(vio_option($class,$item,true)) echo 'checked' ?> >
        <?php echo vio_option($class,$item,true)=="true" ?>
    </div>
    <?php
}
    ?>