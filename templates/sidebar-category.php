<?
//获取所有分类
$categories = get_categories();
$tags = get_tags();
?>

<div class="vio-card bar-category">
    <!-- <h3>各种各样</h3> -->
    <ul>
        <?php foreach ($categories as $category) : ?>
            <li class="category">
                <a href="<?php echo get_category_link($category->term_id) ?>">
                    <?php echo $category->name ?>
                </a>
                <span><? echo $category->category_count?></span>
            </li>
        <?php endforeach ?>
        <?php foreach ($tags as $tag) : ?>
            <li class="tag">
                <a href="<?php echo get_tag_link($tag->term_id) ?>">
                    <?php echo $tag->name ?>
                </a>
                <span><? echo $tag->count?></span>
            </li>
        <?php endforeach ?>
    </ul>
</div>