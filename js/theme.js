/**
 * Modern Landing Pro Theme JavaScript
 */

(function() {
    'use strict';
    
    // DOM Ready
    document.addEventListener('DOMContentLoaded', function() {
        initializeTheme();
    });
    
    /**
     * Initialize theme functionality
     */
    function initializeTheme() {
        initScrollEffects();
        initMobileMenu();
        initSmoothScrolling();
        initAnimations();
        initParallax();
        initTypingEffect();
        initCounters();
        initFormValidation();
    }
    
    /**
     * Header scroll effects
     */
    function initScrollEffects() {
        const header = document.getElementById('site-header');
        if (!header) return;
        
        let lastScrollTop = 0;
        
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Add/remove scrolled class
            if (scrollTop > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            // Hide/show header on scroll
            if (scrollTop > lastScrollTop && scrollTop > 200) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            
            lastScrollTop = scrollTop;
        }, { passive: true });
    }
    
    /**
     * Mobile menu functionality
     */
    function initMobileMenu() {
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const navigation = document.querySelector('.main-navigation');
        
        if (!mobileToggle || !navigation) return;
        
        mobileToggle.addEventListener('click', function() {
            const isOpen = navigation.classList.contains('mobile-open');
            
            if (isOpen) {
                navigation.classList.remove('mobile-open');
                mobileToggle.innerHTML = '☰';
                document.body.style.overflow = '';
            } else {
                navigation.classList.add('mobile-open');
                mobileToggle.innerHTML = '✕';
                document.body.style.overflow = 'hidden';
            }
        });
        
        // Close menu when clicking on links
        navigation.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                navigation.classList.remove('mobile-open');
                mobileToggle.innerHTML = '☰';
                document.body.style.overflow = '';
            });
        });
    }
    
    /**
     * Smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                
                if (target) {
                    const headerHeight = document.getElementById('site-header')?.offsetHeight || 0;
                    const targetPosition = target.offsetTop - headerHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
    
    /**
     * Intersection Observer for animations
     */
    function initAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    
                    // Start counters when they come into view
                    if (entry.target.classList.contains('counter')) {
                        animateCounter(entry.target);
                    }
                }
            });
        }, observerOptions);
        
        // Observe all animatable elements
        document.querySelectorAll('.fade-in-up, .counter').forEach(el => {
            observer.observe(el);
        });
    }
    
    /**
     * Parallax scrolling effect
     */
    function initParallax() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        if (parallaxElements.length === 0) return;
        
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            
            parallaxElements.forEach(element => {
                element.style.transform = `translateY(${rate}px)`;
            });
        }, { passive: true });
    }
    
    /**
     * Typing effect for hero title
     */
    function initTypingEffect() {
        const typingElement = document.querySelector('.typing-effect');
        if (!typingElement) return;
        
        const text = typingElement.textContent;
        typingElement.textContent = '';
        
        let i = 0;
        const typeWriter = function() {
            if (i < text.length) {
                typingElement.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        };
        
        // Start typing effect after a delay
        setTimeout(typeWriter, 1000);
    }
    
    /**
     * Animated counters
     */
    function initCounters() {
        // This will be called by the intersection observer
    }
    
    function animateCounter(element) {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                element.textContent = target;
                clearInterval(timer);
            } else {
                element.textContent = Math.floor(current);
            }
        }, 16);
    }
    
    /**
     * Form validation
     */
    function initFormValidation() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                        showFieldError(field, 'This field is required');
                    } else {
                        field.classList.remove('error');
                        hideFieldError(field);
                    }
                    
                    // Email validation
                    if (field.type === 'email' && field.value.trim()) {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(field.value)) {
                            isValid = false;
                            field.classList.add('error');
                            showFieldError(field, 'Please enter a valid email address');
                        }
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    }
    
    function showFieldError(field, message) {
        let errorElement = field.parentNode.querySelector('.field-error');
        if (!errorElement) {
            errorElement = document.createElement('span');
            errorElement.className = 'field-error';
            field.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }
    
    function hideFieldError(field) {
        const errorElement = field.parentNode.querySelector('.field-error');
        if (errorElement) {
            errorElement.remove();
        }
    }
    
    /**
     * Add to cart functionality with animation
     */
    function addToCartAnimation(button) {
        const originalText = button.textContent;
        button.textContent = 'Adding...';
        button.disabled = true;
        
        setTimeout(() => {
            button.textContent = 'Added!';
            button.classList.add('success');
            
            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
                button.classList.remove('success');
            }, 2000);
        }, 1000);
    }
    
    /**
     * Lazy loading for images
     */
    function initLazyLoading() {
        const images = document.querySelectorAll('img[data-src]');
        
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
    
    /**
     * Back to top button
     */
    function initBackToTop() {
        const backToTopBtn = document.createElement('button');
        backToTopBtn.className = 'back-to-top';
        backToTopBtn.innerHTML = '↑';
        backToTopBtn.setAttribute('aria-label', 'Back to top');
        document.body.appendChild(backToTopBtn);
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('visible');
            } else {
                backToTopBtn.classList.remove('visible');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Initialize back to top button
    initBackToTop();
    
    /**
     * Cookie consent banner
     */
    function initCookieConsent() {
        if (localStorage.getItem('cookieConsent')) return;
        
        const banner = document.createElement('div');
        banner.className = 'cookie-consent';
        banner.innerHTML = `
            <div class="cookie-content">
                <p>We use cookies to enhance your experience. By continuing to visit this site you agree to our use of cookies.</p>
                <button class="btn btn-primary accept-cookies">Accept</button>
            </div>
        `;
        
        document.body.appendChild(banner);
        
        banner.querySelector('.accept-cookies').addEventListener('click', () => {
            localStorage.setItem('cookieConsent', 'true');
            banner.remove();
        });
    }
    
    // Initialize cookie consent
    initCookieConsent();
    
})();