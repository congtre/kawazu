<?php get_header(); ?>
<?php
$page_id = get_the_ID();

$page_title_en = get_post_meta( $page_id, 'page_title_en', true );

if ( empty( $page_title_en ) ) {
    $slug = get_post_field('post_name', $page_id);
    $page_title_en = ucfirst($slug);
}
?>
<main class="c_404">
    <div class="c_page_hero">
        <picture class="c_page_hero__image">
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv_sp.webp">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv.webp" alt="">
        </picture>

        <div class="c_page_hero__content">
            <div class="c_page_hero__heading c_page_heading">
                <h1 class="c_page_heading__mttl u_color_white">ページが見つかりません</h1>
                <p class="c_page_heading__suben u_color_white u_txt_italic_skew">404 NOT FOUND</p>
            </div>
        </div>
    </div>

    <div class="l_container block">
        <div class="c_breadcrumb">
            <?php breadcrumb(); ?>
        </div>
    </div>

    <div class="l_container block">
        <div class="c_404_main">
            <h2 class="c_404_ttl">アクセスしようとしたページは見つかりませんでした。</h2>
            <p class="c_404_txt">この度は、当サイトをご覧いただきありがとうございます。<br>こちらのページは現在使われておりません。<br>メニューからご希望の内容へお進みください。</p>
            <div class="c_404_btn">
                <a href="<?php echo esc_url(home_url()); ?>" class="c_btn02 c_btn">
                    <span>TOPに戻る</span>
                </a>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>