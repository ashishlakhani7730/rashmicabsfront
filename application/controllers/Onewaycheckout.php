<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onewaycheckout extends CI_Controller {
	
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
				$data['fromcitys'] = $this->input->post("fromcitys");
				$data['tocitys'] = $this->input->post("tocitys");
				$data['date'] = $this->input->post("date");
				$data['time'] = $this->input->post("time");
				if($this->encrypt->decode($this->input->post("xmldata")))
				{
					$checkoutdata = json_decode($this->encrypt->decode($this->input->post("xmldata")),true);
					$data["user_detail"] = $checkoutdata['passenger_detail'];
					$data["package_detail"] = $checkoutdata['package_detail'];
					$query ="";
					$getregister = curlnative(T_ONEWAYOFFER,$query,'json');
					$checkoutdata = json_decode($getregister,true);
					$data["package_terms"] = $checkoutdata['trems'][0]['package_terms'];
					$data["terms_and_conditions"] = $checkoutdata['trems'][0]['terms_and_conditions'];
					$data["privacy_policy"] = $checkoutdata['trems'][0]['privacy_policy'];
					$data["cancellation_terms"] = $checkoutdata['trems'][0]['cancellation_terms'];
					$data["xmldata"] = $this->input->post("xmldata");
					//echo "<pre>";print_r($data); exit;
					$data['bootstrap'] = "bootstrap.js";
					$this->load->view("onewaycheckout",$data);
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
			if(file_exists(FCPATH.'packages/oneway/'.$this->session->tempdata('package').'.txt'))
			{
				$getpackage = read_file(FCPATH.'packages/oneway/'.$this->session->tempdata('package').'.txt');
				$postdata = json_decode($getpackage,true);
				$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
				$data['ticketdetail'] = array(
											"bookingid" => $this->session->tempdata('book'),
											"type" => "ONEWAY",
											"tamount" => $packagedata['package_detail']['total_estimated_rate'],
											"name" => $postdata['tname'],
											"email" => $postdata['email'],
											"mobile" => $postdata['tphone'],
											"route" => $postdata['fromcity']." - ".$postdata['tocity'],									
											"categoryname" => $packagedata['package_detail']['category_name'],
											"vehiclename" => $packagedata['package_detail']['vehicle_name'],
											"noseats" => $packagedata['package_detail']['no_of_seats'],
											"tdistance" => $packagedata['package_detail']['total_distance_km'],
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
				$this->load->view("onewaybookingdetail",$data);
			}
		}
		else
		{
			redirect("Home");
		}
	}
	
	public function offline_book()
	{
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
								"b_from_city" => $this->encrypt->decode($postdata['fromcitys']),
								"b_to_city_id" => $this->encrypt->decode($postdata['tocitys']),
								"b_from_date" => $postdata['date'],
								"b_from_time" => $postdata['time'],
								"b_p_id" => $packagedata['passenger_detail']['p_id'],
								"b_p_name" => $name,
								"b_p_contact" => $mobile,
								"b_pickup_point" => $postdata['pickup_point'],
								"b_drop_point" => $postdata['drop_point'],
								"b_payment_type" => 2,
								"b_advance" => $packagedata['package_detail']['total_advance_rate'],
								"chargeable_km" => $packagedata['package_detail']['chargeable_km'],
								"total_estimated_distance" => $packagedata['package_detail']['total_distance_km'],
								"b_night_charge_status" => $packagedata['package_detail']['night_charge_status'],
								"b_self_travel_status" => $postdata['selfstatuss'],
								"b_remarks" => $postdata['note'],
								"payment_id" => 0,
								"total_estimated_rate" => $packagedata['package_detail']['total_estimated_rate'],
								);
								//echo "<pre>"; print_r($bookdata);
					$query2 = http_build_query($bookdata);
					$onewaybookdata = curlnative(ONEWAY_BOOKING,$query2,'array');
					
					if($onewaybookdata->success == "success")
					{
						$data['ticketdetail'] = array(
											"bookingid" => $onewaybookdata->message,
											"type" => "ONEWAY",
											"tamount" => $packagedata['package_detail']['total_estimated_rate'],
											"name" => $name,
											"email" => $postdata['email'],
											"mobile" => $mobile,
											"route" => $postdata['fromcity']." - ".$postdata['tocity'],									
											"categoryname" => $packagedata['package_detail']['category_name'],
											"vehiclename" => $packagedata['package_detail']['vehicle_name'],
											"noseats" => $packagedata['package_detail']['no_of_seats'],
											"tdistance" => $packagedata['package_detail']['total_distance_km'],
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
										$this->load->view("onewaybookingdetail",$data);
					}
		}
	}
}