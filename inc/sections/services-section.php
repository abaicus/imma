<?php
/**
 * Services section for the homepage.
 *
 * @package Imma
 * @since Imma 1.0
 */
if ( ! function_exists( 'imma_services' ) ) :
	/**
	 * Features section content.
	 *
	 * @since Imma 1.0
	 */
	function imma_services() {
		$imma_services_hide = get_theme_mod('imma_services_hide');
		if( (bool) $imma_services_hide === true ){
			return;
		}

		$default = current_user_can( 'edit_posts' ) ? sprintf(
			__( 'Edit this section title in %1$s', 'imma' ),
			sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
				admin_url( 'customize.php?autofocus[control]=imma_services_title' ),
				__( 'customizer', 'imma' ) )
		) : false;
		$imma_services_title    = get_theme_mod( 'imma_services_title', $default );

		$default = current_user_can( 'edit_posts' ) ? sprintf(
			__( 'Edit this section subtitle in %1$s', 'imma' ),
			sprintf( '<a class="link-to-customizer" href="%1$s">%2$s</a>',
				admin_url( 'customize.php?autofocus[control]=imma_services_subtitle' ),
				__( 'customizer', 'imma' ) )
		) : false;
		$imma_services_subtitle = get_theme_mod( 'imma_services_subtitle', $default );
		?>
		<section id="features" class="features">
			<div class="container">
				<div class="row">
					<div class=" col-md-12">
						<?php
						if( !empty($imma_services_title) ){ ?>
							<h2 class="text-center section-title"><?php echo wp_kses_post($imma_services_title); ?></h2>
							<?php
						}
						if( !empty($imma_services_subtitle) ){ ?>
							<p class="text-center lead section-subtitle"><?php echo wp_kses_post($imma_services_subtitle); ?></p>
							<?php
						}?>
					</div>
				</div>
				<div class="row section-content">
					<?php imma_get_services_content(); ?>
				</div>
			</div>
		</section>
		<?php
	}
endif;

if ( function_exists( 'imma_services' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 10, 'imma_services' );
	add_action( 'imma_sections', 'imma_services', absint( $section_priority ) );
}

/**
 * Display main content of services section
 */
function imma_get_services_content(){
	$default = imma_get_services_content_default();
	$imma_services_content  = get_theme_mod( 'imma_services_content', $default);
	if( !empty($imma_services_content) ){
		$imma_services_content = json_decode($imma_services_content, true);
		foreach ( $imma_services_content as $services_box){
			$icon = isset($services_box['icon_value']) ?  $services_box['icon_value'] : '';
			$title = isset($services_box['title']) ? $services_box['title'] : '';
			$text = isset($services_box['subtitle']) ? $services_box['subtitle'] : '';
			$button_text = isset($services_box['text']) ? $services_box['text'] : '';
			$button_link = isset($services_box['link']) ? $services_box['link'] : ''; ?>
			<div class="col-md-4">
				<div class="card card-block text-center">
					<?php
					if( !empty($icon) ) { ?>
						<i class="fa fa-2x <?php echo esc_attr($icon); ?>"></i>
						<?php
					}
					if( !empty($title) ){ ?>
						<h4 class="card-title"><?php echo wp_kses_post($title); ?></h4>
						<?php
					}
					if( !empty($text) ){ ?>
						<p class="card-text"><?php echo wp_kses_post($text); ?></p>
						<?php
					}
					if( !empty($button_text) && !empty($button_link) ){ ?>
						<a href="<?php echo esc_url($button_link); ?>" class="btn btn-yellow btn-outline"><?php echo wp_kses_post($button_text); ?></a>
						<?php
					}?>
				</div>
			</div>
			<?php
		}
	}
}