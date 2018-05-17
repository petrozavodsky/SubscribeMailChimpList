<?php


namespace SubscribeMailChimpList\Classes;


class Form {

	public function __construct() {

		add_filter( 'SubscribeMailChimpList__shortcode-content', [ $this, 'form_html' ] );
	}


	public function form_html( $attrs ) {
		?>

		<?php
	}

}