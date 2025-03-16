const images = document.querySelectorAll('.product-image');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const zoomIcon = document.getElementById('zoomIcon');
const zoomModal = document.getElementById('zoomModal');
const zoomedImage = document.getElementById('zoomedImage');
const closeBtn = document.querySelector('.close');

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

zoomIcon.addEventListener('click', () => {
    zoomModal.style.display = 'block';
    zoomedImage.src = images[currentImageIndex].src;
});

closeBtn.addEventListener('click', () => {
    zoomModal.style.display = 'none';
});

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


document.addEventListener('DOMContentLoaded', () => {
    const toggleIcon = document.getElementById('toggle-icon');
    const descriptionContent = document.querySelector('.description-content');

    toggleIcon.addEventListener('click', () => {
        descriptionContent.classList.toggle('open');
        toggleIcon.classList.toggle('open');
        if (descriptionContent.classList.contains('open')) {
            toggleIcon.textContent = '-';
            descriptionContent.style.display = 'block';
        } else {
            toggleIcon.textContent = '+';
            setTimeout(() => {
                descriptionContent.style.display = 'none';
            }, 500);
        }
    });
});

//

document.addEventListener('DOMContentLoaded', () => {
    const quantityInput = document.getElementById('quantity');
    const increaseQuantityBtn = document.getElementById('increase-quantity');
    const decreaseQuantityBtn = document.getElementById('decrease-quantity');
    const addToCartBtn = document.getElementById('add-to-cart');

    increaseQuantityBtn.addEventListener('click', () => {
        let quantity = parseInt(quantityInput.value);
        quantityInput.value = quantity + 1;
    });

    decreaseQuantityBtn.addEventListener('click', () => {
        let quantity = parseInt(quantityInput.value);
        if (quantity > 1) {
            quantityInput.value = quantity - 1;
        }
    });


});