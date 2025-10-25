<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-content-modern">
            <!-- Footer Top Section -->
            <div class="footer-top-modern">
                <!-- Logo & Description -->
                <div class="footer-brand-modern">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h3><?php bloginfo('name'); ?></h3>
                    <?php endif; ?>
                    <p class="footer-tagline">Osiągnij swoje cele treningowe z profesjonalnym wsparciem. Indywidualne plany treningowe i dietetyczne dopasowane do Twoich potrzeb.</p>
                    <div class="footer-social-modern">
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
                
                <!-- Quick Links -->
                <div class="footer-links-modern">
                    <div class="footer-links-col">
                        <h4>Nawigacja</h4>
                        <ul>
                            <li><a href="<?php echo home_url('/#home'); ?>"><i class="fas fa-chevron-right"></i> Start</a></li>
                            <li><a href="<?php echo home_url('/#about'); ?>"><i class="fas fa-chevron-right"></i> O mnie</a></li>
                            <li><a href="<?php echo home_url('/#services'); ?>"><i class="fas fa-chevron-right"></i> Usługi</a></li>
                            <li><a href="<?php echo home_url('/#testimonials'); ?>"><i class="fas fa-chevron-right"></i> Opinie</a></li>
                            <li><a href="<?php echo home_url('/#contact'); ?>"><i class="fas fa-chevron-right"></i> Kontakt</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-links-col">
                        <h4>Usługi</h4>
                        <ul>
                            <li><a href="<?php echo home_url('/uslugi/dieta-dopasowana-do-twoich-celow/'); ?>"><i class="fas fa-apple-alt"></i> Plan Dietetyczny</a></li>
                            <li><a href="<?php echo home_url('/uslugi/indywidualny-plan-treningowy/'); ?>"><i class="fas fa-dumbbell"></i> Plan Treningowy</a></li>
                            <li><a href="<?php echo home_url('/uslugi/prowadzenie-online/'); ?>"><i class="fas fa-chart-line"></i> Prowadzenie Online</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-links-col">
                        <h4>Kontakt</h4>
                        <ul>
                            <li><a href="mailto:jakubbujakiewicz@gmail.com"><i class="fas fa-envelope"></i> Email</a></li>
                            <li><a href="https://www.facebook.com/profile.php?id=61570839081946" target="_blank"><i class="fab fa-facebook-messenger"></i> Messenger</a></li>
                            <li><a href="https://www.instagram.com/bujakx_/" target="_blank"><i class="fab fa-instagram"></i> @bujakx_</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom -->
            <div class="footer-bottom-modern">
                <div class="footer-bottom-left">
                    <p>&copy; <?php echo date('Y'); ?> <strong><?php bloginfo('name'); ?></strong>. Wszystkie prawa zastrzeżone.</p>
                </div>
                <div class="footer-bottom-right">
                    <a href="<?php echo home_url('/regulamin.html'); ?>">Regulamin</a>
                    <span class="footer-separator">•</span>
                    <a href="<?php echo home_url('/polityka-prywatnosci.html'); ?>">Polityka prywatności</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button class="scroll-top" id="scrollTop">
    <i class="fas fa-arrow-up"></i>
</button>

<!-- Facebook Messenger Floating Button -->
<a href="https://www.facebook.com/profile.php?id=61570839081946" 
   class="whatsapp-float" 
   target="_blank"
   aria-label="Skontaktuj się przez Facebook">
    <i class="fab fa-facebook-messenger"></i>
    <span class="whatsapp-tooltip">Napisz na Facebooku!</span>
</a>

<?php wp_footer(); ?>
</body>
</html>