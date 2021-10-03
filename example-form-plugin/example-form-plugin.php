<?php 
/**
 * Plugin Name: Example Form Plugin
*/

function example_form_plugin(){
    $content = '';
    $content .= '<h2>Contact Us !</h2>';
    $content .= '<form method="post" action="http://127.0.0.1/task4/thank-you/">';
    $content .= '<label for="user_name">Name</label>';
    $content .= '<input type="text" name="your_name" class="form_control" placeholder="Your Name" >';
    $content .= '<label for="your_email">Email</label>';
    $content .= '<input type="email" class="form-control" name="your_email" placeholder="Enter Your Email">';
    $content .= '<label for="your_comments">Questions Or Comments<label>';
    $content .= '<textarea name="your_comments" class="form-control" placeholder="Enter Your Questions Or Comments"></textarea>';
    $content .= '<br/><input type="submit" name="example_form_submit" class="btn btn-primary" value="Send Your Informations">';
    $content .= '</form>';
    return $content ;
}
add_shortcode( 'example_form', 'example_form_plugin' );


function example_form_capture(){
    if(isset($_POST['example_form_submit'])){
        $name = sanitize_text_field($_POST['your_name']);
        $email = sanitize_text_field($_POST['your_email']);
        $comments = sanitize_textarea_field($_POST['your_comments']);
        $to = 'mohammed7sameer2617@gmail.com';
        $subject = 'Test Form Submition';
        $message = "Name : $name <br>Email: $email <br>Comments: $comments";
        wp_mail( $to, $subject, $message);
    }
}

add_action( 'wp-head', 'example_form_capture');

?>