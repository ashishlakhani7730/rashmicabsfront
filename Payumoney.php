<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payumoney extends CI_Controller
{
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		//echo "<pre>"; print_r($this->input->post()); exit;
		if($this->encrypt->decode($this->input->post("currencyxmldata")))
		{   
			if($this->input->post("oneway") == "oneway")
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
				$filedata = array(
								"fromcity" => $this->input->post("fromcity"),
								"tocity" => $this->input->post("tocity"),
								"fromcitys" => $this->encrypt->decode($this->input->post("fromcitys")),
								"tocitys" => $this->encrypt->decode($this->input->post("tocitys")),
								"date" => $this->input->post("date"),
								"time" => $this->input->post("time"),
								"packageid" => $this->encrypt->decode($this->input->post("packageid")),
								"xmldata" => $this->input->post("xmldata"),
								"fname" => $this->input->post("fname"),
								"lname" => $this->input->post("lname"),
								"email" => $this->input->post("email"),
								"mobile" => $this->input->post("mobile"),
								"selfstatus" => $this->input->post("selfstatuss"),
								"tname" => $name,
								"tphone" => $mobile,
								"pickup_point" => $this->input->post("pickup_point"),
								"drop_point" => $this->input->post("drop_point"),
								"note" => $this->input->post("note")
							);
							$filewrite = json_encode($filedata);
							$date = str_replace("/","-",$this->input->post("date"));
							$time = str_replace(":","-",$this->input->post("time"));
							$udf1 = "oneway".$this->encrypt->decode($this->input->post("packageid")).$this->input->post("fromcity").$this->input->post("tocity").$this->encrypt->decode($this->input->post("fromcitys")).$this->encrypt->decode($this->input->post("tocitys")).$date.$time;
							if (!file_exists(FCPATH.'packages/oneway/'.$udf1.'.txt')){
								write_file(FCPATH.'packages/oneway/'.$udf1.'.txt', $filewrite, 'a');
							}
				$data['action'] 					  = PAYU_LIVE;
				$data['txnid'] 						  = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				$data['amount'] 					  = $this->encrypt->decode($this->input->post("currencyxmldata"));
				$data['firstname'] 					  = $this->input->post("fname");
				$data['email'] 			   			  = $this->input->post("email");
				$data['udf1']				  		  = $udf1;
				$data['phone'] 						  = $this->input->post("mobile");
				$data['productinfo'] 				  = "oneway";
				$data['surl'] 						  = site_url("cabs/success");
				$data['furl'] 						  = site_url("cabs/failure");
				$data['service_provider']  			  = "payu_paisa";
				
				$hash_string = MERCHANT_KEY.'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['productinfo'].'|'.$data['firstname'].'|'.$data['email'].'|'.$data['udf1'].'||||||||||'.SALT;
				$data['hash'] = strtolower(hash('sha512', $hash_string));
				$this->load->view('payumoney',$data);
			}
			else if($this->input->post("roundtrip") == "roundtrip")
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
				$filedata = array(
								"fromcity" => $this->input->post("fromcity"),
								"tocity" => $this->input->post("tocity"),
								"fromcitys" => $this->input->post("fromcitys"),
								"tocitys" => $this->input->post("tocitys"),
								"date1" => $this->input->post("date1"),
								"date2" => $this->input->post("date2"),
								"time" => $this->input->post("time"),
								"packageid" => $this->encrypt->decode($this->input->post("packageid")),
								"xmldata" => $this->input->post("xmldata"),
								"fname" => $this->input->post("fname"),
								"lname" => $this->input->post("lname"),
								"email" => $this->input->post("email"),
								"mobile" => $this->input->post("mobile"),
								"selfstatus" => $this->input->post("selfstatuss"),
								"tname" => $name,
								"tphone" => $mobile,
								"pickup_point" => $this->input->post("pickup_point"),
								"drop_point" => $this->input->post("drop_point"),
								"note" => $this->input->post("note")
							);
							$filewrite = json_encode($filedata);
							$date = str_replace("/","-",$this->input->post("date"));
							$time = str_replace(":","-",$this->input->post("time"));
							$udf1 = "roundtrip".$this->encrypt->decode($this->input->post("packageid")).$this->input->post("fromcity").$this->input->post("tocity").$this->encrypt->decode($this->input->post("fromcitys")).$this->encrypt->decode($this->input->post("tocitys")).$date.$time;
							if (!file_exists(FCPATH.'packages/roundtrip/'.$udf1.'.txt')){
								write_file(FCPATH.'packages/roundtrip/'.$udf1.'.txt', $filewrite, 'a');
							}
				$data['action'] 					  = PAYU_LIVE;
				$data['txnid'] 						  = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				$data['amount'] 					  = $this->encrypt->decode($this->input->post("currencyxmldata"));
				$data['firstname'] 					  = $this->input->post("fname");
				$data['email'] 			   			  = $this->input->post("email");
				$data['udf1']				  		  = $udf1;
				$data['phone'] 						  = $this->input->post("mobile");
				$data['productinfo'] 				  = "roundtrip";
				$data['surl'] 						  = site_url("cabs/success");
				$data['furl'] 						  = site_url("cabs/failure");
				$data['service_provider']  			  = "payu_paisa";
				
				$hash_string = MERCHANT_KEY.'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['productinfo'].'|'.$data['firstname'].'|'.$data['email'].'|'.$data['udf1'].'||||||||||'.SALT;
				$data['hash'] = strtolower(hash('sha512', $hash_string));
				$this->load->view('payumoney',$data);
			}
			else if($this->input->post("multicity") == "multicity")
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
				$filedata = array(
								"fromcity" => $this->input->post("from_city"),
								"tocity" => $this->input->post("tocity"),
								"fromcitys" => $this->input->post("fromcitys"),
								"date1" => $this->input->post("from_date"),
								"date2" => $this->input->post("to_date"),
								"time" => $this->input->post("from_time"),
								"packageid" => $this->encrypt->decode($this->input->post("packageid")),
								"xmldata" => $this->input->post("xmldata"),
								"fname" => $this->input->post("fname"),
								"lname" => $this->input->post("lname"),
								"email" => $this->input->post("email"),
								"mobile" => $this->input->post("mobile"),
								"selfstatus" => $this->input->post("selfstatuss"),
								"tname" => $name,
								"tphone" => $mobile,
								"pickup_point" => $this->input->post("pickup_point"),
								"drop_point" => $this->input->post("drop_point"),
								"note" => $this->input->post("note")
							);
							//echo "<pre>"; print_r($filedata); exit;
							$filewrite = json_encode($filedata);
							$date = str_replace("/","-",$this->input->post("date"));
							$time = str_replace(":","-",$this->input->post("time"));
							$udf1 = "multicity".$this->encrypt->decode($this->input->post("packageid")).$this->input->post("fromcity").$this->input->post("tocity").$this->encrypt->decode($this->input->post("fromcitys")).$this->encrypt->decode($this->input->post("tocitys")).$date.$time;
							if (!file_exists(FCPATH.'packages/multicity/'.$udf1.'.txt')){
								write_file(FCPATH.'packages/multicity/'.$udf1.'.txt', $filewrite, 'a');
							}
				$data['action'] 					  = PAYU_LIVE;
				$data['txnid'] 						  = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				$data['amount'] 					  = $this->encrypt->decode($this->input->post("currencyxmldata"));
				$data['firstname'] 					  = $this->input->post("fname");
				$data['email'] 			   			  = $this->input->post("email");
				$data['udf1']				  		  = $udf1;
				$data['phone'] 						  = $this->input->post("mobile");
				$data['productinfo'] 				  = "multicity";
				$data['surl'] 						  = site_url("cabs/success");
				$data['furl'] 						  = site_url("cabs/failure");
				$data['service_provider']  			  = "payu_paisa";
				
				$hash_string = MERCHANT_KEY.'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['productinfo'].'|'.$data['firstname'].'|'.$data['email'].'|'.$data['udf1'].'||||||||||'.SALT;
				$data['hash'] = strtolower(hash('sha512', $hash_string));
				$this->load->view('payumoney',$data);
			}
			else if($this->input->post("local") == "local")
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
				$filedata = array(
								"fromcity" => $this->input->post("fromcity"),
								"fromcitys" => $this->encrypt->decode($this->input->post("fromcitys")),
								"date" => $this->input->post("date"),
								"time" => $this->input->post("time"),
								"sub_type_id" => $this->input->post("sub_type_id"),
								"packageid" => $this->encrypt->decode($this->input->post("packageid")),
								"xmldata" => $this->input->post("xmldata"),
								"fname" => $this->input->post("fname"),
								"lname" => $this->input->post("lname"),
								"email" => $this->input->post("email"),
								"mobile" => $this->input->post("mobile"),
								"selfstatus" => $this->input->post("selfstatuss"),
								"tname" => $name,
								"tphone" => $mobile,
								"pickup_point" => $this->input->post("pickup_point"),
								"drop_point" => $this->input->post("drop_point"),
								"note" => $this->input->post("note")
							);
							$filewrite = json_encode($filedata);
							$date = str_replace("/","-",$this->input->post("date"));
							$time = str_replace(":","-",$this->input->post("time"));
							$udf1 = "local".$this->encrypt->decode($this->input->post("packageid")).$this->input->post("fromcity").$this->encrypt->decode($this->input->post("fromcitys")).$date.$time;
							if (!file_exists(FCPATH.'packages/local/'.$udf1.'.txt')){
								write_file(FCPATH.'packages/local/'.$udf1.'.txt', $filewrite, 'a');
							}
				$data['action'] 					  = PAYU_LIVE;
				$data['txnid'] 						  = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
				$data['amount'] 					  = $this->encrypt->decode($this->input->post("currencyxmldata"));
				$data['firstname'] 					  = $this->input->post("fname");
				$data['email'] 			   			  = $this->input->post("email");
				$data['udf1']				  		  = $udf1;
				$data['phone'] 						  = $this->input->post("mobile");
				$data['productinfo'] 				  = "local";
				$data['surl'] 						  = site_url("cabs/success");
				$data['furl'] 						  = site_url("cabs/failure");
				$data['service_provider']  			  = "payu_paisa";
				
				$hash_string = MERCHANT_KEY.'|'.$data['txnid'].'|'.$data['amount'].'|'.$data['productinfo'].'|'.$data['firstname'].'|'.$data['email'].'|'.$data['udf1'].'||||||||||'.SALT;
				$data['hash'] = strtolower(hash('sha512', $hash_string));
				$this->load->view('payumoney',$data);
			}
		}
		else
		{
			redirect("Home");
		}
	}
	
	
	public function redirectTosuccess() //redirectTosuccess()
	{
		//echo "<pre>"; print_r($this->input->post()); exit;
		if($this->input->post("mihpayid") && $this->input->post("txnid"))
		{
			if($this->input->post("productinfo") && $this->input->post("productinfo") == "oneway")
			{
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$getpackage = read_file(FCPATH.'packages/oneway/'.$this->input->post("udf1").'.txt');
					$postdata = json_decode($getpackage,true);
					$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
					//echo "<pre>"; print_r($packagedata); exit;
					$bookdata = array(
								"package_id" => $postdata['packageid'],
								"b_from_city" => $postdata['fromcitys'],
								"b_to_city_id" => $postdata['tocitys'],
								"b_from_date" => $postdata['date'],
								"b_from_time" => $postdata['time'],
								"b_p_id" => $packagedata['passenger_detail']['p_id'],
								"b_p_name" => $postdata['tname'],
								"b_p_contact" => $postdata['tphone'],
								"b_pickup_point" => $postdata['pickup_point'],
								"b_drop_point" => $postdata['drop_point'],
								"b_payment_type" => 1,
								"b_advance" => $packagedata['package_detail']['total_advance_rate'],
								"chargeable_km" => $packagedata['package_detail']['chargeable_km'],
								"total_estimated_distance" => $packagedata['package_detail']['total_distance_km'],
								"b_night_charge_status" => $packagedata['package_detail']['night_charge_status'],
								"b_self_travel_status" => $postdata['selfstatus'],
								"b_remarks" => $postdata['note'],
								"payment_id" => $this->input->post("payuMoneyId"),
								"total_estimated_rate" => $packagedata['package_detail']['total_estimated_rate'],
								);
							//	echo "<pre>"; print_r($bookdata); exit;
					$query2 = http_build_query($bookdata);
					$onewaybookdata = curlnative(ONEWAY_BOOKING,$query2,'array');
					//echo "<pre>"; print_r($onewaybookdata); exit();
					if($onewaybookdata->success == "success")
					{
						$this->session->set_tempdata("package",$this->input->post("udf1"),600);
						$this->session->set_tempdata("book",$onewaybookdata->message,600);
						redirect("oneway/receipt");
					}
					//print_r($onewaybookdata); exit;
				}
			}
			else if($this->input->post("productinfo") && $this->input->post("productinfo") == "multicity")
			{
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$getpackage = read_file(FCPATH.'packages/multicity/'.$this->input->post("udf1").'.txt');
					$postdata = json_decode($getpackage,true);
					$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
					//echo "<pre>"; print_r($postdata); exit;
					$bookdata = array(
								"package_id" => $postdata['packageid'],
								"b_from_city" => $postdata['fromcity'],
								"b_to_city" => $postdata['tocity'],
								"b_from_date" => $postdata['date1'],
								"b_to_date" => $postdata['date2'],
								"b_from_time" => $postdata['time'],
								"b_p_id" => $packagedata['passenger_detail']['p_id'],
								"b_p_name" => $postdata['tname'],
								"b_p_contact" => $postdata['tphone'],
								"b_pickup_point" => $postdata['pickup_point'],
								"b_drop_point" => $postdata['drop_point'],
								"b_payment_type" => 1,
								"b_advance" => $packagedata['package_detail']['total_advance_rate'],
								"chargeable_km" => $packagedata['package_detail']['chargeable_km'],
								"total_estimated_distance" => $packagedata['package_detail']['total_distance_km'],
								"b_night_charge_status" => $packagedata['package_detail']['night_charge_status'],
								"b_self_travel_status" => $postdata['selfstatus'],
								"b_remarks" => $postdata['note'],
								"payment_id" => $this->input->post("payuMoneyId"),
								"total_estimated_rate" => $packagedata['package_detail']['total_estimated_rate'],
								);
								//echo "<pre>"; print_r($bookdata); exit;
					$query2 = http_build_query($bookdata);
					$multicitybookdata = curlnative(MULTICITY_BOOKING,$query2,'array');
					
					if($multicitybookdata->success == "success")
					{
						$this->session->set_tempdata("package",$this->input->post("udf1"),600);
						$this->session->set_tempdata("book",$multicitybookdata->message,600);
						redirect("multicity/receipt");
					}
				}
			}
			else if($this->input->post("productinfo") && $this->input->post("productinfo") == "roundtrip")
			{
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$getpackage = read_file(FCPATH.'packages/roundtrip/'.$this->input->post("udf1").'.txt');
					$postdata = json_decode($getpackage,true);
					$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
					//echo "<pre>"; print_r($postdata); exit;
					$bookdata = array(
								"package_id" => $postdata['packageid'],
								"b_from_city" => $postdata['fromcitys'],
								"b_to_city" => $postdata['tocitys'],
								"b_from_date" => $postdata['date1'],
								"b_to_date" => $postdata['date2'],
								"b_from_time" => $postdata['time'],
								"b_p_id" => $packagedata['passenger_detail']['p_id'],
								"b_p_name" => $postdata['tname'],
								"b_p_contact" => $postdata['tphone'],
								"b_pickup_point" => $postdata['pickup_point'],
								"b_drop_point" => $postdata['drop_point'],
								"b_payment_type" => 1,
								"b_advance" => $packagedata['package_detail']['total_advance_rate'],
								"chargeable_km" => $packagedata['package_detail']['chargeable_km'],
								"total_estimated_distance" => $packagedata['package_detail']['total_distance_km'],
								"b_night_charge_status" => $packagedata['package_detail']['night_charge_status'],
								"b_self_travel_status" => $postdata['selfstatus'],
								"b_remarks" => $postdata['note'],
								"payment_id" => $this->input->post("payuMoneyId"),
								"total_estimated_rate" => $packagedata['package_detail']['total_estimated_rate'],
								);
								//echo "<pre>"; print_r($bookdata); exit;
					$query2 = http_build_query($bookdata);
					$roundtripbookdata = curlnative(ROUNDTRIP_BOOKING,$query2,'array');
					
					if($roundtripbookdata->success == "success")
					{
						$this->session->set_tempdata("package",$this->input->post("udf1"),600);
						$this->session->set_tempdata("book",$roundtripbookdata->message,600);
						redirect("roundtrip/receipt");
					}
				}
			}
			else if($this->input->post("productinfo") && $this->input->post("productinfo") == "local")
			{
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$getpackage = read_file(FCPATH.'packages/local/'.$this->input->post("udf1").'.txt');
					$postdata = json_decode($getpackage,true);
					$packagedata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
					//echo "<pre>"; print_r($postdata); exit;
					$bookdata = array(
								"package_id" => $postdata['packageid'],
								"sub_type_id" => $postdata['sub_type_id'],
								"b_from_city" => $postdata['fromcitys'], //id
								"b_from_date" => $postdata['date'],
								"b_from_time" => $postdata['time'],
								"b_p_id" => $packagedata['passenger_detail']['p_id'],
								"b_p_name" => $postdata['tname'],
								"b_p_contact" => $postdata['tphone'],
								"b_pickup_point" => $postdata['pickup_point'],
								"b_drop_point" => $postdata['drop_point'],
								"b_payment_type" => 1,
								"b_advance" => $packagedata['package_detail']['total_advance_rate'],
								"b_night_charge_status" => $packagedata['package_detail']['night_charge_status'],
								"b_self_travel_status" => $postdata['selfstatus'],
								"b_remarks" => $postdata['note'],
								"payment_id" => $this->input->post("payuMoneyId"),
								"total_estimated_rate" => $packagedata['package_detail']['total_estimated_rate'],
								);
								
					$query2 = http_build_query($bookdata);
					$onewaybookdata = curlnative(LOCAL_BOOKING,$query2,'array');
					
					if($onewaybookdata->success == "success")
					{
						$this->session->set_tempdata("package",$this->input->post("udf1"),600);
						$this->session->set_tempdata("book",$onewaybookdata->message,600);
						redirect("local/receipt");
					}
					//print_r($onewaybookdata); exit;
				}
			}
		}
	}

	public function redirectTofail()
	{
		if($this->input->post("mihpayid") && $this->input->post("txnid"))
		{
			if($this->input->post("productinfo") && $this->input->post("productinfo") == "oneway")
			{
				$getpackage = read_file(FCPATH.'packages/oneway/'.$this->input->post("udf1").'.txt');
				$postdata = json_decode($getpackage,true);
				
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$data['fromcity'] = $postdata["fromcity"];
					$data['tocity'] = $postdata["tocity"];
					$data['fromcitys'] = $postdata["fromcitys"];
					$data['tocitys'] = $postdata["tocitys"];
					$data['date'] = $postdata["date"];
					$data['time'] = $postdata["time"];
					$data['notice'] = 1;
					if($this->encrypt->decode($postdata["xmldata"]))
					{
						$checkoutdata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
						$data["user_detail"] = $checkoutdata['passenger_detail'];
						$data["package_detail"] = $checkoutdata['package_detail'];
						$data["xmldata"] = $postdata["xmldata"];
						//echo "<pre>";print_r($data); exit;
						$data['bootstrap'] = "bootstrap.js";
						$this->load->view("onewaycheckout",$data);
					}
				}
			}
			else if($this->input->post("productinfo") && $this->input->post("productinfo") == "roundtrip")
			{
				$getpackage = read_file(FCPATH.'packages/roundtrip/'.$this->input->post("udf1").'.txt');
				$postdata = json_decode($getpackage,true);
				
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$data['fromcity'] = $postdata["fromcity"];
					$data['tocity'] = $postdata["tocity"];
					$data['fromcitys'] = $postdata["fromcitys"];
					$data['tocitys'] = $postdata["tocitys"];
					$data['date'] = $postdata["date"];
					$data['time'] = $postdata["time"];
					$data['notice'] = 1;
					if($this->encrypt->decode($postdata["xmldata"]))
					{
						$checkoutdata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
						$data["user_detail"] = $checkoutdata['passenger_detail'];
						$data["package_detail"] = $checkoutdata['package_detail'];
						$data["xmldata"] = $postdata["xmldata"];
						//echo "<pre>";print_r($data); exit;
						$data['bootstrap'] = "bootstrap.js";
						$this->load->view("onewaycheckout",$data);
					}
				}
			}
			else if($this->input->post("productinfo") && $this->input->post("productinfo") == "local")
			{
				$getpackage = read_file(FCPATH.'packages/local/'.$this->input->post("udf1").'.txt');
				$postdata = json_decode($getpackage,true);
				
				if($this->session->userdata('isuserid') && $this->session->userdata('isuserpid') && $this->session->userdata('isusername'))
				{
					$data['fromcity'] = $postdata["fromcity"];
					$data['fromcitys'] = $postdata["fromcitys"];	
					$data['date'] = $postdata["date"];
					$data['time'] = $postdata["time"];
					$data['sub_type_id'] = $postdata["sub_type_id"];
					$data['notice'] = 1;
					if($this->encrypt->decode($postdata["xmldata"]))
					{
						$checkoutdata = json_decode($this->encrypt->decode($postdata["xmldata"]),true);
						$data["user_detail"] = $checkoutdata['passenger_detail'];
						$data["package_detail"] = $checkoutdata['package_detail'];
						$data["xmldata"] = $postdata["xmldata"];
						//echo "<pre>";print_r($data); exit;
						$data['bootstrap'] = "bootstrap.js";
						$this->load->view("localcheckout",$data);
					}
				}
			}
		}
		else
		{
			redirect("Home");
		}
	}
}