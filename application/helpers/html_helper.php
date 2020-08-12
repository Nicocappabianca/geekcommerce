<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	if(!function_exists('front_template'))
	{
		function front_template()
		{
			$ci =& get_instance();

			//Get class and method for active links purposes
			$data_menu['class'] = $ci->router->fetch_class();
			$data_menu['method'] = $ci->router->fetch_method();

			$template['header'] = $ci->load->view('themes/header_view', '', TRUE);
			$template['footer'] = $ci->load->view('themes/footer_view', '', TRUE);
			
			return $template;
		}
	}