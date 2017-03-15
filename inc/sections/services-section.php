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
		$imma_services_title    = get_theme_mod( 'imma_services_title', esc_html__( 'Why our product is the best', 'imma' ) );
		$imma_services_subtitle = get_theme_mod( 'imma_services_subtitle', esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'imma' ) );
		$imma_services_content  = get_theme_mod( 'imma_services_content', json_encode( array(
			array(
				'icon_value' => 'fa-wechat',
				'title'      => esc_html__( 'Responsive', 'imma' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'imma' ),
				'link'       => '#',
				'id'         => 'customizer_repeater_56d7ea7f40b56',
				'color'      => '#e91e63',
			),
			array(
				'icon_value' => 'fa-check',
				'title'      => esc_html__( 'Quality', 'imma' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'imma' ),
				'link'       => '#',
				'id'         => 'customizer_repeater_56d7ea7f40b66',
				'color'      => '#00bcd4',
			),
			array(
				'icon_value' => 'fa-support',
				'title'      => esc_html__( 'Support', 'imma' ),
				'text'       => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'imma' ),
				'link'       => '#',
				'id'         => 'customizer_repeater_56d7ea7f40b86',
				'color'      => '#4caf50',
			),
		) ) );
		?>
		<section id="features" class="features">
			<div class="container">
				<div class="row">
					<div class=" col-md-12">
						<h2 class="text-center">Our services</h2>
						<p class="text-center lead section-subtitle">Learn more about what we stand for and what we
							offer as a service for your business.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="card card-block text-center">
							<i class="fa fa-2x fa-dollar"></i>
							<h4 class="card-title">Small Prices</h4>
							<p class="card-text">Our prices are the smallest! You've got to check them out! Lorem ipsum
								dolor sit amet, consectetur adipisicing elit. </p>
							<a href="#" class="btn btn-yellow btn-outline">Check it out!</a>
						</div>
					</div>
					<div class="col-md-4">

						<div class="card card-block text-center">
							<i class="fa fa-2x fa-star "></i>
							<h4 class="card-title">Guaranteed Satisfaction</h4>
							<p class="card-text">We give our customers satisfaction! Lorem ipsum dolor sit amet,
								consectetur adipisicing elit. </p>
							<a href="#" class="btn btn-yellow ">Check it out!</a>
						</div>
					</div>
					<div class="col-md-4">

						<div class="card card-block text-center">
							<i class="fa fa-2x fa-gift "></i>
							<h4 class="card-title">Great Products</h4>
							<p class="card-text">Our products are the best products around! Lorem ipsum dolor sit amet,
								consectetur adipisicing elit. </p>
							<a href="#" class="btn btn-yellow btn-outline">Check it out!</a>
						</div>
					</div>
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