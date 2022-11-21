<?php 
/**
 * Hesta hooks.
 *
 * @package Hesta
 */

/* ------------------------------ HEADER ------------------------------ */
/**
 * Header doctype.
 *
 * @see hesta_doc_type()
 */
add_action( 'hesta_doctype_section', 'hesta_doc_type', 10 );

/**
 * Header section.
 *
 * @see hesta_head_section()
 */
add_action( 'hesta_header_section', 'hesta_head_section', 10 );

/**
 * Header link section.
 *
 * @see hesta_header_info()
 */
add_action( 'hesta_header_link', 'hesta_header_info', 10 );

/**
 * Header logo section.
 *
 * @see hesta_logo()
 */
add_action( 'hesta_logo_area', 'hesta_logo', 10 );

/**
 * Header menu section.
 *
 * @see hesta_menu()
 */
add_action( 'hesta_menu_area', 'hesta_menu', 10 );

/**
 * Header section.
 *
 * @see hesta_social_section()
 */
add_action( 'hesta_social_area', 'hesta_social_section', 10 );

/* --------------------------- FOOTER ------------------------------------*/
/* 
* footer widget
*
* @see hesta_footer_widget() 
*/
add_action( 'hesta_footer_widget_area', 'hesta_footer_widget' );
/* 
* footer copyright
*
* @see hesta_footer_copyright() 
*/
add_action( 'hesta_footer_copyright_area', 'hesta_footer_copyright' );