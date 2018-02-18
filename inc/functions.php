<?php
/**
 * Assorted helpers
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Access plugin options
 *
 * @return object
 */
function Options() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid, Generic.Functions.OpeningFunctionBraceKernighanRitchie.ContentAfterBrace
	return Options::instance();
}

/**
 * Can URLs be rewritten to use Camo?
 *
 * @return bool
 */
function can_rewrite() : bool {
	$host = Options()->get( 'host' );
	$key  = Options()->get( 'key' );

	$can_rewrite = true;

	// Validate host.
	if ( empty( $host ) || ( ! filter_var( $host, FILTER_VALIDATE_URL ) && ! filter_var( $host, FILTER_VALIDATE_IP ) ) ) {
		$can_rewrite = false;
	}

	// Validate key.
	// TODO: make sure it's an HMAC or something?
	if ( empty( $key ) || ! is_string( $key ) ) {
		$can_rewrite = false;
	}

	return apply_filters( 'camo_image_proxy_can_rewrite', $can_rewrite, $host, $key );
}
