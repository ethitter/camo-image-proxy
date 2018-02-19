<?php
/**
 * Rewrite images in content
 *
 * @package Camo_Image_Proxy
 */

namespace Camo_Image_Proxy;

/**
 * Class Rewrite_Content
 */
class Rewrite_Content {
	use Singleton;

	/**
	 * Filter priority
	 *
	 * @var int
	 */
	private $priority;

	/**
	 * Hooks
	 */
	public function setup() {
		$priority       = apply_filters( 'camo_image_proxy_rewrite_content_priority', PHP_INT_MAX - 1 );
		$this->priority = absint( $priority );

		add_filter( 'the_content', [ $this, 'filter_the_content' ], $this->priority );
	}

	/**
	 * Rewrite image URLs in content
	 *
	 * @param string $content Post content.
	 * @return string
	 */
	public function filter_the_content( string $content ) : string {
		// TODO: only deal with image srcs, use DOM Document.
		return $content;
	}
}
