<?php 

/*
Template Name: Two Col Layout
*/

get_header(); 
if(have_posts()) :
    while(have_posts()): the_post() ?>
    <article class="post page">
        <div class="title-column">
            <h2>
                <?php the_title() ?>
            </h2>
        </div>
        <div class="text-column">
            <?php the_content() ?>
        </div>
    </article>
<?php
    endwhile;
else:
    echo '<p>No Posts Available</p>';
endif;
get_footer(); 
?>