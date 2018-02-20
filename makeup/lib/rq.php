<?php

namespace makeup\lib;

/**
 * Class RQ
 * @package makeup\lib
 */
class RQ
{
	public static function init()
	{
		$_GET = self::parseQueryString();
		$_POST = self::parseFormData();
	}

	/**
	 * Value of a query parameter
	 * 
	 * @param string $key
	 * @return string $value
	 */
	public static function GET($key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	/**
	 * Value of a formular
	 * 
	 * @param string $key
	 * @return string $value
	 */
	public static function POST($key)
	{
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}

	public static function parseQueryString()
	{
		return array_map('self::filterInput', $_GET);
	}

	public static function parseFormData()
	{
		return array_map('self::filterInput', $_POST);
	}

	/**
	 * @param $input
	 * @return mixed
	 */
	private static function filterInput($input)
	{
		return filter_var(rawurldecode($input), FILTER_SANITIZE_STRING);
	}

}

