<?php require_once dirname(__DIR__) . '/vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once dirname(__DIR__) . '/utils/StringFormat.php';

class StringFormatTest extends TestCase {

	public function testPrice()
	{
		$price = StringFormat::price(10);
		$this->assertEquals('&euro; 10,00', $price, 'StringFormat::price - Price not formatted correctly!');

		$price = StringFormat::price(999.50);
		$this->assertEquals('&euro; 999,50', $price, 'StringFormat::price - Price not formatted correctly!');

		$price = StringFormat::price(15.00);
		$this->assertEquals('&euro; 15,00', $price, 'StringFormat::price - Price not formatted correctly!');
	}

	public function testUrl()
	{
		$url = StringFormat::url('Test TEST');
		$this->assertEquals('test-test', $url, 'StringFormat::url - String not formatted correctly!');

		$url = StringFormat::url('^&()');
		$this->assertEquals('%5E%26%28%29', $url, 'StringFormat::url - String not formatted correctly!');
	}

}