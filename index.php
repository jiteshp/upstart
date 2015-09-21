<?php
if( have_posts() ) {
	while( have_posts() ) {
		the_post();
		
		if( is_single() ) {
			get_template_part( 'partials/entry', 'single' );
		}
		elseif( is_page() ) {
			get_template_part( 'partials/entry', 'page' );
		}
		elseif( is_search() ) {
			get_template_part( 'partials/entry', 'search' );
		}
		else {
			get_template_part( 'partials/entry' );
		}
	}
		
	the_posts_pagination( array(
		'next_text' => '<i class="fa fa-chevron-right"></i>',
		'prev_text' => '<i class="fa fa-chevron-left"></i>',
	) );
}
else {
	get_template_part( 'partials/entry', 'none' );
}