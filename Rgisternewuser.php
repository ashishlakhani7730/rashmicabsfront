<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rgisternewuser extends CI_Controller 
{
	
	function __construct()
    {
        parent::__construct();
        $this->load->model('General_data');
	    $this->load->model('Sms_email');
	}
	
	public function index()
	{
		
	}
	
	public function getonewayoffer()
	{
		$tid = intval(1);	

		$this->db->select("*");
		$this->db->from("booking_terms");
		$this->db->where("id",$tid);
		$query = $this->db->get();
		$treams = $query->result();
		
		if($treams)
		{
			$response=array('code'=>1,'trems'=>$treams);
		}
		else
		{
			$response=array('code'=>0,'msg'=>'call to rashmicabs');
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}
	
	public function getoneway()
	{
		$tid = intval(2);	

		$this->db->select("*");
		$this->db->from("booking_terms");
		$this->db->where("id",$tid);
		$query = $this->db->get();
		$treams = $query->result();
		
		if($treams)
		{
			$response=array('code'=>1,'trems'=>$treams);
		}
		else
		{
			$response=array('code'=>0,'msg'=>'call to rashmicabs');
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}
	
	public function getmuticity()
	{
		$tid = intval(3);	

		$this->db->select("*");
		$this->db->from("booking_terms");
		$this->db->where("id",$tid);
		$query = $this->db->get();
		$treams = $query->result();
		
		if($treams)
		{
			$response=array('code'=>1,'trems'=>$treams);
		}
		else
		{
			$response=array('code'=>0,'msg'=>'call to rashmicabs');
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}
	
	public function getroundtrip()
	{
		$tid = intval(4);	

		$this->db->select("*");
		$this->db->from("booking_terms");
		$this->db->where("id",$tid);
		$query = $this->db->get();
		$treams = $query->result();
		
		if($treams)
		{
			$response=array('code'=>1,'trems'=>$treams);
		}
		else
		{
			$response=array('code'=>0,'msg'=>'call to rashmicabs');
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}
	
	public function getlocal()
	{
		$tid = intval(5);	

		$this->db->select("*");
		$this->db->from("booking_terms");
		$this->db->where("id",$tid);
		$query = $this->db->get();
		$treams = $query->result();
		
		if($treams)
		{
			$response=array('code'=>1,'trems'=>$treams);
		}
		else
		{
			$response=array('code'=>0,'msg'=>'call to rashmicabs');
		}
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}

	public function getregisternewdetail()
	{
		date_default_timezone_set('Asia/Kolkata');
		$passenger_detail = array();
		if($this->input->post('newpackage') && $this->input->post('newpackage') != '' && $this->input->post('mobile') && $this->input->post('mobile') != '' && $this->input->post('type') && $this->input->post('type') != '')
		{
			$mobile = $this->input->post('mobile');
			$this->db->select("*")->from("passenger_list")->where("(p_contact = '$mobile' OR p_contact_2 = '$mobile')");
			$que = $this->db->get();
			$passenger = $que->row_array();
			
			if(!empty($passenger))
			{
				$passenger_detail["p_id"] =      $passenger['id'];
				$passenger_detail["p_p_id"] =    $passenger['p_id'];
				$passenger_detail["fullname"] =  $passenger['p_full_name'];
				$passenger_detail["firstname"] = $passenger['p_f_name'];
				$passenger_detail["lastname"] =  $passenger['p_l_name'];
				$passenger_detail["contact1"] =  $passenger['p_contact'];
				$passenger_detail["contact2"] =  $passenger['p_contact_2'];
				$passenger_detail["email"] =     $passenger['p_email_id'];
				$passenger_detail["state"] =     $passenger['p_state'];
				$passenger_detail["city"] =      $passenger['p_city'];
			}
			else
			{
				$password = random_string('alnum', 8);
				
				$passenger_detail_array = array(
												'p_type'=>'Online',

												'p_contact'=>$this->input->post('mobile'),

												'p_password'=>md5($this->input->post('mobile')),

												'p_status'=>1,

												'p_joining_date_time'=>date("Y-m-d H:i:s"),

												'p_created_by'=>-1
										  );
				
				$this->db->insert('passenger_list',$passenger_detail_array);
				
				$get_last_id=$this->db->insert_id();
				
				$this->General_data->update_id('passenger_list','RCP'.date('Y').date('m'),'p_id');
				
				
				$message = 'Thank You For Registration In Rashmi cabs Your USERNAME IS-'.$this->input->post('mobile').' and PASSWORD IS -'.$this->input->post('mobile').' Call Rashmi Cabs on +91 9974234111 for any help.';
				
				$this->Sms_email->send_sms($this->input->post('mobile'),$message); 
				
				$this->db->select("*")->from("passenger_list")->where("id",$get_last_id);
				$querys = $this->db->get();
				$passenger = $querys->result();
				
				$passenger_detail["p_id"] =      $passenger[0]->id;
				$passenger_detail["p_p_id"] =    $passenger[0]->p_id;
				$passenger_detail["fullname"] =  $passenger[0]->p_full_name;
				$passenger_detail["firstname"] = $passenger[0]->p_f_name;
				$passenger_detail["lastname"] =  $passenger[0]->p_l_name;
				$passenger_detail["contact1"] =  $passenger[0]->p_contact;
				$passenger_detail["contact2"] =  $passenger[0]->p_contact_2;
				$passenger_detail["email"] =     $passenger[0]->p_email_id;
				$passenger_detail["state"] =     $passenger[0]->p_state;
				$passenger_detail["city"] =      $passenger[0]->p_city;
				
				/*$passenger_detail['passenger'] = array(
													"p_id"=>$passenger[0]->id,
													"p_p_id"=>$passenger[0]->p_id,
													"fullname"=>$passenger[0]->p_full_name,
													"firstname"=>$passenger[0]->p_f_name,
													"lastname"=>$passenger[0]->p_l_name,
													"contact1"=>$passenger[0]->p_contact,
													"contact2"=>$passenger[0]->p_contact_2,
													"email"=>$passenger[0]->p_email_id,
													"state"=>$passenger[0]->p_state,
													"city"=>$passenger[0]->p_city,
												 );
				*/
			}
			
			if(!empty($passenger_detail))
			{
				if($this->input->post('type') == "onewayoffer")
				{
					$data = $this->db->get_where('oneway_offer_detail',array('id'=>$this->input->post('newpackage')))->result();
					
					if($data[0]->oo_first_city != 0)
					{
						$from_city = $this->db->get_where('city_detail',array('id'=>$data[0]->oo_second_city))->row();
						$to_city = $this->db->get_where('city_detail',array('id'=>$data[0]->oo_third_city))->row();
					}
					else if($data[0]->oo_second_city != 0)
					{
						$from_city = $this->db->get_where('city_detail',array('id'=>$data[0]->oo_first_city))->row();
						$to_city = $this->db->get_where('city_detail',array('id'=>$data[0]->oo_third_city))->row();
					}
					else if($data[0]->oo_third_city != 0)
					{
						$from_city = $this->db->get_where('city_detail',array('id'=>$data[0]->oo_first_city))->row();
						$to_city = $this->db->get_where('city_detail',array('id'=>$data[0]->oo_second_city))->row();
					}
					
					$from_city = $from_city->c_name." , ".$from_city->c_state;

					$to_city = $to_city->c_name." , ".$to_city->c_state;
					
					$total_distance_km = $this->General_data->distance($from_city, $to_city);
					
					$total_time = $this->General_data->time_interval($from_city, $to_city);
					
					$total_time = $total_time + 1;
				
					$package_detail=array();
					
					foreach($data as $i => $d)
					{

						$no_of_seats = $this->db->get_where('vehicle_detail',array('id'=>$d->oo_vt_id))->row()->v_seat_number;
						
						
						$km_rate = $d->oo_km_rate * $total_distance_km;

						$total_estimated_rate =  $km_rate;
						

						$package_detail[$i]['category_name'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->oo_vc_id))->row()->category_name;		

						$package_detail[$i]['vehicle_name'] = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->oo_vc_id))->row()->v_name;	

						$package_detail[$i]['no_of_seats'] = $no_of_seats;

						$package_detail[$i]['p_id'] = $d->id;

						//$package_detail[$i]['total_days'] = $total_days;

						$package_detail[$i]['total_distance_km'] = $total_distance_km;

						$package_detail[$i]['p_extra_km_rate'] = $d->oo_km_rate;

						$package_detail[$i]['p_extra_hr_rate'] = $d->oo_hr_rate;

						$package_detail[$i]['total_time'] = $total_time;

						$package_detail[$i]['total_estimated_rate'] = $total_estimated_rate;

						$package_detail[$i]['valid_from_time'] = $d->oo_valid_from_time;

						$package_detail[$i]['valid_to_time'] = $d->oo_valid_to_time;

						$package_detail[$i]['total_advance_rate'] = 0;
						
						$package_detail[$i]['final_tax'] = "Additional Gov. Tax GST, Toll, Parking, State Tax Charge will be remain.";//$final_tax;
						
						

						$vehicle_list=$this->db->get_where('vehicle_list',array('id'=>$d->oo_vehicle_id))->row();

						

						$package_detail[$i]['v_profile_pic'] = '';

						$package_detail[$i]['v_profile_pic_path'] = '';

						if(!empty($vehicle_list) && !empty($vehicle_list->v_profile_pic)){

							$package_detail[$i]['v_profile_pic'] = $vehicle_list->v_profile_pic;

							$package_detail[$i]['v_profile_pic_path'] = base_url().'uploads/vehicle/profile_pic/'.$vehicle_list->v_profile_pic; 

						}else{

							$vehicle_category=$this->db->get_where('vehicle_category_detail',array('id'=>$d->oo_vc_id))->row();

							if(!empty($d->p_v_category) && !empty($vehicle_category) && !empty($vehicle_category->c_profile_pic)){

								$package_detail[$i]['v_profile_pic']=$vehicle_category->c_profile_pic;

								$package_detail[$i]['v_profile_pic_path'] =base_url().'uploads/category/profile_pic/'.$vehicle_category->c_profile_pic;

							}

						}
					}
					
				}
				else if($this->input->post('type') == "oneway")
				{
					if($this->input->post('from_time') != '')
					{
						$data =$this->db->get_where('package_detail',array('id'=>$this->input->post('newpackage')))->result();
				
						$from_city = $this->db->get_where('city_detail',array('id'=>$data[0]->p_from_city))->row();
						$from_city = $from_city->c_name." , ".$from_city->c_state;
									
						$to_city = $this->db->get_where('city_detail',array('id'=>$data[0]->p_to_city))->row();
						$to_city = $to_city->c_name." , ".$to_city->c_state;
						
							
						$total_distance_km = $this->General_data->distance($from_city, $to_city);	
							
						$i=1;
						$total=0;	
					
						$package_detail=array();
							
						foreach($data as $i => $d)
						{
							
							$max_seats = $this->db->select_max('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
										
							$min_seats = $this->db->select_min('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
							
							if($max_seats == $min_seats)
							{
								$no_of_seats = $max_seats->v_seat_number;
							}
							
							else
							{
								$no_of_seats=$min_seats->v_seat_number.' - '.$max_seats->v_seat_number;	
							}
							
							

							$date = new DateTime($this->input->post('from_time'));
							$dt2=$date->format('G');	
					
							if($dt2==24 or $dt2==1 or $dt2==2 or $dt2==3 or $dt2==4 or $dt2==5 or $dt2==0 )
							{
								$night=$d->p_night_charge;
								$n='';
								$night_charge_status=1;
						
							}
							else
							{
								$night=0;
								$n='<span class="text-danger">Not Applied</span>';
								$night_charge_status=0;
							}
					
							$total_days = 1;
						
							if(($d->p_min_km * $total_days ) > $total_distance_km)
							{
								$estimate_fare_rate = ($d->p_min_km * $total_days) * ($d->p_extra_km_rate);
							}
							else
							{
								$estimate_fare_rate = ($total_distance_km) * ($d->p_extra_km_rate);	
							}
					
							$estimate_fare_rate=$d->p_rate;
					
							if($d->p_discount_type==0)
							{
								$discount = $d->p_discount." %";
								$discount_convert =  ($estimate_fare_rate * $d->p_discount)/100;
								$discount_show = $discount_convert." (".$discount.")";
							}
							else
							{
								$discount = "Rs. ".$d->p_discount;
								$discount_convert = $d->p_discount;
								$discount_show = $discount_convert;
							}
					 
							$km_rate = $estimate_fare_rate;
					
						
							$total_estimated_rate =  $km_rate - $discount_convert;
							
					 
							if($d->p_advance_type==0)
							{
								$total_advance_rate =  ($d->p_advance * $total_estimated_rate)/100;
							}
							else
							{
								$total_advance_rate = $d->p_advance;
							}
					  
					  
							$total_estimated_rate = $total_estimated_rate + $night + ($total_days *$d->p_driver_allowance);
					
							$tax=array();
					
							if($d->p_tax_on_package != 0)
							{
									 $tax_arr = explode(',',$d->p_tax_on_package);
									 
									 foreach($tax_arr as $ar)
									 {
										$tax[] = $this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_name.'  '.$this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_value.'%';
									 }
									 
									 $final_tax = implode(" , ",$tax);
							}
							else
							{
								$final_tax = 'Tax Not Applicable';		
							}
							$package_detail[$i]['test']=$tax;
							//echo '<tr class="cablisting"><th width="30%">'.$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name.'<br>'.$vehicle_name = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name.'</th><th >'.$no_of_seats.'</th><th> Rs. '.$d->p_extra_km_rate.'</th><th><button type="button" class="btn btn-info popovers" rel="popover" data-trigger="hover" data-total-days="'.$total_days.'" data-total-distance="'.number_format($total_distance_km).'" data-discount="'.$discount_show.'" data-estimate-fare-rate="'.number_format($estimate_fare_rate).'" data-min-km="'.number_format($total_days * $d->p_min_km).'" data-rate-per-km="'.$d->p_extra_km_rate.'" data-min-hr="'.$d->p_min_hr.'" data-rate-per-hr="'.$d->p_extra_hr_rate.'" data-night-charge="'.number_format($night).'" data-driver-allowance="'.number_format($total_days * $d->p_driver_allowance).'" data-tax="'.$final_tax.'" data-driver-allowance-per-day="'.$d->p_driver_allowance.'" data-estimated-rate="'.number_format($total_estimated_rate).'" data-advance="'.number_format($total_advance_rate).'">Rs. '.number_format($total_estimated_rate).'</button><input type="hidden" id="availabe_advance" value="'.number_format($total_advance_rate).'"/><input type="hidden" id="available_night_charge_status" value="'.$night_charge_status.'"/></th><th > <a href="javascript:;" class="btn yellow-crusta button-next" onclick="book_package('.$d->id.','.$total_advance_rate.','.$total_distance_km.','.$estimate_fare_rate.','.$total_days.','.$total_estimated_rate.')" ><i class="fa fa-cab"></i> BOOK CAB </a></th></tr>';
							
							$package_detail[$i]['category_name'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name;		
							$package_detail[$i]['vehicle_name'] = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name;	
							$package_detail[$i]['no_of_seats'] = $no_of_seats;
							$package_detail[$i]['p_id'] = $d->id;
							$package_detail[$i]['total_days'] = $total_days;
							$package_detail[$i]['total_distance_km'] = $total_distance_km;
							$package_detail[$i]['discount'] = $discount_show;
							$package_detail[$i]['estimate_fare_rate'] = $estimate_fare_rate;
							$package_detail[$i]['p_min_km'] = $total_days * $d->p_min_km;
							$package_detail[$i]['p_extra_km_rate'] = $d->p_extra_km_rate;
							$package_detail[$i]['p_min_hr'] = $d->p_min_hr;
							$package_detail[$i]['p_extra_hr_rate'] = $d->p_extra_hr_rate;
							$package_detail[$i]['night_charge'] = $night;
							$package_detail[$i]['night_charge_status'] = $night_charge_status;
							$package_detail[$i]['p_driver_allowance'] = $total_days * $d->p_driver_allowance;
							$package_detail[$i]['driver_allowance_per_day'] = $d->p_driver_allowance;
							$package_detail[$i]['chargeable_km'] = $estimate_fare_rate;
							$package_detail[$i]['final_tax'] = "Additional Gov. Tax GST, Toll, Parking, State Tax Charge will be remain.";//$final_tax;
							$package_detail[$i]['total_estimated_rate'] = $total_estimated_rate;
							$package_detail[$i]['total_advance_rate'] = $total_advance_rate;
							
							
							$package_detail[$i]['v_profile_pic'] = '';
							$package_detail[$i]['v_profile_pic_path'] = '';
							$vehicle_category=$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row();
							if(!empty($d->p_v_category) && !empty($vehicle_category) && !empty($vehicle_category->c_profile_pic)){
								$package_detail[$i]['v_profile_pic']=$vehicle_category->c_profile_pic;
								$package_detail[$i]['v_profile_pic_path'] =base_url().'uploads/category/profile_pic/'.$vehicle_category->c_profile_pic;
							}
							
							
							
							//$total=$i;
							//$i++;
							
						}
						
					}
				}
				else if($this->input->post('type') == "roundtrip")
				{
					if(isset($_POST['from_city']) && isset($_POST['b_to_city']) && isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['start_time']))
					{	
	
						$all_to_city = explode(' - ',$this->input->post('b_to_city'));
						  
						$this->load->model('General_data');
						   
						$total_distance_km = 0;
						 
						$last_city="";		 
							
						for($i=0;$i<count($all_to_city);$i++)
						{
							if($i==0)
							{
								$from_city = $this->db->get_where('city_detail',array('id'=>$this->input->post('from_city')))->row();
								$from_city = $from_city->c_name." , ".$from_city->c_state;
							}
							else
							{
								$from_city = $all_to_city[$i-1];
							}
										
							$to_city = $all_to_city[$i];					
										
							$total_distance_km =  $total_distance_km  +  $this->General_data->distance($from_city, $to_city);
										
							$last_city = $to_city;
									
						}
									
						$total_distance_km = 2 * $total_distance_km;
						
									
						$data = $this->db->get_where('package_detail',array('p_sub_type'=>3,'id'=>$this->input->post('newpackage')))->result();	
						$i=1;
						$total=0;	
					
						$package_detail=array();	
						
						
						foreach($data as $i => $d)
						{
							$max_seats = $this->db->select_max('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
										
							$min_seats = $this->db->select_min('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
								
								
							if($max_seats == $min_seats)
							{
								$no_of_seats = $max_seats->v_seat_number;
							}
								
							else
							{
								$no_of_seats=$min_seats->v_seat_number.' - '.$max_seats->v_seat_number;	
							}			
								
								
							date_default_timezone_set('Asia/Kolkata');
					
							$date = new DateTime($this->input->post('start_time'));
							
							$dt2 = $date->format('G');
							
							if($dt2==24 or $dt2==1 or $dt2==2 or $dt2==3 or $dt2==4 or $dt2==5 or $dt2==0)
							{
								$night=$d->p_night_charge;
								$n='';
								$night_charge_status=1;			
							}
							else
							{
								$night=0;
								$n='<span class="text-danger">Not Applied</span>';
								$night_charge_status=0;
							}
								
							$date1 = date_create(date('Y-m-d',strtotime($this->input->post('from_date'))));
							$date2 = date_create(date('Y-m-d',strtotime($this->input->post('to_date'))));			
							
							$diff = date_diff($date1,$date2);
								
							$total_days =  $diff->format("%a");
								
								
							if($dt2<=21)
							{
								$total_days = $total_days + 1;
							}				
											
							$chargeable_km=0;
							
							$discount = "";
							
							if(($d->p_min_km * $total_days ) > $total_distance_km)
							{
								$estimate_fare_rate = ($d->p_min_km * $total_days) * ($d->p_extra_km_rate);
							}
							else
							{
								$estimate_fare_rate = ($total_distance_km) * ($d->p_extra_km_rate);	
							}
							
							if($d->p_discount_type==0)
							{
								$discount = $d->p_discount."%";
								$discount_convert =  ($estimate_fare_rate * $d->p_discount)/100;
								$discount_show = $discount_convert." (".$discount.")";
							}
							else
							{
								$discount = "Rs. ".$d->p_discount;
								$discount_convert = $d->p_discount;
								$discount_show = $discount_convert;
							}
				
						
							$km_rate = $estimate_fare_rate;
						
							
							$total_estimated_rate =  $km_rate - $discount_convert ;
								
						 
							if($d->p_advance_type==0)
							{
								$total_advance_rate =  ($d->p_advance * $total_estimated_rate)/100;
							}
							else
							{
								$total_advance_rate = $d->p_advance;
							}
						  
						  
							$total_estimated_rate = $total_estimated_rate + $night + ($total_days *$d->p_driver_allowance);
							
							$tax=array();
						
							if($d->p_tax_on_package != 0)
							{
								$tax_arr = explode(',',$d->p_tax_on_package);
								 
								foreach($tax_arr as $ar)
								{
									$tax[] = $this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_name.'  '.$this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_value.'%';
								}
								$final_tax = implode(" , ",$tax);
							}
							else
							{
								$final_tax = 'Tax Not Applicable';		
							}
						
								
							//echo '<tr class="cablisting"><th width="30%">'.$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name.'<br>'.$vehicle_name = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name.'</th><th >'.$no_of_seats.'</th><th> Rs. '.$d->p_extra_km_rate.'</th><th><button type="button" class="btn btn-info popovers" rel="popover" data-trigger="hover" data-total-days="'.$total_days.'" data-total-distance="'.number_format($total_distance_km).'" data-discount="'.$discount_show.'" data-estimate-fare-rate="'.number_format($estimate_fare_rate).'" data-min-km="'.number_format($total_days * $d->p_min_km).'" data-rate-per-km="'.$d->p_extra_km_rate.'" data-night-charge="'.number_format($night).'" data-driver-allowance="'.number_format($total_days * $d->p_driver_allowance).'" data-tax="'.$final_tax.'" data-driver-allowance-per-day="'.$d->p_driver_allowance.'" data-estimated-rate="'.number_format($total_estimated_rate).'" data-advance="'.number_format($total_advance_rate).'">Rs. '.number_format($total_estimated_rate).'</button><input type="hidden" id="availabe_advance" value="'.number_format($total_advance_rate).'"/><input type="hidden" id="available_night_charge_status" value="'.$night_charge_status.'"/></th><th > <a href="javascript:;" class="btn yellow-crusta button-next" onclick="book_package('.$d->id.','.$total_advance_rate.','.$total_distance_km.','.$estimate_fare_rate.','.$total_days.','.$total_estimated_rate.')" ><i class="fa fa-cab"></i> BOOK CAB </a></th></tr>';
					
							$package_detail[$i]['category_name'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name;		
							$package_detail[$i]['vehicle_name'] = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name;	
							$package_detail[$i]['no_of_seats'] = $no_of_seats;
							$package_detail[$i]['p_id'] = $d->id;
							$package_detail[$i]['total_days'] = $total_days;
							$package_detail[$i]['total_distance_km'] = $total_distance_km;
							$package_detail[$i]['discount'] = $discount_show;
							$package_detail[$i]['estimate_fare_rate'] = $estimate_fare_rate;
							$package_detail[$i]['p_min_km'] = $total_days * $d->p_min_km;
							$package_detail[$i]['p_extra_km_rate'] = $d->p_extra_km_rate;
							$package_detail[$i]['p_min_hr'] = $d->p_min_hr;
							$package_detail[$i]['p_extra_hr_rate'] = $d->p_extra_hr_rate;
							$package_detail[$i]['night_charge'] = $night;
							$package_detail[$i]['night_charge_status'] = $night_charge_status;
							$package_detail[$i]['p_driver_allowance'] = $total_days * $d->p_driver_allowance;
							$package_detail[$i]['driver_allowance_per_day'] = $d->p_driver_allowance;
							$package_detail[$i]['chargeable_km'] = $estimate_fare_rate;
							$package_detail[$i]['final_tax'] = "Additional Gov. Tax GST, Toll, Parking, State Tax Charge will be remain."; //$final_tax;
							$package_detail[$i]['total_estimated_rate'] = $total_estimated_rate;
							$package_detail[$i]['total_advance_rate'] = $total_advance_rate;
							
							
							$package_detail[$i]['v_profile_pic'] = '';
							$package_detail[$i]['v_profile_pic_path'] = '';
							$vehicle_category=$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row();
							if(!empty($d->p_v_category) && !empty($vehicle_category) && !empty($vehicle_category->c_profile_pic)){
								$package_detail[$i]['v_profile_pic']=$vehicle_category->c_profile_pic;
								$package_detail[$i]['v_profile_pic_path'] =base_url().'uploads/category/profile_pic/'.$vehicle_category->c_profile_pic;
							}
							
							
							
							//$total=$i;
							//$i++;
							
						} 
					}
				}
				else if($this->input->post('type') == "multicity")
				{
					if(isset($_POST['from_city']) && isset($_POST['b_to_city']) && isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['from_time']))
					{	
						$all_to_city = explode(' - ',$this->input->post('b_to_city'));
					  
						$this->load->model('General_data');
					   
						$total_distance_km = 0;
					  
						$last_city="";		 
						
						for($i=0;$i<count($all_to_city);$i++)
						{
							if($i==0)
							{
								$from_city = $this->db->get_where('city_detail',array('id'=>$this->input->post('from_city')))->row();
								$from_city = $from_city->c_name." , ".$from_city->c_state;
							}
							else
							{
								
								$from_city = $all_to_city[$i-1];
										
							}
									
							$to_city = $all_to_city[$i];					
									
							$total_distance_km =  $total_distance_km  +  $this->General_data->distance($from_city, $to_city);
									
							$last_city = $to_city;
								
						}
							 
						$end_city = $this->db->get_where('city_detail',array('id'=>$this->input->post('from_city')))->row();
						$end_city = $end_city->c_name." , ".$end_city->c_state;
								
						$total_distance_km =  $total_distance_km + $this->General_data->distance($last_city, $end_city);
						
								
						$data = $this->db->get_where('package_detail',array('id'=>$this->input->post("newpackage")))->result();
							
						$i=1;
						$total=0;	
					
						$package_detail=array();
								
						foreach($data as $i => $d)
						{
						
							$max_seats = $this->db->select_max('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
										
							$min_seats = $this->db->select_min('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
							
							
							
							
							if($max_seats == $min_seats)
							{
								$no_of_seats = $max_seats->v_seat_number;
							}
							
							else
							{
								$no_of_seats=$min_seats->v_seat_number.' - '.$max_seats->v_seat_number;	
							}
							
							
							
							
							date_default_timezone_set('Asia/Kolkata');
					
							$date = new DateTime($this->input->post('from_time'));
							
							$dt2 = $date->format('G');
						
							//echo $dt2; exit;	
							
							if($dt2==24 or $dt2==1 or $dt2==2 or $dt2==3 or $dt2==4 or $dt2==5 or $dt2==0 )
							{
								$night=$d->p_night_charge;
								$n='';
								$night_charge_status=1;			
							}
							
							else
							{
								$night=0;
								$n='<span class="text-danger">Not Applied</span>';
								$night_charge_status=0;
							}
							
							//echo $night; exit;				 
							 
							 
							$date1 = date_create(date('Y-m-d',strtotime($this->input->post('from_date'))));
							$date2 = date_create(date('Y-m-d',strtotime($this->input->post('to_date'))));			
							
							$diff = date_diff($date1,$date2);
							
							$total_days =  $diff->format("%a");
							
							//echo $total_days; exit;
							
							if($dt2<=21)
							{
								$total_days = $total_days + 1;
							}
											
						
							//echo $total_days; exit;	
							
							$chargeable_km=0;
						
							$discount = "";
							if(($d->p_min_km * $total_days ) > $total_distance_km)
							{
								$estimate_fare_rate = ($d->p_min_km * $total_days) * ($d->p_extra_km_rate);
							}
							else
							{
								$estimate_fare_rate = ($total_distance_km) * ($d->p_extra_km_rate);	
							}
							
							if($d->p_discount_type==0)
							{
								$discount = $d->p_discount."%";
								$discount_convert =  ($estimate_fare_rate * $d->p_discount)/100;
								$discount_show = $discount_convert." (".$discount.")";
							}
							else
							{
								$discount = "Rs. ".$d->p_discount;
								$discount_convert = $d->p_discount;
								$discount_show = $discount_convert;
							}
									 
							$km_rate = $estimate_fare_rate;	
					
							$total_estimated_rate =  $km_rate - $discount_convert ;				
					 
							if($d->p_advance_type==0)
							{
								$total_advance_rate =  ($d->p_advance * $total_estimated_rate)/100;
							}
							else
							{
								$total_advance_rate = $d->p_advance;
							}
					  
					  
							$total_estimated_rate = $total_estimated_rate + $night + ($total_days *$d->p_driver_allowance);
							
							$tax=array();
					
							if($d->p_tax_on_package != 0)
							{
									 $tax_arr = explode(',',$d->p_tax_on_package);
									 
									 foreach($tax_arr as $ar)
									 {
										$tax[] = $this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_name.'  '.$this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_value.'%';
									 }
									 
									 $final_tax = implode(" , ",$tax);
							}
							else
							{
								$final_tax = 'Tax Not Applicable';		
							}
						
							//echo '<tr class="cablisting"><th width="30%">'.$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name.'<br>'.$vehicle_name = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name.'</th><th >'.$no_of_seats.'</th><th> Rs. '.$d->p_extra_km_rate.'</th><th><button type="button" class="btn btn-info popovers" rel="popover" data-trigger="hover" data-total-days="'.$total_days.'" data-total-distance="'.number_format($total_distance_km).'" data-discount="'.$discount_show.'" data-estimate-fare-rate="'.number_format($estimate_fare_rate).'" data-min-km="'.number_format($total_days * $d->p_min_km).'" data-rate-per-km="'.$d->p_extra_km_rate.'" data-night-charge="'.number_format($night).'" data-driver-allowance="'.number_format($total_days * $d->p_driver_allowance).'" data-tax="'.$final_tax.'" data-driver-allowance-per-day="'.$d->p_driver_allowance.'" data-estimated-rate="'.number_format($total_estimated_rate).'" data-advance="'.number_format($total_advance_rate).'">Rs. '.number_format($total_estimated_rate).'</button><input type="hidden" id="availabe_advance" value="'.number_format($total_advance_rate).'"/><input type="hidden" id="available_night_charge_status" value="'.$night_charge_status.'"/></th><th > <a href="javascript:;" class="btn yellow-crusta button-next" onclick="book_package('.$d->id.','.$total_advance_rate.','.$total_distance_km.','.$estimate_fare_rate.','.$total_days.','.$total_estimated_rate.')" ><i class="fa fa-cab"></i> BOOK CAB </a></th></tr>';
					
							$package_detail[$i]['category_name'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name;		
							$package_detail[$i]['vehicle_name'] = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name;	
							$package_detail[$i]['v_description'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->description;
							$package_detail[$i]['no_of_seats'] = $no_of_seats;
							$package_detail[$i]['p_id'] = $d->id;
							$package_detail[$i]['total_days'] = $total_days;
							$package_detail[$i]['total_distance_km'] = $total_distance_km;
							$package_detail[$i]['discount'] = $discount_show;
							$package_detail[$i]['estimate_fare_rate'] = $estimate_fare_rate;
							$package_detail[$i]['p_min_km'] = $total_days * $d->p_min_km;
							$package_detail[$i]['p_extra_km_rate'] = $d->p_extra_km_rate;
							$package_detail[$i]['p_min_hr'] = $d->p_min_hr;
							$package_detail[$i]['p_extra_hr_rate'] = $d->p_extra_hr_rate;
							$package_detail[$i]['night_charge'] = $night;
							$package_detail[$i]['night_charge_status'] = $night_charge_status;
							$package_detail[$i]['p_driver_allowance'] = $total_days * $d->p_driver_allowance;
							$package_detail[$i]['driver_allowance_per_day'] = $d->p_driver_allowance;
							$package_detail[$i]['chargeable_km'] = $estimate_fare_rate;
							$package_detail[$i]['final_tax'] = "Additional Gov. Tax GST, Toll, Parking, State Tax Charge will be remain."; //$final_tax;
							$package_detail[$i]['total_estimated_rate'] = $total_estimated_rate;
							$package_detail[$i]['total_advance_rate'] = $total_advance_rate;
							
							$package_detail[$i]['v_profile_pic'] = '';
							$package_detail[$i]['v_profile_pic_path'] = '';
							$vehicle_category=$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row();
							if(!empty($d->p_v_category) && !empty($vehicle_category) && !empty($vehicle_category->c_profile_pic)){
								$package_detail[$i]['v_profile_pic']=$vehicle_category->c_profile_pic;
								$package_detail[$i]['v_profile_pic_path'] =base_url().'uploads/category/profile_pic/'.$vehicle_category->c_profile_pic;
							}
							
							
							
							//$total=$i;
							//$i++;
							
						} 
					}
				}
				else if($this->input->post('type') == "local")
				{
					date_default_timezone_set('Asia/Kolkata');
					if(isset($_POST['sub_type_id']) && isset($_POST['from_city']) && isset($_POST['from_date']) && isset($_POST['from_time'])){			
					
						$data =$this->db->get_where('package_detail',array('id'=>$this->input->post('newpackage')))->result();
						
						$i=1;
						$total=0;	
					
						$package_detail=array();
					
						foreach($data as $i => $d)
						{	
						
							$max_seats = $this->db->select_max('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
										
							$min_seats = $this->db->select_min('v_seat_number')->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row();
							
							if($max_seats == $min_seats)
							{
								$no_of_seats = $max_seats->v_seat_number;
							}
							
							else
							{
								$no_of_seats=$min_seats->v_seat_number.' - '.$max_seats->v_seat_number;	
							}
							
							date_default_timezone_set('Asia/Kolkata');

							$date = new DateTime($this->input->post('from_time'));
							$dt2=$date->format('G');	
					
							if($dt2==24 or $dt2==1 or $dt2==2 or $dt2==3 or $dt2==4 or $dt2==5 or $dt2==0)
							{
								$night=$d->p_night_charge;
								$n='';
								$night_charge_status=1;
							}
							else
							{
								$night=0;
								$n='<span class="text-danger">Not Applied</span>';
								$night_charge_status=0;
							}
					  
							$km_rate = $d->p_min_km * $d->p_extra_km_rate;
							$hour_rate = $d->p_min_hr * $d->p_extra_hr_rate;
					  
							if($d->p_discount_type==0)
							{
								$discount = $d->p_discount."%";
								$discount_convert =  ($d->p_rate * $d->p_discount)/100;
								$discount_show = $discount_convert." (".$discount.")";
							}
							else
							{
								$discount = "Rs. ".$d->p_discount;
								$discount_convert = $d->p_discount;
								$discount_show = $discount_convert;
							}
							
							$total_estimated_rate =  ($d->p_rate - $discount_convert) + $night;
							
							if($d->p_advance_type==0)
							{
								$total_advance_rate =  ($d->p_advance * $total_estimated_rate)/100;
							}
							else
							{
								$total_advance_rate = $d->p_advance;
							}
						
						
							$tax=array();
						
							if($d->p_tax_on_package != 0)
							{
								 $tax_arr = explode(',',$d->p_tax_on_package);
								 
								 foreach($tax_arr as $ar)
								 {
									$tax[] = $this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_name.'  '.$this->db->get_where('tax_detail',array('id'=>$ar))->row()->t_value.'%';
								 }
								 
								 $final_tax = implode(" , ",$tax);
							}
							else
							{
								$final_tax = 'Tax Not Applicable';		
							}
	
							$package_detail[$i]['category_name'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->category_name;		
							$package_detail[$i]['vehicle_name'] = $this->db->get_where('vehicle_detail',array('v_category_id'=>$d->p_v_category))->row()->v_name;	
							$package_detail[$i]['v_description'] = $this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row()->description;
							$package_detail[$i]['no_of_seats'] = $no_of_seats;
							$package_detail[$i]['p_id'] = $d->id;
							$package_detail[$i]['price'] = $d->p_rate;
							$package_detail[$i]['discount'] = $discount_show;
							$package_detail[$i]['p_min_km'] = $d->p_min_km;
							$package_detail[$i]['p_extra_km_rate'] = $d->p_extra_km_rate;
							$package_detail[$i]['p_min_hr'] = $d->p_min_hr;
							$package_detail[$i]['p_extra_hr_rate'] = $d->p_extra_hr_rate;
							$package_detail[$i]['night_charge'] = $night;
							$package_detail[$i]['night_charge_status'] = $night_charge_status;
							$package_detail[$i]['final_tax'] = "Additional Gov. Tax GST, Toll, Parking, State Tax Charge will be remain."; //$final_tax;
							$package_detail[$i]['total_estimated_rate'] = $total_estimated_rate;
							$package_detail[$i]['total_advance_rate'] = $total_advance_rate;
							
							$package_detail[$i]['v_profile_pic'] = '';
							$package_detail[$i]['v_profile_pic_path'] = '';
							$vehicle_category=$this->db->get_where('vehicle_category_detail',array('id'=>$d->p_v_category))->row();
							if(!empty($d->p_v_category) && !empty($vehicle_category) && !empty($vehicle_category->c_profile_pic)){
								$package_detail[$i]['v_profile_pic']=$vehicle_category->c_profile_pic;
								$package_detail[$i]['v_profile_pic_path'] =base_url().'uploads/category/profile_pic/'.$vehicle_category->c_profile_pic;
							}
						}
					}
				} //last else if over here. (most important part is here for ending bracket.)
				$response=array('code'=>1,'msg'=>'success','passenger_detail'=>$passenger_detail,'package_detail'=>$package_detail[0]);
			}
			else
			{
				$response=array('code'=>0,'msg'=>'Somthing Went To Wrong');
			}
		}
		else
		{
			$response=array('code'=>0,'msg'=>'Parameter Missing');
		}
		
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($response));
	}


	public function check_passenger()
	{
		// using contact no check passeneger if available otherwise make a registration 

		date_default_timezone_set('Asia/Kolkata');
		$passenger_detail = array();
		$response = array();
		if($this->input->post('mobile') && $this->input->post('mobile') != '')
		{

			
			$mobile = $this->input->post('mobile');
			$this->db->select("*")->from("passenger_list")->where("(p_contact = '$mobile' OR p_contact_2 = '$mobile')");
			$que = $this->db->get();
			$passenger = $que->row_array();
			
			if(!empty($passenger))
			{
				$passenger_detail["p_id"] =      $passenger['id'];
				$passenger_detail["p_p_id"] =    $passenger['p_id'];
				$passenger_detail["fullname"] =  $passenger['p_full_name'];
				$passenger_detail["firstname"] = $passenger['p_f_name'];
				$passenger_detail["lastname"] =  $passenger['p_l_name'];
				$passenger_detail["contact1"] =  $passenger['p_contact'];
				$passenger_detail["contact2"] =  $passenger['p_contact_2'];
				$passenger_detail["email"] =     $passenger['p_email_id'];
				$passenger_detail["state"] =     $passenger['p_state'];
				$passenger_detail["city"] =      $passenger['p_city'];
			}
			else
			{
				$password = random_string('alnum', 8);
				
				$passenger_detail_array = array(
												'p_type'=>'Online',

												'p_contact'=>$this->input->post('mobile'),

												'p_password'=>md5($this->input->post('mobile')),

												'p_status'=>1,

												'p_joining_date_time'=>date("Y-m-d H:i:s"),

												'p_created_by'=>-1
										  );
				
				$this->db->insert('passenger_list',$passenger_detail_array);
				
				$get_last_id=$this->db->insert_id();
				
				$this->General_data->update_id('passenger_list','RCP'.date('Y').date('m'),'p_id');
				
				
				$message = 'Thank You For Registration In Rashmi cabs Your USERNAME IS-'.$this->input->post('mobile').' and PASSWORD IS -'.$this->input->post('mobile').' Call Rashmi Cabs on +91 9974234111 for any help.';
				
				$this->Sms_email->send_sms($this->input->post('mobile'),$message); 
				
				$this->db->select("*")->from("passenger_list")->where("id",$get_last_id);
				$querys = $this->db->get();
				$passenger = $querys->result();
			
				$passenger_detail['passenger'] = array(
													"p_id"=>$passenger[0]->id,
													"p_p_id"=>$passenger[0]->p_id,
													"fullname"=>$passenger[0]->p_full_name,
													"firstname"=>$passenger[0]->p_f_name,
													"lastname"=>$passenger[0]->p_l_name,
													"contact1"=>$passenger[0]->p_contact,
													"contact2"=>$passenger[0]->p_contact_2,
													"email"=>$passenger[0]->p_email_id,
													"state"=>$passenger[0]->p_state,
													"city"=>$passenger[0]->p_city,
												 );
			}


			$response=array('msg'=>'success','passenger_detail'=>$passenger_detail);

			
	}

	$this->output->set_content_type('application/json');
	$this->output->set_output(json_encode($response));
}


}