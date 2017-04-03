
<!-- Bootstrap Styling -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap-theme.css">

<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

<div class="sliderWrap">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">

			<?php

			// check if the repeater field has rows of data
			if( have_rows('slides') ):

				// loop through the rows of data
				while ( have_rows('slides') ) : the_row(); ?>

				<a href="<?php the_sub_field('slider_link'); ?>" class="item" style="background-image: url('<?php the_sub_field('slider_image'); ?>');">
					<div class="carousel-caption">
						<?php the_sub_field('slider-caption'); ?>
					</div>
				</a>


			<?php  endwhile;

			else :

				// no rows found

			endif;

			?>
		</div>
		<div class="slider-controls">
			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left fa fa-caret-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right fa fa-caret-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>

			<div class="slideFooter">
				<div class="boxes">
					<a href="<?php the_field('slider_box_link_1'); ?>/?utm_source=homepage&utm_medium=promoboxes&utm_campaign=promo1" class="box" style="background-image: url('<?php the_field('slider_box_image_1'); ?>');">
						<div class="hover"><h4><?php the_field('slider_box_hover_content_1'); ?></h4></div>
						<h3><?php the_field('slider_box_pre_hover_content_1'); ?></h3>
					</a>
					<a href="<?php the_field('slider_box_link_2'); ?>/?utm_source=homepage&utm_medium=promoboxes&utm_campaign=promo2" class="box" style="background-image: url('<?php the_field('slider_box_image_2'); ?>');">
						<div class="hover"><h4><?php the_field('slider_box_hover_content_2'); ?></h4></div>
						<h3><?php the_field('slider_box_pre_hover_content_2'); ?></h3>
					</a>
					<a href="<?php the_field('slider_box_link_3'); ?>/?utm_source=homepage&utm_medium=promoboxes&utm_campaign=promo3" class="box" style="background-image: url('<?php the_field('slider_box_image_3'); ?>');">
						<div class="hover"><h4><?php the_field('slider_box_hover_content_3'); ?></h4></div>
						<h3><?php the_field('slider_box_pre_hover_content_3'); ?></h3>
					</a>
					<a href="<?php the_field('slider_box_link_4'); ?>/?utm_source=homepage&utm_medium=promoboxes&utm_campaign=promo4" class="box" style="background-image: url('<?php the_field('slider_box_image_4'); ?>');">
						<div class="hover"><h4><?php the_field('slider_box_hover_content_4'); ?></h4></div>
						<h3><?php the_field('slider_box_pre_hover_content_4'); ?></h3>
					</a>
				</div>

				<!-- Indicators -->
				<!--
				<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				<li data-target="#carousel-example-generic" data-slide-to="3"></li>
				<li data-target="#carousel-example-generic" data-slide-to="4"></li>
			</ol>
		-->
	</div>

</div>


</div>

<!-- Bootstrap Scripting -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
