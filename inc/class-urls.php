<?php
/**
 * URL Building
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Class URL
 */
class URL {
	use Singleton;

	/**
	 * Can URLs be rewritten to use Camo?
	 *
	 * @return bool
	 */
	public function can_rewrite() : bool {
		$host = Options::instance()->get( 'host' );
		$key  = Options::instance()->get( 'key' );

		$can_rewrite = true;

		// Validate host.
		if ( $this->is_valid_url( $host ) ) {
			$can_rewrite = false;
		}

		// Validate key.
		// TODO: make sure it's an HMAC or something?
		if ( empty( $key ) || ! is_string( $key ) ) {
			$can_rewrite = false;
		}

		return apply_filters( 'camo_image_proxy_can_rewrite', $can_rewrite, $host, $key );
	}

	/**
	 * Encode image URL
	 *
	 * @param string $url Image URL to encode.
	 * @return string|bool
	 */
	public function encode( string $url ) : string {
		if ( ! $this->can_rewrite() || ! $this->is_valid_url( $url ) ) {
			return false;
		}

		$key         = hash_hmac( 'sha1', $url, Options::instance()->get( 'key' ) );
		$url_encoded = bin2hex( $url );

		$url_encoded = sprintf( '%1$s/%2$s/%3$s', Options::instance()->get( 'host' ), $key, $url_encoded );
		$url_encoded = set_url_scheme( $url_encoded, 'https' );

		return $url_encoded;
	}

	/**
	 * Decode encoded URL
	 *
	 * @param string $url Camo URL to decode.
	 * @return string|bool
	 */
	public function decode( string $url ) : string {
		return false;
	}

	/**
	 * Can we encode this URL?
	 *
	 * @param string $url URL to validate.
	 * @return bool
	 */
	private function is_valid_url( string $url ) : bool {
		return empty( $url ) || ( ! filter_var( $url, FILTER_VALIDATE_URL ) && ! filter_var( $url, FILTER_VALIDATE_IP ) );
	}
}
