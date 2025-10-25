<?php
/**
 * Front Page Template with WooCommerce Products
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-background">
        <div class="gradient-overlay"></div>
        <div class="animated-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </div>
    
    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <span class="hero-badge">
                    <i class="fas fa-star"></i>
                    Certyfikowany Trener Personalny
                </span>
                <h1 class="hero-title hero-title-responsive">
                    Twoja<br>
                    <span class="gradient-text">transformacja</span><br>
                    zaczyna się<br>
                    <span class="gradient-text">teraz</span>
                </h1>
                <p class="hero-description">
                    Indywidualne plany treningowe i dietetyczne dostosowane do Twoich celów. 
                    Prowadzenie online z pełnym wsparciem - niezależnie od tego, gdzie jesteś.
                </p>
                
                <div class="hero-features">
                    <div class="feature-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Plany dopasowane do Ciebie</span>
                    </div>
                    <div class="feature-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Stały kontakt i wsparcie</span>
                    </div>
                    <div class="feature-badge">
                        <i class="fas fa-check-circle"></i>
                        <span>Elastyczne godziny online</span>
                    </div>
                </div>
                <div class="hero-buttons">
                    <a href="#services" class="btn-hero-primary">
                        <span>Sprawdź usługi</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#contact" class="btn-hero-secondary">
                        <i class="fas fa-comment-dots"></i>
                        <span>Skontaktuj się</span>
                    </a>
                </div>
            </div>
            
            <div class="hero-image" data-aos="fade-left">
                <div class="image-wrapper">
                    <div class="floating-card card-1">
                        <i class="fas fa-dumbbell"></i>
                        <span>Plany online</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-apple-alt"></i>
                        <span>Dieta indywidualna</span>
                    </div>
                    <div class="floating-card card-3">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Wsparcie 24/7</span>
                    </div>
                    <div class="hero-img-placeholder">
                        <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=600&h=800&fit=crop" alt="Trening personalny - Jakub Bujakiewicz" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="scroll-indicator">
        <span>Scroll</span>
        <div class="mouse">
            <div class="wheel"></div>
        </div>
    </div>
</section>

<!-- Services Section with WooCommerce Products -->
<section class="services" id="services">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Co oferuję?</span>
            <h2 class="section-title">
                Moje <span class="gradient-text">usługi</span>
            </h2>
            <p class="section-description">
                Wybierz pakiet dopasowany do Twoich celów i zacznij transformację już dziś
            </p>
        </div>
        
        <div class="services-grid">
            <?php
            // Get WooCommerce products
            if (class_exists('WooCommerce')) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 3,
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    $delay = 100;
                    while ($products->have_posts()) : $products->the_post();
                        global $product;
                        
                        // Determine if product is featured
                        $is_featured = $product->is_featured();
                        $card_class = $is_featured ? 'service-card featured' : 'service-card';
                        ?>
                        
                        <div class="<?php echo esc_attr($card_class); ?>" data-aos="fade-up" data-aos-delay="<?php echo $delay; ?>">
                            <?php if ($is_featured) : ?>
                                <div class="popular-badge">Najczęściej wybierane</div>
                            <?php endif; ?>
                            
                            <div class="service-icon">
                                <?php
                                // Icon based on product name
                                if (stripos(get_the_title(), 'dieta') !== false || stripos(get_the_title(), 'dietetyczny') !== false) {
                                    echo '<i class="fas fa-apple-alt"></i>';
                                } elseif (stripos(get_the_title(), 'online') !== false || stripos(get_the_title(), 'prowadzenie') !== false) {
                                    echo '<i class="fas fa-chart-line"></i>';
                                } else {
                                    echo '<i class="fas fa-dumbbell"></i>';
                                }
                                ?>
                            </div>
                            
                            <h3><?php the_title(); ?></h3>
                            
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                            
                            <ul class="service-features">
                                <?php
                                // Get product short description and extract features
                                $description = get_the_excerpt();
                                ?>
                                <li><i class="fas fa-check"></i> <?php echo wp_trim_words($description, 8); ?></li>
                                <li><i class="fas fa-check"></i> Indywidualne podejście</li>
                                <li><i class="fas fa-check"></i> Stałe wsparcie</li>
                                <li><i class="fas fa-check"></i> Gwarancja efektów</li>
                            </ul>
                            
                            <div class="service-price">
                                <?php if ($product->is_on_sale()) : ?>
                                    <span class="price-old"><?php echo wc_price($product->get_regular_price()); ?></span>
                                <?php endif; ?>
                                <span class="price"><?php echo $product->get_price_html(); ?></span>
                            </div>
                            
                            <a href="<?php echo get_permalink(); ?>" class="btn-service">
                                Zamów teraz
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            
                            <div class="card-glow"></div>
                        </div>
                        
                        <?php
                        $delay += 100;
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p style="color: white; text-align: center;">Brak dostępnych produktów.</p>';
                endif;
            } else {
                echo '<p style="color: white; text-align: center;">WooCommerce nie jest aktywny.</p>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Blog/Wiedza Section -->
<section class="blog" id="blog">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">Wiedza</span>
            <h2 class="section-title">
                Najnowsze <span class="gradient-text">wpisy</span>
            </h2>
            <p class="section-description">
                Praktyczne wskazówki i porady treningowe
            </p>
        </div>
        
        <div class="posts-grid">
            <?php
            // Get latest blog posts
            $blog_args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            );
            
            $blog_posts = new WP_Query($blog_args);
            
            if ($blog_posts->have_posts()) :
                while ($blog_posts->have_posts()) : $blog_posts->the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="entry-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <header class="entry-header">
                            <h3 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <div class="entry-meta">
                                <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                <span><i class="far fa-folder"></i> <?php the_category(', '); ?></span>
                            </div>
                        </header>
                        
                        <div class="entry-summary">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </div>
                        
                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                Czytaj więcej
                            </a>
                        </footer>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div style="grid-column: 1/-1; text-align: center; color: var(--text-gray); padding: 40px;">
                    <i class="fas fa-book" style="font-size: 48px; color: var(--primary); margin-bottom: 20px;"></i>
                    <p>Wkrótce pojawią się tu wartościowe artykuły o treningach i diecie!</p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <?php if ($blog_posts->found_posts > 0) : ?>
            <div class="blog-cta" data-aos="fade-up" style="text-align: center; margin-top: 50px;">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn-secondary">
                    Zobacz wszystkie artykuły
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
