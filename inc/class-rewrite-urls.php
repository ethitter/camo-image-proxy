<?php
/**
 * Force Core's image functions to use Camo
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Class Rewrite_URLs
 */
class Rewrite_URLs {
	use Singleton;

	/**
	 * Hooks
	 */
	public function setup() {
		add_filter( 'wp_get_attachment_image_src', [ $this, 'encode_image' ] );
	}

	/**
	 * Camouflage attachment URL
	 *
	 * @param array $image Image data.
	 * @return array
	 */
	public function encode_image( array $image ) : array {
		$url = URL::instance()->encode( $image[0] );

		if ( is_string( $url ) ) {
			$image[0] = $url;
		}

		return $image;
	}
}
