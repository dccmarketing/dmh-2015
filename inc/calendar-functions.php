<?php

add_action( 'AHEE__content_espresso_venues_details_template__after_the_content', 'dmh_list_upcoming_events_for_a_venue', 10, 1 );




/**
 * Adds a list of events to the venue page.
 *
 * Query the events for this venue using EE_Venue's events() method
 * @see http://code.eventespresso.com/classes/EE_Venue.html#method_events
 */
function dmh_list_upcoming_events_for_a_venue( $post ) {

	$query_params = array(
        array(
            'status' => 'publish',
            'Datetime.DTT_EVT_start' => array(
                '>',
                date( current_time( 'mysql' ) ),
                'Datetime.DTT_EVT_end' => array(
                    '<',
                    date( current_time( 'mysql' ) )
                )
            )
        ),
		'order_by' => 'Datetime.DTT_EVT_start',
		'order' => 'ASC'
    );

    $events = EEH_Venue_View::get_venue( $post->ID )->events( $query_params );

	echo '<h2>Upcoming screenings:</h2><ul>';

    foreach ( $events as $event ) {

		$event_dt = $event->first_datetime();

        echo '<li>';
        echo '<a href="' . get_permalink( $event->get( 'EVT_ID' ) ) . '">' . $event_dt->start_date( 'n/j/Y' ) . ' - ' . $event->get( 'EVT_name' ) . '</a>';
        echo '</li>';

    }

    echo '</ul>';

} // dmh_list_upcoming_events_for_a_venue