<?php
/**
 * The template for displaying 404 pages (not found).
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
        <h1 class="page-title"><?php _e('404','bluechip'); ?></h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1 class="page-title"><?php _e( 'Not Found', 'bluechip' ); ?></h1>
            <p>
            <?php _e( 'The article you were looking for was not found. You may want to check your link or perhaps that page does not exist anymore. Maybe try a search?', 'bluechip' ); ?>
            </p>
            <?php get_search_form(); ?>
        </div>

        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer(); ?>