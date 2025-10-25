<?php
/**
 * Template Name: Shop Page
 * Description: Custom shop page template
 */

get_header();
?>

<main class="site-main shop-page">
    <div class="container">
        <header class="page-header" style="text-align: center; padding: 60px 20px 40px; margin-bottom: 40px;">
            <h1 class="page-title" style="font-family: 'Poppins', sans-serif; font-size: 48px; font-weight: 800; color: #ffffff; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px;">
                Sklep
            </h1>
            <p style="color: rgba(255, 255, 255, 0.7); font-size: 18px; max-width: 600px; margin: 0 auto;">
                Wybierz idealne rozwiązanie dla siebie i rozpocznij swoją transformację
            </p>
        </header>

        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin-bottom: 60px;">
            <?php
            // Get WooCommerce products
            if (class_exists('WooCommerce')) {
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1, // All products
                    'orderby' => 'menu_order',
                    'order' => 'ASC'
                );
                
                $products = new WP_Query($args);
                
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        global $product;
                        
                        $is_featured = $product->is_featured();
                        $card_class = $is_featured ? 'service-card featured' : 'service-card';
                        ?>
                        
                        <div class="<?php echo esc_attr($card_class); ?>">
                            <?php if ($is_featured) : ?>
                                <div class="popular-badge">Najczęściej wybierane</div>
                            <?php endif; ?>
                            
                            <div class="service-icon">
                                <?php
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
                                Zobacz szczegóły
                                <i class="fas fa-arrow-right"></i>
                            </a>
                            
                            <div class="card-glow"></div>
                        </div>
                        
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div style="grid-column: 1/-1; text-align: center; padding: 60px 20px;">
                        <i class="fas fa-shopping-cart" style="font-size: 64px; color: var(--primary); margin-bottom: 20px;"></i>
                        <h3 style="color: #ffffff; margin-bottom: 15px;">Brak produktów</h3>
                        <p style="color: rgba(255, 255, 255, 0.7);">Wkrótce pojawią się nowe usługi!</p>
                    </div>
                    <?php
                endif;
            }
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
