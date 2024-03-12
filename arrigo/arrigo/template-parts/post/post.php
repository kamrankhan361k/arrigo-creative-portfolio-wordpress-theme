<?php

$date_full  = get_the_date( DATE_W3C );
$date_day   = get_the_date( 'd' );
$date_month = get_the_date( 'M' );
$date_link  = get_month_link( get_post_time( 'Y' ), get_post_time( 'm' ) );

$post_date_style    = get_theme_mod( 'post_date_style', 'square_box' );
$post_show_info     = get_theme_mod( 'post_show_info', true );
$post_show_date     = get_theme_mod( 'post_show_date', true );
$post_show_readmore = get_theme_mod( 'post_show_read_more', true );

?>

<article <?php post_class( 'post post_flex' ); ?> id="post-<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post__media">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
		<!-- - post__media-->
	<?php endif; ?>

	<?php if ( $post_show_date && $post_show_info && $post_date_style == 'square_box' ) : ?>
		<time class="post__date" datetime="<?php echo esc_attr( $date_full ); ?>">
			<span class="post__date-day"><?php echo esc_attr( $date_day ); ?></span>
			<span class="post__date-month"><?php echo esc_attr( $date_month ); ?></span>
		</time>
		<!-- - post__date-->
	<?php endif; ?>

	<div class="post__inner">
		<header class="post__header">
			<?php if ( $post_show_info ) : ?>
				<div class="post__meta">
					<?php get_template_part( 'template-parts/post/partials/post_info' ); ?>
				</div>
				<!-- - post__meta-->
			<?php endif; ?>
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		</header>
		<!-- - post__header-->
		<div class="post__content">
			<?php get_template_part( 'template-parts/content/content', get_post_format() ); ?>
		</div>
		<!-- - post__content-->
		<?php if ( $post_show_readmore ) : ?>
			<?php get_template_part( 'template-parts/post/partials/post_read_more' ); ?>
		<?php endif; ?>
	</div>
</article>
