<?php get_header() ?>
<div class="container content">
<main class="vio-single">
<article>
    <?php if (have_posts()) : ?>
        <?php the_post() ?>
        <!-- <div class="info">
            <div>
                <h1><?php the_title() ?></h1>
            </div>
        </div> -->

        <div class="main-body">
            <?php the_content() ?>
        </div>

    <?php else : ?>
        <h1 style="font-size: 3rem;">文章哪去了?</h1>
        <p>????</p>
    <?php endif ?>

</article>
<?php if(comments_open()):?>
<div class="vio-comments">
    <?php comments_template() ?>
</div>
<?php endif?>
</main>
<div class="sidebar">
    <?php vio_sidebar('user') ?>
</div>
</div>
<?php get_footer()?>