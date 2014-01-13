<?php
require_once( 'iJsonSerializer.php' );

class JsonSerializer implements iJsonSerializer {

	public function __construct() {
		if ( ! extension_loaded( 'curl' ) || ! extension_loaded( 'json' ) )
		{
			throw new PusherException('There is missing dependant extensions - please ensure both cURL and JSON modules are installed');
		}
	}

	public function serialize( $data ) {
		return json_encode( $data );
	}

	public function deserialize( $data, $assoc = false ) {
		return json_decode( $data, $assoc );
	}

}