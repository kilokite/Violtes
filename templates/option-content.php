<?php
if (isset($_POST['name'])) {
?> <h2>saved</h2> <?php
					}

						?>

<link rel="stylesheet" href="<?php get_theme_file_uri('static/css/') ?>">


<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
<form method="post">
	<h2>站点信息</h2>
	<p> 头像URL <input type="text" name="name"> </p>
	<button type="submit">save</button>
</form>