<?php
/**
 * The Slider Section
 *
 * @package Hesta
 */

/**
 * Class hesta_Slider
 */
class hesta_Slider extends hesta_Abstract {
	/**
	 * Initialize Slider Section
	 */
	public function __construct() {
		add_action( 'hesta_slider_content', array( $this, 'hesta_slider_function' ) );
	}

	public function init() {

	}

	/**
	 * Slider section content.
	 *
	 * @since hesta 0.1
	 */
	public function hesta_slider_function() { ?>
		<div class="slider-area">
			<div class="fadeOut owl-carousel owl-theme">
		<?php $hesta_slider_type = get_theme_mod( 'hesta_slider_layout' );
		if ( $hesta_slider_type == "post" ) {
			$post1 = get_theme_mod('hesta_post_1');
			$post2 = get_theme_mod('hesta_post_2');
			$post3 = get_theme_mod('hesta_post_3');  
			$args = array( 
			'post_type' => 'post',
			'post_status'=>'publish', 
			'post__in' => array(get_theme_mod('hesta_post_1'),get_theme_mod('hesta_post_2'),get_theme_mod('hesta_post_3')));
              
			$hesta_slide = new WP_Query( $args ); 
			if ( $hesta_slide->have_posts() ): while ( $hesta_slide->have_posts() ): $hesta_slide->the_post(); 
			if(has_post_thumbnail()) { ?>
			
				<div class="item" style="background-image: url(<?php echo esc_url( the_post_thumbnail_url() ); ?>)">
					<div class="hero-overlay"></div>
						<div class="container">
							<div class="row pt-5">
								<div class="col-md-8">
									<h4 class="slide-title" data-animation="fadeInLeft" data-delay=".5s" style="animation-delay: 0.5s;"><?php the_title(); ?></h4>
									<p class="slide-desc"><?php the_excerpt(); ?></p>
									<a class="post-btn" target="_blank" href="<?php the_permalink(); ?>"> 
              						<?php 
								if( get_theme_mod( 'hesta_slider_btn_text' ) ) {
									$hesta_slider_btn_text = get_theme_mod( 'hesta_slider_btn_text' );
									echo esc_attr( $hesta_slider_btn_text );
								} else esc_html_e( 'LOAD MORE','hesta' );
								?></a> 
								</div>
							</div>
						</div>
				</div>
		<?php } endwhile; 
		wp_reset_postdata(); endif; 
		} else {  /* if page */ 
			$page1 = get_theme_mod('hesta_page_1');
			$page2 = get_theme_mod('hesta_page_2');
			$page3 = get_theme_mod('hesta_page_3'); 
			$args = array( 
			'post_type' => 'page',
			'post_status'=>'publish', 
			'post__in' => array(get_theme_mod('hesta_page_1'),get_theme_mod('hesta_page_2'),get_theme_mod('hesta_page_3')));
              
			$hesta_slide = new WP_Query( $args ); 
			if ( $hesta_slide->have_posts() ):
			while ( $hesta_slide->have_posts() ):
			$hesta_slide->the_post(); 
			if(has_post_thumbnail()) { ?>
			
				<div class="item" style="background-image: url(<?php echo esc_url( the_post_thumbnail_url() ); ?>)">
					<div class="hero-overlay"></div>
						<div class="container">
							<div class="row pt-5">
								<div class="col-md-8">
									<h4 class="slide-title" data-animation="fadeInLeft" data-delay=".5s" style="animation-delay: 0.5s;"><?php the_title(); ?></h4>
									<p class="slide-desc"><?php the_excerpt(); ?></p>
									<a class="post-btn" target="_blank" href="<?php the_permalink(); ?>">
              						<?php if( get_theme_mod( 'hesta_slider_btn_text' ) ) {
									$hesta_slider_btn_text = get_theme_mod( 'hesta_slider_btn_text' );
									echo esc_attr( $hesta_slider_btn_text );
								} else esc_html_e( 'LOAD MORE','hesta' );
								?>
              					</a> 
								</div>
							</div>
						</div>
				</div>
	<?php } endwhile; 
	wp_reset_postdata();
	endif; } ?>
		</div>
	</div>
<?php	}
}
$hesta_Slider = new hesta_Slider();