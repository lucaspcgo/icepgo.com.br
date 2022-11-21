<?php
/**
* The header for our theme
*
* This is the template that displays all of the header section
*
* @package Hesta
* @since 0.1
*/
/* 
* Functions hooked into hesta_doctype_section action
*
* @hooked hesta_doc_type
*/
do_action( 'hesta_doctype_section' );
?>
<head>
	<?php
	/* 
	* Functions hooked into hesta_head_section action
	*
	* @hooked hesta_head_section
	*/
	do_action( 'hesta_header_section' );
	wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#content">
<?php esc_html_e( 'Skip to content', 'hesta' ); ?></a>
<div class="header-info">
	<?php 
	/* 
	* Functions hooked into hesta_header_link action
	*
	* @hooked hesta_header_info
	*/
	do_action( 'hesta_header_link' ); 
	?>
</div>
<header class="header" id="myHeader" <?php if ( has_header_image() ) { ?> style="background-image:url(<?php echo esc_url( get_header_image() ); ?>)" <?php } ?>>
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-sm-2">
				<?php 
				/* 
				* Functions hooked into hesta_logo_area action
				*
				* @hooked hesta_logo
				*/
				do_action( 'hesta_logo_area' );
				?>
			</div>
			<div class="col-lg-8 col-sm-4">
				<?php 
				/* 
				* Functions hooked into hesta_menu_area action
				*
				* @hooked hesta_menu
				*/
				do_action( 'hesta_menu_area' ); 
				?>
			</div>
			<div class="col-lg-2 col-sm-6">
				<?php 
				/* 
				* Functions hooked into hesta_social_area action
				*
				* @hooked hesta_social_section
				*/
				do_action( 'hesta_social_area' );
				?>
			</div>
		</div>
	</div>
</header>