<?php
/**
 * The template for displaying archive pages.
 *
 * @package bluechip
 */

get_header(); 
    $get_image = get_header_image();
    if( $get_image ){
        $header_image = 'style="background-image: url('. esc_url( $get_image ) .');"';
    } else{
        $header_image = '';
    }
?>

    <div class="page-title-area"<?php echo wp_kses_post( $header_image ); ?>>
        <div class="container">
            <h1 class="page-title"><?php the_archive_title(); ?></h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-list">
                <?php
                if ( have_posts() ) :

                    while ( have_posts() ) : the_post();

                        get_template_part( 'contents/content', get_post_format() );

                    endwhile;

                    the_posts_navigation();

                else :

                    get_template_part( 'contents/content', 'none' );

                endif; ?>
                <span class="clearfix"></span>
            </div>
            
            <?php get_sidebar(); ?>

        </div>
    </div>

<?php get_footer(); ?>