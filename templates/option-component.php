<?php

/**
 * 表单组件输入框
 */
function vio_option_component_input($class, $item, $introduce, $placeholder = '', $type = 'none')
{
    $id = $class . '_' . $item;
?>
    <div class="vio-item-input option-component">
        <label for="<?php echo $id ?>"><?php echo $introduce ?></label>
        <div>
            <? if ($type == 'textarea') : ?>
                <textarea name="<?php echo $item ?>" id="<?php echo $id ?>" placeholder="<?php echo $placeholder ?>"><?php vio_option($class, $item) ?></textarea>
            <? else : ?>
                <input type="text" name="<?php echo $item ?>" id="<?php echo $id ?>" placeholder="<?php echo $placeholder ?>" value="<?php vio_option($class, $item) ?>">
                <?php if ($type == 'media') : ?>
                    <input type="button" onclick="vio.selectMedia('#<? echo $id ?>')" value="选择图片"></input>
                <? endif ?>
            <? endif ?>
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


<?php
/**
 * 表单组件 JSON字段列表选择器
 */
function vio_option_component_list($class, $item, $introduce, $options)
{
    // 获取保存在隐藏输入框中的JSON数据，并将其解析为PHP数组
    $json_data = vio_option($class, $item, true);
    $data_array = json_decode($json_data, true);
     // 如果解析失败或数据为空，创建一个空数组
     if (!$data_array || !is_array($data_array)) {
        $data_array = array();
    }
    foreach ($data_array as $field) {
        //数据不符
        if (!array_key_exists($field, $options)) {
            $data_array = array();
            break;
        }
    }

    $id = $class . '_' . $item;
?>
    <div class="vio-item-list option-component <?echo 'consider_'.$id?>">
        <label for="<?php echo $id ?>"><?php echo $introduce ?></label>
        <input type="hidden" name="<?php echo $item ?>" id="<?php echo $id ?>" value='<?php echo json_encode($data_array); ?>'>
        <!-- 显示可选项的下拉选择列表 -->
        <select class="option-select">
            <option value="">请选择</option>
            <?php foreach ($options as $key => $value) : ?>
                <option value='<?php echo $key; ?>'><?php echo $value ?></option>
            <?php endforeach; ?>
        </select>
         <!-- 添加选项按钮 -->
         <button type="button" onclick="addToJsonList('<?php echo $id ?>')">添加选项</button>
        <!-- 显示已选项的列表 -->
        <div class="selected-items">
            <ul>
                <?php foreach ($data_array as $field) : ?>
                    <li><?php echo $options[$field] ?><button type="button" onclick="moveItemUp('<?php echo $id ?>', '<?php echo $field ?>')">↑</button><button type="button" onclick="moveItemDown('<?php echo $id ?>', '<?php echo $field ?>')">↓</button><button type="button" onclick="deleteItem('<?php echo $id ?>', '<?php echo $field ?>')">X</button>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php
}
?>