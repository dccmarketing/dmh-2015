<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>

	<meta charset="utf-8">

	<meta name="author" content="Decatur Memorial Hospital">

	<title><?php bloginfo('name'); ?> - <?php the_title(); ?></title>

	<?php wp_head();?>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Stylesheets -->
	<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"> -->

	<!-- Script -->
    <!-- <script src="<?php bloginfo('template_url'); ?>/js/jQuery-2.1.4.min.js"></script> -->
    <!-- <script src="<?php bloginfo('template_url'); ?>/js/custom.js"></script> -->

    <!-- Fresco -->
	<!-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> -->
	<!-- <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/fresco/fresco.js"></script> --><?php


$mods = get_theme_mods();

?></head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KJMWBL"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KJMWBL');</script>
<!-- End Google Tag Manager -->

	<div id="topBar">

		<div class="contain">
			<div class="topNav"><?php

				wp_nav_menu(array(
					'theme_location' => 'top-bar',
					'container' => false,
				));

			?></div>
		</div>
		<div id="mobileNav" class="mobile-only">
			<h3><?php echo esc_html( $mods['mobile_menu_text'] ); ?></h3>
			<div class="navBtn">
				<p class="open"><i class="fa fa-navicon"></i></p>
				<p class="close"><i class="fa fa-remove"></i></p>
			</div>
		</div>
	</div>
	<div class="wrap-phone">
		<button class="btn-phones"><?php echo esc_html( $mods['mobile_phone_menu_text'] ); ?> <i class="fa fa-phone"></i></button><?php

		$menu_args['menu']				= 'Phone Numbers Menu';
		$menu_args['container'] 		= 'div';
		$menu_args['container_id']    	= 'menu-phone-numbers';
		$menu_args['container_class'] 	= 'menu nav-phones contain';
		$menu_args['menu_class']      	= 'phone-numbers';
		$menu_args['depth']           	= 1;

		wp_nav_menu( $menu_args );

	?></div><!-- .wrap-phone -->

		<div class="contain">
			<p class="hospital"><?php echo esc_html( $mods['text_phone_hospital'] ); ?><a href="tel:<?php echo esc_url( $mods['phone_hospital'] ); ?>"><?php echo esc_html( get_theme_mod( 'phone_hospital' ) ); ?></a></p>
			<p class="scheduling"><?php echo esc_html( $mods['text_phone_scheduling'] ); ?><a href="tel:<?php echo esc_url( $mods['phone_scheduling'] ); ?>"><?php echo esc_html( get_theme_mod( 'phone_scheduling' ) ); ?></a></p>
		</div>
	</div>



	<header>
		<div class="contain">
			<div class="mobile-contain">
				<div class="hd-logo">
					<a href="<?php echo get_option('home'); ?>"><img src="<?php echo esc_url( $mods['dmh_logo'] ); ?>" alt="DMH Logo"></a>
				</div>
				<div class="headerSection">
					<div class="missionStatement">
						<img src="/wp-content/uploads/2016/02/mission-statement.png" alt="Mission Statement">
					</div>
					<div class="search">
						<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
							<!-- <?php include (TEMPLATEPATH . '/searchform.php'); ?> -->
							<div>
								<input type="text" size="18" value="" name="s" id="s" />
								<input type="submit" id="searchsubmit" value="" class="btn" />
							</div>
						</form>
						<div class="myChart">
							<a class="btn btn-blue-sky" href="/dmh-mychart/">DMH MyChart</a>
						</div>
					</div>
					<div class="social">
						<ul>
							<li><a href="<?php echo esc_url( $mods['facebook_url'] ); ?>"><i class="fa fa-facebook"></i></a></li>
							<li><a href="<?php echo esc_url( $mods['twitter_url'] ); ?>"><i class="fa fa-twitter"></i></a></li>
							<li><a href="<?php echo esc_url( $mods['youtube_url'] ); ?>"><i class="fa fa-youtube"></i></a></li>
							<li><a href="<?php echo esc_html( $mods['email_addresses'] ); ?>"><i class="fa fa-envelope-o"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<nav id="primaryNav">
				<?php

					wp_nav_menu(array(
					  'theme_location' => 'primary-nav',
					  'container' => false,

				)); ?>
			</nav>
		</div>
	</header>
	<?php

                    $xml = file_get_contents('/var/ftp/er.wait.times/EpicWaitTimes.xml');
                    $feed = simplexml_load_string($xml,'SimpleXMLElement', LIBXML_NOCDATA);
