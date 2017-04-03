<?php
global $post;
?>
<div class="event-content entry-content">
<?php
$event_phone = espresso_event_phone( $post->ID, FALSE );
	do_action( 'AHEE_event_details_before_the_content', $post );
	espresso_event_content_or_excerpt();
	do_action( 'AHEE_event_details_after_the_content', $post );
 ?>

</div>
<!-- .event-content -->
