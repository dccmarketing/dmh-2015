<?php get_header(); ?>

	<div class="contain wrapper">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$event_class = has_excerpt( $post->ID ) ? ' has-excerpt' : '';
		$event_class = apply_filters( 'FHEE__content_espresso_events__event_class', $event_class );

		do_action( 'AHEE_event_details_before_post', $post );

		?>

			<?php if (get_field('hero_image')) : ?>
				<div class="hero has" style="background-image: url('<?php the_field('hero_image'); ?>');">
			<?php else : ?>
				<div class="hero no" style="background-image: url('<?php the_field('hero_image',4300); ?>');">
			<?php endif; ?>
			</div>


			<?php get_template_part( 'single-event-breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<?php

				$acfs = get_field('screenings', 4300);

				if( $acfs ): ?>
						<h3>Screenings</h3>
						<ul class="event-screenings">
						<?php foreach( $acfs as $post): // variable must be called $post (IMPORTANT) ?>
								<?php setup_postdata($post); ?>
								<li>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</li>
						<?php endforeach; ?>
						</ul>
						<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
				<?php endif; ?>

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
					<?php espresso_get_template_part( 'content/espresso/content', 'espresso_events' ); ?>
				</div>
			</div>

			<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

<?php get_footer();
