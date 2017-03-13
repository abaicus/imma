<?php
/**
 * Blog Section
 *
 * @since 1.0.0
 * @package imma
 *
 */

if ( ! function_exists( 'imma_blog_section' ) ) {
	function imma_blog_section() { ?>

		<section id="blog" class="blog">
			<div class="container">

				<div class="row">
					<div class=" col-md-12">
						<h2 class="text-center">Latest News</h2>
						<p class="text-center lead section-subtitle">Our latest projects and endeavours</p>
					</div>
				</div>

				<div class="row blog-post">
					<div class="col-md-7 col-sm-12 col-xs-12 blog-post-image">
						<img src="<?php echo get_template_directory_uri() . '/img/portfolio1.jpg'; ?>" alt="">
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12 blog-post-content">
						<h2 class="post-title">Using cameras at their full capacity</h2>

						<p class="text-content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci consequuntur
							dolorem esse eum exercitationem, facere labore nostrum officia optio perspiciatis, placeat
							quisquam, quod ratione repellendus sunt suscipit tenetur voluptatem.
						</p>

						<a href="#" class="btn btn-yellow ">Read more</a>
					</div>
				</div>

				<div class="row blog-post">

					<div class="col-md-5 col-sm-12 col-xs-12 blog-post-content">
						<h2 class="post-title">The Sunflowers do have something to say</h2>

						<p class="text-content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci consequuntur
							dolorem esse eum exercitationem, facere labore nostrum officia optio perspiciatis, placeat
							quisquam, quod ratione repellendus sunt suscipit tenetur voluptatem.
						</p>

						<a href="#" class="btn btn-yellow ">Read more</a>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 blog-post-image">
						<img src="<?php echo get_template_directory_uri() . '/img/portfolio2.jpg'; ?>" alt="">
					</div>

				</div>

				<div class="row blog-post">
					<div class="col-md-7 col-sm-12 col-xs-12 blog-post-image">
						<img src="<?php echo get_template_directory_uri() . '/img/portfolio6.jpg'; ?>" alt="">
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12 blog-post-content">
						<h2 class="post-title">Brunettes, shirts and forests are great</h2>

						<p class="text-content">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus adipisci consequuntur
							dolorem esse eum exercitationem, facere labore nostrum officia optio perspiciatis, placeat
							quisquam, quod ratione repellendus sunt suscipit tenetur voluptatem.
						</p>

						<a href="#" class="btn btn-yellow">Read more</a>
					</div>
				</div>

			</div>
		</section>

	<?php }
}
add_action( 'imma_sections', 'imma_blog_section' );