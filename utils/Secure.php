<?php

class Secure {

	private const CIPHER = 'AES-256-CBC';

	/**
	 * @param $value
	 * @return string
	 */
	public static function hash($value)
	{
		return hash('sha256', $value);
	}

	/**
	 * Encrypt value.
	 *
	 * @param $data
	 * @param $id
	 *
	 * @return string
	 * @throws Exception
	 */
	public static function encrypt($data, $id)
	{
		$key = self::getEncryptionKey($id);
		// Remove the base64 encoding from our key
		$encryption_key = base64_decode($key);
		// Generate an initialization vector
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
		$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
		// The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
		return base64_encode($encrypted . '::' . $iv);
	}

	/**
	 * Decrypt encrypted value.
	 *
	 * @param $data
	 * @param $id
	 *
	 * @return string
	 * @throws Exception
	 */
	public static function decrypt($data, $id)
	{
		$key = self::getEncryptionKey($id);
		// Remove the base64 encoding from our key
		$encryption_key = base64_decode($key);
		// To decrypt, split the encrypted data from our IV - our unique separator used was "::"
		list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
	}

	/**
	 * Get encryption key
	 *
	 * @param int $id
	 * @return string
	 */
	private static function getEncryptionKey(int $id)
	{
		$credentialsFile = file_get_contents(dirname(__DIR__ ) . '/credentials.json');
		$credentials = json_decode($credentialsFile);
		$key = 'key' . $id;
		return $credentials->encryptionKeys->$key;
	}

}