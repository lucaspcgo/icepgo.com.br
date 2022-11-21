<?php 

/**
 * theme custom functions
 *
 * @package bluechip
 */


/**
 * author excerpt
 */
function bluechip_author_excerpt() {
  $text_limit = 100; //Words to show in author bio excerpt
  $read_more  = ""; //Read more text
  $end_of_txt = "...";
  $url_of_author  = get_author_posts_url(get_the_author_meta('ID'));
  $short_desc_author = wp_trim_words(strip_tags(
  get_the_author_meta('description')), $text_limit, 
  $end_of_txt);

  return $short_desc_author;
  }

/**
 * return an image inside a post
 */
function bluechip_catch_that_image() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);

      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_url($id);  
        return $transformed_content;
      }
    
  }
  
}

/**
 * return an image inside a post (thumb)
 */
function bluechip_catch_that_image_thumb() {
  global $post;
  $pattern = '|<img.*?class="([^"]+)".*?/>|';
  $transformed_content = apply_filters('the_content',$post->post_content);
  preg_match($pattern,$transformed_content,$matches);
  if (!empty($matches[1])) {
    $classes = explode(' ',$matches[1]);
    $id = preg_grep('|^wp-image-.*|',$classes);
    if (!empty($id)) {
      $id = str_replace('wp-image-','',$id);
      if (!empty($id)) {
        $id = reset($id);
        $transformed_content = wp_get_attachment_url($id);  
         return $transformed_content;
      }
    }
  }
 
}

/**
 * return a gallery image inside a post
 */
function bluechip_catch_gallery_image_full()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        $link = wp_get_attachment_url( $id );
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $link;
          return $first_img;
        }
      }
    } 
}

/**
 * return a gallery image inside a post (thumb)
 */
function bluechip_catch_gallery_image_thumb()  { 
    global $post;
    $gallery = get_post_gallery( $post, false );
    if ( !empty($gallery['ids']) ) {
      $ids = explode( ",", $gallery['ids'] );
      $total_images = 0;
      foreach( $ids as $id ) {
        
        $image  = wp_get_attachment_image( $id, 'thumbnail');
        $total_images++;
        
        if ($total_images == 1) {
          $first_img = $image;
          return $first_img;
        }
      }
    } 
}

/**
 * Social Icons
 */
function bluechip_social_icons()  { 
  $social_networks = array(
      "bluechip_facebook" => "fa-facebook", "bluechip_twitter" => "fa-twitter", "bluechip_google" => "fa-google-plus",
      "bluechip_pinterest" => "fa-pinterest", "bluechip_linkedin" => "fa-linkedin", "bluechip_youtube" => "fa-youtube",
      "bluechip_tumblr" => "fa-tumblr", "bluechip_instagram" => "fa-instagram", "bluechip_flickr" => "fa-flickr",
      "bluechip_vimeo" => "fa-vimeo-square", "bluechip_rss" => "fa-rss"
  );

  foreach ($social_networks as $key => $icon) {
     
      if (get_theme_mod( $key )): ?>
       <a href="<?php echo esc_url( get_theme_mod($key) ); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod( $key ) ); ?>" target="_blank"><i class="fa <?php echo $icon; ?>"></i></a>
      <?php endif;
  }

  if(get_theme_mod('bluechip_email')): ?>
        <a href="mailto:<?php echo esc_attr(get_theme_mod('bluechip_email')); ?>" class="social-tw" title="<?php echo esc_attr( get_theme_mod('bluechip_email')); ?>" target="_blank"><i class="fa fa-envelope"></i> </i></a>
  <?php endif;
}

/**
 * Show pagination
 */
function bluechip_show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
}

/**
 * wp_nav_menu Fallback
 */
function bluechip_primary_menu_fallback() {
    ?>

    <ul id="menu-main-menu" class="nav navbar-nav navbar-right">
        <?php
        wp_list_pages(array(
            'depth'        => 1,
            'exclude' => '', //comma seperated IDs of pages you want to exclude
            'title_li' => '', //must override it to empty string so that it does not break our nav
            'sort_column' => 'post_title', //see documentation for other possibilites
            'sort_order' => 'ASC', //ASCending or DESCending
        ));
        ?>
    </ul>

    <?php
}


/**
 *
 * This script will prompt the users to install the plugin required to
 * enable the "Menu Item" custom post type for magazino theme.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.3.6
 * @author     Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/plugin/class-tgm.php';

add_action( 'tgmpa_register', 'bluechip_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the bluechip library
 * and one from the .org repo.
 *
 * The variable passed to bluechip_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into bluechip_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function bluechip_register_required_plugins() {
 
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
 
 
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => __('Shortcodes Ultimate','bluechip'),
            'slug'      => 'shortcodes-ultimate',
            'required'  => false,
        ),
        array(
            'name'      => __('Better Contact Details','bluechip'),
            'slug'      => 'better-contact-details',
            'required'  => false,
        ),
        array(
            'name'      => __('Team Members','bluechip'),
            'slug'      => 'team-members',
            'required'  => false,
        ),
        array(
            'name'      => __('Testimonial Rotator','bluechip'),
            'slug'      => 'testimonial-rotator',
            'required'  => false,
        ),
 
    );
 
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'bluechip-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'bluechip' ),
            'menu_title'                      => __( 'Install Plugins', 'bluechip' ),
            'installing'                      => __( 'Installing Plugin: %s', 'bluechip' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'bluechip' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'bluechip'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'bluechip'), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'bluechip'),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' , 'bluechip'),
            'return'                          => __( 'Return to Required Plugins Installer', 'bluechip' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'bluechip' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'bluechip' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
 
    tgmpa( $plugins, $config );
 
}