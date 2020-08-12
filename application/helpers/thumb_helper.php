<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	if (!function_exists('thumb'))
	{
		function thumb($url, $width, $height = null, $alignment = null, $quality = null)
		{
			if (is_null($quality))
			{
				$quality = 100;
			}

			$script = base_url("assets/scripts/load.php?src=");
			$string = $script . $url . "&q=" . $quality . "&w=" . $width;

			if(!is_null($alignment))
			{
				$string .= "&zc=" . $alignment;
			}

			if(!is_null($height))
			{
				$string .= "&h=" . $height;
			}

			return $string;
		}
	}