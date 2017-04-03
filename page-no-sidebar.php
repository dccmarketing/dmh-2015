<?php
/*
Template Name: Template 10 - General Template w/o Sidebar
 */
 ?>

 <?php get_header(); ?>

	<div class="contain wrapper no-sidebar">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'banner' ); ?>
			
			<?php get_template_part( 'breadcrumbs' ); ?>

			<div class="main">
				<?php
				$pageHeaderColor = 'transparent';
				// Is this a sub page of Care & Treatment?
				$ancestors = get_post_ancestors( $post );
				if ( in_array( '78', $ancestors ) ) :
					// Does the page have a header color declared?
					if (get_field('header-color-picker')) {
						$pageHeaderColor = get_field('header-color-picker');
					}
					else {
						//Find the top level parent for grandchild pages
						$parent = array_reverse(get_post_ancestors($post->ID));
						// Care & Treatment will be in position 0 so look one level down
						$mainParent = get_page($parent[1]);
						$mainParentID = $mainParent->ID;
						if (get_field('header-color-picker', $mainParentID)){
							$pageHeaderColor = get_field('header-color-picker', $mainParentID);
						}
					}
					?>
					<div class="page-header-color" style="background-color:<?php echo $pageHeaderColor?>"></div>
				<?php
				else :

					?><h1 class="basic-title"><?php the_title(); ?></h1><?php

				endif;
				
				?><div class="mainContent">
					<!-- Page -->
					<?php the_content(); ?>
				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

<?php get_footer();
