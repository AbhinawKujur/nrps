<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_card_temp_save extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Alam','alam');
		error_reporting(0);
	}
	
	public function save_temp_tbl(){
		$all_data = $this->session->userdata('array_session');
		define("fill_data", $all_data);
		error_reporting(0);
	    $this->alam->delete('temp_report_card');
		
		$data['class_id'] = $this->input->post('class_id');
		$data['sec_id']   = $this->input->post('sec_id');
		
		$this->alam->del('topper_rank',"class_id='".$data['class_id']."' AND sec_id='".$data['sec_id']."'");
		for($i=0; $i<count(fill_data['adm_arr']); $i++){
			$adm_no = fill_data['adm_arr'][$i];
			$svData = array(
		      'adm_no'       => fill_data['adm_arr'][$i],
		      'classes'      => fill_data['class_arr'][$i],
		      'sec'          => fill_data['sec_arr'][$i],
		      'term'         => 'ANNUAL',
		      'first_nm'     => fill_data['first_nm_arr'][$i],
		      'roll_no'      => fill_data['roll_no_arr'][$i],
		      'tot_wet_mrk'  => fill_data['tot_wet_mrk_arr'][$i],
		      'tot_per'      => fill_data['tot_per_arr'][$i],
		      'tot_grd'      => fill_data['tot_grd_arr'][$i],
		      'attendance'   => fill_data['attendance_arr'][$i],
		    );
	
			for($j=0; $j<count(fill_data['subj_nm_arr']); $j++){
				$data1['subj'.($j + 1).'_nm']  = fill_data['subj_nm_arr'][$j];
				$data1['subj'.($j + 1).'_mo']  = fill_data['tot_mo_arr'][$adm_no][$j];
				$data1['subj'.($j + 1).'_per'] = fill_data['tot_mo_arr'][$adm_no][$j];
				$data1['subj'.($j + 1).'_grd'] = fill_data['grd_arr'][$adm_no][$j];
			}
			
			$finData = array_merge($svData,$data1);
            $this->alam->insert('temp_report_card',$finData);
			
			$topperRank = array(
				'admno'      => fill_data['adm_arr'][$i],
				'first_nm'   => fill_data['first_nm_arr'][$i],
				'class_id'   => fill_data['class_arr'][$i],
				'sec_id'     => fill_data['sec_arr'][$i],
				'percent'    => fill_data['tot_per_arr'][$i],
				'created_by' => login_details['user_id']
			);
			$this->alam->insert('topper_rank',$topperRank);
		}
		$this->render_template('report_card/view_all_reports',$data);
	}
	
	public function topper_list(){
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		$data['topper_list'] = $this->alam->topper_list();
		$this->load->view('report_card/topper_list_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Topper_List.pdf", array("Attachment"=>0));
	}
	
	public function topper_rank_class_wise($class_id){
		$data['school_photo'] = $this->alam->selectA('school_photo','*');
		$data['school_setting'] = $this->alam->selectA('school_setting','*');
		$classes = $this->alam->selectA('classes','CLASS_NM',"Class_No='$class_id'");
		$data['class_nm'] = $classes[0]['CLASS_NM'];
		$data['class_id'] = $class_id;
		$distUpd = $this->alam->selectA('topper_rank','distinct(percent)',"class_id='".$data['class_id']."' order by percent desc");
		foreach($distUpd as $key => $val){
			$upd = array(
				'rank' => $key + 1
			);
			$this->alam->update('topper_rank',$upd,"percent='".$val['percent']."'");
		}
		
		$data['topper_rank'] = $this->alam->selectA('topper_rank','*,(select CLASS_NM from classes where Class_No=topper_rank.class_id)classes,(select SECTION_NAME from sections where section_no=topper_rank.sec_id)sec',"class_id='$class_id' order by percent DESC");
		$this->load->view('report_card/topper_rank_class_wise_pdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("Topper_List.pdf", array("Attachment"=>0));
	}
}