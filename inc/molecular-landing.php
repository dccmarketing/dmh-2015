<?php 

add_shortcode( 'dmh_molecular_landing_boxes', 'dmh_molecular_landing_boxes' );

/**
 * Displays the output of the shortcode.
 * 
 * @param  [type] $atts    [description]
 * @param  [type] $content [description]
 * @return [type]          [description]
 */
function dmh_molecular_landing_boxes( $atts, $content = null ) {
	
	$atts 	= shortcode_atts( array( 'fields' => 'boxes' ), $atts );
	$fields = get_fields( get_the_ID() );
	
	if ( empty( $fields[$atts['fields']] ) ) { return; }

	$output = '';
	
	$output .= '<div class="mm-boxes">';
	
	foreach ( $fields[$atts['fields']] as $box ) :

		$output .= '<div class="mm-box">';
		$output .= '<div class="mm-img-box" style="background-image:url(';
		$output .= esc_url( $box['image'] );
		$output .= ')">';
		$output .= '<span class="mm-roll">';
		$output .= wp_kses_post( $box['roll-over_text'] );
		$output .= '</span>';
		$output .= '</div>';
		$output .= '<h3 class="mm-title">';
		$output .= esc_html( $box['title'] );
		$output .= '</h3>';
		$output .= '<ul class="mm-links">';
		
		foreach ( $box['links'] as $link ) :
			
			$output .= '<li class="mm-link-wrap">';
			$output .= '<a class="mm-link" href="';
			$output .= esc_url( $link['url'] );
			$output .= '">';
				
				$output .= wp_kses_post( $link['text'] );
			
			$output .= '</a>';
			$output .= '</li>';
			
		endforeach;
		
		$output .= '</ul>';
		$output .= '</div>';

	endforeach;

	$output .= '</div>';
	
	return $output;

} // dmh_molecular_landing_boxes()