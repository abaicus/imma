<?php
/**
 * Ribbon Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_ribbon_section' ) ) {
	function imma_ribbon_section() { ?>

		<section id="ribbon" class="ribbon">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-sm-12">
						<h2>Hello World. This is a ribbon.</h2>
					</div>
					<div class="col-sm-12 col-lg-3 col-lg-offset-1">
						<a href="" class="btn btn-yellow btn-lg btn-outline">Subscribe</a>
					</div>
				</div>
			</div>
		</section>

	<?php }
}
add_action( 'imma_sections', 'imma_ribbon_section' );