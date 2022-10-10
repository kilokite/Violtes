<?php

/** Step 2 (from text above). */
add_action('admin_menu', 'my_menu');

/** Step 1. */
function my_menu()
{
	// add_options_page('Violets','Test','manage_options','my-unique-identifier','my_options');
	add_menu_page('主题设置', 'Violets', 'manage_options', 'option_main', 'option_main', 'dashicons-admin-generic', 6);
	add_submenu_page('option_main', '主题设置', '外观设置', 'manage_options', 'option_style', 'option_style');
}

//option_style
function option_style(){
	If(!current_user_can('manage_options')){
		wp_die('You do not have sufficient permissions to access this page.');
	}
	get_template_part('templates/option','style');
}
/** Step 3. */
function my_options()
{
	if (!current_user_can('manage_options')) {
		wp_die(__('You do not have sufficient permissions to access this page.'));
	}
	echo 'Here is where I output the HTML for my screen.';
	echo '</div><pre>';
}



//添加顶级菜单
// add_action('admin_menu', 'top_menu');
// function top_menu(){
// 	add_menu_page('主题设置', '主题设置', 'manage_options', 'option_main', 'option_main', 'dashicons-admin-generic', 6);
// }

function option_main()
{
	if (!current_user_can('manage_options')) {
		wp_die('You do not have sufficient permissions to access this page.');
	}
	get_template_part('templates/option', 'main');
}




function register_my_menus() {
	register_nav_menus(
	  array(
		'header-menu' => __( 'Header Menu' ),
		'extra-menu' => __( 'Extra Menu' )
	   )
	 );
   }
   add_action( 'init', 'register_my_menus' );
