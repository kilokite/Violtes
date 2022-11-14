
<?php if (isset($_POST['save'])) : ?>
	<?php
	vio_set_option('site_info', array(
		'name' => $_POST['name'],
		'portrait' => $_POST['portrait'],
		'sign' => $_POST['sign']
	));

	vio_set_option('footer', array(
		'name' => $_POST['footer_name']
	));


	?>
	<div class="toast">设置已保存</div>
<?php endif ?>


<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
<form method="post">

	<div>
		<h2>站点信息</h2>
		<p class="tips">有关你和你的站点的信息</p>
		<div>
			<?php
			vio_option_component_input("头像URL", "portrait", 'site_info', 'portrait');
			vio_option_component_input("名字", 'name', 'site_info', 'name');
			vio_option_component_input('简短的介绍/签名', 'sign', 'site_info', 'sign');
			?>
			<p class="tips">不建议写太长</p>
		</div>
	</div>
	<div>
		<h2>内容</h2>
		<p class="tips">将会站点中展示的乱七八糟东西</p>
		<div>

		</div>
	</div>
	<div>
		<h2>底部信息</h2>
		<p class="tips">显示在底部的东西</p>
		<div>
			<?php
			vio_option_component_input('署名', 'footer_name', 'footer', 'name');

			?>
		</div>
	</div>

	<button type="submit" name="save">save</button>
</form>