<?php
/*
Template Name: MyChart
*/

get_header();

$fields = get_fields( get_the_ID() );

?><div class="contain wrapper"><?php 

	if ( have_posts() ) : while ( have_posts() ) : the_post();

		get_template_part( 'banner' );

		get_template_part( 'breadcrumbs' );

		get_template_part( 'mobile-sidebar' );

		?><div class="sideBar">
			<h3><?php the_title(); ?></h3>
			<div class="sideMenu"><?php

				global $post;

				$parentsSidebar = get_post_ancestors( get_the_ID() );

				$parentsSidebar = array_reverse($parentsSidebar);

				// echo '<p>'; print_r ($parentsSidebar); '</p>';

				$mainParentSidebar = $parentsSidebar[0];

				if ($mainParentSidebar == 78) {
					$mainParentSidebar = $parentsSidebar[1];
				}

				// echo '<p>'; print_r ($mainParentSidebar); '</p>';

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
					'echo'         => 3,
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

				if( get_field("add_extra_menus" )) { 

					?><div class="add"><?php 

						if ( have_rows('additional_menus') ) :
							
							while ( have_rows('additional_menus') ) : the_row();
	                        	
								the_sub_field( "menu_to_add" );

							endwhile;

						endif;

					?></div><?php

				}

				?></div>
			</div>
			<div class="main">
				<div class="mainContent">
					<section class="mychart-top-content"><?php

						if ( ! empty( $fields['login_box_title'] ) && ! empty( $fields['log_in_box'] ) ) :

							?><div class="mychart-login-box">
								<div class="mychart-login-box-title"><?php echo $fields['login_box_title']; ?></div>
								<div class="mychart-login-box-content"><?php
									echo $fields['log_in_box'];
								?></div>
							</div><?php

						endif;

						the_content();

					?></section><?php

					if ( have_rows('icon_boxes') ) :

						?><div class="mychart-icon-boxes"><?php
							
						while ( have_rows('icon_boxes') ) : the_row();

							$layout = get_sub_field( 'layout' );

							?><section class="icon-box <?php echo esc_attr( $layout ); ?>"><?php

								/**
								 * The icon-box-layout action hook
								 * 
								 * @hooked 	mychart_box_icon_right 		10
								 * @hooked 	mychart_box_icon_left 		10
								 * @hooked 	mychart_box_icon_top 		10
								 * @hooked 	mychart_box_icon_bottom 	10
								 */
								do_action( 'icon-box-layout', $layout );

							?></section><?php

						endwhile;

						?></div><!-- .icon-boxes --><?php

					endif;

				?></div>
			</div><?php

		endwhile; else :

			?><p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p><?php

		endif;
	
	?></div><!-- .wrapper.contain --><?php

get_footer();
