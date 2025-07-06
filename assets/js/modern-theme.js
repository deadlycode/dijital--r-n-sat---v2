// Modern Theme JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Enhanced card hover effects
    const cards = document.querySelectorAll('.modern-card, .category-card, .feature-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.transition = 'all 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Loading animation for buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.classList.contains('loading')) {
                this.classList.add('loading');
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Yükleniyor...';
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.classList.remove('loading');
                }, 2000);
            }
        });
    });

    // Disabled parallax effect to fix scroll issues
    // window.addEventListener('scroll', function() {
    //     const scrolled = window.pageYOffset;
    //     const parallax = document.querySelector('.hero-section');
    //     if (parallax) {
    //         const speed = scrolled * 0.5;
    //         parallax.style.transform = `translateY(${speed}px)`;
    //     }
    // });

    // Disabled typing effect to prevent layout issues
    // const heroTitle = document.querySelector('.hero-title');
    // if (heroTitle) {
    //     const text = heroTitle.textContent;
    //     heroTitle.textContent = '';
    //     let index = 0;
    //     
    //     function typeWriter() {
    //         if (index < text.length) {
    //             heroTitle.textContent += text.charAt(index);
    //             index++;
    //             setTimeout(typeWriter, 100);
    //         }
    //     }
    //     
    //     // Start typing effect after a small delay
    //     setTimeout(typeWriter, 500);
    // }

    // Category cards interactive effects
    const categoryCards = document.querySelectorAll('.category-card');
    categoryCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        
        // Add ripple effect on click
        card.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Theme transition effects
    function addThemeTransition() {
        document.body.style.transition = 'background-color 0.3s ease, color 0.3s ease';
        
        const elements = document.querySelectorAll('.card, .navbar, .btn');
        elements.forEach(el => {
            el.style.transition = 'all 0.3s ease';
        });
    }
    
    addThemeTransition();

    // Enhanced theme toggle with animation
    window.toggleTheme = function() {
        const body = document.body;
        const themeIcon = document.getElementById('theme-icon');
        const themeButton = document.querySelector('.theme-toggle');
        
        // Add rotation animation to button
        themeButton.style.transform = 'rotate(360deg)';
        
        setTimeout(() => {
            if (body.getAttribute('data-theme') === 'dark') {
                body.setAttribute('data-theme', 'light');
                themeIcon.className = 'fas fa-sun';
                localStorage.setItem('theme', 'light');
            } else {
                body.setAttribute('data-theme', 'dark');
                themeIcon.className = 'fas fa-moon';
                localStorage.setItem('theme', 'dark');
            }
            
            themeButton.style.transform = 'rotate(0deg)';
        }, 150);
    };

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.feature-card, .category-card');
    animateElements.forEach(el => observer.observe(el));

    // Add floating animation to theme toggle button
    const themeToggle = document.querySelector('.theme-toggle');
    if (themeToggle) {
        let floating = true;
        
        function floatAnimation() {
            if (floating) {
                themeToggle.style.transform = 'translateY(-5px)';
                setTimeout(() => {
                    if (floating) themeToggle.style.transform = 'translateY(5px)';
                }, 1000);
            }
        }
        
        setInterval(floatAnimation, 2000);
        
        themeToggle.addEventListener('mouseenter', () => {
            floating = false;
            themeToggle.style.transform = 'scale(1.2)';
        });
        
        themeToggle.addEventListener('mouseleave', () => {
            floating = true;
            themeToggle.style.transform = 'scale(1)';
        });
    }
});

// CSS for ripple effect and animations
const style = document.createElement('style');
style.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .animate-in {
        animation: slideInUp 0.6s ease forwards;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .navbar.scrolled {
        background: rgba(255, 255, 255, 0.95) !important;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
    }
    
    [data-theme="dark"] .navbar.scrolled {
        background: rgba(45, 45, 45, 0.95) !important;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
    }
    
    .btn.loading {
        opacity: 0.8;
        pointer-events: none;
    }
`;
document.head.appendChild(style);
