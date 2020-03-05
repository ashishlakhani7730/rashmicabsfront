<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//oneway offer route.
$route['onewayoffer/tocityajax'] = 					"Home/to_city";
$route['lists/cablists'] = 							"Cablist";
$route['cabs/bookcab'] = 							"Cablist/book_cab";
$route['cabonewayoffer/checkout'] = 				"Onewayoffercheckout";
$route['onewayoffer/checkout'] = 					"Onewayoffercheckout/oneway_offercheckout";
$route['onewayoffer/inquiry_form']=                 "Cablist/oneway_offer_booking_inquiry";

//oneway route.
$route['oneway/tocityajax'] = 						"Home/one_way_to_city";
$route['lists/onewaycablists'] = 					"Onewaycablist";
$route['onewaycabs/bookcab'] = 						"Onewaycablist/book_cab";
$route['caboneway/checkout'] = 						"Onewaycheckout";
$route['oneway/checkout'] = 						"Onewaycheckout/oneway_checkout";
$route['cabs/onewayoffline'] = 						"Onewaycheckout/offline_book";

//payumoney route.
$route['cabs/payload'] = 							"Payumoney";
$route['cabs/success']  = 							"Payumoney/redirectTosuccess";
$route['cabs/failure'] = 							"Payumoney/redirectTofail";
$route['oneway/receipt'] = 							"Onewaycheckout/receipt";
$route['local/receipt'] = 							"Localcheckout/receipt";
$route['roundtrip/receipt'] = 						"Roundtripcheckout/receipt";
$route['multicity/receipt'] = 						"Multicitycheckout/receipt";

//roundway-trips route.
$route['lists/roundcablists'] = 					"Roundtrip";
$route['roundtrip/bookcab'] = 						"Roundtrip/book_cab";
$route['cabroundway/checkout'] = 					"Roundtripcheckout";
$route['round/checkout'] = 							"Roundtripcheckout/roundtrip_checkout";
$route['cabs/roundtripoffline'] =  					"Roundtripcheckout/offline_book";

//multicity route.
$route['lists/multicitycablists'] = 				"Multicity";
$route['lists/putpackagedata'] = 					"Multicity/showpackagedata";
$route['multicity/bookcab'] = 						"Multicity/book_cab";
$route['cabmulticity/checkout'] = 					"Multicitycheckout";
$route['multicity/checkout'] = 						"Multicitycheckout/multicity_checkout";
$route['cabs/multicityoffline'] =					"Multicitycheckout/offline_book";

//localway route.
$route['lists/localcablists'] = 					"Localcablist";
$route['localcabs/bookcab'] = 						"Localcablist/book_cab";
$route['cablocalway/checkout'] = 					"Localcheckout";
$route['cabs/localoffline'] = 						"Localcheckout/offline_book";


//other static pages.
$route['cab/aboutus'] =								"Aboutus";
$route['cab/onewayoffer'] =							"Onewayoffer";
$route['cab/tariffcard'] =							"Tariffcard";
$route['cab/attachtaxi'] =							"Attachtaxi";
$route['cab/gallery'] =								"Gallery";
$route['cab/ppolicy'] =								"Ppolicy";
$route['cab/jaintirth'] = 							"Jaintirth";
$route['cab/bhavnagar'] = 							"Bhavnagar";
$route['cab/nearbhavnagar'] = 						"Nearbhavnagar";
$route['cab/gujarat'] = 							"Gujarat";
$route['cab/place_in_bvn'] = 						"Place_in_bvn";
$route['cab/placenearbvn'] = 						"Place_near_bvn";
$route['cab/place_in_guj'] = 						"Place_guj";

