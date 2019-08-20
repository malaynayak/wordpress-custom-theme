        <footer class="site-footer">
            <?php if (get_theme_mod('dt_footer_callout_display') == 'Yes'): ?>
                <div class="footer-callout clearfix">
                    <div class="footer-callout-image">
                        <img src="<?php echo wp_get_attachment_url(get_theme_mod('dt_footer_callout_image')) ?>" alt="">
                    </div>
                    <div class="footer-callout-text">
                        <h2>
                            <a href="<?php echo get_permalink(get_theme_mod('dt_footer_callout_link')); ?>">
                                <?php echo get_theme_mod('dt_footer_callout_headline'); ?>
                            </a>
                        </h2>
                        <?php echo wpautop(get_theme_mod('dt_footer_callout_text')); ?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="footer-widgets clearfix">
                <?php if(is_active_sidebar('footer1')): ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer1'); ?>
                    </div>
                <?php endif; ?>
                <?php if(is_active_sidebar('footer2')): ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer2'); ?>
                    </div>
                <?php endif; ?>
                <?php if(is_active_sidebar('footer3')): ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer3'); ?>
                    </div>
                <?php endif; ?>
                <?php if(is_active_sidebar('footer4')): ?>
                    <div class="footer-widget-area">
                        <?php dynamic_sidebar('footer4'); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="footer-bottom">
                <nav class="site-nav">
                    <?php wp_nav_menu([
                        'theme_location' => 'footer'
                    ]) ?>
                </nav>
                <div class="copy"><?php bloginfo('name') ?><?php echo ' - @'.date('Y') ?></div>
            </div>
        </footer>
    </div>
    <?php wp_footer(); ?>
    </body>
</html>