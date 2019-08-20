<?php 

get_header(); 

if(have_posts()) : ?>
    <h2>Search Results For: <?php the_search_query() ?></h2>
    <?php
    while(have_posts()): the_post() ?>
    <?php get_template_part('content', get_post_format()); ?>
<?php
    echo paginate_links();
    endwhile;
else:
    echo '<h2>No Search Results For: '. get_search_query(). '</h2>';
endif;
get_footer(); 
?>