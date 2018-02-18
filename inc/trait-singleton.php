<?php
/**
 * Trait file for Singletons.
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Make a class into a singleton.
 */
trait Singleton {
	/**
	 * Existing instance.
	 *
	 * @var object
	 */
	protected static $instance;

	/**
	 * Get class instance.
	 *
	 * @return object
	 */
	public static function instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static();
			static::$instance->setup();
		}
		return static::$instance;
	}

	/**
	 * Setup the singleton.
	 */
	public function setup() {
		// Silence.
	}
}
