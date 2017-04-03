<?php

global $post;

$banner = dmh_get_banner_image( get_the_ID() );

if ( empty( $banner ) ) {

	?><div class="hero no-image"></div><?php

} else {

	?><div class="hero" style="background-image: url(<?php echo esc_url( $banner ); ?>);"></div><?php

}