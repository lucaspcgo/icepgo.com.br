<?php /*
* theme functions 
*/

if ( ! function_exists( 'hesta_blogpage_sidebar' ) ) :
	function hesta_blogpage_sidebar() {
		if( get_theme_mod('hesta_blog_sidebar','show-sidebar') == "show-sidebar" )
			$hesta_blog_div = 8;
		else $hesta_blog_div = 12;
		return $hesta_blog_div;
	}
endif;

if ( ! function_exists( 'hesta_single_sidebar' ) ) :
	function hesta_single_sidebar() {
		if( get_theme_mod('hesta_single_sidebar','show-sidebar') == "show-sidebar" )
			$hesta_blog_div = 8;
		else $hesta_blog_div = 12;
		return $hesta_blog_div;
	}
endif;


/* display comments */
if ( ! function_exists( 'hesta_comment' ) ) :
	function hesta_comment( $comment, $args, $depth ) {
		//get theme data
		global $comment_data;
		//translations
		$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] :
			__( 'Reply', 'hesta' ); ?>
        <div class="comment-list">
            <div class="single-comment justify-content-between d-flex">
				<div class="user justify-content-between d-flex">
					<div class="thumb">
						<?php echo get_avatar( $comment, $size = '60' ); ?>
					</div>
					<div class="desc">
						<?php comment_text(); ?>
						<div class="d-flex justify-content-between">
							<div class="d-flex align-items-center">
								<h5><?php comment_author(); ?></h5>
								<p class="date"><?php comment_date(); ?> <?php esc_html_e( 'at', 'hesta' ); ?>&nbsp;<?php comment_time( 'g:i a' ); ?>  </p>
							</div>

							<div class="reply-btn">
								<?php comment_reply_link( array_merge( $args, array(
									'reply_text' => $leave_reply,
									'depth'      => $depth,
									'max_depth'  => $args['max_depth']
								) ) ) ?>
							</div>

							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'hesta' ); ?></em>
								<br/>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
        </div>
	<?php }
endif;

/* single post navigation */
function hesta_single_navigation() { ?>
    <div class="row navigation-area">
		<?php $hesta_prevPost = get_previous_post(true);
		if($hesta_prevPost) {?>
		<?php $hesta_prevthumbnail = get_the_post_thumbnail_url($hesta_prevPost->ID, array(100,100) );?>
		<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
			<?php if($hesta_prevthumbnail) { ?>
            <div class="thumb">
				<img class="img-fluid" src="<?php echo esc_url( $hesta_prevthumbnail ); ?>">
            </div>
			<?php } ?>
			<div class="detials">
				<h4><?php previous_post_link(); ?></h4>
			</div>
		</div>

		<?php } $hesta_nextPost = get_next_post(true);
		if($hesta_nextPost) {
		$hesta_nextthumbnail = get_the_post_thumbnail_url($hesta_nextPost->ID, array(100,100) ); ?>
		<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
			<div class="detials">
                <h4><?php next_post_link(); ?></h4>
            </div>
			<?php if($hesta_nextthumbnail) { ?>
			<div class="thumb">
				<img class="img-fluid" src="<?php echo esc_url( $hesta_nextthumbnail ); ?>" alt="">
            </div>
			<?php } } ?>
		</div>
	</div>
	<?php
}
add_action( 'hesta_blog_navigation', 'hesta_single_navigation' );

/* pagination link for index, author, category, tag pages */
function hesta_navigation() { ?>
    <nav class="blog-pagination">
		<?php posts_nav_link(); ?>
    </nav>
	<?php
}
add_action( 'hesta_pagination', 'hesta_navigation' );

/* excerpt length */
function hesta_excerpt_length( $length ) {
	if ( is_admin() ) return $length; return 30;
}
add_filter( 'excerpt_length', 'hesta_excerpt_length' );

/* wp_body_open function check */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}