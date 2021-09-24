<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( 'wyeth-style' ), 
        wp_get_theme()->get('Version') // this only works if you have Version in the style header
    );
}

// add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
// function my_theme_enqueue_styles() {
//     $parenthandle = 'wyeth-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
//     $theme = wp_get_theme();
//     wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
//         array(),  // if the parent theme code has a dependency, copy it to here
//         $theme->parent()->get('Version')
//     );
//     wp_enqueue_style( 'child-style', get_stylesheet_uri(),
//         array( $parenthandle ),
//         $theme->get('Version') // this only works if you have Version in the style header
//     );
// }

// Queue parent style followed by child/customized style
// add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 10);

// function theme_enqueue_styles() {
//     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
//     wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/styles/child-style.css', array( 'parent-style' ) );
// }

// add_action( 'wp_enqueue_scripts()', 'my_theme_enqueue_styles' );
// function my_theme_enqueue_styles() {
//     wp_enqueue_style( 'parent-style', 
// 		get_template_directory_uri() . '/style.css' );
// 	wp_enqueue_style( 'wyeth-style', 
// 		get_template_directory_uri() . '/app.css' );
// 	wp_enqueue_style( 'parent-custom-style', 
// 		get_template_directory_uri() . '/custom.css' );
// 	wp_enqueue_style( 'child-style', 
// 		get_stylesheet_directory_uri() . '/style.css', 
// 		array('parent-style', 'parent-app-style', 'parent-custom-style'), 
// 		wp_get_theme()->get('Version')
// 	);
// }

