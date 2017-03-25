<?php
/**
 * Page editor control
 *
 * @package WordPress
 * @subpackage Hestia
 * @since Hestia 1.1.3
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}
/**
 * Class to create a custom tags control
 */
class Imma_Page_Editor extends WP_Customize_Control {


	/**
	 * Flag to include sync scripts if needed
	 *
	 * @var bool|mixed
	 */
	private $needsync = false;

	/**
	 * Flag to load teeny.
	 *
	 * @var bool|mixed
	 */
	private $teeny = false;

	/**
	 * Label after ajax reload/
	 *
	 * @var string
	 */
	public $label = '';

	/**
	 * Imma_Page_Editor constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param string               $id Id.
	 * @param array                $args Constructor args.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['needsync'] ) ) {
			$this->needsync = $args['needsync'];
		}
		if ( ! empty( $args['teeny'] ) ) {
			$this->teeny = $args['teeny'];
		}
		if( !empty( $args['label'] ) ){
			$this->label = $args['label'];
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue() {
		wp_enqueue_script( 'imma_text_editor', get_template_directory_uri() . '/inc/customizer-modules/customizer-page-editor/js/imma-text-editor.js', array( 'jquery' ), false, true );
		if ( $this->needsync === true ) {
			wp_enqueue_script( 'imma_controls_script', get_template_directory_uri() . '/inc/customizer-modules/customizer-page-editor/js/imma-update-controls.js', array( 'jquery', 'customize-preview' ), '', true );
			wp_localize_script( 'imma_controls_script', 'requestpost', array(
				'ajaxurl'           => admin_url( 'admin-ajax.php' ),
				'thumbnail_control' => 'imma_feature_thumbnail',
				'editor_control'    => 'imma_page_editor',
				'thumbnail_label'   => $this->label,
			) );
		}
	}


	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		static $i = 1;?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>">
		<?php
		$settings = array(
			'textarea_name' => $this->id,
			'teeny' => $this->teeny,
		);
		$control_content = $this->value();
		$frontpage_id = get_option( 'page_on_front' );
		$page_content = '';
		if ( ! empty( $frontpage_id ) && $this->needsync === true ) {
			$content_post = get_post( $frontpage_id );
			$page_content = $content_post->post_content;
			$page_content = apply_filters( 'imma_text', $page_content );
			$page_content = str_replace( ']]>', ']]&gt;', $page_content );

			if ( $control_content !== $page_content ) {
				$control_content = $page_content;
			}
		}

		wp_editor( $control_content, $this->id, $settings );

		if( $i == 2){
			do_action( 'admin_print_footer_scripts' );
		}
		$i++;

	}
}
