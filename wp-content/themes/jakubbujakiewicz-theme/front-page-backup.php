<?php
/**
 * Front Page Template
 * 
 * This displays the main landing page content
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
        </div>
    </div>
</section>

<p style="color: white; text-align: center; padding: 50px; font-size: 24px;">
    🚧 Strona w budowie - wkrótce pełna wersja! 🚧
</p>

<?php get_footer(); ?>