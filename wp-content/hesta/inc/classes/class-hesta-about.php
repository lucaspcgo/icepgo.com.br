<?php
/**
 * The about Section
 *
 * @package Hesta
 */

/**
 * Class hesta_about
 */
class hesta_about extends hesta_Abstract {
	/**
	 * Initialize about Section
	 */
	public function __construct() {
		add_action( 'hesta_about_area', array( $this, 'hesta_about_function' ) );
	}

	public function init() {

	}

	/**
	 * about section content.
	 *
	 * @since Hesta 0.1
	 */
	function hesta_about_function() {
		$hesta_about_show = get_theme_mod( 'hesta_about_show' );
		if ( $hesta_about_show == 1 ) : 
		$args = array( 
		'post_type' => 'page',
		'post_status'=>'publish', 
		'post__in' => array(get_theme_mod('hesta_about_page')));

		$hesta_about = new WP_Query( $args );
		if ( $hesta_about->have_posts() ):
		while ( $hesta_about->have_posts() ):
		$hesta_about->the_post(); ?>
        <div class="about-area">
			<div class="container-fluid">
				<div class="row align-items-center">
				<?php if( has_post_thumbnail() ) { ?>
					<div class="col-md-5 col-lg-5 left">
						<div class="support-location-img">
                  			<?php the_post_thumbnail( 'hesta-about-thumb' ); ?>
						</div>
					</div>
					<div class="col-md-7 col-lg-7 right">
						<div class="right-caption">
							<!-- Section Tittle -->
							<div class="section-tittle section-tittle2 mb-50">
								<h2><?php the_title(); ?></h2>
							</div>
							<div class="support-caption">
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" class="post-btn"><?php 
								if( get_theme_mod( 'hesta_about_btn_text' ) ) {
									$hesta_about_btn_text = get_theme_mod( 'hesta_about_btn_text' );
									echo esc_attr( $hesta_about_btn_text );
								} else esc_html_e( 'Know More','hesta' );
								?></a>
							</div>
						</div>
					</div>
				<?php } else { ?>
				<div class="col-md-12 col-lg-12 about-single-div text-center right">
						<div class="right-caption">
							<!-- Section Tittle -->
							<div class="section-tittle section-tittle2 mb-50">
								<h2><?php the_title(); ?></h2>
							</div>
							<div class="support-caption">
								<?php the_excerpt(); ?>
								<a href="<?php the_permalink(); ?>" class="post-btn"><?php 
								if( get_theme_mod( 'hesta_about_btn_text' ) ) {
									$hesta_about_btn_text = get_theme_mod( 'hesta_about_btn_text' );
									echo esc_attr( $hesta_about_btn_text );
								} else esc_html_e( 'Know More','hesta' );
								?></a>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
		<?php endwhile; 
		wp_reset_postdata();
		endif; endif;
	}
}
$hesta_about = new hesta_about();