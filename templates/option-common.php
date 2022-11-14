<script src="<?php echo get_theme_file_uri('static/js/jquery-min.js') ?>"></script>
<script src="<?php echo get_theme_file_uri('static/js/vio-option.js') ?>"></script>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('static/css/vio-option.css') ?>">

<script>
    let vioValue = {
        ajaxURL: "<?php echo admin_url('admin-ajax.php') ?>"
    }
</script>

<?php
//设置选项模板

?>

<?php function vio_option_component_input($name, $post, $class, $item, $placeholder = "")
{
?>
    <?php //输入框 
    ?>
    <P class="option-item">
        <label for="<?php echo $post ?>"><?php echo $name ?></label>
        <input type="text" name="<?php echo $post ?>" id="<?php echo $post ?>" placeholder="<?php echo $placeholder ?>" value="<?php vio_option($class, $item) ?>">
    </P>

<?php } ?>

<?php function vio_option_component_select($name, $post, $class, $item, $options)
{
?>
    <?php //下拉框 
    ?>
    <P class="option-item">
        <label for="<?php echo $post ?>"><?php echo $name ?></label>
        <select name="<?php echo $post ?>" id="<?php echo $post ?>">
            <?php foreach ($options as $option) : ?>
                <option value="<?php echo $option['value'] ?>" <?php if (vio_option($class, $item, true) == $option['value']) echo 'selected' ?>><?php echo $option['name'] ?></option>
            <?php endforeach ?>
        </select>
    </P>

<?php } ?>

<?php function vio_option_component_radio($name, $post, $class, $item, $options)
{ ?>
<?php } ?>



<?php function vio_option_component_switch($name, $post, $class, $item)
{ ?>
    <?php
    //一个复选框
    ?>
    <P class="option-item">
        <label for="<?php echo $post ?>"><?php echo $name ?></label>
        <input type="checkbox" name="<?php echo $post ?>" id="<?php echo $post ?>" <?php if (vio_option($class, $item, true)) echo 'checked' ?>>
    </P>


<?php } ?>