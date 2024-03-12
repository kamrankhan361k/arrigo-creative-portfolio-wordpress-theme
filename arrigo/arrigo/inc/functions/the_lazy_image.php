<?php

/**
 * Markup for lazy images & backgrounds
 */
if ( ! function_exists( 'arr_the_lazy_image' ) ) {
	function arr_the_lazy_image( $args ) {
		$defaults = array(
			'id'    => null,
			'type'  => 'image',
			'size'  => 'full',
			'class' => array(
				'wrapper' => array(),
				'image'   => array(),
			),
		);

		$attrs_wrapper = '';
		$class_wrapper = '';
		$class_media   = '';

		$placeholder_src = apply_filters( 'arts/lazy/placeholder', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAHCGzyUAAAABGdBTUEAALGPC/xhBQAAADhlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAAqACAAQAAAABAAAAAaADAAQAAAABAAAAAQAAAADa6r/EAAAAC0lEQVQI12NolQQAASYAn89qhTcAAAAASUVORK5CYII=' );

		$args = wp_parse_args( $args, $defaults );

		if ( ! $args['id'] || ! $args['type'] ) {
			return;
		}

		// image
		if ( array_key_exists( 'wrapper', $args['class'] ) && is_array( $args['class']['wrapper'] ) && ! empty( $args['class']['wrapper'] ) ) {
			$class_wrapper = implode( ' ', $args['class']['wrapper'] );
		}

		// image
		if ( array_key_exists( 'image', $args['class'] ) && is_array( $args['class']['image'] ) && ! empty( $args['class']['image'] ) ) {
			$class_media = implode( ' ', $args['class']['image'] );
		}

		switch ( $args['type'] ) {
			case 'background':
				$class_wrapper .= ' lazy-bg';
				break;
			case 'image':
				if ( $args['class']['wrapper'] !== false ) {
					$class_wrapper .= ' lazy';
				}
				break;
		}

		if ( $args['class']['image'] !== false ) {
			$class_media .= ' of-cover';
		}

		$attrs                  = wp_get_attachment_image_src( $args['id'], $args['size'] );
		$srcset                 = '';
		$sizes                  = '';
		$enable_optimized_sizes = apply_filters( 'arts/lazy/enable_optimized_sizes', true );
		$alt                    = get_post_meta( $args['id'], '_wp_attachment_image_alt', true );

		if ( $enable_optimized_sizes ) {
			$srcset = wp_get_attachment_image_srcset( $args['id'], $args['size'] );
			$sizes  = wp_get_attachment_image_sizes( $args['id'], $args['size'] );
		}

		?>
			<?php if ( ! empty( $class_wrapper ) || ! empty( $attrs_wrapper ) ) : ?>
				<?php if ( $args['type'] === 'image' ) : ?>
					<div class="<?php echo esc_attr( $class_wrapper ); ?>" <?php echo esc_attr( $attrs_wrapper ); ?> style="padding-bottom: calc( (<?php echo esc_attr( $attrs[2] ); ?> / <?php echo esc_attr( $attrs[1] ); ?>) * 100% ); height: 0;">
				<?php else : ?>
					<div class="<?php echo esc_attr( $class_wrapper ); ?>" <?php echo esc_attr( $attrs_wrapper ); ?>>
				<?php endif; ?>
			<?php endif; ?>
				<?php
				switch ( $args['type'] ) {
					case 'background':
						?>
							<img class="<?php echo esc_attr( $class_media ); ?>" src="<?php echo esc_attr( $placeholder_src ); ?>" data-src="<?php echo esc_attr( $attrs[0] ); ?>" data-srcset="<?php echo esc_attr( $srcset ); ?>" data-sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo esc_attr( $alt ); ?>" />
							<?php
						break;
					case 'image':
						?>
							<img class="<?php echo esc_attr( $class_media ); ?>" src="<?php echo esc_attr( $placeholder_src ); ?>" data-src="<?php echo esc_attr( $attrs[0] ); ?>" width="<?php echo esc_attr( $attrs[1] ); ?>" height="<?php echo esc_attr( $attrs[2] ); ?>" data-srcset="<?php echo esc_attr( $srcset ); ?>" data-sizes="<?php echo esc_attr( $sizes ); ?>" alt="<?php echo esc_attr( $alt ); ?>"/>
							<?php
						break;
				}
				?>
			<?php if ( ! empty( $class_wrapper ) ) : ?>
				</div>
			<?php endif; ?>
		<?php
	}
}
