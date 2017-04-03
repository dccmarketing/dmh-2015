<?php
/*
News (blog) Archive
 */
 ?>

 <?php get_header(); ?>

	<div class="contain wrapper">

    <div class="hero" style="background-image: url('<?php the_field('default_banner_image',4480); ?>');">
    </div>


      <?php get_template_part( 'breadcrumbs' ); ?>

      <?php get_template_part( 'mobile-sidebar' ); ?>

			<div class="sideBar">
				<div class="sideMenu">
          <div class="add">
          <?php wp_list_categories('taxonomy=news-topic&title_li=News Categories'); ?>
		    </div>
				</div>
			</div>
			<div class="main">
				<div class="mainContent">

          <h1 class="basic-title"><?php single_cat_title(); ?></h1><br />

          <?php if ( have_posts() ) : ?>
          <?php
            // set up or arguments for our custom query
            $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
            $query_args = array(
              'post_type' => 'news',
              'paged' => $paged
            );
            // create a new instance of WP_Query
            $the_query = new WP_Query( $query_args );
          ?>

          <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
            <i class="fa fa-comments-o"></i>
            <article>
              <h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
              <div class="excerpt">
                <?php the_excerpt(); ?>
              </div>
            </article>
          <?php endwhile; ?>

          <?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
            <nav class="prev-next-posts">
              <div class="prev-posts-link">
                <?php echo get_next_posts_link( 'Older Entries', $the_query->max_num_pages ); // display older posts link ?>
              </div>
              <div class="next-posts-link">
                <?php echo get_previous_posts_link( 'Newer Entries' ); // display newer posts link ?>
              </div>
            </nav>
          <?php } ?>

          <?php else: ?>
            <article>
              <h1>Sorry...</h1>
              <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            </article>
          <?php endif; ?>
				</div>
			</div>

		<?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
	</div>

<?php get_footer();
