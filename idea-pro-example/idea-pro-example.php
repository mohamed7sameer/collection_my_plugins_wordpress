<?php
/**
 * Plugin Name: Idea Pro Example
 * Description: This Is Just An Example
 * */

/* part one of the plugin tutorial  */

function ideapro_example_function(){
    $content = "This Is Very Basic Plugin" ;
    $content .= "<div>This is a div</div>" ;
    $content .= "<p>This is a block of paragraph text</p>" ;
    return $content ;
}

add_shortcode( 'example', 'ideapro_example_function' );

/* part 2 of the plugin tutorial */


function ideaPro_admin_menu_option(){
    add_menu_page( 'Header & footer Scripts', 'Site Scripts', 'manage_options', 'ideapro-admin-menu', 'idea_pro_scripts_page', '', 200 );
}
add_action( 'admin_menu', 'ideaPro_admin_menu_option' );

function idea_pro_scripts_page(){
    if(array_key_exists('submit_scripts_update',$_POST)){
        update_option( 'ideapro_header_scripts', $_POST['header_scripts'] );
        update_option( 'ideapro_footer_scripts', $_POST['footer_scripts'] );
        ?>
        <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible">
            <strong>settings have been saved . </strong>
        </div>
        <?php
    }

    $header_scripts = get_option( 'ideapro_header_scripts', '' );
    $footer_scripts = get_option( 'ideapro_footer_scripts', '' );
    
?>
<div class="wrap">
    <h2>Update Scripts</h2>
    <form action="" method="post">
        <label>
            Header Scripts
        <textarea name="header_scripts" class="large-text"><?php print $header_scripts?></textarea>
        </label>
        <label>
            Footer Scripts
        <textarea name="footer_scripts" class="large-text"><?php print $footer_scripts?></textarea>
        </label>
        <input type="submit" name="submit_scripts_update" class="button button-primary" value="UPDATE SCRIPTS" >
    </form>
</div>
<?php
}


function ideapro_display_header_scripts(){
    $header_scripts = get_option( 'ideapro_header_scripts', '' );
    print $header_scripts ;

}

add_action( 'wp_head', 'ideapro_display_header_scripts');

function ideapro_display_footer_scripts(){
    $footer_scripts = get_option( 'ideapro_footer_scripts', '' );
    print $footer_scripts ;
    
}
add_action( 'wp_footer', 'ideapro_display_footer_scripts');

/* part 3 of the plugin tutorial */

function ideapro_form(){
    /* content variable */
    $content =  '';
    $content .= '<form method="post" action="http://127.0.0.1/task4/thank-you/" />' ;
        $content .= '<input type="text" name="full_name" placeholder="Full Name">' ;
        $content .= '<br />';

        $content .= '<input type="text" name="email_address" placeholder="Email Address">' ;
        $content .= '<br />';

        $content .= '<input type="text" name="phone_number" placeholder="Phone Number">' ;
        $content .= '<br />';

        $content .= '<textarea name="comments" placeholder="Give us your Comments"></textarea>' ;
        $content .= '<br />';

        $content .= '<input type="submit" name="ideapro_submit_form" value="Submit Your Information" />';

    $content .= '</form>';
    return $content ;
}

add_shortcode( 'ideapro_contact_form', 'ideapro_form' );


function set_html_content_type(){
    return 'text/html';
}

function ideapro_form_capture(){
    if(array_key_exists('ideapro_submit_form',$_POST)){
        $to = 'mohammed7sameer2617@gmail.com' ;
        $subject = 'Idea Pro Example Site From Submition' ;
        $body = '' ;
        $body .= 'Name: '. $_POST['full_name']. '<br />';
        $body .= 'Email: '. $_POST['email_address']. '<br />';
        $body .= 'Phone: '. $_POST['phone_number']. '<br />';
        $body .= 'Comments'. $_POST['comments']. '<br />';
        add_filter( 'wp_mail_content_type', 'set_html_content_type');
        wp_mail( $to, $subject, $body);
        remove_filter( 'wp_mail_content_type', 'set_html_content_type');
        /*start  part 4 of the plugin tutorial */
        /* insert the information into a comment */
        /*https://developer.wordpress.org/reference/functions/wp_insert_comment/ */
        global $post;
        /*
        $time = current_time('mysql') ;
        $data = array(
            'comment_post_ID' => $post->ID,
            'comment_content' => $body,
            'comment_author_IP' => $_SERVER['REMOTE_ADDR'],
            'comment_date' => $time,
            'comment_approved' => 1
        );
        wp_insert_comment($data);
        */
        /* create table task4_form_submitions{ID:int,data:text} */
        global $wpdb;
        echo '<pre>';
        
        $insertData = $wpdb->get_results("INSERT INTO " .$wpdb->prefix. "form_submitions (`data`) VALUES ('" .$body ."');");
        
        /*end  part 4 of the plugin tutorial */

    }
}

add_action( 'wp_head', 'ideapro_form_capture' );





