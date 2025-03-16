document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const closeMenu = document.getElementById('close-menu');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        if (window.innerWidth > 768) {
            if (sidebar.classList.contains('open')) {
                mainContent.classList.toggle('open');
            } else {
                mainContent.classList.remove('open');
            }
        }
    });

    closeMenu.addEventListener('click', function() {
        sidebar.classList.remove('open');
        if (window.innerWidth > 768) {
            mainContent.classList.remove('open');
        }
    });
});

const images = document.querySelectorAll('.product-image');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

let currentImageIndex = 0;

function showImage(index) {
    images.forEach((img, i) => {
        img.style.display = i === index ? 'block' : 'none';
        img.style.opacity = i === index ? '1' : '0';
    });
}

function nextImage() {
    currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
    showImage(currentImageIndex);
}

function prevImage() {
    currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
    showImage(currentImageIndex);
}

prevBtn.addEventListener('click', prevImage);
nextBtn.addEventListener('click', nextImage);

// Hide navigation buttons if only one image is available
if (images.length <= 1) {
    prevBtn.style.display = 'none';
    nextBtn.style.display = 'none';
}

// Touch events for mobile view
let startX, endX;

document.querySelector('.image-container').addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
});

document.querySelector('.image-container').addEventListener('touchmove', (e) => {
    endX = e.touches[0].clientX;
});

document.querySelector('.image-container').addEventListener('touchend', () => {
    if (startX > endX + 50) {
        nextImage();
    } else if (startX < endX - 50) {
        prevImage();
    }
    showImage(currentImageIndex);
});

// Auto slide function
let autoSlideInterval;

function startAutoSlide() {
    autoSlideInterval = setInterval(nextImage, 3000); // 3 seconds
}

function stopAutoSlide() {
    clearInterval(autoSlideInterval);
}

// Start auto slide
startAutoSlide();

// Stop auto slide on mouse enter and

//