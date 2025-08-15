<?php get_header(); ?>
<main class="p_vehicle">
    <div class="c_page_hero">
        <picture class="c_page_hero__image">
            <source media="(max-width: 767px)" srcset="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv_sp.webp">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/other/img_mv.webp" alt="">
        </picture>

        <div class="c_page_hero__content">
            <div class="c_page_hero__heading c_page_heading">
                <h1 class="c_page_heading__mttl u_color_white">
                    車輌紹介
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

    <?php
        $terms = get_terms( array(
            'taxonomy'   => 'vehicle_introduction_cate',
            'hide_empty' => false,
        ) );
    ?>

    <?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :?>
    <div class="p_vehicle_anchor">
        <div class="l_container block">
            <div class="c_inpage_navs archive" data-aos="fade-up">
                <?php foreach ( $terms as $term ) : ?>
                    <div class="c_inpage_nav">
                        <a href="#<?php echo esc_html( $term->slug ); ?>">
                            <?php echo esc_html( $term->name ); ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="p_vehicle_main">
        <?php foreach ( $terms as $index => $term ) : ?>
        <section class="p_vehicle_section" id="<?php echo esc_html( $term->slug ); ?>">
            <div class="l_container block">
                <div class="c_heading_h2" data-aos="fade-up">
                    <span class="u_fs_40 u_f_en c_heading_h2__numb"><?php echo str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></span>
                    <h2 class="u_fs_40 c_heading_h2__mttl"><?php echo esc_html( $term->name ); ?></h2>
                    <span class="u_f_en c_heading_h2__en"><?php echo get_field( 'vehicle_cate_en', $term->taxonomy . '_' . $term->term_id ); ?></span>
                </div>
                <h3 class="c_heading_h3bg c_heading_bg01" data-aos="fade-up">
                    <span class="c_heading_h3bg__main">積載物</span>
                    <span class="c_heading_h3bg__sub"><?php echo get_field( 'vehicle_cate_products', $term->taxonomy . '_' . $term->term_id ); ?></span>
                </h3>
                <p class="p_vehicle_section__txt" data-aos="fade-up"><?php echo esc_html( $term->description ); ?></p>
                <?php
                    $args = array(
                        'post_type'      => 'vehicle_introduction',
                        'posts_per_page' => -1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'vehicle_introduction_cate',
                                'field'    => 'term_id',
                                'terms'    => $term->term_id,
                            ),
                        ),
                    );

                    $query = new WP_Query( $args );
                ?>
                <?php if ( $query->have_posts() ) : ?>
                <div class="c_card_groups">
                    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="c_card" data-aos="fade-up">
                        <figure class="c_card__thumb">
                            <?php
                                if ( has_post_thumbnail() ) {
                                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                } else {
                                    $img_url = get_stylesheet_directory_uri().'/assets/images/common/no_image.webp';
                                }
                            ?>
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title(); ?>">
                        </figure>
                        <h4 class="c_card__title"><?php the_title(); ?></h4>
                        <p class="c_card__catch"><?php echo wp_strip_all_tags(get_field('vehicle_detail_description')); ?></p>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
