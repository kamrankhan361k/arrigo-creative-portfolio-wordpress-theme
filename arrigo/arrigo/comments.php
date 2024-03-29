<?php

if ( post_password_required() ) {
	return;
}

require_once ARR_THEME_PATH . '/inc/classes/class-arr-walker-comment.php';
?>


<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				$output = sprintf( '%1$s %2$s', $comments_number, __( 'Comment', 'arrigo' ) );
				echo esc_html( $output );
			} else {
				$output = sprintf( '%1$s %2$s', $comments_number, __( 'Comments', 'arrigo' ) );
				echo esc_html( $output );
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments(
					array(
						'avatar_size' => 80,
						'style'       => 'ol',
						'short_ping'  => true,
						'walker'      => new Arr_Walker_Comment(),
					)
				);
			?>
		</ol>

		<?php
		the_comments_pagination();

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'arrigo' ); ?></p>
		<?php
	endif;

	comment_form();
	?>
</div><!-- #comments -->
