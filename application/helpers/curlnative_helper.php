<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('curlnative'))
{
	function curlnative($url,$postdata,$json_array)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($ch);

		if (curl_errno($ch))
        {
			return "Error: " . curl_error($ch);
        }
        else
        {
			
			if($json_array == "array")
			{
				return json_decode($data);
			}
			else
			{
				return $data;
			}

		}
		curl_close($ch);
	}
}