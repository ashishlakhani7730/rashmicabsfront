<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php require_once("header.php"); ?>
		<div class="page-title-container">
            <div class="container">
                <div class="page-title pull-left">
                    <h2 class="entry-title"><?php if(isset($fromcity) && $fromcity != '') { echo $fromcity." - "; } ?><?php if(isset($tocity) && $tocity != '') { echo $tocity." - "; } ?>ONEWAY OFFER<?php if(isset($date) && $date != "") { echo " - ".$date; }?></h2>
                </div>
                <ul class="breadcrumbs pull-right">
                    <li><a href="<?php echo base_url(); ?>">GO TO HOME</a></li>  
					<li class="active">Cab List</li>
                </ul>
            </div>
        </div>
<section id="content">
            <div class="container">
                <div id="main">
                    <div class="row">
                        <div class="col-sm-4 col-md-3">
                          
                            <div class="toggle-container filters-container">
							<div class="panel style1 arrow-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#modify-search-panel" class="collapsed">Modify Search</a>
                                    </h4>
                                    <div id="modify-search-panel" class="panel-collapse in">
                                        <div class="panel-content">
                                            <form action="<?php echo site_url("lists/cablists"); ?>" method="post">
												<input type="hidden" name="xmldataparser" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                                                <div class="form-group">
                                                    <label>Leaving from</label>
                                                    <select id="b_from_city" name="b_from_city" class="form-control full-width select2" required>
											<option></option>
											<?php foreach($from_city_list as $c){?>

												<option value="<?php echo $this->encrypt->encode($c->id).",".$c->c_name; ?>" ><?php echo $c->c_name;?></option>

											<?php } ?>  

                                            </optgroup>

                                        </select>
                                                </div>
												  <div class="form-group">
                                                    <label>Going To</label>
                                                    <select id="b_to_city_id" name="b_to_city_id" class="form-control select2" required>

													</select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date of Journey</label>
                                                    <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="dd-mm-yyyy" required/>
                                                    </div>
                                                </div>
                                               
                                                <br />
                                                <button type="submit" class="full-width btn-medium">SEARCH CABS</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                          <div class="col-sm-8 col-md-9">
                            <form id="xmldatafo" name="xmldatafo" action="<?php echo site_url("cabonewayoffer/checkout"); ?>" method="post">
								<input type="hidden" name="xmldataparser" value="<?php echo $this->security->get_csrf_hash(); ?>">
								<input type="hidden" name="fromcity" value="<?php if(isset($fromcity) && $fromcity != '') { echo $fromcity." - "; } ?>">
								<input type="hidden" name="tocity" value="<?php if(isset($tocity) && $tocity != '') { echo $tocity." - "; } ?>">
								<input type="hidden" name="fromcityid" value="<?php if(isset($fromcityid) && $fromcityid != '') { echo $fromcityid; } ?>">
								<input type="hidden" name="tocityid" value="<?php if(isset($tocityid) && $tocityid != '') { echo $tocityid; } ?>">
								<input type="hidden" name="date" value="<?php if(isset($date) && $date != "") { echo " - ".$date; }?>">
								<input type="hidden" id="xmldata" name="xmldata" value="">
							</form>
                            <div class="car-list listing-style3 car">
								<div class="modal fade bs-modal-sm" id="authpopup" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-sm">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">Your Mobile Number</h4>
										</div>
										<div class="modal-body">
											<form action="#" class="horizontal-form">
									 <div class="form-body">
										<div class="row">
                                    
                                       <div class="col-md-12">
											<div id="moberror" class="alert alert-error">
											</div>
											<div id="mobprogress" class="progress">
											  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"
											  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
												Please Wait
											  </div>
											</div> 
                                          <div class="form-group">
                                             <label class="control-label">Enter Your 10 Digit Mobile Number<span class="required">*</span></label>
                                             <input type="text" id="mobile" name="mobile" maxlength="10" class="form-control" required>
                                             
                                          </div>
                                       </div>
                                       <!--/span--> 
										</form>
										</div>
										<div class="modal-footer">
											   <a id="book" class="button btn-small full-width">BOOK NOW</a>
											
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							</div>
							</div>
								<?php if(!empty($cablist)) { ?>
									<?php foreach($cablist as $key => $cab) { ?>
						<div class="modal fade" id="farepopup<?php echo $cab['p_id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h2 class="modal-title">Fare Detail</h2>
										</div>
										<div class="modal-body">
										<div class="form-body">
											<div class="row">
												<form action="#" class="horizontal-form">
													<div class="col-md-6">
														<h4><b>Total Distant:</b></h4>
													</div>
													<div class="col-md-6">
														<h4><?php echo $cab['total_distance_km']; ?></h4>
													</div>
													<div class="col-md-6">
														<h4><b>Rate Per KM:</b></h4>
													</div>
													<div class="col-md-6">
														<h4><?php echo $cab['p_extra_km_rate']; ?></h4>
													</div>
													<div class="col-md-6">
														<h4><b>Rate Per HR:</b></h4>
													</div>
													<div class="col-md-6">
														<h4><?php echo $cab['p_extra_hr_rate']; ?></h4>
													</div>
													<div class="col-md-6">
														<h4><b>Estimated Time:</b></h4>
													</div>
													<div class="col-md-6">
														<h4><?php echo $cab['total_time']; ?></h4>
													</div>
													<div class="col-md-6">
														<h4><b>Total Est. Rate:</b></h4>
													</div>
													<div class="col-md-6">
														
														<h4><?php echo $cab['total_estimated_rate']; ?></h4>
														
													</div>
													<div class="col-md-12">
														
															<h4>After:<b><?php echo $cab['total_time']; ?>hrs.</b>Extra Hour Charge Will Be Applied</h4>
														
													</div>
													<div class="col-md-12">
														
														<h4><?php echo $cab['final_tax']; ?></h4>
														
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
                                <article class="box">
									<?php if($cab['v_profile_pic'] == '') { ?>
                                    <figure class="col-xs-3">
                                        <span><img alt="" src="<?php echo base_url();?>/assets/images/defaultimg-01.png"></span>
                                    </figure>
									<?php } else { ?>
									<figure class="col-xs-3">
                                        <span><img alt="" src="<?php echo $cab['v_profile_pic_path']; ?>"></span>
                                    </figure>
									<?php } ?>
                                    <div class="details col-xs-9 clearfix">
                                        <div class="col-sm-6">
                                            <div class="clearfix">
                                                <h4 class="box-title"><?php echo $cab['category_name']; ?> <br>
                                               <span>
                                               	<a data-toggle="modal" href="#farepopup<?php echo $cab['p_id']; ?>" class="button btn-mini">FARE DETAILS</a>
                                               </span>
                                                </h4>
                                                
                                            </div>
                                            <div class="amenities">
                                                <ul>
                                                    <li><i class="soap-icon-user circle"></i><?php echo $cab['no_of_seats']; ?></li>
                                                    <li><i class="soap-icon-aircon circle"></i>AC</li>
													<li><i class="soap-icon-clock-1 circle"></i>Valid <?php echo date('h:i A',strtotime($cab['valid_from_time']))." TO ".date('h:i A',strtotime($cab['valid_to_time'])); ?></li>
                                                </ul>
                                            </div>
										</div>
                                        <div class="col-xs-6 col-sm-3 character">
                                            <dl class="">
                                                <dt class="skin-color">Min. Km</dt><dd><?php echo $cab['total_distance_km']; ?></dd>
                                                <dt class="skin-color">Ext. Km. Rate</dt><dd>Rs.<?php echo $cab['p_extra_km_rate']; ?></dd>
                                                <dt class="skin-color">Ext. Hr Rate</dt><dd>Rs.<?php echo $cab['p_extra_hr_rate']; ?></dd>
                                            </dl>
                                        </div>
                                        <div class="action col-xs-6 col-sm-3">
                                            <span class="price"><small style="font-weight: 800">Est. Package Rate</small><br>Rs. <?php echo $cab['total_estimated_rate']; ?>/-</span>
                                            <a  data-toggle="modal" id="<?php echo $this->encrypt->encode($cab['p_id']); ?>" href="#authpopup" class="button btn-small full-width bookingpro">BOOK</a>
                                        </div>
                                    </div>
                                </article>
								<?php } } else if(isset($cablists) && $cablists == 1) { ?>
								
									<div class="alert alert-notice"><h4>Please Search New Route From Here</h4></div><span class="close"></span></div>
								
								<?php } else if(isset($date) && $date == 1) { ?>
								
									<div class="alert alert-error"><h4>Please Select Valid Date</h4></div><span class="close"></span></div>
									
								<?php } else if(isset($city) && $city == 1) { ?>
								
									<div class="alert alert-error"><h4>Please Select Valid Fromcity And ToCity</h4></div><span class="close"></span></div>
					
								<?php } else { ?>
								
									<div class="alert alert-notice"><h4>Requested Cab Services Not  Available In This Route And Date.</h4><h4>Please Find Different Route Or Date.</h4></div>
								    <div class="alert alert-notice"><h4>Do you want to send offer inquiry? <button type="button" name="btn_inquiry_form" id="btn_inquiry_form"> YES</button></h4></div>
								   
								    <div id="inquiry_form" class="travelo-box box-full" style="display:none">
								        <div class="row">
                                            <form action="<?php echo site_url("onewayoffer/inquiry_form"); ?>" method="post" id="frm_inquiry_form">
												<input type="hidden" name="xmldataparser" value="<?php echo $this->security->get_csrf_hash(); ?>" />
												<div class="form-group">
                                                    <label>Contact</label>
                                                    <input type="text"  id="i_contact" name="i_contact" class="form-control" required>
											    </div>
                                                <div class="form-group">
                                                    <label>From city</label>
                                                    <input type="text"  id="i_from_city" name="i_from_city" class="form-control" required>
											    </div>
											    <div class="form-group">
                                                    <label>To city</label>
                                                    <input type="text"  id="i_to_city" name="i_to_city" class="form-control" required>
											    </div>
                                                <div class="form-group">
                                                    <label>Vehicle Category</label>
                                                    <select id="i_vehicle_category" name="i_vehicle_category" class="form-control select2" required>
                                                        <option>Select Category</option>
            											<?php foreach($categorylist as $c){?>
            
            												<option value="<?php echo $this->encrypt->encode($c['id']).",".$c['category_name']; ?>" ><?php echo $c['category_name'];?></option>
            
            											<?php } ?>  
													</select>
                                                </div>
                                               <div class="form-group">
                                                    <label>Plan Date</label>
                                                   <div class="datepicker-wrap">
                                                        <input type="text" name="date_from" class="input-text full-width" placeholder="dd-mm-yyyy" required/>
                                                    </div>
                                               </div>
                                               <div class="form-group">
                                                    <label>Plan Time</label>
                                                    <div class="selector">                                               
                                                        <select id="time_from" name="time_from" class="full-width" required>
    														<option value="">Select Plan Time</option>
    														<option value="01:00 AM">1:00 AM</option>
    														<option value="02:00 AM">2:00 AM</option>
    														<option value="03:00 AM">3:00 AM</option>
    														<option value="04:00 AM">4:00 AM</option>
    														<option value="05:00 AM">5:00 AM</option>
    														<option value="06:00 AM">6:00 AM</option>
    														<option value="07:00 AM">7:00 AM</option>
    														<option value="08:00 AM">8:00 AM</option>
    														<option value="09:00 AM">9:00 AM</option>
    														<option value="10:00 AM">10:00 AM</option>
    														<option value="11:00 AM">11:00 AM</option>
    														<option value="12:00 AM">12:00 AM</option>
    														<option value="01:00 PM">1:00 PM</option>
    														<option value="02:00 PM">2:00 PM</option>
    														<option value="03:00 PM">3:00 PM</option>
    														<option value="04:00 PM">4:00 PM</option>
    														<option value="05:00 PM">5:00 PM</option>
    														<option value="06:00 PM">6:00 PM</option>
    														<option value="07:00 PM">7:00 PM</option>
    														<option value="08:00 PM">8:00 PM</option>
    														<option value="09:00 PM">9:00 PM</option>
    														<option value="10:00 PM">10:00 PM</option>
                                                            <option value="11:00 PM">11:00 PM</option>
                                                            <option value="12:00 PM">12:00 PM</option>
                                                        </select>                                                
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Notes</label>
                                                    <input type="text"  id="i_notes" name="i_notes" class="form-control" required>
											    </div>
                                                <br />
                                                <button type="submit" class="full-width btn-medium">Booking Inquiry</button>

                                            </form>
                                        </div>
                                    </div>
								<?php } ?>
                            </div>           
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php require_once("footer.php"); ?>
<script>
var newpackage;
tjq(document).ready(function(){
	tjq("#moberror").hide();
	tjq("#mobprogress").hide();
	tjq("#b_from_city").select2();
	tjq("#b_to_city_id").select2();
});
tjq("select#b_from_city").change(function()
{
	var b_from_city = tjq('#b_from_city').val();
	
	tjq.ajax({
			url: '<?php echo site_url('onewayoffer/tocityajax'); ?>',
			headers: {'X-Powered-By':'ASP.NET','Authorization':'RASHMIxxxxxxxxxxxxx9'},
			method: 'post',
			data: {'xmldataparser':'<?php echo $this->security->get_csrf_hash(); ?>',b_from_city : b_from_city},
			success: function(res)
			{
				tjq('#b_to_city_id').empty();

				tjq('#b_to_city_id').html(res);
			}
    });
});
tjq('.bookingpro').click(function() {
   newpackage = this.id;
});

tjq('#btn_inquiry_form').click(function(){
    tjq('#inquiry_form').show();
    tjq('#frm_inquiry_form').trigger("reset");
});

tjq('#book').click(function() {
	
   var mobile = tjq("#mobile").val();
   if(mobile != '')
   {
	   tjq("#mobprogress").show();
	   tjq.ajax({
			url: '<?php echo site_url('cabs/bookcab'); ?>',
			headers: {'X-Powered-By': 'ASP.NET','Authorization':'RASHMIxxxxxxxxxxxxx9'},
			method: 'post',
			data: {'xmldataparser':'<?php echo $this->security->get_csrf_hash(); ?>',mobile:mobile,newpackage:newpackage,'city_from':'<?php if(isset($fromcityid)) { echo $fromcityid; } ?>','city_to':'<?php if(isset($tocityid)) { echo $tocityid; }?>'},
			success: function(res)
			{
			    console.log(res.code);
				tjq("#mobprogress").hide();
				if(res.code)
				{
		
					tjq("#moberror").hide();
					tjq("#xmldata").val(res.xmldata);
					tjq("#xmldatafo").submit();
				}
				else
				{
					tjq("#moberror").html("<h4>"+res.msg+"</h4><span class='close'></span>");
					tjq("#moberror").show();
				}
			}
		});
   }
   else
   {
	    tjq("#moberror").html("<h4>Please Enter Mobile Number</h4><span class='close'></span>");
	   tjq("#moberror").show();
   }
});
</script>
</body>
</html>