<article id="entry-<?php the_id(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>

<?php
if( comments_open() || get_comments_number() ) {
	comments_template();
}