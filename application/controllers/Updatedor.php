<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Updatedor extends MY_Controller {
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
	}

	public function updateDateofRetirement()
	{
		$employeeDetails = $this->sumit->fetchAllData('*','employee',array());
		foreach ($employeeDetails as $key => $value) {
			
			$dob_month = date('m',strtotime($value['D_O_B']));
			$dob_date = date('d',strtotime($value['D_O_B']));
			$date_of_retirement_year = date('Y',strtotime($value['D_O_B']))+60;
			$date_of_retirement = $date_of_retirement_year.'-'.$dob_month.'-'.$dob_date;

			$this->sumit->update('employee',array('D_O_RETIER'=>$date_of_retirement),array('id'=>$value['id']));
		}
	}
}