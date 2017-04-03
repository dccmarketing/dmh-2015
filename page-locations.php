<?php
/*
Template Name: Template 4 - Locations
 */
 ?>

 <?php get_header(); ?>

	<div class="contain wrapper location">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'banner' ); ?>
			
			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<h3>Locations &amp; Maps</h3>
				<div class="sideMenu">

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

					<div class="loc">
						<?php $current_page = $post->ID; ?>

						<?php $loop = new WP_Query( array( 'post_type' => 'location' )); ?>

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
					</div>
				</div>
			</div>

			<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

	</div>

<?php get_footer();
