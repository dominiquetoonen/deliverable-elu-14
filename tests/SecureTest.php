<?php require_once dirname(__DIR__) . '/vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once dirname(__DIR__) . '/utils/Secure.php';

class SecureTest extends TestCase {

	public function testHash()
	{
		$hash = Secure::hash('testValue');
		$this->assertNotEquals('testValue', $hash, 'Secure::hash - Not hashed!');
		$this->assertEquals(64, strlen($hash), 'Secure::hash - Hash isn\'t 64 characters long!');

		$hash = Secure::hash('test Another value');
		$this->assertNotEquals('test Another value', $hash, 'Secure::hash - Not hashed!');
		$this->assertEquals(64, strlen($hash), 'Secure::hash - Hash isn\'t 64 characters long!');
	}

	/**
	 * @throws Exception
	 */
	public function testEncryptDecrypt()
	{
		$encryptString = 'encrypt this string';
		$encrypted = Secure::encrypt($encryptString, 1);
		$this->assertNotEquals($encryptString, strlen($encrypted), 'Secure::encrypt - Not encrypted!');

		$decrypted = Secure::decrypt($encrypted, 1);
		$this->assertEquals($encryptString, $decrypted,'Secure::decrypt - Not successfully decrypted!');
	}

}