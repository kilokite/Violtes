<?php

if (post_password_required()) {
    return;
}
?>
<?php if (have_comments()) : ?>
    <div class="comments">
        <h3 class="comment_title">评论</h3> 
        <!-- 感觉这俩字是多余的，这还看不出来是评论？ -->
         <?php comment_form(Array(
            'fields' => Array(
                'email' => '<span class="title">email</span> <input id="email" name="email" type="text" class="input"/>',
                'url' => '<span class="title">url</span> <input id="email" name="email" type="text" class="input"/>',
                'author' => '<span class="title">author</span> <input id="email" name="email" type="text" class="input"/>',
            ),
            'title_reply' => "", //“发表评论”
            'title_reply_to' => "回复给 %s",
            'comment_notes_before' => '',
            'comment_field' => '<textarea type="text" id="comment_input" name="comment" class="comment_input"></textarea>',
            //TODO textarea 自动增高 以后js解决
            'logged_in_as' => ""

         )); ?> 

        
        <ul>

            <?php
        wp_list_comments( array( 
					'style' => 'ul', 
					'short_ping' => true, 
					'avatar_size' => 74, 
                    'callback' => 'vio_comment',
				) ); 
            ?>

        </ul>
        
    <?php else : ?>
        <?php comment_form(); ?> 
    <?php endif ?>