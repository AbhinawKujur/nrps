<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verified_list extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
		$this->load->library('Alam_custom','alam_custom');
		$this->loggedOutThreeAdmForm();
	}
	
	public function index(){
		$data['religion'] = $this->alam->selectA('religion','*',"status='Y' order by sorting_no");
		$data['category'] = $this->alam->selectA('category','*');
		$data['motherTounge'] = $this->alam_custom->motherTounge();
		$data['bloodGroup'] = $this->alam_custom->bloodGroup();
		$data['parent_qualification'] = $this->alam_custom->parent_qualification();
		$data['parent_accupation'] = $this->alam_custom->parent_accupation();
		$data['grand_parent'] = $this->alam_custom->grand_parent();
		$data['verifiedData'] = $this->alam->selectA('three_adm_data','*,(select CLASS_NM from classes where Class_No=three_adm_data.class_0)classnm_0,(select SECTION_NAME from sections where section_no=three_adm_data.sec_0)secnm_0,(select CAT_DESC from category where CAT_CODE=three_adm_data.category)catnm,(select Rname from religion where RNo=three_adm_data.religion)religionnm',"f_code='Ok' AND verified_status='1'");
		$this->threeAdmissionAdminTemplate('adm_three/admin/verifiedList',$data);
	}
}
