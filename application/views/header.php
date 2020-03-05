<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->output->set_header("X-Powered-By: ASP.NET"); ?>
<!DOCTYPE html>
<html> 
<head>
    <title>Welcome to Rashmi Cabs</title>
    <meta charset="utf-8">
    <meta name="keywords" content="Welcome to Rashmi  Travels" />
    <meta name="description" content="Welcome to Rashmi  Travels">
    <meta name="author" content="Greenworld Technologies">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/animate.min.css">
	<link href="<?php echo base_url();?>assets/js/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/js/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/components/revolution_slider/css/settings.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/components/revolution_slider/css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/components/jquery.bxslider/jquery.bxslider.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/components/flexslider/flexslider.css" media="screen" />
    <link id="main-style" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/updates.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">
    <!--<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/pace.min.js" data-pace-options='{ "ajax": false }'></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/page-loading.js"></script>-->
	<script type="text/javascript">
	function printDiv(invoice) { var printContents = document.getElementById(invoice).innerHTML; var originalContents = document.body.innerHTML; document.body.innerHTML = printContents; window.print(); document.body.innerHTML = originalContents;}
	</script>
	<style>.error{color:red}</style>
    <style>
body {margin:0;height:2000px;}

.icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  z-index: 999999;
}

.icon-bar a {
  display: block;
  text-align: center;
  padding: 16px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.icon-bar a:hover {
  background-color: #000;
}

.facebook {
  background: #3B5998;
  color: white;
}

.twitter {
  background: #55ACEE;
  color: white;
}

.google {
  background: #dd4b39;
  color: white;
}

.linkedin {
  background: #007bb5;
  color: white;
}

.youtube {
  background: #bb0000;
  color: white;
}

.content {
  margin-left: 75px;
  font-size: 30px;
}
</style>
</head>
<body>
	<div id="page-wrapper">
        <header id="header" class="navbar-static-top">
             <div class="topnav hidden-xs">
                <div class="container">
                    <ul class="quick-menu pull-left">
                        <li><a href="#">MAIL US: care@rashmicabs.com</a></li>
                       
                    </ul>
                    <ul class="quick-menu pull-right">
                        <li><a href="#">CALL US: +91 99745 86007 / +91 97263 47007</a></li>
                       
                    </ul>
                </div>
            </div>
            
            <div class="main-header">
                <input type="hidden" id="asp_secure_data" name="asp_secure_data" value="<?php echo $this->security->get_csrf_hash(); ?>">
                <a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
                    Mobile Menu Toggle                </a>

                <div class="container">
                    <h1 class="logo navbar-brand">
                        <a href="<?php echo base_url(); ?>" >
                            <img src="<?php echo base_url(); ?>assets/images/rc_gold_logo.png" width="280px" alt="Rashmi Cabs" />                        </a>                    </h1>

                    <nav id="main-menu" role="navigation">
                        <ul class="menu">
                            <li class="menu-item-has-children active"><a href="<?php echo base_url(); ?>">Home</a></li>
							 <li class="menu-item-has-children"><a href="<?php echo site_url("cab/aboutus"); ?>">About Us</a></li>
							  <li class="menu-item-has-children"><a href="<?php echo site_url("cab/onewayoffer"); ?>">ONEWAY OFFER</a></li>
							    <li class="menu-item-has-children"><a href=<?php echo site_url("cab/tariffcard"); ?>>TARIFF CARD</a></li>
								   <li class="menu-item-has-children"><a href="<?php echo site_url("cab/attachtaxi"); ?>">ATTACH TAXI</a></li>
								   <li class="menu-item-has-children"><a href="<?php echo site_url("cab/gallery"); ?>">GALLERY</a></li>
                        </ul>
                    </nav>
                </div>
                
                <nav id="mobile-menu-01" class="mobile-menu collapse">
                    <ul id="mobile-primary-menu" class="menu">
                         <li class="menu-item-has-children"><a href="<?php echo base_url(); ?>">Home</a></li>
							 <li class="menu-item-has-children"><a href="<?php echo site_url("cab/aboutus"); ?>">About Us</a></li>
							  <li class="menu-item-has-children"><a href="<?php echo site_url("cab/onewayoffer"); ?>">Oneway Offer</a></li>
							    <li class="menu-item-has-children"><a href="<?php echo site_url("cab/tariffcard"); ?>">Tariff Card</a></li>
								   <li class="menu-item-has-children"><a href="<?php echo site_url("cab/attachtaxi"); ?>">Attach Taxi</a></li>
								   <li class="menu-item-has-children"><a href="<?php echo site_url("cab/gallery"); ?>">Gallery</a></li>
                    </ul>
                </nav>
            </div>  
        </header>