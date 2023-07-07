<?php
include_once 'option-component.php';
?>


<h1><?php //echo esc_html(get_admin_page_title()); ?></h1>
<form method="post" option_class="data_card">
	<div>
		<h2>资料卡</h2>
        <h3>个人信息</h3>
		<p class="tips">有关你和你的站点的信息</p>
        <?vio_option_component_input('data_card','name','昵称',"name")?>
        <?vio_option_component_input('data_card','portrait','头像URL',"name",'media')?>
        <?vio_option_component_input('data_card','sign','简短的介绍',"name")?>
	</div>
    <?vio_option_component_switch('data_card','enable',"显示资料卡")?>
	<button type="submit">save</button>
</form>

<form action="post" option_class="footer">
<div>
	<div>
		<h2>底部信息</h2>
		<div>
			<h3>署名</h3>
			<?php
			vio_option_component_input('footer','name',"站点底部署名");
			?>
			<?vio_option_component_input('footer','custom','自定义HTML','HTML','textarea')?>
		</div>
	</div>
	<button type="submit">save</button>

</form>