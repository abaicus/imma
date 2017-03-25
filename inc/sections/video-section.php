<?php
/**
 * About Section
 *
 * @since 1.0.0
 * @package Imma
 *
 */

if ( ! function_exists( 'imma_video' ) ) {
	/**
	 * About section content.
	 *
	 * @since Imma 1.0
	 */
	function imma_video() {

		$imma_video_hide = get_theme_mod( 'imma_video_hide', true );

		if ( ( bool ) $imma_video_hide === true ) {
			return;
		}

		$imma_video_text = get_theme_mod( 'imma_video_text' );

		$imma_video_link      = get_theme_mod( 'imma_video_link' );
		$video_thumbnail = preg_match( '/\/\/(www\.)?(youtu|youtube)\.(com|be)\/(watch|embed)?\/?(\?v=)?([a-zA-Z0-9\-\_]+)/', $imma_video_link, $youtube_matches );
		$youtube_id      = ! empty( $youtube_matches ) ? $youtube_matches[6] : '';
		$yt_thumbnail    = 'https://img.youtube.com/vi/' . $youtube_id . '/maxresdefault.jpg';

		?>
		<section id="video" class="video">
			<div class="video-thumbnail"
			' <?php if ( ! empty( $yt_thumbnail ) ) {
				echo 'style="background-image: url(' . $yt_thumbnail . ')';
			} ?>"></div>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<?php if ( ! empty( $imma_video_text ) ) { ?>
							<div
								class="video-section-content"><?php echo wp_kses_post( $imma_video_text ); ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="video-wrap">
				<?php imma_get_video_content(); ?>
			</div>
		</section>
		<?php
	}
}

if ( function_exists( 'imma_video' ) ) {
	$section_priority = apply_filters( 'imma_section_priority', 70, 'imma_video' );
	add_action( 'imma_sections', 'imma_video', absint( $section_priority ) );
}

function imma_get_video_content() {
	$imma_video_link = get_theme_mod( 'imma_video_link' );

	if ( ! empty( $imma_video_link ) ) {
		$imma_video_mute_toggle = get_theme_mod( 'imma_video_mute_toggle', true );
		if ( ( bool ) $imma_video_mute_toggle === true ) {
			$imma_video_mute_status = 'true';
		} else {
			$imma_video_mute_status = 'false';
		}

		$imma_video_focus_toggle = get_theme_mod( 'imma_video_focus_toggle', true );
		if ( ( bool ) $imma_video_focus_toggle === true ) {
			$imma_video_focus_status = 'true';
		} else {
			$imma_video_focus_status = 'false';
		}
		?>

		<!-- Youtube player start-->
		<div class="video-player"
		     data-property="{
			     videoURL:'<?php echo esc_url( $imma_video_link ); ?>',
			     containment:'.video#video',
			     startAt:0,
			     mute:<?php echo esc_attr( $imma_video_mute_status ); ?>,
			     autoPlay:true,
			     loop:true,
			     opacity:1,
			     showControls:false,
			     showYTLogo:false,
			     vol:100,
			     stopMovieOnBlur:<?php echo esc_attr( $imma_video_focus_status ); ?>
		     }"></div>
		<!-- Youtube player end -->
	<?php }
}