<?php

if (post_password_required()) {
    return;
}
?>
<?php if (have_comments()) : ?>
    <div class="comments">
        <h3>评论</h3>
        <?php comment_form(); ?> 
        <ul>
            <?php
        wp_list_comments( array( 
					'style' => 'ol', 
					'short_ping' => true, 
					'avatar_size' => 74, 
				) ); 
            ?>
            ?>
        </ul>
        
    <?php else : ?>
        <?php comment_form(); ?> 
    <?php endif ?>