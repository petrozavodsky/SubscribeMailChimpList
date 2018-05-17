<?php

namespace SubscribeMailChimpList\Widgets;

use SubscribeMailChimpList;
use WP_Widget;

class SubscribeMailChimpWidget extends WP_Widget {
	private $textdomain = __NAMESPACE__;
	private $suffix = " - SubscribeMailChimpWidget";

	function __construct() {
		$this->textdomain = SubscribeMailChimpList::$textdomine;
		$className        = get_called_class();
		$className        = str_replace( "\\", '-', $className );
		parent::__construct(
			$className,
			__( "My widget ", 'SubscribeMailChimpList' ) . $this->suffix,
			[
				'description' => __( "My widget", 'SubscribeMailChimpList') . $this->suffix
			]
		);
	}

	public function widget( $args, $instance ) {

		echo $args['before_widget'];
		?>
ec
		<?php
		echo $args['after_widget'];
	}


	public function form( $instance ) {
		echo '<p class="no-options-widget">' . __( 'There are no options for this widget.', 'SubscribeMailChimpList' ) . '</p>';

		return 'noform';
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

}