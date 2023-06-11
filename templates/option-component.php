<?php

/**
 * 表单组件输入框
 */
function vio_option_component_input($class, $item, $introduce, $placeholder = '',$media = false)
{
    $id = $class . '_' . $item;
?>
    <div class="vio-item-input option-component">
        <label for="<?php echo $id ?>"><?php echo $introduce ?></label>
        <div>
        <input type="text" name="<?php echo $item ?>" id="<?php echo $id ?>" placeholder="<?php echo $placeholder ?>" value="<?php vio_option($class, $item) ?>">
        <?php if($media){?>
            <input type="button" onclick="vio.selectMedia('#<?echo $id?>')" value="选择图片"></input>
        <?php }?>
        </div>
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
        <label for="<?php echo $item ?>"><?php echo $introduce ?></label>
        <input type="hidden" name="<?php echo $item ?>" value="false">
        <input type="checkbox" name="<?php echo $item ?>" id="<?php echo $item ?>" value="true" <?php if (vio_option($class, $item, true)) echo 'checked' ?>>
        <?php echo vio_option($class, $item, true) == "true" ?>
    </div>
<?php
}
?>

<?php
/**
 * 表单组件 下拉框
 */
function vio_option_component_select($class, $item, $introduce, $select)
{
    $vio_option = vio_option($class, $item, true);
    //这个选项选的什么
?>
    <div class="option-component vio-item-select">
        <label for="<?php echo $item ?>"><?php echo $introduce ?></label>
        <select name="<?php echo $item ?>" id="<?php echo $item ?>">
            <?php foreach ($select as $value) {
            ?>
                <option value="<?php echo $value[1] ?>" <?php if ($vio_option == $value[1]) echo  'selected' ?>><?php echo $value[0] ?></option>
            <?php
            } ?>
        </select>
    </div>
<?php
}
?>

<?
function vio_option_submit_button()
{
?>
    <button type="submit" name="save" class="">save</button>
<?
}
?>