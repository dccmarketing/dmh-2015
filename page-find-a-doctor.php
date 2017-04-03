<?php
/*
Template Name: Template 3 - Find a Doctor
 */
 ?>

 <?php get_header(); ?>

	<div class="contain wrapper doctors">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'banner' ); ?>

			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<h3>Find a Doctor</h3>
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

					<?php get_template_part( 'doctor-search' ); ?>

				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>


<?php get_footer();
