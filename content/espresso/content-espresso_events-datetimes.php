<?php

if ( is_single() || is_archive() && espresso_display_datetimes_in_event_list() ) :
global $post;
do_action( 'AHEE_event_details_before_event_date', $post );
?>
	<div class="event-datetimes">
		<?php espresso_list_of_event_dates( $post->ID );?>
	</div>
	<!-- .event-datetimes -->
<?php
do_action( 'AHEE_event_details_after_event_date', $post );
endif;
?>
