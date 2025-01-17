<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php require_once("header.php"); ?>
		<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"><?php if(isset($from_city_name) && $from_city_name != '') { echo $from_city_name; } ?><?php if(isset($from_city_name) && $from_city_name != '') { echo " - "; } ?><?php if(isset($to_city_name) && $to_city_name != '') { echo $to_city_name; } ?><?php if(isset($to_city_name) && $to_city_name != '') { echo " - "; } ?>ROUNDTRIP<?php if(isset($from_date) && $from_date != '') { echo " - "; } ?><?php if(isset($from_date) && $from_date != "") { echo $from_date; }?><?php if(isset($to_date) && $to_date != '') { echo " - "; } ?><?php if(isset($to_date) && $to_date != "") { echo $to_date; }?></h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="<?php echo base_url(); ?>">GO TO HOME</a></li>   
					<li><a href="<?php echo site_url('lists/roundcablists'); ?>">Cab List</a></li>
					<li class="active">Checkout</li>
                </ul>
            </div>
        </div>
		<div id="views">
		<section id="content" class="gray-area">
            <div class="container">
                <div class="row">
				<?php if(isset($notice) && $notice == "1") { ?> 
				<div class="alert alert-notice">
                        <h4>!Please Try Agian Your Payment Process Is Failure...</h4>
                    <span class="close"></span>
                </div>
				<?php } ?>
					<div class="sidebar col-sms-6 col-sm-4 col-md-3">
                        <div class="booking-details travelo-box">
                            <h4>Booking Details</h4>
                            <article class="flight-booking-details">
                                <div class="travel-title">
                                    <h5 class="box-title"><?php echo $package_detail['category_name']."-". $package_detail['vehicle_name']; ?><small>ROUNDTRIP</small></h5>
                                </div>                                              
                            </article>                       
                            <h4>Other Details</h4>
                            <dl class="other-details">
								<dt class="feature">Number Of Seat:</dt><dd class="value"><?php echo $package_detail['no_of_seats'];?></dd>	
                                <dt class="feature">Total Distance:</dt><dd class="value"><?php echo $package_detail['total_distance_km']; ?> KM</dd>
								<dt class="feature">Minimum KM::</dt><dd class="value"><?php echo $package_detail['p_min_km']; ?> KM</dd>
                                <dt class="feature">Extra Rate Per Km.:</dt><dd class="value">Rs. <?php echo $package_detail['p_extra_km_rate']; ?></dd>
								<dt class="feature">Minimum HR::</dt><dd class="value"><?php echo $package_detail['p_min_hr']; ?> HR</dd>
								<dt class="feature">Extra Rate Per Hr.:</dt><dd class="value"><?php echo $package_detail['p_extra_hr_rate']; ?></dd>
								<dt class="feature">Estimated Fare:</dt><dd class="value">Rs. <?php echo $package_detail['estimate_fare_rate']; ?></dd>
								<dt class="feature">Discount:</dt><dd class="value">Rs. <?php echo $package_detail['discount']; ?></dd>
								<dt class="feature">Total Est. Rate:</dt><dd class="value">Rs. <?php echo $package_detail['total_estimated_rate']; ?></dd>
								<dt class="feature">Additional Tax:</dt><dd class="value"><?php echo $package_detail['final_tax']; ?></dd>
                                <dt class="total-price">Total Est. Price</dt><dd class="total-price-value">INR. <?php echo $package_detail['total_estimated_rate']; ?></dd>
                            </dl>
                        </div>
                    </div>
                    <div id="main" class="col-sms-6 col-sm-8 col-md-9">
                        <div class="booking-section travelo-box">
                            <?php if($package_detail['total_advance_rate'] == 0) { ?>
							<form id="checkoutdetail" action="<?php echo site_url("cabs/multicityoffline");?>" name="checkoutdetail" class="booking-form" method="post">
							<?php } else { ?>
                            <form id="checkoutdetail" action="<?php echo site_url("cabs/payload");?>" name="checkoutdetail" class="booking-form" method="post">
							<?php } ?>
                                <input type="hidden" name="xmldataparser" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<input type="hidden" name="multicity" value="multicity">
								<input type="hidden" name="from_city" value="<?php if(isset($from_city) && $from_city != '') { echo $from_city; } ?>">
								<input type="hidden" name="tocity" value="<?php if(isset($to_city_name) && $to_city_name != '') { echo $to_city_name; } ?>">
								<input type="hidden" name="fromcitys" value="<?php if(isset($from_city_name) && $from_city_name != '') { echo $from_city_name; } ?>">
								<input type="hidden" name="from_date" value="<?php if(isset($from_date) && $from_date != "") { echo $from_date; }?>">
								<input type="hidden" name="to_date" value="<?php if(isset($to_date) && $to_date != "") { echo $to_date; }?>">
								<input type="hidden" name="from_time" value="<?php if(isset($from_time) && $from_time != "") { echo $from_time; }?>">
								<input type="hidden" name="packageid" value="<?php echo $this->encrypt->encode($package_detail['p_id']);?>">
								<input type="hidden" name="xmldata" value="<?php echo $xmldata; ?>">
								<div class="person-information">
                                    <h2>Your Personal Information</h2>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>first name</label>
                                            <input type="text" id="fname" name="fname" class="input-text full-width" value="<?php if(isset($user_detail['firstname']) && $user_detail['firstname'] != ""){ echo $user_detail['firstname']; }?>" <?php if($user_detail['firstname'] != ''){ echo "disabled";} ?> placeholder="Enter First Name" />
											<?php if(isset($user_detail['firstname']) && $user_detail['firstname'] != ""){ ?>
											<input type="hidden" name="fname" value="<?php echo $user_detail['firstname']; ?>">
											<?php } ?>
										</div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>last name</label>
                                            <input type="text" id="lname" name="lname" class="input-text full-width" value="<?php if(isset($user_detail['lastname']) && $user_detail['lastname'] != ""){ echo $user_detail['lastname']; }?>" <?php if($user_detail['lastname'] != ''){ echo "disabled";} ?> placeholder="Enter Last Name"/>
											<?php if(isset($user_detail['lastname']) && $user_detail['lastname'] != ""){ ?>
											<input type="hidden" name="lname" value="<?php echo $user_detail['lastname']; ?>">
											<?php } ?>
										</div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>email address</label>
                                            <input type="text" class="input-text full-width" id="email" name="email" value="<?php if(isset($user_detail['email']) && $user_detail['email'] != ""){ echo $user_detail['email']; }?>" <?php if($user_detail['email'] != ''){ echo "disabled";} ?> placeholder="Enter Email Address"/>
											<?php if(isset($user_detail['email']) && $user_detail['email'] != ""){ ?>
											<input type="hidden" name="email" value="<?php echo $user_detail['email']; ?>">
											<?php } ?>
										</div>
                                        <div class="col-sm-6 col-md-5">
                                           <label>Phone number</label>
                                            <input type="text" class="input-text full-width" id="mobile" name="mobile" disabled value="<?php if(isset($user_detail['contact1']) && $user_detail['contact1'] != ""){ echo $user_detail['contact1']; } else if (isset($user_detail['contact2']) && $user_detail['contact2'] != "") { echo $user_detail['contact2']; }?>" placeholder="Enter Mobile Number" readonly/>
											<?php if(isset($user_detail['contact1']) && $user_detail['contact1'] != ""){ ?>
											<input type="hidden" name="mobile" value="<?php echo $user_detail['contact1']; ?>">
											<?php } else if(isset($user_detail['contact2']) && $user_detail['contact2'] != "") { ?>
											<input type="hidden" name="mobile" value="<?php echo $user_detail['contact2']; ?>">
											<?php } ?>
										</div>
                                    </div>
                                <hr />
								<h2>Traveller Information</h2>
                                    <div class="form-group row">
										<div class="col-sm-6 col-md-5">
											<div class="form-group">
												<div class="checkbox">
													 <input id="self" name="selfstatus" type="checkbox" value=""><span class="skin-color">Self Travel</span>
													 <input id="selfs" type="hidden" name="selfstatuss" value="0">
												</div>
											</div>
                                        </div>
									</div>
									<div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Traveller name</label>
                                            <input type="text" class="input-text full-width" id="tname" name="tname" value="" placeholder="Enter Traveller Name" />
                                        </div>
                                        <div class="col-sm-6 col-md-5">
                                            <label>Traveller Mobile</label>
                                            <input type="text" class="input-text full-width" id="tphone" name="tphone" value="" placeholder="Enter Traveller Mobile" />
                                        </div>
                                    </div>
								<hr />
                                <div class="card-information">                               
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-md-5">
                                            <label>Pickup Point</label>
                                             <input type="text" id="pickup_point" name="pickup_point" class="input-text full-width" value="" placeholder="Enter Pickup Point" />
                                        </div>
										<div class="col-sm-6 col-md-5">
                                            <label>Drop Point</label>
                                             <input type="text" id="drop_point" name="drop_point" class="input-text full-width" value="" placeholder="Enter Drop Point" />
                                        </div>
                                        
                                    </div>
									<div class="form-group row">
                                        <div class="col-sm-6 col-md-10">
                                            <label>Other Notes</label>
                                             <input type="text" id="note" name="note" class="input-text full-width" value="" placeholder="Enter Your Notes" />
                                        </div>
                                        
                                    </div>
                                    
                                    </div>
                                </div>
                                <hr />
                                <div class="form-group row">
                                        <div class="col-sm-6 col-md-10">
                                            <label>Advance Payment For Booking Confirmation</label>
                                             <input type="text" class="input-text full-width" value="Rs.<?php echo $package_detail['total_advance_rate']; ?>" placeholder="" disabled="disabled" />
											 <input type="hidden" name="currencyxmldata" value="<?php echo $this->encrypt->encode($package_detail['total_advance_rate']); ?>">
                                        </div>
										<div class="col-sm-6 col-md-10">
                                            <label>Payment Type</label>
                                             <input type="text" class="input-text full-width" value="ONLINE PAYMENT" placeholder="" disabled="disabled" />
                                        </div>
                                        
                                </div>
								<div class="form-group row">
                                    <div class="col-sm-6 col-md-6">
                                      
                                        <div >
<span class="text-danger"><strong>NOTE:</strong> After Trip Complate All Due amount it will be pay on DRIVER. <br>
Baggage Allowance (Max.): For MINI : 2 BAGS, For SEDAN 3 BAGS, For SUV 4 Bags, For SUV DELUX 5 Bags.  </span>

                                           
                                        </div>
                                    </div>
                                    
                                     
                                </div>
                                
                                <hr>
                                <div class="form-group">
                                    <div class="checkbox chk2">
                                        <label>
                                            <input type="checkbox" id="agree" name="agree" checked> By continuing, you agree to the <a data-toggle="modal" href="#packagetrems"><span class="skin-color"> Package Terms </span></a> , <a data-toggle="modal" href="#t_c"><span class="skin-color"> Terms & condition </span></a> , <a data-toggle="modal" href="#p_p"><span class="skin-color"> Privacy Policy </span></a>,<a data-toggle="modal" href="#c_c"><span class="skin-color"> Cancellation Rules </span></a>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
									<div class="col-sm-12 col-md-12">
											<div id="errormsg" class="alert alert-error">
											</div>
									</div>
                                    <div class="col-sm-12 col-md-12">
                                        <button type="button" id="checkoutpro" class="full-width btn-large">PROCEED TO PAY</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>               
                </div>
            </div>
			<div class="modal fade" id="packagetrems" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h2 class="modal-title">Package Terms</h2>
										</div>
										<div class="modal-body">
										<div class="form-body">
											<div class="row">
												<form action="#" class="horizontal-form">
													<div class="col-md-12">
														<?php if($package_terms != ''){ echo $package_terms; }else{ echo "Call on Rashmicabs";}?>
													</div>
												</form>
											</div>
										<div class="modal-footer">
										
											   <a class="button btn-small full-width" data-dismiss="modal" aria-hidden="true" >Close</a>			
										</div>
										</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>	
							</div>
						</div>
						<div class="modal fade" id="t_c" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h2 class="modal-title">Terms & condition</h2>
										</div>
										<div class="modal-body">
										<div class="form-body">
											<div class="row">
												<form action="#" class="horizontal-form">
													<div class="col-md-12">
														<?php if($terms_and_conditions != ''){ echo $terms_and_conditions; }else{ echo "Call on Rashmicabs";}?>
													</div>
												</form>
											</div>
										<div class="modal-footer">
										
											   <a class="button btn-small full-width" data-dismiss="modal" aria-hidden="true" >Close</a>			
										</div>
										</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>	
							</div>
						</div>
						<div class="modal fade" id="p_p" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h2 class="modal-title">Privacy & Policy</h2>
										</div>
										<div class="modal-body">
										<div class="form-body">
											<div class="row">
												<form action="#" class="horizontal-form">
													<div class="col-md-12">
														<?php if($privacy_policy != ''){ echo $privacy_policy; }else{ echo "Call on Rashmicabs";}?>
													</div>
												</form>
											</div>
										<div class="modal-footer">
										
											   <a class="button btn-small full-width" data-dismiss="modal" aria-hidden="true" >Close</a>			
										</div>
										</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>	
							</div>
						</div>
						<div class="modal fade" id="c_c" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h2 class="modal-title">Cancellation Rules</h2>
										</div>
										<div class="modal-body">
										<div class="form-body">
											<div class="row">
												<form action="#" class="horizontal-form">
													<div class="col-md-12">
														<?php if($cancellation_terms != ''){ echo $cancellation_terms; }else{ echo "Call on Rashmicabs";}?>
													</div>
												</form>
											</div>
										<div class="modal-footer">
										
											   <a class="button btn-small full-width" data-dismiss="modal" aria-hidden="true" >Close</a>			
										</div>
										</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>	
							</div>
						</div>
        </section>
	</div>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script>

google.maps.event.addDomListener(window, 'load', function ()

{

	

	var places = new google.maps.places.Autocomplete((document.getElementById('pickup_point')),

	{

		types: ['geocode'],

		componentRestrictions: {country: 'in' }

	});

	

	google.maps.event.addListener(places, 'place_changed', function ()

	 {

		

	});

	

	

	

	var places = new google.maps.places.Autocomplete((document.getElementById('drop_point')),

	{

		types: ['geocode'],

		componentRestrictions: {country: 'in' }

	});

	

	google.maps.event.addListener(places, 'place_changed', function ()

	 {

		

	});

	

});

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiwIrp3iYRK3PkyU0ZAj90gWWaAYDKQDA&libraries=places" async defer></script>
<?php require_once("footer.php"); ?>
<script type="text/javascript" src="<?php echo base_url()."assets/js/jquery.validate.js"; ?>"></script>
<script>
tjq(document).ready(function() {
	tjq("#errormsg").hide();
	var self;
		tjq('#self').on('change',function(){
			var passn =tjq("#fname").val()+" "+tjq("#lname").val();
			var passm =tjq("#mobile").val();
			if(tjq(this).prop("checked") == true){
			   self = 1;
			   tjq("#selfs").val(1);
               tjq("#tname").val(passn);
			   tjq("#tphone").val(passm);
				tjq("#tname").attr("disabled", "disabled");
				tjq("#tphone").attr("disabled", "disabled");
            }
            else if(tjq(this).prop("checked") == false){
				self = 0;
				tjq("#selfs").val(0);
               tjq("#tname").val('');
				tjq("#tphone").val('');
				tjq("#tname").removeAttr("disabled");
				tjq("#tphone").removeAttr("disabled");
            }
			
		});
		
		tjq("#checkoutpro").on('click',function(){
			if(!tjq("form[name='checkoutdetail']").valid())
			{
				tjq(".selector").after(tjq("#triptime-error"));
				return false;
			}
			else
			{
				tjq("#checkoutdetail").submit();
				/*
				var fname = tjq('#fname').val();
				var lname = tjq('#lname').val();
				var email = tjq('#email').val();
				var mobile = tjq('#mobile').val();
				var tname = tjq('#tname').val();
				var tphone = tjq('#tphone').val();
				var triptime = tjq('#triptime').val();
				var pickup_point = tjq('#pickup_point').val();
				var drop_point = tjq('#drop_point').val();
				var note = tjq('#note').val();
				var xmldata = "<?php echo $xmldata; ?>";
				var selfstatus = self;
				var fcity = "<?php echo $fromcity; ?>";
				var tcity = "<?php echo $tocity; ?>";
				tjq.ajax({
						url: '<?php echo site_url('oneway/checkout'); ?>',
						headers: {'X-Powered-By': 'ASP.NET','Authorization':'RASHMIxxxxxxxxxxxxx9'},
						method: 'post',
						//dataType:"json",
						data: {'xmldataparser':'<?php echo $this->security->get_csrf_hash(); ?>',fname:fname,lname:lname,email:email,mobile:mobile,tname:tname,tphone:tphone,triptime:triptime,pickup_point:pickup_point,drop_point:drop_point,note:note,xmldata:xmldata,selfstatus:selfstatus,fcity:fcity,tcity:tcity},
						success: function(res)
						{
							if(res.code == 0)
							{
								tjq("#errormsg").html("<h4>"+res.msg+"</h4><span class='close'></span>");
								tjq("#errormsg").show();
							}
							else
							{
								tjq("#views").empty();
								tjq("#views").html(res);
								tjq('html,body').animate({ scrollTop: 0 }, 'slow', function () {});
								//tjq("#views").load("<?php echo base_url()."Onewayofferbookdetail"; ?>");
							}
						}
				});*/
			}
		});	

	jQuery.validator.addMethod("regx1", function(value, element, regexpr) 
  	{          
    		return regexpr.test(value);
  	}, "Not Valid value...");	
	
	jQuery.validator.addMethod("valueNotEquals", function(value, element, valueNotEqual){
			return valueNotEqual !== value;
	}, "Please Select");

	  tjq("form[name='checkoutdetail']").validate({
		  onfocusout: function (element) {tjq(element).valid();},
	    rules: {
	      fname: {
			  		required: true,
			  		regx1:  /^[A-z ]+$/,
			  		minlength: 3,
			  		maxlength: 30
		  },
		  lname: {
			  		required: true,
			  		regx1:  /^[A-z ]+$/,
			  		minlength: 3,
			  		maxlength: 30
		  },
		  email: {
			  		required: true,
			  		regx1:  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
			  		minlength: 3,
			  		maxlength: 30
		  },
		  tname: {
			  		required: true,
			  		regx1:  /^[A-z ]+$/,
			  		minlength: 3,
			  		maxlength: 30
		  },
		  tphone: {
	        		required: true,
			  		regx1: /^((?!(0))[0-9]{10})$/,
	        		minlength: 10,
			  		maxlength: 10
	      },
		  pickup_point: {
	        		required: true,
			  		regx1: /^[ A-Za-z0-9.,-]*$/,
	      },
		  drop_point: {
	        		required: true,
			  		regx1: /^[ A-Za-z0-9.,-]*$/,
	      },
		  agree:{required: true}
		  
	    },
	    messages: {
	    	fname:  {
		  				required: "Please Enter First Name",
			  			regx1: "Enter Only Charecter",
						minlength: "name minimum 3 Charecter",
						maxlength: "name maximum 30 Charecter"
		  	},
			lname:  {
		  				required: "Please Enter Last Name",
			  			regx1: "Enter Only Charecter",
						minlength: "name minimum 3 Charecter",
						maxlength: "name maximum 30 Charecter"
		  	},
			email: {
						required: "Please Enter Email",
			  			regx1: "Please Enter Valid Email"
		  	},
			tname:  {
		  				required: "Please Enter Traveler Name",
			  			regx1: "Enter Only Charecter",
						minlength: "name minimum 3 Charecter",
						maxlength: "name maximum 30 Charecter"
		  	},
			tphone: {
						required: "Please Enter Traveler Mobile No ",
						regx1: "Please Enter Valid Mobile No Without 0",
						minlength:"Please 10 Digit Mobile No",
						maxlength:"Please 10 Digit Mobile No"
	      	},
			pickup_point: {
	        		required: "Please Enter Pickup Point",
			  		regx1: "Pleas Select Valid Pickup Point",
			},
			drop_point: {
	        		required: "Please Enter Pickup Point",
			  		regx1: "Pleas Select Valid Pickup Point",
			},
			agree:{required: "Please Agree With T&c"}
			
	    },
	    errorElement : 'div',
		errorPlacement: function(error, element) {
		  var placement = tjq(element).data('error');
		  if (placement) {
			tjq(placement).append(error)
		  } else {
			error.insertAfter(element);
		  }
		}
	  });
	
});
</script>
</body>
</html>