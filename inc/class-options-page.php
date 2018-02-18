<?php
/**
 * Plugin options page
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Class Options_Page
 */
class Options_Page {
	use Singleton;

	/**
	 * Settings screen section
	 *
	 * @var string
	 */
	private $section = 'camp-image-proxy';

	/**
	 * Field labels
	 *
	 * @var array
	 */
	private $labels = [];

	/**
	 * Option name
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Hooks
	 */
	public function setup() {
		$this->name = Options::instance()->name;

		$this->labels['host'] = __( 'Host', 'camo-image-proxy' );
		$this->labels['key']  = __( 'Shared Key', 'camo-image-proxy' );

		add_action( 'admin_init', [ $this, 'action_admin_init' ] );
	}

	/**
	 * Add fields to Media settings page
	 */
	public function action_admin_init() {
		register_setting( 'media', $this->name, [ Options::instance(), 'sanitize_all' ] );
		add_settings_section( $this->section, __( 'Camo Image Proxy', 'camo-image-proxy' ), '__return_false', 'media' );

		foreach ( $this->labels as $key => $label ) {
			$args = [
				'option' => $key,
				'label'  => $label,
			];
			add_settings_field( $key, $label, [ $this, 'screen' ], 'media', $this->section, $args );
		}
	}

	/**
	 * Render options field
	 *
	 * @param array $args Field arguments.
	 */
	public function screen( $args ) {
		$value      = Options::instance()->get( $args['option'] );
		$input_type = 'host' === $args['option'] ? 'url' : 'text';
		$name       = sprintf( '%1$s[%2$s]', $this->name, $args['option'] );
		$html_id    = sprintf( '%1$s-%2$s', str_replace( '_', '-', $this->name ), $args['option'] );

		?>
		<input
			type="<?php echo esc_attr( $input_type ); ?>"
			name="<?php echo esc_html( $name ); ?>"
			class="regular-text"
			id="<?php echo esc_attr( $html_id ); ?>"
			value="<?php echo esc_attr( $value ); ?>"
		/>
		<?php
	}
}
