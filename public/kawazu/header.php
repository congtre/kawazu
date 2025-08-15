<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php echo get_option('my_tag_head_top'); ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <?php echo get_option('my_analytics_tag'); ?>
    <?php if (is_front_page()): ?>
    <script>
        if (!window.sessionStorage.getItem("storage_loadding")) {
            document.documentElement.classList.add("is_loadding");
            window.sessionStorage.setItem("storage_loadding", new Date().getTime().toString());
        }
    </script>
    <?php endif; ?>
</head>
<body <?php body_class(); ?>>
    <?php echo get_option('my_tag_body_top'); ?>
    <div id="wrapper" class="body-wrapper">
        <header class="l_header js_header" id="header">
            <div class="l_header__inner">
                <?php $tag = is_front_page() ? 'h1' : 'div'; ?>
                <<?php echo $tag ?> class="l_header__logo">
                    <a href="<?php echo esc_url(home_url()); ?>" class="l_header__logo_link">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/common/logo.webp" alt="KAWAZU 河津産業株式会社">
                    </a>
                    <span class="l_header__logo_des">北九州市を中心とした西日本全域の産業廃棄物・<span class="u_inline_block">特別管理産業廃棄物収集運搬許可を取得</span></span>
                </<?php echo $tag ?>>

                <div class="l_header__contact">
                    <div class="l_header__contact_tel">
                        <a href="tel:0947-44-7065">0947-44-7065</a>
                    </div>
                    <div class="l_header__contact_sns">
                        <a href="" class="l_header__contact_sns_link" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/common/icon_mess.webp" alt="">
                        </a>
                        <a href="https://www.instagram.com/kawazu2801/" class="l_header__contact_sns_link" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/common/icon_ig.webp" alt="">
                        </a>
                    </div>
                </div>

                <button class="l_header_burger js_toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span class="txt">MENU</span>
                    <span class="txt close">CLOSE</span>
                </button>
            </div>

            <div class="l_header_fixed">
                <div class="l_header_fixed__inner">
                    <ul class="l_header_fixed__mlist">
                        <li class="l_header_fixed__mlist_item">
                            <a href="<?php echo esc_url(home_url()); ?>/company" class="l_header_fixed__mlist_link">
                                <span class="ja">会社案内</span>
                                <span class="en">Company informaiton</span>
                            </a>
                        </li>
                        <li class="l_header_fixed__mlist_item">
                            <a href="<?php echo esc_url(home_url()); ?>/service" class="l_header_fixed__mlist_link">
                                <span class="ja">事業案内</span>
                                <span class="en">Service</span>
                            </a>
                        </li>
                        <li class="l_header_fixed__mlist_item js_submenu">
                            <a href="<?php echo esc_url(home_url()); ?>/vehicles_info" class="l_header_fixed__mlist_link has_child">
                                <span class="ja">車輌紹介</span>
                                <span class="en">Vehicle introduction</span>
                            </a>
                            <div class="js_gnavi_sub l_header_sub">
                                <ul>
                                    <li>
                                        <a href="<?php echo esc_url(home_url()); ?>/vehicles_info">車輛紹介 TOP</a>
                                    </li>
                                    <li>
                                        <a href="">ダンプ</a>
                                    </li>
                                    <li>
                                        <a href="">アームロール</a>
                                    </li>
                                    <li>
                                        <a href="">ウイング車</a>
                                    </li>
                                    <li>
                                        <a href="">平ボディー</a>
                                    </li>
                                    <li>
                                        <a href="">タンク車</a>
                                    </li>
                                    <li>
                                        <a href="">粉粒立体運搬車</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="l_header_fixed__mlist_item">
                            <a href="<?php echo esc_url(home_url()); ?>/trans" class="l_header_fixed__mlist_link">
                                <span class="ja">運搬実績</span>
                                <span class="en">Transportation record</span>
                            </a>
                        </li>
                        <li class="l_header_fixed__mlist_item">
                            <a href="<?php echo esc_url(home_url()); ?>/list" class="l_header_fixed__mlist_link">
                                <span class="ja">許可一覧</span>
                                <span class="en">List of permits</span>
                            </a>
                        </li>
                        <li class="l_header_fixed__mlist_item">
                            <a href="<?php echo esc_url(home_url()); ?>/contact" class="l_header_fixed__mlist_link">
                                <span class="ja">お問い合わせ</span>
                                <span class="en">Contact us</span>
                            </a>
                        </li>
                        <li class="l_header_fixed__mlist_item recruit">
                            <a href="<?php echo esc_url(home_url()); ?>/recruit" class="l_header_fixed__mlist_link">
                                <span class="ja">求人・採用情報</span>
                                <span class="en">Recruit</span>
                            </a>
                        </li>
                    </ul>

                    <ul class="l_header_fixed__slist">
                        <li class="l_header_fixed__slist_item">
                            <a href="">業界の中の河津産業</a>
                        </li>
                        <li class="l_header_fixed__slist_item">
                            <a href="">環境への取り組み</a>
                        </li>
                        <li class="l_header_fixed__slist_item">
                            <a href="">運輸安全マネジメント</a>
                        </li>
                        <li class="l_header_fixed__slist_item">
                            <a href="">新着情報</a>
                        </li>
                    </ul>

                    <a href="" class="l_header_fixed__banner">
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/common/img_banner.webp" alt="">
                    </a>

                    <div class="l_header_fixed__last">
                        <p class="l_header_fixed__last_tel">
                            <span class="box"><span class="text">TEL</span></span>
                            <a href="tel:0947-44-7065">0947-44-7065</a>
                        </p>
                        <p class="l_header_fixed__last_time">対応時間 9：00 ～ 18：00</p>
                        <figure class="l_header_fixed__last_banner">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/common/img_header_banner.webp" alt="">
                        </figure>

                        <div class="l_header_fixed__last_btn">
                            <a href="" class="l_header_fixed__last_sns">Instagram</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="l_main">
