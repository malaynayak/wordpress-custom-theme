<?php 

get_header(); ?>
<div class="site-content clearfix">
    <?php 
        if(have_posts()) :
            while(have_posts()): the_post() ?>
            <?php the_content(); ?>
        <?php
            endwhile;
        else:
            echo '<p>No Posts Available</p>';
        endif;
    ?>

    <div class="home-columns clearfix">
        <div class="one-half">
            <!-- Opinions -->
            <h2>Recent Opinions</h2>
            <?php 
                $opinionPosts  = new WP_Query('cat=9&posts_per_page=2');
                if($opinionPosts->have_posts()) :
                    while($opinionPosts->have_posts()): $opinionPosts->the_post() ?>
                        <article class="post <?php echo (has_post_thumbnail())? 'has-thumbnail':'' ?>">
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('tiny-thumbnail') ?>
                            </div>
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            <?php the_excerpt(); ?> 
                        </article>
                <?php
                    endwhile;
                else:
                    echo '<p>No Posts Available</p>';
                endif;
                wp_reset_postdata();
                ?>
                <a class="posts-button" href="<?php echo get_category_link(9) ?>">View All Opinions</a>
        </div>
        
        <div class="one-half last">
            <!-- News -->
            <h2>Recent News</h2>
            <?php 
                $opinionPosts  = new WP_Query('cat=3&posts_per_page=2');
                if($opinionPosts->have_posts()) :
                    while($opinionPosts->have_posts()): $opinionPosts->the_post() ?>
                        <article class="post <?php echo (has_post_thumbnail())? 'has-thumbnail':'' ?>">
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('tiny-thumbnail') ?>
                            </div>
                            <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            <?php the_excerpt(); ?> 
                        </article>
                <?php
                    endwhile;
                else:
                    echo '<p>No Posts Available</p>';
                endif;
                wp_reset_postdata();
                ?>
                <a class="posts-button" href="<?php echo get_category_link(3) ?>">View All News</a>
        </div>
    </div>
</div>
    
<?php get_footer(); ?>