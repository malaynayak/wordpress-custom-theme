<?php 

get_header(); ?>
<div class="site-content clearfix">
    <div class="main-column">
        <?php 
            if(have_posts()) :
                while(have_posts()): the_post() ?>
                <?php get_template_part('content', get_post_format()); ?>
            <?php
                endwhile;
                // previous_posts_link();
                // next_posts_link();
                echo paginate_links();
            else:
                echo '<p>No Posts Available</p>';
            endif;
        ?>
    </div>
    <?php get_sidebar(); ?>
</div>
    
<?php get_footer(); ?>