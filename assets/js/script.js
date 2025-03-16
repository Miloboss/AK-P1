const carouselInner = document.querySelector('.carousel-inner-my');
const items = document.querySelectorAll('.carousel-item-my');
const totalItems = items.length;
let index = 0;

// Clone first and last items
const firstClone = items[0].cloneNode(true);
const lastClone = items[totalItems - 1].cloneNode(true);
firstClone.id = 'first-clone';
lastClone.id = 'last-clone';

carouselInner.appendChild(firstClone);
carouselInner.insertBefore(lastClone, items[0]);

let currentIndex = 1;

carouselInner.style.transform = `translateX(-${currentIndex * 100}%)`;

function showNextSlide() {
    const isMobile = window.innerWidth < 769;
    currentIndex++;
    carouselInner.style.transition = 'transform 0.5s ease-in-out';
    carouselInner.style.transform = `translateX(-${currentIndex * (isMobile ? 100 : 50)}%)`;

    if (currentIndex === totalItems + 1) {
        setTimeout(() => {
            carouselInner.style.transition = 'none';
            currentIndex = 1;
            carouselInner.style.transform = `translateX(-${currentIndex * (isMobile ? 100 : 50)}%)`;
        }, 500);
    }
}

setInterval(showNextSlide, 2000); // 2 seconds delay

// Touch control
let startX, endX;

carouselInner.addEventListener('touchstart', (e) => {
    startX = e.touches[0].clientX;
});

carouselInner.addEventListener('touchmove', (e) => {
    endX = e.touches[0].clientX;
});

carouselInner.addEventListener('touchend', () => {
    const isMobile = window.innerWidth < 769;
    if (startX > endX + 50) {
        // Swipe left
        currentIndex++;
    } else if (startX < endX - 50) {
        // Swipe right
        currentIndex--;
    }
    carouselInner.style.transition = 'transform 0.5s ease-in-out';
    carouselInner.style.transform = `translateX(-${currentIndex * (isMobile ? 100 : 50)}%)`;

    if (currentIndex === totalItems + 1) {
        setTimeout(() => {
            carouselInner.style.transition = 'none';
            currentIndex = 1;
            carouselInner.style.transform = `translateX(-${currentIndex * (isMobile ? 100 : 50)}%)`;
        }, 500);
    } else if (currentIndex === 0) {
        setTimeout(() => {
            carouselInner.style.transition = 'none';
            currentIndex = totalItems;
            carouselInner.style.transform = `translateX(-${currentIndex * (isMobile ? 100 : 50)}%)`;
        }, 500);
    }
});


//