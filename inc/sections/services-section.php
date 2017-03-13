<?php
/**
 * Services Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_services_section' ) ) {
	function imma_services_section() { ?>


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

	<?php }
}
add_action( 'imma_sections', 'imma_services_section' );