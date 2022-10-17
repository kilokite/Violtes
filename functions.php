<?php

function vio_require_styles()
{
	//静态资源
	wp_enqueue_style('vio-min', get_theme_file_uri('static/css/vio-min.css'));
}
add_action('wp_enqueue_scripts', 'vio_require_styles');


function vio_fuck()
{
	//删除一些非必要的东西

	//remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
	remove_action('wp_head', 'feed_links', 2);   //移除feed
	remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
	remove_action('wp_head', 'rsd_link'); //移除离线编辑器开放接口
	remove_action('wp_head', 'wlwmanifest_link'); //移除头部的Windows Live Writer的适配器
	remove_action('wp_head', 'index_rel_link'); //去除本页唯一链接信息
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); //清除前后文信息
	remove_action('wp_head', 'start_post_rel_link', 10, 0); //清除前后文信息
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); //清除前后文信息
	//remove_action( 'wp_head', 'locale_stylesheet' ); //移除本地化样式表
	remove_action('publish_future_post', 'check_and_publish_future_post', 10, 1); //移除本地化样式表
	//remove_action( 'wp_head', 'noindex', 1 ); //移除本地化样式表
	//remove_action( 'wp_head', 'wp_print_styles', 8 ); //移除本地化样式表
	//remove_action( 'wp_head', 'wp_print_head_scripts', 9 ); //移除本地化样式表
	remove_action('wp_head', 'wp_generator');  //wordpress版本号
	//remove_action( 'wp_head', 'rel_canonical' ); //去除规范链接
	remove_action('wp_footer', 'wp_print_footer_scripts'); //移除页脚js
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0); //移除短链接
	remove_action('template_redirect', 'wp_shortlink_header', 11, 0); //移除短链接
	add_action('widgets_init', 'my_remove_recent_comments_style'); //移除评论样式
	function my_remove_recent_comments_style()
	{
		global $wp_widget_factory;
		remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style')); //移除评论样式

		add_filter('show_admin_bar', '__return_false'); //移除顶部工具栏（admin_bar）
		//TODO 隐藏 还是 更好的的显示方式
		//这玩意真有人用？


	}
}

function vio_feature()
{
	function register_my_menus() {
		register_nav_menus(
		  array(
			'header-menu' => '顶部菜单',
		   )
		 );
	   }
	   add_action( 'init', 'register_my_menus' );

	//添加特色图片支持
	add_theme_support("post-thumbnails");

	//摘录字数
	function wpdocs_custom_excerpt_length($length)
	{
		return 200;
	}
	add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

	//摘录省略号
	function wpdocs_excerpt_more($more)
	{
		return '<span class="art-ellipsis">.....</span>';
	}
	add_filter('excerpt_more', 'wpdocs_excerpt_more');

	function vio_menu()
	{
		//注册设置菜单
		add_menu_page("Violets", "Violets", "manage_options", "vio-option", "vio_option_main");
		function vio_option_main()
		{
			get_template_part("templates/option", "main");
		}
		add_submenu_page("vio-option", "内容", "内容", "manage_options", "vio-option-content", "vio_option_content");
		function vio_option_content()
		{
			get_template_part("templates/option", "content");
		}
		add_submenu_page("vio-option", "样式", "样式", "manage_options", "vio-option-style", "vio_option_style");
		function vio_option_style()
		{
			get_template_part("templates/option", "style");
		}
	}
	add_action('admin_menu', 'vio_menu');
}




function testMessage()
{
	echo "Test Message";
}

function vio_sidebar($bar)
{
	//侧栏 blog信息应该是
	get_template_part('templates/sidebar', $bar);
}

function vio_option($name){
	echo get_option("vio-".$name);
}

function vio_badge($num){
	$badge = get_option("vio-badge");
	$badge = explode(",", $badge);

}

vio_feature();
vio_fuck();

?>