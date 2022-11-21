<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Hesta
 * @since 0.1
 */
get_header();
/* 
* breadcrumbs
*/
get_template_part('breadcrumbs'); ?>
<section class="blog_area section-padding blog_single_area" id="content">
    <div class="container">
        <div class="row">
            <?php $hesta_single_div = hesta_single_sidebar(); ?>
            <div class="col-lg-<?php echo esc_attr( $hesta_single_div ); ?> mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'post', 'content' );
					endwhile; endif; 
					
					/*
					* Functions hooked into hesta_blog_navigation action
					*
					* @hooked hesta_single_navigation
					*/
					do_action( 'hesta_blog_navigation' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif; 
					?>
                </div>
            </div>
			<?php if( get_theme_mod('hesta_single_sidebar','show-sidebar') == "show-sidebar" ) : ?>
			<div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
			<?php endif; ?>
        </div>
    </div>
</section>
<?php
get_footer();