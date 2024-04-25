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
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['terms-conditions'] = 'home/terms_and_conditions';
$route['privacy-policy'] = 'home/privacy_policy';
$route['submitAdmissionApplication'] = 'home/submit_admission_application';
$route['admission-preview'] = 'home/candidatePreview';
$route['candidatePayment'] = 'home/candidatePayment';
$route['createAdmissionPaymentOrder'] = 'home/createAdmissionPaymentOrder';
$route['checkValidCoupon'] = 'home/checkValidCoupon';
$route['get_candidate_invoice'] = 'home/get_candidate_invoice';

$route['start-survey/(:any)'] = 'survey/survey_start/$1';

$route['exam_apply'] = 'home/exam_apply';
$route['devexam_apply'] = 'home/devexam_apply';
$route['getEMailOTP'] = 'home/getEMailOTP';

$route['exam_apply_preview'] = 'home/exam_apply_preview';

$route['partnership'] = 'home/partnership';
$route['check_partnership_details'] = 'home/check_partnership_details';
$route['partnershipPayment'] = 'home/partnershipPayment';
$route['get_partnership_invoice'] = 'home/get_partnership_invoice';



$route['setPaymentOrder'] = 'home/setPaymentOrder';
$route['paymentStatus'] = 'home/paymentStatus';
$route['get_payment_invoice'] = 'home/get_payment_invoice';

$route['registration'] = 'registration/index';
$route['check_qualified_enrollment'] = 'registration/check_qualified_enrollment';
$route['get_registration'] = 'registration/get_registration';
$route['preview_registration'] = 'registration/preview_registration';
$route['preview_details'] = 'registration/preview_details';
$route['complete_registration'] = 'registration/complete_registration';
$route['registration_payment'] = 'registration/registration_payment';

$route['live_exam'] = 'home/live_exam';

/*--------AJAX CALLS-------*/
$route['check_enrollment'] = 'home/check_enrollment';