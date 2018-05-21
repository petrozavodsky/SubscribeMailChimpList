<?php

namespace SubscribeMailChimpList\Classes;


use SubscribeMailChimpList\Utils\Ajax;
use SubscribeMailChimpList\Utils\Assets;

class AjaxHandle extends Ajax {
	use Assets;

	/**
	 * AjaxOut2 constructor.
	 */
	function __construct() {
		$name = "MailChimpListAddMail";
		parent::__construct( $name );
		$this->add_js_css( $name );
	}

	/**
	 * @param $name
	 */
	private function add_js_css( $name ) {
		$handle = $this->addJs(
			$name,
			'header',
			[ 'jquery' ]
		);
		$this->vars_ajax(
			$handle,
			[
				'ajax_url'        => $this->ajax_url,
				'ajax_url_action' => $this->ajax_url_action,
			]
		);
	}

	/**
	 * @param string $request
	 */
	public function callback( $request ) {
		do_action( 'SubscribeMailChimpList__ajax-handle', $request );
	}
}