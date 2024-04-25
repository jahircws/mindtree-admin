<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

	public function __construct()
	{
		// $this->videodb = $this->load->database('videodb', TRUE);
	}

	/*=============================================================*/
	public function get_candidate_dtls_video()
	{
		/*'ACEVT/22-23/EXAM-01/00241',
			'ACEVT/22-23/EXAM-01/00240',
			'ACEVT/22-23/EXAM-01/00237',
			'ACEVT/22-23/EXAM-01/00034',
			'ACEVT/22-23/EXAM-01/00068',
			'ACEVT/22-23/EXAM-01/00105',
			'ACEVT/22-23/EXAM-01/00092',
			'ACEVT/22-23/EXAM-01/00190',
			'ACEVT/22-23/EXAM-01/00445',
			'ACEVT/22-23/EXAM-01/00555',
			'ACEVT/22-23/EXAM-01/00008',
			'ACEVT/22-23/EXAM-01/00061',
			'ACEVT/22-23/EXAM-01/00099',
			'ACEVT/22-23/EXAM-01/00154',
			'ACEVT/22-23/EXAM-01/00065',
			'ACEVT/22-23/EXAM-01/00228',
			'ACEVT/22-23/EXAM-01/00274',
			'ACEVT/22-23/EXAM-01/00310',
			'ACEVT/22-23/EXAM-01/00388',
			'ACEVT/22-23/EXAM-01/00333',
			'ACEVT/22-23/EXAM-01/00347',
			'ACEVT/22-23/EXAM-01/00435',
			'ACEVT/22-23/EXAM-01/00311',
			'ACEVT/22-23/EXAM-01/00694',
			'ACEVT/22-23/EXAM-01/00676',
			'ACEVT/22-23/EXAM-01/00692',
			'ACEVT/22-23/EXAM-01/00665',
			'ACEVT/22-23/EXAM-01/00822',
			'ACEVT/22-23/EXAM-01/00961',
			'ACEVT/22-23/EXAM-01/00390',
			'ACEVT/22-23/EXAM-01/00180',
			'ACEVT/22-23/EXAM-01/00867',
			'ACEVT/22-23/EXAM-01/00443',
			'ACEVT/22-23/EXAM-01/00891',
			'ACEVT/22-23/EXAM-01/00113',
			'ACEVT/22-23/EXAM-01/00117',
			'ACEVT/22-23/EXAM-01/00134',
			'ACEVT/22-23/EXAM-01/01333',
			'ACEVT/22-23/EXAM-01/01332',
			'ACEVT/22-23/EXAM-01/00429',
			'ACEVT/22-23/EXAM-01/00712',
			'ACEVT/22-23/EXAM-01/01178',
			'ACEVT/22-23/EXAM-01/01224',
			'ACEVT/22-23/EXAM-01/01327',
			'ACEVT/22-23/EXAM-01/01223',
			'ACEVT/22-23/EXAM-01/01254',
			'ACEVT/22-23/EXAM-01/01244',
			'ACEVT/22-23/EXAM-01/01293',
			'ACEVT/22-23/EXAM-01/00673',
			'ACEVT/22-23/EXAM-01/00553',
			'ACEVT/22-23/EXAM-01/00930',
			'ACEVT/22-23/EXAM-01/00446',
			'ACEVT/22-23/EXAM-01/00810',
			'ACEVT/22-23/EXAM-01/00722',
			'ACEVT/22-23/EXAM-01/00723',
			'ACEVT/22-23/EXAM-01/00405',
			'ACEVT/22-23/EXAM-01/00318',
			'ACEVT/22-23/EXAM-01/00677',
			'ACEVT/22-23/EXAM-01/01132',
			'ACEVT/22-23/EXAM-01/01117',
			'ACEVT/22-23/EXAM-01/01376',
			'ACEVT/22-23/EXAM-01/01360',
			'ACEVT/22-23/EXAM-01/00762',
			'ACEVT/22-23/EXAM-01/00760',
			'ACEVT/22-23/EXAM-01/00773',
			'ACEVT/22-23/EXAM-01/00770',
			'ACEVT/22-23/EXAM-01/00859',
			'ACEVT/22-23/EXAM-01/01129',
			'ACEVT/22-23/EXAM-01/00831',
			'ACEVT/22-23/EXAM-01/00761',
			'ACEVT/22-23/EXAM-01/00796',
			'ACEVT/22-23/EXAM-01/01571',
			'ACEVT/22-23/EXAM-01/01572',
			'ACEVT/22-23/EXAM-01/01573',
			'ACEVT/22-23/EXAM-01/01007',
			'ACEVT/22-23/EXAM-01/01317',
			'ACEVT/22-23/EXAM-01/01322',
			'ACEVT/22-23/EXAM-01/00973',
			'ACEVT/22-23/EXAM-01/00925',
			'ACEVT/22-23/EXAM-01/00635',
			'ACEVT/22-23/EXAM-01/01001',
			'ACEVT/22-23/EXAM-01/00150',
			'ACEVT/22-23/EXAM-01/00987',
			'ACEVT/22-23/EXAM-01/00989',
			'ACEVT/22-23/EXAM-01/01852',
			'ACEVT/22-23/EXAM-01/01853',
			'ACEVT/22-23/EXAM-01/01857',
			'ACEVT/22-23/EXAM-01/01869',
			'ACEVT/22-23/EXAM-01/01880',
			'ACEVT/22-23/EXAM-01/01881',
			'ACEVT/22-23/EXAM-01/01893',
			'ACEVT/22-23/EXAM-01/01903',
			'ACEVT/22-23/EXAM-01/01907',
			'ACEVT/22-23/EXAM-01/01914',
			'ACEVT/22-23/EXAM-01/01915',
			'ACEVT/22-23/EXAM-01/01916',
			'ACEVT/22-23/EXAM-01/01917',
			'ACEVT/22-23/EXAM-01/01022',
			'ACEVT/22-23/EXAM-01/01889',
			'ACEVT/22-23/EXAM-01/01891',
			'ACEVT/22-23/EXAM-01/01905',
			'ACEVT/22-23/EXAM-01/01906',
			'ACEVT/22-23/EXAM-01/01872',
			'ACEVT/22-23/EXAM-01/01196',
			'ACEVT/22-23/EXAM-01/01873',
			'ACEVT/22-23/EXAM-01/01092',
			'ACEVT/22-23/EXAM-01/01848',
			'ACEVT/22-23/EXAM-01/01851',
			'ACEVT/22-23/EXAM-01/01009',
			'ACEVT/22-23/EXAM-01/00380',
			'ACEVT/22-23/EXAM-01/00372',
			'ACEVT/22-23/EXAM-01/02829',
			'ACEVT/22-23/EXAM-01/01121',
			'ACEVT/22-23/EXAM-01/02811',
			'ACEVT/22-23/EXAM-01/01148',
			'ACEVT/22-23/EXAM-01/00932',
			'ACEVT/22-23/EXAM-01/00067',
			'ACEVT/22-23/EXAM-01/00022',
			'ACEVT/22-23/EXAM-01/02812',
			'ACEVT/22-23/EXAM-01/00042',
			'ACEVT/22-23/EXAM-01/00145',
			'ACEVT/22-23/EXAM-01/00202',
			'ACEVT/22-23/EXAM-01/01208',
			'ACEVT/22-23/EXAM-01/00162',
			'ACEVT/22-23/EXAM-01/01020',
			'ACEVT/22-23/EXAM-01/00198',
			'ACEVT/22-23/EXAM-01/01083',
			'ACEVT/22-23/EXAM-01/00999',
			'ACEVT/22-23/EXAM-01/01075',
			'ACEVT/22-23/EXAM-01/00243',
			'ACEVT/22-23/EXAM-01/00225',
			'ACEVT/22-23/EXAM-01/00248',
			'ACEVT/22-23/EXAM-01/00246',
			'ACEVT/22-23/EXAM-01/00249',
			'ACEVT/22-23/EXAM-01/01186',
			'ACEVT/22-23/EXAM-01/00224',
			'ACEVT/22-23/EXAM-01/00250',
			'ACEVT/22-23/EXAM-01/00235',
			'ACEVT/22-23/EXAM-01/00253',
			'ACEVT/22-23/EXAM-01/00260',
			'ACEVT/22-23/EXAM-01/00263',
			'ACEVT/22-23/EXAM-01/00261',
			'ACEVT/22-23/EXAM-01/00280',
			'ACEVT/22-23/EXAM-01/00271',
			'ACEVT/22-23/EXAM-01/00282',
			'ACEVT/22-23/EXAM-01/01263',
			'ACEVT/22-23/EXAM-01/02626',
			'ACEVT/22-23/EXAM-01/01220',
			'ACEVT/22-23/EXAM-01/02025',
			'ACEVT/22-23/EXAM-01/02182',
			'ACEVT/22-23/EXAM-01/01262',
			'ACEVT/22-23/EXAM-01/01248',
			'ACEVT/22-23/EXAM-01/00285',
			'ACEVT/22-23/EXAM-01/01151',
			'ACEVT/22-23/EXAM-01/02467',
			'ACEVT/22-23/EXAM-01/02788'*/
		$this->db->select('cbk.name, cbk.enroll_no, cbk.mobile, subject_title as subject, "active" as status, NOW() as add_datetime')->from('candidates_wb cbk');
		$this->db->join('subject_teacher st', 'st.id=cbk.subject_id', 'left');
		$this->db->where_in('cbk.enroll_no', array(
			'ACEVT/22-23/EXAM-01/01853',
			'ACEVT/22-23/EXAM-01/01857',
			'ACEVT/22-23/EXAM-01/01880',
			'ACEVT/22-23/EXAM-01/01881',
			'ACEVT/22-23/EXAM-01/01916',
			'ACEVT/22-23/EXAM-01/01092',
			'ACEVT/22-23/EXAM-01/00162',
			'ACEVT/22-23/EXAM-01/01020',
			'ACEVT/22-23/EXAM-01/00282'));
		return $this->db->get()->result_array();
	}
	/*=============================================================*/

	public function cu_candidate_reg_and_payment($data, $data1, $chk_adm_dtls, $user_id)
	{
		$this->db->trans_begin();

		if($chk_adm_dtls == 0){
			$data['status'] = 'complete';
			$data1['add_datetime'] = $data['add_datetime'] = date('Y-m-d H:i:s');

			if(insertData('user_registration_dtls', $data)){
				insertData('user_payment_log', $data1);
			}else{
				$this->db->trans_rollback();
			}
		}else{
			$data['update_datetime'] = date('Y-m-d H:i:s');
			if(updateData('user_registration_dtls', $data, 'user_id='.$user_id)){
				updateData('user_payment_log', $data1, 'userid='.$user_id);
			}else{
				$this->db->trans_rollback();
			}
		}

		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
	}
	/*=============================================================*/
	public function check_valid_admin($email)
	{
		$this->db->where('username', $email);
		return $this->db->get('admin')->result();
	}

	public function get_total_candidate_login()
	{
		return $this->videodb->get('candidate_login')->num_rows();
	}

	public function get_all_districts($id = 0)
	{
		if($id != 0){
			$this->db->where('id', $id);
		}
		$this->db->order_by('district_title', 'ASC');
		return $this->db->get('district')->result();
	}

	public function get_all_subjects($id = 0)
	{
		if($id != 0){
			$this->db->where('id', $id);
		}
		$this->db->order_by('add_datetime', 'DESC');
		return $this->db->get('subject_teacher')->result();
	}

	public function get_all_subjects_with_total_questions()
	{
		$this->db->select('st.*, ( select count(id) from questions ques where ques.subject_id = st.id ) as ques_count');
		$this->db->order_by('st.add_datetime', 'DESC');
		return $this->db->get('subject_teacher st')->result();
	}

	/*==============================================================================*/
	public function get_candidate_from_enroll($enroll)
	{
		$this->db->select('cbk.id as cand_id,, cbk.status as cbk_status, uad.status as uad_status, cbk.*, uad.*, st.subject_title')->from('candidates_wb cbk');
		$this->db->join('user_registration_dtls uad', 'uad.user_id = cbk.id', 'left');
		$this->db->join('subject_teacher st', 'st.id = cbk.subject_id', 'left');
		$this->db->where('cbk.enroll_no', $enroll);
		return $this->db->get()->result();
	}
	public function get_all_candidate_list_with_no_enroll()
	{
		// $this->db->where('enroll_no', "");
		// $this->db->or_where('subject_id', 0);
		// $this->db->or_where('location_id', 0);
		$this->db->order_by('name', 'ASC');
		return $this->db->get('candidates_wb')->result();
	}
	public function get_total_candidates()
	{
		return $this->db->get('candidates_wb')->num_rows();
	}
	public function get_user_payment_log_dtls($enroll, $user_id, $payment_type)
	{
		$this->db->where(array('userid'=>$user_id, 'enroll_no'=>$enroll, 'payment_type'=>$payment_type));
		return $this->db->get('user_payment_log')->result();
	}
	public function check_existing_transaction_log($upli_id)
	{
		$this->db->where('pay_log_id', $upli_id);
		return $this->db->get('transaction_log')->num_rows();
	}
	public function get_all_candidate_list($dist)
	{
		if($dist != "all"){
			$this->db->where('location_id', $dist);
		}
		$this->db->order_by('add_datetime', 'DESC');
		return $this->db->get('candidates_wb')->result();
	}

	public function get_all_candidate_list_for_video($dist)
	{
		$cand = array();
		$query = $this->videodb->select('enroll_no')->get('candidate_login')->result();
		foreach($query as $value){
			array_push($cand, $value->enroll_no);
		}

		if($dist != "all"){
			$this->db->where('location_id', $dist);
		}
		if(!empty($cand)){
			$this->db->where_not_in('enroll_no', $cand);
		}
		$this->db->order_by('add_datetime', 'DESC');
		return $this->db->get('candidates_wb')->result();
	}
	public function get_candidate_details_by_IDlist($cand_ids)
	{
		$this->db->select('cbk.name, cbk.enroll_no, cbk.dob, cbk.mobile, st.subject_title, urd.profile_dp, urd.signature')->from('candidates_wb cbk');
		$this->db->join('subject_teacher st', 'st.id=cbk.subject_id', 'inner');
		$this->db->join('user_registration_dtls urd', 'urd.user_id=cbk.id', 'left');
		$this->db->where_in('cbk.id', $cand_ids);
		return $this->db->get()->result();
	}
	public function get_candidate_video_details($enroll)
	{
		$this->videodb->where_in('enroll_no', $enroll);
		return $this->videodb->get('candidate_login')->result();
	}

	public function check_valid_enrollment($enroll)
	{
		$this->db->where('enroll_no', $enroll);
		return $this->db->get('candidates_wb')->num_rows();
	}

	public function get_candidate_by_enroll($enroll)
	{
		$this->db->select('cw.enroll_no, cw.name, cw.email, cw.mobile, CONCAT(cw.address, ", ", cw.block, ", ", cw.discrict, "-", cw.pin) as fulladdress, urd.bank_name, urd.account_no, urd.branch_name, urd.ifsc_code');
		$this->db->from('candidates_wb as cw');
		$this->db->join('user_registration_dtls as urd', 'urd.user_id = cw.id', 'left');
		$this->db->where('cw.enroll_no', $enroll);
		return $this->db->get()->result();
	}

	public function check_payment_exist($prim_id)
	{
		$this->db->select("cbk.teacher, cbk.coordinator, (select count(id) from user_payment_log where userid=".$prim_id." and payment_type='exam_fees') as ubl")->from('candidates_wb cbk');
		$this->db->where('cbk.id', $prim_id);
		return $this->db->get()->result();
	}

	public function get_all_candidate_list_by_status($params)
	{
		if($params == 'applied'){

			$this->db->select('cbk.id as cbk_id, cbk.*, CONCAT(pt.first_name, " ", pt.last_name) as refer_name, upl.id as upl_id, upl.fees, upl.payment_status, upl.payment_type')->from('candidates_wb cbk');
			$this->db->join('user_payment_log upl', 'upl.userid = cbk.id', 'left');
			$this->db->join('partnership pt', 'pt.upid = cbk.partnership_id', 'left');
			$this->db->where(array('cbk.teacher !='=>'','upl.payment_type'=>'exam_fees'));
			$this->db->where_in('cbk.status',array('approved', 'applied'));
			$this->db->order_by('cbk.add_datetime', 'DESC');

		}else if($params == 'registration'){

			$this->db->select('cbk.id as cbk_id, cbk.partnership_id, cbk.name, CONCAT(pt.first_name, " ", pt.last_name) as refer_name, cbk.enroll_no, cbk.discrict, cbk.teacher, cbk.status as cbk_status, cbk.mobile, cbk.phone, cbk.email, cbk.father, cbk.dob, cbk.gender, uad.status as uad_status, uad.*, upl.id as upl_id, upl.fees, upl.payment_status, upl.payment_type')->from('candidates_wb cbk');
			$this->db->join('user_registration_dtls uad', 'uad.user_id = cbk.id', 'inner');
			$this->db->join('user_payment_log upl', 'upl.userid = cbk.id', 'left');
			$this->db->join('partnership pt', 'pt.upid = cbk.partnership_id', 'left');
			$this->db->where(array('cbk.teacher !='=>'','cbk.status'=>'qualified', 'upl.payment_type'=>'registration_fees'));
			$this->db->order_by('cbk.add_datetime', 'DESC');

		}else if($params == 'coordinator'){

			$this->db->select('*')->from('candidates_wb cbk');
			$this->db->where('cbk.teacher','');
			$this->db->where_in('cbk.status', array('applied', 'approved'));
			$this->db->order_by('add_datetime', 'DESC');

		}else if($params == 'rejected'){

			$this->db->select('cbk.*, CONCAT(pt.first_name, " ", pt.last_name) as refer_name')->from('candidates_wb cbk');
			$this->db->join('partnership pt', 'pt.upid = cbk.partnership_id', 'left');
			$this->db->where('cbk.status', 'rejected');
			$this->db->order_by('cbk.add_datetime', 'DESC');

		}
		return $this->db->get()->result();
	}

	public function get_applied_candidate_list_by_district($dist)
	{
		$this->db->select('cbk.id as cbk_id, cbk.*, CONCAT(pt.first_name, " ", pt.last_name) as refer_name, upl.id as upl_id, upl.fees, upl.payment_status, upl.payment_type')->from('candidates_wb cbk');
		$this->db->join('user_payment_log upl', 'upl.userid = cbk.id', 'left');
		$this->db->join('partnership pt', 'pt.upid = cbk.partnership_id', 'left');
		if($dist != "all"){
			$this->db->where('cbk.location_id', $dist);
		}
		$this->db->where('cbk.teacher<>','');
		$this->db->where('upl.payment_type','exam_fees');
		$this->db->where_in('cbk.status', array('applied', 'approved'));
		$this->db->order_by('cbk.add_datetime', 'DESC');
		return $this->db->get()->result();
	}

	public function get_districtID_subjectID($teacher, $discrict)
	{
		return $this->db->query("select (select id from district where name='".$discrict."') as dist_id, (select id from subject_teacher where sub_teacher='".$teacher."') as sub_id")->result();
	}
	/*==============================================================================*/

	public function get_applied_payments($type='')
	{
		// name, enrollment, father name, phone, district, block, pincode, payment status, payment date
		$this->db->select('CASE WHEN cbk.partnership_id = "" OR cbk.partnership_id IS NULL THEN "" ELSE CONCAT(pt.first_name, " ", pt.last_name," (", cbk.partnership_id, ")") END as refer_name, cbk.name, cbk.enroll_no, cbk.'.$type.' as position, cbk.father, DATE_FORMAT(cbk.dob, "%d %M %Y") as dob, cbk.gender, cbk.email, cbk.mobile, cbk.discrict, cbk.block, cbk.pin, upl.fees, IF(upl.payment_status, "Done","Incomplete") as payment_status, DATE_FORMAT(tl.add_datetime, "%D %b %Y %r") as payment_dt, tl.payment_id, upl.invoice_id, DATE_FORMAT(cbk.add_datetime, "%d %M %Y %h:%i%p")')->from('candidates_wb cbk');
		$this->db->join('user_payment_log upl', 'upl.userid = cbk.id', 'inner');
		$this->db->join('transaction_log tl', 'tl.pay_log_id = upl.id', 'left');
		$this->db->join('partnership pt', 'pt.upid = cbk.partnership_id', 'left');
		if($type=='teacher'){
			$this->db->where('cbk.teacher<>','');
		}else{
			$this->db->where('cbk.coordinator<>','');
		}
		$this->db->where(array('cbk.status'=>'applied', 'upl.payment_type'=>'exam_fees'));
		$this->db->or_where(array('cbk.status'=>'approved'));
		$this->db->order_by('cbk.add_datetime', 'DESC');
		return $this->db->get()->result();
	}

	public function get_qualified_payments()
	{
		// COALESCE(your_column, '')
		// CASE
		// 	WHEN cbk.partnership_id = '' OR cbk.partnership_id IS NULL THEN ""
		// 	ELSE CONCAT(pt.first_name, " ", pt.last_name," (", cbk.partnership_id, ")"), "")
		// END
		// name, enrollment, father name, phone, district, block, pincode, payment status, payment date
		$this->db->select('CASE WHEN cbk.partnership_id = "" OR cbk.partnership_id IS NULL THEN "" ELSE CONCAT(pt.first_name, " ", pt.last_name," (", cbk.partnership_id, ")") END as refer_name, cbk.name, cbk.enroll_no, cbk.father, DATE_FORMAT(cbk.dob, "%d %M %Y") as dob, cbk.gender, cbk.email, cbk.mobile, cbk.discrict, cbk.block, cbk.pin, upl.fees, IF(upl.payment_status, "Done","Incomplete") as payment_status, DATE_FORMAT(tl.add_datetime, "%D %b %Y %r") as payment_dt, tl.payment_id, upl.invoice_id, DATE_FORMAT(cbk.add_datetime, "%d %M %Y %h:%i%p")')->from('candidates_wb cbk');
		$this->db->join('user_payment_log upl', 'upl.userid = cbk.id', 'left');
		$this->db->join('transaction_log tl', 'tl.pay_log_id = upl.id', 'left');
		$this->db->join('partnership pt', 'pt.upid = cbk.partnership_id', 'left');
		$this->db->where(array('cbk.status'=>'qualified', 'upl.payment_type'=>'registration_fees'));
		$this->db->order_by('cbk.add_datetime', 'DESC');
		return $this->db->get()->result();
	}


	/*=========================================================================================================*/
	public function get_all_subjects_with_total_questionbanks()
	{
		$this->db->select('st.*, ( select count(id) from question_bank qb where qb.subject_id = st.id and is_delete=0 ) as qb_count');
		$this->db->order_by('st.add_datetime', 'DESC');
		return $this->db->get('subject_teacher st')->result();
	}
	public function get_question_banks_by_sub_id($value)
	{
		$this->db->select('qb.*, ( select count(id) from questions ques where ques.qb_id = qb.id and is_delete = 0 ) as ques_count');
		$this->db->order_by('qb.add_datetime', 'DESC');
		$this->db->where(array('is_delete'=>false, 'subject_id'=>$value));
		return $this->db->get('question_bank qb')->result();
	}
	public function get_question_bank_by_id($value)
	{
		$this->db->where(array('is_delete'=>false, 'id'=>$value));
		return $this->db->get('question_bank qb')->result();
	}
	/*--------------------------------------------------------------------------------------------*/
	public function get_total_question_of_questionbank($sub_id)
	{
		$this->db->where(array('is_delete'=>false,'qb_id'=>$sub_id));
		return $this->db->get('questions')->num_rows();
	}
	public function get_all_questions_by_questionbank($qb_id)
	{
		$this->db->where(array('is_delete'=>false,'subject_id'=>$sub_id));
		$this->db->order_by('add_datetime', 'DESC');
		return $this->db->query($query)->result();
	}
	public function insertQuestionData($ques_query, $op_query)
	{
		$this->db->trans_begin();

		$this->db->query("INSERT INTO questions (qb_id, ques_type, question, answer, marks, is_active, is_delete, add_datetime) VALUES (".$ques_query.")");
		$qb_id = $this->db->insert_id();
		if($op_query !== ""){
			$this->db->query("INSERT INTO options (question_id, option_sets, add_datetime) VALUES (".$qb_id.", ".$op_query.")");
		}

		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return 0;
		}
		else
		{
		        $this->db->trans_commit();
		        return 1;
		}
	}
	// public function get_question_by_id($value)
	// {
	// 	$this->db->where(array('is_delete'=>false,'id'=>$value));
	// 	return $this->db->get('questions')->result_array();
	// }
	/*----------------------------------------------------------------------------------------------------------*/
	public function get_exam_list_by_status($params)
	{
		$this->db->select('ex.*, dist.name as district_name, sub.subject_title')->from('exam ex');
		$this->db->join('district dist', 'dist.id=ex.district_id', 'inner');
		$this->db->join('subject_teacher sub', 'sub.id=ex.subject_id', 'inner');
		$this->db->where('ex.status', $params);
		$this->db->order_by('ex.add_datetime', 'DESC');
		return $this->db->get()->result();
	}
	public function get_total_exam_by_status($status)
	{
		$this->db->where('ex.status', $status);
		return $this->db->get('exam ex')->num_rows();
	}
	public function get_exam_by_id($value)
	{
		$this->db->where('id', $value);
		return $this->db->get('exam')->result_array();
	}
	public function get_exam_short_dtls_by_id($id)
	{
		$this->db->select('id, etitle, full_marks');
		$this->db->where('id', $id);
		return $this->db->get('exam')->result();
	}

	public function get_total_linked_candidates_by_exam_id($exam_id)
	{
		$this->db->select('cand_id');
		$this->db->where('exam_id', $exam_id);
		return $this->db->get('exam_map_candidates')->num_rows();
	}

	/*--------------------------------------------------------------------------------------------------------*/
	public function get_section_total_marks_by_exam_id($exam_id)
	{
		$sec_marks = 0;
		$ques_array = array();
		$result = $this->db->query('SELECT ques_ids FROM section_map_question smq left join sections sec ON sec.id=smq.sec_id WHERE sec.exam_id='.$exam_id)->result();
		foreach($result as $row){
			$ques_ids = json_decode($row->ques_ids);
			if(!empty($ques_ids)){
				$ques_array = array_merge($ques_array, $ques_ids);
			}
		}
		if(!empty($ques_array)){
			$sec_marks = $this->db->query('SELECT SUM(marks) as sec_marks FROM questions WHERE id IN ('.implode(', ', $ques_array).')')->result();
		}
		return $sec_marks;
	}
	public function get_total_marks_for_section_by_ques_ids($ques_ids)
	{
		$sec_marks = 0;
		if(!empty($ques_ids)){
			$sec_marks = $this->db->query('SELECT SUM(marks) as sec_marks FROM questions WHERE id IN ('.implode(', ', $ques_ids).')')->result();
		}
		return $sec_marks;
	}
	public function get_all_sections_under_exam($value)
	{
		$this->db->select('sec.*, JSON_LENGTH(smq.ques_ids) as ques_count')->from('sections sec');
		$this->db->join('section_map_question smq', 'smq.sec_id=sec.id', 'left');
		$this->db->where('sec.exam_id', $value);
		$this->db->order_by('sec.add_datetime', 'ASC');
		return $this->db->get()->result();
	}
	public function get_section_by_id($value)
	{
		$this->db->where('id', $value);
		return $this->db->get('sections')->result();
	}

	/*--------------------------------------------------------------------------------------------------------*/
	public function get_list_questions_by_section($sec_id, $exam_id)
	{
		$ques_array = array();
		$this->db->select('ques_ids');
		$this->db->where(array('sec_id'=>$sec_id, 'exam_id'=>$exam_id));
		$result = $this->db->get('section_map_question')->result();

		foreach($result as $row){
			$ques_ids = json_decode($row->ques_ids);
			if(!empty($ques_ids)){
				$ques_array = array_merge($ques_array, $ques_ids);
			}
		}

		return $ques_array;
	}
	public function get_list_questions_used_by_other_sections($sec_id, $exam_id)
	{
		$ques_array = array();
		$this->db->select('ques_ids');
		$this->db->where(array('sec_id <>'=>$sec_id, 'exam_id'=>$exam_id));
		$result = $this->db->get('section_map_question')->result();

		foreach($result as $row){
			$ques_ids = json_decode($row->ques_ids);
			if(!empty($ques_ids)){
				$ques_array = array_merge($ques_array, $ques_ids);
			}
		}

		return $ques_array;
	}
	public function get_all_active_question_bank_under_examId($exam_id)
	{
		$this->db->select('qb.id, qb.title')->from('question_bank qb');
		$this->db->join('exam ex', 'ex.subject_id = qb.subject_id', 'left');
		$this->db->where(array('qb.is_active'=>true, 'qb.is_delete'=>false, 'ex.id'=>$exam_id));
		return $this->db->get()->result();
	}
	public function get_all_active_questions_under_qbId($qb_id, $sec_ques_array, $other_sec_ques_array)
	{
		if(empty($sec_ques_array)){
			$this->db->select('*, 0 as has_smq')->from('questions');
		}else{
			$this->db->select("*, IF(LOCATE(id, '".implode(', ', $sec_ques_array)."'), 1, 0) as has_smq")->from('questions');
		}
		if(!empty($other_sec_ques_array)){
			$this->db->where_not_in('id', $other_sec_ques_array);
		}
		$this->db->where(array('is_active'=>true, 'is_delete'=>false, 'qb_id'=>$qb_id));
		return $this->db->get()->result();
	}
	public function check_already_present_sqm($sec_id, $exam_id)
	{
		$this->db->where(array('sec_id'=>$sec_id, 'exam_id'=>$exam_id));
		return $this->db->get('section_map_question')->num_rows();
	}


	public function get_selected_exam_datas($exam_id)
	{
		$this->db->select('ex.id, ex.etitle, ex.district_id, dist.name as district_name, ex.subject_id, st.subject_title')->from('exam ex');
		$this->db->join('district dist', 'dist.id=ex.district_id', 'inner');
		$this->db->join('subject_teacher st', 'st.id=ex.subject_id', 'inner');
		$this->db->where('ex.id', $exam_id);
		return $this->db->get()->result();
	}
	public function get_invited_candidate_list_by_district($dist, $exam_id, $subject_id)
	{
		$this->db->select("cbk.id as cbk_id, cbk.*, upl.id as upl_id, upl.fees, upl.payment_status, upl.payment_type, IF((select count(cand_id) from exam_map_candidates where exam_id=".$exam_id." and cand_id=cbk.id) > 0, 'Linked', 'Not Linked') as invite_stat")->from('candidates_wb cbk');
		$this->db->join('user_payment_log upl', 'upl.userid = cbk.id', 'left');
		$this->db->where('cbk.location_id', $dist);
		$this->db->where('cbk.subject_id', $subject_id);
		$this->db->where('cbk.teacher<>','');
		$this->db->where('upl.payment_type','exam_fees');
		$this->db->where_in('cbk.status', array('applied', 'approved'));
		$this->db->order_by('cbk.add_datetime', 'DESC');
		return $this->db->get()->result();
	}

	public function get_exam_candidate_result($exam_id)
	{
		$this->db->select('emc.id as emc_id, emc.status as attend_status, emc.estart_datetime, emc.eend_datetime, emc.marks as cand_marks, emc.result, emc.giving_status, cbk.id as cbk_id, cbk.name, cbk.discrict, cbk.teacher, cbk.enroll_no, cbk.father, cbk.mobile, cbk.email, cbk.status as cbk_status, ex.etitle, ex.full_marks, ex.pass_mark')->from('exam_map_candidates emc');
		$this->db->join('candidates_wb cbk', 'cbk.id = emc.cand_id', 'inner');
		$this->db->join('exam ex', 'ex.id = emc.exam_id', 'left');
		$this->db->where('emc.exam_id', $exam_id);
		return $this->db->get()->result();
	}
	public function export_exam_candidate_result($exam_id)
	{
		/*
		$this->db->select('cbk.name, cbk.enroll_no, cbk.father, cbk.mobile, cbk.discrict, cbk.block, cbk.pin, upl.fees, IF(upl.payment_status, "Done","Incomplete") as payment_status, DATE_FORMAT(tl.add_datetime, "%D %b %Y %r") as payment_dt, tl.payment_id, upl.invoice_id')->from('candidates_wb cbk');
		*/
		$this->db->select("cbk.name, cbk.enroll_no, cbk.father, DATE_FORMAT(cbk.dob, '%d %M %Y') as dob, cbk.gender, cbk.email, cbk.mobile, cbk.discrict, cbk.block, cbk.pin, UPPER(emc.giving_status) AS giving_status, IF(emc.giving_status='done', CONCAT(DATE_FORMAT('Started @  ', emc.estart_datetime, '%D %b %Y %r'),'; ', 'Ended @  ', DATE_FORMAT(emc.eend_datetime, '%D %b %Y %r')), '') as given_datetime, CONCAT('Full Marks: ', ex.full_marks,'; ','Pass Marks: ', ex.pass_mark) as exam_marks, emc.marks as cand_marks, UPPER(emc.result) as result")->from('exam_map_candidates emc');
		$this->db->join('candidates_wb cbk', 'cbk.id = emc.cand_id', 'inner');
		$this->db->join('exam ex', 'ex.id = emc.exam_id', 'left');
		$this->db->where('emc.exam_id', $exam_id);
		return $this->db->get()->result();

		/*$this->db->select('emc.id as emc_id, emc.status as attend_status, emc.estart_datetime, emc.eend_datetime, emc.marks as cand_marks, emc.result, emc.giving_status, cbk.id as cbk_id, cbk.name, cbk.discrict, cbk.teacher, cbk.enroll_no, cbk.father, cbk.mobile, cbk.email, ex.etitle, ex.full_marks, ex.pass_mark')*/
	}
	/*--------------------------------------------------------------------------------------------------------*/
	public function get_all_fees_structure() {
		return $this->db->where('id', 1)->get('fees_setting')->result();
	}

	public function get_all_web_setting() {
		return $this->db->where('id', 1)->get('website_settings')->result();
	}
/*--------------------------------------------------------------------------------------------------------*/
	public function check_valid_partnership($email)
	{
		$this->db->where('contact', $email);
		return $this->db->get('partnership')->num_rows();
	}

	public function get_partnership_details($id) 
	{
		$this->db->where('id', $id);
		return $this->db->get('partnership')->result();
	}
	public function get_last_partnership_uuid()
	{
		$this->db->select_max('upid');
		$result = $this->db->get('partnership')->result();

		if(!empty($result)){
			$enrollment = trim($result[0]->upid);
			$slahposi = strripos($enrollment,"/");
			$enNum = (int)substr($enrollment, $slahposi+1);
			return $enNum+1; //intval(str_replace('0', '', $enNum)) + 1;
			//return $result[0]->id + 1;
		}else{
			return 1;
		}
	}
	public function get_total_partnership()
	{
		return $this->db->get('partnership')->num_rows();
	}
}

?>