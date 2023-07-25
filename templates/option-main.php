<script src="<?php echo get_theme_file_uri('static/js/jquery-min.js') ?>"></script>
<script src="<?php echo get_theme_file_uri('static/js/vio-option.js') ?>"></script>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('static/css/vio-option.css') ?>">
<?  wp_enqueue_media();?>
<script>
    let vioValue = {
        ajaxURL: "<?php echo admin_url('admin-ajax.php') ?>"
    }
</script>

<!-- <button onclick="vio_click()">ajax</button> -->
<div onclick="toggleMenu()" class="open-menu"></div>
<div class="vio-setting">
    <div class="setting_list">
        <ul>
            <li>
                <button page="site">站点</button>
            </li>
            <li>
                <button page="style">样式</button>
            </li>
            <li>
                <button page="content">内容</button>
            </li>
            <li>
                <button page="sidebar">侧边栏</button>
            </li>
            <li>
                <button page="other">其他</button>
            </li>
        </ul>
    </div>
    <div class="vio-option-container">
        <!-- 选项容器 -->
    </div>
</div>

