<?php get_header(); ?>

<section class="page-content section-padding">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                <header class="page-header text-center">
                    <h1 class="page-title">
                        <?php the_title(); ?>
                    </h1>
                    <?php if (has_excerpt()) : ?>
                        <div class="page-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="page-content-wrapper">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="page-featured-image">
                            <?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="page-text">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'modern-landing-pro'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div>
                </div>

                <?php if (comments_open() || get_comments_number()) : ?>
                    <div class="page-comments">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</section>

<style>
.page-content {
    background: #ffffff;
}

.page-article {
    max-width: 800px;
    margin: 0 auto;
}

.page-header {
    margin-bottom: 4rem;
}

.page-title {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 2rem;
    color: #2d3748;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-excerpt {
    font-size: 1.25rem;
    color: #718096;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}

.page-featured-image {
    margin-bottom: 3rem;
    text-align: center;
}

.featured-image {
    border-radius: 16px;
    box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
    max-width: 100%;
    height: auto;
}

.page-text {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #4a5568;
}

.page-text h2,
.page-text h3,
.page-text h4,
.page-text h5,
.page-text h6 {
    color: #2d3748;
    margin-top: 3rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.page-text h2 {
    font-size: 2rem;
}

.page-text h3 {
    font-size: 1.5rem;
}

.page-text p {
    margin-bottom: 1.5rem;
}

.page-text ul,
.page-text ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.page-text li {
    margin-bottom: 0.5rem;
}

.page-text blockquote {
    border-left: 4px solid #667eea;
    padding-left: 2rem;
    margin: 2rem 0;
    font-style: italic;
    font-size: 1.25rem;
    color: #718096;
}

.page-text img {
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 2rem 0;
}

.page-links {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.page-links a {
    padding: 0.5rem 1rem;
    background: #f7fafc;
    border-radius: 4px;
    color: #667eea;
    text-decoration: none;
    transition: all 0.3s ease;
}

.page-links a:hover {
    background: #667eea;
    color: white;
}

.page-comments {
    margin-top: 4rem;
    padding-top: 3rem;
    border-top: 1px solid #e2e8f0;
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2.5rem;
    }
    
    .page-text {
        font-size: 1rem;
    }
    
    .page-header {
        margin-bottom: 3rem;
    }
    
    .page-links {
        flex-wrap: wrap;
    }
}
</style>

<?php get_footer(); ?>