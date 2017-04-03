<div class="doc-head">
	<div class="doc col-1">
		<h3>FIND</h3>
		<div class="doc-search">
			<form method="get" id="searchdoc" action="<?php bloginfo('home'); ?>/">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>
				<div class="border">
					<p>FIND</p>
					<input type="hidden" name="post_type" value="doctors" />
					<input type="text" size="18" value="" placeholder="Type Physician's Name Here" name="s" id="s" />
					<a href="/find-a-doctor-by-name/">Click here to view all physicians by name ></a>
					<input type="submit" id="searchdoctors" value="SEARCH" class="btn" />
				</div>

			</form>
		</div>
	</div>

	<div class="doc col-2">
		<h3>BROWSE</h3>
		<div class="doc-specialty">
			<p>BY SPECIALTY</p>

				<?php

				$donotshow = get_field('specialties_that_will_not_display',3845);

				//str_replace(array('[', ']'), '', htmlspecialchars(json_encode($donotshow), ENT_NOQUOTES));
				
				//echo json_encode($donotshow);

				$donotshow = str_replace(array('[', ']'), '', htmlspecialchars(json_encode($donotshow), ENT_NOQUOTES));

				//echo $donotshow;
				



					$specialty = array(
					          'hierarchical'   => 0,
										'show_option_none'   => 'Choose a Specialty',
										'taxonomy'           => 'dr-specialty',
										'value_field'	     => 'slug',
										'orderby'            => 'slug',
										'order'				 => 'ASC',
										'exclude'			=> $donotshow,
					          			'title_li' => ''
					);
				?>
				<?php wp_dropdown_categories( $specialty ); ?>
				<script type="text/javascript">
					<!--
					var dropdown = document.getElementById("cat");
					function onCatChange() {
						if ( dropdown.options[dropdown.selectedIndex].value != '' ) {
							location.href = "<?php echo esc_url( home_url( '/' ) ); ?>/dr-specialty/"+dropdown.options[dropdown.selectedIndex].value;
						}
					}
					dropdown.onchange = onCatChange;
					-->
				</script>

			<a href="/find-a-doctor-by-specialty/">Click here to view all physicians by Specialty ></a>
		</div>
	</div>
</div>
