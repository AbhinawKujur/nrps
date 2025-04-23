<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homeworklist extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}

	public function index()
	{
		$adm_no = $this->session->userdata('adm');
		$data['categoryList'] = $this->sumit->fetchAllData('*','homework_cat_master',array());
		$data['subjectList'] = $this->notice_model->getHomeworkSubjectinParent($adm_no);

		$where = "haw.admno='$adm_no'";
		if(isset($_POST['search']))
		{
			$category = $this->input->post('category');
			$subject = $this->input->post('subject');
			$status = $this->input->post('status');

			if($category != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category'";
			}

			if($subject != '')
			{
				$where = "haw.admno='$adm_no' AND h.subject='$subject'";
			}

			if($status != '')
			{
				$where = "haw.admno='$adm_no' AND haw.homework_status='$status'";
			}

			if($category != '' && $status != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category' AND haw.homework_status='$status'";
			}

			if($subject != '' && $status != '')
			{
				$where = "haw.admno='$adm_no' AND h.subject='$subject' AND haw.homework_status='$status'";
			}

			if($category != '' && $subject != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category' AND h.subject='$subject'";
			}

			if($category != '' && $subject != '' && $status != '')
			{
				$where = "haw.admno='$adm_no' AND h.homework_category='$category' AND h.subject='$subject' AND haw.homework_status='$status'";
			}

		}
		$data['homeworkList'] = $this->notice_model->getHomeworkList($where);
		$this->Parent_templete('parents_dashboard/homeworkList',$data);
	}
	
	public function uploadHwById(){
		$hw_id = $this->input->post('hw_id');
		$hwData = $this->alam->selectA('homework','*,(select SubName from subjects where SubCode=homework.subject)subjnm,(select category from homework_cat_master where id=homework.homework_category)catnm,',"id='$hw_id'");
		$modalHead = $hwData[0]['subjnm']." (<i>".$hwData[0]['catnm']."</i>)"; 
		$remarks  = $hwData[0]['remarks']; 
		$hwId     = $hwData[0]['id']; 
		$array = array($modalHead,$remarks,$hwId);
		echo json_encode($array);
	}
	
	public function uploadHwSave(){
		$adm_no = $this->session->userdata('adm');
		$imgList = array();
		for($i=0; $i<count($_FILES['img']['name']); $i++){
			if(!empty($_FILES['img']['name'][$i])){
			$image              = $_FILES['img']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = strtotime('now'). rand() .'.'.$image_ext;
			$imagepath          = "uploads/homework_img/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"][$i],$imagepath);
			$imgList[] = $imagepath;
			}else{
				$imagepath  = '';
			}
			$save = array(
				'stuUploadedimg' => serialize($imgList),
				'stuByRemarks'   => $this->input->post('remarks'),
				'stu_status'     => 'Y',
			);
			//echo "<pre>";
			//print_r($save);
			$hwId = $this->input->post('hwId');
			$this->alam->update('homework_adm_wise',$save,"admno='$adm_no' AND homework_tbl_id='$hwId'");
		}
	}
}