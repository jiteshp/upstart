<article id="entry-<?php the_id(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>"
			   title="Read &mdash; <?php echo esc_attr( get_the_title() ); ?>"
			   rel="bookmark"><?php the_title(); ?></a>
		</h1>
	</header>
	
	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>
</article>