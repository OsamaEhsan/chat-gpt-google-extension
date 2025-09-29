<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <?php bloginfo('name'); ?>
            </div>
            <p class="footer-description">
                <?php 
                $footer_description = get_theme_mod('footer_description', 'Creating exceptional digital experiences that drive results and exceed expectations.');
                echo esc_html($footer_description);
                ?>
            </p>
            <div class="footer-social">
                <?php
                $social_links = array(
                    'facebook'  => get_theme_mod('facebook_url', '#'),
                    'twitter'   => get_theme_mod('twitter_url', '#'),
                    'linkedin'  => get_theme_mod('linkedin_url', '#'),
                    'instagram' => get_theme_mod('instagram_url', '#'),
                );
                
                $social_icons = array(
                    'facebook'  => '📘',
                    'twitter'   => '🐦',
                    'linkedin'  => '💼',
                    'instagram' => '📷',
                );
                
                foreach ($social_links as $platform => $url) :
                    if (!empty($url) && $url !== '#') :
                ?>
                    <a href="<?php echo esc_url($url); ?>" class="social-link" aria-label="<?php echo esc_attr(ucfirst($platform)); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo $social_icons[$platform]; ?>
                    </a>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'modern-landing-pro'); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>