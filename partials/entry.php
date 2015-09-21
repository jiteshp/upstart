<article id="entry-<?php the_id(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>"
			   title="Read &mdash; <?php echo esc_attr( get_the_title() ); ?>"
			   rel="bookmark"><?php the_title(); ?></a>
		</h1>
		
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
		<?php
		if( has_post_thumbnail() ): ?>
		<p class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>"
			   title="Read &mdash; <?php echo esc_attr( get_the_title() ); ?>"
			   rel="bookmark"><?php the_post_thumbnail( 'post-thumbnail' ); ?></a>
		</p> <?php
		endif;
		
		the_excerpt(); ?>
	</div>
</article>