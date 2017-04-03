<?php
/*
Template Name: Template 7 - Find a Doctor by Name
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
						<h2>Physicians by Name</h2>
						<p class="viewAll">View All</p>
						<ul class="letters">
							<li id="A">A</li>
							<li id="B">B</li>
							<li id="C">C</li>
							<li id="D">D</li>
							<li id="E">E</li>
							<li id="F">F</li>
							<li id="G">G</li>
							<li id="H">H</li>
							<li id="I">I</li>
							<li id="J">J</li>
							<li id="K">K</li>
							<li id="L">L</li>
							<li id="M">M</li>
							<li id="N">N</li>
							<li id="O">O</li>
							<li id="P">P</li>
							<li id="Q">Q</li>
							<li id="R">R</li>
							<li id="S">S</li>
							<li id="T">T</li>
							<li id="U">U</li>
							<li id="V">V</li>
							<li id="W">W</li>
							<li id="X">X</li>
							<li id="Y">Y</li>
							<li id="Z">Z</li>
						</ul>

            <div class="doc-names">
              <?php
                $anchorChar = '';
                $args = array( 'post_type' => 'doctor', 'posts_per_page'=>-1, 'orderby'=>'title','order'=>'ASC');
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                  $name = get_the_title();//Get Dr. lastname, firstname
                  $name = $name{0};//grab first letter of lastname
                  $name = strtoupper($name); //Makes the letter uppercase
                  $title = get_the_title();
                  $link = get_the_permalink();
                  if ($anchorChar === '') {
                    $anchorChar = $name;
                    echo '<div class="doc-name '.$anchorChar.'">';
                    echo '<h3>'.$anchorChar.'</h3>';
                  }
                  elseif ($anchorChar != $name) {
                    $anchorChar = $name;
                    echo '</div><div class="doc-name '.$anchorChar.'">';//Close previous div snd create new
                    echo '<h3>'.$anchorChar.'</h3>';
                  }
                  echo '<a href="'.$link.'">'.$title.'</a><br />';
                  ?>
                <?php endwhile; ?>
              </div> <!-- Close the last div -->
              <div class="doc-name hide none">
                <p>
                  No Doctors Found with that letter.
                </p>
              </div>
            </div>
					</div>

				</div>
			</div>

		<?php endwhile; else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>


<?php get_footer();
