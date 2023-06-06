<?php
include_once 'option-component.php';
?>


<h1><?php //echo esc_html(get_admin_page_title()); ?></h1>
<form method="post" option_class="footer">
	<div>
		<h2>站点信息</h2>
		<p class="tips">有关你和你的站点的信息</p>
		<div>
			<?php
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
			vio_option_component_input('footer','name',"站点底部署名");

			?>
		</div>
	</div>

	<button type="submit">save</button>
</form>