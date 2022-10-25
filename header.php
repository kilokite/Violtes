<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name') . wp_title("&nbsp; - &nbsp;") ?></title>
    <?php wp_head() ?>
</head>

<body>
    <header>
        <!-- 导航栏 -->
        <?php wp_nav_menu(array('header-menu' => '顶部菜单')) ?>
    </header>
    <!-- banner -->
    <section class="banner">
        <div class="banner-content">


            <?php if (is_404()) : ?>
                <div class="sayhello vio-404">
                    <h1>404</h1>
                    <p>The ordinary days that we live in may, in fact, be a series of miracles.</p>
                </div>
            <?php else : ?>
                <div class="sayhello">
                    <h1><?php bloginfo('name') ?></h1>
                    <p><?php bloginfo('description') ?></p>
                </div>
            <?php endif ?>

        </div>
    </section>
    <?php
    //导航栏 
    //wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
    ?>