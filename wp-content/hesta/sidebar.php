<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Hesta
 * @version 0.1
 */
?>
<div class="blog_right_sidebar">
		<?php if ( is_active_sidebar( 'sidebar-primary' ) ) :
			dynamic_sidebar( 'sidebar-primary' );
		else :
			$args = array(
				'before_widget' => '<div id="%1$s" class="single_sidebar_widget post_category_widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget_title">',
				'after_title'   => '</h4>'
			);
			the_widget( 'WP_Widget_Pages', null, $args );
			the_widget( 'WP_Widget_Categories', 'dropdown=1&count=1' );
		endif;
		?>
</div>