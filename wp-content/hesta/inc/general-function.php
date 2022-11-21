<?php
/**
 * Hesta header functions to be hooked
 *
 * @package Hesta
 */

if( ! function_exists( 'hesta_doc_type' ) ) : 
	function hesta_doc_type() { ?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
<?php } 
endif; ?>

<?php if ( ! function_exists( 'hesta_head_section' ) ) :
	function hesta_head_section() { ?>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<?php if ( is_singular() && pings_open() ) { ?>
            <link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
			<?php }
			wp_head(); ?>
		</head>
<?php }
endif; ?>

<?php if ( ! function_exists( 'hesta_header_info' ) ) :
	function hesta_header_info() { 
	$hesta_address = get_theme_mod( 'hesta_address' );
	$hesta_email = get_theme_mod( 'hesta_email' );
	$hesta_phone_number = get_theme_mod( 'hesta_phone_number' );
	?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<ul class="info-link">
						<?php if( $hesta_email ) { ?>
						<li><i class="fa fa-paper-plane pr-2"></i><a href="<?php echo esc_url( 'mailto:' . sanitize_email( $hesta_email ) ); ?>"><?php echo esc_html( $hesta_email); ?></a></li>
						<?php } ?>
						<?php if( $hesta_phone_number ) { ?>
						<li><i class="fa fa-phone pr-2"></i><?php echo esc_html( $hesta_phone_number ) ?></li>
						<?php } ?>
						<?php if( $hesta_address ) { ?>
						<li><i class="fa fa-map marker pr-2"></i><?php echo esc_html( $hesta_address ); ?></li>
						<?php } ?>
					</ul>
				</div>
			</div> 
		</div>
<?php } 
endif; ?>

<?php if ( ! function_exists( 'hesta_logo' ) ) :
	function hesta_logo() { ?>
		<div class="header__logo">
			<a style="color: #<?php echo esc_attr( get_theme_mod( 'header_textcolor' ) ); ?>" title="<?php the_title_attribute(); ?>"href="<?php echo esc_url( home_url() ); ?>">
			
				<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
				$image = wp_get_attachment_image_src( $custom_logo_id, 'full' );

				if ( has_custom_logo() ) { ?>
					<img src="<?php echo esc_url( $image[0] ); ?>"/>
				<?php } elseif ( display_header_text() ) { ?>
					<h3 class="site-title"> <?php echo esc_html( get_bloginfo( 'name' ) ); ?> </h3>
				<?php } ?> 
			</a>
		</div>
				
<?php } 
endif; ?>

<?php if ( ! function_exists( 'hesta_menu' ) ) :
	function hesta_menu() { ?>
		<nav class="navbar navbar-light navbar-expand-lg mainmenu header__menu">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'hesta' ); ?>">
				<span class="fa fa-bars "></span>
            </button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<?php
						wp_nav_menu( array(
							'theme_location'  => 'primary',
							'depth'           => 4, // 1 = no dropdowns, 2 = with dropdowns.
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav mr-auto',
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'walker'          => new WP_Bootstrap_Navwalker(),
						) );
				?>
			</div>
		</nav>	
<?php } 
endif; ?>

<?php if ( ! function_exists( 'hesta_social_section' ) ) :
	function hesta_social_section() {
	if( get_theme_mod('hesta_social_icon') == '1' ) :
	?>
		<div class="header__right">
		<?php if ( has_nav_menu( 'social' ) ) :
			wp_nav_menu(
				array(
						'theme_location' => 'social',
						'menu_class'     => 'header__right__social',
						'walker' => new WO_Nav_Social_Walker(),
						'depth'          => 1,
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					)
			); 
		endif; ?>
		</div>
<?php endif; } 
endif;

/**
 * hesta footer functions to be hooked
 *
 * @package Hesta
 */
if ( ! function_exists( 'hesta_footer_widget' ) ) :
	/**
	 * footer widget area
	 */
	function hesta_footer_widget() {
		?>
        <div class="row mb-5">
				<?php
				if ( is_active_sidebar( 'footer-widget' ) ) {
					dynamic_sidebar( 'footer-widget' );
				} else {
					$args = array(
						'before_widget' => '<div class="col-md-3 footer-widget mb-3">',
						'after_widget'  => '</div>',
						'before_title'  => '<h2 class="heading-2">',
						'after_title'   => '</h2>'
					);
					the_widget( 'WP_Widget_Pages', null, $args );
				}
				?>
        </div>
		<?php
	}
endif;

if ( ! function_exists( 'hesta_footer_copyright' ) ) :
	/**
	 * footer copyright area
	 */
	function hesta_footer_copyright() {
		$hesta_copyright = get_theme_mod( 'hesta_copyright' );
		$hesta_footer_info = get_theme_mod( 'hesta_footer_info' );
		$hesta_link = get_theme_mod( 'hesta_link' );
		?>
        <p><?php echo esc_html( $hesta_copyright ); ?> <a href="<?php echo esc_url( $hesta_link ); ?>" target="_blank"><?php echo esc_html( $hesta_footer_info ); ?></a>
		</p>
		<?php
	}
endif;