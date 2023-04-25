<script src="<?php echo get_theme_file_uri('static/js/jquery-min.js') ?>"></script>
<script src="<?php echo get_theme_file_uri('static/js/vio-option.js') ?>"></script>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('static/css/vio-option.css') ?>">

<script>
    let vioValue = {
        ajaxURL: "<?php echo admin_url('admin-ajax.php') ?>"
    }
</script>

<!-- <button onclick="vio_click()">ajax</button> -->

<div class="vio_setting">
    <div class="setting_list">
        <ul>
            <li>
                <button page="site">站点</button>
            </li>
            <li>
                <button page="style">顶部与底部</button>
            </li>
            <li>
                <button page="content">内容</button>
            </li>
            <li>
                <button page="top">侧边栏</button>
            </li>
            <li>
                <button page="top">SEO</button>
            </li>
            <li>
                <button page="test">测试</button>
            </li>
        </ul>
    </div>
    <div class="vio-option-container">
        <!-- 选项容器 -->
    </div>
</div>

