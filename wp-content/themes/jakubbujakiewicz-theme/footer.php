<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <div class="footer-copyright">
                <p>&copy; <?php echo date('Y'); ?> <strong><?php bloginfo('name'); ?></strong>. <?php _e('All rights reserved.', 'jakubbujakiewicz'); ?></p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>