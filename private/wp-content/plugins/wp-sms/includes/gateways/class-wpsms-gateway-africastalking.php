<?php

namespace WP_SMS\Gateway;

class africastalking extends \WP_SMS\Gateway {
	private $wsdl_link = '';
	private $client = null;
	private $http;
	public $tariff = "http://africastalking.com/";
	public $unitrial = true;
	public $unit;
	public $flash = "enable";
	public $isflash = false;

	public function __construct() {
		parent::__construct();
		include_once( 'libraries/africastalking/AfricasTalkingGateway.php' );

		$this->validateNumber = "+254711XXXYYY";
		$this->help           = "API key generated from your account settings";
		$this->has_key        = true;
	}

	public function SendSMS() {

		/**
		 * Modify sender number
		 *
		 * @since 3.4
		 *
		 * @param string $this ->from sender number.
		 */
		$this->from = apply_filters( 'wp_sms_from', $this->from );

		/**
		 * Modify Receiver number
		 *
		 * @since 3.4
		 *
		 * @param array $this ->to receiver number
		 */
		$this->to = apply_filters( 'wp_sms_to', $this->to );

		/**
		 * Modify text message
		 *
		 * @since 3.4
		 *
		 * @param string $this ->msg text message.
		 */
		$this->msg = apply_filters( 'wp_sms_msg', $this->msg );

		// Get the credit.
		$credit = $this->GetCredit();

		// Check gateway credit
		if ( is_wp_error( $credit ) ) {
			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $credit->get_error_message(), 'error' );

			return $credit;
		}

		$gateway = new \AfricasTalkingGateway( $this->username, $this->has_key );

		try {
			$results = $gateway->sendMessage( implode( ',', $this->to ), $this->msg, $this->from );

			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $result );

			/**
			 * Run hook after send sms.
			 *
			 * @since 2.4
			 *
			 * @param string $result result output.
			 */
			do_action( 'wp_sms_send', $result );

			return $result;
		} catch ( \AfricasTalkingGatewayException $e ) {
			// Log the result
			$this->log( $this->from, $this->msg, $this->to, $e->getMessage(), 'error' );

			return new \WP_Error( 'send-sms', $e->getMessage() );
		}
	}

	public function GetCredit() {
		// Check username and password
		if ( ! $this->username or ! $this->password ) {
			return new \WP_Error( 'account-credit', __( 'Username/Password does not set for this gateway', 'wp-sms-pro' ) );
		}

		if ( ! function_exists( 'curl_version' ) ) {
			return new \WP_Error( 'required-function', __( 'CURL extension not found in your server. please enable curl extension.', 'wp-sms' ) );
		}

		$gateway = new \AfricasTalkingGateway( $this->username, $this->has_key );

		try {
			$data = $gateway->getUserData();
			preg_match( '!\d+!', $data->balance, $matches );

			return $matches[0];
		} catch ( \AfricasTalkingGatewayException $e ) {
			return new \WP_Error( 'account-credit', $e->getMessage() );
		}
	}
}