<?php


namespace SubscribeMailChimpList\Classes;


class Form {

	public function __construct() {

		add_filter( 'SubscribeMailChimpList__form-content', [ $this, 'form_html' ], 10, 1 );

		add_action( 'SubscribeMailChimpList__form', [ $this, 'bind_form' ], 10, 1 );

	}

	public function bind_form( $attrs ) {

		echo $this->form_html( $attrs );

	}

	public function form_html( $attrs ) {

	    // TODO add router
	    //$attrs

		ob_start();
		?>
        <div class="SubscribeMailChimpList__form-wrapper">
            <div class="SubscribeMailChimpList__form-wrap">

				<?php if ( ! empty( $attrs['title'] ) ): ?>
                    <div class="SubscribeMailChimpList__form-title">
						<?php echo $attrs['title']; ?>
                    </div>
				<?php endif; ?>

                <form action="<?php echo AjaxHandle::$form_action; ?>" method="post" class="SubscribeMailChimpList__form">

                    <div class="SubscribeMailChimpList__form-fields-wrapper">

                        <input name="email" type="email" placeholder="<?php _e( 'Enter your E-mail...', 'SubscribeMailChimpList' ); ?>"
                               class="SubscribeMailChimpList__form-input">

                        <button type="submit" class="SubscribeMailChimpList__form-button">
							<?php _e( 'Subscribe', 'SubscribeMailChimpList' ); ?>
                        </button>

                    </div>

                    <div class="SubscribeMailChimpList__form-alerts-wrap
                    <?php echo( empty( $attrs['alert-class'] ) ? 'no-message' : $attrs['alert-class'] ); ?>"
                         data-alert="alert-area"
                    >

						<?php if ( ! empty( $attrs['alert'] ) ): ?>
							<?php echo $attrs['alert']; ?>
						<?php endif; ?>

                    </div>

                </form>

            </div>
        </div>
		<?php
		$res = ob_get_contents();
		ob_clean();

		return $res;
	}

	private function options_helper( $id, $number ) {

		$default_options = $this->default_options();

		$option      = get_option( $id );
		$number      = strval( $number );
		$data        = $option[ $number ];
		$widget_data = $this->array_clean_empty_vals( [
			'api_key' => $data['api_key'],
			'list_id' => $data['list_id']
		] );

		$out = [];

		foreach ( $default_options as $key => $val ) {

			if ( array_key_exists( $key, $widget_data ) ) {
				$out[ $key ] = $widget_data[ $key ];
			} else {
				$out[ $key ] = $val;
			}

		}

		return $out;

	}

	private function array_clean_empty_vals( $array ) {

		return array_filter( $array, function ( $element ) {
			return ! empty( $element );
		} );

	}

	private function default_options() {
		$options = [
			'api_key' => get_option( Admin::$option_prefix . 'api_key', false ),
			'list_id' => get_option( Admin::$option_prefix . 'list_id', false )
		];

		return $options;
	}

}