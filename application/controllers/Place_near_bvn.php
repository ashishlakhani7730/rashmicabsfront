<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_near_bvn extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data['bootstrap'] = "bootstrap.js";
		$this->load->view("placenearbvn",$data);
	}
}