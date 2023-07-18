<?php get_header() ?>
<div class="container content">
    <main class="vio-single">
        <article>
            <?php if (have_posts()) : ?>
                <?php the_post() ?>
                <div class="main-body">
                    <?php the_content() ?>
                </div>
            <?php else : ?>
                <h1 style="font-size: 3rem;">文章哪去了?</h1>
                <p>????</p>
            <?php endif ?>

        </article>
        <?php if (comments_open()) : ?>
            <div class="vio-comments">
                <?php comments_template() ?>
            </div>
        <?php endif ?>
    </main>
    <div class="sidebar">
        <div>
        <?vio_get_sidebar('page')?>
        </div>
    </div>
</div>
<?php get_footer() ?>