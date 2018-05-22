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
use SubscribeMailChimpList\Classes\Admin;
use SubscribeMailChimpList\Classes\AjaxHandle;
use SubscribeMailChimpList\Classes\Form;
use SubscribeMailChimpList\Classes\MailChimpAjax;
use SubscribeMailChimpList\Classes\Shortcode;
use SubscribeMailChimpList\Utils\ActivateWidgets;

class SubscribeMailChimpList extends Wrap {
	public $version = '1.0.1';
	public static $textdomine;

	function __construct() {
		self::$textdomine = $this->setTextdomain();

		new Admin();

		new AjaxHandle();

		new MailChimpAjax();

		new Form();

		new Shortcode(
			'SubscribeMailChimpList',
			[
				'title' => __( 'Subscribe to our newsletter', 'SubscribeMailChimpList' ),
			]
		);

		new ActivateWidgets(
			__FILE__,
			'Widgets',
			'SubscribeMailChimpList'
		);

	}

}

function SubscribeMailChimpList__init() {
	new SubscribeMailChimpList();
}

add_action( 'plugins_loaded', 'SubscribeMailChimpList__init', 30 );