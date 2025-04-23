<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RemarksAssessment extends MY_controller{
	
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
		$this->load->model('Pawan','pawan');		
	}
	
	public function index(){	
		$array['class_no']   	= $this->pawan->selectA('classes','*');				
						
        $this->render_template('e_exam/remarks_assessment',$array);		
	}
	
	public function Class_sec(){
		 $class_no	=$this->input->post('class_code');
		 $data = $this->pawan->section_name_cwisw($class_no);
		 ?>


		<select id="section_id" name='section_id' style="padding:2px; width:174px;">
			    <option value=''>Select</option>
				<?php
				  if(isset($data)){
					  foreach($data as $dt){
						?>
						<option value="<?php echo $dt->section_no; ?>"><?php echo $dt->section_nm; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function subject_nam(){
		 $class_no	=$this->input->post('class_code');
		 $sec_no	=$this->input->post('sec_no');
		 $data1 = $this->pawan->subject_name_cwisw($class_no);
		 print_r($data1);
		 ?>


		<select id="subject_nam" name='subject_nam' style="padding:2px; width:174px;" onchange='section_sec(this.value)'>
			    <option value=''>Select</option>
				<?php
				  if(isset($data1)){
					  
					  foreach($data1 as $dt1){
						  
						?>
						<option value="<?php echo $dt1->subject; ?>"><?php echo $dt1->sub_name; ?></option>
						<?php
					  }
				  }
				?>
		</select>
			  <?php 
	}
	
	public function student_exam_details(){		
		 $class_no			= $this->input->post('class_id');
		 $section_no		= $this->input->post('section_id');
		 $subject_nam		= $this->input->post('subject_nam');
		 $question			= $this->pawan->question_det($class_no,$section_no,$subject_nam);
		
		 ?>
		 <div class="table-responsive">
		 	<table class='table'>
			
				<tr>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>ADM. NO.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>NAME</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 230px;'><strong>Question</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 310px;'><strong>Answer</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;width: 50px;'><strong>Marks</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Remarks</strong></td>
				</tr>
				<?php
				foreach($question as $qus){
				?>
				<tr>
				<td style="border: 1px solid ;"><?=$qus->admno?></td>
				<td style="border: 1px solid ;"><?=$qus->stuname;?></td>
				<td style="border : 1px solid ;"><?=$qus->question;?>&nbsp;&nbsp;<span style="color:red;float: right;">(MM : <?=$qus->maxmarks;?>)</span></td>
				<td style="border : 1px solid ;"><?=$qus->ans?></td>
				<td style="border : 1px solid ;">
				
				<input type="text" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66" onchange="marksd(this.value,'<?=$qus->qid?>')" maxlength='2' name="marks" id="marks_<?=$qus->qid?>" value="<?=$qus->ob_marks?>" class="form-control">
				</td>
				
				<td style="border: 1px solid ;border-right: 1px solid ;">
				<input type="hidden" name="maxmarks" value="<?=$qus->maxmarks;?>" id="maxmarks_<?=$qus->qid;?>">
				<input type="text" name="remarks" value="<?=$qus->remarks;?>" id="remarks_<?=$qus->qid?>" onchange="marksd(this.value,'<?=$qus->qid;?>')" class="form-control" >				
				</td>
				</tr>
				<?php } ?>

</table>				
<?php				
	}
	
	public function marks_entry(){		
		 $ids				= $this->input->post('qid');
		 $marks				= $this->input->post('marks');
		 $remarks			= $this->input->post('remarks');
		
		 
		 $arr=array(
		 'ob_marks'	=>	$marks,	
		 'remarks'	=>	$remarks
		 );
		 
		 $this->pawan->update('e_exam_answers',$arr,"id='$ids'");
		 
	}
}
