<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudyTopiclist extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}

	public function index(){
		$class_code = $this->session->userdata('class_code');
		$sec_code   = $this->session->userdata('sec_code');
		$data['admno']  = $this->session->userdata('adm');
		$data['elearningData'] = $this->alam->selectA('e_learning','*,(select SubName from subjects where SubCode=e_learning.subject)subjnm,(SELECT chapter FROM chaptertopicmaster WHERE id=e_learning.chapter)chapternm',"class='$class_code' AND sec='$sec_code' order by id desc");
		$this->Parent_templete('parents_dashboard/studyTopiclist',$data);
	}
	
	public function studentQuery($id,$subject,$class,$sec){
		$data['admno'] = $this->session->userdata('adm');
		$admno = $data['admno'];
		
		$nameData = $this->alam->selectA('e_learning_conversation_stu','user_name',"user_id='$admno'");
		$data['name'] = (!empty($nameData[0]['user_name']))?$nameData[0]['user_name']:'';
		
		$data['elearningData'] = $this->alam->selectA('e_learning','*,(select SubName from subjects where SubCode=e_learning.subject)subjnm,(select chapter from chaptertopicmaster where id=e_learning.chapter)chapternm',"id='$id'");
		
		$data['conversation_stu'] = $this->alam->selectA('e_learning_conversation_stu','*,(select SubName from subjects where SubCode=e_learning_conversation_stu.subject)subjnm,(select remarks from e_learning where id=e_learning_conversation_stu.topic_id)topicnm',"subject='$subject' AND topic_id='$id' AND classes='$class' AND sec='$sec' order by id desc");
		
		$this->Parent_templete('parents_dashboard/studentQuery',$data);
	}
	
	public function studentQuertySave(){
		$query = $this->input->post('query');
		$classes   = $this->input->post('classes');
		$sec   = $this->input->post('sec');
		$admno   = $this->input->post('admno');
		$stuNmData = $this->alam->selectA('student','FIRST_NM',"ADM_NO='$admno'");
		$firstnm = $stuNmData[0]['FIRST_NM'];
		$img   = $this->input->post('img');
		$subject   = $this->input->post('subject');
		$topic_id   = $this->input->post('topic_id');
		
		$nameData = $this->alam->selectA('e_learning_conversation_stu','user_name',"user_id='$admno'");
		$name = (!empty($nameData[0]['user_name']))?$nameData[0]['user_name']:'';
		
		$imgList = array();
		for($i=0; $i<count($_FILES['img']['name']); $i++){
			if(!empty($_FILES['img']['name'][$i])){
			$image              = $_FILES['img']['name'][$i]; 
			$expimage           = explode('.',$image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count-1];
			$image_name         = strtotime('now'). rand() .'.'.$image_ext;
			$imagepath          = "uploads/e_learning_files/".$image_name;
			
			move_uploaded_file($_FILES["img"]["tmp_name"][$i],$imagepath);
			$imgList[] = $imagepath;
			}else{
				$imagepath  = '';
			}
		}
		
		$studentQuerySave = array(
			'user_id'		  => $admno,
			'user_type'		  => 'S',
			'user_name'		  => $firstnm,
			'subject'         => $subject,
			'topic_id'        => $topic_id,
			'classes'         => $classes,
			'sec'             => $sec,
			'query'           => $query,
			'img'             => serialize($imgList)
		);
		$blockData = $this->alam->selectA('e_learning','id,lock_topic',"id='$topic_id'");
		if($blockData[0]['lock_topic'] == 1){
			$this->alam->insert('e_learning_conversation_stu',$studentQuerySave);
		}else{
			echo "query_blocked";
			die;
		}
		
		$conversation_stu = $this->alam->selectA('e_learning_conversation_stu','*,(select SubName from subjects where SubCode=e_learning_conversation_stu.subject)subjnm,(select remarks from e_learning where id=e_learning_conversation_stu.topic_id)topicnm',"subject='$subject' AND topic_id='$topic_id' AND classes='$classes' AND sec='$sec' order by id desc");
		if(!empty($conversation_stu)){
			foreach($conversation_stu as $key => $val){
				if($name == $val['user_name']){
					$userIconColor = 'green';
				}else{
					$userIconColor = 'red';
				}
				?>
				 <b><i class="fa fa-user-circle" style='color:<?php echo $userIconColor; ?>'></i> <?php echo $val['user_name']; ?></b>
				 <p style='font-size:12px;'>
					<?php echo $val['query']; ?>
					<?php
						if($val['img'] != 'a:0:{}'){
							?>
								<a href='<?php echo base_url(unserialize($val['img'])); ?>' download> &nbsp;<i class="fa fa-download" style='color:red'></i></a>
							<?php
						}
					?>
					<br />
					<span style='text-align:right'><?php echo date('d-M H:i a',strtotime($val['created_at'])); ?></span>
				 </p>
				<?php
			}
		}
	}
	
	public function autoRefresh($subject,$topic_id,$classes,$sec){
		$conversation_stu = $this->alam->selectA('e_learning_conversation_stu','*,(select SubName from subjects where SubCode=e_learning_conversation_stu.subject)subjnm,(select remarks from e_learning where id=e_learning_conversation_stu.topic_id)topicnm',"subject='$subject' AND topic_id='$topic_id' AND classes='$classes' AND sec='$sec' order by id desc");
		
		$admno = $this->session->userdata('adm');
		
		$nameData = $this->alam->selectA('e_learning_conversation_stu','user_name',"user_id='$admno'");
		$name = (!empty($nameData[0]['user_name']))?$nameData[0]['user_name']:'';
		
		if(!empty($conversation_stu)){
			foreach($conversation_stu as $key => $val){
				if($name == $val['user_name']){
					$userIconColor = 'green';
				}else{
					$userIconColor = 'red';
				}
				?>
				 <b><i class="fa fa-user-circle" style='color:<?php echo $userIconColor; ?>'></i> <?php echo $val['user_name']; ?></b>
				 <p style='font-size:12px;'>
					<?php echo $val['query']; ?>
					<?php
						if($val['img'] != 'a:0:{}'){
							?>
								<a href='<?php echo base_url(unserialize($val['img'])); ?>' download> &nbsp;<i class="fa fa-download" style='color:red'></i></a>
							<?php
						}
					?>
					<br />
					<span style='text-align:right'><?php echo date('d-M H:i a',strtotime($val['created_at'])); ?></span>
				 </p>
				<?php
			}
		}
	}
	
	public function statusSave(){
		$elearning_tbl_id = $this->input->post('elearning_tbl_id');
		$admno            = $this->input->post('admno');
		$save = array(
			'downloadStatus' => 1
		);
		
		$this->alam->update('e_learning_adm_wise',$save,"elearning_tbl_id='$elearning_tbl_id' AND admno='$admno'");
	}
}