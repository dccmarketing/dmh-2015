<?php
/**
 * Functions for the MyChart page template.
 */
add_action( 'icon-box-layout', 'mychart_box_icon_right', 10, 1 );
add_action( 'icon-box-layout', 'mychart_box_icon_left', 10, 1 );
add_action( 'icon-box-layout', 'mychart_box_icon_top', 10, 1 );
add_action( 'icon-box-layout', 'mychart_box_icon_bottom', 10, 1 );

/**
 * The icon-right iconbox layout
 */
function mychart_box_icon_right( $layout ) {
	
	if ( 'icon-right' !== $layout ) { return; } 

	?><div class="icon-box-content">
		<h2 class="icon-box-heading"><?php
	                        	
			the_sub_field( 'heading' );

		?></h2>
		<p><?php the_sub_field( 'content' ); ?></p>
	</div>
	<img class="icon-box-icon" src="<?php the_sub_field( 'icon' ); ?>" /><?php

} // mychart_box_icon_right()

/**
 * The icon-left iconbox layout
 */
function mychart_box_icon_left( $layout ) {

	if ( 'icon-left' !== $layout ) { return; } 

	?><img class="icon-box-icon" src="<?php the_sub_field( 'icon' ); ?>" />
	<div class="icon-box-content">
		<h2 class="icon-box-heading"><?php
	                        	
			the_sub_field( 'heading' );

		?></h2>
		<p><?php the_sub_field( 'content' ); ?></p>
	</div><?php

} // mychart_box_icon_left()

/**
 * The icon-top iconbox layout
 */
function mychart_box_icon_top( $layout ) {

	if ( 'icon-top' !== $layout ) { return; } 

	?><div class="icon-box-content">
		<img class="icon-box-icon" src="<?php the_sub_field( 'icon' ); ?>" />
		<h2 class="icon-box-heading"><?php
	                        	
			the_sub_field( 'heading' );

		?></h2>
		<p><?php the_sub_field( 'content' ); ?></p>
	</div><?php

} // mychart_box_icon_top()

/**
 * The icon-bottom iconbox layout
 */
function mychart_box_icon_bottom( $layout ) {

	if ( 'icon-bottom' !== $layout ) { return; } 

	?><div class="icon-box-content">
		<h2 class="icon-box-heading"><?php
	                        	
			the_sub_field( 'heading' );

		?></h2>
		<p><?php the_sub_field( 'content' ); ?></p>
		<img class="icon-box-icon" src="<?php the_sub_field( 'icon' ); ?>" />
	</div><?php

} // mychart_box_icon_bottom()


