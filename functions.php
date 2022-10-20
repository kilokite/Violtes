<?php
$GLOBALS['VIO_V'] = 100;
//大版本+100000，数据结构改变+100，日常+2，修bug+1
//version

function vio_require_styles()
{
	//静态资源
	wp_enqueue_style('vio-min', get_theme_file_uri('static/css/vio-min.css'));
}
add_action('wp_enqueue_scripts', 'vio_require_styles');



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
}

add_filter('show_admin_bar', '__return_false'); //移除顶部工具栏（admin_bar）
//TODO 隐藏 还是 更好的的显示方式
//这玩意真有人用？

//注册菜单（导航栏）
function register_my_menus()
{
	register_nav_menus(
		array(
			'header-menu' => '顶部菜单（导航栏）',
		)
	);
}
add_action('init', 'register_my_menus');

//特色图片支持
add_theme_support("post-thumbnails");

//摘录字数 150
function wpdocs_custom_excerpt_length($length)
{
	return 150;
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

//violets functions

//init and update
function vio_init()
{
	$init  = get_option('vio-init');
	if ($init == false || $init < $GLOBALS['VIO_V'] - 99) {
		//初始化 || 更新
		$default = array(
			'site_info' => array(
				'name' => 'Violets', //站长名?
				'portrait' => '',    //头像
				'sign' => 'person worthy of that name', //签名
			)
		);
		if ($init == false) {
			foreach ($default as $key => $value) {
				add_option('vio-' . $key, json_encode($value));
			}
		} else {
			//UPDATE？
			foreach ($default as $key => $value) {
				$old = json_decode(get_option('vio-' . $key), true);
				foreach ($value as $k => $v) {
					if (!isset($old[$k])) {
						//新的
						$old[$k] = $v;
					}
				}
				update_option('vio-' . $key, json_encode($old));
			}
		}
		update_option('vio-init', $GLOBALS['VIO_V']);
	}
}
vio_init();

$vio_options = array(); //算缓存？

function vio_option($class, $item, $return = false)
{
	//获取单个项 类 项 返回方式
	global $vio_options;
	//JSON方式保存 读取
	if (!isset($vio_options[$class]) || $vio_options[$class] == null) {
		$vio_options[$class] = json_decode(get_option("vio-" . $class), true);
	}
	if (isset($vio_options[$class][$item])) {
		if ($return) {
			return $vio_options[$class][$item];
		} else {
			echo $vio_options[$class][$item];
		}
	}else{
		if($return){
			return null;
		}
		echo 'null';
	}
}


function vio_set_option($class, $items)
{
	global $vio_options;
	//有什么换什么
	$option = json_decode(get_option("vio-" . $class), true);
	foreach ($items as $key => $value) {
		$option[$key] = $value;
	}
	update_option("vio-" . $class, json_encode($option));
	$vio_options[$class] = null;
}


function vio_sidebar($bar)
{
	//侧栏 blog信息应该是
	get_template_part('templates/sidebar', $bar);
}


function vio_badge($num)
{
	//TODO 取得徽章
	$badge = get_option("vio-badge");
	$badge = explode(",", $badge);
}

function vio_pagination()
{
	//分页
	the_posts_pagination(array(
		'max_size'  => 2,
		'prev_text' => __('◂', 'textdomain'),
		'next_text' => __('▸', 'textdomain'),
	));
}
