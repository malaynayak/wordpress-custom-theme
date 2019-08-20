<article class="post <?php echo (has_post_thumbnail())? 'has-thumbnail':'' ?>">
    <div class="post-thumbnail">
        <?php the_post_thumbnail('small-thumbnail') ?>
    </div>
    <h2>
        <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
    </h2>
    <p class="post-info"><?php the_time('F jS, Y g:i a') ?> 
        | By <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author() ?></a>
        | Posted in 
        <?php  
            $categories = get_the_category();
            $op = '';
            if ($categories) {
                foreach($categories as $category) {
                    $op .= '<a href="'. get_category_link($category->term_id).'">'.$category->cat_name.'</a>,';
                }
            }
            echo trim($op, ',');
        ?>
    </p>
    <?php 
    if (is_search() || is_archive()) { 
        the_excerpt();
    } else { 
        if($post->post_excerpt) {
            the_excerpt();
        } else {
            the_content();
        }
    }?> 
</article>