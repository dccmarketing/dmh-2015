<?php
/**
* The template for displaying Archive pages
*/
?>
<?php get_header(); ?>

<div class="contain wrapper">
  
  <?php get_template_part( 'banner' ); ?>

  <?php get_template_part( 'breadcrumbs' ); ?>

  <?php get_template_part( 'mobile-sidebar' ); ?>

  <div class="sideBar">
    <h3><?php echo $taxTitle //category title ?></h3>
    <h3 class="doc-tax">Find a Doctor</h3>
    <div class="sideMenu">
      <?php if (is_tax('news-topic')): ?>
        <?php wp_list_categories('taxonomy=news-topic&title_li=News Categories'); ?>

      <?php endif; ?>
      
        <div class="add doc-tax">
          <?php

              wp_nav_menu(
                  array(
                'menu' => 'Find a Doctor',
                // do not fall back to first non-empty menu
                'theme_location' => '__no_such_location',
                // do not fall back to wp_page_menu()
                'fallback_cb' => false
                )
              );

          ?>
        </div>

  </div>
  </div>
  <div class="main">
    <div class="mainContent">

      <h1 class="basic-title"><?php single_cat_title(); ?></h1><br />

      <div class="doc-tax">
          <?php get_template_part( 'doctor-search' ); ?>
          <br /><br />
      </div>

      <!-- Archive -->

      <?php if ( have_posts() ) : $posts = query_posts($query_string .
      '&taxonomy=dr-specialty&orderby=title&order=asc&posts_per_page=-1'); ?>

        <?php /* The loop */ ?>
        <?php while ( have_posts() ) : the_post(); ?>

        <div class="isNews">
          <i class="fa fa-comments-o"></i>
            <article>
              <h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
              <div class="excerpt">
                <?php the_excerpt(); ?>
              </div>
            </article>
        </div>

        <div class="notNews notDoctors">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="excerpt">
            <?php the_excerpt(); ?>
          </div>
        </div>

        <div class="doc-tax">
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>

        <?php endwhile; ?>

      <?php else : ?>
        <h2>Sorry, No Posts Found</h2>
        <?php get_template_part( 'content', 'none' ); ?>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_footer();
