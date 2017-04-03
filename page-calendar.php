<?php
/*
Template Name: Template 9 - Calendar Landing
 */
 ?>

 <?php get_header(); ?>

	<div class="contain wrapper">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'banner' ); ?>

			<?php get_template_part( 'breadcrumbs' ); ?>

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

					<!-- Show title in colored bar only on Care & Treatment parent pages -->
					<?php

						$postAncestors = get_post_ancestors();

						$postAncestors = array_reverse($postAncestors);

						$postParent = $postAncestors[1];

						if ($postParent == 78) {
							$postParent = $postAncestor[1];
						}

						if (in_array($postParent, $post->ancestors)) {

					?>

					<?php } else { ?>

						<h1 class="title"><?php the_title(); ?></h1>

					<?php } ?>

				</div>
				<?php
				}// Endif
				?>

				<div class="mainContent">


						<h1 class="basic-title"><?php the_title(); ?></h1><br />


					<?php the_content(); ?>
				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>
<?php get_footer();
