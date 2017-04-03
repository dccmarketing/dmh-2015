<?php
/*
Template Name: Template 2 - Cancer Care
 */
 ?>

 <?php get_header(); ?>

	<div class="contain wrapper cancer">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'slider' ); ?>

			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<h3>DMH Cancer<br>Care Institute<br>Comprehensive<br>Cancer Program</h3>
					<div class="sideMenu">
						<div class="add">
							<ul>
								<?php if( have_rows('cancer_care_sidebar') ):
									while ( have_rows('cancer_care_sidebar') ) : the_row(); ?>
									
									<li><a href="<?php the_sub_field('link_location'); ?>"><?php the_sub_field('link_label'); ?></a></li>

								<?php  endwhile; else : endif; ?>
							</ul>
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

					<img src="<?php the_field('sidebar_image'); ?>" alt="<?php the_title(); ?>">

					<div class="info">
						<img src="<?php the_field('sidebar_logo'); ?>" alt="<?php the_title(); ?>">
						<?php the_field('sidebar_contact_info'); ?>
					</div>

				</div>

				


			<div class="main">
				
				<div class="color-block" style="background-color: <?php the_field( 'header-color-picker' ); ?>">
					<h2>DMH Cancer Care Institute Comprehensive Cancer Program</h2>
				</div>

				<div class="mainContent">

					<div class="content">
						<?php the_content(); ?>
					</div>

					<div class="column one">
						<div class="content">
							<?php the_field('column_1_content'); ?>
						</div>
					</div>

					<div class="column two">
						<div class="content">
							<?php the_field('column_2_content'); ?>
						</div>
					</div>

				</div>
					
				<?php endwhile; else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>

			</div>
	</div>



<?php get_footer();
