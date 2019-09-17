<?php

// Creating the widget 
class Demo_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'demo_Widget', // Base ID of your widget
            __('Demo Widget'), // Widget name will appear in UI
            array(
                'classname' =>  'Demo_Widget',
                'description' => __('Sample wodpress widget'),
            )
        );
    }

    // Creating widget front-end
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output
        $postsQuery  = new WP_Query('cat='.$instance['category'].'&posts_per_page='.$instance['num_posts']);
        if($postsQuery->have_posts()) {
            echo '<ul>';
            while($postsQuery->have_posts()){
                $postsQuery->the_post();
                echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';
            }
            wp_reset_postdata();
            echo '</ul>';
        }
        echo $args['after_widget'];
    }

    // Widget Backend 
    public function form($instance)
    {   
        $title = __('New title');
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }

        $category_id = get_category_by_slug('uncategorized')->term_id;
        if (isset($instance['category'])) {
            $category_id = $instance['category'];
        }

        $num_posts = 2;
        if (isset($instance['num_posts'])) {
            $num_posts = $instance['num_posts'];
        }

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input 
                class="widefat" 
                id="<?php echo $this->get_field_id('title'); ?>" 
                name="<?php echo $this->get_field_name('title'); ?>" 
                type="text" 
                value="<?php echo esc_attr($title); ?>" 
            />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category:'); ?></label>
            <select 
                class="widefat" 
                id="<?php echo $this->get_field_id('category'); ?>" 
                name="<?php echo $this->get_field_name('category'); ?>">
                <?php foreach(get_categories() as $category): ?>
                    <option <?php echo ($category_id == $category->term_id) ? "selected":""; ?> value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e('Num Posts:'); ?></label>
            <input 
                class="widefat" 
                id="<?php echo $this->get_field_id('num_posts'); ?>" 
                name="<?php echo $this->get_field_name('num_posts'); ?>" 
                type="number"
                min=0
                max=5
                value="<?php echo esc_attr($num_posts); ?>" 
            />
        </p>
<?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['category'] = (!empty($new_instance['category'])) ? strip_tags($new_instance['category']) : '';
        $instance['num_posts'] = (!empty($new_instance['num_posts'])) ? strip_tags($new_instance['num_posts']) : '';
        return $instance;
    }
}