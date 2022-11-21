<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Hesta
 * @since 0.1
 */
get_header();
/* 
* breadcrumbs
*/
get_template_part('breadcrumbs'); ?>
<section class="blog_area section-padding" id="content">
    <div class="container">
        <div class="row">
		<?php $hesta_blog_div = hesta_blogpage_sidebar(); ?>
            <div class="col-lg-<?php echo esc_attr( $hesta_blog_div ); ?> mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'post', 'content' );
					endwhile; endif; 
					
					/*
					* Functions hooked into hesta_pagination action
					*
					* @hooked hesta_navigation
					*/
					do_action( 'hesta_pagination' ); 
					?>
                </div>
            </div>
			<?php if( get_theme_mod('hesta_blog_sidebar','show-sidebar') == "show-sidebar" ) : ?>
			<div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
			<?php endif; ?>
        </div>
    </div>
</section>
<?php
get_footer();