<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "vendor/autoload.php";

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Course_model', 'cmodel');
		date_default_timezone_set('Asia/Kolkata');
		ini_set('memory_limit', '-1');
	}

	public function testingEmail()
	{
		$to="jtarafder96@gmail.com";
		$subject = "Testing Email";
		$message="Mail has been send successfully.";
		echo $this->MailSystem($to, '', $subject, $message);
	}

	public function MailSystem($to, $cc, $subject, $message)
	{
		$mail = new PHPMailer(true);
		//Enable SMTP debugging.
		$mail->SMTPDebug = 0;                               
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();            
		//Set SMTP host name  
		$mail->CharSet = 'utf-8';// set charset to utf8
		//$mail->Encoding = 'base64';
		$mail->SMTPAuth = true;// Enable SMTP authentication
		$mail->SMTPSecure = 'ssl';// Enable TLS encryption, `ssl` also accepted

		$mail->Host = EMAIL_CONFIG['host'];// Specify main and backup SMTP servers
		$mail->Port = EMAIL_CONFIG['port'];// TCP port to connect to
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);		                     
		//Provide username and password     
		$mail->Username = EMAIL_CONFIG['email'];                 
		$mail->Password = EMAIL_CONFIG['password'];                                                                         

		$mail->From = 'noreply@acelnvt.org';
		$mail->FromName = 'Association of Compulsive E-Learning';

		$mail->addAddress($to);

		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $message;
		//$mail->AltBody = "This is the plain text version of the email content";

		return ($mail->send())? 1 : 0;
		//$mail->ErrorInfo;
		
	}

	public function index()
	{
		if(isset($_GET['token'])){
			$id = isset($_GET['uid'])? $_GET['uid'] : 0;
			$slug = base64_decode($_GET['token']);
			$course = $this->cmodel->get_main_course_details_by_slug($slug);
			if(!empty($course)){
				// print_r($course); exit;
				$data['token'] = $_GET['token'];
				$data['course_id'] = $course[0]->id;
				$data['course_name'] = $course[0]->title;
				// $data['redirect_url'] =  base64_decode($_GET['redirect_uri']);
				$data['states'] = $this->cmodel->get_active_states();
				$data['pageTitle'] = 'Admission | '.getMainTitle();
				if($id){
					$data['fp'] = $this->cmodel->get_candidate_for_preview($id);
				}else{
					$data['fp'][0] = (object)array('id'=>0,'candidate_name' => '', 'father_name' => '', 'gender' => '', 'dob' => '', 'nationality' => '', 'religion' => '', 'email' => '', 'mobile' => '', 'alt_mobile' => '', 'present_address' => '', 'pre_pin_code' => '', 'pre_district' => 0, 'pre_state' => 0, 'adhaar_no' => '', 'adhaar_front' => '', 'adhaar_back' => '', 'pan_no' => '', 'pan_pic' => '', 'photo_dp' => '', 'qualification' => '', 'degree_name' => '', 'board_uni' => '', 'pass_year' => '', 'grade' => '', 'status'=>1);
				}

				$data['pageName'] = 'career_apply';
				$this->load->view('home/index', $data);
			}else{
				redirect('https://mindtreeinc.com');
			}
		}else{
			redirect('https://mindtreeinc.com');
		}
	}

	public function get_districts_by_state()
	{
		$resp = array('status'=>false, 'data'=>[]);
		if(isset($_GET['stateid'])){
			$result = $this->cmodel->get_active_districts_by_stateid($_GET['stateid']);
			if(count($result)){
				$resp = array('status'=>true, 'data'=>$result);
			}
		}

		echo json_encode($resp);
	}

	public function generateEnrollment()
	{
		$yr =date('y');
		$getlastID = $this->umodel->get_last_candidate_enroll_no();

		$padToFive = ($getlastID <= 99999)? substr('00000'.$getlastID, -5) : $getlastID;

		// return 'ACEVT/'.$yr.'-'.($yr+1).'/EXAM-13/'.$padToFive;
		return 'UIDN/08/'.$padToFive;
		//ACEVT/22-23/EXAM-01/00000  ACEVT/22-23/EXAM-01/00003
	}

	public function terms_and_conditions()
	{
		$data['pageTitle'] = 'Terms abd Conditions | '.getMainTitle();
		$data['pageName'] = 'terms_and_conditions';
		$this->load->view('terms_and_conditions', $data);
	}

	public function privacy_policy($value='')
	{
		$data['pageTitle'] = 'Privay Policy | '.getMainTitle();
		$data['pageName'] = 'Privay Policy';
		$this->load->view('privacy_policy', $data);
	}
	public function check_file_type($str)
    {
        $allowed_types = array('jpg', 'jpeg', 'png');
        // Check if a file is uploaded
        if (!empty($_FILES['fl_profiledp']['name'])) {
            // Get file extension
            $ext = pathinfo($_FILES['fl_profiledp']['name'], PATHINFO_EXTENSION);
            
            // Check if file extension is allowed
            if (!in_array($ext, $allowed_types)) {
                $this->form_validation->set_message('check_file_type', 'The {field} must be a JPG, JPEG, or PNG file.');
                return FALSE;
            }
        }
        return TRUE;
    }
	public function check_addhar_front_file_type($str)
    {
        $allowed_types = array('jpg', 'jpeg', 'png');
        // Check if a file is uploaded
        if (!empty($_FILES['fl_adhaar_front']['name'])) {
            // Get file extension
            $ext = pathinfo($_FILES['fl_adhaar_front']['name'], PATHINFO_EXTENSION);
            
            // Check if file extension is allowed
            if (!in_array($ext, $allowed_types)) {
                $this->form_validation->set_message('check_addhar_front_file_type', 'The {field} must be a JPG, JPEG, or PNG file.');
                return FALSE;
            }
        }
        return TRUE;
    }
	public function check_addhar_back_file_type($str)
    {
        $allowed_types = array('jpg', 'jpeg', 'png');
        // Check if a file is uploaded
        if (!empty($_FILES['fl_adhaar_back']['name'])) {
            // Get file extension
            $ext = pathinfo($_FILES['fl_adhaar_back']['name'], PATHINFO_EXTENSION);
            
            // Check if file extension is allowed
            if (!in_array($ext, $allowed_types)) {
                $this->form_validation->set_message('check_addhar_back_file_type', 'The {field} must be a JPG, JPEG, or PNG file.');
                return FALSE;
            }
        }
        return TRUE;
    }
	public function check_pancard_file_type($str)
    {
        $allowed_types = array('jpg', 'jpeg', 'png');
        // Check if a file is uploaded
        if (!empty($_FILES['fl_pancard']['name'])) {
            // Get file extension
            $ext = pathinfo($_FILES['fl_pancard']['name'], PATHINFO_EXTENSION);
            
            // Check if file extension is allowed
            if (!in_array($ext, $allowed_types)) {
                $this->form_validation->set_message('check_pancard_file_type', 'The {field} must be a JPG, JPEG, or PNG file.');
                return FALSE;
            }
        }
        return TRUE;
    }
	public function generateCandidateID()
	{
		$getlastID = $this->cmodel->get_last_candidate_uuid();

		$padToFive = ($getlastID <= 99999)? substr('00000'.$getlastID, -5) : $getlastID;

		return 'MTI/'.date('Y').'/'.$padToFive;
		//ACEVT/22-23/EXAM-01/00000  ACEVT/22-23/EXAM-01/00003
	}
	public function submit_admission_application(){
		$resp = array('status'=>false, 'msg'=>"<p>Server fail to connect.</p>", 'amount'=>0, 'webURL'=>"");
		$this->load->library('form_validation');

		// $this->form_validation->set_rules('uid', 'User ID', 'required');
        $this->form_validation->set_rules('course_name', 'Course Name', 'required');
        $this->form_validation->set_rules('course_session', 'Session', 'required');
        $this->form_validation->set_rules('fullname', 'Candidate Name', 'required');
        $this->form_validation->set_rules('father_name', 'Father Name', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'required');
        // $this->form_validation->set_rules('religion', 'Religion', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('contact_1', 'Mobile', 'required|numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('contact_2', 'Alternate Mobile', 'numeric|min_length[10]|max_length[12]');
        $this->form_validation->set_rules('pre_address', 'Present Address', 'required');
        $this->form_validation->set_rules('pre_pincode', 'Present Pin Code', 'required|numeric|min_length[6]|max_length[6]');
        $this->form_validation->set_rules('pre_district', 'Present District', 'required');
		$this->form_validation->set_rules('pre_ddl_state', 'Present State', 'required');
		// if (!!$this->input->post('same_as_pre')) {
		// 	$this->form_validation->set_rules('per_address', 'Permanent Address', 'required');
		// 	$this->form_validation->set_rules('per_ddl_state', 'Permanent State', 'required');
		// 	$this->form_validation->set_rules('per_district', 'Permanent District', 'required');
		// 	$this->form_validation->set_rules('per_pincode', 'Permanent Pin Code', 'required|numeric|min_length[6]|max_length[6]');
		// }
		$this->form_validation->set_rules('fl_adhaar_front', 'Cover Image', 'callback_check_addhar_front_file_type');
		$this->form_validation->set_rules('fl_adhaar_back', 'Cover Image', 'callback_check_addhar_back_file_type');
		$this->form_validation->set_rules('fl_pancard', 'Cover Image', 'callback_check_pancard_file_type');
		$this->form_validation->set_rules('fl_profiledp', 'Cover Image', 'callback_check_file_type');
        $this->form_validation->set_rules('addhar_no', 'Aadhaar Number', 'required|numeric|min_length[12]|max_length[12]');
        $this->form_validation->set_rules('pan_no', 'PAN Number', 'required|min_length[10]|max_length[10]');
        $this->form_validation->set_rules('hs', 'Qualification', 'required');
        // $this->form_validation->set_rules('hsboard', 'Degree Name', 'required');
        $this->form_validation->set_rules('hsboard', 'Board/University', 'required');
        $this->form_validation->set_rules('hsyear', 'Passing Year', 'required');
        $this->form_validation->set_rules('hsgrade', 'Grade', 'required');

		if ($this->form_validation->run() === FALSE) {
			$resp['msg'] = validation_errors();
		} else {
			$token_brk = explode('~',base64_decode($_POST['token']));

			// $resp['amount'] = (int)$token_brk[2];

			$data['uid'] = $this->generateCandidateID(); 
			$data['course_id'] = $_POST['course_id']; 
			$data['course_name'] = $_POST['course_name']; 
			$data['session'] = $_POST['course_session']; 
			$data['candidate_name'] = $_POST['fullname']; 
			$data['father_name'] = $_POST['father_name']; 
			$data['gender'] = $_POST['gender']; 
			$data['dob'] = date('Y-m-d', strtotime($_POST['dob'])); 
			$data['nationality'] = strtoupper(trim($_POST['nationality'])); 
			// $data['religion'] = strtoupper(trim($_POST['religion'])); 
			$data['email'] = strtolower(trim($_POST['email'])); 
			$data['mobile'] = $_POST['contact_1']; 
			$data['alt_mobile'] = $_POST['contact_2']; 
			$data['present_address'] = $_POST['pre_address']; 
			$data['pre_pin_code'] = $_POST['pre_pincode']; 
			$data['pre_district'] = $_POST['pre_district']; 
			$data['pre_state'] = $_POST['pre_ddl_state']; 
			// $data['same_as_pre'] = $_POST['same_as_above']; 
			// if(!!$_POST['same_as_above']){
			// 	$data['permanent_address'] = $_POST['pre_address']; 
			// 	$data['per_pin_code'] = $_POST['pre_pincode']; 
			// 	$data['per_district'] = $_POST['pre_district']; 
			// 	$data['per_state'] = $_POST['pre_ddl_state'];
			// }else{
			// 	$data['permanent_address'] = $_POST['per_address']; 
			// 	$data['per_pin_code'] = $_POST['per_pincode']; 
			// 	$data['per_district'] = $_POST['per_district']; 
			// 	$data['per_state'] = $_POST['per_ddl_state'];
			// }
			
			 
			$data['adhaar_no'] = $_POST['addhar_no'];  
			$data['pan_no'] = strtoupper(trim($_POST['pan_no'])); 
			$data['qualification'] = $_POST['hs']; 
			$data['board_uni'] = $_POST['hsboard']; 
			$data['pass_year'] = $_POST['hsyear']; 
			$data['grade'] = $_POST['hsgrade']; 
			$data['status'] = $_POST['status']; 

			$upload_dir = './assets/images/candidates/';
			if (!empty($_FILES['fl_pancard']['name'])) {
                $file_name = uniqid() . '_' . $_FILES['fl_pancard']['name'];
                $file_name = str_replace(' ', '_', $file_name); // Replace spaces with underscores

                if (move_uploaded_file($_FILES['fl_pancard']['tmp_name'], $upload_dir . $file_name)) {
                    $data['pan_pic'] = $upload_dir . $file_name;
                }
            }
			if (!empty($_FILES['fl_profiledp']['name'])) {
                $file_name = uniqid() . '_' . $_FILES['fl_profiledp']['name'];
                $file_name = str_replace(' ', '_', $file_name); // Replace spaces with underscores

                if (move_uploaded_file($_FILES['fl_profiledp']['tmp_name'], $upload_dir . $file_name)) {
                    $data['photo_dp'] = $upload_dir . $file_name;
                }
            }
			if (!empty($_FILES['fl_adhaar_front']['name'])) {
                $file_name = uniqid() . '_' . $_FILES['fl_adhaar_front']['name'];
                $file_name = str_replace(' ', '_', $file_name); // Replace spaces with underscores

                if (move_uploaded_file($_FILES['fl_adhaar_front']['tmp_name'], $upload_dir . $file_name)) {
                    $data['adhaar_front'] = $upload_dir . $file_name;
                }
            }
			if (!empty($_FILES['fl_adhaar_back']['name'])) {
                $file_name = uniqid() . '_' . $_FILES['fl_adhaar_back']['name'];
                $file_name = str_replace(' ', '_', $file_name); // Replace spaces with underscores

                if (move_uploaded_file($_FILES['fl_adhaar_back']['tmp_name'], $upload_dir . $file_name)) {
                    $data['adhaar_back'] = $upload_dir . $file_name;
                }
            }
			
			if($_POST['id'] == 0){
				$cand_id = insertDataRetId('students', $data);
			}else{
				$cand_id = $_POST['id'];
				updateData('students', $data, 'id='.$cand_id);
			}
			
			$resp['webURL'] = 'admission-preview?token='.$_POST['token'].'&uid='.$cand_id;
			// $resp['amount'] = $resp['amount'];
			$resp['msg'] = $data;
			$resp['status'] = true;

		}
		echo json_encode($resp);
	}
	public function candidatePreview()
	{
		if(isset($_GET['token']) && isset($_GET['uid'])){
			$slug = base64_decode($_GET['token']);
			$course = $this->cmodel->get_main_course_details_by_slug($slug);
			$data['token'] = $_GET['token'];
			
			$amount = $price = (float)$course[0]->price;
			$discount = (int)$course[0]->discount;
			if($discount != 0){
				$amount = $price*(1 - ($discount/100));
			}

			$data['price'] = $price;
			$data['amount'] = $amount;
			$data['fp'] = $this->cmodel->get_candidate_for_preview($_GET['uid']);
			if($data['fp'][0]->status==3){
				redirect('https://mindtreeinc.com');
			}else{
				$data['pageTitle'] = 'Admission Preview | '.getMainTitle();
				$data['pageName'] = 'career_apply_preview';
				$this->load->view('home/index', $data);
			}
			
		}else{
			redirect('https://mindtreeinc.com');
		}
	}
	public function checkValidCoupon()
	{
		$resp = array('status'=>false, 'msg'=>'Coupon code not found', 'data'=>[]);
		if(isset($_GET['ccode'])){
			$code = $this->cmodel->get_coupon_by_code($_GET['ccode']);
			if($code){
				$resp = array('status'=>true, 'msg'=>'Coupon code found', 'data'=>$code);
			}
		}
		echo json_encode($resp);
	}
	public function createAdmissionPaymentOrder()
	{
		$resp = array('status'=>false, 'msg'=>"<p>Server fail to connect.</p>", 'amount'=>0, 'prim_id'=>0);
		$amount = (int)$_POST['amount'];
		$discount = (int)$_POST['discount'];
		if($discount != 0){
			$amount = $amount * (1 - ($discount/100));
		}
		$api = new Api(RAZORPAY_TEST['key_id'], RAZORPAY_TEST['key_secret']);
		$orderData = [
			'receipt'         => 'receipt_'.time(),
			'amount'          => $amount*100,
			'currency'        => 'INR'
		];
		
		$razorpayOrder = $api->order->create($orderData);

		$orderConfig = array(
			"key"=>RAZORPAY_TEST['key_id'],
			"amount"=>$amount*100,
			"currency"=>"INR",
			"name"=>"MindtreeInc.com",
			"description"=>"",
			"image"=>"",
			"order_id"=>$razorpayOrder->id,
			"prefill"=>array(
				"name"=>trim($_POST['candidate_name']),
				"email"=>$_POST['email'],
				"contact"=>$_POST['mobile']
			)
		);
		$resp['options'] = $orderConfig;
		$resp['status'] = true;
		$resp['amount'] = $amount;
		$resp['prim_id'] = $_POST['id'];

		echo json_encode($resp);
	}
	public function candidatePayment()
	{
		$success = true;

		$error = "Payment Failed";

		$api = new Api(RAZORPAY_TEST['key_id'], RAZORPAY_TEST['key_secret']);

		$amount = $_POST['response']['amount'];
		$prim_id = $_POST['response']['prim_id'];

		$order_id = $_POST['response']['razorpay_order_id'];
		$payment_id = $_POST['response']['razorpay_payment_id'];
		$signature = $_POST['response']['razorpay_signature'];

		if (empty($payment_id) === false)
		{
			try
			{
				$attributes = array(
					'razorpay_order_id' => $order_id,
					'razorpay_payment_id' => $payment_id,
					'razorpay_signature' => $signature
				);

				$api->utility->verifyPaymentSignature($attributes);
			}
			catch(SignatureVerificationError $e)
			{
				$success = false;
				$error = 'Razorpay Error : ' . $e->getMessage();
			}
		}
		$payment = $api->payment->fetch($payment_id);

		$data1['payment_id'] = $payment['id'];
		$data1['order_id'] = $payment['order_id'];
		$data1['signature_hash'] = $signature;
		$data1['amount'] = $payment['amount'];
		$data1['status'] = $payment['status'];
		$data1['bank_name'] = (($payment['bank'] != NULL)? $payment['bank'] : '');
		$data1['resp_msg'] = (($payment['error_description'] != NULL)? $payment['error_description'] : '');
		$data1['add_datetime'] = date('Y-m-d H:i:s');

		if ($success === true)
		{

			$data['status'] = ($data1['status']=='captured')? 3 : 2;
			updateData('students', $data, 'id='.$prim_id);
			
			$data1['pay_log_id'] = $prim_id;
			insertData('transaction_log', $data1);

			$resp = array('status'=>true, 'errors'=>"", 'webURI'=>'get_candidate_invoice/?pid='.base64_encode($payment['id']).'&fid='.base64_encode($prim_id));
		}
		echo json_encode($resp);
	}
	public function get_candidate_invoice()
	{
		$paymentId = base64_decode($_GET['pid']);
		$fid = base64_decode($_GET['fid']);
		
		$api = new Api(RAZORPAY_TEST['key_id'], RAZORPAY_TEST['key_secret']);

		$get_upay_log = $this->cmodel->get_user_payment_log(array('cand.id'=>$fid, 'tl.payment_id'=>$paymentId));

		$orderDetails = $api->order->fetch($get_upay_log[0]->order_id);

		$data['odetails'] = $orderDetails;
		$data['udetails'] = $get_upay_log;
		
		$data['pageTitle'] = 'Payment Receipt | '. getMainTitle();
		//$data['pageName'] = 'payment_receipt';
		$this->load->view('payment_receipt', $data);
	}

	

	/*===============================================================================================*/

}
