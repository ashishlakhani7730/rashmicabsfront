<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
		<section id="content" class="gray-area">
            <div class="container">
                <div class="row">
				<div class="alert alert-success">
                        Oneway Offer Cab Requested Successfully
                    <span class="close"></span>
                </div>

					<div class="sidebar col-sm-4 col-md-3">
						
							<article class="detailed-logo">
							  
								<div class="details">
									<h2 class="box-title"><?php echo $ticketdetail['bookingid'];?><small><?php echo $ticketdetail['type']; ?></small></h2>
									<span class="price clearfix">
										<small class="pull-left">Total Paid</small>
										<span class="pull-right">INR. <?php echo $ticketdetail['tamount']; ?></span>
									</span>
								   
								   
								   
								</div>
							</article>
							 
							<div class="travelo-box contact-box">
								<h4>Need Any Help?</h4>
								<p>We would be more than happy to help you. Our team advisor are 24/7 at your service to help you.</p>
								<address class="contact-details">
									<span class="contact-phone"><i class="soap-icon-phone"></i> +91 9974586007</span>
									<br>
									<a class="contact-email" href="#">help@rashmicabs.com</a>
								</address>
							</div>
							
							
					</div>                  
                  <div id="printableArea"> 
                    <div id="main" class="col-sm-8 col-md-9">
                        <div class="booking-information travelo-box">
                         
                            <h2>  <img src="<?php echo base_url(); ?>assets/images/rc_dark_logo.png" width="220px" alt="RASHMI CABS" /></h2>
                            
                            <hr />
                            <div class="booking-confirmation clearfix">
                                <i class="soap-icon-recommend icon circle"></i>
                                <div class="message">
                                    <h4 class="main-message">Thank You. Your Booking Order is Confirmed Now.</h4>
                                    <p>A confirmation email has been sent to your provided email address.</p>
                                </div>
                                <a onClick="printDiv('printableArea')" value="print a div!" class="button print-button btn-small yellow-bg uppercase">Print Details</a>
                                
                            </div>
                            <hr />
                            <h2>Traveler Information</h2>
                            <dl class="term-description">
                                <dt>Booking Ref Number:</dt><dd><?php echo $ticketdetail['bookingid'];?></dd>
                                <dt>Name:</dt><dd><?php echo $ticketdetail['name'];?></dd>                         
                                <dt>E-mail address:</dt><dd><?php echo $ticketdetail['email'];?></dd>
                                <dt>Phon number:</dt><dd><?php echo $ticketdetail['mobile'];?></dd>
                                <dt>route:</dt><dd><?php echo $ticketdetail['route'];?></dd>
                               
                                 <dt>Payment Details:</dt><dd>Rs. <?php echo $ticketdetail['tamount']; ?> Paid via online</dd>
                               
                            </dl>
                            <hr />
                            <div class="row">
                             <div class="intro box table-wrapper full-width hidden-table-sms">
                                        <div class="col-sm-6 table-cell travelo-box">
                                                                    <h2>Trip Information</h2>

                                            <dl class="term-description">
                                    <dt class="feature">Vehical Type:</dt><dd class="value"><?php echo $ticketdetail['categoryname'];?></dd>
									<dt class="feature">Vehical Name:</dt><dd class="value"><?php echo $ticketdetail['vehiclename'];?></dd>
									<dt class="feature">NUMBER OF SEAT:</dt><dd class="value"><?php echo $ticketdetail['noseats'];?></dd>	
                                    <dt class="feature">Estimated Distance:</dt><dd class="value">KM.<?php echo $ticketdetail['tdistance'];?></dd>
									<dt class="feature">Extra Rate Per Km.:</dt><dd class="value">Rs.<?php echo $ticketdetail['ratekm'];?></dd>
									<dt class="feature">EXTRA Rate Per HR.:</dt><dd class="value">Rs.<?php echo $ticketdetail['ratehr'];?></dd>
								    <dt class="feature">ESTIMATED TIME:</dt><dd class="value">Rs.<?php echo $ticketdetail['totaltime'];?></dd>
									<dt class="feature">Estimated Total:</dt><dd class="value">Rs.<?php echo $ticketdetail['tamount'];?></dd>
									<dt class="feature">Additional Tax:</dt><dd class="value"><?php echo $ticketdetail['tax'];?></dd>
                                            </dl>
                                        </div>
                                        <div class="col-sm-6 table-cell">
                                            <div class="detailed-features clearfix">
                                                <div class="col-md-6 table-cell travelo-box">
                                                         <h2>Pick-up - Drop details</h2>
                                                        
                                                    
                                                    <div class="icon-box style11">
                                                        <div class="icon-wrapper">
                                                            <i class="soap-icon-clock"></i>
                                                        </div>
                                                        <dl class="details">
                                                            <dt class="skin-color">Pickup time</dt>
                                                            <dd><?php echo $ticketdetail['pickupdate'];?>  |  <?php echo $ticketdetail['pickuptime'];?></dd>
                                                        </dl>
                                                    </div>
                                                    <div class="icon-box style11">
                                                        <div class="icon-wrapper">
                                                            <i class="soap-icon-departure"></i>
                                                        </div>
                                                        <dl class="details">
                                                            <dt class="skin-color">Boarding Point</dt>
                                                            <dd><?php echo $ticketdetail['pickuppoint'];?></dd>
                                                        </dl>
                                                    </div>
													
                                                    <div class="icon-box style11">
                                                        <div class="icon-wrapper">
                                                            <i class="soap-icon-departure"></i>
                                                        </div>
                                                        <dl class="details">
                                                            <dt class="skin-color">Dropping Point</dt>
                                                            <dd><?php echo $ticketdetail['droppoint'];?></dd>
                                                        </dl>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                        </div>
                                      </div>
                            </div>
                        </div>
                    </div>
                  </div>  
                </div>
            </div>
        </section>