<?php
/**
 * Clients Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_clients_section' ) ) {
	function imma_clients_section() { ?>

		<section class="clients">

			<div class="container">
				<div class="row">
					<div class=" col-md-12">
						<h2 class="text-center">Our Clients</h2>
						<p class="text-center lead section-subtitle">Who we've been working with lately</p>
					</div>
				</div>
				<div class="row text-center clients-row">
					<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
						<a href="#"><img src="<?php echo get_template_directory_uri() . '/img/clients_1.png';?>" alt=""></a>
					</div>
					<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
						<a href="#"><img src="<?php echo get_template_directory_uri() . '/img/clients_2.png';?>" alt=""></a>
					</div>
					<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
						<a href="#"><img src="<?php echo get_template_directory_uri() . '/img/clients_3.png';?>" alt=""></a>
					</div>
					<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
						<a href="#"><img src="<?php echo get_template_directory_uri() . '/img/clients_4.png';?>" alt=""></a>
					</div>
					<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
						<a href="#"><img src="<?php echo get_template_directory_uri() . '/img/clients_5.png';?>" alt=""></a>
					</div>
					<div class="sponsor-item col-xs-12 col-sm-6 col-md-2">
						<a href="#"><img src="<?php echo get_template_directory_uri() . '/img/clients_6.png';?>" alt=""></a>
					</div>
				</div>
			</div>

		</section>

	<?php }
}
add_action( 'imma_sections', 'imma_clients_section' );