<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditExamQuestion extends MY_controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Alam','alam');
	}
	public function index(){
		$ROLE_ID = login_details['ROLE_ID'];
		$user_id = login_details['user_id'];
		
		if($ROLE_ID == 2){
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"Main_Teacher_Code='$user_id' order by Class_no");
		}else{
			$data['classData'] = $this->alam->selectA('class_section_wise_subject_allocation','distinct(Class_no),(select CLASS_NM from classes where Class_No=class_section_wise_subject_allocation.Class_No)classnm',"1='1' order by Class_no");
		}
		$data['examMaster'] = $this->alam->selectA('online_exam_master','*');
		
		$this->render_template('onlineexam/teacher/addquestion/addexamquestion',$data);
	}
	
	public function loadSec(){
		$class_id = $this->input->post('class_id');
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(section_no),(select SECTION_NAME from sections where section_no=class_section_wise_subject_allocation.section_no)secnm',"Class_No='$class_id'");
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['section_no']; ?>'><?php echo $val['secnm']; ?></option>
			<?php
		}
	}
	
	public function loadSubj(){
		$cls = $this->input->post('cls');
		$sec = $this->input->post('sec');
		
		$secData  = $this->alam->selectA('class_section_wise_subject_allocation','distinct(subject_code),(select SubName from subjects where SubCode=class_section_wise_subject_allocation.subject_code)subjnm',"Class_No = '$cls' AND section_no = '$sec'");
		
		?>
			<option value=''>Select</option>
		<?php
		foreach($secData as $key => $val){
			?>
				<option value='<?php echo $val['subject_code']; ?>'><?php echo $val['subjnm']; ?></option>
			<?php
		}
	}
	
	
	public function loateExamDate(){
		 $cls = $this->input->post('cls');
		 $sec = $this->input->post('sec');
		 $subj = $this->input->post('subj');
		$cdate=	date('Y-m-d');
		$examDate  = $this->alam->selectA('online_exam_schedule','distinct(exam_date)',"class_id = '$cls' AND sec_id = '$sec' and subject_id='$subj' and exam_date>='$cdate'");
		//echo $this->db->last_query();
		?>
			<option value=''>Select</option>
		<?php
		foreach($examDate as $key => $val){
			?>
				<option value='<?php echo $val['exam_date']; ?>'><?php echo $val['exam_date']; ?></option>
			<?php
		}
	}
	
	
	
	public function editquestion($id){
		
				
		$data['question_list']	=$this->alam->selectA('online_exam_question','*',"id='$id'");
		$schedule	=$data['question_list'][0]['schedule_id'];
		$allotedmark	=$this->alam->selectA('online_exam_question','sum(marks) as tot_marks',"schedule_id='$schedule'");
		$data['allot_marks']=(!empty($allotedmark[0]['tot_marks']))?$allotedmark[0]['tot_marks']:'0';
		$data['schedule']=$this->alam->selectA('online_exam_schedule','*',"id='$schedule'");
		$this->render_template('onlineexam/teacher/addquestion/editexamquestion',$data);	
	}
	
	public function examquestionUpdate(){
		$flag=0;
		$errors=array();

		$schedule	= $this->input->post('schedule_id'); 	   
		$user_id 	= login_details['user_id']; 
		$qus_id		= $this->input->post('qus_id'); 
		$qustion	= $this->input->post('qustion');
		$marks		= $this->input->post('marks');
		$alotmarks	= $this->input->post('alotmarks');
		$maxmark	= $this->input->post('maxmark');
		$exam_pt	= $this->input->post('exam_pt');
		if(empty($qustion)){
		$errors[]="Question Is Mandatory"; 
		}
		if(empty($marks)){
		$errors[]="Marks Is Mandatory"; 
		}
		if(empty($exam_pt)){
		$errors[]="Exam Pattern is Mandatory"; 
		}
		$totmark=$marks+$alotmarks;

		
		if($exam_pt==1){
		$savequs	=array(
			'exam_ptern_id'	=> $exam_pt,
			'question'		=> $qustion,
			'marks'			=> $marks,
			'created_by'	=> $user_id,
			'created_on'	=> date('Y-m-d H:i:s'),
		);
		
		}elseif($exam_pt==2){		
		$no_option	= $this->input->post('no_option');
		$opt1		= $this->input->post('opt1');
		$opt2		= $this->input->post('opt2');
		$opt3		= $this->input->post('opt3');
		$opt4		= $this->input->post('opt4');
		$opt5		= $this->input->post('opt5');
		$ans_key	= $this->input->post('ans_key');
		if($no_option==2){
		if(empty($opt1)){
		$errors[]="Option-A Should Not Be Blank"; 
		}
		if(empty($opt2)){
		$errors[]=" Option-B Should Not Be Blank"; 
		}
		}elseif($no_option==4){
		if(empty($opt1)){
		$errors[]="Option-A Should Not Be Blank"; 
		}
		if(empty($opt2)){
		$errors[]="Option-B Should Not Be Blank"; 
		}
		if(empty($opt3)){
		$errors[]="Option-C Should Not Be Blank"; 
		}
		if(empty($opt4)){
		$errors[]="Option-D Should Not Be Blank"; 
		}		
		}elseif($no_option==5){
		if(empty($opt1)){
		$errors[]="Option-A Should Not Be Blank"; 
		}
		if(empty($opt2)){
		$errors[]="Option-B Should Not Be Blank"; 
		}
		if(empty($opt3)){
		$errors[]="Option-C Should Not Be Blank"; 
		}
		if(empty($opt4)){
		$errors[]="Option-D Should Not Be Blank"; 
		}
		if(empty($opt5)){
		$errors[]="Option-E Should Not Be Blank"; 
		}
		}else{
		$errors[]=" Please Select No Of Option ."; 
		}	
		if(empty($ans_key)){
		$errors[]="Answer Is Mandatory"; 
		}
		
			$savequs	=array(
				
				'exam_ptern_id'	=> $exam_pt,				
				'question'		=> $qustion,
				'marks'			=> $marks,
				'obj_no_option'	=> $no_option,
				'option_1'		=> $opt1,
				'option_2'		=> $opt2,
				'option_3'		=> $opt3,
				'option_4'		=> $opt4,
				'option_5'		=> $opt5,
				'ans_key'		=> $ans_key,
				'created_by'	=> $user_id,
				'created_on'	=> date('Y-m-d H:i:s'),
			);
		
		
		}elseif($exam_pt==3){
		
		}else{
		
		
		}
		if(empty($errors)==true)
			 {
				$this->alam->update('online_exam_question',$savequs,"id='$qus_id'");
			//**************Question Image***************************/
				
					if(!empty($_FILES['img']['name'])){
						$filepath2='online_exam/'.$schedule.'/question';
						$filepath='online_exam/'.$schedule;
						if(!is_dir($filepath)){
						 mkdir($filepath, 0755);
						 mkdir($filepath2, 0755);
						}
							$image              = $_FILES['img']['name']; 
							$expimage           = explode('.',$image);				
							$image_ext          = $expimage[1];
							$image_name         =  'Q'.$qus_id.'.'.$image_ext;
							$imagepath          = $filepath2.'/'.$image_name;
								
						move_uploaded_file($_FILES["img"]["tmp_name"],$imagepath);
						$qusimg	=	array(
							'qus_img'	=>$imagepath,
						);
						$this->alam->update('online_exam_question',$qusimg,"id='$qus_id'");
						}
					//*******************Answer image A*************************//	
					if(!empty($_FILES['img1']['name'])){
					$filepath2='online_exam/'.$schedule.'/question';
					$filepath='online_exam/'.$schedule;
					if(!is_dir($filepath)){
					 mkdir($filepath, 0755);
					 mkdir($filepath2, 0755);
					}
						$image              = $_FILES['img1']['name']; 
						$expimage           = explode('.',$image);				
						$image_ext          = $expimage[1];
						$image_name         =  'A'.$qus_id.'.'.$image_ext;
						$imagepath          = $filepath2.'/'.$image_name;
							
					move_uploaded_file($_FILES["img1"]["tmp_name"],$imagepath);
					$qusimg	=	array(
						'option_img_1'	=>$imagepath,
					);
					$this->alam->update('online_exam_question',$qusimg,"id='$qus_id'");
					}
					
					//*******************Answer image B*************************//	
					if(!empty($_FILES['img2']['name'])){
					$filepath2='online_exam/'.$schedule.'/question';
					$filepath='online_exam/'.$schedule;
					if(!is_dir($filepath)){
					 mkdir($filepath, 0755);
					 mkdir($filepath2, 0755);
					}
						$image              = $_FILES['img2']['name']; 
						$expimage           = explode('.',$image);				
						$image_ext          = $expimage[1];
						$image_name         =  'B'.$qus_id.'.'.$image_ext;
						$imagepath          = $filepath2.'/'.$image_name;
							
					move_uploaded_file($_FILES["img2"]["tmp_name"],$imagepath);
					$qusimg	=	array(
						'option_img_2'	=>$imagepath,
					);
					$this->alam->update('online_exam_question',$qusimg,"id='$qus_id'");
					}
					//*******************Answer image C*************************//	
					if(!empty($_FILES['img3']['name'])){
					$filepath2='online_exam/'.$schedule.'/question';
					$filepath='online_exam/'.$schedule;
					if(!is_dir($filepath)){
					 mkdir($filepath, 0755);
					 mkdir($filepath2, 0755);
					}
						$image              = $_FILES['img3']['name']; 
						$expimage           = explode('.',$image);				
						$image_ext          = $expimage[1];
						$image_name         =  'C'.$qus_id.'.'.$image_ext;
						$imagepath          = $filepath2.'/'.$image_name;
							
					move_uploaded_file($_FILES["img3"]["tmp_name"],$imagepath);
					$qusimg	=	array(
						'option_img_3'	=>$imagepath,
					);
					$this->alam->update('online_exam_question',$qusimg,"id='$qus_id'");
					}
					//*******************Answer image D*************************//	
					if(!empty($_FILES['img4']['name'])){
					$filepath2='online_exam/'.$schedule.'/question';
					$filepath='online_exam/'.$schedule;
					if(!is_dir($filepath)){
					 mkdir($filepath, 0755);
					 mkdir($filepath2, 0755);
					}
						$image              = $_FILES['img4']['name']; 
						$expimage           = explode('.',$image);				
						$image_ext          = $expimage[1];
						$image_name         =  'D'.$qus_id.'.'.$image_ext;
						$imagepath          = $filepath2.'/'.$image_name;
							
					move_uploaded_file($_FILES["img4"]["tmp_name"],$imagepath);
					$qusimg	=	array(
						'option_img_4'	=>$imagepath,
					);
					$this->alam->update('online_exam_question',$qusimg,"id='$qus_id'");
					}			
					//*******************Answer image E*************************//	
					if(!empty($_FILES['img5']['name'])){
					$filepath2='online_exam/'.$schedule.'/question';
					$filepath='online_exam/'.$schedule;
					if(!is_dir($filepath)){
					 mkdir($filepath, 0755);
					 mkdir($filepath2, 0755);
					}
						$image              = $_FILES['img5']['name']; 
						$expimage           = explode('.',$image);				
						$image_ext          = $expimage[1];
						$image_name         =  'E'.$qus_id.'.'.$image_ext;
						$imagepath          = $filepath2.'/'.$image_name;
							
					move_uploaded_file($_FILES["img5"]["tmp_name"],$imagepath);
					$qusimg	=	array(
						'option_img_5'	=>$imagepath,
					);
					$this->alam->update('online_exam_question',$qusimg,"id='$qus_id'");
					}
					
				redirect('onlineexam/teacher/addquestion/AddExamQuestion/addquestion/'.$schedule);
				}else{
				$this->session->set_flashdata('msg',$errors);
				redirect('onlineexam/teacher/addquestion/EditExamQuestion/editquestion/'.$qus_id );
				}	
	
	}
	
	public function viewModal(){
		 $ids			=$this->input->post('id');
		 $question_list	=$this->alam->selectA('online_exam_question','*',"schedule_id='$ids'");
		 ?>
		 <div class="row">
			<div class="table-responsive">
			<table class='table'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important; width:50px;'>Sl.No.</th>
					<th style='background:#337ab7; color:#fff !important;'>Question</th>
					<th style='background:#337ab7; color:#fff !important;width:100px;'>Answer Key</th>
					<th style='background:#337ab7; color:#fff !important;width:100px;'>Marks</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$c=0;
			foreach($question_list as $key=>$vals){
			
			?>
				<tr>
				<td style="border: 1px solid #bbb0b0;"><?=++$c;?></td>
				<td style="border: 1px solid #bbb0b0;"><strong><?=$vals['question'];?></strong>
				<?php
				if($vals['obj_no_option']>0){
				if($vals['obj_no_option']==2){
				echo '<p>A.&nbsp;'.$vals['option_1'].'</p>';
				echo '<p>B.&nbsp;'.$vals['option_2'].'</p>';
				}elseif($vals['obj_no_option']==4){
				echo '<p>A.&nbsp;'.$vals['option_1'].'</p>';
				echo '<p>B.&nbsp;'.$vals['option_2'].'</p>';
				echo '<p>C.&nbsp;'.$vals['option_3'].'</p>';
				echo '<p>D.&nbsp;'.$vals['option_4'].'</p>';
				
				}else{
				echo '<p>A.&nbsp;'.$vals['option_1'].'</p>';
				echo '<p>B.&nbsp;'.$vals['option_2'].'</p>';
				echo '<p>C.&nbsp;'.$vals['option_3'].'</p>';
				echo '<p>D.&nbsp;'.$vals['option_4'].'</p>';
				echo '<p>E.&nbsp;'.$vals['option_5'].'</p>';
				}
				}
				?>
				</td>
				<td style="border: 1px solid #bbb0b0;"><?=$vals['ans_key'];?></td>
				<td style="border: 1px solid #bbb0b0;"><?=$vals['marks'];?></td>
				
				</tr>
				<?php }?>
			</tbody>
			</table>
			</div>
			</div>
			<?php
	}
	
	public function question_list(){
		$qus_id			=$this->input->post('qus_id');
		$question_list	=$this->alam->selectA('online_exam_question','*',"id='$qus_id'");
		$question	=$question_list[0]['question'];
		$option_1		=$question_list[0]['option_1'];
		$option_2		=$question_list[0]['option_2'];
		$option_3		=$question_list[0]['option_3'];
		$option_4		=$question_list[0]['option_4'];
		$option_5		=$question_list[0]['option_5'];
		$obj_no_option	=$question_list[0]['obj_no_option'];
		$marks			=$question_list[0]['marks'];
		$array = array($qus_id,$question,$option_1,$option_2,$option_3,$option_4,$option_5,$obj_no_option,$marks);	
		echo json_encode($array);
		
		
		
	}
	
	
	
	
}