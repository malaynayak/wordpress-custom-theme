<?php 

get_header(); 

if(have_posts()) :
    while(have_posts()): the_post() ?>
    <article class="post page">
        <?php if (has_children() || $post->post_parent > 0): ?>
            <nav class="site-nav children-links clearfix">
                <span class="parent-link">
                    <a href="<?php echo get_the_permalink(getTopParentId()) ?>">
                        <?php echo get_the_title(getTopParentId()) ?>
                    </a>
                </span>
                <ul>
                    <?php wp_list_pages([
                        'child_of' => getTopParentId(),
                        'title_li' => ''
                    ]) ?>
                </ul>
            </nav>
        <?php endif; ?>
        <h2>
            <?php the_title() ?>
        </h2>
        <?php the_content() ?>
    </article>
    <h3>Latest News Bulletins</h3>
    <?php 
        $currentPage = get_query_var('paged');
        $newsPosts  = new WP_Query([
            'category_name' => 'news',
            'posts_per_page' => 3,
            'paged' => $currentPage
        ]);
        if($newsPosts->have_posts()) :
            echo '<ul class="bulletins">';
            while($newsPosts->have_posts()) :
                $newsPosts->the_post(); ?>
                <li>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </li>
        <?php
            endwhile;

            //previous_posts_link('Previous Page')
            //next_posts_link('Next Page', $newsPosts->max_num_pages);

            echo paginate_links([
                'total' =>  $newsPosts->max_num_pages
            ]);
            echo '</ul>';
        endif;
        wp_reset_postdata();
        ?>
<?php
    endwhile;
else:
    echo '<p>No Posts Available</p>';
endif;
get_footer(); 
?>