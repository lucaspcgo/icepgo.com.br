<?php
/**
 * The template for displaying all pages.
 *
 *
 * @package bluechip
 */

get_header(); 
    $get_image = get_header_image();
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
    $thumb_url = $thumb_url_array[0];
    if( has_post_thumbnail() ){
        $header_image = 'style="background-image: url('. esc_url( $thumb_url ) .');"';
    } elseif( $get_image ){
        $header_image = 'style="background-image: url('. esc_url( $get_image ) .');"';
    } else{
        $header_image = '';
    }

?>

    <div class="page-title-area"<?php echo wp_kses_post( $header_image ); ?>>
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col-md-8 content-area">
                <?php
                while ( have_posts() ) : the_post();

                get_template_part( 'contents/content', 'page' );

                ?>

                <span class="clearfix"></span>

                <?php

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

                endwhile; // End of the loop.
                ?>  
            </div> 

            <?php get_sidebar(); ?>

            <span class="clearfix"></span>
        </div>
    </div>

<?php get_footer(); ?>