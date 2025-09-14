// DOM Elements
const menuItems = document.querySelectorAll('.menu-item');
const audioControl = document.querySelector('.audio-control');
const socialItems = document.querySelectorAll('.social-item');

// Menu item click handlers
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        // Remove active class from all items
        menuItems.forEach(i => i.classList.remove('active'));
        
        // Add active class to clicked item
        this.classList.add('active');
        
        // Get URL from data attribute
        const url = this.getAttribute('data-url');
        
        // Add click animation
        this.style.transform = 'scale(0.95)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
        
        // Navigate to URL (in real implementation)
        if (url) {
            console.log('Navigating to:', url);
            // window.location.href = url; // Uncomment for actual navigation
            
            // Show loading state
            showLoadingState(this);
        }
    });
    
    // Add hover sound effect placeholder
    item.addEventListener('mouseenter', function() {
        // playHoverSound(); // Placeholder for sound effect
    });
});


// Loading state function
function showLoadingState(element) {
    const originalContent = element.innerHTML;
    const icon = element.querySelector('.menu-icon');
    
    icon.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // Remove loading state after 2 seconds (simulated)
    setTimeout(() => {
        element.innerHTML = originalContent;
    }, 2000);
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const activeItem = document.querySelector('.menu-item.active');
    const currentIndex = Array.from(menuItems).indexOf(activeItem);
    
    let nextIndex = currentIndex;
    
    switch(e.key) {
        case 'ArrowRight':
            nextIndex = (currentIndex + 1) % menuItems.length;
            break;
        case 'ArrowLeft':
            nextIndex = (currentIndex - 1 + menuItems.length) % menuItems.length;
            break;
        case 'ArrowDown':
            nextIndex = (currentIndex + 5) % menuItems.length;
            break;
        case 'ArrowUp':
            nextIndex = (currentIndex - 5 + menuItems.length) % menuItems.length;
            break;
        case 'Enter':
            if (activeItem) {
                activeItem.click();
            }
            return;
        default:
            return;
    }
    
    e.preventDefault();
    menuItems[nextIndex].click();
    menuItems[nextIndex].focus();
});

// Touch/swipe support for mobile
let touchStartX = 0;
let touchStartY = 0;

document.addEventListener('touchstart', function(e) {
    touchStartX = e.touches[0].clientX;
    touchStartY = e.touches[0].clientY;
});

document.addEventListener('touchend', function(e) {
    const touchEndX = e.changedTouches[0].clientX;
    const touchEndY = e.changedTouches[0].clientY;
    
    const deltaX = touchEndX - touchStartX;
    const deltaY = touchEndY - touchStartY;
    
    // Minimum swipe distance
    const minSwipeDistance = 50;
    
    if (Math.abs(deltaX) > minSwipeDistance || Math.abs(deltaY) > minSwipeDistance) {
        // Handle swipe gestures if needed
        console.log('Swipe detected:', deltaX, deltaY);
    }
});

// Accessibility improvements
menuItems.forEach((item, index) => {
    item.setAttribute('tabindex', '0');
    item.setAttribute('role', 'button');
    item.setAttribute('aria-label', item.textContent.trim());
    
    // Focus management
    item.addEventListener('focus', function() {
        this.style.outline = '2px solid rgba(255, 255, 255, 0.8)';
        this.style.outlineOffset = '2px';
    });
    
    item.addEventListener('blur', function() {
        this.style.outline = 'none';
    });
});

// Smooth scroll behavior
document.documentElement.style.scrollBehavior = 'smooth';

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animation to main elements
    const header = document.querySelector('.header');
    const menuGrid = document.querySelector('.menu-grid');
    const socialMedia = document.querySelector('.social-media');
    const footer = document.querySelector('.footer');
    
    header.style.animation = 'fadeIn 1s ease forwards';
    menuGrid.style.animation = 'fadeIn 1s ease forwards 0.3s';
    socialMedia.style.animation = 'fadeIn 1s ease forwards 0.6s';
    footer.style.animation = 'fadeIn 1s ease forwards 0.9s';
    
    // Set initial opacity to 0 for animation
    [header, menuGrid, socialMedia, footer].forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
    });
    
    // Animate in sequence
    setTimeout(() => {
        header.style.opacity = '1';
        header.style.transform = 'translateY(0)';
    }, 100);
    
    setTimeout(() => {
        menuGrid.style.opacity = '1';
        menuGrid.style.transform = 'translateY(0)';
    }, 400);
    
    setTimeout(() => {
        socialMedia.style.opacity = '1';
        socialMedia.style.transform = 'translateY(0)';
    }, 700);
    
    setTimeout(() => {
        footer.style.opacity = '1';
        footer.style.transform = 'translateY(0)';
    }, 1000);
});

// Performance optimization
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

// Optimized resize handler
const handleResize = debounce(() => {
    // Adjust grid layout based on screen size
    const screenWidth = window.innerWidth;
    const menuGrid = document.querySelector('.menu-grid');
    
    if (screenWidth <= 480) {
        menuGrid.style.gridTemplateColumns = '1fr';
    } else if (screenWidth <= 768) {
        menuGrid.style.gridTemplateColumns = 'repeat(2, 1fr)';
    } else if (screenWidth <= 1024) {
        menuGrid.style.gridTemplateColumns = 'repeat(3, 1fr)';
    } else {
        menuGrid.style.gridTemplateColumns = 'repeat(5, 1fr)';
    }
}, 250);

window.addEventListener('resize', handleResize);

// Add ripple effect to menu items
menuItems.forEach(item => {
    item.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s ease-out;
            pointer-events: none;
        `;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add CSS animation for ripple effect
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .menu-item {
        position: relative;
        overflow: hidden;
    }
`;
document.head.appendChild(style);