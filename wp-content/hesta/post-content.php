<div id="post-<?php the_ID(); ?>" <?php post_class( 'hesta_blog' ); ?>>
	
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="blog_item_img">
		<?php if ( get_theme_mod( 'hesta_show_featured_image','1' ) ) : ?>
		<img class="card-img rounded-0" src="<?php the_post_thumbnail_url(); ?>">
		<?php endif; 
		if( get_theme_mod('hesta_show_author_date','1') ) :  ?>
		<div class="blog_item_date">
			<h3><span class="entry-author">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"> <?php esc_html_e( 'By','hesta' ); ?> <?php the_author_meta( 'display_name' ); ?></a>
			</span>
			<?php esc_html_e( '-','hesta' ); ?> <?php echo esc_html( get_the_date() ); ?></h3>
		</div>
		<?php endif; ?>
	</div>
	<?php } else { ?>
		<div class="blog_item_date1">
			<h3><span class="entry-author">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"> <?php esc_html_e( 'By','hesta' ); ?> <?php the_author_meta( 'display_name' ); ?></a>
			</span>
			<?php esc_html_e( '-','hesta' ); ?> <?php echo esc_html( get_the_date() ); ?></h3>
		</div>
	<?php } ?>

	<div class="blog_details">
		<!-- title -->
		<?php if( is_single() || is_page() ) { ?>
			<h2><?php the_title(); ?></h2>
		<?php } else { ?>
		<a class="d-inline-block" href="<?php the_permalink(); ?>">
			<h2><?php the_title(); ?></h2>
		</a>
		<?php } ?>
		
		<!-- content -->
		<?php 
		if ( is_single() || is_page() ) {
			the_content();
		} else {
			the_excerpt();
		}
		?>
		
		<?php if ( is_single() && get_the_category_list() ) { ?>
		<ul class="blog-info-link">
			<?php if( get_theme_mod( 'hesta_show_categories','1' ) ) : ?>
			<li><i class="fa fa-user"></i> <span> <?php esc_html_e( "Categories :", 'hesta' ); ?> </span>
				<?php the_category( ' , ' ); ?> </li>
			<li class="tag_list">
				<?php the_tags( __( 'Tags : ', 'hesta' ), ', ', '<br />' ); ?>
            </li>
			<?php endif;
			if( get_theme_mod( 'hesta_show_comments','1' ) ) : ?>
			<li><i class="fa fa-comments"></i> <?php comments_number( '0', '1 comment', '% comments' ); ?> </li>
			<?php endif; ?>
		</ul>
		<?php } ?>
		
		<?php if ( ! is_page() && ! is_single() ) { ?>
		<div class="col-md-12"> <a class="more-btn" target="_blank" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'hesta' ); ?></a> </div>
		<?php } ?>
		
		<?php
		$hesta_pagination = array(
		'before'           => '<p>' . __( 'Pages:', 'hesta' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => __( 'Next page', 'hesta' ),
		'previouspagelink' => __( 'Previous page', 'hesta' ),
		'pagelink'         => '%',
		'echo'             => 1
	);
	wp_link_pages( $hesta_pagination ); ?>
		
	</div>
</div>