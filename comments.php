<?php
/**
 *	Comments template
 *	----------------------------------------------------------------------------
 */
if( post_password_required() ) {
	return;
} ?>

<div id="comments" class="entry-comments">
	<?php 
	if( have_comments() ): ?>
	<p id="comments-title">
		<i class="fa fa-comment-o"></i>
		<?php comments_number( 'No comments yet', '1 comment', '% comments' ); ?> &bull;
		<a href="#respond">add yours</a>
	</p>
	
	<ol id="comments-list">
		<?php
		wp_list_comments( array(
			'avatar_size'	=> 50,
			'max_depth'		=> 2,
			'type'			=> 'comment',
		) ); ?>
	</ol> <?php
	endif;
	
	/**
	 *	Display comments closed note
	 *	------------------------------------------------------------------------
	 */
	if( ! comments_open() ): ?>
	<p class="comments-closed">Comments are closed.</p> <?php
	endif;
	
	/**
	 *	Display comment form
	 *	------------------------------------------------------------------------
	 */
	comment_form( array(
		'comment_notes_after'	=> null,
		'comment_notes_before'	=> null,
	) ); ?>
</div>