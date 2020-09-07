<?php

class StringFormat {

	/**
	 * Format a float number to an euro formatted price.
	 *
	 * @param float $price
	 *
	 * @return string
	 */
	public static function price(float $price)
	{
		setlocale(LC_MONETARY, 'nl_NL');
		return money_format('&euro; %!n', $price);
	}

	/**
	 * Format a string to use in an url.
	 *
	 * @param string $string
	 *
	 * @return string
	 */
	public static function url(string $string)
	{
		$string = urlencode(strtolower(str_replace(' ', '-', $string)));
		return $string;
	}

}