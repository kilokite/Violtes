<?php get_header(); ?>
<?php // TODO 置顶帖子实现
?>

<main class="art-list">
    <?php if (is_archive()) : ?>
        <?php if (is_tag()) : ?>
            <div class="vio-archive-title" tag>
                <div>
                <h1>标签：<?php single_tag_title() ?></h1>
                <p><?php echo tag_description() ?></p>
                </div>
            </div>
        <?php elseif (is_category()) : ?>
            <div class="vio-archive-title">
                <div>
                <h1>分类：<?php single_cat_title() ?></h1>
                <p><?php echo category_description() ?></p>
                </div>
            </div>
        <?php endif ?>

    <?php endif ?>
    <?php if (have_posts()) : ?>
        <ul>
            <?php while (have_posts()) : the_post() ?>
                <li class="vio-card">
                    <div class="art-card">
                        <!-- 文字信息 -->
                        <h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                        <div class="art-excerpt"><?php the_excerpt() ?></div>
                        <p class="art-info">
                            <span><?php the_time("Y-m-d") ?></span>
                            <span class="art-cats"><?php the_category(" ", " ") //🐱
                                                    ?></span>
                            <span class="art-tags"><?php the_tags("", " ") ?></span>
                        </p>
                    </div>
                    <?php if (has_post_thumbnail()) : ?>
                        <!-- 图片 -->
                        <div class="art-img">
                            <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="">
                        </div>
                    <?php endif ?>
                </li>
            <?php endwhile ?>
        </ul>
        <div class="vio-pagination"><?php vio_pagination(); ?></div>

    <?php else : ?>
    <?php endif ?>
</main>

<nav class="sidebar">
    <!-- sideBar! -->
    <?php vio_sidebar('user') ?>
</nav>

<?php get_footer() ?>