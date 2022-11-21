<?php 

/**
 * Customizer Display
 *
 * @package bluechip
 */

  function bluechip_apply_color() {

    if( get_theme_mod('bluechip_color_settings') ){
      $primary  =   esc_html( get_theme_mod('bluechip_color_settings') );
    }else{
      $primary  =  '#1565c0';
    }

    if( get_theme_mod('bluechip_footer_bg') ){
      $footer_bg  =   esc_html( get_theme_mod('bluechip_footer_bg') );
    }else{
      $footer_bg  =  '#191919';
    }

    $custom_css = "
        a,
        a:hover,
        #site-info .info-item p:before, #site-info .info-item div:before,
        .dropdown-menu > .active > a, .dropdown-menu > .active > a:focus, .dropdown-menu > .active > a:hover{
            color: {$primary};
        }
        .widget #wp-calendar caption{
            background: {$primary};
        }
        .page-title-area,
        #site-header .navbar-default .navbar-toggle,
        .comment .comment-reply-link,
        input[type='submit'], button[type='submit'], .btn, .comment .comment-reply-link,.top-contact-info,
        #site-header.head-with-bgcolor,#banner, #section-2, #section-3, #section-5{
            background-color: {$primary};
        }
        .comment .comment-reply-link,
        input[type='submit'], button[type='submit'], .btn, .comment .comment-reply-link{
            border: 1px solid {$primary};
        }
        footer.footer{
            background: {$footer_bg};
        }
        @media only screen and (max-width: 767px) {
          #main-navigation{
            background-color: {$primary};
          }
        }
        .tmm .tmm_member {
            border: 2px solid {$primary}!important;
        }
        .tmm .tmm_member .tmm_photo {
            border-radius: 100%!important;
        }
        .tmm .tmm_member .tmm_photo {
            border: 8px solid {$primary};
        }
        .tmm .tmm_member .tmm_photo {
            background-position: center!important;
        }
        
      ";

    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '', 'all' );
    wp_enqueue_style( 'bluechip-main-stylesheet', get_template_directory_uri() . '/assets/css/style.css', array(), '', 'all' );
    wp_add_inline_style( 'bluechip-main-stylesheet', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'bluechip_apply_color', 999 );