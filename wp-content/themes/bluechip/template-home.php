<?php
/**
 * Template Name: Homepage
 *
 *
 * @package bluechip
 */

get_header(); ?>

    <?php 
     /**
     * Functions hooked in to bluechip_home_banner action.
     *
     * @hooked bluechip_template_banner 
     */
    do_action('bluechip_home_banner'); ?>
    
    <?php 
    /**
     * Functions hooked in to bluechip_home action.
     *
     * @hooked bluechip_template_section_1 -10 
     * @hooked bluechip_template_section_2 -15
     */
    do_action('bluechip_home'); 

get_footer(); ?>