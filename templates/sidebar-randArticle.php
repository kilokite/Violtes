<?
$randArticlelist = get_posts(array(
    'numberposts' => 5,
    'orderby' => 'rand',
    'post_status' => 'publish',
    'post_type' => 'post',
    'suppress_filters' => true
));

?>
<div class="vio-card bar-article">
    <div id="bar_article_list">
    <?foreach($randArticlelist as $post):?>
    <p class="bar-article-title"><a href="<?php the_permalink()?>" class="bar-article-title"><? the_title()?></a></p>
    <?endforeach?>
    </div>
    <div class="helper">
    <div class="tool">
            <span class="icon-sync icon"></span>
            <button class="tool-random icon" id="tool_random">手气不错</button>
        </div>
    </div>
</div>