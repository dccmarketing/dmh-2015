<footer>
	<div class='contain'>
		<div class="location">
			<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			<div class="copyright">
				<span class="site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span> &middot; <address>2300 N. Edward Street &middot; Decatur, Illinois 62526 </address> &middot; <a href="tel:<?php echo esc_url( get_theme_mod( 'footer_phone_number' ) ); ?>"><?php echo esc_html( get_theme_mod( 'footer_phone_number' ) ); ?></a> &middot; <span>&copy <?php echo date( 'Y' ) . ' '; esc_html_e( 'All Rights Reserved', 'dmh' ); ?></span>
			</div>
		</div>
		<div class="footNav">
			<?php
				wp_nav_menu(array(
				  'theme_location' => 'footer-nav',
				  'container' => false,

			)); ?>
		</div>
	</div>
</footer>

<?php wp_footer();?>
</body>
</html>
