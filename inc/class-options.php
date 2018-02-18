<?php
/**
 * Plugin options
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Class Options
 */
class Options {
	use Singleton;

	/**
	 * Option name
	 *
	 * @var string
	 */
	private $name = 'camo_image_proxy_opts';

	/**
	 * Allowed options
	 *
	 * @var array
	 */
	private $allowed_options = [
		'host' => '',
		'key'  => '',
	];

	/**
	 * Access certain private properties
	 *
	 * @param string $name Property name.
	 * @return mixed
	 */
	public function __get( string $name ) {
		switch ( $name ) {
			case 'name':
				return $this->name;

			default:
				return new \WP_Error( 'invalid-property', __( 'Invalid property requested.', 'camo-image-proxy' ), $name );
		}
	}

	/**
	 * Retrieve full plugin options
	 *
	 * @return array
	 */
	private function get_all() : array {
		$options = get_option( $this->name, [] );
		$options = wp_parse_args( $options, $this->allowed_options );
		return $options;
	}

	/**
	 * Get plugin option
	 *
	 * @param string $option Plugin option to retrieve.
	 * @return mixed
	 */
	public function get( string $option ) {
		if ( ! array_key_exists( $option, $this->allowed_options ) ) {
			return false;
		}

		$options = $this->get_all();
		return $options[ $option ] ?? false;
	}

	/**
	 * Set plugin option
	 *
	 * @param string $option Plugin option to set.
	 * @param mixed  $value Option value.
	 * @return bool
	 */
	public function set( string $option, $value ) : bool {
		$value              = $this->sanitize( $option, $value );
		$options            = $this->get_all();
		$options[ $option ] = $value;

		return update_option( $this->name, $options );
	}

	/**
	 * Sanitize option
	 *
	 * @param string $option Plugin option.
	 * @param mixed  $value Option value to sanitize.
	 * @return mixed
	 */
	public function sanitize( string $option, $value ) {
		switch ( $option ) {
			case 'host':
				$value = esc_url( $value );
				break;

			case 'key':
				$value = sanitize_text_field( $value );
				break;

			default:
				return false;
		}

		return $value;
	}

	/**
	 * Sanitize array of options
	 *
	 * @param array $options Options to sanitize.
	 * @return array
	 */
	public function sanitize_all( array $options ) : array {
		foreach ( $options as $option => $value ) {
			$options[ $option ] = $this->sanitize( $option, $value );
		}

		return $options;
	}
}
