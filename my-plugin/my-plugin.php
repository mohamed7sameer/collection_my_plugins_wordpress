<?php
/**
 * Plugin Name: My Plugin
 * Description: This Is Just An Example
 * */
$my_plugin_list = get_option( 'my_plugin_list', [] );

function my_plugin_shortcode(){
    $my_plugin_list = get_option( 'my_plugin_list', [] );
    $data = '<ul>';
    foreach($my_plugin_list as $val){
        $data .= "<li>$val</li>";
    }
    $data .= "</ul>" ;
    return $data ;
}

add_shortcode( 'myplugin', 'my_plugin_shortcode' );



function my_plugin_admin_menu(){
    add_menu_page( 'My Plugin', 'My Plugin', 'manage_options', 'my-plugin-menu', 'my_plugin_content_page', '', 200 );
}
add_action( 'admin_menu', 'my_plugin_admin_menu' );

function my_plugin_content_page(){
    $my_plugin_list = get_option( 'my_plugin_list', [] );
    if(array_key_exists('save_list',$_POST)){
        update_option( 'my_plugin_list', $_POST['list'] );
        ?>
        <div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible">
            <strong>success save setting . </strong>
        </div>
        <?php
    }
    ?>
    <div class="wrap">    
        <h1>this short code is : [myplugin /] </h1>
        <div class="demo">
            <form action="" method="post">
                <a href="javascript:void(0)" id="add" class="button action">+</a>
                <ul id="sortable">
                    <?php
                        foreach($my_plugin_list as $val){
                    ?>
                    <li id="" class="ui-state-default">
                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
                        <input name="list[]" type="text" value="<?= $val ?>" onclick="this.focus()" />
                        <button onclick="deleteIteme(this)">Delete</button>
                     </li>
                    <?php
                        }
                    ?>
                </ul>
            <br><br>
            <hr>
            <br><br>
            <input type="submit" name="save_list" class="button action" value="save">
            </form>       
        </div><!-- End demo -->
    </div>
    <?php
}



function add_styles_and_scripts(){
    wp_enqueue_style( 'my_jquery_uri', plugins_url('assets/css/jquery-ui.min.css',__FILE__) );
    wp_enqueue_style( 'my_jquery_uri_theme', plugins_url('assets/css/jquery-ui.theme.min.css',__FILE__) );
    wp_enqueue_style( 'my_style', plugins_url('assets/css/mystyle.css',__FILE__));
    wp_enqueue_script( 'my_jquery', plugins_url('assets/js/jquery.min.js',__FILE__),null,true,true);
    wp_enqueue_script( 'my_jquery_uri', plugins_url('assets/js/jquery-ui.min.js',__FILE__),null,true,true);
    wp_enqueue_script( 'my_scripts', plugins_url('assets/js/scripts.js',__FILE__),null,true,true);
}

add_action( 'admin_enqueue_scripts', 'add_styles_and_scripts' );



?>




