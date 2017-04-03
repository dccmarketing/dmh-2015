<?php
/**
* DMH Theme functions and definitions
*/

// Actions & Filters
add_action( 'after_setup_theme', 'dmh_theme_setup' );
add_action( 'after_setup_theme', 'dmh_content_width' );
add_filter( 'body_class', 'dmh_body_classes' );
add_action( 'admin_menu', 'dmh_remove_admin_menus' );
add_action( 'init', 'register_my_menus' );
add_filter( 'nav_menu_css_class' , 'special_nav_class' , 10 , 2 );
add_action( 'wp_enqueue_scripts', 'dmh_scripts' );
add_action( 'wp_enqueue_scripts', 'dmh_styles' );
add_filter( 'excerpt_length', 'new_excerpt_length' );
// add_filter('excerpt_more', 'new_excerpt_more' );
add_filter( 'excerpt_more', 'new_excerpt_more' );
add_shortcode( 'dmh-event-list', 'dmh_event_list' );
add_shortcode( 'dmh-recent-news', 'dmh_recent_news' );
add_filter( 'FHEE__EE_Ticket_Selector__display_ticket_selector__template_path', 'ee_custom_ticket_selector_template_location' );
add_action( 'template_redirect', 'my_remove_ical_link' );
add_filter( 'admin_footer_text', 'ee_remove_footer_text', 11 );
add_action( 'wp_footer', 'ee_default_ticket_selector_one' );
add_action( 'dmh_footer_before', 'dmh_home_icon_links', 20 );




/**
 * Setup theme
 */
function dmh_theme_setup() {

	add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

}

/**************************
Custom Navigation
***************************/
function register_my_menus() {
  register_nav_menus(
  array(
    'top-bar' => __( 'Top Bar' ),
    'primary-nav' => __( 'Primary' ),
    'footer-nav' => __( 'Footer' ),
    'general-nav' => __( 'General (Sidebar)' )

    )
  );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @hooked 		after_setup_theme
 * @global 		int 		$content_width
 */
function dmh_content_width() {

	if ( isset( $content_width ) ) { return; }

	$content_width = 672;

} // dmh_content_width()

/**
 * Adds classes to the body tag.
 *
 * @hooked		body_class
 * @global 		$post						The $post object
 * @param 		array 		$classes 		Classes for the body element.
 * @return 		array 						The modified body class array
 */
function dmh_body_classes( $classes ) {

	global $post;

	if ( empty( $post->post_content ) ) {

		$classes[] = 'content-none';

	} else {

		$classes[] = $post->post_name;

	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {

		$classes[] = 'group-blog';

	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {

		$classes[] = 'hfeed';

	}

	return $classes;

} // dmh_body_classes()


/**************************
Remove Posts from Admin Menu
***************************/
function dmh_remove_admin_menus() {

	remove_menu_page( 'edit.php' );

}

/**************************
Active Nav Link
***************************/
function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}

/**************************
Pagination
***************************/
function pagination($pages = '', $range = 4)
{
  $showitems = ($range * 2)+1;

  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '')
  {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages)
    {
      $pages = 1;
    }
  }

  if(1 != $pages)
  {
    echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
    if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

    for ($i=1; $i <= $pages; $i++)
    {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
      {
        echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
      }
    }

    if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
    echo "</div>\n";
  }
}

/**************************
Scripts
***************************/
function dmh_scripts() {
    //wp_deregister_script('jquery');
    wp_enqueue_script('jquery');
    wp_register_script( 'fresco', get_template_directory_uri() . '/js/fresco/fresco.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'fresco', get_template_directory_uri() . '/js/fresco/fresco.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '', true );
}

/**************************
Styles
***************************/

function dmh_styles() {
    wp_register_style( 'dmh-style', get_template_directory_uri() . '/style.css', '', '', 'screen' );
	wp_enqueue_style( 'dmh-style' );

	wp_enqueue_style( 'dmh-editor-styles', get_stylesheet_directory_uri() . '/css/editor.css', '', '', 'screen' );
}

/**************************
Excerpts
***************************/
function new_excerpt_length($length) {
  return 18;
}

// function new_excerpt_more( $more ) {
// 	return '';
// }

// Changing excerpt more
function new_excerpt_more($more) {
  global $post;
  return '… <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}

/**
* Allows visitors to page forward/backwards in any direction within month view
* an "infinite" number of times (ie, even if no events available for those months).
*/

if ( class_exists( 'Tribe__Events__Main' ) ) {

  class ContinualMonthViewPagination {
    public function __construct() {
      add_filter( 'tribe_events_the_next_month_link', array( $this, 'next_month' ) );
      add_filter( 'tribe_events_the_previous_month_link', array( $this, 'previous_month' ) );
    }

    public function next_month() {
      $url = tribe_get_next_month_link();
      $text = tribe_get_next_month_text();
      $date = Tribe__Events__Main::instance()->nextMonth( tribe_get_month_view_date() );
      return '<a data-month="' . $date . '" href="' . $url . '" rel="next">' . $text . ' <span>&raquo;</span></a>';
    }

    public function previous_month() {
      $url = tribe_get_previous_month_link();
      $text = tribe_get_previous_month_text();
      $date = Tribe__Events__Main::instance()->previousMonth( tribe_get_month_view_date() );
      return '<a data-month="' . $date . '" href="' . $url . '" rel="prev"><span>&laquo;</span> ' . $text . ' </a>';
    }
  }

  new ContinualMonthViewPagination;

}

/**
 * Method of listing upcoming events
 *
 */
function dmh_event_list() {
  // Safety first! Bail in the event TEC is inactive/not loaded yet
  if ( ! class_exists( 'Tribe__Events__Main' ) )
  return;


  // Build our query, adopt the default number of events to show per page
  $output = '';
  $upcoming = new WP_Query( array(
    'post_type' => Tribe__Events__Main::POSTTYPE,
    'posts_per_page'   => 5
  ) );

  // If we got some results, let's list 'em
  while ( $upcoming->have_posts() ) {
    $upcoming->the_post();
    $eventTitle = get_the_title();
    $eventLink = get_the_permalink();
    $date  = tribe_get_start_date($pageID, false, "l F, jS Y");

    // Of course, you could and probably would expand on this
    // and add more info and better formatting
    echo '<div><h4><i class="fa fa-calendar"></i> test <a href="'.$eventLink.'">'.$eventTitle.'</a></h4><p>'.$date.'</p></div>';
  }

  // Clean up
  wp_reset_query();
}

// Create a new shortcode to list upcoming events, optionally
// with pagination

function dmh_recent_news() {
  $output = '';
  $query_args = array(
    'post_type' => 'news',
    'posts_per_page' => 5
  );
  // create a new instance of WP_Query
  $news_query = new WP_Query( $query_args );

  if ( $news_query->have_posts() ) :
    while ( $news_query->have_posts() ) : $news_query->the_post();
    $title = get_the_title();
    $link = get_the_permalink();
    $date = get_the_date('l F, jS Y');
    $excerpt = wp_trim_words( get_the_content(), 10, '...' );
    // run the loop
    $output .= '<div>';
    $output .= '<h4><i class="fa fa-comments-o"></i><a href="'.$link.'">'.$title.'</a></h4>';
    $output .= '<div class="date">Posted '.$date.'</div>';
    $output .= '<div class="excerpt">'.$excerpt.'</div>';
    $output .= '</div>';
  endwhile;
endif;
echo $output;
// Clean up
wp_reset_query();
}

/**
 * Event Espresso
 *
 * @param type
 * @return void
 */

//* Set Event Espresso to look for the ticket selector template in the espresso templates folder within the uploads folder for WordPress
function ee_custom_ticket_selector_template_location(){
  return WP_CONTENT_DIR . '/uploads/espresso/templates/ticket_selector_chart.template_show_remaining_tickets.php';
}

function my_remove_ical_link() {
  remove_filter( 'FHEE__espresso_list_of_event_dates__datetime_html', array( 'EED_Ical', 'generate_add_to_iCal_button' ), 10 );
}


function ee_remove_footer_text() {
  remove_filter( 'admin_footer_text', array( 'EE_Admin', 'espresso_admin_footer' ), 10 );
}


//Event espresso set deault ticket quantity to 1
  function ee_default_ticket_selector_one() {
   $post = get_the_id();
   ?>
   <script type="text/javascript">
   var postID = <?php echo(json_encode($post)); ?>;
   jQuery(document).ready(function () {
   jQuery("#ticket-selector-tbl-qty-slct-"+postID+"-1 option[value='0']").remove();
  });
   </script>
   <?php
  }


/**
 * Returns the proper banner image URL.
 *
 * If $postID is empty, return.
 * Get banner image field from curent page. If not empty, return the result.
 * Get post ancestors, reverse the array. If its not empty:
 * 	If the first parent is the care & treatment page (id # 78), return its banner image field.
 * 	If the post ancestors are not empty, but t
 *
 * @param 	int 	$postID 		The post ID
 *
 * @return 	url 					The banner image URL
 */
function dmh_get_banner_image( $postID ) {

	if ( empty( $postID ) ) { return; } // no postID, exit.

	$banner = '';

	$banner = get_field( 'hero_image', $postID ); // get hero image field

	if ( ! empty( $banner ) ) { return $banner; } // if not empty, return it.

	$banner = dmh_get_thumbnail_url( $postID, 'full' ); // get featured image

	if ( ! empty( $banner ) ) { return $banner; } // if not empty, return it.

	$parents 	= get_post_ancestors( $postID ); // get all parents

	if ( ! empty( $parents ) ) {

		$parents 	= array_reverse( $parents ); // reverse the order
		$slug 		= get_post( $parents[0] ); // get the first parent's slug

	}

	// if the parents aren't empty and its a care & treatment child page
	// return the hero image of the parent
	if ( ! empty( $parents[0] ) && 'care-treatment' === $slug->post_name ) {

		$banner = dmh_get_thumbnail_url( $parents[1], 'full' );

		if ( ! empty( $banner ) ) { return $banner; }

		$field = get_field( 'hero_image', $parents[1] );

		if ( ! empty( $field ) ) { return $field; }
	
	}

	return get_theme_mod( 'default_banner_image' ); // finally, return the default banner

} // dmh_get_banner_image()

/**
 * Returns the emergency room paitent count and average wait time
 * by processing the EpicWaitTimes.xml file that's uploaded every
 * five minutes.
 *
 * @return 	array 		An array with the wait time minutes, patient count, and when the file was updated.
 */
function dmh_get_waittimes() {

	$return = array();

	$xml = file_get_contents('/var/ftp/er.wait.times/EpicWaitTimes.xml');

	if ( empty( $xml ) ) { return 'Empty XML'; }

	$feed = simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA);

	if ( empty( $feed ) ) { return 'Empty feed'; }

	$return['minutes'] 	= $feed->waitTimeMinutes;
	$return['count'] 	= $feed->patientCount[0];
	$central 			= new DateTimeZone( 'America/Chicago' );
	$utczone 			= new DateTimeZone( 'UTC' );
	$chi 				= new DateTime( 'America/Chicago' );
	$utc 				= new DateTime( 'UTC' );
	$offset 			= $utczone->getOffset($utc) - $central->getOffset($chi); // difference between the UTC and Chicago timezones in seconds.

	// Reduce the file timestamp by the time zone offset between Chicago and the server time (UTC).
	$modified = filemtime( '/var/ftp/er.wait.times/EpicWaitTimes.xml' ) - $offset;
	$modified = date( 'n/j/Y g:i:s A', $modified );

	$return['updated'] = $modified;

	return $return;
	
} // dmh_get_waittimes()

/**
 * Returns the URL of the featured image
 *
 * @param 	int 		$postID 		The post ID
 * @param 	string 		$size 			The image size to return
 *
 * @return 	string | bool 				The URL of the featured image, otherwise FALSE
 */
function dmh_get_thumbnail_url( $postID, $size = 'thumbnail' ) {

	if ( empty( $postID ) ) { return FALSE; }

	$thumb_id = get_post_thumbnail_id( $postID );

	if ( empty( $thumb_id ) ) { return FALSE; }

	$thumb_array = wp_get_attachment_image_src( $thumb_id, $size );

	if ( empty( $thumb_array ) ) { return FALSE; }

	return $thumb_array[0];

} // dmh_get_thumbnail_url()

/**
 * Adds the icon links to the home page footer.
 */
function dmh_home_icon_links() {

	$links = get_field( 'links' );

	if ( empty( $links ) ) { return; } 

	?><div class="homefooter">
    <div class="contain">
      <ul><?php

		foreach ( $links as $link ) :

			?><li><a href="<?php
				echo esc_url( $link['url'] );
			?>"><?php

			if ( 'icon' === $link['icon_type'] ) {

				?><i class="fa fa-<?php echo esc_attr( $link['icon'] ); ?>"></i><?php

			} elseif ( 'image' === $link['icon_type'] ) {

				?><img class="link-img" src="<?php echo esc_url( $link['image']['url'] ); ?>"><?php

			}

			?><span><?php
				esc_html_e( $link['text'], 'dmh' );
			?></span></a></li><?php

		endforeach;

      ?></ul>
    </div>
  </div><?php 

} // dmh_home_icon_links()



/**
 * Load Molecular Medicine file.
 */
require get_stylesheet_directory() . '/inc/molecular-landing.php';

/**
 * Load Calendar Functions file.
 */
require get_stylesheet_directory() . '/inc/calendar-functions.php';

/**
 * Load TinyMCE Functions file.
 */
require get_stylesheet_directory() . '/inc/tinymce-functions.php';

/**
 * Load MyChart page Functions file.
 */
require get_stylesheet_directory() . '/inc/mychart-functions.php';

/**
 * Load Customizer file.
 */
require get_stylesheet_directory() . '/inc/customizer.php';



