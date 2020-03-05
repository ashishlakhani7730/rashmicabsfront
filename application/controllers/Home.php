<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->output->parse_exec_vars = FALSE;
		//$this->ci_minifier->init(3);
		//$this->output->cache(30); 
	}
	
	public function index()
	{
		$query = '';
		$city = curlnative(FROM_CITY,$query,'array'); 
		if(!empty($city->from_city_list))
		{
			$data['from_city_list'] = $city->from_city_list;
		}
		else
		{
			$data['from_city_list'] = '';
		}
		$data['bootstrap'] = "bootstrap.js";
		$this->load->view('home',$data);
	}
	//$this->output->set_content_type('application/json');
	//$this->output->set_output(json_encode($response));
	public function to_city()
	{	
		$fromcity = exploded($this->input->post("b_from_city"));
		if($this->encrypt->decode($fromcity[0]))
		{
			$query = array("b_from_city"=>$this->encrypt->decode($fromcity[0]));
			$tocity = curlnative(TO_CITY_ONEWAYOFFER,$query,'array');
			if(!empty($tocity->to_city_list))
			{
				foreach($tocity->to_city_list as $tcity)
				{
					$this->output->append_output("<option value='".$this->encrypt->encode($tcity->id).",".$tcity->c_name."'>".$tcity->c_name."</option>");
					
				}
			}
		}
	}
	
	public function one_way_to_city()
	{
		$fromcity = exploded($this->input->post("oneway_from_city"));
		if($this->encrypt->decode($fromcity[0]))
		{
			$query = array("from_city"=>$this->encrypt->decode($fromcity[0]));
			$tocity = curlnative(TO_CITY_ONEWAY,$query,'array');
			if(!empty($tocity->to_city_list))
			{
				foreach($tocity->to_city_list as $tcity)
				{
					$this->output->append_output("<option value='".$this->encrypt->encode($tcity->id).",".$tcity->c_name."'>".$tcity->c_name."</option>");
					
				}
			}
		}
	}
}
