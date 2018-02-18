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
	 * Hooks and other preparations
	 */
	public function setup() {
		// Hooks and such.
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

		$options = get_option( $this->name, [] );
		$options = wp_parse_args( $options, $this->allowed_options );

		return $options[ $option ] ?? false;
	}

	/**
	 * Set plugin option
	 *
	 * @param string $option Plugin option to set.
	 * @param mixed  $value Option value.
	 * @return bool
	 */
	public function update( string $option, $value ) : bool {
		return false;
	}
}
