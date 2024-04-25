<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function getMainTitle()
{
	return 'MINDTREEINC';
}
function insertData($tableName, $data){
	$ci = & get_instance();
	$ci->load->database();
	return $ci->db->insert($tableName, $data);
}
function insertBatchData($tableName, $data)
{
	$ci = & get_instance();
	$ci->load->database();
	return $ci->db->insert_batch($tableName, $data);
}
function insertDataRetId($tableName, $data){
	$ci = & get_instance();
	$ci->load->database();
	$ci->db->insert($tableName, $data);
	return $ci->db->insert_id();
}
function updateData($tableName, $data, $where){
	$ci = & get_instance();
	$ci->load->database();
	$ci->db->where($where);
	return $ci->db->update($tableName, $data);
}
function deleteData($tableName, $where){
	$ci = & get_instance();
	$ci->load->database();
	$ci->db->where($where);
	return $ci->db->delete($tableName);
}

function runQuery($query){
	$ci = & get_instance();
	$ci->load->database();
	return $ci->db->query($query)->result();
}

function getFeeTypevalue($type) {
	$ci = & get_instance();
	$ci->load->database();
	return $ci->db->select($type)->get('fees_setting')->result();
}

function getWebsiteSettingType($type) {
	$ci = & get_instance();
	$ci->load->database();
	return $ci->db->select($type)->get('website_settings')->result();
}
// // =============================================================================================
// function insertVideoData($tableName, $data){
// 	$ci = & get_instance();
// 	$videodb = $ci->load->database('videodb', TRUE);
// 	return $videodb->insert($tableName, $data);
// }
// function insertVideoBatchData($tableName, $data)
// {
// 	$ci = & get_instance();
// 	$videodb = $ci->load->database('videodb', TRUE);
// 	return $videodb->insert_batch($tableName, $data);
// }
// function updateVideoData($tableName, $data, $where){
// 	$ci = & get_instance();
// 	$videodb = $ci->load->database('videodb', TRUE);
// 	$videodb->where($where);
// 	return $videodb->update($tableName, $data);
// }
// function runVideoQuery($query){
// 	$ci = & get_instance();
// 	$videodb = $ci->load->database('videodb', TRUE);
// 	return $videodb->query($query)->result();
// }
// // =============================================================================================
// function insertCoordData($tableName, $data){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);
// 	return $coord->insert($tableName, $data);
// }
// function insertBatchCoordData($tableName, $data)
// {
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);
// 	return $coord->insert_batch($tableName, $data);
// }
// function insertCoordDataRetId($tableName, $data){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);
// 	$coord->insert($tableName, $data);
// 	return $coord->insert_id();
// }
// function updateCoordData($tableName, $data, $where){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);
// 	$coord->where($where);
// 	return $coord->update($tableName, $data);
// }
// function deleteCoordData($tableName, $where){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);
// 	$coord->where($where);
// 	return $coord->delete($tableName);
// }
// function runCoordQuery($query){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);
// 	return $coord->query($query)->result();
// }
// function getCoordSettingsByKey($obj_key){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('coord', TRUE);

// 	return $coord->where('obj_key', $obj_key)->get('coord_settings')->result();
// }
// // =============================================================================================
// function insertLmsData($tableName, $data){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('lms', TRUE);
// 	return $coord->insert($tableName, $data);
// }
// function insertBatchLmsData($tableName, $data)
// {
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('lms', TRUE);
// 	return $coord->insert_batch($tableName, $data);
// }
// function insertLmsDataRetId($tableName, $data){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('lms', TRUE);
// 	$coord->insert($tableName, $data);
// 	return $coord->insert_id();
// }
// function updateLmsData($tableName, $data, $where){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('lms', TRUE);
// 	$coord->where($where);
// 	return $coord->update($tableName, $data);
// }
// function deleteLmsData($tableName, $where){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('lms', TRUE);
// 	$coord->where($where);
// 	return $coord->delete($tableName);
// }
// function runLmsQuery($query){
// 	$ci = & get_instance();
// 	$coord = $ci->load->database('lms', TRUE);
// 	return $coord->query($query)->result();
// }