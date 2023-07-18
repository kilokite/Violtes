<?php
include_once 'option-component.php';
?>

<form action="post" option_class="sidebar">
    <h3>首页</h3>
    <?
    $sidebarList = array(
        'user' => '个人卡片',
        'category' => 'tag池',
        'randArticle' => '随机文章',
        'directory' => '目录(文章页)',
    );
    vio_option_component_list('sidebar', 'index', '',$sidebarList);
    ?>
    <h3>文章页</h3>
    <?vio_option_component_list('sidebar','article','',$sidebarList)?>
    <h3>页面（归档）</h3>
    <?vio_option_component_list('sidebar','archive','',$sidebarList)?>
    <h3>页面（默认）</h3>
    <?vio_option_component_list('sidebar','page','',$sidebarList)?>
    <button type="submit">save</button>

</form>