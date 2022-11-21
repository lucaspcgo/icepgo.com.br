<?php
/**
 * The template for displaying front page
 *
 * @package Hesta
 * @since 0.1
 */
get_header();
if ( get_option( 'show_on_front' ) == 'page' ) {
	$hesta_front_page = get_theme_mod( 'hesta_front_page' );
	if ( $hesta_front_page ) {
		get_template_part( 'content', 'frontpage' );
	} else {
		get_template_part( 'index' );
	}
} else {
	get_template_part( 'index' );
}
get_footer();