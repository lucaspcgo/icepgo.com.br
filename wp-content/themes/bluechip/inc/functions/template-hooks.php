<?php 

/**
 * theme template hooks
 *
 * @package bluechip
 */

/**
 * site header
 */
add_action( 'bluechip_header', 'bluechip_template_header' );
function bluechip_template_header(){ 
    $get_banner_id = get_theme_mod( 'bluechip_banner' );
    $social = do_shortcode('[contact_details type="social" format="horizontal" fields="twitter,facebook,instagram,pinterest,google_plus,linkedin,vimeo,youtube,github"]');
    ?>
	<header id="site-header"<?php if( empty($get_banner_id) && is_front_page() && is_home() ) : ?> class="head-with-bgcolor" <?php endif; ?>>
        <div class="top-contact-info">
            <div class="container">
                <div class="row">
                    <?php bluechip_template_important_info(); ?>
                    <?php if( $social && shortcode_exists( 'contact_details' ) ){ ?>
                    <div class="col-sm-6 social-icons">
                        <?php 
                            echo wp_kses_post( $social ); ?>
                    </div>
                    <?php } ?>
                    <span class="clearfix"></span>
                </div>
            </div>
        </div>
        <div class="container">
    		<nav class="navbar navbar-default" role="navigation">
    			<!-- Brand and toggle get grouped for better mobile display -->
    			<div class="navbar-header">

    				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navigation">
    				<span class="sr-only"><?php _e( 'Toggle navigation','bluechip' ); ?></span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    				<span class="icon-bar"></span>
    				</button>

                    <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ): 
                    $bluechip_custom_logo_id = get_theme_mod( 'custom_logo' );
                    $image = wp_get_attachment_image_src( $bluechip_custom_logo_id,'full');
                    ?>
                    <h1 id="logo"><a class="navbar-brand" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src="<?php echo esc_url( $image[0] ); ?>"></a></h1>
                    <?php else : ?>
                    <h1 id="logo"><a class="navbar-brand" href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php echo esc_html( bloginfo('name') ); ?></a></h1>
                    <?php endif; ?>

    			</div>

    			<div class="collapse navbar-collapse" id="main-navigation">
    				<?php 
    				wp_nav_menu( array(
    				'menu'              => 'main-nav',
    				'theme_location'    => 'main-nav',
    				'depth'             => 2,
    				'container'         => 'false',
    				'container_class'   => 'collapse navbar-collapse',
    				'menu_class'        => 'nav navbar-nav navbar-right',
    				'fallback_cb'       => 'bluechip_primary_menu_fallback',
    				'walker'            => new wp_bootstrap_navwalker())
    				);
    				
    				?>
    			</div><!-- /.navbar-collapse -->
    		</nav>
        </div>
	</header>
<?php
}

/**
 * related posts
 */
add_action( 'bluechip_relate_posts', 'bluechip_template_related_posts' );
function bluechip_template_related_posts(){ 
	global $post;
	$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
	if ( get_theme_mod('bluechip_related_posts') ):
	$related_class = 'related-hide';
	else :
	$related_class = '';
	endif;
	if (!empty($related)): ?>

		<div class="related-posts<?php echo " " . esc_attr( $related_class ); ?>">
			<h3 class="entry-footer-title"><?php esc_html_e('You may also like ','bluechip'); ?></h3>
			<div class="row">
			<?php if( $related ): foreach( $related as $post ) { ?>
			<?php setup_postdata($post); ?>
			
				<div class="col-md-4 related-item">
					<div class="related-image">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
							<?php $image_thumb = bluechip_catch_that_image_thumb(); $gallery_thumb = bluechip_catch_gallery_image_thumb(); 
							if ( has_post_thumbnail()):
							the_post_thumbnail('600x600');  
							elseif(has_post_format('gallery') && !empty($gallery_thumb)): 
							echo wp_kses_post( $gallery_thumb ); 
							elseif(has_post_format('image') && !empty($image_thumb)): 
							echo '<img src="'. esc_url($image_thumb) . '">'; 
							else: ?>
							<?php $blank = get_template_directory_uri() . '/assets/images/blank.jpg'; ?>
							<img src="<?php echo esc_url($blank); ?>">
							<?php endif; ?>
						</a>
					</div>

					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

				</div>
			

			<?php } endif; wp_reset_postdata(); ?>

			</div>

		</div>
	<?php endif; 
}

/**
 * Site information
 */
add_action( 'bluechip_site_info', 'bluechip_template_important_info' );
function bluechip_template_important_info(){ 

    if(shortcode_exists( 'contact_details' )){

    $location   = strip_tags( do_shortcode('[contact_details format="horizontal" fields="address"]') );
    $phone      = strip_tags( do_shortcode('[contact_details format="horizontal" fields="phone"]') );
    $email      = strip_tags( do_shortcode('[contact_details format="horizontal" fields="email"]') );

    ?>
    <?php if( $location || $phone || $email ){ ?>
    <div class="col-sm-6 important-info">
		<p><?php echo '<span class="fa fa-map-marker "></span>' . esc_html( $location ); ?></p>
		<p><?php echo '<span class="fa fa-phone"></span>' . esc_html( $phone ); ?></p>
		<p><?php echo '<span class="fa fa-envelope"></span>' . esc_html( $email ); ?></p>
    </div>
    <?php } ?>
<?php
    }
}


/**
 * Homepage Sections
 */
add_action( 'bluechip_home_banner', 'bluechip_template_banner', 10 );

function bluechip_template_banner(){ ?>
	<?php 
        $get_banner_id = get_theme_mod( 'bluechip_banner' );
        $post = get_post( $get_banner_id );
        $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($get_banner_id) );
        $content = apply_filters('the_content', $post->post_content);

        if( $get_banner_id ) :
    ?>
    <section id="banner" style="<?php if( $thumb_url ) { ?> background-image: url( <?php echo esc_url( $thumb_url ); ?> ); <?php } ?>">
        <div class="container">
            <div class="col-md-offset-2 col-md-8 section-content">
                <?php echo $content; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
<?php
}

add_action( 'bluechip_home', 'bluechip_template_section_1', 10 );
add_action( 'bluechip_home', 'bluechip_template_section_2', 15 );
add_action( 'bluechip_home', 'bluechip_template_section_3', 20 );
add_action( 'bluechip_home', 'bluechip_template_section_4', 25 );
add_action( 'bluechip_home', 'bluechip_template_section_5', 30 );

function bluechip_template_section_1(){

        $get_sec_1_id = get_theme_mod( 'bluechip_section_1' );
        $post_1 = get_post( $get_sec_1_id );
        $thumb_url_1 = wp_get_attachment_url( get_post_thumbnail_id($get_sec_1_id) );
        $content_1 = apply_filters('the_content', $post_1->post_content);

        if( $get_sec_1_id ) :
    ?>
        <section id="section-1">
            <div class="container">
            <div class="section-content">
                <?php echo $content_1; ?>
            </div>
            </div>
            <span class="clearfix"></span>
        </section>

    <?php endif;

}

function bluechip_template_section_2(){

        $get_sec_2_id = get_theme_mod( 'bluechip_section_2' );
        $post_2 = get_post( $get_sec_2_id );
        $thumb_url_2 = wp_get_attachment_url( get_post_thumbnail_id($get_sec_2_id) );
        $content_2 = apply_filters('the_content', $post_2->post_content);

        if( $get_sec_2_id ) :
    ?>
        
        <section id="section-2">
            <span class="section-bg col-md-6 pull-left" style="<?php if( $thumb_url_2 ) { ?> background-image: url( <?php echo esc_url( $thumb_url_2 ); ?> ); <?php } ?>"></span>
            <div class="section-content col-md-6 pull-right">
                <?php echo $content_2; ?>
            </div>
            <span class="clearfix"></span>
        </section>
    
    <?php endif; 
}

function bluechip_template_section_3(){

        $get_sec_3_id = get_theme_mod( 'bluechip_section_3' );
        $post_3 = get_post( $get_sec_3_id );
        $thumb_url_3 = wp_get_attachment_url( get_post_thumbnail_id($get_sec_3_id) );
        $content_3 = apply_filters('the_content', $post_3->post_content);

        if( $get_sec_3_id ) :
    ?>
        
        <section id="section-3">
            <div class="section-content col-md-6 pull-left">
                <?php echo $content_3; ?>
            </div>
            <span class="section-bg col-md-6 pull-right" style="<?php if( $thumb_url_3 ) { ?> background-image: url( <?php echo esc_url( $thumb_url_3 ); ?> ); <?php } ?>"></span>
            <span class="clearfix"></span>
        </section>
    
    <?php endif; 
}

function bluechip_template_section_4(){

        $get_sec_4_id = get_theme_mod( 'bluechip_section_4' );
        $post_4 = get_post( $get_sec_4_id );
        $thumb_url_4 = wp_get_attachment_url( get_post_thumbnail_id($get_sec_4_id) );
        $content_4 = apply_filters('the_content', $post_4->post_content);

        if( $get_sec_4_id ) :
    ?>
        <section id="section-4">
            <div class="container">
            <div class="section-content">
                <?php echo $content_4; ?>
            </div>
            </div>
            <span class="clearfix"></span>
        </section>

    <?php endif;

}

function bluechip_template_section_5(){

        $get_sec_5_id = get_theme_mod( 'bluechip_section_5' );
        $post_5 = get_post( $get_sec_5_id );
        $thumb_url_5 = wp_get_attachment_url( get_post_thumbnail_id($get_sec_5_id) );
        $content_5 = apply_filters('the_content', $post_5->post_content);

        if( $get_sec_5_id ) :
    ?>
        <section id="section-5" style="<?php if( $thumb_url_5 ) { ?> background-image: url( <?php echo esc_url( $thumb_url_5 ); ?> ); <?php } ?>">
            <div class="container">
            <div class="section-content">
                <?php echo $content_5; ?>
            </div>
            </div>
            <span class="clearfix"></span>
        </section>

    <?php endif;

}

/**
 * Footer Hooks
 */
add_action( 'bluechip_footer', 'bluechip_template_footer_widgets', 10 );
add_action( 'bluechip_footer', 'bluechip_template_copyright', 15 );

function bluechip_template_footer_widgets(){ 
	if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="footer-widgets wrap">
                        <div class="col-sm-4 footer-item"><?php dynamic_sidebar( 'footer-1' ); ?></div>
                        <div class="col-sm-4 footer-item"><?php dynamic_sidebar( 'footer-2' ); ?></div>
                        <div class="col-sm-4 footer-item"><?php dynamic_sidebar( 'footer-3' ); ?></div>
                    
                    <span class="clearfix"></span>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
<?php
}

function bluechip_template_copyright(){ ?>
    <div class="footer-copyright">
        <div class="container">
            &#169; <?php echo date_i18n('Y') . ' '; bloginfo( 'name' ); ?>
            <span><?php if(is_home() || is_front_page()): ?>
                - <?php echo __( 'Built with ','bluechip' ); ?><a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bluechip' ) ); ?>" rel="nofollow" target="_blank" ><?php printf('%s', 'WordPress' ); ?></a> <span><?php _e('and','bluechip'); ?></span> <a href="<?php echo esc_url( __( 'https://wpdevshed.com/themes/blue-chip/', 'bluechip' ) ); ?>" rel="nofollow" target="_blank"><?php printf( esc_html( '%s', 'bluechip' ), 'Bluechip' ); ?></a>
            <?php endif; ?>
            </span>
        </div>
    </div>
<?php
}