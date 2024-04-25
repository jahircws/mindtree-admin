<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {

	public function __construct()
	{

	}
	public function get_total_candidates()
	{
		return $this->db->get('students')->num_rows();
	}
	public function get_candidate_for_preview($id)
	{
		$this->db->select('cand.*, pres.state_title as pre_state_title, pred.district_title as pre_district_title, tl.amount, tl.add_datetime as payment_dt, tl.payment_id, tl.order_id')->from('students cand');
		$this->db->join('state as pres', 'pres.state_id = cand.pre_state', 'left');
		$this->db->join('district as pred', 'pred.districtid = cand.pre_district', 'left');
		$this->db->join('transaction_log tl', 'tl.pay_log_id = cand.id', 'left');
		// $this->db->join('state as pers', 'pers.state_id = cand.per_state', 'left');
		// $this->db->join('district as perd', 'perd.districtid = cand.per_district', 'left');
		// , pers.state_title as per_state_title, perd.district_title as per_district_title
		$this->db->where('cand.id', $id);
		return $this->db->get()->result();
	}
	public function get_last_candidate_uuid()
	{
		$this->db->select_max('uid');
		$result = $this->db->get('students')->result();

		if(!empty($result)){
			$enrollment = trim($result[0]->uid);
			$slahposi = strripos($enrollment,"/");
			$enNum = (int)substr($enrollment, $slahposi+1);
			return $enNum+1; //intval(str_replace('0', '', $enNum)) + 1;
			//return $result[0]->id + 1;
		}else{
			return 1;
		}
	}
	public function get_user_payment_log($where)
	{
		$this->db->select('cand.course_name, cand.session, cand.candidate_name as name,cand.uid as enroll_no,cand.email,cand.mobile,cand.present_address as address,cand.pre_pin_code as pin,state.state_title, district.district_title as discrict, tl.amount, tl.add_datetime as payment_dt, tl.payment_id, tl.order_id')->from('students cand');
		$this->db->join('state', 'state.state_id = cand.pre_state', 'left');
		$this->db->join('district', 'district.districtid = cand.pre_district', 'left');
		$this->db->join('transaction_log tl', 'tl.pay_log_id = cand.id', 'left');
		$this->db->where($where);
		return $this->db->get()->result();
	}

	public function get_active_states()
	{
		$this->db->where('status', 'Active');
		$this->db->order_by('state_title', 'ASC');
		return $this->db->get('state')->result();
	}

	public function get_active_districts_by_stateid($stateid)
	{
		$this->db->where(['state_id'=>$stateid,'district_status'=>'Active']);
		$this->db->order_by('district_title', 'ASC');
		return $this->db->get('district')->result();
	}

	public function get_coupon_by_code($ccode)
	{
		$this->db->where(['code' => $ccode, 'status' => 1, 'expiration_date >=' => date('Y-m-d')]);
		return $this->db->get('coupon_codes')->result();
	}
	public function get_all_coupons($id = 0)
	{
		if($id != 0){
			$this->db->where('id', $id);
		}
		$this->db->order_by('created_at', 'ASC');
		return $this->db->get('coupon_codes')->result();
	}
	public function get_coupon_codes_count()
	{
		return $this->db->get('coupon_codes')->num_rows();
	}

    public function get_all_course_category($id = 0)
	{
		if($id != 0){
			$this->db->where('id', $id);
		}
		$this->db->order_by('title', 'ASC');
		return $this->db->get('course_category')->result();
	}
    public function get_course_category_count()
	{
		return $this->db->get('course_category')->num_rows();
	}
    public function get_active_course_category()
    {
        $this->db->where('status', 1);
        $this->db->order_by('title', 'ASC');
		return $this->db->get('course_category')->result();
    }


    public function get_short_course_details($upid)
    {
        if($upid != 0){
			$this->db->where('id', $upid);
		}
		$this->db->order_by('title', 'ASC');
		return $this->db->get('short_courses')->result();
    }
    public function  get_short_course_count() {
        return $this->db->get('short_courses')->num_rows();
    }

    public function get_main_course_details($upid)
    {
        if($upid != 0){
			$this->db->where('id', $upid);
		}
		$this->db->order_by('title', 'ASC');
		return $this->db->get('courses')->result();
    }
    public function  get_main_course_count() {
        return $this->db->get('courses')->num_rows();
    }

	public function get_main_course_details_by_slug($slug)
    {
        $this->db->where('slug', $slug);
		$this->db->where('status', 1);
		return $this->db->get('courses')->result();
    }
}
?>