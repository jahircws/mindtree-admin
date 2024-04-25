<?php

use PHPUnit\Util\Json;

defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();
class Courseadmin extends CI_Controller {
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model', 'amodel');
		$this->load->model('Course_model', 'cmodel');
		// $this->load->model('User_model', 'umodel');
		date_default_timezone_set('Asia/Kolkata');
		ini_set('memory_limit', '-1');
	}
    /*================================================================================================== */
	public function course_categories()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Course Category | '.getMainTitle();
			$data['pageName'] = 'courses/course_categories';

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
	public function cuCourseCategory()
	{
		$resp = array('sttaus'=>false, 'errors'=>'<p>Something went wrong.</p>');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Category name', 'trim|required');

		if($this->form_validation->run() == FALSE){
			$resp['errors'] = validation_errors();
			// $this->session->set_flashdata('errors', validation_errors());
		}else{
			$id = $_POST['prim_id'];

			$data['title'] = trim($_POST['title']);
            $data['slug'] = strtolower(str_replace(' ', '-', $data['title']));
			$data['status'] = true;

			if($id == 0){
				$data['add_datetime'] = date('Y-m-d H:i:s');
				insertData('course_category', $data);
				$resp['status'] = true;
				$resp['errors'] = 'Category added.';
			}else{
				$data['update_datetime'] = date('Y-m-d H:i:s');
				updateData('course_category', $data, 'id='.$id);
				$resp['status'] = true;
				$resp['errors'] = 'Category updated.';
			}
		}
		echo json_encode($resp);
	}
	public function getCategoryData()
	{
		$resp = array('status'=>false, 'data'=>[]);
		if(isset($_GET['prim_id'])){
			$result = $this->cmodel->get_all_course_category($_GET['prim_id']);
			if(count($result) == 1){
				$resp['status'] = true;
				$resp['data'] = $result[0];
			}
		}
		echo json_encode($resp);
	}
	public function getCourseCategoryList()
	{
		$output = array();
		$query = "SELECT * FROM course_category cb WHERE (";

		if(isset($_POST['search']['value']))
		{
			$query .= 'cb.title LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		$query .= ') ';
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY add_datetime DESC ';
		}

		$filtered_rows = count(runQuery($query));

		if($_POST['length'] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = runQuery($query);

		$total_rows = $this->cmodel->get_course_category_count();

		$data = array();

		$i=1; 
		foreach($result as $row)
		{
			$edit_button = '';
			$delete_button = '';
			$sub_array = array();

			$sub_array[] = $i;
			$sub_array[] = $row->title;
			$sub_array[] = (($row->status)? '<div class="badge badge-success badge-shadow">Active</div>' : '<div class="badge badge-warning badge-shadow">Inactive</div>');
			
			$edit_button = '<a href="javascript:addEditCategory(`edit`, '.$row->id.');" class="btn btn-primary btn-sm" id="btn_edit_'.$row->id.'"><i class="fas fa-edit"></i></a> ';
			$delete_button = '<a href="javascript:toggleStatus('.$row->id.', '.(($row->status)? 0 : 1).');" class="btn btn-warning btn-sm ml-2" id="btn_status_'.$row->id.'"><i class="fas fa-exchange-alt"></i></a>';

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

	public function changeCoordCategoryStatus()
	{
		$data['status'] = $_POST['status'];

		echo updateData('course_category', $data, 'id='.$_POST['prim_id']);
	}

    /*================================================================================================== */
	public function course_enquiries()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Course Enquiries | '.getMainTitle();
			$data['pageName'] = 'courses/course_enquiries';

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
    /*================================================================================================== */
    public function short_courses_add($upid=NULL) 
    {
        if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Short Courses | '.getMainTitle();
			$data['pageName'] = 'courses/short_courses_add';

			if($upid){
				$data['fp'] = $this->cmodel->get_short_course_details($upid);
				// print_r($data['fp']); exit;
			}else{
				$data['fp'][0] = (object)array(
                    'id'=>0,
                    'cover_img' => '', 
                    'title' => '', 
                    'price' => 0, 
                    'discount' => 0, 
                    'details' => ''
                );;
			}

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
    }
    public function check_file_type($str)
    {
        $allowed_types = array('jpg', 'jpeg', 'png');

        // Check if a file is uploaded
        if (!empty($_FILES['fl_cover_img']['name'])) {
            // Get file extension
            $ext = pathinfo($_FILES['fl_cover_img']['name'], PATHINFO_EXTENSION);
            
            // Check if file extension is allowed
            if (!in_array($ext, $allowed_types)) {
                $this->form_validation->set_message('check_file_type', 'The {field} must be a JPG, JPEG, or PNG file.');
                return FALSE;
            }
        }
        return TRUE;
    }
    public function cuShortCourse()
    {
        $resp = array('status'=>false, 'errors'=>"<p>Server fail to connect.</p>");
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('fl_cover_img', 'Cover Image', 'callback_check_file_type');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('price', 'Price', 'numeric');

        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            $resp['errors'] = validation_errors();
        } else {
            $id = (int)$_POST['sc_id'];

            $data = array(
                'title' => $this->input->post('title'),
                'slug' => strtolower(str_replace(' ', '-', $this->input->post('title'))),
                'price' => $this->input->post('price'),
                'discount' => $this->input->post('discount'),
                'details' => $this->input->post('details'),
                'status' => true
            );
            // Handle file upload
            if (!empty($_FILES['fl_cover_img']['name'])) {
                // Define upload directory
                $upload_dir = './assets/images/short_courses/';

                // Generate a unique filename
                $file_name = uniqid() . '_' . $_FILES['fl_cover_img']['name'];
                $file_name = str_replace(' ', '_', $file_name); // Replace spaces with underscores

                // Move the uploaded file to the desired location
                if (move_uploaded_file($_FILES['fl_cover_img']['tmp_name'], $upload_dir . $file_name)) {
                    $data['cover_img'] = $upload_dir . $file_name;
                }
            }
            if($id===0){
				
				$data['add_datetime'] = date('Y-m-d H:i:s'); 
				insertData('short_courses', $data);

				$resp = array('status'=>true, 'msg'=>"<p>Short course added</p>");
			}else{
				$data['update_datetime'] = date('Y-m-d H:i:s'); 
				updateData('short_courses', $data, 'id='.$id);

				$resp = array('status'=>true, 'msg'=>"<p>Short course updated</p>");
			}
        }
        echo json_encode($resp);
    }
    public function short_courses_list()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Short Course List | '.getMainTitle();
			$data['pageName'] = 'courses/short_courses_list';
			
			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
    public function getShortCourseList()
    {
        $output = array();
		$query = "SELECT * FROM short_courses cb WHERE (";

		if(isset($_POST['search']['value']))
		{
			$query .= 'cb.title LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		$query .= ') ';
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY add_datetime DESC ';
		}

		$filtered_rows = count(runQuery($query));

		if($_POST['length'] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = runQuery($query);

		$total_rows = $this->cmodel->get_short_course_count();

		$data = array();

		$i=1; 
		foreach($result as $row)
		{
			$edit_button = '';
			$delete_button = '';
			$sub_array = array();

			$sub_array[] = $i;
            $sub_array[] = '<img src="'.base_url($row->cover_img).'" id="previewImage" alt="cover_img" class="img-thumbnail w-100" onerror="this.src=`'.base_url('assets/images/user_noimage.png').'`"/>';
			$sub_array[] = $row->title;
            $sub_array[] = 'Price: Rs.'.$row->price.'<br>Discount: '.$row->discount.'%';
			$sub_array[] = (($row->status)? '<div class="badge badge-success badge-shadow">Active</div>' : '<div class="badge badge-warning badge-shadow">Inactive</div>');
			
			$edit_button = '<a href="'.base_url('courseadmin/short_courses_add/'.$row->id).'" class="btn btn-primary btn-sm" id="btn_edit_'.$row->id.'"><i class="fas fa-edit"></i></a> ';
			$delete_button = '<a href="javascript:toggleStatus('.$row->id.', '.(($row->status)? 0 : 1).');" class="btn btn-warning btn-sm ml-2" id="btn_status_'.$row->id.'"><i class="fas fa-exchange-alt"></i></a>';

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
    public function changeShortCourseStatus()
	{
		$data['status'] = (int)$_POST['status'];

		echo updateData('short_courses', $data, 'id='.$_POST['prim_id']);
	}
    /*================================================================================================== */
    public function main_courses_add($upid=NULL)
    {
        if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Main Courses | '.getMainTitle();
			$data['pageName'] = 'courses/main_courses_add';
            $data['categories'] = $this->cmodel->get_active_course_category();
			if($upid){
				$data['fp'] = $this->cmodel->get_main_course_details($upid);
			}else{
				$data['fp'][0] = (object)array(
                    'id'=>0,
                    'category_id' => '',
                    'cover_img' => '',
                    'title' => '',
                    'price' => 0,
                    'discount' => 0,
					'eligibility' => json_encode([]),
                    'highlights' => json_encode([]), // Initialize as empty JSON object
                    'for_whom' => json_encode([]), // Initialize as empty JSON object
                    'details' => ''
                );
			}

			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
    }
    public function cuMainCourse()
    {
        $resp = array('status'=>false, 'errors'=>"<p>Server fail to connect.</p>");
        $this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('category_id', 'Category ID', 'required');
        $this->form_validation->set_rules('cover_img', 'Cover Image', 'callback_check_file_type');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('discount', 'Discount', 'numeric');
        // $this->form_validation->set_rules('highlights', 'Highlights', 'callback_check_json_array');
        // $this->form_validation->set_rules('for_whom', 'For Whom', 'callback_check_json_array');
        $this->form_validation->set_rules('details', 'Details', 'required');
    
        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            $resp['errors'] = validation_errors();
        } else {
            $id = (int)$_POST['sc_id'];

            $data = array(
                'category_id' => $this->input->post('category_id'),
                'title' => $this->input->post('title'),
                'slug' => strtolower(str_replace(' ', '-', $this->input->post('title'))),
                'price' => $this->input->post('price'),
                'discount' => $this->input->post('discount'),
                'details' => $this->input->post('details'),
				'eligibility' => json_encode($this->input->post('eligibility')),
                'highlights' => json_encode($this->input->post('highlights')),
                'for_whom' => json_encode($this->input->post('for_whom')), 
                'status' => true
            );
            // Handle file upload
            if (!empty($_FILES['fl_cover_img']['name'])) {
                // Define upload directory
                $upload_dir = './assets/images/main_courses/';

                // Generate a unique filename
                $file_name = uniqid() . '_' . $_FILES['fl_cover_img']['name'];
                $file_name = str_replace(' ', '_', $file_name); // Replace spaces with underscores

                // Move the uploaded file to the desired location
                if (move_uploaded_file($_FILES['fl_cover_img']['tmp_name'], $upload_dir . $file_name)) {
                    $data['cover_img'] = $upload_dir . $file_name;
                }
            }
            if($id===0){
				
				$data['add_datetime'] = date('Y-m-d H:i:s'); 
				insertData('courses', $data);

				$resp = array('status'=>true, 'msg'=>"<p>Course added</p>");
			}else{
				$data['update_datetime'] = date('Y-m-d H:i:s'); 
				updateData('courses', $data, 'id='.$id);

				$resp = array('status'=>true, 'msg'=>"<p>Course updated</p>");
			}
        }
        echo json_encode($resp);
    }
    public function main_courses_list()
	{
		if($this->session->has_userdata('adminData') && $_SESSION['adminData']['isLoggedIn']){
			$data['pageTitle'] = 'Course List | '.getMainTitle();
			$data['pageName'] = 'courses/main_courses_list';
			
			$this->load->view('admin/index', $data);
		}else{
			redirect(base_url('masteradmin'));
		}
	}
    public function getMainCourseList()
    {
        $output = array();
		$query = "SELECT cb.*, cc.title as category_title FROM courses cb INNER JOIN course_category cc ON cc.id = cb.category_id WHERE (";

		if(isset($_POST['search']['value']))
		{
			$query .= 'cb.title LIKE "%'.$_POST["search"]["value"].'%" ';
		}
		$query .= ') ';
		if(isset($_POST["order"]))
		{
			$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$query .= 'ORDER BY add_datetime DESC ';
		}

		$filtered_rows = count(runQuery($query));

		if($_POST['length'] != -1)
		{
			$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$result = runQuery($query);

		$total_rows = $this->cmodel->get_main_course_count();

		$data = array();

		$i=1; 
		foreach($result as $row)
		{
			$edit_button = '';
			$delete_button = '';
			$sub_array = array();

			$sub_array[] = $i;
            $sub_array[] = '<img src="'.base_url($row->cover_img).'" id="previewImage" alt="cover_img" class="img-thumbnail w-100" onerror="this.src=`'.base_url('assets/images/user_noimage.png').'`"/>';
			$sub_array[] = $row->title.'<br><strong>'.$row->category_title.'</strong>';
            $sub_array[] = 'Price: Rs.'.$row->price.'<br>Discount: '.$row->discount.'%';
			$sub_array[] = (($row->status)? '<div class="badge badge-success badge-shadow">Active</div>' : '<div class="badge badge-warning badge-shadow">Inactive</div>');
			
			$edit_button = '<a href="'.base_url('courseadmin/main_courses_add/'.$row->id).'" class="btn btn-primary btn-sm" id="btn_edit_'.$row->id.'"><i class="fas fa-edit"></i></a> ';
			$delete_button = '<a href="javascript:toggleStatus('.$row->id.', '.(($row->status)? 0 : 1).');" class="btn btn-warning btn-sm ml-2" id="btn_status_'.$row->id.'"><i class="fas fa-exchange-alt"></i></a>';

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
    public function changeMainCourseStatus()
	{
		$data['status'] = $_POST['status'];

		echo updateData('courses', $data, 'id='.$_POST['prim_id']);
	}
}

?>