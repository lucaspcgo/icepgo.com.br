<?php
if (!defined('ABSPATH')) {
    exit();
}

class Admin_2020_module_admin_advanced
{
    public function __construct($version, $path, $utilities)
    {
        $this->version = $version;
        $this->path = $path;
        $this->utils = $utilities;
    }

    /**
     * Loads menu actions
     * @since 1.0
     */

    public function start()
    {
		///REGISTER THIS COMPONENT
		add_filter('admin2020_register_component', array($this,'register'));
		
		if(!$this->utils->enabled($this)){
			return;
		}
		
		$info = $this->component_info();
		$optionname = $info['option_name'];
		
		if($this->utils->is_locked($optionname)){
			return;
		}
		
		
		
		add_action('admin_head',array($this,'add_body_styles'),0);
		
		
		
    }
	
	
	/**
	 * Loads custom js and css
	 * @since 1.0
	 */
	
	public function start_front()
	{
		
		if(!$this->utils->enabled($this)){
			return;
		}
		
		$info = $this->component_info();
		$optionname = $info['option_name'];
		
		if($this->utils->is_locked($optionname)){
			return;
		}
		
		
		
		add_action('login_head',array($this,'add_body_styles_front'));
		
	}
	
	
	/**
	 * Register advanced component
	 * @since 1.4
	 * @variable $components (array) array of registered admin 2020 components
	 */
	public function register($components){
		
		array_push($components,$this);
		return $components;
		
	}
	
	
	
	/**
	 * Returns component info for settings page
	 * @since 1.4
	 */
	public function component_info(){
		
		$data = array();
		$data['title'] = __('Advanced','admin2020');
		$data['option_name'] = 'admin2020_admin_advanced';
		$data['description'] = __('Creates options for adding custom CSS and JS.','admin2020');
		return $data;
		
	}
	
	/**
	 * Returns settings options for settings page
	 * @since 2.1
	 */
	public function get_settings_options(){
		
		$info = $this->component_info();
		$optionname = $info['option_name'];
		
		$settings = array();
		
		
		$temp = array();
		$temp['name'] = __('Advanced module disabled for','admin2020');
		$temp['description'] = __("Custom CSS and JS will not load for the selected roles and users.",'admin2020');
		$temp['type'] = 'user-role-select';
		$temp['optionName'] = 'disabled-for'; 
		$temp['value'] = $this->utils->get_option($optionname,$temp['optionName'], true);
		$settings[] = $temp;
		
		$temp = array();
		$temp['name'] = __('Custom CSS','admin2020');
		$temp['description'] = __("CSS added here will be loaded on every admin page as well as the login page",'admin2020');
		$temp['type'] = 'code-area-css';
		$temp['optionName'] = 'custom-css'; 
		$temp['language'] = 'language-css';
		$temp['value'] = $this->utils->get_option($optionname,$temp['optionName'], false);
		$settings[] = $temp;
		
		$temp = array();
		$temp['name'] = __('Custom JS','admin2020');
		$temp['description'] = __("Javascript added here will be loaded on every admin page as well as the login page",'admin2020');
		$temp['type'] = 'code-area-css';
		$temp['optionName'] = 'custom-js'; 
		$temp['language'] = 'language-js';
		$temp['value'] = stripslashes($this->utils->get_option($optionname,$temp['optionName'], false));
		$settings[] = $temp;
		
		
		
		return $settings;
		
	}
	
	
	
	/**
	* Adds custom css for custom background colors
	* @since 1.4
	*/
	
	public function add_body_styles(){
		
		
		$info = $this->component_info();
		$optionname = $info['option_name'];
		$customcss = $this->utils->get_option($optionname,'custom-css');
		$customjs = $this->utils->get_option($optionname,'custom-js');
		
		
		if ($customcss != ""){
		  echo '<style type="text/css">';
		  echo stripslashes($customcss);
		  echo '</style>';
		}
		
		
		if ($customjs != ""){
		  echo '<script>';
		  echo stripslashes($customjs);
		  echo '</script>';
		}
	}
	
	
	/**
	* Adds custom css for custom background colors
	* @since 1.4
	*/
	
	public function add_body_styles_front(){
		
		
		$info = $this->component_info();
		$optionname = $info['option_name'];
		$customcss = $this->utils->get_option($optionname,'custom-css');
		
		
		if ($customcss != ""){
		  echo '<style type="text/css">';
		  echo stripslashes($customcss);
		  echo '</style>';
		}
	}
	
	
}
