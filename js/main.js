// Main JavaScript File
document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth scroll para enlaces internos
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

    // Navbar scroll effect
    let lastScroll = 0;
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll <= 0) {
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
            return;
        }
        
        if (currentScroll > lastScroll) {
            // Scrolling down
            navbar.style.transform = 'translateY(-100%)';
        } else {
            // Scrolling up
            navbar.style.transform = 'translateY(0)';
            navbar.style.boxShadow = '0 2px 30px rgba(0, 0, 0, 0.2)';
        }
        
        lastScroll = currentScroll;
    });

    // Animación de elementos al hacer scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observar elementos con la clase animate
    document.querySelectorAll('.product-card-wrapper, .category-card, .team-card').forEach(el => {
        observer.observe(el);
    });

    // Hover effect en productos
    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Loading overlay para navegación
    const links = document.querySelectorAll('a:not([href^="#"]):not([target="_blank"])');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.href && !this.classList.contains('no-loading')) {
                document.body.style.opacity = '0.7';
            }
        });
    });

    // Inicializar tooltips de Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Filtro de productos (si existe)
    const searchInput = document.getElementById('searchProducts');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const productCards = document.querySelectorAll('.product-card-wrapper');
            
            productCards.forEach(card => {
                const productName = card.querySelector('.card-title').textContent.toLowerCase();
                const productDesc = card.querySelector('.card-text').textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || productDesc.includes(searchTerm)) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.5s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }

    // Contador animado para precios con descuento
    function animateValue(element, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = progress * (end - start) + start;
            element.textContent = '$' + value.toFixed(2);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    // Aplicar animación a precios cuando son visibles
    const priceObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.dataset.animated) {
                const price = parseFloat(entry.target.textContent.replace('$', ''));
                animateValue(entry.target, 0, price, 1000);
                entry.target.dataset.animated = 'true';
            }
        });
    });

    document.querySelectorAll('.text-danger.fw-bold, .fw-bold.fs-2').forEach(el => {
        priceObserver.observe(el);
    });

    // Validación de formularios
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Efecto parallax en el carousel
    const carousel = document.querySelector('.carousel');
    if (carousel) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = carousel.querySelector('.carousel-inner');
            if (parallax && scrolled < 500) {
                parallax.style.transform = 'translateY(' + scrolled * 0.5 + 'px)';
            }
        });
    }

    // Botón back to top
    const backToTop = document.createElement('button');
    backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
    backToTop.className = 'btn btn-dark btn-floating';
    backToTop.id = 'backToTop';
    backToTop.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: none;
        z-index: 1000;
        cursor: pointer;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
    `;
    document.body.appendChild(backToTop);

    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            backToTop.style.display = 'block';
        } else {
            backToTop.style.display = 'none';
        }
    });

    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    backToTop.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
    });

    backToTop.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });

    // Lazy loading de imágenes (placeholder)
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    document.querySelectorAll('.product-image-placeholder, .carousel-image').forEach(img => {
        imageObserver.observe(img);
    });

    // Animación de badges de descuento
    const discountBadges = document.querySelectorAll('.badge.bg-danger');
    discountBadges.forEach(badge => {
        badge.style.animation = 'pulse 2s infinite';
    });

    // Agregar animación pulse al CSS dinámicamente
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    `;
    document.head.appendChild(style);

    // Preload de páginas importantes (mejora UX)
    const importantLinks = document.querySelectorAll('a[href*="categorias"], a[href*="carrito"]');
    importantLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            const href = this.getAttribute('href');
            if (href && !document.querySelector(`link[href="${href}"]`)) {
                const prefetch = document.createElement('link');
                prefetch.rel = 'prefetch';
                prefetch.href = href;
                document.head.appendChild(prefetch);
            }
        });
    });

    // Console easter egg
    console.log('%c¡Bienvenido a StyleShop! 👕👟', 
        'font-size: 20px; font-weight: bold; color: #2C3E50;');
    console.log('%cSi estás viendo esto, ¡debes ser desarrollador! 💻', 
        'font-size: 14px; color: #7F8C8D;');
    console.log('%c¿Interesado en unirte al equipo? Contáctanos en contacto.php', 
        'font-size: 12px; color: #34495E;');
});