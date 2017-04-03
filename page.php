<?php
/**
 * Template Name: Template 1 - General Template
 */

$fields = get_fields( get_the_ID() );

get_header(); ?>

<div class="contain wrapper"><?php

	if ( have_posts() ) : 
		
		while ( have_posts() ) : the_post();

			get_template_part( 'banner' );

			get_template_part( 'breadcrumbs' );

			get_template_part( 'mobile-sidebar' );

			?><div class="sideBar">
				<h3><?php the_title(); ?></h3>
				<div class="sideMenu"><?php
				
				if ( ! $fields['hide_default_menus'] ) {

					global $post;

					$parentsSidebar = get_post_ancestors( get_the_ID() );
					$parentsSidebar = array_reverse($parentsSidebar);
					$mainParentSidebar = $parentsSidebar[0];

					if ( $mainParentSidebar == 78 ) {
						
						$mainParentSidebar = $parentsSidebar[1];

					}

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
					
				} // hide default menus, or not?

				if ( $fields['add_extra_menus'] ) {
					
					?><div class="add"><?php
					
						if ( have_rows('additional_menus') ):
						
							while ( have_rows('additional_menus') ) : the_row();
							
								the_sub_field( "menu_to_add" );
								
							endwhile;
							
						endif;
					
					?></div><?php
				
				}

				?></div>
			</div>
			<div class="main"><?php
			
				$pageHeaderColor = 'transparent';
				// Is this a sub page of Care & Treatment?
				$ancestors = get_post_ancestors( $post );
				
				if ( in_array( '78', $ancestors ) ) {
					
					// Does the page have a header color declared?
					if ( $fields['header-color-picker'] ) {
						
						$pageHeaderColor = $fields['header-color-picker'];
						
					} else {
						
						//Find the top level parent for grandchild pages
						$parent = array_reverse(get_post_ancestors($post->ID));
						// Care & Treatment will be in position 0 so look one level down
						$mainParent = get_page($parent[1]);
						$mainParentID = $mainParent->ID;
						
						if (get_field('header-color-picker', $mainParentID)){
							
							$pageHeaderColor = get_field('header-color-picker', $mainParentID);
							
						}
						
					}
					
					?><div class="page-header-color" style="background-color:<?php echo $pageHeaderColor?>">

					<!-- Show title in colored bar only on Care & Treatment parent pages --><?php

						$postAncestors 	= get_post_ancestors();
						$postAncestors 	= array_reverse($postAncestors);
						$postParent 	= $postAncestors[1];

						if ($postParent == 78) {
							
							$postParent = $postAncestor[1];
							
						}

						if ( ! in_array( $postParent, $post->ancestors ) ) {
							
							?><h1 class="title"><?php the_title(); ?></h1><?php 
						
						} 
						
					?></div><?php
					
				} // Endif
				
				?><div class="mainContent"><?php

					if ( is_front_page() || is_page( 'er-wait-times' ) ) :

						?><div class="waitTimes"><?php

							$waittimes = dmh_get_waittimes();

							//echo '<!-- <pre>'; print_r( $waittimes ); echo '</pre>-->';

							?><h4>EMERGENCY ROOM WAIT TIMES</h4>
							<p class="time">AVERAGE WAIT TIME: <?php echo esc_html( $waittimes['minutes'] ); ?> minutes</p>
							<p class="count">PATIENT COUNT: <?php echo esc_html( $waittimes['count'] ); ?></p>
							<p class="updated">Updated: <?php echo esc_html( $waittimes['updated'] ); ?></p>
							<hr>
						</div><?php

					endif;

					?><!-- Show title on all pages unless child of Care & Treatment --><?php

					$postAncestors = get_post_ancestors( get_the_ID() );
					$postAncestors = array_reverse($postAncestors);
					
					if( ! empty( $postAncestors ) ) {

						$postParent = $postAncestors[0];

						if ( $postParent !== 78 ) {

							?><h1 class="basic-title"><?php the_title(); ?></h1><br /><?php 
							
						}
						
					} else { 
						
						?><h1 class="basic-title"><?php the_title(); ?></h1><?php 
					
					}
					
					the_content(); 
					
				?></div>
			</div><?php 
		
		endwhile; 
	
	else : 
		
		?><p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p><?php 
	
	endif; 
	
?></div><?php

get_footer();
