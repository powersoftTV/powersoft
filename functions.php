<?php

function auto_loader($class_name) {
    if ((substr($class_name, 0, 10) !== 'Powersoft_') && (substr($class_name, 0, 10) !== 'ReCaptcha_')) {
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
    wp_localize_script( 'powerscript', 'powerscript_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( "power_nonce" ), 'img'=> get_template_directory_uri() . '/imgs/download.svg' ) );
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
    wp_enqueue_script('powerscript');
    wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js');
    wp_enqueue_script('recaptcha');

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
add_editor_style(array('css/editor-style.css'));
/*---------------------------------------------------------------------*/

add_action( 'wp_enqueue_scripts', 'wp_scripts_styles' );
add_action( 'wp_ajax_contacts', 'contacts_callback' );
add_action( 'wp_ajax_nopriv_contacts', 'contacts_callback');



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



