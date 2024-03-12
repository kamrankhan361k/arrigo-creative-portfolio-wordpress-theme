<?php

$post_date_style            = get_theme_mod( 'post_date_style', 'square_box' );
$post_show_date             = get_theme_mod( 'post_show_date', true );
$post_show_categories       = get_theme_mod( 'post_show_categories', true );
$post_show_comments_counter = get_theme_mod( 'post_show_comments_counter', true );
$post_show_author           = get_theme_mod( 'post_show_author', true );
$date_link                  = get_month_link( get_post_time( 'Y' ), get_post_time( 'm' ) );
$author                     = arr_get_post_author();

?>

<ul class="post-meta">
	<?php if ( $post_show_date && $post_date_style == 'info' || is_single() ) : ?>
		<li><a href="<?php echo esc_attr( $date_link ); ?>"><?php echo esc_html( get_the_date() ); ?></a></li>
	<?php endif; ?>

	<?php if ( $post_show_categories ) : ?>
		<?php if ( has_category() ) : ?>
			<li><?php the_category( ',&nbsp;' ); ?></li>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( $post_show_comments_counter ) : ?>
		<li><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php comments_number(); ?></a></li>
	<?php endif; ?>

	<?php if ( ! empty( $author['name'] ) && $post_show_author ) : ?>
		<li>
		<?php esc_html_e( 'by', 'arrigo' ); ?>&nbsp;<a href="<?php echo esc_url( $author['url'] ); ?>"><?php echo esc_html( $author['name'] ); ?></a>
		</li>
	<?php endif; ?>
</ul>
