<?php

/**
 * Debugging can be done by adding &html=1 to the end of the URL when viewing the PDF
 * We no longer need to access the file directly.
 */
if( ! class_exists( 'FPPDF_Core' ) ) { exit; }/* Accessed directly */

/**
 * Set up the form ID and lead ID, as well as we want page breaks displayed.
 * Form ID and Lead ID can be set by passing it to the URL - ?fid=1&lid=10
 */
FPPDF_Common::setup_ids();

global $fppdf;
$configuration_data    = $fppdf->get_config_data( $form_id );
$show_html_fields      = ( isset( $configuration_data['default-show-html'] ) && $configuration_data['default-show-html'] == 1 ) ? true : false;
$show_empty_fields     = ( isset( $configuration_data['default-show-empty'] ) && $configuration_data['default-show-empty'] == 1 ) ? true : false;

$stylesheet_location = ( file_exists( FP_PDF_TEMPLATE_LOCATION . 'dmhcard.css' ) ) ? FP_PDF_TEMPLATE_URL_LOCATION . 'dmhcard.css' : FP_PDF_PLUGIN_URL .'styles/dmhcard.css' ;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel='stylesheet' href='<?php echo $stylesheet_location; ?>' type='text/css' />
    <title>DMH Greeting Card</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
    <body><?php

        $output = array();

        foreach( $lead_ids as $lead_id ) {

            $fields = FPPDF_Common::get_form_fields($form_id, $lead_id);

            $data = FPPDF_Entry::show_entry(array(
                'id' => $lead_id,
                'fields' => $fields,
                'user_info' => false,
                'include_blank' => $show_empty_fields,
                'show_html' => $show_html_fields,
                'type' => 'array'
            ));

            foreach ( $data['field'] as $field ) {

                switch( $field['title'] ) {

                    case 'Card'                 : $key = 'card'; break;
                    case 'Your Name'            : $key = 'sender'; break;
                    case 'Email Address'        : $key = 'email'; break;
                    case 'Phone Number'         : $key = 'phone'; break;
                    case 'Patient\'s Name'      : $key = 'patient'; break;
                    case 'Patient Room Number'  : $key = 'room'; break;
                    case 'Message'              : $key = 'message'; break;

                }

                if ( ! empty( $field['value'] ) && ! isset( $output[$key] ) ) {

                    $output[$key] = $field['value'];

                }

            }
        }

        ?><div class="dmhcard">
            <div class="card-front"><?php

            if ( ! empty( $output['card'] ) ) {

				$url = get_stylesheet_directory_uri() . '/FORMIDABLE_PDF_TEMPLATES/images/' . $output['card'] . '-upsidedown.jpg';

                ?><img src="<?php echo esc_url( $url ); ?>"><?php

            }

            ?></div>
            <div class="inside-blank"></div>
            <div class="card-back"><?php

            ?><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/FORMIDABLE_PDF_TEMPLATES/images/DMH-logo.jpg' ); ?>"><?php

            ?></div>
            <div class="inside-msg">
                <p class="recipient"><?php

                if ( ! empty( $output['patient'] ) ) {

                    echo esc_html( 'To: ' . $output['patient'] );

                }

                if ( ! empty( $output['room'] ) ) {

                    echo esc_html( ' (Room ' . $output['room'] . ')' );

                }

                ?></p>
                <p class="card-msg"><?php

                if ( ! empty( $output['message'] ) ) {

                    echo esc_html( $output['message'] );

                }

                ?></p>
                <p class="sender"><?php

                if ( ! empty( $output['sender'] ) ) {

                    echo esc_html( 'From: ' . $output['sender'] );

                }

                ?></p>
            </div>
        </div>
    </body>
</html>