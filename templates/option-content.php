<div class="wrap"> 
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1> 
		<form action="options.php" method="post"> 
			<?php 
			// 为注册设置“wporg”输出安全字段 
			settings_fields('vio-option-content');
			// 输出设置部分及其字段
			// (sections 为 "wporg" 注册，每个字段都注册到特定的 section) 
			do_settings_sections( 'vio-option-content' ); 
			// 输出保存设置按钮
			submit_button( '保存设置' ); 
			?> 
		</form> 
	</div> 

