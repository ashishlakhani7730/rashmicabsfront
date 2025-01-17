<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localcheckout extends CI_Controller {
	
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
				$data['fromcitys'] = $this->input->post("fromcitys");
				$data['date'] = $this->input->post("date");
				$data['time'] = $this->input->post("time");
				$data['sub_type_id'] = $this->input->post("sub_type_id");
				if($this->encrypt->decode($this->input->post("xmldata")))
				{
					$checkoutdata = json_decode($this->encrypt->decode($this->input->post("xmldata")),true);
					//echo "<pre>"; print_r($checkoutdata); exit;
					$data["user_detail"] = $checkoutdata['passenger_detail'];
					$data["package_detail"] = $checkoutdata['package_detail'];
					$data["package_terms"] = $checkoutdata['trems'][0]['package_terms'];
					$data["terms_and_conditions"] = $checkoutdata['trems'][0]['terms_and_conditions'];
					$data["privacy_policy"] = $checkoutdata['trems'][0]['privacy_policy'];
					$data["cancellation_terms"] = $checkoutdata['trems'][0]['cancellation_terms'];
					$data["xmldata"] = $this->input->post("xmldata");
					//echo "<pre>";print_r($data); exit;
					$data['bootstrap'] = "bootstrap.js";
					$this->load->view("localcheckout",$data);
				}
			}
		}
		else
		{
			redirect("lists/onewaycablists");
		}
	}
	
	public function receipt()
	{
		if($this->session->tempdata('package') && $this->session->tempdata('book'))
		{
			if(file_exists(FCPATH.'packages/local/'.$this->session->tempdata('package').'.txt'))
			{
				$getpackage = read_file(FCPATH.'packages/local/'.$this->session->tempdata('package').'.txt');
				$postdata = json_decode($getpackage,true);
				$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
				$data['ticketdetail'] = array(
											"bookingid" => $this->session->tempdata('book'),
											"type" => "LOCAL",
											"tamount" => $packagedata['package_detail']['total_estimated_rate'],
											"name" => $postdata['tname'],
											"email" => $postdata['email'],
											"mobile" => $postdata['tphone'],
											"route" => $postdata['fromcity'],									
											"categoryname" => $packagedata['package_detail']['category_name'],
											"vehiclename" => $packagedata['package_detail']['vehicle_name'],
											"noseats" => $packagedata['package_detail']['no_of_seats'],
											"minikm" => $packagedata['package_detail']['p_min_km'],
											"ratekm" => $packagedata['package_detail']['p_extra_km_rate'],
											"minihr" => $packagedata['package_detail']['p_min_hr'],
											"ratehr" => $packagedata['package_detail']['p_extra_hr_rate'],									
											"tax" => $packagedata['package_detail']['final_tax'],
											"pickupdate" => $postdata['date'],
											"pickuptime" => $postdata['time'],
											"pickuppoint" =>  $postdata['pickup_point'],
											"droppoint" => $postdata['drop_point'],
											"adavancepaid" => $packagedata['package_detail']['total_advance_rate'],
											"b_advance" => $packagedata['package_detail']['total_advance_rate']
										);
				$this->load->view("localbookingdetail",$data);
				}
		}
		else
		{
			redirect("Home");
		}
	}
	
	public function offline_book()
	{
		//echo "<pre>"; print_r($this->input->post()); 
		//print_r($this->encrypt->decode($this->input->post('xmldata'))); exit;
		if($this->input->server('REQUEST_METHOD') == 'POST')
		{
			if($this->input->post("selfstatuss") == "1")
			{
				$name=$this->input->post("fname")." ".$this->input->post("lname");
				$mobile=$this->input->post("mobile");
			}
			else
			{
				$name=$this->input->post("tname");
				$mobile=$this->input->post("tphone");
			}
					
			$postdata = $this->input->post(NULL, TRUE);
			//print_r($postdata); exit;
			$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
			$bookdata = array(
							"package_id" => $this->encrypt->decode($postdata['packageid']),
							"sub_type_id" => $postdata['sub_type_id'],
							"b_from_city" => $this->encrypt->decode($postdata['fromcitys']), //id
							"b_from_date" => $postdata['date'],
							"b_from_time" => $postdata['time'],
							"b_p_id" => $packagedata['passenger_detail']['p_id'],
							"b_p_name" => $name,
							"b_p_contact" => $mobile,
							"b_pickup_point" => $postdata['pickup_point'],
							"b_drop_point" => $postdata['drop_point'],
							"b_payment_type" => 2, //cash to rashmicabs payment type.
							"b_advance" => $packagedata['package_detail']['total_advance_rate'],
							"b_night_charge_status" => $packagedata['package_detail']['night_charge_status'],
							"b_self_travel_status" => $postdata['selfstatus'],
							"b_remarks" => $postdata['note'],
							"payment_id" => 0,
							"total_estimated_rate" => $packagedata['package_detail']['total_estimated_rate'],
							);
				//print_r($bookdata); exit;			
				$query2 = http_build_query($bookdata);
				$localbookdata = curlnative(LOCAL_BOOKING,$query2,'array');
				
				if($localbookdata->success == "success")
				{
					$data['ticketdetail'] = array(
												"bookingid" => $localbookdata->message,
												"type" => "LOCAL",
												"tamount" => $packagedata['package_detail']['total_estimated_rate'],
												"name" => $name,
												"email" => $postdata['email'],
												"mobile" => $mobile,
												"route" => $postdata['fromcity'],									
												"categoryname" => $packagedata['package_detail']['category_name'],
												"vehiclename" => $packagedata['package_detail']['vehicle_name'],
												"noseats" => $packagedata['package_detail']['no_of_seats'],
												"minikm" => $packagedata['package_detail']['p_min_km'],
												"ratekm" => $packagedata['package_detail']['p_extra_km_rate'],
												"minihr" => $packagedata['package_detail']['p_min_hr'],
												"ratehr" => $packagedata['package_detail']['p_extra_hr_rate'],									
												"tax" => $packagedata['package_detail']['final_tax'],
												"pickupdate" => $postdata['date'],
												"pickuptime" => $postdata['time'],
												"b_advance" => $packagedata['package_detail']['total_advance_rate'],
												"pickuppoint" =>  $postdata['pickup_point'],
												"droppoint" => $postdata['drop_point'],
												"adavancepaid" => $packagedata['package_detail']['total_advance_rate']
											);
					$this->load->view("localbookingdetail",$data);
				}
		}
		else
		{
			redirect("Home");
		}
	}
}