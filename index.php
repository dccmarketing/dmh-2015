<?php get_header(); ?>

	<div class="contain wrapper">
		<!-- Index -->

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'banner' ); ?>

			<?php get_template_part( 'breadcrumbs' ); ?>

			<?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<h3><?php the_title(); ?></h3>
				<div class="sideMenu">

					<?php global $post;

					$parentsSidebar = get_post_ancestors();

					$parentsSidebar = array_reverse($parentsSidebar);

					echo '<p>'; print_r ($parentsSidebar); '</p>';

					$mainParentSidebar = $parentsSidebar[0];

					if ($mainParentSidebar == 78) {
						$mainParentSidebar = $parentsSidebar[1];
					}

					echo '<p>'; print_r ($mainParentSidebar); '</p>';

					if (in_array($mainParentSidebar, $post->ancestors)) {
				    	$id = $mainParentSidebar;
					} else {
						$id = get_the_ID();
					}

					$args = array(
						'authors'      => '',
						'child_of'     => $id,
						'date_format'  => get_option('date_format'),
						'depth'        => 5,
						'echo'         => 1,
						'exclude'      => '',
						'include'      => '',
						'link_after'   => '',
						'link_before'  => '',
						'post_type'    => 'page',
						'post_status'  => 'publish',
						'show_date'    => '',
						'sort_column'  => 'menu_order, post_title',
					        'sort_order'   => '',
						'title_li'     => __(''),
						'walker'       => new Walker_Page
					);

					wp_list_pages( $args );
					?>

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
				<?php
				$pageHeaderColor = 'transparent';
				// Is this a sub page of Care & Treatment?
				$ancestors = get_post_ancestors( $post );
				if ( in_array( '78', $ancestors ) ) {
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
					<div class="page-header-color" style="background-color:<?php echo $pageHeaderColor?>">


						<!-- <h1><?php the_title(); ?></h1> -->



					</div>
				<?php
				}// Endif
				?>

				<div class="mainContent">

					<?php 

					$postAncestors = get_post_ancestors();

					$postAncestors = array_reverse($postAncestors);

					// echo '<p>'; print_r ($postAncestors); '</p>';

					$postParent = $postAncestors[0];

					if ($postParent == 78) { ?>

				    	<!-- This is a placeholder to see content 

				    		<h1 class="basic-title">SHOULD HAVE NO HEADING</h1> 

				    	-->

					<?php } else { ?>

						<h1 class="basic-title"><?php the_title(); ?></h1> 

					<?php } ?>


					<?php the_content(); ?>
				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, not found.' ); ?></p>
		<?php endif; ?>
	</div>

<?php get_footer();
