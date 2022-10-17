<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name') ?></title>
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
            <div class="sayhello">
                <h1><?php bloginfo('name') ?></h1>
                <p><?php bloginfo('description') ?></p>
            </div>

        </div>
    </section>
    <div class="container">
        <!-- 正片 -->
        <!--     
<?php
//导航栏 
//wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
?> -->