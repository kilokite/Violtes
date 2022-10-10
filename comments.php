
<?php if(have_comments()):?>
    <div class="comments">
        <h3>评论</h3>
        <ul>
        <?php 
				wp_list_comments( array( 
					'style' => 'ol', 
					'short_ping' => true, 
					'avatar_size' => 74, 
				) ); 
			?> 
        </ul>

    <?php else:?>
        <h2>没评论</h2>
    <?php endif?>