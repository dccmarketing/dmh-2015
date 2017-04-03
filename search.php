<?php get_header(); ?>
<style>

	.hero.no-image {background-image: url('<?php the_field('default_banner_image',3353); ?>');}
	.hero.new-image {background-image: url('<?php the_field('hero_image'); ?>') !important;}

</style>
	<div class="contain wrapper">

			<div class="hero no-image <?php the_field('new_image'); ?>">
			<!--	<?php
				//Display DR. Search in banner if it's a search query containing doctor post_type
				if(isset($_GET['post_type'])) {
        $type = $_GET['post_type'];
        if($type == 'doctors') {?>
        	<h1>Find a Doctor</h1>
        <?php
        } else {?>
          <h1>Search Results</h1>
        <?php }
		    }?> -->
			</div> 

			<?php get_template_part( 'mobile-sidebar' ); ?>
			
			<div class="sideBar">


					<?php
					//Display Find a Dr. Nav if its a Dr. Search
					if(isset($_GET['post_type'])) {
	        $type = $_GET['post_type'];
	        if($type == 'doctors') { ?>
						<h3>Find a Doctor</h3>
						<div class="sideMenu">
							<div class="add">
								<?php wp_nav_menu( array('menu' => 'Find a Doctor' )); ?>
								<li class="backButton"><a href="javascript:history.go(-1)" onMouseOver="self.status=document.referrer;return true">< Back</a></li>
							</div>
						</div>
	        <?php }
			    }else {?>
						<h3>Other Pages</h3>
						<div class="sideMenu">
							<div class="add">
								<?php
									wp_nav_menu(array(
										'theme_location' => 'general-nav',
										'container' => 'div',

									));
								?>
								<li class="backButton"><a href="javascript:history.go(-1)" onMouseOver="self.status=document.referrer;return true">< Back</a></li>
							</div>
						</div>
					<?php } ?>
			</div>
			<div class="main">
				<div class="mainContent">
					<?php
					//Display Dr. Search boxes if it's a search query containing doctor post_type
					if(isset($_GET['post_type'])) {
					$type = $_GET['post_type'];
						if($type == 'doctors') {?>
							<?php get_template_part( 'doctor-search' ); ?>
						<?php
						} else {?>
						<?php }
					}?>
					<h2 class="search-title">Search Results</h2>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a><br>
					<?php the_excerpt(); ?>
					<br>

					<?php endwhile; else : ?>
						<?php
							//Display Dr. Search boxes if it's a search query containing doctor post_type
							if(isset($_GET['post_type'])) {
							$type = $_GET['post_type'];
								if($type == 'doctors') {?>
									<p><?php _e( 'Sorry, no doctors matched your criteria.' ); ?></p>
								<?php
								} ?>
							<?php
							} else {?>
								<p><?php _e( 'Sorry, no items matched your criteria.' ); ?></p>
							<?php } ?>
					<?php endif; ?>
				</div>
			</div>


	</div>

<?php get_footer();
