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
<?php
    endwhile;
else:
    echo '<p>No Posts Available</p>';
endif;
get_footer(); 
?>