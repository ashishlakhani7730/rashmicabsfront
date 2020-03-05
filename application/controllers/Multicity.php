<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multicity extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$response = array();
		
		$fromcity = exploded($this->input->post("b_from_city"));
		if($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post("b_from_city") != '' && $this->input->post("b_to_city") != '' && $this->input->post("date") != '' && $this->input->post("date_to") != '' && $this->input->post("time") != '')
		{
			$getpackagedata = array(
									  "from_city" => $this->encrypt->decode($fromcity[0]),
									  "from_city_name" => $fromcity[1],
									  "b_to_city" => $this->input->post("b_to_city"),
									  "from_date" => date('Y-m-d',strtotime($this->input->post("date"))),
									  "to_date" 	=> date('Y-m-d',strtotime($this->input->post("date_to"))),
									  "from_time" => $this->input->post("time")
							  );
			$query = http_build_query($getpackagedata);
			$getpackage = curlnative(GET_MULTICITY_PAKAGE,$query,'json');
			
			$response['code'] = 1;
			$response['package'] = $getpackage;
			$response['postdata'] = json_encode($getpackagedata);
		}
		else
		{
			$response['code'] = 0;
			$response['msg'] = 'All Fields Is Required';
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}
	
	public function showpackagedata()
	{
		//echo "<pre>"; print_r($this->input->post()); exit;
		
		$finapackage = json_decode($this->input->post("package"),true);
		$postdata = json_decode($this->input->post("postdata"));
		//echo "<pre>"; print_r($finapackage); exit;
		$data['cablist'] = $finapackage['package_list'];
		$data['cablists'] = 0;
		$data['bootstrap'] = "bootstrap.js";
		$data['from_city'] = $postdata->from_city;
		$data['from_city_name'] = $postdata->from_city_name;
		$data['to_city_name'] = $postdata->b_to_city;
		$data['from_date'] = $postdata->from_date;
		$data['to_date'] = $postdata->to_date;
		$data['from_time'] = $postdata->from_time;
		//echo "<pre>"; print_r($data); exit;
		$this->load->view('multicitycablist',$data);
	}
	
	public function book_cab()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			//echo "<pre>"; print_r($this->input->post()); exit;
			if($this->encrypt->decode($this->input->post("newpackage")))
			{
				if($this->input->post("mobile") && $this->input->post("mobile") == "")
				{
					$response = array("code"=>0,"msg"=>"Please Enter Mobile Number");
				}
				else if((!preg_match("/[2-9]{1}\d{9}/",$this->input->post('mobile'))))
				{
					$response = array("code"=>0,"msg"=>"Please Enter Valid Mobile Number");
				}
				else
				{
					$postdata = array(
						"newpackage" => $this->encrypt->decode($this->input->post("newpackage")),
						"mobile" => $this->input->post('mobile'),
						"from_city" => $this->input->post('fcity'),
						"b_to_city" => $this->input->post('tcity'),
						"from_date" => $this->input->post('fdate'),
						"to_date" => $this->input->post('rdate'),
						"from_time" => $this->input->post('stime'),
						"type" => "multicity"
					);
					$query = http_build_query($postdata);
					
					$getregister = curlnative(GET_REGISTER_DETAIL,$query,'json');
					$finaregister = json_decode($getregister,true);
					//echo "<pre>"; print_r($finaregister); exit;
					if($finaregister['code'] == 1)
					{
						if($this->session->userdata('isuserid') && $this->session->userdata('isusername') == $this->input->post("mobile"))
						{
							$response = array("code"=>1,"msg"=>"SUESSFULLY","xmldata"=>$this->encrypt->encode($getregister));
						}
						else
						{
							if($this->session->userdata('isuserid') && $this->session->userdata('isusername'))
							{
								$this->session->unset_userdata('isuserid');
								$this->session->unset_userdata('isuserpid');
								$this->session->unset_userdata('isusername');
							}
							
							$this->session->set_userdata("isuserid",$finaregister['passenger_detail']['p_id']);
							$this->session->set_userdata("isuserpid",$finaregister['passenger_detail']['p_p_id']);
							if($finaregister['passenger_detail']['contact1'] != "")
							{
								$this->session->set_userdata("isusername",$finaregister['passenger_detail']['contact1']);
							}
							else
							{
								$this->session->set_userdata("isusername",$finaregister['passenger_detail']['contact2']);
							}
							
							$response = array("code"=>1,"msg"=>"SUESSFULLY","xmldata"=>$this->encrypt->encode($getregister));
						}	
					}
					else
					{
						$response = array("code"=>$finaregister['code'],"msg"=>$finaregister['msg']);
					}
				}
			}
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}
}