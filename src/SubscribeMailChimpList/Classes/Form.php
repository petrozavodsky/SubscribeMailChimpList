<?php


namespace SubscribeMailChimpList\Classes;


class Form {

	public function __construct() {

		add_filter( 'SubscribeMailChimpList__shortcode-content', [ $this, 'form_html' ] ,10 ,1 );
	}


	public function form_html( $attrs ) {
	    d($attrs);
		ob_start();
		?>
        <div class="SubscribeMailChimpList__form-wrapper">
            <div class="SubscribeMailChimpList__form-wrap">

                <div class="SubscribeMailChimpList__form-title">
					<?php echo $attrs['title']; ?>
                </div>

                <form action="" method="post">


                    <div class="SubscribeMailChimpList__form-fields-wrapper">

                        <input type="email" class="SubscribeMailChimpList__form-input">

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