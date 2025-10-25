// ===================================
// MODERN FITNESS WEBSITE - MAIN.JS
// Ultra-modern interactions & animations
// ===================================

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all features
    initNavigation();
    initScrollEffects();
    initCounters();
    initContactForm();
    loadBlogPosts();
    initMobileMenu();
    initSimpleAnimations();
});

// ===== NAVIGATION =====
function initNavigation() {
    const navbar = document.getElementById('navbar');
    const navLinks = document.querySelectorAll('.nav-link');
    const sections = document.querySelectorAll('section[id]');
    
    if (!navbar || navLinks.length === 0 || sections.length === 0) {
        return;
    }
    
    // Scroll spy - update active link based on scroll position
    function updateActiveNavLink() {
        const scrollPos = window.scrollY + window.innerHeight / 3;
        let current = null;
        
        // Find which section is currently in view
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute('id');
            
            if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                current = sectionId;
            }
        });
        
        // If no section found, default to first section (home)
        if (!current && window.scrollY < 300) {
            current = 'home';
        }
        
        // Update active class on nav links
        if (current) {
            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref === `#${current}`) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }
    }
    
    // Sticky navigation and scroll spy
    let ticking = false;
    window.addEventListener('scroll', () => {
        // Sticky effect
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Throttle scroll spy for performance
        if (!ticking) {
            window.requestAnimationFrame(() => {
                updateActiveNavLink();
                ticking = false;
            });
            ticking = true;
        }
    });
    
    // Initial update on page load
    setTimeout(() => {
        updateActiveNavLink();
    }, 300);
    
    // Smooth scroll for navigation links
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const navbarHeight = navbar.offsetHeight || 80;
                const offsetTop = targetSection.offsetTop - navbarHeight - 20;
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                
                // Update active link immediately on click
                navLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                
                // Close mobile menu if open
                const navMenu = document.getElementById('navMenu');
                const hamburger = document.getElementById('hamburger');
                if (navMenu && navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    if (hamburger) hamburger.classList.remove('active');
                }
            }
        });
    });
}

// ===== MOBILE MENU =====
function initMobileMenu() {
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileActions = document.querySelectorAll('.nav-buttons a, .mobile-social-links a');
    
    if (!hamburger || !navMenu) {
        return; // Elements not found
    }
    
    // Toggle menu
    hamburger.addEventListener('click', (e) => {
        e.stopPropagation();
        const isActive = hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
        
        // Prevent body scroll when menu is open
        if (isActive) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    });
    
    // Close menu when clicking on navigation link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        });
    });
    
    // Close menu when clicking on button/social
    mobileActions.forEach(action => {
        action.addEventListener('click', () => {
            setTimeout(() => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            }, 300);
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', (e) => {
        const isClickInsideMenu = navMenu.contains(e.target);
        const isClickOnHamburger = hamburger.contains(e.target);
        
        if (!isClickInsideMenu && !isClickOnHamburger && navMenu.classList.contains('active')) {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}

// ===== SCROLL EFFECTS =====
function initScrollEffects() {
    // Scroll to top button
    const scrollTopBtn = document.getElementById('scrollTop');
    
    if (!scrollTopBtn) return; // Exit if button not found
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 500) {
            scrollTopBtn.classList.add('visible');
        } else {
            scrollTopBtn.classList.remove('visible');
        }
    });
    
    scrollTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Parallax effect for hero shapes
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const shapes = document.querySelectorAll('.shape');
        
        shapes.forEach((shape, index) => {
            const speed = (index + 1) * 0.3;
            shape.style.transform = `translate(0, ${scrolled * speed}px)`;
        });
    });
}

// ===== COUNTERS ANIMATION =====
function initCounters() {
    const counters = document.querySelectorAll('.stat-number');
    
    if (counters.length === 0) {
        return; // No counters on page, skip
    }
    
    let animated = false;
    
    const animateCounters = () => {
        if (animated) return;
        
        const statsSection = document.querySelector('.hero-stats') || document.querySelector('.about');
        
        if (!statsSection) {
            return; // No stats section found
        }
        
        const rect = statsSection.getBoundingClientRect();
        const isVisible = rect.top < window.innerHeight && rect.bottom >= 0;
        
        if (isVisible) {
            animated = true;
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }
    };
    
    window.addEventListener('scroll', animateCounters);
    animateCounters(); // Check on load
}

// ===== CONTACT FORM =====
function initContactForm() {
    const form = document.getElementById('contactForm');
    
    if (!form) return; // Exit if form not found on page
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            message: document.getElementById('message').value
        };
        
        const submitBtn = form.querySelector('.btn-submit-modern') || form.querySelector('.btn-submit');
        
        if (!submitBtn) {
            console.error('Submit button not found');
            return;
        }
        
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<span>Wysyłanie...</span><i class="fas fa-spinner fa-spin"></i>';
        submitBtn.disabled = true;
        
        try {
            // Send to WordPress REST API endpoint
            const response = await fetch('https://jakubbujakiewicz.pl/wp-json/contact/v1/send', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            
            const result = await response.json();
            
            if (response.ok && result.success) {
                // Show success message
                showNotification(result.message || 'Wiadomość wysłana pomyślnie! Odezwę się wkrótce.', 'success');
                form.reset();
            } else {
                // Handle error from API
                const errorMessage = result.message || result.data?.message || 'Wystąpił błąd podczas wysyłania.';
                showNotification(errorMessage, 'error');
            }
            
        } catch (error) {
            console.error('Contact form error:', error);
            showNotification('Wystąpił błąd. Spróbuj ponownie lub napisz bezpośrednio na kontakt@jakubbujakiewicz.pl', 'error');
        } finally {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

// ===== LOAD BLOG POSTS FROM WORDPRESS =====
async function loadBlogPosts() {
    const blogGrid = document.getElementById('blogGrid');
    
    if (!blogGrid) return; // Exit if blog grid not found on page
    
    try {
        // Fetch latest 3 posts from WordPress REST API
        const response = await fetch('https://jakubbujakiewicz.pl/wp-json/wp/v2/posts?per_page=3&_embed', {
            mode: 'cors',
            credentials: 'omit'
        });
        
        if (!response.ok) {
            throw new Error('Failed to fetch posts');
        }
        
        const posts = await response.json();
        
        // Clear loading state
        blogGrid.innerHTML = '';
        
        // Create blog cards
        posts.forEach((post, index) => {
            const card = createBlogCard(post, index);
            blogGrid.appendChild(card);
        });
        
    } catch (error) {
        console.log('Blog loading skipped (CORS):', error.message);
        
        // Show fallback content with sample posts
        blogGrid.innerHTML = `
            <a href="https://jakubbujakiewicz.pl/blog/" class="blog-card" target="_blank">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1517836357463-d25dfeac3438?w=600&h=400&fit=crop" alt="Trening">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="fas fa-calendar"></i> Najnowsze</span>
                        <span class="blog-author"><i class="fas fa-user"></i> Jakub</span>
                    </div>
                    <h3>Najlepsze ćwiczenia na masę</h3>
                    <p class="blog-excerpt">Poznaj najskuteczniejsze ćwiczenia do budowania masy mięśniowej...</p>
                    <span class="blog-read-more">Czytaj więcej <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
            <a href="https://jakubbujakiewicz.pl/blog/" class="blog-card" target="_blank">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=600&h=400&fit=crop" alt="Dieta">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="fas fa-calendar"></i> Najnowsze</span>
                        <span class="blog-author"><i class="fas fa-user"></i> Jakub</span>
                    </div>
                    <h3>Jak ułożyć dietę na redukcję</h3>
                    <p class="blog-excerpt">Praktyczny poradnik jak schudnąć zdrowo i skutecznie...</p>
                    <span class="blog-read-more">Czytaj więcej <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
            <a href="https://jakubbujakiewicz.pl/blog/" class="blog-card" target="_blank">
                <div class="blog-image">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=600&h=400&fit=crop" alt="Motywacja">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="blog-date"><i class="fas fa-calendar"></i> Najnowsze</span>
                        <span class="blog-author"><i class="fas fa-user"></i> Jakub</span>
                    </div>
                    <h3>5 sposobów na motywację do treningów</h3>
                    <p class="blog-excerpt">Jak utrzymać regularność i nie odpuścić w połowie drogi...</p>
                    <span class="blog-read-more">Czytaj więcej <i class="fas fa-arrow-right"></i></span>
                </div>
            </a>
        `;
    }
}

function createBlogCard(post, index) {
    const card = document.createElement('a');
    card.href = post.link;
    card.className = 'blog-card';
    card.setAttribute('data-aos', 'fade-up');
    card.setAttribute('data-aos-delay', (index + 1) * 100);
    card.target = '_blank';
    
    // Get featured image
    let featuredImage = 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=600&h=400&fit=crop';
    if (post._embedded && post._embedded['wp:featuredmedia']) {
        featuredImage = post._embedded['wp:featuredmedia'][0].source_url;
    }
    
    // Get author name
    let authorName = 'Jakub Bujakiewicz';
    if (post._embedded && post._embedded.author) {
        authorName = post._embedded.author[0].name;
    }
    
    // Format date
    const date = new Date(post.date);
    const formattedDate = date.toLocaleDateString('pl-PL', { 
        day: '2-digit', 
        month: '2-digit', 
        year: 'numeric' 
    });
    
    // Get excerpt
    const excerpt = post.excerpt.rendered
        .replace(/<[^>]*>/g, '') // Remove HTML tags
        .substring(0, 120) + '...';
    
    card.innerHTML = `
        <div class="blog-image">
            <img src="${featuredImage}" alt="${post.title.rendered}" loading="lazy">
        </div>
        <div class="blog-content">
            <div class="blog-meta">
                <span class="blog-date">
                    <i class="fas fa-calendar"></i>
                    ${formattedDate}
                </span>
                <span class="blog-author">
                    <i class="fas fa-user"></i>
                    ${authorName}
                </span>
            </div>
            <h3>${post.title.rendered}</h3>
            <p class="blog-excerpt">${excerpt}</p>
            <span class="blog-read-more">
                Czytaj więcej
                <i class="fas fa-arrow-right"></i>
            </span>
        </div>
    `;
    
    return card;
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles if not already present
    if (!document.getElementById('notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            .notification {
                position: fixed;
                top: 100px;
                right: 30px;
                background: rgba(20, 25, 48, 0.95);
                backdrop-filter: blur(20px);
                border: 1px solid var(--border);
                border-radius: 12px;
                padding: 20px 25px;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
                z-index: 10000;
                animation: slideIn 0.3s ease;
                max-width: 400px;
            }
            
            .notification-content {
                display: flex;
                align-items: center;
                gap: 15px;
                color: var(--text);
            }
            
            .notification-content i {
                font-size: 24px;
            }
            
            .notification-success {
                border-left: 4px solid var(--primary);
            }
            
            .notification-success i {
                color: var(--primary);
            }
            
            .notification-error {
                border-left: 4px solid #e74c3c;
            }
            
            .notification-error i {
                color: #e74c3c;
            }
            
            @keyframes slideIn {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 5000);
}

// ===== FLOATING CARDS PARALLAX =====
window.addEventListener('mousemove', (e) => {
    const cards = document.querySelectorAll('.floating-card');
    const centerX = window.innerWidth / 2;
    const centerY = window.innerHeight / 2;
    
    cards.forEach((card, index) => {
        const speed = (index + 1) * 0.01;
        const x = (e.clientX - centerX) * speed;
        const y = (e.clientY - centerY) * speed;
        
        card.style.transform = `translate(${x}px, ${y}px)`;
    });
});

// ===== IMAGE LAZY LOADING =====
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                }
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
}

// ===== SERVICE CARDS HOVER EFFECT =====
document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        card.style.setProperty('--mouse-x', `${x}px`);
        card.style.setProperty('--mouse-y', `${y}px`);
    });
});

// ===== BEFORE/AFTER SLIDER (for future implementation) =====
function initBeforeAfterSlider() {
    const transformationCards = document.querySelectorAll('.transformation-card');
    
    transformationCards.forEach(card => {
        const slider = card.querySelector('.slider');
        const beforeImg = card.querySelector('.img-before');
        let isDragging = false;
        
        if (!slider || !beforeImg) return;
        
        const updateSlider = (e) => {
            const rect = card.getBoundingClientRect();
            let x = e.clientX - rect.left;
            
            // Ensure x is within bounds
            x = Math.max(0, Math.min(x, rect.width));
            
            const percentage = (x / rect.width) * 100;
            slider.style.left = `${percentage}%`;
            beforeImg.style.clipPath = `polygon(0 0, ${percentage}% 0, ${percentage}% 100%, 0 100%)`;
        };
        
        slider.addEventListener('mousedown', () => {
            isDragging = true;
        });
        
        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                updateSlider(e);
            }
        });
        
        document.addEventListener('mouseup', () => {
            isDragging = false;
        });
        
        // Touch support
        slider.addEventListener('touchstart', () => {
            isDragging = true;
        });
        
        document.addEventListener('touchmove', (e) => {
            if (isDragging) {
                updateSlider(e.touches[0]);
            }
        });
        
        document.addEventListener('touchend', () => {
            isDragging = false;
        });
    });
}

// Initialize before/after slider
setTimeout(initBeforeAfterSlider, 1000);

// ===== PERFORMANCE OPTIMIZATION =====
// Debounce function for scroll events
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Optimize scroll events
window.addEventListener('scroll', debounce(() => {
    // Your scroll optimizations here
}, 10));

// ===== CONSOLE MESSAGE =====
console.log('%c🚀 Welcome to Jakub Bujakiewicz Website!', 'color: #0ed145; font-size: 20px; font-weight: bold;');
console.log('%cDesigned & Developed with ❤️', 'color: #667eea; font-size: 14px;');
console.log('%cInterested in collaboration? Contact: kontakt@jakubbujakiewicz.pl', 'color: #a0aec0; font-size: 12px;');

// ===== FAQ ACCORDION =====
function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            item.classList.toggle('active');
        });
    });
}

// Call FAQ init
initFAQ();

// ===== SIMPLE SCROLL ANIMATIONS =====
function initSimpleAnimations() {
    const animatedElements = document.querySelectorAll('[data-aos]');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });
    
    animatedElements.forEach(el => {
        observer.observe(el);
    });
}
