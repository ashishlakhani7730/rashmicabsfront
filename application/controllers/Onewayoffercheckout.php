<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onewayoffercheckout extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
			{
				$data['fromcity'] = $this->input->post("fromcity");
				$data['tocity'] = $this->input->post("tocity");
				$data['fromcityid'] = $this->input->post("fromcityid");
				$data['tocityid'] = $this->input->post("tocityid");
				$data['date'] = $this->input->post("date");
			
				if($this->encrypt->decode($this->input->post("xmldata")))
				{
					$checkoutdata = json_decode($this->encrypt->decode($this->input->post("xmldata")),true);
			//		print_r($checkoutdata);
					$data["user_detail"] = $checkoutdata['passenger_detail'];
					$data["package_detail"] = $checkoutdata['package_detail'];
					$data["package_terms"] = $checkoutdata['trems'][0]['package_terms'];
					$data["terms_and_conditions"] = $checkoutdata['trems'][0]['terms_and_conditions'];
					$data["privacy_policy"] = $checkoutdata['trems'][0]['privacy_policy'];
					$data["cancellation_terms"] = $checkoutdata['trems'][0]['cancellation_terms'];
					$data["xmldata"] = $this->input->post("xmldata");
				//	echo "<pre>";print_r($data); exit;
					$data['bootstrap'] = "bootstrap.js";
					$this->load->view("onewayoffercheckout",$data);
				}
			}
		}
		else
		{
			redirect("lists/cablists");
		}
	}
	
	public function oneway_offercheckout()
	{
		$response = array();
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
			{
				$postdata = $this->input->post(NULL,TRUE);
				  //echo "<pre>"; print_r($postdata);
				if($postdata['selfstatus'])
				{
					if(!isset($postdata['fname']) || $postdata['fname'] == '')
					{
						$response = array("code"=>0,"msg"=>"Please Enter First Name");
					}
					else if(!preg_match("/^[\\p{L} .'-]+$/",$postdata['fname']))
					{
						$response = array("code"=>0,"msg"=>"Enter Only Charecter In First Name");
					}
					
					if(!isset($postdata['lname']) || $postdata['lname'] == '')
					{
						$response = array("code"=>0,"msg"=>"Please Enter Last Name");
					}
					else if(!preg_match('/^[A-z]+$/',$postdata['lname']))
					{
						$response = array("code"=>0,"msg"=>"Enter Only Charecter In Last Name");
					}
				
					if(!isset($postdata['mobile']) || $postdata['mobile'] == '')
					{
						$response = array("code"=>0,"msg"=>"Please Enter Mobile Number");
					}
					else if(!preg_match('/^((?!(0))[0-9]{10})$/',$postdata['mobile']))
					{
						$response = array("code"=>0,"msg"=>"Enter Valid Mobile Number");
					}
					
				}
				else
				{
					if(!isset($postdata['tname']) || $postdata['tname'] == '')
					{
						$response = array("code"=>0,"msg"=>"Please Enter Traveller Name");
					}
					else if(!preg_match('/^[A-z]+$/',$postdata['tname']))
					{
						$response = array("code"=>0,"msg"=>"Enter Only Charecter In Traveller Name");
					}
					
					if(!isset($postdata['tphone']) || $postdata['tphone'] == '')
					{
						$response = array("code"=>0,"msg"=>"Please Enter Traveller Mobile Number");
					}
					else if(!preg_match('/^((?!(0))[0-9]{10})$/',$postdata['tphone']))
					{
						$response = array("code"=>0,"msg"=>"Please Enter Valid Traveller Mobile Number");
					}
				}
				
				if(!isset($postdata['email']) || $postdata['email'] == '')
				{
					$response = array("code"=>0,"msg"=>"Please Enter Email");
				}
				else if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$postdata['email']))
				{
					$response = array("code"=>0,"msg"=>"Please Enter Valid Email");
				}
				
				if(!isset($postdata['triptime']) || $postdata['triptime'] == '')
				{
					$response = array("code"=>0,"msg"=>"Please Select Start TripTime");
				}
				else if(!preg_match('/\b(0?\d|1[0-2]):[0-5]\d (AM|PM)/',$postdata['triptime']))
				{
					$response = array("code"=>0,"msg"=>"Please Select Valid Start TripTime");
				}
				
				if(!isset($postdata['pickup_point']) || $postdata['pickup_point'] == '')
				{
					$response = array("code"=>0,"msg"=>"Please Select Pickup Point");
				}
				else if(!preg_match('/^[ A-Za-z0-9.,-]*$/',$postdata['pickup_point']))
				{
					$response = array("code"=>0,"msg"=>"Please Select Valid Pickup Point");
				}
				
				if(!isset($postdata['drop_point']) || $postdata['drop_point'] == '')
				{
					$response = array("code"=>0,"msg"=>"Please Select Drop Point");
				}
				else if(!preg_match('/^[ A-Za-z0-9.,-]*$/',$postdata['drop_point']))
				{
					$response = array("code"=>0,"msg"=>"Please Select Valid Drop Point");
				}
				
				// print_r($response);
				// exit;
				if(empty($response))
				{
					$updatedata = array(
									"isweb" => "isweb", 
									"passenger_id" => $this->session->userdata('isuserid'),
									"first_name"=>$postdata['fname'],
									"last_name"=>$postdata['lname'],
									"email_id"=>$postdata['email'],
									"contact_no"=>$postdata['mobile'],
									"contact_no_2"=>"",
									"state"=>"",
									"city"=>""
								);
					$query = http_build_query($updatedata);
					$profiledata = curlnative(EDIT_USER_PROFILE,$query,'array');
					
					$bookdata = json_decode($this->encrypt->decode($this->input->post("xmldata")),true);
					//echo "<pre>";print_r($bookdata); exit;
					$fromcity = $postdata['fcity'];
					$tocity = $postdata['tcity'];
					
					/*
					if($bookdata['package_detail']['firstcity'] == 0)
					{
						$fromcity = $bookdata['package_detail']['secondcity'];
						$tocity = $bookdata['package_detail']['thiredcity'];
					}
					else if($bookdata['package_detail']['secondcity'] == 0)
					{
						$fromcity = $bookdata['package_detail']['firstcity'];
						$tocity = $bookdata['package_detail']['thiredcity'];
					}
					else if($bookdata['package_detail']['thiredcity'] == 0)
					{
						$fromcity = $bookdata['package_detail']['firstcity'];
						$tocity = $bookdata['package_detail']['secondcity'];
					}*/
					
					$name = "";
					$mobile = "";
					
					if($postdata['selfstatus'])
					{
						$name = $postdata['fname']." ".$postdata['lname'];
						$mobile = $postdata['mobile'];
					}
					else
					{
						$name = $postdata['tname'];
						$mobile = $postdata['tphone'];
					}
					
					$bookofferrequest = array(
											"package_id"=>$bookdata['package_detail']['p_id'],
											"b_from_city"=>$fromcity,
											"b_to_city_id"=>$tocity,
											"b_from_time"=>$postdata['triptime'],
											"valid_from_time"=>$bookdata['package_detail']['valid_from_time'],
											"valid_to_time"=>$bookdata['package_detail']['valid_to_time'],
											"b_p_id"=>$this->session->userdata('isuserid'),
											"b_p_name"=>$name,
											"b_p_contact"=>$mobile,
											"b_pickup_point"=>$postdata['pickup_point'],
											"b_drop_point"=>$postdata['drop_point'],
											"b_payment_type"=>3,
											"b_advance"=>0,
											"total_estimated_distance"=>$bookdata['package_detail']['total_distance_km'],
											"total_estimated_time"=>$bookdata['package_detail']['total_time'],
											"b_self_travel_status"=>$postdata['selfstatus'],
											"b_remarks"=>$postdata['note'],
											"payment_id"=>3,
											"total_estimated_rate"=>$bookdata['package_detail']['total_estimated_rate'],			
										);
					$query2 = http_build_query($bookofferrequest);
					$offerrequestdata = curlnative(ONEWAY_OFFER_BOOKING,$query2,'array');
					//echo "<pre>";print_r($bookdata); print_r($profiledata);
				/*	echo "<pre>";
					print_r($offerrequestdata);
					exit;*/
					if($offerrequestdata->error == 0)
					{						
						$data['ticketdetail'] = array(
												"bookingid" => 	$offerrequestdata->message,
												"type" => "onewayoffer",
												"tamount" => $bookdata['package_detail']['total_estimated_rate'],
												"name" => $name,
												"email" => $postdata['email'],
												"mobile" => $mobile,
												"route" => $postdata['fcity']." ".$postdata['tcity'],
												"tdistance" => $bookdata['package_detail']['total_distance_km'],
												"ratekm" => $bookdata['package_detail']['p_extra_km_rate'],
												"ratehr" => $bookdata['package_detail']['p_extra_hr_rate'],
												"totaltime" => $bookdata['package_detail']['total_time'],
												"tax" => $bookdata['package_detail']['final_tax'],
												"categoryname" => $bookdata['package_detail']['category_name'],
												"vehiclename" => $bookdata['package_detail']['vehicle_name'],
												"noseats" => $bookdata['package_detail']['no_of_seats'],
												"pickuppoint" => $postdata['pickup_point'],
												"droppoint" => $postdata['drop_point'],
												"pickuptime" => $postdata['triptime'],
												"pickupdate" => $postdata['date']
											);
						$this->load->view("oneofferbookingdetail",$data);
					}
					else
					{
						$response["code"] = 0;
						$response["msg"] = $offerrequestdata->message;
						$this->output->set_content_type('application/json');
						$this->output->set_output(json_encode($response));
					}
				}
			}
			else
			{
				$response["code"] = 0;
				$response["msg"] = "Somthing Went To Wrong";
				$this->output->set_content_type('application/json');
				$this->output->set_output(json_encode($response));
			}
		}
		else
		{
			$response["code"] = 0;
			$response["msg"] = "Please Retry To Booking This Offer";
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($response));
		}
	}
}