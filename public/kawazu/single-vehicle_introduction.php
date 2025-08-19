<?php get_header(); ?>
<?php
$terms = get_the_terms( get_the_ID(), 'vehicle_introduction_cate' );
$term_id = $terms[0]->term_id;
$term_name = $terms[0]->name;
?>
<main class="p_vehicle_detail">
    <div class="c_page_hero">
        <picture class="c_page_hero__image">
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv_sp.webp">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv.webp" alt="">
        </picture>

        <div class="c_page_hero__content">
            <div class="c_page_hero__heading c_page_heading">
                <p class="c_page_heading__subja u_color_skyblue">車輛紹介</p>
                <h1 class="c_page_heading__mttl u_color_white">
                    <?php the_title(); ?>
                </h1>
                <p class="c_page_heading__suben u_color_white u_txt_italic_skew">Vehicle introduction</p>
            </div>
        </div>
    </div>

    <div class="l_container block">
        <div class="c_breadcrumb">
            <?php breadcrumb(); ?>
        </div>
    </div>

    <section class="p_vehicle_detail_main">
        <div class="l_container">
            <div class="c_heading_h2" data-aos="fade-up">
                <span class="u_fs_40 u_f_en c_heading_h2__numb"><?php echo get_post_order_number(); ?></span>
                <h2 class="u_fs_40 c_heading_h2__mttl"><?php the_title(); ?></h2>
                <span class="u_f_en c_heading_h2__en"><?php echo get_field( 'vehicle_cate_en', 'term_' . $term_id ); ?></span>
            </div>
            <div class="p_vehicle_detail_flex">
                <div class="p_vehicle_detail_box" data-aos="fade-up">
                    <div class="p_vehicle_detail_box__txt">
                        <h3 class="c_heading_h3bg c_heading_bg01">
                            <span class="c_heading_h3bg__main">積載物</span>
                            <span class="c_heading_h3bg__sub"><?php echo get_field( 'vehicle_cate_products', 'term_' . $term_id ); ?></span>
                        </h3>
                        <h3 class="c_heading_h3"><?php echo get_field('vehicle_detail_title'); ?></h3>
                        <p class="p_vehicle_detail_txt"><?php echo wp_kses_post(get_field('vehicle_detail_description')); ?></p>
                    </div>
                    <?php if ( have_rows( 'vehicle_detail_table' ) ) : ?>
                        <div class="c_tbl">
                            <?php while ( have_rows( 'vehicle_detail_table' ) ) : the_row();
                                $title = get_sub_field( 'vehicle_detail_table_title' );
                                $text  = get_sub_field( 'vehicle_detail_table_text' );
                            ?>
                                <dl class="c_tbl__row">
                                    <dt class="c_tbl__head"><?php echo esc_html( $title ); ?></dt>
                                    <dd class="c_tbl__body"><?php echo wp_kses_post( $text ); ?></dd>
                                </dl>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                    $slides = get_field('vehicle_detail_slides');
                    if ( $slides && count($slides) === 1 ) {
                        $extra_class = ' none_slide';
                    } else {
                        $extra_class = '';
                    }
                ?>
                <?php if ( have_rows('vehicle_detail_slides') ) : ?>
                    <div class="p_vehicle_detail_slide<?php echo $extra_class; ?>" data-aos="fade-up">
                        <div class="p_vehicle_detail_slide__for swiper">
                            <div class="p_vehicle_detail_slide__for_inner swiper-wrapper">
                                <?php while ( have_rows('vehicle_detail_slides') ) : the_row();
                                    $type = get_sub_field('vehicle_detail_slides_type');
                                    echo '<div class="p_vehicle_detail_slide__for_item swiper-slide">';
                                    if ( $type === 'image' ) {
                                        $image = get_sub_field('vehicle_detail_slides_image');
                                        if ( $image ) {
                                            echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
                                        }
                                    } elseif ( $type === 'youtube' ) {
                                        $youtube_url = get_sub_field('vehicle_detail_slides_youtube');
                                        if ( $youtube_url ) {
                                            echo youtube_url_to_iframe($youtube_url);
                                        }
                                    } elseif ( $type === 'mp4' ) {
                                        $mp4 = get_sub_field('vehicle_detail_slides_mp4');
                                        if ( $mp4 ) {
                                            echo '<video controls muted><source src="' . esc_url($mp4['url']) . '" type="video/mp4"></video>';
                                        }
                                    }
                                    echo '</div>';
                                endwhile; ?>
                            </div>
                            <div class="p_vehicle_detail_slide__btn prev"></div>
                            <div class="p_vehicle_detail_slide__btn next"></div>
                        </div>
                        <div class="p_vehicle_detail_slide__nav swiper">
                            <div class="p_vehicle_detail_slide__nav_inner swiper-wrapper">
                                <?php if ( have_rows('vehicle_detail_slides') ) : ?>
                                    <?php while ( have_rows('vehicle_detail_slides') ) : the_row();
                                        $type = get_sub_field('vehicle_detail_slides_type');
                                        echo '<div class="p_vehicle_detail_slide__nav_item swiper-slide">';
                                        if ( $type === 'image' ) {
                                            $image = get_sub_field('vehicle_detail_slides_image');
                                            if ( $image ) {
                                                echo '<img src="' . esc_url($image['sizes']['thumbnail']) . '" alt="' . esc_attr($image['alt']) . '">';
                                            }
                                        } elseif ( $type === 'youtube' ) {
                                            $youtube_url = get_sub_field('vehicle_detail_slides_youtube');
                                            if ( $youtube_url ) {
                                                echo '<span class="youtube"><img src="' . esc_url(get_youtube_thumbnail($youtube_url)) . '" alt=""></span>';
                                            }
                                        } elseif ( $type === 'mp4' ) {
                                            echo '<span class="mp4">MP4</span>';
                                        }
                                        echo '</div>';
                                    endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php $free_area = get_field( 'vehicle_detail_free' ); ?>
            <div class="p_vehicle_detail_free" data-aos="fade-up"><?php echo !empty($free_area) ? wp_kses_post($free_area) : ''; ?></div>
        </div>
    </section>

    <section class="p_vehicle_detail_other">
        <div class="l_container">
            <p class="p_vehicle_detail_other__en">Other Vehicles</p>
            <div class="p_vehicle_detail_other__main">
                <div class="p_vehicle_detail_other__head" data-aos="fade-up">
                    <h2 class="p_vehicle_detail_other__ttl"><?php echo $term_name; ?></h2>
                    <p class="p_vehicle_detail_other__sub">車輛一覧</p>
                    <div class="p_vehicle_detail_other__btn">
                        <a href="<?php echo esc_url(home_url()); ?>/vehicles_info" class="c_btn02 c_btn">
                            <span>全ての車輛一覧に戻る</span>
                        </a>
                    </div>
                </div>
                <?php
                    $args = array(
                        'post_type'      => 'vehicle_introduction',
                        'posts_per_page' => 3,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'vehicle_introduction_cate',
                                'field'    => 'term_id',
                                'terms'    => $term_id,
                            ),
                        ),
                    );

                    $query = new WP_Query( $args );
                ?>
                <?php if ( $query->have_posts() ) : ?>
                <div class="c_card_groups">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <a href="<?php echo the_permalink(); ?>" class="c_card" data-aos="fade-up">
                        <figure class="c_card__thumb">
                            <?php
                                if ( has_post_thumbnail() ) {
                                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                } else {
                                    $img_url = get_stylesheet_directory_uri().'/assets/images/common/no_image.webp';
                                }
                            ?>
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>">
                        </figure>
                        <h4 class="c_card__title"><?php the_title(); ?></h4>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <?php endif; ?>
                <div class="p_vehicle_detail_other__bot" data-aos="fade-up">
                    <a href="<?php echo esc_url(home_url()); ?>/vehicle-introduction" class="c_btn02 c_btn">
                        <span>全ての車輛一覧に戻る</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>