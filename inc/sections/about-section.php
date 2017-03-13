<?php
/**
 * About Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_about_section' ) ) {
	function imma_about_section() { ?>


		<section id="product" class="product">
			<div class="container-half container-half-left"></div>
			<div class="container-half container-half-right"></div>
			<div class="container">
				<div class="row">
					<div class="col-sm-5 product-content">
						<p class="lead text-xs-left">Showcase what you have to say about your great product right in this area.</p>
						<p class="text-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni blanditiis soluta dicta explicabo sequi. Sit quaerat ipsa tempora, dolorem, incidunt consequuntur id, corporis, atque accusantium aut labore cupiditate placeat dolor.</p>
						<p class="text-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni blanditiis soluta dicta explicabo sequi. Sit quaerat ipsa tempora, dolorem, incidunt consequuntur id, corporis, atque accusantium aut labore cupiditate placeat dolor.</p>
					</div>
				</div>
			</div>

		</section>

	<?php }
}
add_action( 'imma_sections', 'imma_about_section' );