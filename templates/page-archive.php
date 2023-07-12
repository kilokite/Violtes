<?php /* Template Name: 归档 */ ?>

<?
$the_query = new WP_Query('posts_per_page=-1&ignore_sticky_posts=1');
$the_year = 0;
?>

<?php get_header() ?>
<div class="container content">
    <main class="vio-single">
        <article>
            <?php if (have_posts()) : ?>
                <?php the_post() ?>
                <div class="main-body">
                    <?php the_content() ?>
                </div>
            <? endif ?>
            <div class="cutup"></div>
            <ul class="vio-archive">
            <?while($the_query->have_posts()):$the_query->the_post()?>
                <?
                $year = get_the_time('Y');
                if($year != $the_year):
                $the_year = $year
                ?>
                <li><h2><?echo $year?>年</h2></li>
                <?endif?>
                <li class="M<?the_time('m')?>"><span><?the_time('m / d')?></span><a href="<?the_permalink()?>"><?the_title()?></a></li>
            <?endwhile?>
            </ul>
        </article>
    </main>
    <div class="sidebar">
        <?php vio_sidebar('user') ?>
        <? vio_sidebar('category')?>
    </div>
</div>
<?php get_footer() ?>