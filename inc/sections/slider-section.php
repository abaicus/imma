<?php
if ( ! function_exists( 'imma_slider_section' ) ) {
	function imma_slider_section() { ?>

		<section id="header-carousel">
			<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">

					<div class="item active" style="background: url('<?php echo  get_template_directory_uri() . '/img/ribbon.jpg' ?>') no-repeat center">
						<div class="item-content-wrap">
							<div class="cover-caption">
								<div class="container">
									<div class="col-sm-10 col-sm-offset-1">
										<h1 class="display-3">Welcome to our website!</h1>


										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio dolorum
											beatae, ullam ab
											similique quia vitae vel cum, assumenda quod totam quisquam pariatur
											mollitia quam
											laudantium quos rerum, culpa, aperiam.</p>

										<a href="#" class="btn btn-yellow btn-lg">Click here</a>

									</div>
								</div>
							</div>
						</div>


					</div>

					<div class="item" style="background: url('<?php echo  get_template_directory_uri() . '/img/cover.jpg' ?>') no-repeat center">
						<div class="item-content-wrap">

							<div class="cover-caption">
								<div class="container">
									<div class="col-sm-10 col-sm-offset-1">
										<h1 class="display-3">This is the second slide!</h1>


										<p>Testing the slider</p>

										<a href="#" class="btn btn-yellow btn-lg">Click here</a>

									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row text-center">
						<a href="#"><i class="scroll-invite animated bounce fa fa-3x  fa-angle-double-down"></i></a>
					</div>
				</div>
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
				</ol>

				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="fa fa-2x fa-angle-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="fa fa-2x fa-angle-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</section>
		<?php
	}
}

remove_action( 'imma_hero_section', 'imma_big_title_section' );
add_action( 'imma_hero_section', 'imma_slider_section' );