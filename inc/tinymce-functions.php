<?php
/**
 * Enhancements to TinyMCE
 */
add_filter( 'mce_buttons_2', 'dmh_add_mce_font_buttons' );
add_filter( 'mce_buttons', 'dmh_add_formats_select' );
add_filter( 'tiny_mce_before_init', 'dmh_add_format_options' );
add_action( 'init', 'dmh_add_editor_styles' );




/**
 * Adds a stylesheet to the editor.
 */
function dmh_add_editor_styles() {

	add_editor_style( 'css/dmhsighealth.css' );
	add_editor_style( 'css/editor.css' );

} // dmh_add_editor_styles()

/**
 * Add new styles to the TinyMCE "formats" menu dropdown
 *
 * @param 		string		$settings 		The current formats select settings.
 * @return 		string 		$settings 		The modified formats select settings.
 */
function dmh_add_format_options( $settings ) {

	$custom[0]['title'] 					= __( 'Text Formatting', 'dmh' );

	$custom[0]['items'][0]['title'] 		= __( 'Uppercase', 'dmh' );
	$custom[0]['items'][0]['inline'] 		= 'span';
	$custom[0]['items'][0]['classes'] 		= 'text-uppercase';

	$custom[0]['items'][1]['title'] 		= __( 'lowercase', 'dmh' );
	$custom[0]['items'][1]['inline'] 		= 'span';
	$custom[0]['items'][1]['classes'] 		= 'text-lowercase';



	$custom[1]['title'] 					= __( 'Floats', 'dmh' );

	$custom[1]['items'][0]['title'] 		= __( 'Float Right', 'dmh' );
	$custom[1]['items'][0]['inline'] 		= 'span';
	$custom[1]['items'][0]['classes'] 		= 'float-right';

	$custom[1]['items'][1]['title'] 		= __( 'Float Left', 'dmh' );
	$custom[1]['items'][1]['inline'] 		= 'span';
	$custom[1]['items'][1]['classes'] 		= 'float-left';


	$custom[2]['title'] 					= __( 'Theme Formatting', 'dmh' );

	$custom[2]['items'][0]['title'] 		= __( 'Letterbox', 'dmh' );
	$custom[2]['items'][0]['block'] 		= 'p';
	$custom[2]['items'][0]['classes'] 		= 'letterbox';

	$custom[2]['items'][1]['title'] 		= __( 'Letterbox Right', 'dmh' );
	$custom[2]['items'][1]['block'] 		= 'p';
	$custom[2]['items'][1]['classes'] 		= 'letterbox float-right';

	$custom[2]['items'][2]['title'] 		= __( 'Letterbox Left', 'dmh' );
	$custom[2]['items'][2]['block'] 		= 'p';
	$custom[2]['items'][2]['classes'] 		= 'letterbox float-left';

	$custom[2]['items'][3]['title'] 		= __( 'Line Behind - Text Center', 'dmh' );
	$custom[2]['items'][3]['inline'] 		= 'span';
	$custom[2]['items'][3]['classes'] 		= 'line-middle lm-text-center';

	$custom[2]['items'][4]['title'] 		= __( 'Line Behind - Text Left', 'dmh' );
	$custom[2]['items'][4]['inline'] 		= 'span';
	$custom[2]['items'][4]['classes'] 		= 'line-middle lm-text-left';

	$custom[2]['items'][5]['title'] 		= __( 'Line Behind - Text Right', 'dmh' );
	$custom[2]['items'][5]['inline'] 		= 'span';
	$custom[2]['items'][5]['classes'] 		= 'line-middle lm-text-right';

	$custom[2]['items'][6]['title'] 		= __( 'Content Block', 'dmh' );
	$custom[2]['items'][6]['block'] 		= 'div';
	$custom[2]['items'][6]['classes'] 		= 'clear';

	$settings['style_formats_merge'] 	= true;
	$settings['style_formats'] 			= json_encode( $custom );

	return $settings;

} // dmh_add_format_options()

/**
 * Add Formats Dropdown Menu To MCE
 *
 * @param 		array 		$buttons 		The current array of buttons.
 * @return 		array 		$buttons 		The modifed array of buttons.
 */
function dmh_add_formats_select( $buttons ) {

	array_push( $buttons, 'styleselect' );
	return $buttons;

} // dmh_add_formats_select()

/**
 * Enable font size & font family selects in the editor
 * 
 * @param 		array 		$buttons 		The current array of buttons.
 * @return 		array 		$buttons 		The modified array of buttons.
 */
function dmh_add_mce_font_buttons( $buttons ) {

	array_unshift( $buttons, 'fontselect' ); // Add Font Select
	array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
	return $buttons;

} // dmh_add_mce_font_buttons()
