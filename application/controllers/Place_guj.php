<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_guj extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['bootstrap'] = "bootstrap.js";
		$this->load->view("place_in_guj",$data);
	}
}