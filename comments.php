<?php

if (post_password_required()) {
    return;
}
?>
<h3 class="comment_title">评论</h3>
<!-- 感觉这俩字是多余的，这还看不出来是评论？ --> 
<?php comment_form(array(
    //TODO 垃圾东西，等我ajax
    'fields' => array(
        'email' => '<input id="email" name="email" type="text" class="input" placeholder="email"/>',
        'url' => '<input id="url" name="url" type="text" class="input" placeholder="blog url"/>',
        'author' => '<input id="author" name="author" type="text" class="input" placeholder="author"/>',
    ),
    'title_reply_before' => '',
    'title_reply' => "", //“发表评论”
    'title_reply_after' => '',
    'title_reply_to' => '<span class="reply_title">你 ▸ %s</span>',
    'comment_notes_before' => '',
    'comment_field' => '<textarea type="text" id="comment_input" name="comment" class="comment_input" placeholder="写点啥"></textarea>',
    //TODO textarea 自动增高 以后js解决
    'logged_in_as' => "",
    'cancel_reply_link'=>'取消',
    'label_submit' => "发送"

)); ?>

<?php if (have_comments()) : ?>
    <div class="comments">
        <?
        // print_r(get_comments(array('post_id' => get_the_ID())));
        ?>
        <ul>

            <?php
            wp_list_comments(array(
                'style' => 'ul',
                'short_ping' => true,
                'avatar_size' => 74,
                'callback' => 'vio_comment',
            ));
            ?>

        </ul>

    <?php else : ?>
        <!-- <p>无评论</p> -->
    <?php endif ?>