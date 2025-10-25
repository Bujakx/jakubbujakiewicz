<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FLKWFT9GKW"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-FLKWFT9GKW');
    </script>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="author" content="Jakub Bujakiewicz">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#0ed145">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Navigation -->
<nav class="navbar" id="navbar">
    <div class="container">
        <div class="nav-wrapper">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>" class="logo-image">
            </a>
            
            <div class="nav-menu" id="navMenu">
                <ul class="nav-links">
                    <li><a href="<?php echo esc_url(home_url('/#home')); ?>" class="nav-link">Start</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#about')); ?>" class="nav-link">O mnie</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#services')); ?>" class="nav-link">Usługi</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#blog')); ?>" class="nav-link">Blog</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#testimonials')); ?>" class="nav-link">Opinie</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#faq')); ?>" class="nav-link">FAQ</a></li>
                    <li><a href="<?php echo esc_url(home_url('/#contact')); ?>" class="nav-link">Kontakt</a></li>
                </ul>
                <div class="nav-buttons">
                    <a href="<?php echo esc_url(home_url('/#services')); ?>" class="btn-primary">
                        <i class="fas fa-rocket"></i> Rozpocznij teraz
                    </a>
                    <a href="<?php echo wp_login_url(); ?>" class="btn-login">
                        <i class="fas fa-user"></i> Zaloguj się
                    </a>
                    <?php if (class_exists('WooCommerce')) : ?>
                        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon-btn">
                            <i class="fas fa-shopping-cart"></i>
                            <?php 
                            $cart_count = WC()->cart->get_cart_contents_count();
                            if ($cart_count > 0) : 
                            ?>
                                <span class="cart-count"><?php echo $cart_count; ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="mobile-social-links">
                    <a href="https://www.facebook.com/profile.php?id=61570839081946" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://www.instagram.com/bujakx_/" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@trenerbujak" target="_blank" aria-label="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
            
            <button class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>