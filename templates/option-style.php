<?php get_template_part('templates/option','common')?>

<?php
if(isset($_POST['save'])){
vio_set_option('style',array(
    'theme_color' => $_POST['theme_color'],
));
}
?>

<form method="post">
    <div>
        <h2>整体</h2>
        <div>
            <?php
            vio_option_component_select('主题颜色','theme_color','style','theme_color',array(
                array('name'=>'默认','value'=>'default'),
                array('name'=>'黑色','value'=>'black'),
                array('name'=>'蓝色','value'=>'blue'),
                array('name'=>'绿色','value'=>'green'),
                array('name'=>'紫色','value'=>'violet'),
                array('name'=>'红色','value'=>'red'),
                array('name'=>'黄色','value'=>'yellow'),
            ));
            ?>
            <?php 
            vio_option_component_switch('pjax','pjax','style','pjax');
            ?>
        </div>
    </div>
    <button type="submit" name="save">save</button>
</form>