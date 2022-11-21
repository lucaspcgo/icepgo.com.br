<?php
/**
 * Hesta functions and code
 *
 * @package Hesta
 * @since 0.1
 *
 */
/**
 * Define constants
 */
define( 'HESTA_PARENT_DIR', get_template_directory() );
define( 'HESTA_PARENT_URI', get_template_directory_uri() );
define( 'HESTA_PARENT_INC_DIR', HESTA_PARENT_DIR . '/inc' );
define( 'HESTA_PARENT_INC_URI', HESTA_PARENT_URI . '/inc' );

/* 
 * require classes 
*/
require HESTA_PARENT_INC_DIR . '/classes/class-hesta-core-function.php';
require HESTA_PARENT_INC_DIR . '/classes/class-hesta-abstract.php';
require HESTA_PARENT_INC_DIR . '/classes/class-hesta-slider.php';
require HESTA_PARENT_INC_DIR . '/classes/class-hesta-about.php';
require HESTA_PARENT_INC_DIR . '/classes/class-hesta-blog.php';
require HESTA_PARENT_INC_DIR . '/classes/class-hesta-service.php';
require HESTA_PARENT_INC_DIR . '/classes/class-wp-bootstrap-navwalker.php';

/* 
 * customizer class
*/

require HESTA_PARENT_DIR . '/inc/customizer/customizer.php';
require HESTA_PARENT_DIR . '/inc/hesta-pro-intro.php';

/*
 * Load hooks and general functions
*/
require HESTA_PARENT_INC_DIR . '/theme-hooks.php';
require HESTA_PARENT_INC_DIR . '/general-function.php';
require HESTA_PARENT_INC_DIR . '/hesta-function.php';
require HESTA_PARENT_INC_DIR . '/class_nav_social_walker.php';


/**
* display notice 
**/

if ( $pagenow == 'index.php' || $pagenow == 'themes.php' ) {
	add_action( 'admin_notices', 'hesta_activation_notice' );
}

function hesta_activation_notice(){
$my_theme = wp_get_theme();	
?>
    <style>
		a.reply-btn {
			display: initial;
			margin: 0 auto;
			border-radius: 4px;
			color: #fff;
			background: #0e6ec4;
			padding: 10px;
			text-decoration: none;
		}
		.hello-elementor-notice-content {
			padding: 28px;
			text-align: center;
		}
		.notice h3 {
			margin: 0 0 5px;
		}
		.notice.updated.is-dismissible {
			padding: 15px;
		}
		a.rate-btn {
			font-size: 11px;
			text-decoration: none;
			background: #153e4d;
			padding: 3px 10px;
			color: #fff;
		}
		a.support-btn {
			margin-left: 10px;
			text-decoration: none;
		}
		.review-page {
			background: rgba(221, 240, 249, 0.8) !important;
			padding: 15px;
			border-left-color: #e0f0f7 !important;
		}
		.notice.updated.is-dismissible.review-page {
			border-left: 1px solid #ccd0d4 !important;
		}
	</style>

    <div class="notice updated my-dismiss-notice is-dismissible review-page">
		<div class="hello-elementor-notice-inner">
			<div class="hello-elementor-notice-content">
				<h3> <?php _e('Thank you for installing', 'hesta'); ?> <?php echo $my_theme->get( 'Name' ); ?>
				<?php echo esc_html_e('Version - ','hesta'); ?>
				 <?php echo esc_html( $my_theme->get('Version') ); ?>
				</h3>
				
				<p style="margin-bottom: 18px;"><?php 
				_e(' Are you are enjoying Hesta? We would love to hear your feedback. Big thanks in advance.','hesta'); ?> </p>
				<a target="_blank" class="reply-btn" href="https://wordpress.org/support/theme/hesta/reviews/#new-post"> <?php _e('Submit a review','hesta'); ?> </a>
				
				<a target="_blank" class="reply-btn" style="margin-left: 18px;" href="https://wordpress.org/support/theme/hesta/" > <?php _e('Free Support','hesta'); ?> </a>
				
				<a target="_blank" class="reply-btn" style="margin-left: 18px;" href="<?php echo admin_url('/themes.php?page=hesta'); ?>" > <?php _e('View Demo & Documentation','hesta'); ?> </a>
				
				<button type="button" class="notice-dismiss">
					<span class="screen-reader-text">Dismiss this notice.</span>
				</button>
				
			</div>
		</div>
	</div>
<?php }