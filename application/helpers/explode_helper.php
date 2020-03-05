<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('exploded'))
{
	function exploded($string)
	{
		return $exp = explode(",",$string);
	}
}