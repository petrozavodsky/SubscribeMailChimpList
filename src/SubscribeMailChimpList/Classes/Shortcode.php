<?php

namespace SubscribeMailChimpList\Classes;

use SubscribeMailChimpList\Utils\ActivateShortcode;
use SubscribeMailChimpList\Utils\Assets;

class Shortcode extends ActivateShortcode {
	use Assets;

	protected $js = false;
	protected $css = true;


	function base( $attrs, $content, $tag ) {

		return apply_filters( 'SubscribeMailChimpList__shortcode-content', $attrs );
	}

}