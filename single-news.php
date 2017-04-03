<?php get_header(); ?>

	<div class="contain wrapper">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php if (get_field('hero_image')) : ?>
				<div class="hero has" style="background-image: url('<?php the_field('hero_image'); ?>');">
			<?php else : ?>
				<div class="hero no" style="background-image: url('<?php the_field('default_banner_image',4480); ?>');">
			<?php endif; ?>
			</div>


			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<div class="sideMenu">
					<?php wp_list_categories('taxonomy=news-topic&title_li=News Categories'); ?>
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
					<h1 class="news-title"><?php the_title(); ?></h1>
					<div class="news-date"><? the_date('l F, jS Y'); ?></div>
					<?php the_content(); ?>

				</div>
			</div>

			<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

<?php get_footer();
