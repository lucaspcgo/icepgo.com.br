<div id="post-<?php the_ID(); ?>" <?php post_class( 'hesta_page' ); ?>>
	
	<?php if ( has_post_thumbnail() ) { ?>
	<div class="blog_item_img">
		<img class="card-img rounded-0" src="<?php the_post_thumbnail_url(); ?>" alt="">
		<div class="blog_item_date">
			<h3><span class="entry-author">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>"> <?php esc_html_e( 'By','hesta' ); ?> <?php the_author_meta( 'display_name' ); ?></a>
			</span>
			<?php esc_html_e( '-','hesta' ); ?> <?php echo esc_html( get_the_date() ); ?></h3>
		</div>
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
		<h2><?php the_title(); ?></h2>
		
		<!-- content -->
		<?php the_content(); 
		
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