<?php
$GLOBALS['VIO_V'] = 100;
//？ 大版本+100000，数据结构改变+100，日常+2，修bug+1
//version
$GLOBALS['force_update'] = true;
//强制更新数据结构

require_once(get_theme_file_path('functions-ugly.php'));
// 不好看的functions ugly functions

function vio_require_styles()
{
	//引入静态资源
	wp_enqueue_style('vio-min', get_theme_file_uri('static/css/vio-min.css'));
}
add_action('wp_enqueue_scripts', 'vio_require_styles');


//# 特性 feature

function my_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style')); //移除评论样式
}
add_filter('show_admin_bar', '__return_false'); //移除顶部工具栏（admin_bar）
//TODO 隐藏 还是 更好的的显示方式
//？这玩意真有人用？

/**注册菜单（导航栏）*/
function register_my_menus()
{
	register_nav_menus(
		array(
			'header-menu' => '顶部菜单（导航栏）',
		)
	);
}
add_action('init', 'register_my_menus');


add_theme_support("post-thumbnails");
//特色图片支持

/**摘录字数*/
function wpdocs_custom_excerpt_length($length)
{
	return 150;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

/**摘录省略号*/
function wpdocs_excerpt_more($more)
{
	return '<span class="art-ellipsis">.....</span>';
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');


/**添加菜单*/
function vio_menu()
{
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

//# violets functions

//保存与使用设置选项
//init & update
function vio_init()
{
	$init  = get_option('vio-init');
	if ($init == false || $init < $GLOBALS['VIO_V'] - 99 || $GLOBALS['force_update']) {
		//初始化 || 更新
		$default = array(
			'site_info' => array(
				'name' => 'Violets', //站长名?
				'portrait' => '',    //头像
				'sign' => 'person worthy of that name', //签名
			),
			'footer' => array(
				'name' => 'ZSKT Studio', //底部署名
			),
			'style' => array(
				'theme_color' => 'violet',
				'pjax' => true,
			),
			'test' => array(
				//TODO
				'input' => 'none',
				'select' => 'A',
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
		//标记初始化
	}
}
vio_init();

//## 设置选项
$vio_options = array(); //？ 缓存选项

/**获取设置选项*/
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
	} else {
		if ($return) {
			return null;
		}
		echo 'null';
	}
}

/**设置设置选项*/
function vio_set_option($class, $items)
{
	global $vio_options;
	//有什么换什么
	if(($option = get_option("vio-" . $class)) == false){
		//不存在
		echo 1;
		return false;
	}
	$option = json_decode($option, true);
	foreach ($items as $key => $value) {
		if(isset($option[$key])){
			$option[$key] = $value;
		}else{
			echo json_encode($option);
			echo 2 . $key;
			return false;
		}
	}
	update_option("vio-" . $class, json_encode($option));
	$vio_options[$class] = null;
	return true;
}

/**获取侧边栏模板*/
function vio_sidebar($bar)
{
	get_template_part('templates/sidebar', $bar);
}

/**取得徽章*/
function vio_badge($num)
{
	//TODO
	$badge = get_option("vio-badge");
	$badge = explode(",", $badge);
}

/**分页*/
function vio_pagination()
{
	the_posts_pagination(array(
		'max_size'  => 2,
		'prev_text' => __('◂', 'textdomain'),
		'next_text' => __('▸', 'textdomain'),
	));
}

//# ajax
/**ajax*/
function vio_ajax()
{
	$post_data = $_POST['data'];
	$return  = array();
	$func = "vio_ajax_" . $post_data['action'];
	if (function_exists($func)) {
		//存在 不需要管理员的 函数
		$return['return'] = $func($post_data);
	} elseif (function_exists($func = $func . '_manager')) {
		//存在 需要管理员的 函数
		if (current_user_can('manage_options')) {
			//是管理员
			$return['return'] = $func($post_data);
		} else {
			$return['error'] = 'no permission';
		}
	} else {
		$return['error'] = 'no action ' ;
	}
	echo json_encode($return);
	wp_die();
}
add_action('wp_ajax_vio_ajax', 'vio_ajax');

function vio_ajax_get_option_page_manager($data){
	//获取设置页面
	$option = $data['name'];
	$option = str_replace(array('..', '/', '\\'), '', $option);
	$template_path = get_template_directory() . '/templates/option-' . $option . '.php';
	if (file_exists($template_path)) {
		ob_start();
		// get_template_part('templates/option', 'content');
		include_once($template_path);
		$return = ob_get_contents();

		ob_end_clean();
		return $return;
	} else {
		return "no file $option";
	}
}
/**设置选项 */
function vio_ajax_set_option_manager($data){
	$class = $data['optionClass'];
	$items = $data['items'];
	if(vio_set_option($class, $items)){
		return true;
	}else{
		return false;
	}
}
