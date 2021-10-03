<?php

/**
 * Plugin Name: Demo Bootstrap Css
*/

function demo_include_bootstrap(){
    // wp_enqueue_style( 'my_bootstrap', plugin_dir_url( __FILE__ ).'assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'my_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css' );
    wp_enqueue_script( 'my_script', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js' );
}

add_action( 'wp_enqueue_scripts', 'demo_include_bootstrap' );

?>