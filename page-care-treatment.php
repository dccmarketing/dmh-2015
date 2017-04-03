<?php
/*
Template Name: Template 5 - Care & Treatment
 */
 ?>

<?php get_header(); ?>

	<div class="contain wrapper">

		<?php get_template_part( 'breadcrumbs' ); ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div class="main ct">
				<div class="mainContent">
					<div class="heading">
						<h1><?php the_title(); ?></h1>
						<div class="selection">
				              <form action="<?php bloginfo('url'); ?>" method="get">
				                  <?php
				                  $select = wp_dropdown_pages(
	                                      array(
	                                          'child_of' => 78,
	                                          'show_option_none' => 'Select',
	                                          'depth' => 1,
	                                          'echo' => 0
	                                      )
	                                  );

				                  echo str_replace('<select ', '<select onchange="this.form.submit()" ', $select);
				                  ?>
				              </form>
						</div>
						<div class="headContent">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="groups">
						<?php if( have_rows('category') ):
							while ( have_rows('category') ) : the_row(); ?>

							<a class="group" href="<?php the_sub_field('category_main_page_link'); ?>" title="<?php the_sub_field('category_name'); ?>">
								<div class="image" style="background-image: url('<?php the_sub_field('category_image'); ?>');">
									<div class="info">
										<h4><?php the_sub_field('category_description'); ?></h4>
									</div>
								</div>
								<div class="color" style="background: <?php the_sub_field('category_color'); ?>;"></div>
								<h3><?php the_sub_field('category_name'); ?></h3>
							</a>

						<?php  endwhile; else : endif; ?>
					</div>
				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

<?php get_footer();
