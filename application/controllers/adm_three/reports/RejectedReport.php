<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RejectedReport extends MY_Controller {
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
		$data['verifiedData'] = $this->alam->selectA('three_adm_data','*,(select CAT_DESC from category where CAT_CODE=three_adm_data.category)catnm,(select Rname from religion where RNo=three_adm_data.religion)religionnm',"f_code='Ok' AND verified_status='2'");
		$this->threeAdmissionAdminTemplate('adm_three/admin/rejectedList',$data);
	}
}
