<?php

/**
 * load bluechip functions and definitions.
 *
 * @package bluechip
 */

/**
 * load functions
 */
require get_template_directory() . '/inc/functions/functions.php'; 

/**
 * load custom functions
 */
require get_template_directory() . '/inc/functions/custom-functions.php';

/**
 * load template hooks
 */
require get_template_directory() . '/inc/functions/template-hooks.php';

/**
 * load bootstrap navwalker
 */
require get_template_directory() . '/assets/wp_bootstrap_navwalker.php'; /* Theme wp_bootstrap_navwalker display */

/**
 * customizer
 */
require get_template_directory() . '/inc/customizer/controls.php';
require get_template_directory() . '/inc/customizer/display.php';