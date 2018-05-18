<?php

namespace SubscribeMailChimpList\Classes;


class Admin {

	public static $option_prefix = 'SubscribeMailChimpList__';

	public function __construct() {

		add_action( 'admin_menu', [ $this, 'add_option_field_to_setting_admin_page' ] );

	}

	function add_option_field_to_setting_admin_page() {

		d(
			get_option( self::$option_prefix . 'api_key' )
		);

		add_settings_field(
			self::$option_prefix . 'api_key',
			__( 'MailChimp API key', 'SubscribeMailChimpList' ),
			[ $this, 'sanitize' ],
			'reading',
			'default'
		);

		register_setting( 'reading', self::$option_prefix . 'api_key' );

		add_settings_field(
			self::$option_prefix . 'list_id',
			__( 'MailChimp List id', 'SubscribeMailChimpList' ),
			[ $this, 'sanitize' ],
			'reading',
			'default'
		);

		register_setting( 'reading', self::$option_prefix . 'list_id' );

	}

	private function sanitize( $val ) {

		if ( is_string( $val ) ) {
			return trim( $val );
		}

		return '';

	}

}