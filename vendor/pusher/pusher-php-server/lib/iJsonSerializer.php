<?php

/**
 * Used to serialize
 */
interface iJsonSerializer {

	/**
	 * Serialize to JSON.
	 * @param object $data The object to be serialized as JSON.
	 */
	public function serialize( $data );

	/**
	 * Deserialize a string to an object.
	 * @param $data string the string to be converted to an object
	 * @param assoc boolean whether the string should be convereted to an associative array rather than an object (StdClass).
	 */
	public function deserialize( $data, $assoc );
}