<?php
/*
Template Name: Template 3 - Find a Doctor
 */
 ?>
 <?php get_header(); ?>
<style>

	.hero.no-image {background-image: url('<?php the_field('default_banner_image',3353); ?>');}
	.hero.new-image {background-image: url('<?php the_field('hero_image'); ?>') !important;}

</style>
	<div class="contain wrapper doctors">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="hero no-image <?php the_field('new_image'); ?>">
			</div>

			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<h3>Find a Doctor</h3>
				<div class="sideMenu">

				<div class="add">
		          <?php

		              wp_nav_menu(
		                  array(
		                'menu' => 'Find a Doctor',
		                // do not fall back to first non-empty menu
		                'theme_location' => '__no_such_location',
		                // do not fall back to wp_page_menu()
		                'fallback_cb' => false
		                )
		              );

		          ?>
		        </div>

          <?php if( get_field("add_extra_menus" )) { ?>
              <div class="add">
                <?php if ( have_rows('additional_menus') ): ?>
                    <?php while ( have_rows('additional_menus') ) : the_row(); ?>
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
					
					<?php the_content(); ?>

					<?php get_template_part( 'doctor-search' ); ?>

					<div class="doctor">
						<div class="column left">
							<div class="content">
								<img src="<?php the_field('doctor_photo'); ?>" alt="<?php the_title(''); ?>"><br>
								<h3><!-- <?php the_title(''); ?> --> <?php the_field('first_name'); ?> <?php the_field('last_name'); ?> <?php the_field('doc_title'); ?></h3>

								<div class="section">
									<h4 class="label">Specialty</h4>
					                <!-- Loop through the taxonomy to list specialties-->
					                <ul class="doctor-specialty info">
					                  <?php
					                  $donotshow = get_field('specialties_that_will_not_display',3845);

					                  //Do something if a specific array value exists within a post
					                  $term_list = wp_get_post_terms($post->ID, 'dr-specialty', array("fields" => "all"));
					                  foreach($term_list as $term_single) {
					                  	if (!in_array( $term_single->term_id, $donotshow)) {
					                  $termLink = get_term_link( $term_single );
					                  //if ($term_single->name != 'DMH Medical Group')
					                  echo '<li><a href="'.$termLink.'">'.$term_single->name.'</a></li>'; //display the name
					                  		}
					              		}
					                  ?>

					                </ul>
					            </div>
				                
				                <div class="section">
					                <h4 class="label">Office Hours</h4>
									<div class="info"><?php the_field('office_hours'); ?></div>
								</div>

								<div class="section">
									<h4 class="label">Office Phone</h4>
									<p class="info"><?php the_field('office_phone'); ?></p>
								</div>

								<div class="section">
									<h4 class="label">Office Fax</h4>
									<p class="info"><?php the_field('office_fax'); ?></p>
								</div>
							</div>
						</div>
						<div class="column right">
							<div class="content">
								<div class="section">
									<h4 class="label">Office Address</h4>
					                <?php $relposts = get_field('office');
					                if( $relposts ): ?>

					                    <?php foreach( $relposts as $post): // variable must be called $post (IMPORTANT) ?>
					                        <?php setup_postdata($post); ?>
					                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					                            <p><?php the_field('office_address'); ?></p>
					                    <?php endforeach; ?>
					                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
					                <?php endif; ?>
					            </div>

				                <div class="section">
					                <h4 class="label">Additional Office Information</h4>
					                <div class="info"><?php the_field('additional_office_information'); ?></div>
					            </div>

					            <div class="section">
									<h4 class="label">Affiliations:</h4>
									<div class="info">
										<?php if( have_rows('affiliations') ):
											while ( have_rows('affiliations') ) : the_row(); ?>
											<h4><?php the_sub_field('heading'); ?></h4>
											<?php the_sub_field('description'); ?>
										<?php  endwhile; else : endif; ?>
									</div>
								</div>

								<div class="section">
									<h4 class="label">Education:</h4>
									<div class="info"><?php the_field('education'); ?></div>
								</div>

								<div class="section">
									<h4 class="label">Certification:</h4>
										<ul class="info">
											<?php if( have_rows('board_certification') ):
												while ( have_rows('board_certification') ) : the_row(); ?>
												<li><?php the_sub_field('certification'); ?></li>
											<?php  endwhile; else : endif; ?>
										</ul>
								</div>

								<div class="section">
									<h4 class="label">Memberships:</h4>
										<ul class="info">
											<?php if( have_rows('memberships') ):
												while ( have_rows('memberships') ) : the_row(); ?>
												<li><?php the_sub_field('membership'); ?></li>
											<?php  endwhile; else : endif; ?>
										</ul>
								</div>

								<div class="section">
									<h4 class="label">Special Interests:</h4>
									<div class="info"><?php the_field('special_interests'); ?></div>
								</div>

								<div class="section">
									<h4 class="label">Hometown:</h4>
									<div class="info"><?php the_field('hometown'); ?></div>
								</div>

							</div>
						</div>
					</div>

				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>


<?php get_footer();
