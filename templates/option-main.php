<?php get_template_part('templates/option', 'common') ?>
<!-- <h2>Violet Version : <?php echo get_option('vio-init') ?></h2> -->

<!-- <button onclick="vio_click()">ajax</button> -->

<div class="vio_setting">
    <div class="setting_list">
        <ul>
            <li>
                <button go="top">站点</button>
            </li>
            <li>
                <button go="top">顶部与底部</button>
            </li>
            <li>
                <button go="top">内容</button>
            </li>
            <li>
                <button go="top">侧边栏</button>
            </li>
            <li>
                <button go="top">SEO</button>
            </li>
            <li>
                <button go="top">自定义</button>
            </li>
        </ul>
    </div>
    <div class="setting">
        <?php get_template_part('templates/option', 'content') ?>
        <button id="test">click me</button>
    </div>
</div>

<script>
    function vio_click() {
        alert("start")
        vio.action('the_test',{},(data)=>{
            alert(data)
        })
    }


    $("#test").click(function() {
        vio_click()
    })
</script>