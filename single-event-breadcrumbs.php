<div class="breadcrumbs contain">
	<p id="breadcrumbs">
		<span xmlns:v="http://rdf.data-vocabulary.org/#">
			<span typeof="v:Breadcrumb">
				<a href="<?php echo get_home_url(); ?>" rel="v:url" property="v:title">Home</a> &gt;
				<span rel="v:child" typeof="v:Breadcrumb">
					<a href="<?php echo get_home_url(); ?>/calendar/" rel="v:url" property="v:title">Calendar</a> &gt;
					<span class="breadcrumb_last"><?php the_title(); ?></span>
				</span>
			</span>
		</span>
	</p>
</div>
