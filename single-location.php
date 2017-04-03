<?php get_header(); ?>

<!-- Google Maps API for onpage maps -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<!-- Script to place Google Map on page -->
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {

// var
var $markers = $el.find('.marker');


// vars
var args = {
	zoom		: 15,
	center		: new google.maps.LatLng(0, 0),
	mapTypeId	: google.maps.MapTypeId.ROADMAP
};


// create map
var map = new google.maps.Map( $el[0], args);


// add a markers reference
map.markers = [];


// add markers
$markers.each(function(){

		add_marker( $(this), map );

});


// center map
center_map( map );


// return
return map;

}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

// var
var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

// create marker
var marker = new google.maps.Marker({
	position	: latlng,
	map			: map
});

// add to array
map.markers.push( marker );

// if marker contains HTML, add it to an infoWindow
if( $marker.html() )
{
	// create info window
	var infowindow = new google.maps.InfoWindow({
		content		: $marker.html()
	});

	// show info window when marker is clicked
	google.maps.event.addListener(marker, 'click', function() {

		infowindow.open( map, marker );

	});
}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

// vars
var bounds = new google.maps.LatLngBounds();

// loop through all markers and create bounds
$.each( map.markers, function( i, marker ){

	var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

	bounds.extend( latlng );

});

// only 1 marker?
if( map.markers.length == 1 )
{
	// set center of map
		map.setCenter( bounds.getCenter() );
		map.setZoom( 15 );
}
else
{
	// fit to bounds
	map.fitBounds( bounds );
}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

$('.acf-map').each(function(){

	// create map
	map = new_map( $(this) );

});

});

})(jQuery);
</script>

	<div class="contain wrapper location">

			<?php get_template_part( 'banner' ); ?>

			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<h3>Locations &amp; Maps</h3>
				<div class="sideMenu">

					<?php if( get_field("add_extra_menus", 84 )) { ?>
							<div class="add">
								<?php if ( have_rows('additional_menus', 84) ): ?>
										<?php while ( have_rows('additional_menus', 84) ) : the_row(); ?>
											<?php the_sub_field( "menu_to_add" ); ?>
										<?php endwhile; ?>
								<?php endif; ?>
							</div>
					<?php } ?>

				</div>
			</div>
			<div class="main">
				<div class="mainContent">

					<h1 class="basic-title"><?php the_title(); ?></h1><br />
					
				<?php

				    $your_query = new WP_Query( 'pagename=locations' );

				    while ( $your_query->have_posts() ) : $your_query->the_post();
				        the_content();
				    endwhile;

				    wp_reset_postdata();
				?>

				<?php
				if (in_array("pagename=ear-nose-throat-allergy", $post->ancestors)) {
				    echo "page id 95 is an ancestor of this page";
				}
				?>

					<div class="loc">
						<?php $current_page = $post->ID; ?>

						<?php $loop = new WP_Query( array( 'post_type' => 'location') ); ?>

						<?php if( $loop->have_posts() ) : ?>
							<h3>Locations</h3>
							<div class="loc-select">
								<p>Select a location for map and details</p>
								<select onchange="location = this.options[this.selectedIndex].value;">
									<option value="#">- Select a Location -</option>
									<?php 

										$args = array( 
											'post_type' => 'location', 
											'posts_per_page'=>200, 
											'orderby'=>'title',
											'order'=>'ASC',
											'tax_query' => array(
											        array(
											            'taxonomy' => 'not shown',
											            'field' => 'slug',
											            'terms' => array( 'slug', 'dont-show-on-site' ),
											            'operator' => 'NOT IN'
											        )
											    )
											

										);


										$loop = new WP_Query( $args ); 




									?>

									<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

										<option value="<?php the_permalink(); ?>"><?php the_title(); ?></option>

									<?php endwhile; ?>
								</select>
							</div>
						<?php endif; ?>

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

							<?php the_content(); ?>

							<!-- Place map on page if it has been entered -->
							<?php

								$location = get_field('location_map');

								if( !empty($location) ):
								?>
								<div class="acf-map">
									<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
								</div>
								<i class="fa fa-map-o"></i> <a class="directions" target="_blank" href="https://www.google.com/maps?saddr=My+Location&daddr=<?php $location = get_field('location_map'); echo $location['lat'] . ',' . $location['lng']; ?>">Get Directions to <?php the_title(); ?></a>

							<?php endif; ?><!-- /map -->

					</div>



					<div class="loc-content">
						<div class="detail">
							<h3><?php the_title(); ?></h3>
							<?php if( get_field( "loc_image" ) ) : ?>
							  <img src="<?php the_field('loc_image'); ?>" alt="<?php the_title(); ?>">
							<?php endif; ?>

							<div class="section">
								<h3 class="label">Meet the Doctors</h3>

								<div class="info">
									<?php
										$relposts = array('order' => 'ASC');
										$relposts = get_field('doctors_location');

										if( $relposts ): 

											foreach( $relposts as $post): // variable must be called $post (IMPORTANT) ?>
										        <?php setup_postdata($post); ?>
								            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />
										    <?php endforeach; ?>
										    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
									<?php endif;?>
								</div>
							</div>

							<div class="section">
								<h4 class="label">Office Phone</h4>
								<p class="info"><?php the_field('office_phone'); ?></p>
							</div>

							<div class="section">
								<h4 class="label">Office Fax</h4>
								<p class="info"><?php the_field('office_fax'); ?></p>
							</div>

							<div class="section">
								<h4 class="label">Office Hours</h4>
								<div class="info"><?php the_field('office_hours'); ?></div>
							</div>

							<div class="section">
								<h4 class="label">Email</h4>
								<div class="info"><?php the_field('office_email'); ?></div>
							</div>

							<div class="section">
								<h4 class="label">Website</h4>
								<div class="info"><?php the_field('office_website'); ?></div>
							</div>

							<div class="section">
								<h3 class="label"><?php the_title(); ?></h3>
								<p class="info"><?php the_field('office_address'); ?></p>
							</div>

							<div class="section">
								<h3 class="label">Special Services</h3>
								<div class="info"><?php the_field('special_servies'); ?></div>
							</div>
						</div>
					</div>

					<?php endwhile; else : ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php endif; ?>

				</div>
			</div>


	</div>

	</div>

<?php get_footer();
