<?php
/**
 * Customize control multiple choice.
 *
 * @package WordPress
 * @subpackage Capri
 * @since Capri 1.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Customize_Control_Multiple_Select
 */
class Capri_Customize_Control_Multiple_Select extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @var string
	 */
	public $type = 'multiple-select';

	/**
	 * Enqueue necessary script
	 */
	public function enqueue() {
		wp_enqueue_script( 'customizer-repeater-script', get_template_directory_uri() . '/inc/customizer-multiple-choice/js/customizer_multiple_choice.js', array( 'jquery' ), '1.0.1', true );
	}


	/**
	 * Displays the multiple select on the customize screen.
	 */
	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select class="woo-multiple-select" <?php $this->link(); ?> multiple="multiple" style="height: 100%;">
				<?php
				foreach ( $this->choices as $value => $label ) {
					echo '<option value="' . esc_attr( $value ) . '">' . $label . '</option>';
				}
				?>
			</select>
		</label>
	<?php
	}
}

/**
 * Sanitization function for multiple select control.
 *
 * @param array $input Multiple select input.
 *
 * @return string
 */
function capri_sanitize_multiple_select( $input ) {

	if ( ! empty( $input ) ) {
	    $woo_categories = capri_get_woo_categories();
	    foreach ( $input as $selected_cat ) {
		    if ( ! array_key_exists( $selected_cat, $woo_categories ) ) {
			    return array( 'none' );
		    }
	    }
	}
	return $input;
}
