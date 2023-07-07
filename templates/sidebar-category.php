<?
//获取所有分类
$categories = get_categories();
$tags = get_tags();
?>

<div class="vio-card bar-category">
    <!-- <h3>各种各样</h3> -->
            <?php foreach ($categories as $category) : ?>
                    <a href="<?php echo get_category_link($category->term_id) ?>" class="category">
                        <?php echo $category->name ?>
                    </a>
            <?php endforeach ?>
            <?php foreach ($tags as $tag) : ?>
                    <a href="<?php echo get_tag_link($tag->term_id) ?>" class="tag">
                        <?php echo $tag->name ?>
                    </a>
            <?php endforeach ?>
</div>