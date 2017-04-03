<?php
/*
Template Name: Template 8 - Find a Doctor by Specialty
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

          <div class="doc-list">
                
            <h2>Display by Specialty</h2>

              <ul class="specialties">
                
                <?php

                
                // Get all the taxonomies for this post type
                $taxonomies = get_object_taxonomies( (object) array( 'post_type' => 'doctor' ) );

              
                foreach( $taxonomies as $taxonomy ) :

                    // Gets every "category" (term) in this taxonomy to get the respective posts
                    $terms = get_terms( $taxonomy );
                    $numTerms = count($terms);
                    $listLength = $numTerms/2;
                    $listLength = round($listLength);
                    $counter = 1;

                    $donotshow = get_field('specialties_that_will_not_display',3845);

                    //print_r( $donotshow );

                      foreach( $terms as $term ) :
                        
                          $termLink = get_term_link( $term );

                        if (!in_array( $term->term_id, $donotshow)) {


                          //echo $term->term_id; 

                          echo "<li class='item".$term->term_id."''><a href='".$termLink."'>".$term->name."</a>";
                          // List Doctors Under Each Category
                          // $posts = new WP_Query( "taxonomy=$taxonomy&term=$term->slug&posts_per_page=2" );
                          //
                          // if( $posts->have_posts() ):
                          //   echo "<ul>";
                          //   while( $posts->have_posts() ) : $posts->the_post();
                          //     echo "<li><a href='".get_the_permalink()."'>".get_the_title()."</a></li>";
                          //   endwhile;
                          //   echo "</ul>";
                          // endif;
                          echo "</li>";
                          if ($counter == $listLength) {
                            echo "</ul><ul class='specialties right-col'>";
                          }
                          $counter++;

                        }

                      endforeach;
                        
                  endforeach;
                ?>
              </ul>
          </div>


				</div>
			</div>

		<?php endwhile;?>
		<?php endif; ?>
	</div>


<?php get_footer();
