<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpParser\Node\Expr\FuncCall;

require 'vendor/autoload.php';

class Masteradmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'amodel');
		$this->load->model('Course_model', 'cmodel');
		date_default_timezone_set('Asia/Kolkata');
		ini_set('memory_limit', '-1');
	}
	/*================================================================================================== */
	public function index()
	{
		if($this->session->has_userdata('adminData')){
			redirect(base_url('masteradmin/dashboard'));
		}else{
			$data['pageTitle'] = 'Admin Login | '.getMainTitle();
			$this->load->view('admin/login', $data);
		}
	}

	
	/*================================================================================================== */
	public function userAuthentication()
	{
		$resp = array('accessGranted'=>false, 'errors'=>"Something went wrong.", 'webURI'=>"");
		 $this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Useremail', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$resp['errors'] = validation_errors();
		}else{
			$email = strtolower(trim($_POST['email']));
			$password = md5(trim($_POST['password']));

			$chk_admin = $this->amodel->check_valid_admin($email);

			if(!empty($chk_admin)){
				if($password == $chk_admin[0]->password){
					$adminData = array(
						'userId'=> $chk_admin[0]->id,
						'name'=> getMainTitle().' Admin',
						'email'=> $chk_admin[0]->username,
						'isLoggedIn'=> true
					);
					$this->session->set_userdata('adminData', $adminData);
					$resp['accessGranted'] = true;
					$resp['webURI'] = 'masteradmin/dashboard';
				}else{
					$resp['errors'] = '<p>Wrong password entered.</p>';
				}
			}else{
				$resp['errors'] = '<p>Admin not found.</p>';
			}
		}

		echo json_encode($resp);
	}
	public function logout()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$this->session->unset_userdata('adminData');
			$this->session->sess_destroy();
			redirect(base_url('masteradmin'));
		}else{
			redirect(base_url('masteradmin'));
		}
	}
	/*================================================================================================== */
	public function dashboard()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Admin Dashboard | '.getMainTitle();
			$data['pageName'] = 'dashboard';
			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
	/*=============================================// COMMON //===================================================== */
	public function coupons()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Coupons | AVCET';
			$data['pageName'] = 'courses/coupons';

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
	public function cuCoupons()
	{
		$resp = array('sttaus'=>false, 'errors'=>'<p>Something went wrong.</p>');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('code', 'Code', 'trim|required');
		$this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric');
		$this->form_validation->set_rules('expiration_date', 'Expiration Date', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$resp['errors'] = validation_errors();
			// $this->session->set_flashdata('errors', validation_errors());
		}else{
			$id = $_POST['prim_id'];

			$data['code'] = trim($_POST['code']);
			$data['discount'] = trim($_POST['discount']);
			$data['expiration_date'] = trim($_POST['expiration_date']);
			$data['status'] = true;

			if($id == 0){
				insertData('coupon_codes', $data);
				$resp['status'] = true;
				$resp['errors'] = 'Coupon added.';
				// $this->session->set_flashdata('success', 'Coupon added.');
			}else{
				updateData('coupon_codes', $data, 'id='.$id);
				$resp['status'] = true;
				$resp['errors'] = 'Coupon updated.';
				// $this->session->set_flashdata('success', 'Coupon updated.');
			}
		}
		echo json_encode($resp);
		// redirect(base_url('coordcommon/coord_subjects'));
	}
	public function getCouponData()
	{
		$resp = array('status'=>false, 'data'=>[]);
		if(isset($_GET['prim_id'])){
			$result = $this->cmodel->get_all_coupons($_GET['prim_id']);
			if(count($result) == 1){
				$resp['status'] = true;
				$resp['data'] = $result[0];
			}
		}
		echo json_encode($resp);
	}
	public function getCouponList()
	{
		$output = array();
		$query = "SELECT * FROM coupon_codes cb WHERE (";

		if(isset($_POST['search']['value']))
		{
			$query .= 'cb.code LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		$query .= ') ';
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY created_at DESC ';
		}

		$filtered_rows = count(runQuery($query));

		if($_POST['length'] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = runQuery($query);

		$total_rows = $this->cmodel->get_coupon_codes_count();

		$data = array();

		$i=1; 
		foreach($result as $row)
		{
			$edit_button = '';
			$delete_button = '';
			$sub_array = array();

			$sub_array[] = $i;
			$sub_array[] = $row->code;
			$sub_array[] = $row->discount;
			$sub_array[] = date('jS M Y', strtotime($row->expiration_date));
			$sub_array[] = (($row->status)? '<div class="badge badge-success badge-shadow">Active</div>' : '<div class="badge badge-warning badge-shadow">Inactive</div>');
			
			$edit_button = '<a href="javascript:addEditCoupon(`edit`, '.$row->id.');" class="btn btn-primary btn-sm" id="btn_edit_'.$row->id.'"><i class="fas fa-edit"></i></a> ';
			$delete_button = '<a href="javascript:toggleStatus('.$row->id.', '.(($row->status)? false : true).');" class="btn btn-warning btn-sm ml-2" id="btn_status_'.$row->id.'"><i class="fas fa-exchange-alt"></i></a>';

			$sub_array[] = $edit_button . ' ' . $delete_button;

			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"		=>	intval($_POST["draw"]),
			"recordsTotal"	=>	$total_rows,
			"recordsFiltered"	=>	$filtered_rows,
			"data"		=>	$data
		);
		echo json_encode($output);
	}
	public function changeCouponStatus()
	{
		$data['status'] = $_POST['status'];

		echo updateData('coupon_codes', $data, 'id='.$_POST['prim_id']);
	}
	/*================================================================================================== */
	/* States*/
	public function states()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'States | AVCET';
			$data['pageName'] = 'states';
			$data['states'] = $this->amodel->get_all_states();

			if(isset($_GET['state_id'])){
				$data['dist'] = $this->amodel->get_all_districts($_GET['state_id']);
			}else{
				$data['dist'][0] = (object)array('id'=>0, 'name'=>"");
			}

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
	/*DISTRICT*/
	public function districts()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Districts | AVCET';
			$data['pageName'] = 'districts';
			$data['districts'] = $this->amodel->get_all_districts();

			if(isset($_GET['id'])){
				$data['dist'] = $this->amodel->get_all_districts($_GET['id']);
			}else{
				$data['dist'][0] = (object)array('id'=>0, 'name'=>"");
			}

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
	public function cuDistrict()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('district_name', 'District name', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', validation_errors());
		}else{
			$id = $_POST['prim_id'];

			$data['name'] = trim($_POST['district_name']);
			$data['is_active'] = true;

			if($id == 0){
				$data['add_datetime'] = date('Y-m-d H:i:s');
				insertData('district', $data);
				$this->session->set_flashdata('success', 'District added.');
			}else{
				$data['update_datetime'] = date('Y-m-d H:i:s');
				updateData('district', $data, 'id='.$id);
				$this->session->set_flashdata('success', 'District updated.');
			}
		}
		redirect(base_url('masteradmin/districts'));
	}
	public function changeDistrictStatus()
	{
		$data['district_status'] = $_POST['status'];

		echo updateData('district', $data, 'districtid='.$_POST['prim_id']);
	}

	/*================================================================================================== */
	public function candidates()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Candidates | '.getMainTitle();
			$data['pageName'] = 'courses/candidates';
			$data['states'] = $this->cmodel->get_active_states();
			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
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
	public function getCandidateReport() 
	{
		$output = array();
		$state_id = $_POST['state_id'];
		$district_id = $_POST['district_id'];
		$status = $_POST['status'];
		$date_range = $_POST['date_range'];

		$query = "SELECT cb.*, ss.state_title, dt.district_title FROM students cb INNER JOIN state ss ON ss.state_id = cb.pre_state LEFT JOIN district dt ON dt.districtid = cb.pre_district WHERE true";

		if($district_id != 0){
			$query .= ' AND (cb.pre_district = '.$district_id.')';
		}
		if($state_id != 0){
			$query .= ' AND (cb.pre_state = '.$state_id.')';
		}
		if($status != 0){
			$query .= ' AND (cb.status = '.$status.')';
		}
		if($date_range != ""){
			$dates = explode(' - ', $date_range);
			$start_date = date('Y-m-d H:i:s', strtotime(trim($dates[0])));
			$end_date = date('Y-m-d H:i:s', strtotime(trim($dates[1]) . ' 23:59:59'));

			$query .= ' AND (add_datetime >= '.$start_date.' AND add_datetime <= '.$end_date.')';
		}
		if(isset($_POST['search']['value']))
		{
			$query .= ' AND (cb.candidate_name LIKE "%'.$_POST["search"]["value"].'%" OR cb.uid LIKE "%'.$_POST["search"]["value"].'%" OR cb.email LIKE "%'.$_POST["search"]["value"].'%" OR cb.course_name LIKE "%'.$_POST["search"]["value"].'%" OR cb.session LIKE "%'.$_POST["search"]["value"].'%") ';
		}
		if(isset($_POST["order"]))
		{
			$query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= ' ORDER BY cb.add_datetime DESC ';
		}

		$filtered_rows = count(runQuery($query));

		if($_POST['length'] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = runQuery($query);

		$total_rows = $this->cmodel->get_total_candidates();

		$data = array();

		$i=1; 
		$stats = array('NA', 'Preview', 'Expired', 'Enrolled', 'Completed', 'Failed', 'Rejected');
		foreach($result as $row)
		{
			$edit_button = '';
			$delete_button = '';
			// $complete_btn = '<button type="button" class="btn btn-success btn-sm mr-3" id="btn_yes_'.$row->id.'" onClick="updateCandidateStatus('.$row->id.', 2)"><i class="fas fa-check"></i></button>';
			// $reject_btn = '<button type="button" class="btn btn-warning btn-sm mr-3" id="btn_no_'.$row->id.'" onClick="updateCandidateStatus('.$row->id.', 3)"><i class="fas fa-times"></i></button>';

			$sub_array = array();

			$sub_array[] = $i;
			$sub_array[] = '<div class="badge badge-primary badge-shadow">'.strtoupper($row->uid).'</div><br>'.trim($row->candidate_name);
			$sub_array[] = $row->course_name;
			$sub_array[] = $row->email.'<br>'.$row->mobile;
			$sub_array[] = date('jS M Y, h:ia',strtotime($row->add_datetime));
			$sub_array[] = '<div class="badge badge-info badge-shadow">'.$stats[$row->status].'</div>';
			
			$edit_button = '<button type="button" class="btn btn-success btn-sm mr-3" id="btn_view_'.$row->id.'" onClick="viewCandidateDetails('.$row->id.')"><i class="fas fa-eye"></i></button>  <button type="button" class="btn btn-info btn-sm mr-3" id="btn_view_'.$row->id.'" onClick="openCandidateStatus('.$row->id.', '.$row->status.')"><i class="fas fa-user-cog"></i></button>';
			// if($row->status == 1){
			// 	$edit_button .= $complete_btn." ".$reject_btn;
			// }
			//<a href="'.base_url('coordinatoradmin/tjp_surveys/'.$row->id).'" class="btn btn-info btn-sm"><i class="fas fa-user-edit"></i></a>
			//$delete_button = '<button type="button" id="btn_status_'.$row->id.'" class="btn btn-danger btn-sm" onClick="toggleStatus('.$row->id.', `'.(($row->status==='1')? '2' : '1').'`)">'.(($row->status==='1')? '<i class="fas fa-user-times"></i>' : '<i class="fas fa-user-check"></i>').'</button>';

			$sub_array[] = $edit_button . ' ' . $delete_button;

			$data[] = $sub_array;
			$i++;
		}

		$output = array(
			"draw"		=>	intval($_POST["draw"]),
			"recordsTotal"	=>	$total_rows,
			"recordsFiltered"	=>	$filtered_rows,
			"data"		=>	$data
		);
		echo json_encode($output);
	}

	public function updateCandidateStatus() {
		$cand_id = $_POST['cand_id'];
		$status = $_POST['ddl_status'];

		$data['status'] = $status;

		echo updateData('students', $data, 'id='.$cand_id);
	}

	public function getCandidateData()
	{
		$tjp_id = (isset($_GET['id']))? $_GET['id'] : 0;

		$teacher_data = $this->cmodel->get_candidate_for_preview($tjp_id);
		if (empty($teacher_data)) {
            $this->output->set_status_header(400);
            $this->output->set_content_type('application/json')->set_output(json_encode(['error' => 'Candidate data not found.']));
            return;
        }
		$view_data['tjp'] = $teacher_data;
        $html_content = $this->load->view('admin/courses/candidate_view', $view_data, true);

        // Return data as JSON
        $this->output->set_content_type('application/json')->set_output(json_encode(['html_content' => $html_content]));
	}
	/*================================================================================================== */


	/*================================================================================================== */


	/*================================================================================================== */
}