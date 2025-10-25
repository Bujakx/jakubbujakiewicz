<?php
/**
 * Jakub Bujakiewicz Theme Functions
 */

// Theme Setup
function jakubbujakiewicz_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('woocommerce');
    // Disable zoom (lupa effect)
    // add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'jakubbujakiewicz'),
    ));
}
add_action('after_setup_theme', 'jakubbujakiewicz_theme_setup');

// Enqueue styles and scripts
function jakubbujakiewicz_theme_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap', array(), null);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');
    
    // Theme stylesheet
    wp_enqueue_style('jakubbujakiewicz-style', get_stylesheet_uri(), array(), '5.2');
    
    // Theme scripts
    wp_enqueue_script('jakubbujakiewicz-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '5.2', true);
}
add_action('wp_enqueue_scripts', 'jakubbujakiewicz_theme_scripts');

// Remove admin bar margin for clean frontend
function jakubbujakiewicz_remove_admin_bar_margin() {
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'jakubbujakiewicz_remove_admin_bar_margin');

// Add custom logo support with default
function jakubbujakiewicz_custom_logo_setup() {
    $defaults = array(
        'height'      => 50,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'jakubbujakiewicz_custom_logo_setup');

// Widgets
function jakubbujakiewicz_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'jakubbujakiewicz'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'jakubbujakiewicz'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer', 'jakubbujakiewicz'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'jakubbujakiewicz'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'jakubbujakiewicz_widgets_init');

// Excerpt length
function jakubbujakiewicz_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'jakubbujakiewicz_excerpt_length');

// Excerpt more
function jakubbujakiewicz_excerpt_more($more) {
    return '... <a class="read-more" href="' . get_permalink() . '">' . __('Read More', 'jakubbujakiewicz') . '</a>';
}
add_filter('excerpt_more', 'jakubbujakiewicz_excerpt_more');

// WooCommerce product columns
function jakubbujakiewicz_woocommerce_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'jakubbujakiewicz_woocommerce_loop_columns');

// WooCommerce products per page
function jakubbujakiewicz_woocommerce_products_per_page() {
    return 9;
}
add_filter('loop_shop_per_page', 'jakubbujakiewicz_woocommerce_products_per_page');

// Remove WooCommerce default styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// Change WooCommerce button text
add_filter('woocommerce_product_single_add_to_cart_text', function() {
    return 'Dodaj do koszyka';
});

add_filter('woocommerce_product_add_to_cart_text', function() {
    return 'Zobacz więcej';
});

// Remove WooCommerce breadcrumbs (optional)
// remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

// Customize WooCommerce image sizes
function jakubbujakiewicz_woocommerce_image_dimensions() {
    // Single product image
    update_option('woocommerce_single_image_width', 600);
    // Thumbnail image
    update_option('woocommerce_thumbnail_image_width', 300);
    // Gallery thumbnail
    update_option('woocommerce_thumbnail_cropping', 'custom');
}
add_action('after_setup_theme', 'jakubbujakiewicz_woocommerce_image_dimensions');

// Add custom class to body for WooCommerce pages
function jakubbujakiewicz_woocommerce_body_class($classes) {
    if (is_woocommerce()) {
        $classes[] = 'woocommerce-page-custom';
    }
    return $classes;
}
add_filter('body_class', 'jakubbujakiewicz_woocommerce_body_class');

// Change "Out of Stock" text
add_filter('woocommerce_get_availability_text', function($text, $product) {
    if (!$product->is_in_stock()) {
        $text = 'Niedostępny';
    }
    return $text;
}, 10, 2);

// Disable WooCommerce block styles
function jakubbujakiewicz_disable_woocommerce_block_styles() {
    wp_dequeue_style('wc-blocks-style');
}
add_action('wp_enqueue_scripts', 'jakubbujakiewicz_disable_woocommerce_block_styles', 100);

// Hide "Bez kategorii" (Uncategorized) from product pages
function jakubbujakiewicz_hide_uncategorized_in_products($terms, $post_id, $taxonomy) {
    if ($taxonomy === 'product_cat') {
        foreach ($terms as $key => $term) {
            if ($term->slug === 'bez-kategorii' || $term->slug === 'uncategorized') {
                unset($terms[$key]);
            }
        }
    }
    return $terms;
}
add_filter('get_the_terms', 'jakubbujakiewicz_hide_uncategorized_in_products', 10, 3);

// Remove default WooCommerce single product layout
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);

// Add wrapper for grid layout - open before images
function jakubbujakiewicz_product_grid_wrapper_start() {
    echo '<div class="product-main-container">';
}
add_action('woocommerce_before_single_product_summary', 'jakubbujakiewicz_product_grid_wrapper_start', 1);

// Close wrapper after summary
function jakubbujakiewicz_product_grid_wrapper_end() {
    echo '</div><!-- .product-main-container -->';
}
add_action('woocommerce_after_single_product_summary', 'jakubbujakiewicz_product_grid_wrapper_end', 5);

// Add custom product image wrapper
function jakubbujakiewicz_product_image_wrapper_start() {
    echo '<div class="product-image-wrapper">';
}
add_action('woocommerce_before_single_product_summary', 'jakubbujakiewicz_product_image_wrapper_start', 5);

function jakubbujakiewicz_product_image_wrapper_end() {
    echo '</div>';
}
add_action('woocommerce_before_single_product_summary', 'jakubbujakiewicz_product_image_wrapper_end', 25);

// Improve product description formatting
function jakubbujakiewicz_format_product_description($content) {
    if (is_product()) {
        // Add paragraph breaks
        $content = wpautop($content);
        // Make lists more visible
        $content = str_replace('<ul>', '<ul class="product-features-list">', $content);
    }
    return $content;
}
add_filter('the_content', 'jakubbujakiewicz_format_product_description');
add_filter('woocommerce_short_description', 'jakubbujakiewicz_format_product_description');

// Change product category separator
function jakubbujakiewicz_product_category_separator() {
    return ' • ';
}
add_filter('woocommerce_product_categories_widget_args', function($args) {
    $args['separator'] = ' • ';
    return $args;
});

// Improve Add to Cart success message
add_filter('wc_add_to_cart_message_html', function($message) {
    return str_replace('Zobacz koszyk', '🛒 Zobacz koszyk', $message);
});

// Change WooCommerce product base slug to 'uslugi' instead of 'usluga' or Polish characters
add_filter('woocommerce_permalinks', function($permalinks) {
    $permalinks['product_base'] = '/uslugi';
    return $permalinks;
});

// Update cart count via AJAX for dynamic cart icon
add_filter('woocommerce_add_to_cart_fragments', function($fragments) {
    $cart_count = WC()->cart->get_cart_contents_count();
    
    ob_start();
    ?>
    <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon-btn">
        <i class="fas fa-shopping-cart"></i>
        <?php if ($cart_count > 0) : ?>
            <span class="cart-count"><?php echo $cart_count; ?></span>
        <?php endif; ?>
    </a>
    <?php
    $fragments['.cart-icon-btn'] = ob_get_clean();
    
    return $fragments;
});

// Add Product Badge Before Title
function jakubbujakiewicz_product_badge() {
    global $product;
    
    // Check if product is featured or new (created in last 30 days)
    $is_featured = $product->is_featured();
    $post_date = get_the_date('U');
    $current_date = current_time('U');
    $is_new = ($current_date - $post_date) < (30 * 24 * 60 * 60); // 30 days
    
    echo '<div class="product-badges">';
    
    if ($is_featured) {
        echo '<span class="product-badge badge-bestseller">⭐ BESTSELLER</span>';
    }
    
    if ($is_new) {
        echo '<span class="product-badge badge-new">🔥 NOWOŚĆ</span>';
    }
    
    echo '</div>';
}
add_action('woocommerce_single_product_summary', 'jakubbujakiewicz_product_badge', 4);

// Add Trust Badges After Add to Cart Button
function jakubbujakiewicz_trust_badges() {
    ?>
    <div class="product-trust-badges">
        <div class="trust-badge">
            <i class="fas fa-shield-alt"></i>
            <span><strong>Bezpieczna płatność</strong><br>SSL & szyfrowanie</span>
        </div>
        <div class="trust-badge">
            <i class="fas fa-undo"></i>
            <span><strong>14 dni zwrotu</strong><br>Gwarancja zwrotu pieniędzy</span>
        </div>
        <div class="trust-badge">
            <i class="fas fa-headset"></i>
            <span><strong>Wsparcie 24/7</strong><br>Pomoc online</span>
        </div>
    </div>
    <?php
}
add_action('woocommerce_single_product_summary', 'jakubbujakiewicz_trust_badges', 35);

// Add custom inline CSS for cart page with maximum priority
function jakubbujakiewicz_cart_custom_css() {
    if (is_cart()) {
        ?>
        <style type="text/css">
            /* CART PAGE CUSTOM STYLES - MAXIMUM PRIORITY */
            
            /* Add custom cart header */
            body.woocommerce-cart .woocommerce:before {
                content: '🛒 KOSZYK' !important;
                display: block !important;
                text-align: center !important;
                font-family: 'Poppins', sans-serif !important;
                font-size: 56px !important;
                font-weight: 900 !important;
                color: #ffffff !important;
                text-transform: uppercase !important;
                letter-spacing: 4px !important;
                margin-bottom: 40px !important;
                text-shadow: 0 0 40px rgba(14, 209, 69, 0.6), 0 0 80px rgba(14, 209, 69, 0.3) !important;
                animation: titleGlow 3s ease-in-out infinite !important;
                padding: 20px 20px 10px !important;
            }
            
            @keyframes titleGlow {
                0%, 100% {
                    text-shadow: 0 0 40px rgba(14, 209, 69, 0.6), 0 0 80px rgba(14, 209, 69, 0.3);
                }
                50% {
                    text-shadow: 0 0 60px rgba(14, 209, 69, 0.8), 0 0 120px rgba(14, 209, 69, 0.5);
                }
            }
            
            /* Cart page wrapper */
            body.woocommerce-cart .woocommerce {
                max-width: 1400px !important;
                margin: 0 auto !important;
                padding: 20px !important;
            }
            
            body.woocommerce-cart table.shop_table,
            .woocommerce-cart table.shop_table,
            table.shop_table.cart,
            table.shop_table {
                background: rgba(20, 25, 48, 0.7) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 20px !important;
                border-collapse: separate !important;
                border-spacing: 0 !important;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 60px rgba(14, 209, 69, 0.1) !important;
            }
            
            body.woocommerce-cart table.shop_table thead,
            table.shop_table thead {
                background: linear-gradient(135deg, rgba(14, 209, 69, 0.15) 0%, rgba(14, 209, 69, 0.25) 100%) !important;
                border-bottom: 3px solid rgba(14, 209, 69, 0.5) !important;
            }
            
            body.woocommerce-cart table.shop_table th,
            table.shop_table th {
                color: #ffffff !important;
                font-family: 'Poppins', sans-serif !important;
                font-weight: 800 !important;
                font-size: 13px !important;
                padding: 20px !important;
                border-bottom: 2px solid rgba(14, 209, 69, 0.2) !important;
                background: transparent !important;
                text-transform: uppercase !important;
                letter-spacing: 1.5px !important;
                text-shadow: 0 2px 10px rgba(14, 209, 69, 0.3) !important;
            }
            
            body.woocommerce-cart table.shop_table td,
            table.shop_table td {
                color: rgba(255, 255, 255, 0.95) !important;
                padding: 25px 20px !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
                background: transparent !important;
                font-size: 15px !important;
            }
            
            body.woocommerce-cart table.shop_table tbody tr,
            table.shop_table tbody tr {
                transition: all 0.3s ease !important;
                background: transparent !important;
            }
            
            body.woocommerce-cart table.shop_table tbody tr:hover,
            table.shop_table tbody tr:hover {
                background: rgba(14, 209, 69, 0.08) !important;
                transform: scale(1.01) !important;
            }
            
            /* Product thumbnail with glow */
            table.shop_table td.product-thumbnail img {
                border-radius: 12px !important;
                border: 2px solid rgba(14, 209, 69, 0.4) !important;
                transition: all 0.3s ease !important;
                box-shadow: 0 0 20px rgba(14, 209, 69, 0.2) !important;
            }
            
            table.shop_table td.product-thumbnail img:hover {
                border-color: rgba(14, 209, 69, 0.8) !important;
                box-shadow: 0 0 30px rgba(14, 209, 69, 0.5) !important;
                transform: scale(1.05) !important;
            }
            
            /* Product name link */
            table.shop_table td.product-name a {
                color: #ffffff !important;
                font-weight: 600 !important;
                font-size: 16px !important;
                transition: all 0.3s ease !important;
            }
            
            table.shop_table td.product-name a:hover {
                color: #0ed145 !important;
                text-shadow: 0 0 15px rgba(14, 209, 69, 0.6) !important;
            }
            
            /* Price with glow */
            table.shop_table td.product-price,
            table.shop_table td.product-subtotal {
                color: #0ed145 !important;
                font-weight: 800 !important;
                font-size: 20px !important;
                text-shadow: 0 0 15px rgba(14, 209, 69, 0.4) !important;
            }
            
            /* Quantity input - futuristic design */
            table.shop_table .quantity {
                background: rgba(14, 209, 69, 0.1) !important;
                border: 2px solid rgba(14, 209, 69, 0.4) !important;
                border-radius: 12px !important;
                box-shadow: 0 0 15px rgba(14, 209, 69, 0.2) !important;
                transition: all 0.3s ease !important;
            }
            
            table.shop_table .quantity:hover {
                border-color: rgba(14, 209, 69, 0.7) !important;
                box-shadow: 0 0 25px rgba(14, 209, 69, 0.4) !important;
            }
            
            table.shop_table .quantity input.qty {
                background: transparent !important;
                border: none !important;
                color: #ffffff !important;
                font-weight: 700 !important;
                font-size: 16px !important;
            }
            
            /* Remove button - danger style with animation */
            table.shop_table td.product-remove a {
                background: rgba(255, 59, 48, 0.15) !important;
                border: 2px solid rgba(255, 59, 48, 0.5) !important;
                color: #ff3b30 !important;
                border-radius: 12px !important;
                padding: 10px 14px !important;
                transition: all 0.3s ease !important;
                font-weight: 700 !important;
                display: inline-block !important;
            }
            
            table.shop_table td.product-remove a:hover {
                background: rgba(255, 59, 48, 0.3) !important;
                border-color: rgba(255, 59, 48, 0.8) !important;
                transform: rotate(90deg) scale(1.1) !important;
                box-shadow: 0 0 20px rgba(255, 59, 48, 0.5) !important;
            }
            
            /* Coupon section styling */
            table.shop_table .coupon {
                display: flex !important;
                gap: 10px !important;
                flex-wrap: wrap !important;
                align-items: center !important;
                margin-bottom: 15px !important;
            }
            
            table.shop_table .coupon label {
                color: rgba(255, 255, 255, 0.9) !important;
                font-weight: 600 !important;
                width: 100% !important;
                margin-bottom: 10px !important;
            }
            
            table.shop_table .coupon input[type="text"] {
                background: rgba(255, 255, 255, 0.05) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 12px !important;
                color: #ffffff !important;
                padding: 14px 18px !important;
                font-size: 15px !important;
                min-width: 200px !important;
                flex: 1 !important;
                transition: all 0.3s ease !important;
            }
            
            table.shop_table .coupon input[type="text"]:focus {
                background: rgba(255, 255, 255, 0.08) !important;
                border-color: rgba(14, 209, 69, 0.7) !important;
                outline: none !important;
                box-shadow: 0 0 20px rgba(14, 209, 69, 0.3) !important;
            }
            
            table.shop_table .coupon input[type="text"]::placeholder {
                color: rgba(255, 255, 255, 0.4) !important;
            }
            
            table.shop_table .coupon button[name="apply_coupon"] {
                background: rgba(14, 209, 69, 0.15) !important;
                border: 2px solid rgba(14, 209, 69, 0.4) !important;
                color: #0ed145 !important;
                padding: 14px 28px !important;
                border-radius: 12px !important;
                font-weight: 700 !important;
                font-size: 15px !important;
                text-transform: uppercase !important;
                cursor: pointer !important;
                transition: all 0.3s ease !important;
                letter-spacing: 0.5px !important;
            }
            
            table.shop_table .coupon button[name="apply_coupon"]:hover {
                background: rgba(14, 209, 69, 0.3) !important;
                border-color: rgba(14, 209, 69, 0.7) !important;
                color: #ffffff !important;
                box-shadow: 0 0 25px rgba(14, 209, 69, 0.4) !important;
                transform: translateY(-2px) !important;
            }
            
            /* Update cart button */
            table.shop_table button[name="update_cart"] {
                background: linear-gradient(135deg, #0ed145 0%, #09a033 100%) !important;
                color: #000000 !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                padding: 14px 30px !important;
                border-radius: 12px !important;
                font-weight: 700 !important;
                font-size: 15px !important;
                text-transform: uppercase !important;
                cursor: pointer !important;
                transition: all 0.3s ease !important;
                letter-spacing: 0.5px !important;
            }
            
            table.shop_table button[name="update_cart"]:hover {
                transform: translateY(-3px) !important;
                box-shadow: 0 8px 25px rgba(14, 209, 69, 0.4) !important;
            }
            
            table.shop_table button[name="update_cart"]:disabled {
                opacity: 0.5 !important;
                cursor: not-allowed !important;
            }
            
            /* Actions row styling */
            table.shop_table td.actions {
                background: rgba(14, 209, 69, 0.05) !important;
                border-top: 2px solid rgba(14, 209, 69, 0.2) !important;
                padding: 25px !important;
            }
            
            /* Cart totals - premium box */
            .cart-collaterals .cart_totals {
                background: linear-gradient(135deg, rgba(20, 25, 48, 0.9) 0%, rgba(10, 15, 30, 0.9) 100%) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 24px !important;
                padding: 40px !important;
                position: relative !important;
                overflow: hidden !important;
                box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5), 0 0 80px rgba(14, 209, 69, 0.15) !important;
            }
            
            /* Animated background for cart totals */
            .cart-collaterals .cart_totals::before {
                content: '' !important;
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                background: linear-gradient(135deg, rgba(14, 209, 69, 0.05) 0%, rgba(14, 209, 69, 0.15) 50%, rgba(14, 209, 69, 0.05) 100%) !important;
                background-size: 200% 200% !important;
                animation: gradientShift 3s ease infinite !important;
                z-index: 0 !important;
                pointer-events: none !important;
            }
            
            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            .cart_totals > * {
                position: relative !important;
                z-index: 1 !important;
            }
            
            .cart_totals h2 {
                color: #ffffff !important;
                border-bottom: 3px solid rgba(14, 209, 69, 0.4) !important;
                padding-bottom: 20px !important;
                margin-bottom: 25px !important;
                font-size: 26px !important;
                font-weight: 800 !important;
                text-transform: uppercase !important;
                letter-spacing: 2px !important;
                text-shadow: 0 0 20px rgba(14, 209, 69, 0.4) !important;
            }
            
            .cart_totals .order-total th,
            .cart_totals .order-total td {
                color: #0ed145 !important;
                font-size: 28px !important;
                font-weight: 900 !important;
                text-shadow: 0 0 25px rgba(14, 209, 69, 0.6) !important;
                padding-top: 20px !important;
                border-top: 2px solid rgba(14, 209, 69, 0.3) !important;
            }
            
            /* Checkout button - ULTIMATE DESIGN */
            .wc-proceed-to-checkout {
                margin-top: 25px !important;
                padding-top: 25px !important;
                border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
            }
            
            .wc-proceed-to-checkout a.checkout-button,
            .wc-proceed-to-checkout .button {
                display: block !important;
                position: relative !important;
                background: linear-gradient(135deg, #0ed145 0%, #09a033 100%) !important;
                color: #000000 !important;
                padding: 22px 40px !important;
                border-radius: 16px !important;
                font-weight: 800 !important;
                font-size: 18px !important;
                text-align: center !important;
                text-decoration: none !important;
                text-transform: uppercase !important;
                letter-spacing: 1.5px !important;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
                box-shadow: 0 8px 30px rgba(14, 209, 69, 0.4), 0 0 60px rgba(14, 209, 69, 0.2) !important;
                overflow: visible !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
            }
            
            .wc-proceed-to-checkout a.checkout-button:hover,
            .wc-proceed-to-checkout .button:hover {
                transform: translateY(-5px) scale(1.02) !important;
                box-shadow: 0 12px 40px rgba(14, 209, 69, 0.6), 0 0 80px rgba(14, 209, 69, 0.4) !important;
                background: linear-gradient(135deg, #2ef95d 0%, #0ed145 100%) !important;
                border-color: rgba(14, 209, 69, 0.6) !important;
            }
            
            .wc-proceed-to-checkout a.checkout-button:active,
            .wc-proceed-to-checkout .button:active {
                transform: translateY(-2px) scale(0.98) !important;
            }
            
            /* RESPONSIVE DESIGN FOR CART */
            @media (max-width: 768px) {
                /* Mobile cart header */
                body.woocommerce-cart .woocommerce:before {
                    font-size: 36px !important;
                    padding: 10px 10px 5px !important;
                    margin-bottom: 25px !important;
                    letter-spacing: 2px !important;
                }
                
                /* Stack table on mobile */
                body.woocommerce-cart table.shop_table,
                table.shop_table.cart {
                    border-radius: 15px !important;
                }
                
                body.woocommerce-cart table.shop_table thead {
                    display: none !important;
                }
                
                body.woocommerce-cart table.shop_table tbody tr,
                table.shop_table tbody tr {
                    display: block !important;
                    margin-bottom: 20px !important;
                    border: 2px solid rgba(14, 209, 69, 0.3) !important;
                    border-radius: 15px !important;
                    padding: 15px !important;
                }
                
                body.woocommerce-cart table.shop_table td,
                table.shop_table td {
                    display: block !important;
                    text-align: left !important;
                    padding: 10px !important;
                    border: none !important;
                }
                
                table.shop_table td:before {
                    content: attr(data-title) !important;
                    font-weight: 700 !important;
                    color: #0ed145 !important;
                    display: block !important;
                    margin-bottom: 5px !important;
                    font-size: 12px !important;
                    text-transform: uppercase !important;
                }
                
                table.shop_table td.product-thumbnail {
                    text-align: center !important;
                    padding: 15px !important;
                }
                
                table.shop_table td.product-thumbnail img {
                    max-width: 120px !important;
                    margin: 0 auto !important;
                }
                
                table.shop_table td.product-remove {
                    text-align: center !important;
                }
                
                /* Cart totals on mobile */
                .cart-collaterals .cart_totals {
                    padding: 25px !important;
                    margin-top: 30px !important;
                }
                
                .cart_totals h2 {
                    font-size: 20px !important;
                }
                
                .cart_totals .order-total th,
                .cart_totals .order-total td {
                    font-size: 22px !important;
                }
                
                .wc-proceed-to-checkout a.checkout-button,
                .wc-proceed-to-checkout .button {
                    padding: 18px 30px !important;
                    font-size: 16px !important;
                }
            }
            
            @media (max-width: 480px) {
                body.woocommerce-cart .woocommerce:before {
                    font-size: 28px !important;
                    letter-spacing: 1px !important;
                }
                
                table.shop_table td.product-thumbnail img {
                    max-width: 100px !important;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'jakubbujakiewicz_cart_custom_css', 999);

// Add custom CSS for checkout page
function jakubbujakiewicz_checkout_custom_css() {
    if (is_checkout()) {
        ?>
        <style type="text/css">
            /* CHECKOUT PAGE CUSTOM STYLES */
            
            /* Checkout header */
            body.woocommerce-checkout .woocommerce:before {
                content: '💳 ZAMÓWIENIE' !important;
                display: block !important;
                text-align: center !important;
                font-family: 'Poppins', sans-serif !important;
                font-size: 56px !important;
                font-weight: 900 !important;
                color: #ffffff !important;
                text-transform: uppercase !important;
                letter-spacing: 4px !important;
                margin-bottom: 40px !important;
                text-shadow: 0 0 40px rgba(14, 209, 69, 0.6), 0 0 80px rgba(14, 209, 69, 0.3) !important;
                animation: titleGlow 3s ease-in-out infinite !important;
                padding: 20px 20px 10px !important;
            }
            
            @keyframes titleGlow {
                0%, 100% {
                    text-shadow: 0 0 40px rgba(14, 209, 69, 0.6), 0 0 80px rgba(14, 209, 69, 0.3);
                }
                50% {
                    text-shadow: 0 0 60px rgba(14, 209, 69, 0.8), 0 0 120px rgba(14, 209, 69, 0.5);
                }
            }
            
            body.woocommerce-checkout .woocommerce {
                max-width: 1400px !important;
                margin: 0 auto !important;
                padding: 20px !important;
            }
            
            /* Checkout form styling */
            .woocommerce-checkout .col2-set,
            .woocommerce-checkout #order_review_heading,
            .woocommerce-checkout #order_review {
                background: rgba(20, 25, 48, 0.7) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 20px !important;
                padding: 30px !important;
                margin-bottom: 30px !important;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5), 0 0 60px rgba(14, 209, 69, 0.1) !important;
            }
            
            .woocommerce-checkout h3 {
                color: #ffffff !important;
                font-size: 24px !important;
                font-weight: 800 !important;
                text-transform: uppercase !important;
                letter-spacing: 2px !important;
                margin-bottom: 25px !important;
                padding-bottom: 15px !important;
                border-bottom: 2px solid rgba(14, 209, 69, 0.3) !important;
                text-shadow: 0 0 20px rgba(14, 209, 69, 0.4) !important;
            }
            
            /* Form fields */
            .woocommerce-checkout .form-row label {
                color: rgba(255, 255, 255, 0.9) !important;
                font-weight: 600 !important;
                margin-bottom: 8px !important;
                font-size: 14px !important;
            }
            
            .woocommerce-checkout .form-row input.input-text,
            .woocommerce-checkout .form-row textarea,
            .woocommerce-checkout .form-row select {
                background: rgba(255, 255, 255, 0.05) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 12px !important;
                color: #ffffff !important;
                padding: 14px 18px !important;
                font-size: 15px !important;
                transition: all 0.3s ease !important;
            }
            
            .woocommerce-checkout .form-row input.input-text:focus,
            .woocommerce-checkout .form-row textarea:focus,
            .woocommerce-checkout .form-row select:focus {
                background: rgba(255, 255, 255, 0.08) !important;
                border-color: rgba(14, 209, 69, 0.7) !important;
                outline: none !important;
                box-shadow: 0 0 20px rgba(14, 209, 69, 0.3) !important;
            }
            
            /* Order review table */
            .woocommerce-checkout-review-order-table {
                background: transparent !important;
                border: none !important;
            }
            
            .woocommerce-checkout-review-order-table thead {
                background: linear-gradient(135deg, rgba(14, 209, 69, 0.15) 0%, rgba(14, 209, 69, 0.25) 100%) !important;
                border-bottom: 3px solid rgba(14, 209, 69, 0.5) !important;
            }
            
            .woocommerce-checkout-review-order-table th {
                color: #ffffff !important;
                font-weight: 800 !important;
                padding: 15px !important;
                text-transform: uppercase !important;
                font-size: 13px !important;
                letter-spacing: 1.5px !important;
            }
            
            .woocommerce-checkout-review-order-table td {
                color: rgba(255, 255, 255, 0.9) !important;
                padding: 15px !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            }
            
            .woocommerce-checkout-review-order-table .product-name {
                font-weight: 600 !important;
            }
            
            .woocommerce-checkout-review-order-table .product-total {
                color: #0ed145 !important;
                font-weight: 700 !important;
                text-shadow: 0 0 15px rgba(14, 209, 69, 0.4) !important;
            }
            
            .woocommerce-checkout-review-order-table .order-total th,
            .woocommerce-checkout-review-order-table .order-total td {
                color: #0ed145 !important;
                font-size: 24px !important;
                font-weight: 900 !important;
                text-shadow: 0 0 25px rgba(14, 209, 69, 0.6) !important;
                border-top: 2px solid rgba(14, 209, 69, 0.3) !important;
                padding-top: 20px !important;
            }
            
            /* Payment methods */
            .woocommerce-checkout #payment {
                background: rgba(20, 25, 48, 0.7) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 20px !important;
                padding: 25px !important;
            }
            
            .woocommerce-checkout #payment .payment_methods {
                border: none !important;
            }
            
            .woocommerce-checkout #payment .payment_method_label {
                color: #ffffff !important;
                font-weight: 600 !important;
            }
            
            .woocommerce-checkout #payment .payment_box {
                background: rgba(14, 209, 69, 0.1) !important;
                border: 1px solid rgba(14, 209, 69, 0.3) !important;
                border-radius: 12px !important;
                color: rgba(255, 255, 255, 0.9) !important;
            }
            
            /* Place order button */
            .woocommerce-checkout #place_order {
                display: block !important;
                width: 100% !important;
                background: linear-gradient(135deg, #0ed145 0%, #09a033 100%) !important;
                color: #000000 !important;
                padding: 22px 40px !important;
                border-radius: 16px !important;
                font-weight: 800 !important;
                font-size: 18px !important;
                text-align: center !important;
                text-transform: uppercase !important;
                letter-spacing: 1.5px !important;
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
                box-shadow: 0 8px 30px rgba(14, 209, 69, 0.4), 0 0 60px rgba(14, 209, 69, 0.2) !important;
                border: 2px solid rgba(14, 209, 69, 0.3) !important;
                cursor: pointer !important;
            }
            
            .woocommerce-checkout #place_order:hover {
                transform: translateY(-5px) scale(1.02) !important;
                box-shadow: 0 12px 40px rgba(14, 209, 69, 0.6), 0 0 80px rgba(14, 209, 69, 0.4) !important;
                background: linear-gradient(135deg, #2ef95d 0%, #0ed145 100%) !important;
            }
            
            /* RESPONSIVE CHECKOUT */
            @media (max-width: 768px) {
                body.woocommerce-checkout .woocommerce:before {
                    font-size: 36px !important;
                    padding: 10px 10px 5px !important;
                    margin-bottom: 25px !important;
                    letter-spacing: 2px !important;
                }
                
                .woocommerce-checkout .col2-set,
                .woocommerce-checkout #order_review {
                    padding: 20px !important;
                }
                
                .woocommerce-checkout h3 {
                    font-size: 20px !important;
                }
                
                .woocommerce-checkout #place_order {
                    padding: 18px 30px !important;
                    font-size: 16px !important;
                }
            }
            
            @media (max-width: 480px) {
                body.woocommerce-checkout .woocommerce:before {
                    font-size: 28px !important;
                    letter-spacing: 1px !important;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'jakubbujakiewicz_checkout_custom_css', 999);
