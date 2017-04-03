<?php
/**
 * Template Name: Template 1 - General Template
 */

get_header();

	?><div class="contain wrapper no-sidebar">
		<div class="main">
			<div class="mainContent">
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'That cannot be found.', 'dmh' ); ?></h1>
					</header><!-- .page-header -->

					<div class="page-content">
						<p><?php esc_html_e( 'It looks like nothing was found at this location. Look in the sitemap below or try a search?', 'dmh' ); ?></p>
						<p><?php get_search_form(); ?></p><?php

						echo do_shortcode( '[pagelist exclude="4265,4267,4188,4185,4187,4186,4266,4462"]' );

					?></div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div>
		</div>
	</div><?php

get_footer();