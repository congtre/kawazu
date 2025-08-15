<?php get_header(); ?>
<?php
$page_id = get_the_ID();

$page_title_en = get_post_meta( $page_id, 'page_title_en', true );

if ( empty( $page_title_en ) ) {
    $slug = get_post_field('post_name', $page_id);
    $page_title_en = ucfirst($slug);
}
?>
<main class="p_other">
    <div class="c_page_hero">
        <picture class="c_page_hero__image">
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv_sp.webp">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv.webp" alt="">
        </picture>

        <div class="c_page_hero__content">
            <div class="c_page_hero__heading c_page_heading">
                <h1 class="c_page_heading__mttl u_color_white"><?php the_title(); ?></h1>
                <p class="c_page_heading__suben u_color_white u_txt_italic_skew"><?php echo esc_html( $page_title_en ); ?></p>
            </div>
        </div>
    </div>

    <div class="l_container block">
        <div class="c_breadcrumb">
            <?php breadcrumb(); ?>
        </div>
    </div>

    <div class="p_other_main">
        <div class="l_container block">
            <?php the_content(); ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
