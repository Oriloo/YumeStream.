function CarrouselRollBig(carouselId, progressId) {
    const carousel = document.getElementById(carouselId);
    const leftArrow = carousel.parentElement.querySelector('.left-arrow');
    const rightArrow = carousel.parentElement.querySelector('.right-arrow');
    const track = carousel.querySelector('.carousel-track');
    const cards = track.querySelectorAll('.carousel-card');
    const progressBars = document.getElementById(progressId).querySelectorAll('.barre-av');
    let currentIndex = 0;
    let autoSlideInterval;
    
    // Set each card's width to be 100vw
    cards.forEach(card => {
        card.style.minWidth = '100vw';
    });
    
    const moveToIndex = (index) => {
        track.style.transform = `translateX(-${index * 100}vw)`;
        updateProgressBar(index);
    };

    const updateProgressBar = (index) => {
        progressBars.forEach((bar, i) => {
            if (i === index) {
                bar.classList.add('active');
            } else {
                bar.classList.remove('active');
            }
        });
    };
    
    const startAutoSlide = () => {
        autoSlideInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % cards.length;
            moveToIndex(currentIndex);
        }, 10000);
    };

    const stopAutoSlide = () => {
        clearInterval(autoSlideInterval);
    };

    leftArrow.addEventListener('click', () => {
        stopAutoSlide();
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        moveToIndex(currentIndex);
        startAutoSlide();
    });
    
    rightArrow.addEventListener('click', () => {
        stopAutoSlide();
        currentIndex = (currentIndex + 1) % cards.length;
        moveToIndex(currentIndex);
        startAutoSlide();
    });
    
    // Add event listeners to progress bars
    progressBars.forEach((bar, index) => {
        bar.addEventListener('click', () => {
            stopAutoSlide();
            currentIndex = index;
            moveToIndex(currentIndex);
            startAutoSlide();
        });
    });
    
    // Initial setup
    moveToIndex(currentIndex);
    startAutoSlide();
}

function CarrouselRoll(carouselId) {
    const carousel = document.getElementById(carouselId);
    const leftArrow = carousel.parentElement.querySelector(`.left-arrow`);
    const rightArrow = carousel.parentElement.querySelector(`.right-arrow`);
    const track = carousel.querySelector('.carousel-track');
    let currentScrollPosition = 0;

    let scrollAmount = window.innerWidth * 0.94; // 94% of the viewport width
    const threshold = window.innerWidth * 0.1; // 10% of the viewport width as threshold

    const updateArrowVisibility = () => {
        const maxScroll = track.scrollWidth - track.clientWidth;

        if (window.innerWidth < 480) {
            leftArrow.style.display = 'none';
            rightArrow.style.display = 'none';
        } else {
            leftArrow.style.display = currentScrollPosition <= threshold ? 'none' : 'block';
            rightArrow.style.display = currentScrollPosition >= maxScroll - threshold ? 'none' : 'block';
        }
    };

    leftArrow.addEventListener('click', () => {
        currentScrollPosition = Math.max(currentScrollPosition - scrollAmount, 0);
        track.style.transform = `translateX(-${currentScrollPosition}px)`;
        updateArrowVisibility();
    });

    rightArrow.addEventListener('click', () => {
        const maxScroll = track.scrollWidth - track.clientWidth;
        currentScrollPosition = Math.min(currentScrollPosition + scrollAmount, maxScroll);
        track.style.transform = `translateX(-${currentScrollPosition}px)`;
        updateArrowVisibility();
    });

    // Update scrollAmount and arrow visibility if window is resized
    window.addEventListener('resize', () => {
        scrollAmount = window.innerWidth * 0.94;
        updateArrowVisibility();
    });

    // Initial check to set the visibility of the arrows
    updateArrowVisibility();
}
