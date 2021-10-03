<?php

/**
 * Plugin Name: Idea Pro Custom Post Type
 * 
*/

function ideapro_custom_post_type(){
    register_post_type(
        'Example',
        array(
            'labels' => array(
                'name'=> __('Examples'),
                'singular_name' => __('Example') ,
                'add_new' => __('Add New Example'),
                'add_new_item' => __('Add New Example'),
                'edit_item' => __('Edit Example'),
                'search_items' => __('Search Examples')
            ),
            'manu_position' => 5,
            'public' => true,
            'exclude_from_search' => true,
            'has_archive' => false,
            'register_meta_box_cb' => 'example_metabox',
            'supports' => array(
                'title',
                'editor',
                'thumbnail'
            )
        )
    );
}

add_action( 'init', 'ideapro_custom_post_type' );


function get_example_post_types(){
    $args = array(
        // 'posts_per_page' => -1,
        'numberposts' => -1,
        'post_type' => 'example'
    );
    $ourPosts = get_posts($args);
    // echo '<pre>' ;
    // print_r($ourPosts) ;
    $content = '';
    foreach($ourPosts as $key=>$val){
        // print $val->ID . "<br>";
        $content .= "<a href='". get_permalink($val->ID) ."'><b>$val->post_title . </b></a><br>";
        $content .= $val->post_content . "<hr>";
    }
    return $content ;
}
add_shortcode( 'get_example_posts', 'get_example_post_types' );




function example_metabox(){
    add_meta_box( 'example_metabox_customfields', 'Example Custom Fields', 'example_metabox_display','example','normal','high') ;
}

add_action('add_meta_boxes', 'example_metabox');

function example_metabox_display(){
    global $post;
    $sub_title = get_post_meta($post->ID,'sub_title',true);
    $author_name = get_post_meta($post->ID,'author_name',true);
    ?>
    <label>
        Sub Title
        <input type="text" value="<?php print $sub_title ?>" name="sub_title" placeholder="Sub Title" class="widefat">
    </label>
    <br><br>
    <label>
        Authors Name
        <input type="text" value="<?php print $author_name ?>" name="author_name" placeholder="Authors Name" class="widefat">
    </label>
    <?php
}



function example_posttype_save($post_id){
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    if($is_revision || $is_autosave){
        return ;
    }
    $post = get_post( $post_id);
    if($post->post_type == "example"){
        /* save the custom field data */
        if(array_key_exists('sub_title',$_POST)){
            update_post_meta( $post_id, 'sub_title', $_POST['sub_title']);
        }
        if(array_key_exists('author_name',$_POST)){
            update_post_meta( $post_id, 'author_name', $_POST['author_name']);
        }
    }
}
add_action('save_post','example_posttype_save');

