<?php
if ( ! function_exists( 'imma_big_title_section' ) ) {
	function imma_big_title_section() {
		$imma_big_title_hide = get_theme_mod( 'imma_big_title_hide', esc_html__( '', 'imma' ) );

		if ( (bool) $imma_big_title_hide === true ) {
			return;
		}

		$imma_big_title_title       = get_theme_mod( 'imma_big_title_title', current_user_can( 'edit_posts' ) ? sprintf(
			__( 'Edit title in %1$s', 'imma' ),
			sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
				admin_url( 'customize.php?autofocus[control]=imma_big_title_title' ),
				__( 'customizer', 'imma' ) )
		) : false );
		$imma_big_title_subtitle    = get_theme_mod( 'imma_big_title_subtitle', current_user_can( 'edit_posts' ) ? sprintf(
			__( 'Edit this subtitle in %1$s', 'imma' ),
			sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
				admin_url( 'customize.php?autofocus[control]=imma_big_title_title' ),
				__( 'customizer', 'imma' ) )
		) : false );
		$imma_big_title_button_text = get_theme_mod( 'imma_big_title_button_text', current_user_can( 'edit_posts' ) ? esc_html__( 'Edit this button in customizer', 'imma' ) : false );
		$imma_big_title_button_link = get_theme_mod( 'imma_big_title_button_link', current_user_can( 'edit_posts' ) ? esc_url( admin_url() . 'customize.php?autofocus[control]=imma_big_title_button_text' ) : false );
		$imma_big_title_background  = get_theme_mod( 'imma_big_title_background', current_user_can( 'edit_posts' ) ? esc_url( get_template_directory_uri() . '/img/cover.jpg' ) : false );
		if ( ! empty( $imma_big_title_title ) || ! empty( $imma_big_title_subtitle ) || ! empty( $imma_big_title_button_text ) || ! empty( $imma_big_title_button_link ) || ! empty( $imma_big_title_background ) ) {
			?>
			<section id="cover" style>
			<?php
			if ( is_customize_preview() ) { ?>
				<div class="big-title-css"></div>
				<?php
			}

			if ( ! empty( $imma_big_title_title ) || ! empty( $imma_big_title_subtitle ) || ! empty( $imma_big_title_button_text ) || ! empty( $imma_big_title_button_link ) ) { ?>
				<div class="cover-caption">
					<div class="container">
						<div class="col-sm-10 col-sm-offset-1">
						<?php
						if ( ! empty ( $imma_big_title_title ) ) { ?>
							<h1 class="display-3"><?php echo wp_kses_post( $imma_big_title_title ); ?></h1>
						<?php }

						if ( ! empty ( $imma_big_title_subtitle ) ) { ?>
							<p><?php echo wp_kses_post( $imma_big_title_subtitle ) ?></p>
						<?php }

						if ( ! empty ( $imma_big_title_button_text ) && ! empty( $imma_big_title_button_link ) ) { ?>
							<div class="button-wrapper">
								<a href="<?php echo esc_url( $imma_big_title_button_link ); ?>" class="btn btn-yellow btn-lg">
									<?php echo esc_html( $imma_big_title_button_text ); ?>
								</a>
							</div>
						<?php } ?>
							</div>
						</div>
					</div>
					<?php
				}
				?>

				</section>
				<?php
			}
		}
	}

	add_action( 'imma_hero_section', 'imma_big_title_section' );
	?>