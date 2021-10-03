<?php

/**
 * Plugin Name: Admin Dashboard Widget
*/

function admin_dashboard_widget(){
    wp_add_dashboard_widget( 'admin_dashboard_widget', 'Admin Dashboard Widget', 'admin_dashboard_widget_callback' );
}

add_action( 'wp_dashboard_setup', 'admin_dashboard_widget');


function admin_dashboard_widget_callback(){
    echo 'hello dashboard' ;
}