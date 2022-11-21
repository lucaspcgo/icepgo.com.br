<?php
/**
 * The Blog Section
 *
 * @package Hesta
 */

/**
 * Class hesta_Blog
 */
class hesta_Blog extends hesta_Abstract {
	/**
	 * Initialize Slider Section
	 */
	public function __construct() {
		add_action( 'hesta_blog_content', array( $this, 'hesta_blog_function' ) );
	}

	public function init() {

	}

	/**
	 * Slider section content.
	 *
	 * @since hesta 0.1
	 */
	function hesta_blog_function() {
	$hesta_blog_title = get_theme_mod( 'hesta_blog_title' );
	$hesta_blog_desc  = get_theme_mod( 'hesta_blog_desc' );
	?>
    <div class="home-blog-area pt-100">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row justify-content-center pb-5">
            <div class="col-md-6 heading-section text-center">
				<h2 class="mb-3"><?php echo esc_html( $hesta_blog_title ); ?></h2> 
				<p><?php echo esc_html( $hesta_blog_desc ); ?></p>
			</div>
        </div>
        <div class="row">
			<div class="home-blog owl-carousel owl-theme">
			<?php if ( have_posts() ) :
			$hesta_posts_count = wp_count_posts()->publish; $args = array( 'post_type' => 'post','posts_per_page'      => $hesta_posts_count, 'ignore_sticky_posts' => 1 );
			$hest_post_type_data = new WP_Query( $args );
			while ( $hest_post_type_data->have_posts() ): $hest_post_type_data->the_post(); ?>
				<div class="item1">
					<div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
							<?php if ( has_post_thumbnail() ) : ?>
                                <img src="<?php the_post_thumbnail_url(); ?>">
							<?php endif; ?>
                                <ul>
                                    <li> <?php esc_html_e( 'By ','hesta' ); the_author_meta( 'display_name' ); esc_html_e( ' - ','hesta' ); echo esc_html( get_the_date() ); ?> </li>
                                </ul>
                            </div>
                            <div class="blog-cap">
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php the_excerpt(); ?>
                                <a href="<?php the_permalink(); ?>" class="more-btn"><?php 
								if( get_theme_mod( 'hesta_blog_btn_text' ) ) {
									$hesta_blog_btn_text = get_theme_mod( 'hesta_blog_btn_text' );
									echo esc_attr( $hesta_blog_btn_text );
								} else esc_html_e( 'Read More','hesta' );
								?></a>
                            </div>
                        </div>
                    </div>
				</div>
				<?php endwhile; 
				wp_reset_postdata();
				endif; ?>
			</div>
		</div>
	</div>
</div>
<?php
	}
}
$hesta_Blog = new hesta_Blog();