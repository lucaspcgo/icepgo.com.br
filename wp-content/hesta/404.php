<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Hesta
 * @since 0.1
 */
get_header();
/* 
* breadcrumbs
*/
get_template_part('breadcrumbs'); ?>
<section class="not_found_page section-padding" id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-1 mb-lg-0">
                <div class="blog_left_sidebar">
                    <article class="blog_item">
                        <h1 class="no_found_title"><?php esc_html_e( '404', 'hesta' ); ?></h1>

                        <div class="blog_details no_detail text-center">
                            
                            <h2><?php esc_html_e( 'Oops! The page you requested not found.', 'hesta' ); ?></h2>
                            
                            <?php get_search_form(); ?>
							<div class="hom">
								<a href="<?php echo esc_url( home_url("/") ); ?>"> <?php esc_html_e( 'Go Home', 'hesta' ); ?></a>
							</div>
                        </div>
                    </article>
                </div>
            </div>
			
        </div>
    </div>
</section>
<?php 
get_footer();