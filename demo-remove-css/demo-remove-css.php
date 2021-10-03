<?php
/**
 * Plugin Name: Demo Remove CSS
*/

remove_action( 'wp_print_styles', 'print_imoji_styles' );

function remove_block_library(){
    wp_dequeue_style('wp-block-library');
}

add_action('wp_print_styles', 'remove_block_library');


?>