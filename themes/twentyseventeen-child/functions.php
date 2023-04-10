<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'twentyseventeen-style', get_template_directory_uri() . '/style.css', array());
    wp_enqueue_style( 'twentyseventeen-child-style',
        get_stylesheet_uri(),
        array( 'twentyseventeen-style' ),
        wp_get_theme()->get( 'Version' ) // This only works if you have Version defined in the style header.
    );
}
