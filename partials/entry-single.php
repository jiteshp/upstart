<article id="entry-<?php the_id(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<div class="entry-meta">
			<span class="entry-author">
				by <?php the_author_link(); ?>
			</span>
			
			<span class="entry-time">
				on <?php the_time( 'F j, Y' ); ?>
			</span>
			
			<span class="entry-category">
				in <?php the_category( ', ' ); ?>
			</span>
		</div>
	</header>
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</article>

<?php
if( comments_open() || get_comments_number() ) {
	comments_template();
}