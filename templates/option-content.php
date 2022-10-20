<?php if(isset($_POST['save'])):?>
	<?php
	vio_set_option('site_info',array(
		'name' => $_POST['name'],
		'portrait' => $_POST['portrait'],
		'sign' => $_POST['sign']
	));
		?>
	<div class="toast">设置已保存</div>
<?php endif?>
<link rel="stylesheet" href="<?php echo get_theme_file_uri('static/css/vio-option.css') ?>">


<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
<form method="post">

	<div>
		<h2>站点信息</h2>
		<P> <label for="portraitL">sidebar头像URL</label> <input type="text" name="portrait" id="portrait" value="<?php vio_option('site_info','portrait')?>"></P>
		<p><label for="name">名字</label> <input type="text" name="name" id="name" value="<?php vio_option('site_info','name')?>"></p>
		<p><label for="sign">简短的介绍|签名</label><input type="text" name="sign" id="sign" value="<?php vio_option('site_info','sign')?>"></p>
		<p><label for="badge">徽章(,分隔，不超过十个)</label> <input type="text" id="badge" name="badge"></p>
	</div>
	<button type="submit" name="save">save</button>
</form>