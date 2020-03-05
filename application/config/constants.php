<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

//use live garmentclick.
define("PAYU_LIVE","https://sandboxsecure.payu.in/_payment");
//define("PAYU_LIVE","https://secure.payu.in/_payment");
define("MERCHANT_KEY","A1Rfv0Qd"); 
define("SALT","ZBWVt3RqKX"); 


//api url define
define("FROM_CITY",                         "http://app.rashmicabs.com/index.php/API/Booking_management/from_city_list");
define("VEHICLE_CATEGORY_LIST",             "http://app.rashmicabs.com/index.php/API/Booking_management/vehicle_category");
define("CHECK_PASSENGER",                   "http://app.rashmicabs.com/index.php/API/Rgisternewuser/check_passenger");

//oneway offer
define("TO_CITY_ONEWAYOFFER",               "http://app.rashmicabs.com/index.php/API/Oneway_offer_booking/to_city_list");
define("GET_ONEWAY_OFFER_PAKAGE",           "http://app.rashmicabs.com/index.php/API/Oneway_offer_booking/get_available_package");
define("GET_REGISTER_DETAIL",				"http://app.rashmicabs.com/index.php/API/Rgisternewuser/getregisternewdetail");
define("EDIT_USER_PROFILE",					"http://app.rashmicabs.com/index.php/API/Passenger_management/PassengerEdit");
define("ONEWAY_OFFER_BOOKING",				"http://app.rashmicabs.com/index.php/API/Oneway_offer_booking/request_oneway_offer_booking");
define("ONEWAY_OFFER_INQUIRY",				"http://app.rashmicabs.com/index.php/API/Booking_management/add_booking_enquiry");

//oneway
define("TO_CITY_ONEWAY",					"http://app.rashmicabs.com/index.php/API/Oneway_booking/to_city_list");
define("GET_ONEWAY_PAKAGE",					"http://app.rashmicabs.com/index.php/API/Oneway_booking/get_available_package");
define("ONEWAY_BOOKING",					"http://app.rashmicabs.com/index.php/API/Oneway_booking/confirm_oneway_booking");

//roundtrip
define("GET_ROUNDTRIP_PAKAGE",				"http://app.rashmicabs.com/index.php/API/Roundtrip_booking/get_package_data");
define("ROUNDTRIP_BOOKING",					"http://app.rashmicabs.com/index.php/API/Roundtrip_booking/confirm_outstation_booking");

//multicity 
define("GET_MULTICITY_PAKAGE",				"http://app.rashmicabs.com/index.php/API/Multicity_booking/get_package_data");
define("MULTICITY_BOOKING",					"http://app.rashmicabs.com/index.php/API/Multicity_booking/confirm_multicity_booking");
//local
define("GET_LOCAL_PAKAGE",                  "http://app.rashmicabs.com/index.php/API/Local_booking/get_package_data");
define("LOCAL_BOOKING",						"http://app.rashmicabs.com/index.php/API/Local_booking/confirm_local_booking");

//terms & conditions
define("T_ONEWAYOFFER",						"http://app.rashmicabs.com/index.php/API/Rgisternewuser/getonewayoffer");
define("T_ONEWAY",							"http://app.rashmicabs.com/index.php/API/Rgisternewuser/getoneway");
define("T_MULTICITY",						"http://app.rashmicabs.com/index.php/API/Rgisternewuser/getmuticity");
define("T_ROUNDTRIP",						"http://app.rashmicabs.com/index.php/API/Rgisternewuser/getroundtrip");
define("T_LOCAL",							"http://app.rashmicabs.com/index.php/API/Rgisternewuser/getlocal");