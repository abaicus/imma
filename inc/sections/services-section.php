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
		} ?>
		<section id="features" class="features">
			<div class="container">
				<?php imma_display_section_head( 'imma_services_title', 'imma_services_subtitle' ); ?>
				<div class="row section-content">
					<?php imma_get_services_content(); ?>
				</div>
			</div>
		</section>
		<?php
	}
endif;



/**
 * Display main content of services section
 */
function imma_get_services_content(){
	$default = imma_get_services_content_default();
	$imma_services_content  = get_theme_mod( 'imma_services_content', $default);
	if( !empty($imma_services_content) ){
		$imma_services_content = json_decode($imma_services_content, true);
		$count = 0;
		foreach ( $imma_services_content as $services_box){
			$count ++;
			$icon = isset($services_box['icon_value']) ?  $services_box['icon_value'] : '';
			$title = isset($services_box['title']) ? $services_box['title'] : '';
			$text = isset($services_box['subtitle']) ? $services_box['subtitle'] : '';
			$button_text = isset($services_box['text']) ? $services_box['text'] : '';
			$button_link = isset($services_box['link']) ? $services_box['link'] : ''; ?>
			<div class="col-md-4 col-centered">
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
						<a href="<?php echo esc_url($button_link); ?>" class="btn btn-yellow <?php if( $count % 2 !== 0) { echo 'btn-outline'; } ?>"><?php echo wp_kses_post($button_text); ?></a>
						<?php
					}?>
				</div>
			</div>
			<?php
		}
	}
}