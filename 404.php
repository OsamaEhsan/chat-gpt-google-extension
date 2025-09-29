<?php get_header(); ?>

<section class="error-404 section-padding">
    <div class="container">
        <div class="error-content text-center">
            <div class="error-number">
                <h1 style="font-size: 8rem; font-weight: 700; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; margin-bottom: 2rem;">
                    404
                </h1>
            </div>
            
            <div class="error-message">
                <h2 style="font-size: 2.5rem; font-weight: 600; margin-bottom: 1.5rem; color: #2d3748;">
                    <?php esc_html_e('Oops! Page Not Found', 'modern-landing-pro'); ?>
                </h2>
                
                <p style="font-size: 1.25rem; color: #718096; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">
                    <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'modern-landing-pro'); ?>
                </p>
                
                <div class="error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                        <?php esc_html_e('Go Back Home', 'modern-landing-pro'); ?>
                    </a>
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <?php esc_html_e('Go Back', 'modern-landing-pro'); ?>
                    </a>
                </div>
            </div>
            
            <div class="search-form" style="margin-top: 4rem;">
                <h3 style="font-size: 1.5rem; margin-bottom: 2rem; color: #2d3748;">
                    <?php esc_html_e('Try searching for what you need:', 'modern-landing-pro'); ?>
                </h3>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<style>
.error-404 {
    min-height: 70vh;
    display: flex;
    align-items: center;
}

.error-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.search-form {
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.search-form input[type="search"] {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
    margin-bottom: 1rem;
    transition: border-color 0.3s ease;
}

.search-form input[type="search"]:focus {
    border-color: #667eea;
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.search-form input[type="submit"] {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-form input[type="submit"]:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

@media (max-width: 768px) {
    .error-404 .error-number h1 {
        font-size: 6rem;
    }
    
    .error-404 .error-message h2 {
        font-size: 2rem;
    }
    
    .error-actions {
        flex-direction: column;
        align-items: center;
    }
}
</style>

<?php get_footer(); ?>