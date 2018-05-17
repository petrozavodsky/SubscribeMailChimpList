<?php

/*
Plugin Name: Subscribe MailChimp List
Plugin URI: http://alkoweb.ru
Author: Petrozavodsky
Author URI: http://alkoweb.ru
Requires PHP: 7.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . "includes/Autoloader.php" );

use SubscribeMailChimpList\Autoloader;

new Autoloader( __FILE__, 'SubscribeMailChimpList' );


use SubscribeMailChimpList\Base\Wrap;
use SubscribeMailChimpList\Classes\AjaxHandle;
use SubscribeMailChimpList\Classes\MailChimpAjax;
use SubscribeMailChimpList\Classes\Shortcode;

class SubscribeMailChimpList extends Wrap {
	public $version = '1.0.1';
	public static $textdomine;

	function __construct() {
		self::$textdomine = $this->setTextdomain();

		new AjaxHandle();

		new MailChimpAjax();

		new Shortcode(
			'SubscribeMailChimpList',
			[
				'title'       => 'Subscribe',
			]
		);

	}

}

function SubscribeMailChimpList__init() {
	new SubscribeMailChimpList();
}

add_action( 'plugins_loaded', 'SubscribeMailChimpList__init', 30 );
