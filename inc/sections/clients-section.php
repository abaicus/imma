<?php
/**
 * Clients Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_clients' ) ) {
	/**
	 * Clients section
	 */
	function imma_clients() {
		$imma_clients_hide = get_theme_mod('imma_clients_hide');
		if( (bool) $imma_clients_hide === true ){
			return;
		} ?>
		<section class="clients">
			<div class="container">
				<?php
				imma_display_section_head( 'imma_clients_title', 'imma_clients_subtitle' ); ?>
				<div class="row text-center clients-row section-content">
					<?php imma_get_clients_content(); ?>
				</div>
			</div>

		</section>

	<?php }
}

if ( function_exists( 'imma_clients' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 70, 'imma_clients' );
	add_action( 'imma_sections', 'imma_clients', absint( $section_priority ) );
}

/**
 * Get clients content
 */
function imma_get_clients_content(){
	$default = imma_get_clients_content_default();
	$imma_clients_content  = get_theme_mod( 'imma_clients_content', $default);
	if( !empty($imma_clients_content) ){
		$imma_clients_content = json_decode($imma_clients_content, true);
		foreach ( $imma_clients_content as $client ){
			$image = isset($client['image_url']) ? $client['image_url'] : '';
			$link = isset($client['link']) ? $client['link'] : '';
			if( !empty($image)){ ?>
				<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
					<a href="<?php esc_url($link); ?>">
						<img src="<?php echo esc_url( $image );?>" alt=""></a>
				</div>
				<?php
			}?>

			<?php
		}
	}
}