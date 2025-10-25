<?php
/**
 * WooCommerce Template
 * 
 * This template is used for all WooCommerce pages
 */

get_header(); ?>

<main class="site-main woocommerce-page">
    <div class="content-area">
        <?php woocommerce_content(); ?>
    </div>
</main>

<?php get_footer(); ?>