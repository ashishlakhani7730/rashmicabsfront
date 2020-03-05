<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onewaycablist extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
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
		
		$fromcity = exploded($this->input->post("oneway_from_city"));
		$tocity = exploded($this->input->post("oneway_to_city_id"));
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->encrypt->decode($fromcity[0]) && $this->encrypt->decode($tocity[0]) && $this->input->post('onewaytime') != '')
			{
				/*if(preg_match('/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3(0|1))\/\d{4}/', $this->input->post('oneway_date_from')))
				{*/
					$postdata = array(
						"sub_type_id" => 2,
						"from_city" => $this->encrypt->decode($fromcity[0]),
						"to_city" => $this->encrypt->decode($tocity[0]),
						"from_date" => date('Y-m-d',strtotime($this->input->post("oneway_date_from"))),
						"from_time" => $this->input->post("onewaytime")
					);
					$query = http_build_query($postdata);
					$getpackage = curlnative(GET_ONEWAY_PAKAGE,$query,'json');
					$finapackage = json_decode($getpackage,true);
					//echo "<pre>"; print_r($finapackage); exit;
					$data['cablist'] = $finapackage['package_list'];
					$data['cablists'] = 0;
					$data['bootstrap'] = "bootstrap.js";
					$data['fromcityid'] = $fromcity[0];
					$data['tocityid'] = $tocity[0];
					$data['fromcity'] = $fromcity[1];
					$data['tocity'] = $tocity[1];
					$data['date'] = date('d-m-Y',strtotime($this->input->post('oneway_date_from')));	
					$data['fromtime'] = $this->input->post('onewaytime');
					//echo "<pre>"; print_r($data); exit;
					$this->load->view('onewaycablist',$data);
				/*}
				else
				{
					$data['cablist'] = '';
					$data['date'] = 1;
					$data['bootstrap'] = "bootstrap.js";
					$this->load->view('onewaycablist',$data);
				}*/
			}
			else
			{
				$data['cablist'] = '';
				$data['city'] = 1;
				$data['bootstrap'] = "bootstrap.js";
				$this->load->view('onewaycablist',$data);
			}
		}
		else
		{
			$data['cablist'] = '';
			$data['cablists'] = 1;
			$data['bootstrap'] = "bootstrap.js";
			$this->load->view('onewaycablist',$data);
		}
	}
	
	public function book_cab()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
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
						"from_time" => $this->input->post('ttime'),
						"type" => "oneway"
					);
					$query = http_build_query($postdata);
					$getregister = curlnative(GET_REGISTER_DETAIL,$query,'json');
					$finaregister = json_decode($getregister,true);
					//echo "<pre>"; print_r($finaregister); exit;
					if($finaregister['code'] == 1)
					{
						if($this->session->userdata('isuserid') && $this->session->userdata('isusername') == $this->input->post("mobile"))
						{
						   // print_r($getregister);
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
							//print_r($getregister);
							
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