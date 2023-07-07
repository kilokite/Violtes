<?php include_once 'option-component.php'?>

<form method="post" option_class="style" >
    <div>
        <h2>整体</h2>
        <h3>颜色</h3>
        <div>
            <?php 
            vio_option_component_select('style','theme_color','主题色',[
                ['蓝','sky'],
                ['紫','violet'],
                ['粉','bbb']
            ]);
            vio_option_component_switch('style','pjax','style','pjax');
            
            vio_option_component_input('style','background','背景图URL','url','media');
            ?>
        </div>
    </div>
    <? vio_option_submit_button()?>
</form>