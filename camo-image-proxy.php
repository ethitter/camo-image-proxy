<?php
/**
 * Plugin Name:     Camo Image Proxy
 * Plugin URI:      https://ethitter.com/plugins/
 * Description:     Rewrite image URLs to use a Camo image proxy.
 * Author:          Erick Hitter
 * Author URI:      https://ethitter.com/
 * Text Domain:     camo-image-proxy
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

define( __NAMESPACE__ . '\PLUGIN_PATH', dirname( __FILE__ ) );

/**
 * Trait for singletons
 */
require_once PLUGIN_PATH . '/inc/trait-singleton.php';

/**
 * Plugin options
 */
require_once PLUGIN_PATH . '/inc/class-options.php';

/**
 * Options page
 */
require_once PLUGIN_PATH . '/inc/class-options-page.php';

/**
 * Assorted functions
 */
require_once PLUGIN_PATH . '/inc/functions.php';

/**
 * Load plugin singletons
 */
function init() {
	Options::instance();

	if ( is_admin() ) {
		Options_Page::instance();
	}
}
add_action( 'init', __NAMESPACE__ . '\init' );
