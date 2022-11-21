<?php
/**
 * The Service Section
 *
 * @package Hesta
 */

/**
 * Class hesta_Service
 */
class hesta_Service extends hesta_Abstract {

	/**
	 * Initialize Slider Section
	 */
	public function __construct() {
		add_action( 'hesta_service_content', array( $this, 'hesta_service_function' ) );
	}

	public function init() {
	}

	function hesta_service_function() {
		$hesta_service_title = get_theme_mod( 'hesta_service_title' );
		$hesta_service_desc  = get_theme_mod( 'hesta_service_desc' );
		if ( get_theme_mod( 'hesta_service_show' ) ) : ?>
        <section class="services-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
					<div class="col-md-6 heading-section text-center">
						<h2 class="mb-4"><?php echo esc_html( $hesta_service_title ); ?> </h2>
						<p><?php echo esc_html( $hesta_service_desc ); ?></p>
					</div>
				</div>
				<div class="row d-flex no-gutters justify-content-center">
				<?php if(get_theme_mod('hesta_service_1')!='' || get_theme_mod('hesta_service_2')!='' || get_theme_mod('hesta_service_3')!='' || get_theme_mod('hesta_service_4')!='' ) {
				$args = array( 
				'post_type' => 'post',
				'ignore_sticky_posts' => 1,
                'orderby' => 'title',
                'order'     => 'ASC',
				'post__in' => array(get_theme_mod('hesta_service_1'),get_theme_mod('hesta_service_2'),get_theme_mod('hesta_service_3'),get_theme_mod('hesta_service_4')));
				$hesta_service = new WP_Query( $args );
                
				if ( $hesta_service->have_posts() ):
				while ( $hesta_service->have_posts() ):
				$hesta_service->the_post(); 
				?>
					<div class="col-md-3 d-flex">
						<div class="media block-6 services d-block">
							<div class="line"></div>
							<?php if( has_post_thumbnail() ) :?>
							<div class="icon">
								<!--<span class="fa fa-desktop"></span>-->
								<img src="<?php the_post_thumbnail_url(); ?>">
							</div>
							<?php endif; ?>
							<div class="media-body">
								<h3 class="heading mb-3"><?php the_title(); ?></h3>
								<?php the_excerpt(); ?>
							</div>
						</div>      
					</div>
				<?php endwhile; 
				wp_reset_postdata();
				endif; } ?>
				</div>
			</div>
		</section>
		<?php endif;
	}
}
$hesta_Service = new hesta_Service();