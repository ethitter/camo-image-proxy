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
	 * Hooks
	 */
	public function setup() {
		add_action( 'admin_init', [ $this, 'action_admin_init' ] );
	}

	/**
	 * Add fields to Media settings page
	 */
	public function action_admin_init() {
		//register_setting();

		//add_settings_section();
		//add_settings_field();
	}
}
