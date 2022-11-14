<?php
//太丑了，单独搞个文件

//删除head一些非必要的东西

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


//自定义评论模板
$comment_user = array();
function vio_comment($comment, $args, $depth)
{
	global $comment_user;
	$style = ''; //列表class li class
	$reply = false; //是否为回复？is reply?
	$comment_user[$depth] = $comment->comment_author;

	if ($depth > 1) {
		//回复
		$reply = true;
		if ($depth == 2) {
			$style = 'reply';
		}
	}
?>

	<li class="<?php echo $style ?>">

		<?php
		// echo json_encode(array(
		// 	'comment' => $comment,
		// 	'args' => $args,
		// 	'depth' => $depth
		// ));
		?>

		<div class="comment" id="comment-<?php comment_ID() ?>">

			<div class="avatar">
				<?php echo get_avatar($comment, 64); ?>
			</div>

			<div class="comment-content">

				<div class="info">
					<p class="name">
						<?php echo get_comment_author_link(); ?>
						<?php if ($reply) : ?>
							<span>▸</span>
							<span><?php echo $comment_user[--$depth] ?></span>
						<?php endif ?>
					</p>

					<span class="time"><span class="year"><?php echo get_comment_date('Y-'); ?></span><?php echo get_comment_date('m-d'); ?></span>
				</div>

				<div class="text">
					<?php comment_text(); ?>
				</div>

				<div class="reply_link">
					<?php comment_reply_link(array_merge($args, array('reply_text' => '回复', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div>

			</div>
		</div>

	<?php } ?>