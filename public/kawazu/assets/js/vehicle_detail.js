$(function () {
    const swiperNav = new Swiper('.p_vehicle_detail_slide__nav', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });

    const swiperFor = new Swiper('.p_vehicle_detail_slide__for', {
        spaceBetween: 10,
        effect: 'fade',
        loop: true,
        speed: 1500,
        autoplay: {
            delay: 1500,
        },
        navigation: {
            nextEl: '.p_vehicle_detail_slide__btn.next',
            prevEl: '.p_vehicle_detail_slide__btn.prev',
        },
        thumbs: {
            swiper: swiperNav,
        },
        on: {
            transitionEnd: function () {
                const activeSlide = $(this.slides[this.activeIndex]);
                if (activeSlide.find('video, iframe').length > 0) {
                    this.autoplay.stop();
                } else {
                    this.autoplay.start();
                }
            },
        },
    });

    // $('.p_vehicle_detail_slide__for, .p_vehicle_detail_slide__nav')
    //     .on('mouseenter', function () {
    //         const activeSlide = $(swiperFor.slides[swiperFor.activeIndex]);

    //         if (activeSlide.find('video, iframe').length > 0) {
    //             swiperFor.autoplay.stop();
    //         }
    //     })
    //     .on('mouseleave', function () {
    //         swiperFor.autoplay.start();
    //     });
});
