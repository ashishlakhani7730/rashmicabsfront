<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cablist extends CI_Controller {
	
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
		
		$fromcity = exploded($this->input->post("b_from_city"));
		$tocity = exploded($this->input->post("b_to_city_id"));
		
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->encrypt->decode($fromcity[0]) && $this->encrypt->decode($tocity[0]))
			{
			/*	if(preg_match('/(0[1-9]|1[0-2])\/(0[1-9]|1[0-9]|2[0-9]|3(0|1))\/\d{4}/', date('yyyy/m/d',strtotime( $this->input->post('date_from')))))
				{*/
					//echo "hello1"; exit;
					$postdata = array(
						"from_city" => $this->encrypt->decode($fromcity[0]),
						"b_to_city_id" => $this->encrypt->decode($tocity[0]),
						"from_date" => date('Y-m-d',strtotime($this->input->post("date_from")))
					);
					$query = http_build_query($postdata);
				
					//echo $query; exit;
					$getpackage = curlnative(GET_ONEWAY_OFFER_PAKAGE,$query,'json');
					$finapackage = json_decode($getpackage,true);
				
				    $vehicle_category = json_decode(curlnative(VEHICLE_CATEGORY_LIST,$query,'json'), true);
					//echo $getpackage; exit;
					//print_r($vehicle_category);
					$data['categorylist'] = $vehicle_category['categorylist'];
					$data['cablist'] = $finapackage['package_list'];
					$data['cablists'] = 0;
					$data['bootstrap'] = "bootstrap.js";
					$data['fromcityid'] = $this->encrypt->decode($fromcity[0]);					
					$data['tocityid'] = $this->encrypt->decode($tocity[0]);
					$data['fromcity'] = $fromcity[1];
					$data['tocity'] = $tocity[1];
					$data['date'] = date('d-m-Y',strtotime( $this->input->post('date_from')));			
					//echo "<pre>"; print_r($data); exit;
					$this->load->view('cablist',$data);
				/*}
				else
				{
					echo "hello2"; exit;
					$data['cablist'] = '';
					$data['date'] = 1;
					$data['bootstrap'] = "bootstrap.js";
					$this->load->view('cablist',$data);
				}*/
			}
			else
			{
				$data['cablist'] = '';
				$data['city'] = 1;
				$data['bootstrap'] = "bootstrap.js";
				$this->load->view('cablist',$data);
			}
		}
		else
		{
			$data['cablist'] = '';
			$data['cablists'] = 1;
			$data['bootstrap'] = "bootstrap.js";
			$this->load->view('cablist',$data);
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
						"type" => "onewayoffer",												
						"city1" => $this->input->post("city_from"),												
						"city2" => $this->input->post("city_to")
					);
					//echo "<pre>"; print_r($postdata); exit;
					$query = http_build_query($postdata);
					$getregister = curlnative(GET_REGISTER_DETAIL,$query,'json');					
					//print_r($getregister); exit;
					$finaregister = json_decode($getregister,true);
				//	print_r($finaregister); exit;
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
	
	
	public function oneway_offer_booking_inquiry()
	{
	    if($this->input->server('REQUEST_METHOD') == 'POST')
		{
		    //print_r($this->input->post(NULL, true));
		    //"name", "mobile", "from_city", "to_city", "category_id", "category_name", "plan_date", "plan_time", "open_notes",
		    //echo $this->session->userdata('isusername');
		    
		    $category = exploded($this->input->post("i_vehicle_category"));
		    
		    $postdata = array(
		                "mobile" => $this->input->post('i_contact'),
		                "from_city" => $this->input->post('i_from_city'),
		                "to_city" => $this->input->post('i_to_city'),
						"category_id" => $this->encrypt->decode($category[0]),
						"category_name" => $category[1],
						"plan_date" => date('Y-m-d', strtotime($this->input->post('date_from'))),												
						"plan_time" => date('H:i:s', strtotime($this->input->post('time_from'))),												
						"open_notes" => $this->input->post("i_notes")
					);
					
			$query = http_build_query($postdata);
			$passenger_detail = curlnative(CHECK_PASSENGER,$query,'json');
			
			$passenger = json_decode($passenger_detail,true);
			
			$postdata['user'] = $passenger['passenger_detail']['p_id'];
			$postdata['name'] = $passenger['passenger_detail']['fullname'];
			
			$query = http_build_query($postdata);
			$inquiry_response = curlnative(ONEWAY_OFFER_INQUIRY,$query,'json');					
		    //$inquiry_response = json_decode($inquiry_response,true);
		   $this->session->set_flashdata('flashSuccess', 'Your Enquiry Successfully Submitted, Our Customer executive contact you soon.');
		  redirect(base_url().'cab/onewayoffer');
		}
	}
} ?>