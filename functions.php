<?php

// SOCIAL MEDIA
define("FACEBOOK", "yourFacebookURL");
define("TWITTER", "yourTwitterURL");

// DEFAULT PATH
define("DOMAIN", get_site_url()."/");
define("FILES", "template_directory");


// SHORTCUTE
add_filter('widget_text', 'do_shortcode');

// ADD THUMBNAILS IMAGES
add_theme_support('post-thumbnails');

// *************** REMOVE WP ADMIN BAR ***************

function my_function_admin_bar()
{
    return false;
}
add_filter("show_admin_bar", "my_function_admin_bar");

// *************** CHANGE MENU POST NAME ***************

// add_filter(  'gettext',  'change_post_to_article'  );
// add_filter(  'ngettext',  'change_post_to_article'  );
// function change_post_to_article( $translated ) {
//      $translated = str_ireplace(  'Post',  'YOUR MENU NAME',  $translated );
//      return $translated;
// }

// ******************************  NEWSLETTER  ******************************

// PLUGIN REQUIRE: Email Subscribers & Newsletters
// FORM REQUIRE: <input type="hidden" name="news" value="-1">
if (isset($_POST['news']) &&  $_POST['news']==-1  &&  isset($_POST['email'])) {

    $data['es_email_mail'] = strip_tags($_POST['email']);
    $data['es_email_name'] = strip_tags($_POST['nome']);
    $data['es_email_status'] = "Confirmed";

    setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $date = date('Y-m-d H:i:s');
    $data['es_email_created'] = date("Y-m-d H:i:s");
    $data['es_email_group'] = "Public";

    global $wpdb;
    if ($wpdb->insert('wp_es_emaillist', $data)) {
        echo "<script>alert('E-mail cadastrado com sucesso');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar');</script>";
    }
}


// ******************************  CONTACT  ******************************

if (isset($_POST['contact'])  &&  $_POST['contact']==-1 &&  isset($_POST['email'])) {

    $name = (isset($_POST['name']) && $_POST['name']!="")? "<b>NOME:</b> ".strip_tags($_POST['name'])."<br>":"";
    $email = (isset($_POST['email']) && $_POST['email']!="")? "<b>E-MAIL:</b> ".strip_tags($_POST['email'])."<br>":"";
    $phone = (isset($_POST['phone']) && $_POST['phone']!="")? "<b>TELEFONE:</b> ".strip_tags($_POST['phone'])."<br>":"";
    $msg = (isset($_POST['msg']) && $_POST['msg']!="")? "<b>MENSAGEM:</b> ".strip_tags($_POST['msg'])."<br>":"";

    $to = "email@yourdomain.com";
    $from = "email@yourdomain.com";
    $subject = "Contato através do site";

    $headers = "From: $from\n";
    $headers .= "Reply-To: ".$email."\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\n";

    $html = "<html><body>";
    $html .= "<h2 style='color:#888'>Formulário de contato enviado através do site:</h2>";
    $html .= $name.$email.$phone.$msg;
    $html .= "</html></body>";

    // SEND
    if (!mail($to, $subject, $html, $headers, $from)) {
        echo "<script>alert('Erro ao enviar');</script>";
    } else {
        echo "<script>alert('Enviado com sucesso');</script>";
    }
}


// ***************  EXCERPT  ***************
function excerpt($limit, $ex="")
{
    if ($ex=="") {
        $ex = get_the_excerpt();
    }
    $excerpt = explode(' ', $ex, $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt).'...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);
    return $excerpt;
}

// ##################  POST TYPES  ###################
// PLUGIN REQUIRE: Advanced Custom Fields ACF
// DASHICONS (icons): https://developer.wordpress.org/resource/dashicons/#images-alt2


// ***************   BANNER POST TYPE  ***************

add_action('init', 'banner');
function banner()
{
    register_post_type('banner', array(

        'labels' => array(
            'name' => __('Banner'),
            'singular_name' => __('Banners')
        ),
        //'taxonomies' => array('category'),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-share-alt2',
        )

    );
}





// *****************  PAGER  ********************
function wp_pagination()
{
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('page', '%#%'),
        'format' => '',
        'big_number' => 999999999,
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'show_all' => false,
        'end_size'=> 1,
        'mid_size'=> 2,
        'prev_next'=> true,
        'prev_text'=> '&lsaquo;',
        'next_text'=> '&rsaquo;',
        'type'=> 'plain'
    );

    if ($wp_rewrite->using_permalinks()) {
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
    }
    if (!empty($wp_query->query_vars['s'])) {
        $pagination['add_args'] = array( 's' => get_query_var('s') );
    }

    echo paginate_links($pagination);
}

// *****************  COUNTER POSTS ******************

if ( ! function_exists( 'tutsup_session_start' ) ) {
    function tutsup_session_start() {
        if ( ! session_id() ) @session_start();
    }
    add_action( 'init', 'tutsup_session_start' );
}

if ( ! function_exists( 'tp_count_post_views' ) ) {

    function tp_count_post_views () {

        if ( is_single() ) {


            global $post;


            if ( empty( $_SESSION[ 'tp_post_counter_' . $post->ID ] ) ) {


                $_SESSION[ 'tp_post_counter_' . $post->ID ] = true;


                $key = 'tp_post_counter';
                $key_value = get_post_meta( $post->ID, $key, true );


                if ( empty( $key_value ) ) {
                    $key_value = 1;
                    update_post_meta( $post->ID, $key, $key_value );
                } else {

                    $key_value += 1;
                    update_post_meta( $post->ID, $key, $key_value );
                }

            }

        }

        return;

    }
    add_action( 'get_header', 'tp_count_post_views' );
}
