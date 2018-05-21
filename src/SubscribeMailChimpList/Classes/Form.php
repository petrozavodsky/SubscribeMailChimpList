<?php


namespace SubscribeMailChimpList\Classes;


class Form {

	public function __construct() {

		add_filter( 'SubscribeMailChimpList__shortcode-content', [ $this, 'form_html' ], 10, 1 );

		add_action( 'SubscribeMailChimpList__form', [ $this, 'form_html' ], 10, 1 );

	}


	public function form_html( $attrs ) {
		ob_start();
		?>
        <div class="SubscribeMailChimpList__form-wrapper">
            <div class="SubscribeMailChimpList__form-wrap">

                <div class="SubscribeMailChimpList__form-title">
					<?php echo $attrs['title']; ?>
                </div>

                <form action="" method="post" class="SubscribeMailChimpList__form">


                    <div class="SubscribeMailChimpList__form-fields-wrapper">

                        <input type="email" placeholder="<?php _e( 'Enter your E-mail...', 'SubscribeMailChimpList' ); ?>"
                               class="SubscribeMailChimpList__form-input">

                        <button type="submit" class="SubscribeMailChimpList__form-button">
							<?php _e( 'Subscribe', 'SubscribeMailChimpList' ); ?>
                        </button>

                    </div>


                    <div class="SubscribeMailChimpList__form-alerts-wrap">

                    </div>

                </form>

            </div>
        </div>
		<?php
		$res = ob_get_contents();
		ob_clean();

		return $res;
	}

}