<!-- no-results -->
<div id="no-results">
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {
		printf( '<p>Ready to publish your first post? <a href="%1$s">Get started here</a>.</p>',
			esc_url( admin_url( 'post-new.php' ) ) );
	}
	elseif( is_search() ) {
		printf( '<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>' );
		get_search_form();
	}
	else {
		printf( '<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>' );
		get_search_form();
	} ?>
</div> <!-- /no-results -->