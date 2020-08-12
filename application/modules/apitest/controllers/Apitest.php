<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apitest extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		
	}

	function index()
	{
		$this->load->view("apitest/app/view_apitest.php");
	}
}
