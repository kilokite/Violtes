<?php get_header() ?>
<div class="container content">
<main class="vio-single">
<article>
    <?php if (have_posts()) : ?>
        <?php the_post() ?>
        <div class="info">
            <div>
                <h1><?php the_title() ?></h1>
                <div class="post-meta">
                    <?php if (has_post_thumbnail()) :  //根据有无头图提供不同信息展示方式 
                    ?>
                        <p> <span>分类</span><span class="art-cats item"><?php the_category(' ') ?></span></p>
                        <p> <span>标签</span><span class="art-tags item"><?php the_tags("", " ") ?></span></p>
                        <p> <span>评论</span><span class="item"><?php comments_number() ?></span></p>
                        <p> <span>时间</span><span class="item"><?php the_time('Y-m-d H:m') ?></span></p>
                        <?php //英文长度不统一 S,T,S,T吧，可能 
                        ?>
                    <?php else : ?>
                        <P>
                            <span class="item"><?php the_time('Y-m-d H:m') ?></span>
                            <span class="art-cats item"><?php the_category(' ') ?></span>
                            <span class="art-tags item"><?php the_tags("", " ") ?></span>
                            <span class="item"><?php comments_number() ?></span>
                        </p>
                    <?php endif ?>
                </div>
            </div>
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="这是个特色图片？" class="thumbnail">
            <?php endif ?>
        </div>

        <div class="main-body">
            <?php the_content() ?>
        </div>
    <?php else : ?>
        <h1 style="font-size: 3rem;">文章哪去了?</h1>
        <p>????</p>
    <?php endif ?>

</article>

<div class="vio-comments">
    <?php comments_template() ?>
</div>
</main>
<div class="sidebar">
    <?php vio_sidebar('user') ?>
</div>
</div>
<?php get_footer()?>