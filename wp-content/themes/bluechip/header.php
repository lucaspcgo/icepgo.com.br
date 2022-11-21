<?php
/**
 * The header for our theme.
 *
 *
 * @package bluechip
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />

		<?php // force Internet Explorer to use the latest rendering engine available ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?> >
	<?php wp_body_open(); ?>
			
		<?php 
		/**
         * Functions hooked in to bluechip_header action.
         *
         * @hooked bluechip_template_header 
         */
		do_action('bluechip_header'); ?>

		<div id="content-area">