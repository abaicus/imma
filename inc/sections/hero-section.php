<?php
/**
 * Hero Area Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_hero_section' ) ) {
	function imma_hero_section() {

		do_action('imma_hero_section')?>

	<?php }
}
add_action( 'imma_sections', 'imma_hero_section' );