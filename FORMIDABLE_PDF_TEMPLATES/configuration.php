<?php

/**
 * Formidable Pro PDF Extended Configuration
 */

/**
 * Users can assign defaults to forms that aren't configured below.
 * Note: this will only work if the configuration option FPPDF_SET_DEFAULT_TEMPLATE is set to true (located at the bottom of this file).
 *
 * Users can use any configuration option like you would for a singular form, including:
 * notifications, template, filename, pdf_size, orientation, security and rtl
 *
 * Notification Options
 * notifications Mixed - String, Boolean or Array.
 * Notifications can be a string like 'Admin Notifications', an array with multiple notification names or true to send to all.
 * Notification IDs can be found to the very right of the From/Reply to field in the 'Emails' form setting section ( Forms -> Settings -> Emails )
 * See http://formidablepropdfextended.com/faq/find-notification-id/ for a screenshot of the notification ID.
 * 
 * You are also able to use field ID/Keys in filename ([sitename], [ip], [id], [key], [20], [ltzq9])
 *
 * Usage:
 * 'default-show-html' - This option will display HTMl blocks in your default tempalte.
 * 'default-show-empty' - All form fields will be displayed in the PDF, regardless of what the user input is.
 *
 */
global $fp_pdf_default_configuration;

$fp_pdf_default_configuration = array(
	'template' 			=> 'dmh-greeting-card.php',
	'pdf_size' 			=> 'letter',
	'orientation' 		=> 'landscape',
);

$fp_pdf_config[] = array(
	'default-show-html' => true,
	'filename' 			=> 'greeting-card-[id].pdf',
	'form_id' 			=> 13,
	'notifications' 	=> true,
	'notifications' 	=> 4117,
	'template' 			=> 'dmh-greeting-card.php',	
);

/** ---------------------------------------------------------------
 * CUSTOM PDF SETUP BELOW.
 * See http://formidablepropdfextended.com/documentation-v1/installation-and-configuration/#constants for more details
 *
 * By default, forms that don't have PDFs assigned through the above configuration
 * will automatically use the default template in the admin area.
 * Set to false to disable this feature.
 */
define('FPPDF_SET_DEFAULT_TEMPLATE', true);

/**
 * MEMORY ISSUES?
 * Try setting the options below to true to help reduce the memory footprint of the package.
 */
define('FP_PDF_ENABLE_MPDF_LITE', true); /* strip out advanced features like advanced table borders, terms and conditions, columns, index, bookmarks and barcodes. */
define('FP_PDF_ENABLE_MPDF_TINY', false); /* if your tried the lite version and are still having trouble the tiny version includes the bare minimum features. There's no positioning, float, watermark or form support */
define('FP_PDF_DISABLE_FONT_SUBSTITUTION', false); /* reduced memory by stopping font substitution */
define('FP_PDF_ENABLE_SIMPLE_TABLES', false); /* disable the advanced table feature and forces all cells to have the same border, background etc. */