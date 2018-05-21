<?php

namespace SubscribeMailChimpList\Classes;


class MailChimpAjax {

	public $api_key;
	public $list_id;

	private $timeout = 35;


	function __construct() {
		$this->api_key = Admin::$option_prefix . 'api_key';
		$this->list_id = Admin::$option_prefix . 'list_id';

		add_action( 'SubscribeMailChimpList__ajax-handle', [ $this, 'action' ] );
	}

	public function action() {
		$request = $_REQUEST;
		$request = array_map( 'trim', $request );
		unset( $request['action'] );


		if ( array_key_exists( 'email', $request ) && is_email( $request['email'] ) ) {

			if ( $this->subscribe( $request['email'] ) ) {
				wp_send_json_success( [
					'message'     => 'Вы подписались на рассылку',
					'button_text' => 'Готово!'
				] );
			} else {
				wp_send_json_error( [ 'message' => 'Ошибка отправки' ] );
			}
		}

		wp_send_json_error( [ 'message' => 'Неверный Email' ] );
	}

	private function subscribe( $email ) {


		$api_key = $this->api_key;
		$list_id = $this->list_id;
		$data    = array(
			'email_address' => $email,
			'status'        => 'subscribed',
			'merge_fields'  => array(
				'EMAIL' => $email,
			)
		);
		$body    = json_encode( $data );

		$opts        = array(
			'headers'  => array(
				'Content-Type'  => 'application/json',
				'Authorization' => 'apikey ' . $api_key
			),
			'blocking' => true,
			'timeout'  => $this->timeout,
			'body'     => $body
		);
		$apiKeyParts = explode( '-', $api_key );
		$shard       = $apiKeyParts[1];
		$url         = "https://{$shard}.api.mailchimp.com/3.0/lists/{$list_id}/members/";
		$response    = wp_remote_post( $url, $opts );


		if ( is_wp_error( $response ) ) {
			return false;
		}
		if ( $response['response']['code'] == 200 ) {
			return true;
		}

		return false;
	}
}
