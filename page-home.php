<?php
/**
 * Template Name: Template 6 - Homepage
 */

get_header();

$fields = get_fields( get_the_ID() );

?><div class="contain wrapper home"><?php
	
	if ( have_posts() ) : while ( have_posts() ) : the_post();

	get_template_part( 'slider' );

	get_template_part( 'breadcrumbs' );

	?><div class="main">
		<div class="mainContent">
			<div class="wait_vid">
				<div class="wait">
					<p class="box-title"><i class="fa fa-group"></i>Information For You</p>
					<div class="wrap-infos">
						<div class="info1 info-box">
							<h4>EMERGENCY ROOM</h4><?php

							$waittimes = dmh_get_waittimes();

							?><p class="time">AVERAGE WAIT TIME: <?php echo esc_html( $waittimes['minutes'] ); ?> minutes</p>
							<p class="count">PATIENT COUNT: <?php echo esc_html( $waittimes['count'] ); ?></p> 
							<p class="updated">Updated: <?php echo esc_html( $waittimes['updated'] ); ?></p>
							<div class="moreInfo">
								<h4>More Information</h4>
								<p>ER total "Average Wait Time" is calculated from when a patient registers to when a patient sees a doctor. "Patient Count" is the total number of patients in the ER right now. Avg. wait time may increase due to critical patients. Real time calculations are updated every 5 minutes.</p>
							</div><!-- .moreInfo -->
						</div><!-- .info1 -->
						<div class="info-content"><?php
						
							the_content();
						
						?></div><!-- .info-content -->
					</div><!-- .wrap-promos -->
				</div><!-- .wait -->
			</div><!-- .wait_vid -->

			<div class="communication">
				<ul class="nav">
					<li id="newsBtn" class="active"><i class="fa fa-comments-o"></i>News</li>
					<li id="eventsBtn"><i class="fa fa-calendar"></i>Events</li>
					<div class="com-feed">
						<div id="com-news">
							<h2>In the News</h2>
							<div class="feed-scroll"><?php 
							
								echo do_shortcode("[dmh-recent-news]"); 
								
							?></div>
							<h3><a href="/news">More News ></a></h3>
						</div>
						<div id="com-events">
							<h2>Upcoming Events</h2>
							<div class="feed-scroll"><?php 
							
								echo do_shortcode("[ESPRESSO_EVENTS limit=5]"); 
								
							?></div>
							<h3><a href="/calendar/">More Events ></a></h3>
						</div>
					</div>
				</ul>
			</div><!-- .communication -->
		</div><!-- .mainContent -->
		
		<div class="videos gallery">
			<a class="box-title-link" href="https://www.youtube.com/user/decaturmemorial/videos" target="_blank"><p class="box-title"><i class="fa fa-youtube-play"></i> Videos</p></a>
			<div class="vids"><?php
			
			foreach ( $fields['videos'] as $video ) :
				
				?><a href="<?php echo esc_url( $video['url']); ?>"
				  style="background-image: url('<?php echo esc_url( $video['image'] ); ?>');"
				  class="fresco vid"
				  title="<?php echo esc_html( $video['label'] ); ?> - Video"
				  data-fresco-group='example'
				  data-fresco-options="
				  width: 853,
				  height: 480,
				  youtube: { autoplay: 0 }
				  ">
				  <h3 class="vid-title"><?php echo esc_html( $video['label'] ); ?></h3>
				</a><?php

			endforeach;

			?></div><!-- .vids -->
		</div><!-- .videos -->
		
	</div><!-- .main -->
</div><!-- .contain -->
</div><?php

endwhile; else : 

	?><p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p><?php

endif;

/**
 * The dmh_footer_before action hook.
 *
 * @hooked		dmh_home_icon_links			20
 */
do_action( 'dmh_footer_before' );

get_footer();
