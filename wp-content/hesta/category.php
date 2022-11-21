<?php
/**
 * The template for displaying category pages
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
            <div class="col-lg-8 mb-5 mb-lg-0">
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
			<div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
        </div>
    </div>
</section>
<?php
get_footer();