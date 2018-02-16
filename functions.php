<?php

if (isset($_GET["cid"])) {
    setcookie("cid", $_GET["cid"], time() + 60 * 60 * 3);
}
if (isset($_GET["subacc"])) {
    setcookie("subacc", $_GET["subacc"], time() + 60 * 60 * 3);
}
if (isset($_GET["kwrd"])) {
    setcookie("kwrd", $_GET["kwrd"], time() + 60 * 60 * 3);
}
if (isset($_GET["clcid"])) {
    setcookie("clcid", $_GET["clcid"], time() + 60 * 60 * 3);
}

$my_theme = wp_get_theme();
$tm_ver=$my_theme->get( 'Version' );

// mapping cid
function cid_map($cid){
    $ruls_list=explode(',',get_option('cid_ruls'));
    if($ruls_list){
        foreach($ruls_list as $v){
            $rul=explode('=',trim($v));
            if(isset($rul[0]) && $rul[0]){
                if ($cid == trim($rul[0])) {
                    $cid = trim($rul[1]);
                }
            }
        }
    }
    return $cid;
}

// get or coockie
function getParam($key) {
    $value = null;

    if (isset($_GET[$key])) {
        $value = $_GET[$key];
    } else {
        if (isset($_COOKIE[$key])) {
            $value = $_COOKIE[$key];
        }
    }

    return $value;
}

function auto_loader($class_name) {
    if ((substr($class_name, 0, 5) !== 'Deka_') && (substr($class_name, 0, 10) !== 'ReCaptcha_')) {
        return;
    }
    $class = str_replace('_', '/', $class_name);
    $path = realpath( get_template_directory() ).'/src/'.$class.'.php';
    if (is_readable($path)) {
        require_once $path;
    }
}
spl_autoload_register('auto_loader');

//add_filter( 'wp_title', 'baw_hack_wp_title_for_home' );
function baw_hack_wp_title_for_home( $title )
{
  if( empty( $title ) && ( is_home() || is_front_page() ) ) {
    return __( 'HOME') . ' | ';
  }
  return $title;
}
/* options */
add_option( 'deka_site_key', '6Lf8QQ0UAAAAAJr2uZvIzG6PtKPw0mJ2dex9GaHB');
add_option( 'deka_secret_key', '6Lf8QQ0UAAAAAJTdiSpP19-7WK-EiCFFJ6bLX2DJ');
add_option( 'deka_contact_address', 'customerservice@bizfella.co.uk');
add_option( 'deka_fb', 'https://www.facebook.com/');
add_option( 'deka_twitter', 'https://twitter.com/');
add_option( 'deka_linkedin', 'https://www.linkedin.com/');
add_option( 'deka_instagram', 'https://www.instagram.com/');
add_option( 'deka_css',"" );
add_option( 'deka_script_head',"" );
add_option( 'deka_script_footer',"");
add_option( 'deka_noscript_footer','' );

add_option( 'default_cid',"10000" );
$script='<script src="https://form.t3leads.com/api/init/23/{{$affiliate_id}}"  id="t3v3_form" type="text/javascript"></script>';
$script.="<script>";
$script.="var form_params = { 
                parse_defaults: true,
                style_settings:{},
                tags: {{tags}}
            };
            var form = new Form(form_params);" ;
$script.="</script>";
add_option( 'form_script',$script );
add_option( 'cid_ruls',"" );
add_option( 'footer_text',"Bizfella Ltd.  Company registered address: 5300 Lakeside | Cheadle Royal Business Park | Cheadle | Cheshire SK8 3GP. Registered company number 09219302<br>
                Authorised and regulated by the Financial Conduct Authority (reference number 719923)" );
add_option( 'orange-footer_top_text',"Need a car and a loan? <i>...or are you looking for a loan for a car?</i> " );
add_option( 'orange-footer_bottom_text',"<i>We drive a better deal for you!</i> " );
add_option( 'deka_calc_rate',"9" );
add_option( 'deka_site_id',"29" );

function admin_generate_menu()
{
    add_menu_page('Site options', 'Site Options', 'manage_options', 'deka-admin', 'show_deka_admin');
}
function page_init()
{
    register_setting('deka-settings-group', 'deka_site_key');
    register_setting('deka-settings-group', 'deka_secret_key');
    register_setting('deka-settings-group', 'deka_contact_address');
    register_setting('deka-settings-group', 'deka_fb');
    register_setting('deka-settings-group', 'deka_twitter');
    register_setting('deka-settings-group', 'deka_linkedin');
    register_setting('deka-settings-group', 'deka_instagram');
    register_setting('deka-settings-group', 'deka_css');
    register_setting('deka-settings-group', 'deka_script_head');
    register_setting('deka-settings-group', 'deka_script_footer');
    register_setting('deka-settings-group', 'deka_noscript_footer');

    register_setting('deka-settings-group', 'default_cid');
    register_setting('deka-settings-group', 'form_script');
    register_setting('deka-settings-group', 'cid_ruls');

    register_setting('deka-settings-group', 'orange-footer_top_text');
    register_setting('deka-settings-group', 'orange-footer_bottom_text');
    register_setting('deka-settings-group', 'footer_text');
    register_setting('deka-settings-group', 'deka_calc_rate');
    register_setting('deka-settings-group', 'deka_site_id');
}
function show_deka_admin()
{
    include_once('show_deka_admin.php');
}
if (!is_admin()) {
    add_shortcode('get_started', 'show_get_started');
    add_shortcode('privacy', 'show_privacy');
    add_shortcode('terms', 'show_terms');
    add_shortcode('faq', 'show_faq');
    add_shortcode('complaints', 'show_complaints');
    add_shortcode('calculator', 'show_calculator');
}
/*------------------------------------------------*/

function show_get_started(){
    $cid = getParam("cid");
    $cid = $cid ? cid_map($cid) : get_option('default_cid');
    $form_script=get_option('form_script');
    $form_script = str_replace('{{$affiliate_id}}', $cid , $form_script);
    $tags = array(
        "subacc" => getParam("subacc"),
        "kwrd"   => getParam("kwrd"),
        "clcid"  => getParam("clcid"),
    );
    $tags = array_filter($tags);
    $tags_string = $tags ? json_encode($tags) : "{}";
    $form_script = '<div style="margin-top: 20px;">'.str_replace('{{tags}}', $tags_string , $form_script).'</div>';
    ob_start();
    echo $form_script;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function get_content($str){
    $out=Deka_Privacy::get($str);
    $out = str_replace('.html', "/" , $out);
    $out = str_replace('<a href="', '<a href="/' , $out);
    $out = str_replace("<a href='", "<a href='/" , $out);
    $out = str_replace('<a href="/mailto:', '<a href="mailto:' , $out);
    return $out;
}

function show_privacy(){
    $out= Deka_Privacy::get('ukprivacynew');
    ob_start();
    echo $out;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function show_terms(){
    $out= get_content('ukpaydaytcnew');
    ob_start();
    echo $out;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
function show_faq(){
    ob_start();
    echo Deka_Privacy::get('faquk');
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
function show_complaints(){
    ob_start();
    echo Deka_Privacy::get('ukcomplaints');
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
function show_calculator($atts){
    $color='blue';
    extract(shortcode_atts(array(
        'color' => 'blue',
    ), $atts));
    ob_start();
    if($color!='blue' && $color!='orange'){
        $color='blue';
    }
    ?>
    <div class="car_<?php echo $color; ?>_box overflow-hidden">
        <div class="cars_wrapper">
            <div class="cars_calc_block overflow-hidden">
                <div class="bl_wrapper">
                    <?php get_template_part( 'calculator' ); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

function wp_scripts_styles() {
    global $tm_ver;
    wp_register_style('jquery_ui_css', get_template_directory_uri().'/css/jquery-ui.min.css');
    wp_register_style('bt_css', get_template_directory_uri().'/css/bootstrap.min.css');
    wp_register_style('font_awesome', get_template_directory_uri().'/css/font-awesome.min.css');
    wp_register_style('style', get_template_directory_uri().'/css/style.css',array(),$tm_ver);
    wp_register_style('mediawp', get_template_directory_uri().'/css/media.css',array(),$tm_ver);
    wp_register_script('jquery', get_template_directory_uri().'/js/jquery.min.js');
    wp_register_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js');
    wp_register_script('jquery_ui', get_template_directory_uri().'/js/jquery-ui.min.js');
    wp_register_script('jquery_touch', get_template_directory_uri().'/js/jquery.ui.touch-punch.min.js');
    wp_register_script('dekascript', get_template_directory_uri() . '/js/script.js',array(),$tm_ver);
    wp_register_script('infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js');
    wp_localize_script( 'dekascript', 'dekascript_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( "deka_nonce" ), 'img'=> get_template_directory_uri() . '/imgs/download.svg' ) );
    wp_enqueue_style('jquery_ui_css');
    wp_enqueue_style('bt_css');
    wp_enqueue_style('font_awesome');
    wp_enqueue_style('style');
    wp_enqueue_style('mediawp');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('jquery_ui');
    wp_enqueue_script('jquery_touch');
    wp_enqueue_script('infinitescroll');
    wp_enqueue_script('dekascript');
    wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
    wp_enqueue_script('recaptcha');

    $body_classes = get_body_class();
    if(in_array("blog", $body_classes)) {
        wp_register_script('dekaslider', get_template_directory_uri() . '/js/slider.js',array(),$tm_ver);
        wp_enqueue_script('dekaslider');
    }


}

if ( !is_nav_menu('top') ) {
    $menu_id = wp_create_nav_menu('top');
    wp_update_nav_menu_item($menu_id, 2);
}
if ( !is_nav_menu('bottom') ) {
    $menu_id = wp_create_nav_menu('bottom');
    wp_update_nav_menu_item($menu_id, 1);
}
if (function_exists('register_sidebar')) {

    register_sidebar(array(
        'name' => 'Sidebar',
        'id'   => 'sidebar',
        'description'   => 'This is the widgetized sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>'
    ));

}

function register_my_menus() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Header Menu' ),
      'bottom-menu' => __( 'Footer Menu' )
    )
  );
}
/*------------------ new table activation-----------------------*/
function deka_cache_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'deka_cache';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		id int(10) unsigned NOT NULL AUTO_INCREMENT,
		date_expire datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		title varchar(255) NOT NULL,
		content text NULL,
		PRIMARY KEY (`id`),
        UNIQUE KEY `title` (`title`)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
/*---------------------------------------------------------------*/

/*------empty cache ajax-------------*/

function empty_cache_callback() {
    $response="Success";
	if(!Deka_Privacy::emptyCache()){
        $response="Error";
    }
    echo $response;
	wp_die();
}

/*------------------------------------*/
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2)+1;

    global $paged;
    if(empty($paged)) $paged = 1;

    if($pages == '')
    {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages)
        {
            $pages = 1;
        }
    }

    if(1 != $pages)
    {
        echo "<div class=\"pagination\"><span class='pages_text'>Page ".$paged." of ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

        for ($i=1; $i <= $pages; $i++)
        {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
            {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
            }
        }

        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
        echo "</div>\n";
    }
}

function my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div class="head_wrapper_blue"><div class="block_head blue"><h2>' . __( 'SEARCH' ) . '</div></div>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="" />
    </div>
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form', 100 );

/*------add meta box -----*/
function add_post_meta_boxes() {
    global $post;
    $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

    if($pageTemplate == 'templates/homepage.php' ) {
        add_meta_box(
            'home_page_next_to_calc',        // Unique ID
            'Text next to loan calculator',            // Title
            'next_to_calc_box',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'home_page_blue_box_left',        // Unique ID
            'Left part of Blue box',            // Title
            'blue_box_left',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'home_page_blue_box_right',        // Unique ID
            'Right part of Blue box',            // Title
            'blue_box_right',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'home_page_next_to_bb',        // Unique ID
            'Text next to Blue box',            // Title
            'next_to_bb',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'home_page_faq_left',        // Unique ID
            'FAQ block left side',            // Title
            'faq_left',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'home_page_faq_right',        // Unique ID
            'FAQ block right side',            // Title
            'faq_right',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );

    }
    if($pageTemplate == 'templates/contacts.php' ) {
        add_meta_box(
            'contacts_email_us',        // Unique ID
            'Email Us',            // Title
            'email_us',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'contacts_phone_us',        // Unique ID
            'Phone Us',            // Title
            'phone_us',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'contacts_write_us',        // Unique ID
            'Write Us',            // Title
            'write_us',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'contacts_tel',        // Unique ID
            'Phone',            // Title
            'contact_tel',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'contacts_address',        // Unique ID
            'Address',            // Title
            'contact_address',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'contacts_complaints',        // Unique ID
            'Complaints',            // Title
            'contacts_complaints',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'contacts_before_footer',        // Unique ID
            'Text before footer',            // Title
            'before_footer',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
    }
    if($pageTemplate == 'templates/cars.php' ) {
        add_meta_box(
            'cars_posts',        // Unique ID
            'Cars section',            // Title
            'cars_posts',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'cars_calc',        // Unique ID
            'Calculator section',            // Title
            'cars_calc',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );
        add_meta_box(
            'cars_blog',        // Unique ID
            'Blog section',            // Title
            'cars_blog',        // Callback function
            'page',                    // Admin page (or post type)
            'normal',                // Context
            'high'                    // Priority
        );

    }

    add_meta_box(
        'second_title',        // Unique ID
        'Second Title',            // Title
        'second_title',        // Callback function
        'page',                    // Admin page (or post type)
        'normal',                // Context
        'high'                    // Priority
    );
    add_meta_box(
        'car_price',        // Unique ID
        'Car Price',            // Title
        'car_price',        // Callback function
        'cars',                    // Admin page (or post type)
        'side',                // Context
        'high'                    // Priority
    );

    add_meta_box(
        'post_view_count',        // Unique ID
        'View count',            // Title
        'post_view_count',        // Callback function
        'post',                    // Admin page (or post type)
        'side',                // Context
        'high'                    // Priority
    );
    add_meta_box(
        'post_trending',        // Unique ID
        'Trending',            // Title
        'post_trending',        // Callback function
        'post',                    // Admin page (or post type)
        'side',                // Context
        'high'                    // Priority
    );


}
function next_to_calc_box( $object) { ?>
    <?php wp_nonce_field( 'save_next_to_calc_box', 'next_to_calc_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="next_to_calc" id="next_to_calc"><?php echo esc_html( get_post_meta( $object->ID, 'next_to_calc', true ) ); ?></textarea>
<?php }
function blue_box_left( $object) { ?>
    <?php wp_nonce_field( 'save_blue_box_left_box', 'blue_box_left_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="blue_box_left" id="blue_box_left"><?php echo esc_html( get_post_meta( $object->ID, 'blue_box_left', true ) ); ?></textarea>
<?php }
function blue_box_right( $object) { ?>
    <?php wp_nonce_field( 'save_blue_box_right_box', 'blue_box_right_nonce' ); ?>
    <textarea class="widefat" style="height: 160px;" autocomplete="off" cols="40" name="blue_box_right" id="blue_box_right"><?php echo esc_html( get_post_meta( $object->ID, 'blue_box_right', true ) ); ?></textarea>
<?php }
function next_to_bb( $object) { ?>
    <?php wp_nonce_field( 'save_next_to_bb_box', 'next_to_bb_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="next_to_bb" id="next_to_bb"><?php echo esc_html( get_post_meta( $object->ID, 'next_to_bb', true ) ); ?></textarea>
<?php }
function faq_left( $object) { ?>
    <?php wp_nonce_field( 'save_faq_left_box', 'faq_left_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="faq_left" id="faq_left"><?php echo esc_html( get_post_meta( $object->ID, 'faq_left', true ) ); ?></textarea>
<?php }
function faq_right( $object) { ?>
    <?php wp_nonce_field( 'save_faq_right_box', 'faq_right_nonce' ); ?>
    <textarea class="widefat" style="height: 150px;" autocomplete="off" cols="40" name="faq_right" id="faq_right"><?php echo esc_html( get_post_meta( $object->ID, 'faq_right', true ) ); ?></textarea>
<?php }


function email_us( $object) { ?>
    <?php wp_nonce_field( 'save_email_us_box', 'email_us_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="email_us" id="email_us"><?php echo esc_html( get_post_meta( $object->ID, 'email_us', true ) ); ?></textarea>
<?php }
function phone_us( $object) { ?>
    <?php wp_nonce_field( 'save_phone_us_box', 'phone_us_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="phone_us" id="phone_us"><?php echo esc_html( get_post_meta( $object->ID, 'phone_us', true ) ); ?></textarea>
<?php }
function write_us( $object) { ?>
    <?php wp_nonce_field( 'save_write_us_box', 'write_us_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="write_us" id="write_us"><?php echo esc_html( get_post_meta( $object->ID, 'write_us', true ) ); ?></textarea>
<?php }
function contact_tel( $object) { ?>
    <?php wp_nonce_field( 'save_contact_tel_box', 'contact_tel_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="contact_tel" id="contact_tel"><?php echo esc_html( get_post_meta( $object->ID, 'contact_tel', true ) ); ?></textarea>
<?php }
function contact_address( $object) { ?>
    <?php wp_nonce_field( 'save_contact_address_box', 'contact_address_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="contact_address" id="contact_address"><?php echo esc_html( get_post_meta( $object->ID, 'contact_address', true ) ); ?></textarea>
<?php }
function contacts_complaints( $object) { ?>
    <?php wp_nonce_field( 'save_contacts_complaints_box', 'contacts_complaints_nonce' ); ?>
    <textarea class="widefat" style="height: 60px;" autocomplete="off" cols="40" name="contacts_complaints" id="contacts_complaints"><?php echo esc_html( get_post_meta( $object->ID, 'contacts_complaints', true ) ); ?></textarea>
<?php }
function before_footer( $object) { ?>
    <?php wp_nonce_field( 'save_before_footer_box', 'before_footer_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="before_footer" id="before_footer"><?php echo esc_html( get_post_meta( $object->ID, 'before_footer', true ) ); ?></textarea>
<?php }

function second_title( $object) { ?>
    <?php wp_nonce_field( 'save_second_title_box', 'second_title_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="second_title" id="second_title"><?php echo esc_html( get_post_meta( $object->ID, 'second_title', true ) ); ?></textarea>
<?php }

function cars_posts( $object) { ?>
    <?php wp_nonce_field( 'save_cars_posts_box', 'cars_posts_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="cars_posts" id="cars_posts"><?php echo esc_html( get_post_meta( $object->ID, 'cars_posts', true ) ); ?></textarea>
<?php }
function cars_calc( $object) { ?>
    <?php wp_nonce_field( 'save_cars_calc_box', 'cars_calc_nonce' ); ?>
    <textarea class="widefat" style="height: 50px;" autocomplete="off" cols="40" name="cars_calc" id="cars_calc"><?php echo esc_html( get_post_meta( $object->ID, 'cars_calc', true ) ); ?></textarea>
<?php }
function cars_blog( $object) { ?>
    <?php wp_nonce_field( 'save_cars_blog_box', 'cars_blog_nonce' ); ?>
    <textarea class="widefat" style="height: 30px;" autocomplete="off" cols="40" name="cars_blog" id="cars_blog"><?php echo esc_html( get_post_meta( $object->ID, 'cars_blog', true ) ); ?></textarea>
<?php }
function car_price( $object) { ?>
    <?php wp_nonce_field( 'save_car_price_box', 'car_price_nonce' ); ?>
    <?php
    $car_price=20000;
    if(get_post_meta( $object->ID, 'car_price', true )){
        $car_price=get_post_meta( $object->ID, 'car_price', true );
    }

    ?>
    <label for="car_price">Car Price £</label>
    <input class="widefat" type="number" value="<?php echo esc_html($car_price); ?>" style="" autocomplete="off"  name="car_price" id="car_price" >
    <?php echo calculate_credit($object->ID); ?>
<?php }

function post_view_count( $object) { ?>
    <?php wp_nonce_field( 'save_post_view_count_box', 'post_view_count_nonce' ); ?>
    <?php
    $view_count=0;
    if(get_post_meta( $object->ID, 'post_view_count', true )){
        $view_count=get_post_meta( $object->ID, 'post_view_count', true );
    }
    ?>
    <input class="widefat" type="number" value="<?php echo esc_html($view_count); ?>" style="" autocomplete="off"  name="post_view_count" id="post_view_count" >
<?php }
function post_trending( $object) { ?>
    <?php wp_nonce_field( 'save_post_trending_box', 'post_trending_nonce' ); ?>
    <?php
    $order=0;
    if(get_post_meta( $object->ID, 'post_trending', true )){
        $order=get_post_meta( $object->ID, 'post_trending', true );
    }
    else {
        if(add_post_meta($object->ID, 'post_trending', 1, true)){
            $order=1;
        }
    }

    ?>
    <select class="widefat"   style="" autocomplete="off"  name="post_trending" id="post_trending" >

        <option <?php if(!$order) echo 'selected'; ?> value="0">No</option>
        <option <?php if($order) echo 'selected'; ?> value="1">Yes</option>

    </select>
<?php }

function save_extra_fields( $post_id) {
    global $post;

   // $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
   // if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
   //     return $post_id;
    new_update_meta('next_to_calc', $post_id,"Whatever your credit rating <b>we’ll find the right finance for you!</b>");
    new_update_meta('blue_box_left', $post_id,"<strong>caragogo:</strong> getting you a better car finance deal");
    new_update_meta('blue_box_right', $post_id,'<div>The progress is simple and straightforward.</div>
<ul>
<li>Get approved for your loan</li>
<li>Choose the vehicle you want</li>
<li>Sign documents and arrange to collect the vehicle</li>   
<li>Drive away</li>
</ul>');
    new_update_meta('next_to_bb', $post_id,"‘Caragogo is a broker <b>not a lender</b>’");
    new_update_meta('faq_left', $post_id,"<strong>caragogo:</strong> Not too sure? Here’s a few Q&A’s");
    new_update_meta('faq_right', $post_id,'<div class="q"><div class="col-xs-1">Q:</div><div class="col-xs-11">Does Caragago charge a fee to connect consumers with independent third party Financial Service Providers?</div></div>
<div class="a"><div class="col-xs-1">A:</div><div class="col-xs-11">We do not charge you any fees to use Caragago. <a href="/how-it-works">Read more</a></div></div>
<div class="q"><div class="col-xs-1">Q:</div><div class="col-xs-11">Is the information I provide secure? </div></div>
<div class="a"><div class="col-xs-1">A:</div><div class="col-xs-11">Your use of our services is strictly voluntary and is governed by our Terms & Conditions of Use and Privacy Policy.  <a href="/how-it-works">Read more</a></div></div>
<div class="q"><div class="col-xs-1">Q:</div><div class="col-xs-11">Will independent third party Financial Service Providers perform a credit check?</div></div>
<div class="a"><div class="col-xs-1">A:</div><div class="col-xs-11">Independent Financial Service Providers may perform a credit check or otherwise verify your information.  <a href="/how-it-works">Read more</a></div></div>
<a href="/how-it-works" class="float-right more_button">more</a>');

    new_update_meta('email_us', $post_id,"<h2>Email us</h2>If you email us on {{email}}, we’ll get back to you as quickly as possible within office hours. Or alternatively you can use our mail box here.");
    new_update_meta('phone_us', $post_id,"<h2>Phone us</h2>Our phone line is open 10am – 4pm Monday to Friday, for any issues you may have.");
    new_update_meta('write_us', $post_id,"<h2>Write to us</h2><div>If you would like to contact us in writing, you can send us mail addressed to:</div><div>Please note that we do not accept visitors to the offices.</div>");
    new_update_meta('contact_tel', $post_id,"0161 246 6221");
    new_update_meta('contact_address', $post_id,"<div>Bizfella Ltd.</div><div>5300 Lakeside</div><div>Cheadle</div><div>Cheshire</div><div>SK8 3GP</div><div>United Kingdom</div>");
    new_update_meta('contacts_complaints', $post_id,"<h2>Compliants Handling Procedures</h2>If you have a specific question or complaint, we would like to know about it as it is important for us to stay aware of any problems you may have in using our websites and services. To learn more about making a complaint click <a href='/complaints'>here</a>.");
    new_update_meta('before_footer', $post_id,"Whatever your credit rating <b>we’ll find the right finance for you!</b>");
    new_update_meta('post_view_count', $post_id,"");
    new_update_meta('post_trending', $post_id,"");
    new_update_meta('cars_posts', $post_id,"A selection of the best of the rest");
    new_update_meta('cars_calc', $post_id,"Take a look at how much you’d pay monthly with our <span>budget calculator</span> ");
    new_update_meta('cars_blog', $post_id,"Our latest blogs");
    new_update_meta('car_price', $post_id,"");
    new_update_meta('second_title', $post_id,"");

}
function new_update_meta($meta_name, $post_id, $default_value=""){

    if (isset( $_POST[$meta_name.'_nonce'] ) && wp_verify_nonce( $_POST[$meta_name.'_nonce'], 'save_'.$meta_name.'_box' ) ){

        /* Get the posted data and sanitize it for use as an HTML class. */
        $new_meta_value = ( isset( $_POST[$meta_name] ) && $_POST[$meta_name]  ? balanceTags( $_POST[$meta_name] ) : $default_value );

        if (!add_post_meta($post_id, $meta_name, $new_meta_value, true)) {
            update_post_meta($post_id, $meta_name, $new_meta_value);
        }

    }
    else{
        return $post_id;
    }
}
add_action('add_meta_boxes', 'add_post_meta_boxes');
add_action('save_post', 'save_extra_fields');

function calculate_credit($post_ID){
    $car_price=20000;
    $percent=10;
    if(get_option('deka_calc_rate')){
        $percent=get_option('deka_calc_rate');
    }
    if(get_post_meta( $post_ID, 'car_price', true )){
        $car_price=get_post_meta( $post_ID, 'car_price', true );;
    }
    $month=48;
    $j=$percent/100/12;
    $PM = $car_price*$j/(1 - pow((1 + $j), (-1*$month)));
    $total=$PM*$month;
    $cost=$total-$car_price;
    setlocale(LC_MONETARY, 'en_GB');
    $str="<p><strong>".$month." months at £".formatMoney($PM)." per month</strong></p>
          <p>Total repayment <strong>£".formatMoney($total)."</strong></p>
          <p>Total cost of credit <strong>£".formatMoney($cost)."</strong></p>
          <p>Based on <strong>".$percent."%</strong> APR on good credit score</p>
          <input id='month' type='hidden' value='".$month."'>
          <input id='car_price' type='hidden' value='".$car_price."'>";
    return $str;
}
function formatMoney($number, $fractional=false) {
    $number=round($number,0);
    if ($fractional) {
        $number = sprintf('%.2f', $number);
    }
    while (true) {
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
        if ($replaced != $number) {
            $number = $replaced;
        } else {
            break;
        }
    }
    return $number;
}
/*------end of adding meta box -----*/

function optout_callback()
{
    $status = 'error';
    $site_id=get_option('deka_site_id');
    $message = 'Unsubscribe did not go through. Please try again.';
    if(check_ajax_referer( 'deka_nonce', 'security',false ) && isset($_POST['phone']) && $_POST['phone'] && isset($_POST['email']) && $_POST['email'] &&isset($_POST['resp']) && $_POST['resp']) {
        $secret = get_option('deka_secret_key');
        $phone=trim($_POST['phone']);
        $email=trim($_POST['email']);
        $resp=$_POST['resp'];
        if ($phone && $email && $resp) {
            $recaptcha = new ReCaptcha_ReCaptcha($secret);
            $resp = $recaptcha->verify($resp, $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()) {
                $phone =  str_replace('-', '', $phone);
                $phone =  str_replace(' ', '', $phone);
                $phone =  str_replace('+', '', $phone);
                if ($email) {
                    $pattern = '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/';
                    $match = preg_match($pattern,$email);
                    if ($match != false) {
                        if ($phone) {
                            $pattern = "/^(\(?07\d{9}\)?)$/";
                            $match = preg_match($pattern,$phone);
                            if ($match != false){
//                                $data = array(
//                                    'email' => $email,
//                                    'phone' => $phone,
//                                    'source' => $_SERVER['HTTP_HOST']
//                                );
                                //open connection
                                $ch = curl_init();
                                //set the url, number of POST vars, POST data
                                //curl_setopt($ch, CURLOPT_URL, "https://gb-leads.t3leads.com/optout?key=^VQi9DORaH[KT-GjHc9");
                                curl_setopt($ch, CURLOPT_URL, "https://v3a.t3leads.com/api/do-not-contact-list/global/gb?key=4AFuwb85TcfaWRPH&email=".$email."&phone=".$phone."&source_type=1&source_id=".$site_id);
                                //curl_setopt($ch, CURLOPT_POST, 1);
                                //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                                //execute post
                                $result = curl_exec($ch);
                                //close connection
                                curl_close($ch);

                                $result = @json_decode($result, 1);
                                if ($result['email'] == 'true' && $result['phone'] == 'true') {
                                    $status = 'success';
                                    $message = 'You have successfully opted out. Please allow up to 5 working days for changes to take effect.';
                                }

                            }
                            else{
                                $message = 'You have entered wrong phone format. Please try again.';
                            }
                        } else {
                            $message = 'Sorry, Phone field  can not be empty. Please try again.';
                        }
                    }
                    else{
                        $message = 'You have entered wrong email format. Please try again.';
                    }
                } else {
                    $message = 'Sorry, Email field  can not be empty. Please try again.';
                }
            }
        }
    }
    $response=array('status'=>$status,'message'=>$message);
    echo json_encode($response);
    die();
}
function contacts_callback()
{
    $status = 'error';
    $message = 'Message did not go through. Please try again.';
    if(check_ajax_referer( 'deka_nonce', 'security',false ) && isset($_POST['message']) && $_POST['message'] && isset($_POST['name']) && $_POST['name'] && isset($_POST['email']) && $_POST['email'] &&isset($_POST['resp']) && $_POST['resp']) {
        $secret = get_option('deka_secret_key');
        $to=get_option('deka_contact_address');
        $subj=htmlspecialchars(trim($_POST['subj']));
        $name=htmlspecialchars(trim($_POST['name']));
        $email=trim($_POST['email']);
        $mess_txt=htmlspecialchars(trim($_POST['message']));
        $resp=$_POST['resp'];
        if ($subj && $name && $mess_txt && $email && $resp) {
            $recaptcha = new ReCaptcha_ReCaptcha($secret);
            $resp = $recaptcha->verify($resp, $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()) {
                if ($email) {
                    $pattern = '/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/';
                    $match = preg_match($pattern,$email);
                    if ($match != false) {

                            $affiliate_id=(isset($_COOKIE['cid']) && $_COOKIE['cid']) ? cid_map($_COOKIE['cid']) : get_option('default_cid');
                            $mail_body = "Site: " . $_SERVER['HTTP_HOST'];
                            $mail_body .= "<br>AffID: " .$affiliate_id;
                            $mail_body .= "<br>E-mail : " . $email;
                            $mail_body .= "<br>Ip: " . $_SERVER['REMOTE_ADDR'];
                            $mail_body .= "<br><br>$mess_txt<br>";

                            include_once(ABSPATH . WPINC . '/class-phpmailer.php');
                            $mail = new PHPMailer();
                            $mail->IsSMTP();
                            try {
                                $mail->CharSet = 'UTF-8';
                                $mail->Host       = "smtp.t3leads.com"; // SMTP server example
                                $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
                                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                                $mail->Port       = 465;                    // set the SMTP port
                                $mail->SMTPSecure = "ssl";
                                $mail->Username   = "contactform@t3leads.com"; // SMTP account username example
                                $mail->Password   = "ufr7f765fr&%$#";        // SMTP account password example
                                $mail->SetFrom('contactform@t3leads.com', 'contact form');
                                $mail->Subject    = $subj;
                                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
                                $mail->MsgHTML($mail_body);
                                $mail->AddReplyTo($email, $name);
                                $mail->AddAddress($to);
                                $mail->Send();
                                $status = 'success';
                                $message = 'Thank You.Your message has been successfully sent.';
                            }
                            catch (phpmailerException $e) {
                                //$message = 'Message did not go through. Please try again. '. $e->errorMessage();
                                $message = 'Message did not go through. Please try again.';
                                $response=array('status'=>$status,'message'=>$message);
                                echo json_encode($response);
                                die();
                                //error messages from PHPMailer
                            }
                            catch (Exception $e) {
                                //$message = 'Message did not go through. Please try again. '. $e->getMessage();
                                $message = 'Message did not go through. Please try again.';
                                $response=array('status'=>$status,'message'=>$message);
                                echo json_encode($response);
                                die();
                                //error messages from anything else!
                            }
//                            $mail_body = "Site: " . $_SERVER['HTTP_HOST'];
//                            $mail_body .= "\r\nAffID: " . $affiliate_id;
//                            $mail_body .= "\r\nName : " . $name;
//                            $mail_body .= "\r\nE-mail : " . $email;
//                            $mail_body .= "\r\nIp: " . $_SERVER['REMOTE_ADDR'];
//                            $mail_body .= "\r\n\r\n$mess_txt\r\n";
//                            $is_send_ok = @mail($to, $subj, $mail_body, "Content-type: text/plain; charset=utf-8\n" .
//                                "From: " . $email . "\n" .
//                                "Reply-To: " . $email . "\n" .
//                                "X-Mailer: PHP/" . phpversion());
//                            if (!$is_send_ok){
//                                $status = 'success';
//                                $message = 'Thank You.Your message has been successfully sent.';
//                            }
//                            else {
//                                $message = 'Message did not go through. Please try again.';
//                            }

                    }
                    else{
                        $message = 'You have entered wrong email format. Please try again.';
                    }
                } else {
                    $message = 'Sorry, Email field  can not be empty. Please try again.';
                }
            }
        }
    }
    $response=array('status'=>$status,'message'=>$message);
    echo json_encode($response);
    die();
}

require_once('wp_bootstrap_navwalker.php');
//add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1000, 600, true );
add_image_size( 'deka-post-thumb', 1000, 600, true );
add_image_size( 'deka-page-thumb', 1170, 349, true );

add_image_size( 'deka-mid-blog-thumb', 420, 240, true );
add_image_size( 'deka-home-blog-thumb', 355, 210, true );
add_image_size( 'deka-small-blog-thumb', 220, 170, true );
add_image_size( 'deka-mid_car-thumb', 540, 272, true );
add_image_size( 'deka-home_car-thumb', 460, 270, true );
add_image_size( 'deka-small_car-thumb', 290, 170, true );

add_image_size( 'deka-small-thumb', 100, 100, true );
add_editor_style(array('css/editor-style.css'));
/*---------------------------------------------------------------------*/

add_action( 'init', 'register_my_menus' );
add_action( 'wp_enqueue_scripts', 'wp_scripts_styles' );
add_action( 'wp_ajax_empty_cache', 'empty_cache_callback' );
add_action( 'wp_ajax_optout', 'optout_callback' );
add_action( 'wp_ajax_nopriv_optout', 'optout_callback');
add_action( 'wp_ajax_contacts', 'contacts_callback' );
add_action( 'wp_ajax_nopriv_contacts', 'contacts_callback');
add_action( 'after_switch_theme', 'deka_cache_table' );

if (is_admin()) {
    add_action('admin_menu', 'admin_generate_menu');
    add_action('admin_init', 'page_init');

}

//************************** car of the month***********************/

function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Cars', 'Post Type General Name', 'caragogo' ),
        'singular_name'       => _x( 'Car', 'Post Type Singular Name', 'caragogo' ),
        'menu_name'           => __( 'Cars', 'caragogo' ),
        'parent_item_colon'   => __( 'Parent Car', 'caragogo' ),
        'all_items'           => __( 'All Cars', 'caragogo' ),
        'view_item'           => __( 'View Car', 'caragogo' ),
        'add_new_item'        => __( 'Add New Car', 'caragogo' ),
        'add_new'             => __( 'Add New', 'caragogo' ),
        'edit_item'           => __( 'Edit Car', 'caragogo' ),
        'update_item'         => __( 'Update Car', 'caragogo' ),
        'search_items'        => __( 'Search Car', 'caragogo' ),
        'not_found'           => __( 'Not Found', 'caragogo' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'caragogo' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'cars', 'caragogo' ),
        'description'         => __( 'Cars', 'caragogo' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor',  'thumbnail',  'revisions' ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
       // 'capability_type'     => 'page',
       // 'rewrite' => array( 'slug' => 'cars', 'with_front' => true ),
    );

    // Registering your Custom Post Type
    register_post_type( 'cars', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );

//hide editor
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
    // Get the Post ID.
    if(isset($_GET['post']) ||  isset($_POST['post_ID'])) {
        $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
        if (!isset($post_id)) return;

        // Hide the editor on a page with a specific page template
        // Get the name of the Page Template file.
        $template_file = get_post_meta($post_id, '_wp_page_template', true);
        if ($template_file == 'templates/cars.php') { // the filename of the page template
            remove_post_type_support('page', 'editor');
        }
    }
}
/**********************************************************************/

//remove dns prefetch support
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        return array_diff( wp_dependencies_unique_hosts(), $hints );
    }

    return $hints;
}

add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );

//remove jquery-migrate script
function rem_migrate($scripts){
    if ( ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, array( 'jquery-migrate' ) );
    }
}
add_action( 'wp_default_scripts','rem_migrate');

add_filter( 'the_content', 'tgm_io_shortcode_empty_paragraph_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function tgm_io_shortcode_empty_paragraph_fix( $content ) {

    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );

}
function create_one_post(){
    global $post;
    $content_blog=wp_trim_words( get_the_excerpt(), 16, "..." );
    $html_string="";
    $html_string.='<div class="infinite-post"><div class="one_blog">';
    if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
        $html_string.='<a href="'.get_the_permalink().'" rel="bookmark"><div>'.get_the_post_thumbnail($post,'deka-small-blog-thumb', array( 'class' => 'reg-img' )).'</div></a>';
    }
    $html_string.='<div class="in_one overflow-hidden"><a href="'.get_the_permalink().'" rel="bookmark"><h2>'.get_the_title().'</h2></a><p>'.$content_blog.'</p></div></div></div>';
    return $html_string;
}
function create_one_car(){
    global $post;
    $content_blog=wp_trim_words( get_the_excerpt(), 16, "..." );
    $html_string="";
    $html_string.='<div class="cars-post"><div class="row">';
    if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
        $html_string.='<div class="col-sm-6"><a href="'.get_the_permalink().'" rel="bookmark"><div>'.get_the_post_thumbnail($post,'deka-small_car-thumb', array( 'class' => 'reg-img' )).'</div></a></div>';
    }
    $html_string.='<div class="col-sm-6"><a href="'.get_the_permalink().'" rel="bookmark"><h2>'.get_the_title().'</h2></a><p>'.$content_blog.'</p><a href="/apply" rel="bookmark">QUOTE</a></div></div></div>';
    return $html_string;

}



//remove unnecessary scripts
function wdv_cleanup () {

    remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
    remove_action('wp_head', 'wp_generator'); // remove wordpress version

    remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
    remove_action('wp_head', 'wp_shortlink_wp_head', 10 ); // remove shortlink

    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // remove emojis
    remove_action( 'wp_print_styles', 'print_emoji_styles' );   // remove emojis

    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // remove the / and previous post links

    remove_action('wp_head', 'feed_links', 2); // remove rss feed links
    remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // remove the REST API link
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' ); // remove oEmbed discovery links
    remove_action( 'template_redirect', 'rest_output_link_header', 11); // remove the REST API link from HTTP Headers

    remove_action( 'wp_head', 'wp_oembed_add_host_js' ); // remove oEmbed-specific javascript from front-end / back-end

    remove_action('rest_api_init', 'wp_oembed_register_route'); // remove the oEmbed REST API route
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10); // don't filter oEmbed results
}
add_action('after_setup_theme', 'wdv_cleanup');



