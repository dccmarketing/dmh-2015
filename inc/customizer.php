<?php
/**
 * DMH Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 			https://codex.wordpress.org/Theme_Customization_API
 * @since 			1.0.0
 * @package 		DMH
 */
class DMH_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'customize_register', 	array( $this, 'register_panels' ) );
		add_action( 'customize_register', 	array( $this, 'register_sections' ) );
		add_action( 'customize_register', 	array( $this, 'register_fields' ) );
		add_action( 'wp_head', 				array( $this, 'header_output' ) );
		add_action( 'customize_register', 	array( $this, 'load_customize_controls' ), 0 );

	} // hooks()

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Register panels here

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav_menus			100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		// default_images Section
		$wp_customize->add_section( 'default_images',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'dmh' ),
				'priority'  		=> 10,
				'title'  			=> esc_html__( 'Default Images', 'dmh' ),
			)
		);

		// Header Section
		$wp_customize->add_section( 'header_footer',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'dmh' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Header/Footer', 'dmh' ),
			)
		);

		// Social Media Section
		$wp_customize->add_section( 'social_media',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'dmh' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Social Media', 'dmh' ),
			)
		);

		// Homepage Section
		$wp_customize->add_section( 'homepage',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'dmh' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Homepage', 'dmh' ),
			)
		);

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Default Banner Image Field
		$wp_customize->add_setting(
			'default_banner_image' ,
			array(
				'capability' 			=> 'edit_theme_options',
				'default'  				=> '',
				'sanitize_callback' 	=> 'esc_url_raw',
				'transport' 			=> 'postMessage',
				'type' 					=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'default_banner_image',
				array(
					'active_callback' 	=> '',
					'description' 		=> esc_html__( 'Select the banner image that will be as the default banner image for all pages that have no custom selected banner, all automatically populated listing pages, and all post/news pages. The optimal resolution is a minimum of 960x500 pixels. If the image is smaller and the image will be blurry. If the image is large there may be some parts of the image that are not visible.', 'dmh' ),
					'label' 			=> esc_html__( 'Default Banner Image', 'dmh' ),
					'priority' 			=> 10,
					'section' 			=> 'default_images',
					'settings' 			=> 'default_banner_image'
				)
			)
		);

		// News Banner Image Field
		$wp_customize->add_setting(
			'news_banner_image' ,
			array(
				'capability' 			=> 'edit_theme_options',
				'default'  				=> '',
				'sanitize_callback' 	=> 'esc_url_raw',
				'transport' 			=> 'postMessage',
				'type' 					=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'news_banner_image',
				array(
					'active_callback' 	=> '',
					'description' 		=> esc_html__( 'Select the banner image that will be as the default banner image for all pages that have no custom selected banner, all automatically populated listing pages, and all post/news pages. The optimal resolution is a minimum of 960x500 pixels. If the image is smaller and the image will be blurry. If the image is large there may be some parts of the image that are not visible.', 'dmh' ),
					'label' 			=> esc_html__( 'News Banner Image', 'dmh' ),
					'priority' 			=> 10,
					'section' 			=> 'default_images',
					'settings' 			=> 'news_banner_image'
				)
			)
		);



		// DMH Logo Field
		$wp_customize->add_setting(
			'dmh_logo' ,
			array(
				'capability' 			=> 'edit_theme_options',
				'default'  				=> '',
				'sanitize_callback' 	=> 'esc_url_raw',
				'transport' 			=> 'postMessage',
				'type' 					=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'dmh_logo',
				array(
					'active_callback' 	=> '',
					'description' 		=> esc_html__( 'This will be the logo in the header of the site.', 'dmh' ),
					'label' 			=> esc_html__( 'DMH Logo', 'dmh' ),
					'priority' 			=> 10,
					'section' 			=> 'header_footer',
					'settings' 			=> 'dmh_logo'
				)
			)
		);

		// Mobile Menu Text Field
		$wp_customize->add_setting(
			'mobile_menu_text',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'mobile_menu_text',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Mobile Menu Text', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'header_footer',
				'settings' 			=> 'mobile_menu_text',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'mobile_menu_text' )->transport = 'postMessage';

		// Mobile Phone Menu Text Field
		$wp_customize->add_setting(
			'mobile_phone_menu_text',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'mobile_phone_menu_text',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Mobile Phone Menu Text', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'header_footer',
				'settings' 			=> 'mobile_phone_menu_text',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'mobile_phone_menu_text' )->transport = 'postMessage';

		// Mobile Sidebar Text Field
		$wp_customize->add_setting(
			'mobile_sidebar_text',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'mobile_sidebar_text',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Mobile Sidebar Text', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'header_footer',
				'settings' 			=> 'mobile_sidebar_text',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'mobile_sidebar_text' )->transport = 'postMessage';

		// EpiCare MyChart Page Field
		$wp_customize->add_setting(
			'epicare_mychart_page',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => '',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'epicare_mychart_page',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'EpiCare MyChart Page', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'header_footer',
				'settings' 			=> 'epicare_mychart_page',
				'type' 				=> 'dropdown-pages'
			)
		);
		$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';

		// Footer Phone Number Field
		$wp_customize->add_setting(
			'footer_phone_number',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'footer_phone_number',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Footer Phone Number Text', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'header_footer',
				'settings' 			=> 'footer_phone_number',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'footer_phone_number' )->transport = 'postMessage';



		// Facebook URL Field
		$wp_customize->add_setting(
			'facebook_url',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'facebook_url',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Facebook URL', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'social_media',
				'settings' 			=> 'facebook_url',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'facebook_url' )->transport = 'postMessage';

		// Twitter URL Field
		$wp_customize->add_setting(
			'twitter_url',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'twitter_url',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Twitter URL', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'social_media',
				'settings' 			=> 'twitter_url',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'twitter_url' )->transport = 'postMessage';

		// YouTube URL Field
		$wp_customize->add_setting(
			'youtube_url',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'youtube_url',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'YouTube URL', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'social_media',
				'settings' 			=> 'youtube_url',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'youtube_url' )->transport = 'postMessage';

		// Email Addresses Field
		$wp_customize->add_setting(
			'email_addresses',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => '',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'email_addresses',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( '', 'dmh' ),
				'label'  			=> esc_html__( 'Email Addresses', 'dmh' ),
				'priority' 			=> 10,
				'section'  			=> 'social_media',
				'settings' 			=> 'email_addresses',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'email_addresses' )->transport = 'postMessage';

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 * @see 		header_output()
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) {

			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);

			if ( $echo ) {

				echo $return;

			}

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * @hooked 		wp_head
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// $this->generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// $this->generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! $this->custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (افغانستان‎)', 'dmh' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'dmh' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'dmh' );
		$countries['DZ'] = esc_html__( 'Algeria (الجزائر‎)', 'dmh' );
		$countries['AS'] = esc_html__( 'American Samoa', 'dmh' );
		$countries['AD'] = esc_html__( 'Andorra', 'dmh' );
		$countries['AO'] = esc_html__( 'Angola', 'dmh' );
		$countries['AI'] = esc_html__( 'Anguilla', 'dmh' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'dmh' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'dmh' );
		$countries['AR'] = esc_html__( 'Argentina', 'dmh' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'dmh' );
		$countries['AW'] = esc_html__( 'Aruba', 'dmh' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'dmh' );
		$countries['AU'] = esc_html__( 'Australia', 'dmh' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'dmh' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'dmh' );
		$countries['BS'] = esc_html__( 'Bahamas', 'dmh' );
		$countries['BH'] = esc_html__( 'Bahrain (البحرين‎)', 'dmh' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'dmh' );
		$countries['BB'] = esc_html__( 'Barbados', 'dmh' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'dmh' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'dmh' );
		$countries['BZ'] = esc_html__( 'Belize', 'dmh' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'dmh' );
		$countries['BM'] = esc_html__( 'Bermuda', 'dmh' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'dmh' );
		$countries['BO'] = esc_html__( 'Bolivia', 'dmh' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'dmh' );
		$countries['BW'] = esc_html__( 'Botswana', 'dmh' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'dmh' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'dmh' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'dmh' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'dmh' );
		$countries['BN'] = esc_html__( 'Brunei', 'dmh' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'dmh' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'dmh' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'dmh' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'dmh' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'dmh' );
		$countries['CA'] = esc_html__( 'Canada', 'dmh' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'dmh' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'dmh' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'dmh' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'dmh' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'dmh' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'dmh' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'dmh' );
		$countries['CL'] = esc_html__( 'Chile', 'dmh' );
		$countries['CN'] = esc_html__( 'China (中国)', 'dmh' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'dmh' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'dmh' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'dmh' );
		$countries['CO'] = esc_html__( 'Colombia', 'dmh' );
		$countries['KM'] = esc_html__( 'Comoros (جزر القمر‎)', 'dmh' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'dmh' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'dmh' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'dmh' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'dmh' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'dmh' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'dmh' );
		$countries['CU'] = esc_html__( 'Cuba', 'dmh' );
		$countries['CW'] = esc_html__( 'Curaçao', 'dmh' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'dmh' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'dmh' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'dmh' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'dmh' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'dmh' );
		$countries['DM'] = esc_html__( 'Dominica', 'dmh' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'dmh' );
		$countries['EC'] = esc_html__( 'Ecuador', 'dmh' );
		$countries['EG'] = esc_html__( 'Egypt (مصر‎)', 'dmh' );
		$countries['SV'] = esc_html__( 'El Salvador', 'dmh' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'dmh' );
		$countries['ER'] = esc_html__( 'Eritrea', 'dmh' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'dmh' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'dmh' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'dmh' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'dmh' );
		$countries['FJ'] = esc_html__( 'Fiji', 'dmh' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'dmh' );
		$countries['FR'] = esc_html__( 'France', 'dmh' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'dmh' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'dmh' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'dmh' );
		$countries['GA'] = esc_html__( 'Gabon', 'dmh' );
		$countries['GM'] = esc_html__( 'Gambia', 'dmh' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'dmh' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'dmh' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'dmh' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'dmh' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'dmh' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'dmh' );
		$countries['GD'] = esc_html__( 'Grenada', 'dmh' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'dmh' );
		$countries['GU'] = esc_html__( 'Guam', 'dmh' );
		$countries['GT'] = esc_html__( 'Guatemala', 'dmh' );
		$countries['GG'] = esc_html__( 'Guernsey', 'dmh' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'dmh' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'dmh' );
		$countries['GY'] = esc_html__( 'Guyana', 'dmh' );
		$countries['HT'] = esc_html__( 'Haiti', 'dmh' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'dmh' );
		$countries['HN'] = esc_html__( 'Honduras', 'dmh' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'dmh' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'dmh' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'dmh' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'dmh' );
		$countries['ID'] = esc_html__( 'Indonesia', 'dmh' );
		$countries['IR'] = esc_html__( 'Iran (ایران‎)', 'dmh' );
		$countries['IQ'] = esc_html__( 'Iraq (العراق‎)', 'dmh' );
		$countries['IE'] = esc_html__( 'Ireland', 'dmh' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'dmh' );
		$countries['IL'] = esc_html__( 'Israel (ישראל‎)', 'dmh' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'dmh' );
		$countries['JM'] = esc_html__( 'Jamaica', 'dmh' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'dmh' );
		$countries['JE'] = esc_html__( 'Jersey', 'dmh' );
		$countries['JO'] = esc_html__( 'Jordan (الأردن‎)', 'dmh' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'dmh' );
		$countries['KE'] = esc_html__( 'Kenya', 'dmh' );
		$countries['KI'] = esc_html__( 'Kiribati', 'dmh' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'dmh' );
		$countries['KW'] = esc_html__( 'Kuwait (الكويت‎)', 'dmh' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'dmh' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'dmh' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'dmh' );
		$countries['LB'] = esc_html__( 'Lebanon (لبنان‎)', 'dmh' );
		$countries['LS'] = esc_html__( 'Lesotho', 'dmh' );
		$countries['LR'] = esc_html__( 'Liberia', 'dmh' );
		$countries['LY'] = esc_html__( 'Libya (ليبيا‎)', 'dmh' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'dmh' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'dmh' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'dmh' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'dmh' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'dmh' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'dmh' );
		$countries['MW'] = esc_html__( 'Malawi', 'dmh' );
		$countries['MY'] = esc_html__( 'Malaysia', 'dmh' );
		$countries['MV'] = esc_html__( 'Maldives', 'dmh' );
		$countries['ML'] = esc_html__( 'Mali', 'dmh' );
		$countries['MT'] = esc_html__( 'Malta', 'dmh' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'dmh' );
		$countries['MQ'] = esc_html__( 'Martinique', 'dmh' );
		$countries['MR'] = esc_html__( 'Mauritania (موريتانيا‎)', 'dmh' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'dmh' );
		$countries['YT'] = esc_html__( 'Mayotte', 'dmh' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'dmh' );
		$countries['FM'] = esc_html__( 'Micronesia', 'dmh' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'dmh' );
		$countries['MC'] = esc_html__( 'Monaco', 'dmh' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'dmh' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'dmh' );
		$countries['MS'] = esc_html__( 'Montserrat', 'dmh' );
		$countries['MA'] = esc_html__( 'Morocco (المغرب‎)', 'dmh' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'dmh' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'dmh' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'dmh' );
		$countries['NR'] = esc_html__( 'Nauru', 'dmh' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'dmh' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'dmh' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'dmh' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'dmh' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'dmh' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'dmh' );
		$countries['NG'] = esc_html__( 'Nigeria', 'dmh' );
		$countries['NU'] = esc_html__( 'Niue', 'dmh' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'dmh' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'dmh' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'dmh' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'dmh' );
		$countries['OM'] = esc_html__( 'Oman (عُمان‎)', 'dmh' );
		$countries['PK'] = esc_html__( 'Pakistan (پاکستان‎)', 'dmh' );
		$countries['PW'] = esc_html__( 'Palau', 'dmh' );
		$countries['PS'] = esc_html__( 'Palestine (فلسطين‎)', 'dmh' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'dmh' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'dmh' );
		$countries['PY'] = esc_html__( 'Paraguay', 'dmh' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'dmh' );
		$countries['PH'] = esc_html__( 'Philippines', 'dmh' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'dmh' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'dmh' );
		$countries['PT'] = esc_html__( 'Portugal', 'dmh' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'dmh' );
		$countries['QA'] = esc_html__( 'Qatar (قطر‎)', 'dmh' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'dmh' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'dmh' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'dmh' );
		$countries['RW'] = esc_html__( 'Rwanda', 'dmh' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'dmh' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'dmh' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'dmh' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'dmh' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'dmh' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'dmh' );
		$countries['WS'] = esc_html__( 'Samoa', 'dmh' );
		$countries['SM'] = esc_html__( 'San Marino', 'dmh' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'dmh' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (المملكة العربية السعودية‎)', 'dmh' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'dmh' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'dmh' );
		$countries['SC'] = esc_html__( 'Seychelles', 'dmh' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'dmh' );
		$countries['SG'] = esc_html__( 'Singapore', 'dmh' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'dmh' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'dmh' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'dmh' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'dmh' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'dmh' );
		$countries['ZA'] = esc_html__( 'South Africa', 'dmh' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'dmh' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'dmh' );
		$countries['SS'] = esc_html__( 'South Sudan (جنوب السودان‎)', 'dmh' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'dmh' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'dmh' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'dmh' );
		$countries['SD'] = esc_html__( 'Sudan (السودان‎)', 'dmh' );
		$countries['SR'] = esc_html__( 'Suriname', 'dmh' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'dmh' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'dmh' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'dmh' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'dmh' );
		$countries['SY'] = esc_html__( 'Syria (سوريا‎)', 'dmh' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'dmh' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'dmh' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'dmh' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'dmh' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'dmh' );
		$countries['TG'] = esc_html__( 'Togo', 'dmh' );
		$countries['TK'] = esc_html__( 'Tokelau', 'dmh' );
		$countries['TO'] = esc_html__( 'Tonga', 'dmh' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'dmh' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'dmh' );
		$countries['TN'] = esc_html__( 'Tunisia (تونس‎)', 'dmh' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'dmh' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'dmh' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'dmh' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'dmh' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'dmh' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'dmh' );
		$countries['UG'] = esc_html__( 'Uganda', 'dmh' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'dmh' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (الإمارات العربية المتحدة‎)', 'dmh' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'dmh' );
		$countries['US'] = esc_html__( 'United States', 'dmh' );
		$countries['UY'] = esc_html__( 'Uruguay', 'dmh' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'dmh' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'dmh' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'dmh' );
		$countries['VE'] = esc_html__( 'Venezuela', 'dmh' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'dmh' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'dmh' );
		$countries['EH'] = esc_html__( 'Western Sahara (الصحراء الغربية‎)', 'dmh' );
		$countries['YE'] = esc_html__( 'Yemen (اليمن‎)', 'dmh' );
		$countries['ZM'] = esc_html__( 'Zambia', 'dmh' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'dmh' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

	/**
	 * Loads files for Custom Controls.
	 *
	 * @hooked
	 */
	public function load_customize_controls() {

		$files[] = 'control-editor.php';
		// $files[] = 'control-layout-picker.php';
		// $files[] = 'control-multiple-checkboxes.php';
		// $files[] = 'control-select-category.php';
		// $files[] = 'control-select-menu.php';
		// $files[] = 'control-select-post.php';
		// $files[] = 'control-select-post-type.php';
		// //$files[] = 'control-select-recent-post.php';
		// $files[] = 'control-select-tag.php';
		// $files[] = 'control-select-taxonomy.php';
		// $files[] = 'control-select-user.php';

		foreach ( $files as $file ) {

			require_once( trailingslashit( get_stylesheet_directory() ) . 'inc/controls/' . $file );

		}

	} // load_customize_controls()

	/**
	 * Returns an array of the Australian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_australia( $state = '' ) {

		$states = array();

		$states['ACT'] = esc_html__( 'Australian Capital Territory', 'dmh' );
		$states['NSW'] = esc_html__( 'New South Wales', 'dmh' );
		$states['NT' ] = esc_html__( 'Northern Territory', 'dmh' );
		$states['QLD'] = esc_html__( 'Queensland', 'dmh' );
		$states['SA' ] = esc_html__( 'South Australia', 'dmh' );
		$states['TAS'] = esc_html__( 'Tasmania', 'dmh' );
		$states['VIC'] = esc_html__( 'Victoria', 'dmh' );
		$states['WA' ] = esc_html__( 'Western Australia', 'dmh' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_australia()



	/**
	 * Returns an array of the Canadian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_canada( $state = '' ) {

		$states = array();

		$states['AB'] = esc_html__( 'Alberta', 'dmh' );
		$states['BC'] = esc_html__( 'British Columbia', 'dmh' );
		$states['MB'] = esc_html__( 'Manitoba', 'dmh' );
		$states['NB'] = esc_html__( 'New Brunswick', 'dmh' );
		$states['NL'] = esc_html__( 'Newfoundland and Labrador', 'dmh' );
		$states['NT'] = esc_html__( 'Northwest Territories', 'dmh' );
		$states['NS'] = esc_html__( 'Nova Scotia', 'dmh' );
		$states['NU'] = esc_html__( 'Nunavut', 'dmh' );
		$states['ON'] = esc_html__( 'Ontario', 'dmh' );
		$states['PE'] = esc_html__( 'Prince Edward Island', 'dmh' );
		$states['QC'] = esc_html__( 'Quebec', 'dmh' );
		$states['SK'] = esc_html__( 'Saskatchewan', 'dmh' );
		$states['YT'] = esc_html__( 'Yukon', 'dmh' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_canada()

	/**
	 * Returns an array of the US states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_unitedstates( $state = '' ) {

		$states = array();

		$states['AL'] = esc_html__( 'Alabama', 'dmh' );
		$states['AK'] = esc_html__( 'Alaska', 'dmh' );
		$states['AZ'] = esc_html__( 'Arizona', 'dmh' );
		$states['AR'] = esc_html__( 'Arkansas', 'dmh' );
		$states['CA'] = esc_html__( 'California', 'dmh' );
		$states['CO'] = esc_html__( 'Colorado', 'dmh' );
		$states['CT'] = esc_html__( 'Connecticut', 'dmh' );
		$states['DE'] = esc_html__( 'Delaware', 'dmh' );
		$states['DC'] = esc_html__( 'District of Columbia', 'dmh' );
		$states['FL'] = esc_html__( 'Florida', 'dmh' );
		$states['GA'] = esc_html__( 'Georgia', 'dmh' );
		$states['HI'] = esc_html__( 'Hawaii', 'dmh' );
		$states['ID'] = esc_html__( 'Idaho', 'dmh' );
		$states['IL'] = esc_html__( 'Illinois', 'dmh' );
		$states['IN'] = esc_html__( 'Indiana', 'dmh' );
		$states['IA'] = esc_html__( 'Iowa', 'dmh' );
		$states['KS'] = esc_html__( 'Kansas', 'dmh' );
		$states['KY'] = esc_html__( 'Kentucky', 'dmh' );
		$states['LA'] = esc_html__( 'Louisiana', 'dmh' );
		$states['ME'] = esc_html__( 'Maine', 'dmh' );
		$states['MD'] = esc_html__( 'Maryland', 'dmh' );
		$states['MA'] = esc_html__( 'Massachusetts', 'dmh' );
		$states['MI'] = esc_html__( 'Michigan', 'dmh' );
		$states['MN'] = esc_html__( 'Minnesota', 'dmh' );
		$states['MS'] = esc_html__( 'Mississippi', 'dmh' );
		$states['MO'] = esc_html__( 'Missouri', 'dmh' );
		$states['MT'] = esc_html__( 'Montana', 'dmh' );
		$states['NE'] = esc_html__( 'Nebraska', 'dmh' );
		$states['NV'] = esc_html__( 'Nevada', 'dmh' );
		$states['NH'] = esc_html__( 'New Hampshire', 'dmh' );
		$states['NJ'] = esc_html__( 'New Jersey', 'dmh' );
		$states['NM'] = esc_html__( 'New Mexico', 'dmh' );
		$states['NY'] = esc_html__( 'New York', 'dmh' );
		$states['NC'] = esc_html__( 'North Carolina', 'dmh' );
		$states['ND'] = esc_html__( 'North Dakota', 'dmh' );
		$states['OH'] = esc_html__( 'Ohio', 'dmh' );
		$states['OK'] = esc_html__( 'Oklahoma', 'dmh' );
		$states['OR'] = esc_html__( 'Oregon', 'dmh' );
		$states['PA'] = esc_html__( 'Pennsylvania', 'dmh' );
		$states['RI'] = esc_html__( 'Rhode Island', 'dmh' );
		$states['SC'] = esc_html__( 'South Carolina', 'dmh' );
		$states['SD'] = esc_html__( 'South Dakota', 'dmh' );
		$states['TN'] = esc_html__( 'Tennessee', 'dmh' );
		$states['TX'] = esc_html__( 'Texas', 'dmh' );
		$states['UT'] = esc_html__( 'Utah', 'dmh' );
		$states['VT'] = esc_html__( 'Vermont', 'dmh' );
		$states['VA'] = esc_html__( 'Virginia', 'dmh' );
		$states['WA'] = esc_html__( 'Washington', 'dmh' );
		$states['WV'] = esc_html__( 'West Virginia', 'dmh' );
		$states['WI'] = esc_html__( 'Wisconsin', 'dmh' );
		$states['WY'] = esc_html__( 'Wyoming', 'dmh' );
		$states['AS'] = esc_html__( 'American Samoa', 'dmh' );
		$states['AA'] = esc_html__( 'Armed Forces America (except Canada)', 'dmh' );
		$states['AE'] = esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'dmh' );
		$states['AP'] = esc_html__( 'Armed Forces Pacific', 'dmh' );
		$states['FM'] = esc_html__( 'Federated States of Micronesia', 'dmh' );
		$states['GU'] = esc_html__( 'Guam', 'dmh' );
		$states['MH'] = esc_html__( 'Marshall Islands', 'dmh' );
		$states['MP'] = esc_html__( 'Northern Mariana Islands', 'dmh' );
		$states['PR'] = esc_html__( 'Puerto Rico', 'dmh' );
		$states['PW'] = esc_html__( 'Palau', 'dmh' );
		$states['VI'] = esc_html__( 'Virgin Islands', 'dmh' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_unitedstates()

} // class

$dmh_customizer = new DMH_Customizer();

add_action( 'init', array( $dmh_customizer, 'hooks' ) );
