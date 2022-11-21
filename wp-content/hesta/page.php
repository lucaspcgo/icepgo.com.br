<?php 
/**
 * The template for displaying all page
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
<section class="blog_area section-padding" id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						get_template_part( 'post', 'page' );
					endwhile; endif; 
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