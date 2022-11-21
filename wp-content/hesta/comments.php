<?php
/**
 * The template for displaying Comments
 *
 * @package Hesta
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
        <h4 class="comments-title">
			<?php
			if ( 1 === get_comments_number() ) {
				printf(
				/* translators: %s: The post title. */
					esc_html_e( 'One thought on &ldquo;%s&rdquo;', 'hesta' ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			} else {
				printf(
				/* translators: %1$s: The number of comments. %2$s: The post title. */
					esc_html( _n( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'hesta' ) ),
					esc_html( number_format_i18n( get_comments_number() ) ),
					'<span>' . esc_html( get_the_title() ) . '</span>'
				);
			}
			?>
        </h4>
        <ol class="commentlist">
			<?php
			wp_list_comments(
				array(
					'callback' => 'hesta_comment',
					'style'    => 'ol',
				)
			);
			?>
        </ol><!-- .commentlist -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation" role="navigation">
                <h1 class="assistive-text section-heading"><?php esc_html_e( 'Comment navigation', 'hesta' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'hesta' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'hesta' ) ); ?></div>
            </nav>
		<?php endif; endif; // check for comment navigation 
	
	/* If there are no comments and comments are closed, let's leave a note.
	 * But we only want the note on posts and pages that had comments in the first place.
	 */
	if ( comments_open() ) { ?>
        <div class="leave-coment-form">
			<?php $fields = array(
				'author' => '<div class="row"><div class="col-sm-6 form-group"><input name="author" id="name" type="text" id="exampleInputEmail1" class="form-control" placeholder="'.esc_attr__( 'Name','hesta' ).'"></div>',
				'email'  => '<div class="col-sm-6 form-group"><input  name="email" id="email" type="text" class="form-control" placeholder="'.esc_attr__( 'Email','hesta' ).'"></div></div>',
			);
			function hesta_fields( $fields ) {
				return $fields;
			}

			add_filter( 'hesta_comment_form', 'hesta_fields' );
			$defaults = array(
				'fields'         => apply_filters( 'hesta_comment_form', $fields ),
				'comment_field'  => '<div class="leave-coment-form"><div class="form-group">
			<textarea id="comment" name="comment" class="form-control w-100" placeholder="'.esc_attr__( 'Your comment here...','hesta' ).'" required=""></textarea></div></div>',
				'logged_in_as'   => '<h4 class="logged-in-as">' . __( "Logged in as ", 'hesta' ) . '<a href="' . esc_url( admin_url( 'profile.php' ) ) . '">' . $user_identity . '</a>' . '<a href="' . esc_url( wp_logout_url( get_permalink() ) ) . '" title="'.esc_attr__( 'Log out of this account','hesta' ).'">' . __( " Log out?", 'hesta' ) . '</a>' . '</h4>',
				/* translators: %s: reply to name */
				'title_reply_to' => __( 'Leave a Reply to %s', 'hesta' ),
				'id_submit'      => 'hero-btn',
				'label_submit'   => __( 'Post Comment', 'hesta' ),
				'title_reply'    => '<h4>' . __( 'Leave a Reply', 'hesta' ) . '</h4>',
				'role_form'      => 'form',
			);
			comment_form( $defaults ); ?>
        </div>
	<?php } else { ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'hesta' ); ?></p>
	<?php } ?>
</div>