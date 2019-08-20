<?php 

get_header(); 

if(have_posts()) :
    while(have_posts()): the_post() ?>
    <article class="post">
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
        <?php the_post_thumbnail('banner-image') ?>
        <?php the_content() ?>
        <div class="about-author">
            <div class="author-image">
                <?php echo get_avatar(get_the_author_meta('ID'), 150); ?>
                <p><?php echo get_the_author_meta('display_name') ?></p>
            </div>    
            <div class="author-text">
                <h3>About The Author</h3>
                <?php echo wpautop(get_the_author_meta('description')); ?>
                <div class="other-posts-by">
                    <a class="posts-button" href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">
                        All Posts By <?php echo get_the_author_meta('display_name') ?>
                    </a>
                </div>
            </div>
        </div>
    </article>
<?php
    endwhile;
else:
    echo '<p>No Posts Available</p>';
endif;
get_footer(); 
?>