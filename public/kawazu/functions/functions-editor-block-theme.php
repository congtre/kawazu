<?php

function remove_block_library_style() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
// add_action( 'wp_enqueue_scripts', 'remove_block_library_style' );

function written_enqueue_block_variations() {
	wp_enqueue_script(
		'written-enqueue-block-variations',
		get_stylesheet_directory_uri() . '/assets/js/block-theme/variations.js',
		array( 'wp-blocks', 'wp-dom-ready', 'wp-element', 'wp-primitives', 'wp-edit-post' ),
		wp_get_theme()->get( 'Version' ),
		false
	);
	wp_localize_script(
        'written-enqueue-block-variations',
        'themeData',
        array(
            'templateUrl' => get_stylesheet_directory_uri(),
        )
    );
    wp_enqueue_style( 'custom-editor-css', get_parent_theme_file_uri( '/assets/js/block-theme/editor.css' ));
}
add_action( 'enqueue_block_editor_assets', 'written_enqueue_block_variations' );

function mytheme_block_styles() {
	wp_enqueue_style( 'other', get_parent_theme_file_uri( '/assets/css/other.css' ));
}
add_action( 'enqueue_block_assets', 'mytheme_block_styles' );

add_filter( 'block_categories_all' , function( $categories ) {
	array_unshift( $categories, array(
		'slug'  => 'written-client',
		'title' => 'Custom Theme'
	));

	return $categories;
} );