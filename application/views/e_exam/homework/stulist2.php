<style>
  table tr td,th{
	  color:#000!important;
  }
  table thead tr th{
	  background:#337ab7 !important;
	  color:#fff !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>
<br>
<?php
$cls=$this->pawan->selectA('CLASSES','CLASS_NM',"Class_No='$class_no'");
$sec=$this->pawan->selectA('SECTIONS','SECTION_NAME',"section_no='$section_no'");
$subnm=$this->pawan->selectA('Subjects','SubName',"SubCode='$subject_nam'");
?>
<!--four-grids here-->
<div class="panel panel-primary">
      <div class="panel-heading">Homework Copy Correction List: <?=$cls[0]['CLASS_NM'];?>-<?=$sec[0]['SECTION_NAME'];?>,<span style="margin-left:10px"><?=$subnm[0]['SubName'];?></span><span style="float:right">Submission Date &nbsp;: &nbsp;<?=date('d-M-Y',strtotime($submition_dt));?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=base_url('e_exam/homework/CopyCorrection')?>"><button type="button" class="btn btn-danger btn-sm">Back</button></a> </span> </div>
      <div class="panel-body" style="background-color:white;">
	  
  <div class="row">
  <div class="table-responsive">
		 	<table class='table'>
			
				<tr>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'>&nbsp;<strong>Adm. No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Roll No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;'><strong>Homework Status</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;'><strong>Action</strong></td>
					
				</tr>
				<?php
				foreach($Student_list as $qus=>$vals){
				
				 $adm=$vals['ADM_NO'];
				$stusta=$this->pawan->selectA('e_exam_answers_hw','count(id) as cont',"homework_id='$homwrkid' and admno='$adm' and final_submit_status='1' and teacher_final_copy_correction='2'");
				 $tec_sta=$stusta[0]['cont'];
				
				$stusta1=$this->pawan->selectA('e_exam_answers_hw','count(id) as cont',"homework_id='$homwrkid' and admno='$adm' and final_submit_status='1' and teacher_final_copy_correction='1'");
				$tec_sta1=$stusta1[0]['cont'];
				
				$stusta2=$this->pawan->selectA('e_exam_answers_hw','count(id) as cont',"homework_id='$homwrkid' and admno='$adm' and final_submit_status='1' and teacher_final_copy_correction='0'");
				$tec_sta2=$stusta2[0]['cont'];
				 
				
				?>
				<tr>
				<td style="border: 1px solid #d6cece;border-left: 1px solid #d6cece;">&nbsp;<?=$vals['ADM_NO']?></td>
				<td style="border: 1px solid #d6cece;"><?=$vals['ROLL_NO'];?></td>
				<td style="border: 1px solid #d6cece;"><?=$vals['FIRST_NM'];?></td>
				<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;">
				
				<?php
				if($tec_sta>0){echo "<span style='color:green'>Corrected</span>";}elseif($tec_sta1>0){echo "<span style='color:#fd9514;'><strong>Pending</strong></span>";}elseif($tec_sta2>0){echo "<span style='color:red'>Not Corrected</span>";}else{echo "<span style='color:red'>Not Submitted</span>";}?>
				</td>
				<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;">
				<form method="post" action="<?=base_url('e_exam/homework/RemarksAssessment/student_exam_details');?>">
				<input type="hidden" name="adm_no" value="<?=$vals['ADM_NO']?>">
				<input type="hidden" name="classess1" value="<?=$class_no?>">
				<input type="hidden" name="section_id" value="<?=$section_no?>">
				<input type="hidden" name="subject_nam" value="<?=$subject_nam?>">
				<input type="hidden" name="submition_dt" value="<?=$submition_dt?>">
				<input type="hidden" name="created_at" value="<?=$created_at?>">
				<input type="hidden" name="homwrkid" value="<?=$homwrkid?>">
				<?php
				if($tec_sta>0 || $tec_sta1>0 || $tec_sta2>0){
				?>
				<button type='submit' class='btn btn-info btn-sm'>&nbsp;Open Copy</button>
	  <?php
				}else{
				echo "<button type='button' disabled='disabled' class='btn btn-danger btn-sm'>&nbsp;Open Copy</button>";
				}
				?>
				</form></td>
				
				</tr>
				<?php } ?>

</table>
      
</div>

    </div>
	
	  </div>
	  </div>

<br />
<br />
<div class="clearfix"></div>
<!--inner block start here-->
<div class="inner-block"> </div>
<!--inner block end here-->
<!--copy rights start here-->
<script>
	function classess(class_code){
		
		$.ajax({
			url: "<?php echo base_url('e_exam/CopyCorrection/Class_sec'); ?>",
			type: "POST",
			data: {class_code:class_code},
			success: function(ret){
				$("#section_id").html(ret);
			}
		});
	}
	
	function section_sec(sec_no){
		var class_code = $('#classes').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/CopyCorrection/subject_nam'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code},
			success: function(ret){
				$("#subject_nam").html(ret);
			}
		});
	}
	
	function subject_ids(subject_ids){
		var class_code 	= $('#classes').val();
		var sec_no 		= $('#section_id').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/CopyCorrection/examDate'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code,subject_ids:subject_ids},
			success: function(ret){
				$("#exam_date").html(ret);
			}
		});
	}
	
	function btn_submit(){
		var class_id	=	 $('#classes').val();
		var section_id	=	 $('#section_id').val(); 
		var subject_nam	=	 $('#subject_nam').val();
		var exam_date	=	 $('#exam_date').val();
		
		$.ajax({
			url: "<?php echo base_url('e_exam/CopyCorrection/stulist'); ?>",
			type: "POST",
			data: {class_id:class_id,section_id:section_id,subject_nam:subject_nam,exam_date:exam_date},
			success: function(ret){
				//var fill = $.parseJSON(ret);
				//console.log(ret);
				$("#tab").html(ret);
				$("#submit_prog").prop('disabled',false);
				
			}
		});
	}
	
	function marksd(value,qid){	
		var qid		=	qid;
		var marks	=	 Number($('#marks_'+qid).val());
		var remarks	=	 $('#remarks_'+qid).val();
		var maxmarks=	 Number($('#maxmarks_'+qid).val());

		if(maxmarks>=marks){
		$.post("<?php echo base_url('e_exam/CopyCorrection/marks_entry'); ?>",{qid:qid,marks:marks,remarks:remarks},function(data){
			alert_msg('Success','Data Submitted successfully...!','success');
		});
		}else{
			alert_msg('Error','Enter Valid Marks...!','error');
			$('#marks_'+qid).val('');
		}
		
	}
	
		function alert_msg(head,text,icon){
			$.toast({
				heading: head,
				text: text,
				showHideTransition: 'slide',
				icon: icon,
				position: 'top-right',
			});
		}
		
		
		
		
</script>

 
 