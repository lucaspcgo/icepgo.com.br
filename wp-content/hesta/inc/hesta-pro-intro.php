<?php if (!function_exists('hesta_info_page')) {
	function hesta_info_page() {
	$page1=add_theme_page(__('Welcome to Hesta', 'hesta'), __('<span style="color:#ffe100">About Hesta</span>', 'hesta'), 'edit_theme_options', 'hesta', 'hesta_display_theme');
	
	add_action('admin_print_styles-'.$page1, 'hesta_pro_info');
	}	
}
add_action('admin_menu', 'hesta_info_page');

function hesta_pro_info(){
	// CSS
	wp_enqueue_style('bootstrap',  get_template_directory_uri() .'/assets/css/bootstrap.css');
	wp_enqueue_style('admin',  get_template_directory_uri() .'/assets/css/admin-themes.css');
	//JS
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap-js',get_template_directory_uri() .'/assets/js/bootstrap.js');
} 
if (!function_exists('hesta_display_theme')) {
	function hesta_display_theme() {
		$theme_data = wp_get_theme(); ?>
	<div class="wrap elw-page-welcome about-wrap seting-page">

	    <div class="row hesta-pro">
	        <div class=" col-md-12">
	            <?php $wl_th_info = wp_get_theme(); ?>
					<h2><span class="hesta-title"><?php esc_html_e('Hesta - ','hesta'); ?> <?php echo esc_html( $wl_th_info->get('Version') ); ?> </span></h2>						
				</p>
			</div>
		</div> 
		
		<div class="container">
			<div class="row intro-section">
				<div class="col-md-12">
					<div class="info-box1">
						<h3 class="support"><?php esc_html_e('Theme Preview','hesta'); ?></h3>
						<p style="display: block;margin: 0 auto;padding-top: 20px;"> <a class="support-btn" target="_blank" href="http://kdstheme.in/hesta/"><?php esc_html_e('Theme Preview Link','hesta'); ?></a></p>
					</div>
				</div>
			</div>
		</div>

	<div class="container mt-3">
		<div class="row">
			<div class="col-md-8 document">
				<nav>
					<h3 class="support"><?php esc_html_e('Documentation','hesta'); ?></h3>	
				</nav>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
						<ol>
							<li> <?php esc_html_e('Create a New Page > Home','hesta'); ?> </li>
							<li> <?php esc_html_e('Go to Appearance -> Customize > Homepage Settings -> select A static page option. Select Page which is created in last step','hesta'); ?> </li>
							<li> <?php esc_html_e('Now Go to Customize -> Hesta Settings -> Homepage Setting.','hesta'); ?> </li>
							<li> <?php esc_html_e('Select Option For Custom Frontpage Template','hesta'); ?> </li>
							<li> <?php esc_html_e('Save changes','hesta'); ?> </li>
						</ol>
						<a class="add_page" target="_blank" href="<?php echo admin_url('/post-new.php?post_type=page') ?>"><?php esc_html_e('Add New Page','hesta'); ?></a>
						
					</div>
					
				</div>		
			</div>
		</div>
	</div>
<?php
	}
}
?>