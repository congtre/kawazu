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
        speed: 4000,
        autoplay: {
            delay: 600,
        },
        navigation: {
            nextEl: '.p_vehicle_detail_slide__btn.next',
            prevEl: '.p_vehicle_detail_slide__btn.prev',
        },
        thumbs: {
            swiper: swiperNav,
        },
    });

    $('.p_vehicle_detail_slide__for, .p_vehicle_detail_slide__nav')
        .on('mouseenter', function () {
            swiperFor.autoplay.stop();
        })
        .on('mouseleave', function () {
            swiperFor.autoplay.start();
        });
});
