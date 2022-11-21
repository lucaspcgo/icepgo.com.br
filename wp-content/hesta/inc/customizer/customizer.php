<?php
/**
 * Hesta: Customizer
 *
 * @package Hesta
 * @since 0.1
 */

class hesta_customizer_settings {

    public function __construct() {

        add_action('customize_register', array($this, 'hesta_customize_register'));
		add_action('customize_controls_enqueue_scripts', array($this, 'hesta_customizer_js'));
    }

    public function init() {
    }
	
	// Load dynamic logic for the customizer controls area.
	function hesta_customizer_js() {
		wp_enqueue_script( 'hesta-customize-controls', get_theme_file_uri( '/inc/customizer/js/customize-control.js' ), array(), '1.2', true);
	}
	
	/*
	** Register Theme Customizer
	*/
	function hesta_customize_register( $wp_customize ) {

		// Active callback for page
		function hesta_slider_layout_page( $control ) { 
			if( 'page' == $control->manager->get_setting('hesta_slider_layout')->value() ){
				return true;
			} else {
				return false;
			}
		}

		// Active callback for post
		function hesta_slider_layout_post( $control ) { 
			if( 'post' == $control->manager->get_setting('hesta_slider_layout')->value() ){
				return true;
			} else {
				return false;
			}
		}

		/* Sanitization Callbacks */
		
		function hesta_sanitize_phone_number( $input ) {
			return preg_replace( '/[^\d+]/', '', $input );
		}
		
		// checkbox
		function hesta_sanitize_checkbox( $input ) {
			return $input ? true : false;
		}
		
		// Custom Controls
		function hesta_sanitize_divider_control( $input ) {
			return $input;
		}
		
		// select
		function hesta_sanitize_select( $input, $setting ) {
			$options = $setting->manager->get_control( $setting->id )->choices;
			return ( array_key_exists( $input, $options ) ? $input : $setting->default );
		}

		/* Functions */
		// slider post
		function hesta_post_control( $section, $setting, $desc ) {
			global $wp_customize;
			$wp_customize->add_setting( $setting,
				   array(
					'type'              => 'theme_mod',
					  'sanitize_callback' => 'absint',
					  'capability'        => 'edit_theme_options',
				   )
				);
			$wp_customize->add_control( new hesta_post( $wp_customize, $setting, 
				array(
					'label' => $desc,
					'description' => '' ,
					'section' => $section, 
					'settings' => $setting,
					'active_callback'   => 'hesta_slider_layout_post',
				)
			) );
		}
		
		// service post
		function hesta_service_post( $section, $setting, $desc ) {
			global $wp_customize;
			$wp_customize->add_setting( $setting,
				   array(
					'type'              => 'theme_mod',
					  'sanitize_callback' => 'absint',
					  'capability'        => 'edit_theme_options',
				   )
				);
			$wp_customize->add_control( new hesta_post( $wp_customize, $setting, 
				array(
					'label' => $desc,
					'description' => '' ,
					'section' => $section, 
					'settings' => $setting,
				)
			) );
		}
		
		// slider page
		function hesta_page_control( $section, $setting, $desc ) {
			global $wp_customize;
			$wp_customize->add_setting( $setting,
			   array(
				  'type'              => 'theme_mod',
				  'sanitize_callback' => 'absint',
				  'capability'        => 'edit_theme_options',
			   )
			);
			$wp_customize->add_control( $setting,
				array(
					'label' => $desc,
					'description' => '' ,
					'section' => $section, 
					'type' => 'dropdown-pages',
					'settings' => $setting,
					'active_callback'   => 'hesta_slider_layout_page',
				)
			);
		}
			
		// checkbox
		function hesta_checkbox_control( $section, $setting, $id, $name ) {
			global $wp_customize;

			$wp_customize->add_setting( 'hesta_'.$setting, array(
				'type'		 => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'hesta_sanitize_checkbox'
			) );
			$wp_customize->add_control( 'hesta_'.$setting, array(
				'label'		=> $name,
				'section'	=> $section,
				'type'		=> 'checkbox',
				'settings'   => 'hesta_'.$setting,
			) );
		}

		// text
		function hesta_text_control( $section, $id, $name ) {
			global $wp_customize;
			$wp_customize->add_setting( 'hesta_'.$id , array(
				'type'		 => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			) );
			$wp_customize->add_control( 'hesta_'.$id , array(
				'label'		=> $name,
				'section'	=> $section,
				'type'		=> 'text',
				'settings'   => 'hesta_'.$id,
			) );
		}

		// select
		function hesta_select_control( $section, $id, $name, $atts ) {
			global $wp_customize;
			$wp_customize->add_setting( 'hesta_'.$id , array(
				'type'		 => 'theme_mod',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'hesta_sanitize_select'
			) );
			$wp_customize->add_control( 'hesta_'.$id , array(
				'label'			=> $name,
				'section'		=> $section,
				'transport'	 => 'refresh',
				'type'			=> 'select',
				'choices' 		=> $atts,
				'settings' => 'hesta_'.$id,
			) );
		}

		$wp_customize->add_panel( 'Hesta_settings', array(
			'title' => __( 'Hesta Settings','hesta' ),
			'priority' => 1, // Mixed with top-level-section hierarchy.
		) );
		
		// Homepage section
		$wp_customize->add_section( 'hesta_homepage_setting' , array(
			'title'		 => esc_html__( 'Homepage Setting', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		// front-page setting
		hesta_checkbox_control( 'hesta_homepage_setting','front_page', 'label', esc_html__( 'Select Option For Custom Frontpage Template', 'hesta' ));
		
		/* theme skin section */
		$wp_customize->add_section( 'hesta_theme_skin' , array(
			'title'		 => esc_html__( 'Theme Skin Setting', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		$hesta_skin_select = array(
			'default' => esc_html__( 'Default', 'hesta' ),
			'dark' => esc_html__( 'Dark', 'hesta' ),
		);
		
		// Skin Select
		hesta_select_control( 'hesta_theme_skin', 'theme_skins', esc_html__( 'Select Theme Skin Color','hesta'), $hesta_skin_select );
		
		/* header section */
		$wp_customize->add_section( 'hesta_header_setting' , array(
			'title'		 => esc_html__( 'Header Setting', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		// search button
		hesta_checkbox_control( 'hesta_header_setting','social_icon', 'label', esc_html__( 'Show Social Icons', 'hesta' ));
		
		$navigation_select = array(
			'left' => esc_html__( 'Left', 'hesta' ),
			'right' => esc_html__( 'Right', 'hesta' ),
		);
		
		// menu navigation select
		hesta_select_control( 'hesta_header_setting', 'menu_align', esc_html__( 'Navigation Alignment','hesta'), $navigation_select );
		
		// top bar //
		hesta_text_control( 'hesta_header_setting', 'address' , esc_html__( 'Address','hesta') );
		
		// email //
		$wp_customize->add_setting( 'hesta_email' , array(
			'type'		 => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_email'
		) );
		$wp_customize->add_control( 'hesta_email' , array(
			'label'		=> esc_html__('Email','hesta'),
			'section'	=> 'hesta_header_setting',
			'type'		=> 'email',
		) );
		
		// phone //
		$wp_customize->add_setting( 'hesta_phone_number' , array(
			'type'		 => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'hesta_sanitize_phone_number'
		) );
		$wp_customize->add_control( 'hesta_phone_number' , array(
			'label'		=> esc_html__('Phone number','hesta'),
			'section'	=> 'hesta_header_setting',
		) );
		
		/* slider section */
		$wp_customize->add_section( 'hesta_slider_setting' , array(
			'title'		 => esc_html__( 'Slider Setting', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		$wp_customize->add_setting('hesta_slider_layout', 
			array(
			'type'=>'theme_mod',
				//'default'           => 'post',        
				'sanitize_callback' => 'hesta_sanitize_select',

			)
		);

		$wp_customize->add_control(
			'hesta_slider_layout', 
			array(      
				'label'     => esc_html__('Select Slider Type', 'hesta'),
				'description' => esc_html__( 'Select Type of slider that show on front page', 'hesta' ),
				'section'   => 'hesta_slider_setting',
				'settings'  => 'hesta_slider_layout',
				'transport' => 'refresh',
				'type'      => 'select',
				'choices'   => array(
					'post'  => esc_html__('post', 'hesta'),
					'page'  => esc_html__('page', 'hesta'),
				),
			)
		);
		
		hesta_post_control( 'hesta_slider_setting', 'hesta_post_1', esc_html__( 'Select Post for Slider', 'hesta' ) );
		hesta_post_control( 'hesta_slider_setting', 'hesta_post_2', esc_html__( 'Select Post for Slider', 'hesta' ) );
		hesta_post_control( 'hesta_slider_setting', 'hesta_post_3', esc_html__( 'Select Post for Slider', 'hesta' ) );
		hesta_page_control( 'hesta_slider_setting', 'hesta_page_1', esc_html__( 'Select Page for Slider', 'hesta' ) );
		hesta_page_control( 'hesta_slider_setting', 'hesta_page_2', esc_html__( 'Select Page for Slider', 'hesta' ) );
		hesta_page_control( 'hesta_slider_setting', 'hesta_page_3', esc_html__( 'Select Page for Slider', 'hesta' ) );
	  
		// slider btn text
		hesta_text_control( 'hesta_slider_setting', 'slider_btn_text' , esc_html__( 'Slider Button Text','hesta') );
		
		/* service section */
		$wp_customize->add_section( 'hesta_service_setting' , array(
			'title'		 => esc_html__( 'Service Section', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		hesta_checkbox_control( 'hesta_service_setting','service_show', 'label',  esc_html__( 'Select option to show Service Section on Frontpage', 'hesta' ));
		
		hesta_text_control( 'hesta_service_setting', 'service_title' , esc_html__( 'Service Title','hesta') );
		
		hesta_text_control( 'hesta_service_setting', 'service_desc' , esc_html__( 'Service Description','hesta') );
		
		hesta_service_post( 'hesta_service_setting', 'hesta_service_1', esc_html__( 'Select Post for Service', 'hesta' ) );
		hesta_service_post( 'hesta_service_setting', 'hesta_service_2', esc_html__( 'Select Post for Service', 'hesta' ) );
		hesta_service_post( 'hesta_service_setting', 'hesta_service_3', esc_html__( 'Select Post for Service', 'hesta' ) );
		hesta_service_post( 'hesta_service_setting', 'hesta_service_4', esc_html__( 'Select Post for Service', 'hesta' ) );
		
		/* about section */
		$wp_customize->add_section( 'hesta_about_setting' , array(
			'title'		 => esc_html__( 'About Section', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		hesta_checkbox_control( 'hesta_about_setting','about_show', 'label',  esc_html__( 'Select option to show About Section on Frontpage', 'hesta' ));
		
		hesta_page_control( 'hesta_about_setting', 'hesta_about_page' , esc_html__( 'Select Page for About Us Section', 'hesta' ) );
		
		// about btn text
		hesta_text_control( 'hesta_about_setting', 'about_btn_text' , esc_html__( 'About Us Button Text','hesta') );
		
		/* blog section */
		$wp_customize->add_section( 'hesta_blog_setting' , array(
			'title'		 => esc_html__( 'Blog Section', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		hesta_text_control( 'hesta_blog_setting', 'blog_title' , esc_html__( 'Blog Title','hesta') );
		
		hesta_text_control( 'hesta_blog_setting', 'blog_desc' , esc_html__( 'Blog Description','hesta') );
		
		hesta_text_control( 'hesta_blog_setting', 'blog_btn_text' , esc_html__( 'Blog Button Text','hesta') );
		
		/* blog page */
		$wp_customize->add_section( 'hesta_blogpage_setting' , array(
			'title'		 => esc_html__( 'Blog Page Settings', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		$sidebar_select = array(
			'show-sidebar' => esc_html__( 'Show Sidebar', 'hesta' ),
			'hide-sidebar' => esc_html__( 'Hide Sidebar', 'hesta' ),
		);
		
		// blog page sidebar
		hesta_select_control( 'hesta_blogpage_setting', 'blog_sidebar', esc_html__( 'Blog Page Sidebar On/Off','hesta'), $sidebar_select );
		
		$wp_customize->add_setting( 'hesta_single_blog', array(
			'sanitize_callback' => 'hesta_sanitize_divider_control'
		) );

		$wp_customize->add_control( new hesta_Customize_Control_Divider( $wp_customize, 'hesta_single_blog', array(
			'type' => 'hesta_control_divider',
			'section'  => 'hesta_blogpage_setting',
			'settings' => 'hesta_single_blog'
		) ) );
		
		// single blog page sidebar
		hesta_select_control( 'hesta_blogpage_setting', 'single_sidebar', esc_html__( 'Single Blog Page Sidebar On/Off','hesta'), $sidebar_select );
		
		// Show Featured Image
		hesta_checkbox_control( 'hesta_blogpage_setting', 'show_featured_image', 'label', esc_html__( 'Show Featured Image', 'hesta' ));

		// Show Categories
		hesta_checkbox_control( 'hesta_blogpage_setting', 'show_categories', 'label', esc_html__( 'Show Categories', 'hesta' ));

		// Show Comments
		hesta_checkbox_control( 'hesta_blogpage_setting', 'show_comments', 'label', esc_html__( 'Show Comments', 'hesta' ));

		// Show Author
		hesta_checkbox_control( 'hesta_blogpage_setting', 'show_author_date', 'label', esc_html__( 'Show Author and Date', 'hesta' ));
		
		/* footer section */
		$wp_customize->add_section( 'hesta_footer_setting' , array(
			'title'		 => esc_html__( 'Footer Settings', 'hesta' ),
			'priority'	 => 2,
			'panel'=>'Hesta_settings',
			'capability' => 'edit_theme_options'
		) );
		
		$widget_select = array(
			'6' => esc_html__( '2 Column', 'hesta' ),
			'4' => esc_html__( '3 Column', 'hesta' ),
			'3' => esc_html__( '4 Column', 'hesta' ),
		);
		
		// column select
		hesta_select_control( 'hesta_footer_setting', 'footer_column', esc_html__( 'Footer Widegt Area Column','hesta'), $widget_select );
		
		hesta_text_control( 'hesta_footer_setting', 'copyright' , esc_html__( 'Copyright Text','hesta') );
		
		hesta_text_control( 'hesta_footer_setting', 'footer_info' , esc_html__( 'Footer Theme Text','hesta') );
		
		$wp_customize->add_setting( 'hesta_link', array(
			'type'		 => 'theme_mod',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		) );
		$wp_customize->add_control( 'hesta_link', array(
			'label'		=> __( 'Footer Link', 'hesta' ),
			'section'	=> 'hesta_footer_setting',
			'settings' => 'hesta_link',
			'type'		=> 'text',
		) );
		
		$footer_align = array(
			'left' => esc_html__( 'Left', 'hesta' ),
			'center' => esc_html__( 'Center', 'hesta' ),
			'right' => esc_html__( 'Right', 'hesta' ),
		);
		
		hesta_select_control( 'hesta_footer_setting', 'footer_align', esc_html__( 'Footer Info Alignment','hesta'), $footer_align );

}
}
new hesta_customizer_settings();

/* class for thumbnail images */
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'hesta_post' ) ) :
	class hesta_post extends WP_Customize_Control {  
		public function render_content(){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php $args = array( 'post_type' => 'post', 'post_status'=>'publish'); 
				$slide_id = new WP_Query( $args ); ?>
				<select <?php $this->link(); ?> >
				<?php if($slide_id->have_posts()):
					while($slide_id->have_posts()):
						$slide_id->the_post(); ?>
						<option value= "<?php echo esc_attr(get_the_id()); ?>" <?php if($this->value()== get_the_id() ) echo 'selected="selected"';?>><?php the_title(); ?></option>
						<?php
					endwhile; 
				wp_reset_postdata(); 
				endif; ?>
				</select>
		<?php
		}
	}
endif;

//Control Divider
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'hesta_Customize_Control_Divider' ) ) :
	class hesta_Customize_Control_Divider extends WP_Customize_Control {
		public $type = 'hesta_control_divider';

		public function render_content() {
			echo '<hr>';
		}
	}
endif;


