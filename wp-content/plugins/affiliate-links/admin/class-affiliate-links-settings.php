<?php
// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    die();
}
/**
 * Custom Affiliate Links Configuration Page.
 */
class Affiliate_Links_Settings {

    /**
     * List of settings fields.
     */
    public $fields = array(
            array(
                'name'        => 'slug',
                'title'       => 'Affiliate Link Base',
                'type'        => 'text',
                'description' => "You can change the default base part '<strong>/go/</strong>' of your redirect link to something else"
            ),
            array(
                'name'        => 'default',
                'title'       => 'Default URL for Redirect',
                'type'        => 'text',
                'description' => 'Enter the default URL for redirect if correct URL not set'
            ),
            array(
                'name'        => 'nofollow',
                'title'       => 'Nofollow Affiliate Links',
                'type'        => 'checkbox',
                'description' => 'Add "X-Robots-Tag: noindex, nofollow" to HTTP headers'
            ),
            array(
                'name'        => 'category',
                'title'       => 'Show Category in Link URL',
                'type'        => 'checkbox',
                'description' => 'Show the link category slug in the affiliate link URL'
            ),
            array(
                'name'        => 'stats',
                'title'       => 'Count Hits',
                'type'        => 'checkbox',
                'description' => 'Track the number of times affiliate links have been used'
            ),
            array(
                'name'        => 'redirect',
                'title'       => 'Redirect Type',
                'type'        => 'radio',
                'description' => 'Set redirection HTTP status code',
                'values'      => array(
                    '301' => '301 Moved Permanently',
                    '302' => '302 Found',
                    '307' => '307 Temporary Redirect'
                )
            ),
        );

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {

        add_action( 'admin_menu',  array( $this, 'add_admin_menu' ) );
        add_action( 'admin_init', array( $this, 'settings_init' ) );
        add_filter( 'plugin_action_links_' . AFFILIATE_LINKS_BASENAME, array( $this, 'add_action_links' ) );

    }

	/**
	 * Add settings links
	 */
	function add_action_links( $links ) {

		$links[] = '<a href="' . admin_url( 'edit.php?post_type=affiliate-links&page=affiliate_links' ) . '">' . __( 'Settings', 'affiliate-links' ) . '</a>';
		$links[] = '<a href="https://codecanyon.net/item/affiliate-links-wordpress-plugin-for-link-shortening-and-masking/16917669?ref=teamdev-ltd" target="_blank">' . __( 'Go Premium', 'affiliate-links' ) . '</a>';

		return $links;

	}

    public function add_admin_menu() {

        add_submenu_page(
            'edit.php?post_type=affiliate-links',
            'Affiliate Links Settings',
            'Settings',
            'manage_options',
            'affiliate_links',
            array( $this, 'affiliate_links_options_page' )
        );

    }

    /**
     * Register plugin settings.
     */
    public function settings_init() {

        register_setting( 'affiliate_links', 'affiliate_links_settings' );

        add_settings_section(
            'affiliate_links_settings',
            __( 'Configure your link redirection here', 'affiliate-links' ),
            array( $this, 'affiliate_links_settings_callback'),
            'affiliate_links'
        );

        foreach ($this->fields as $field) {

            add_settings_field(
                $field['name'],
                __( $field['title'], 'affiliate-links' ),
                array( $this, 'render_'.$field['type'].'_field' ),
                'affiliate_links',
                'affiliate_links_settings',
                $field
            );

        }

    }

    public function affiliate_links_settings_callback($arg) {
       //echo '';
    }

    /**
     * Generate text input field.
     */
    public function render_text_field($args) {

        $value = isset( Affiliate_Links::$settings[ $args['name'] ] ) ? Affiliate_Links::$settings[ $args['name'] ] : '';
        ?>
        <input
            type="text"
            name="affiliate_links_settings[<?php echo esc_attr( $args['name'] ) ?>]"
            value="<?php echo esc_attr( $value ) ?>"
        >
        <p class="description"><?php _e( $args['description'], 'affiliate-links' ) ?></p>
        <?php

    }

    /**
     * Generate checkbox field.
     */
    public function render_checkbox_field($args) {

        $checked_value = isset( Affiliate_Links::$settings[ $args['name'] ] ) ? Affiliate_Links::$settings[ $args['name'] ] : 0;
        ?>
        <input
            type="checkbox"
            name="affiliate_links_settings[<?php echo esc_attr( $args['name'] ) ?>]"
            value="1"
            <?php checked( $checked_value, 1 ) ?>
        >
        <?php _e( $args['description'], 'affiliate-links' ) ?>
        <?php

    }

    /**
     * Generate radio button fields.
     */
    public function render_radio_field($args) {

        $values = $args['values'];
        reset($values);
        $default_val = key($values);

        $checked_value = isset( Affiliate_Links::$settings[ $args['name'] ] ) ? Affiliate_Links::$settings[ $args['name'] ] : $default_val;

        foreach( $values as $key => $value ) {
        ?>
            <input
                type="radio"
                id="<?php echo esc_attr( $args['name'] . '_' . $key ) ?>"
                name="affiliate_links_settings[<?php echo esc_attr( $args['name'] ) ?>]"
                value="<?php echo esc_attr( $key ) ?>"
                <?php checked( $checked_value, $key ) ?>
            >
            <label for="<?php echo esc_attr( $args['name'] . '_' . $key ) ?>">
                <?php echo esc_html(  $value ) ?>
            </label>
            <br>
        <?php
        }
        echo '<p class="description">' . __( $args['description'], 'affiliate-links' ) . '</p>';

    }

    /**
     * Plugin settings page HTML.
     */
    public function affiliate_links_options_page() {

        $this->flush_rules();

        ?>
        <h1><?php _e( 'Affiliate Links Settings', 'affiliate-links' ) ?></h1>

        <div id="af_links-wrapper">

            <div id="af_links-primary">
                <div class="wrap">
                    <form action="options.php" method="post" id="af_links-settings-form">

                        <?php load_template( dirname( __FILE__ ) . '/partials/settings-nav-tabs.php' ) ?>

                        <div class="af_links-nav-tab active" id="af_links_settings">
                            <?php
                            settings_fields( 'affiliate_links' );
                            do_settings_sections( 'affiliate_links' );
                            submit_button();
                            ?>
                        </div>

                        <div class="af_links-nav-tab" id="af_links_faq">
                            <?php load_template( dirname( __FILE__ ) . '/partials/settings-faq.php' ) ?>
                        </div>

                        <div class="af_links-nav-tab" id="af_links_docs">
                            <?php load_template( dirname( __FILE__ ) . '/partials/settings-docs.php' ) ?>
                        </div>

                        <div class="af_links-nav-tab" id="af_links_go_premium">
                            <?php load_template( dirname( __FILE__ ) . '/partials/settings-go-premium.php' ) ?>
                        </div>

                    </form>
                </div>
            </div>

            <div id="af_links-sidebar">
                <?php load_template( dirname( __FILE__ ) . '/partials/settings-sidebar.php' ) ?>
            </div>

        </div>
        <?php

    }

    /**
     * Flush permalinks rules.
     */
    public function flush_rules() {

        if ( isset( $_GET['settings-updated'] ) ) {
            flush_rewrite_rules();
        }

    }

}

/**
 * Calls the class for the settings page.
 */
if ( is_admin() ) {

    new Affiliate_Links_Settings();

}