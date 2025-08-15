$(window).bind('load', function () {
    setTimeout(() => {
        $('html').removeClass('is_loadding');
    }, 2000);

    AOS.init({
        duration: 1000,
        once: true,
    });
});
$(document).ready(function () {
    const hambugerButton = $('.js_toggle');
    const spBreakPoint = 1023;
    let drawerFlag = 'close';

    $('a[href^="#"]').click(function () {
        const p = $($(this).attr('href')).offset();
        if ($(window).width() > 767) {
            $('html,body').animate(
                {
                    scrollTop: p.top - 160,
                },
                600
            );
        } else {
            $('html,body').animate(
                {
                    scrollTop: p.top - 100,
                },
                600
            );
        }
        return false;
    });

    //Anchor scroll
    const hash1 = location.hash;
    const $root = $('html, body');
    if (hash1 !== '') {
        const top01 = $(hash1).offset().top;
        if ($(window).width() > 160) {
            $root.animate({ scrollTop: top01 - 160 }, 600);
        } else {
            $root.animate({ scrollTop: top01 - 100 }, 600);
        }
    }

    function menuToggle() {
        const isClose = drawerFlag === 'close';
        $('body').toggleClass('is_menu_open', isClose);
        drawerFlag = isClose ? 'open' : 'close';

        if (drawerFlag === 'open') {
            $('.l_header_fixed__inner').scrollTop(0);
            backfaceFixed(true);
        } else {
            $('.js_gnavi_sub').removeAttr('style');
            backfaceFixed(false);
        }
    }

    hambugerButton.on('click', menuToggle);
    $('.js_submenu').on('click', function (e) {
        if (window.innerWidth <= spBreakPoint) {
            e.preventDefault();
        }
        if (window.innerWidth <= spBreakPoint) {
            $(this).find('.has_child').toggleClass('is_actived');
            $(this).find('.js_gnavi_sub').stop().slideToggle(500);
        } else {
            $(this).find('.has_child').removeClass('is_actived');
            $(this).find('.js_gnavi_sub').removeAttr('style');
        }
    });
    // scroll
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.c_totop').css('transform', 'translateY(0)');
        } else {
            $('.c_totop').removeAttr('style');
        }
    });

    $(window).bind('load resize', function () {
        if ($(this).scrollTop() > 100) {
            $('.c_totop').css('transform', 'translateY(0)');
        } else {
            $('.c_totop').removeAttr('style');
        }

        if (window.innerWidth > spBreakPoint) {
            if ($('body').hasClass('is_menu_open')) {
                hambugerButton.trigger('click');
            }
            if ($('.js_submenu .has_child').hasClass('is_actived')) {
                $('.js_submenu').trigger('click');
            }
        }
    });
});

$(document).ready(function () {
    let currentPath = window.location.pathname.replace(/^\/|\/$/g, '');
    let currentSlug = currentPath.split('/').pop();
    let currentSlugPrev = currentPath.split('/').slice(-2, -1)[0];

    $('.l_header_fixed__mlist_item a').each(function () {
        let linkSlug = $(this)
            .prop('pathname')
            .replace(/^\/|\/$/g, '')
            .split('/')
            .pop();

        if (!$('body').hasClass('wp-singular')) {
            if (linkSlug === currentSlug) {
                $(this).parent().addClass('active');
            }
        } else {
            console.log(111);
            if (linkSlug === currentSlugPrev) {
                $(this).parent().addClass('active');
            }
        }
    });
});
