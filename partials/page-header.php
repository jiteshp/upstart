<?php
if( is_home() && ! is_front_page() ): ?>
<header id="page-header">
	<div class="container">
		<p id="page-title"><?php single_post_title(); ?></p>
	</div>
</header> <?php
elseif( is_home() && is_front_page() ): ?>
<header id="page-header">
	<div class="container">
		<p id="page-title">Recent blog posts</p>
	</div>
</header> <?php
elseif( is_archive() ): ?>
<header id="page-header">
	<div class="container">
		<?php the_archive_title( '<p id="page-title">', '</p>' ); ?>
	</div>
</header> <?php
elseif( is_search() ): ?>
<header id="page-header">
	<div class="container">
		<p id="page-title">Search results for: <?php _e( get_search_query() ); ?></p>
	</div>
</header> <?php
elseif( is_404() ): ?>
<header id="page-header">
	<div class="container">
		<p id="page-title">Oops! Nothing found.</p>
	</div>
</header> <?php
endif;