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
<!--four-grids here-->
<div class="panel panel-primary">
  <div class="panel-heading" style="font-size:11px;"><div class="row">Exam Copy Correction List:
    <?=$test['class_no'];?>
    -
    <?=$test['section_no'];?>
    ,<span style="margin-left:10px">
    <?=$test['subject_nam'];?>
    </span><span style="float:right">Exam Date &nbsp;: &nbsp;
    <?=$test['exam_datee'];?>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=base_url('onlineexam/copy_correction/CopyCorrection')?>">
    <button type="button" style="font-size:9px;" class="btn btn-danger btn-sm">Back</button>
    </a> </span></div> </div>
  <div class="panel-body" style="background-color:white;">
    <table class='table'>
      <tr>
        <td style='background:#5785c3; color:#fff!important;border: 1px solid;'>&nbsp;<strong>Adm. No.</strong></td>
        <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Roll No.</strong></td>
        <td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
        <td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;'><strong>Exam Status</strong></td>
        <td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;'><strong>Action</strong></td>
      </tr>
      <?php
				$exam_schedule_id=$test['exam_schedule_id'];
				foreach($Student_list as $qus){
				$adm=$qus->ADM_NO;
				$e_date=$test['exam_datee'];
					
				$stusta2=$this->pawan->selectA('online_exam_answers','count(id) as cont',"exam_schedule_id='$exam_schedule_id' and admno='$adm'   and date(answered_date)='$e_date'");
				
				$tec_sta2=$stusta2[0]['cont'];
					
				$stusta=$this->pawan->selectA('online_exam_answers','count(id) as cont',"exam_schedule_id='$exam_schedule_id' and admno='$adm'  and teacher_final_copy_correction='2'");
				 $tec_sta=$stusta[0]['cont'];
				
				$stusta1=$this->pawan->selectA('online_exam_answers','count(id) as cont',"exam_schedule_id='$exam_schedule_id' and admno='$adm'  and final_submit_status=1 and ans_status=1 and  teacher_final_copy_correction in ('1','0')");
				$tec_sta1=$stusta1[0]['cont'];
				
				
				?>
      <tr>
        <td style="border: 1px solid #d6cece;border-left: 1px solid #d6cece;">&nbsp;
          <?=$qus->ADM_NO;?></td>
        <td style="border: 1px solid #d6cece;"><?=$qus->ROLL_NO;?></td>
        <td style="border: 1px solid #d6cece;"><?=$qus->FIRST_NM;?></td>
        <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;"><?php
					if($tec_sta2==0)
					{
					echo "<span style='color:red'>Not Appeared</span>";				
					}				
					else
					{
					if($tec_sta>0){
					echo "<span style='color:green'>Corrected</span>";
					}else{
					
					echo "<span style='color:#fd9514;'><strong>Pending</strong></span>";
					}
					}					
					
				?>
        </td>
        <td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;">
			
            <?php
				if($tec_sta1>0 &&  $tec_sta2>0 ){
				?>
			<form method="post" action="<?=base_url('onlineexam/copy_correction/RemarksAssessment/student_exam_details');?>">
            <input type="hidden" name="adm_no" value="<?=$adm?>">
            <input type="hidden" name="class_ids" value="<?=$test['class_id']?>">
            <input type="hidden" name="section_id" value="<?=$test['section_id'];?>">
            <input type="hidden" name="subject_ids" value="<?=$test['subject_id']; ?>">
            <input type="hidden" name="exam_datee" value="<?=$test['exam_datee'];?>">
            <input type="hidden" name="exam_schedule_id" value="<?=$exam_schedule_id; ?>">
            <input type="hidden" name="classess1" value="<?=$test['class_no']; ?>">
            <input type="hidden" name="section_no" value="<?=$test['section_no'];?>">
            <input type="hidden" name="subject_nam" value="<?=$test['subject_nam']; ?>">
            <button type='submit' class='btn btn-info btn-sm'>&nbsp;Open Copy</button>
				 </form>
            <?php
				}elseif($tec_sta>0 ){
				?>
			<form method="post" action="<?=base_url('onlineexam/copy_correction/RemarksAssessment/student_exam_details2');?>">
            <input type="hidden" name="adm_no" value="<?=$adm?>">
            <input type="hidden" name="class_ids" value="<?=$test['class_id']?>">
            <input type="hidden" name="section_id" value="<?=$test['section_id'];?>">
            <input type="hidden" name="subject_ids" value="<?=$test['subject_id']; ?>">
            <input type="hidden" name="exam_datee" value="<?=$test['exam_datee'];?>">
            <input type="hidden" name="exam_schedule_id" value="<?=$exam_schedule_id; ?>">
            <input type="hidden" name="classess1" value="<?=$test['class_no']; ?>">
            <input type="hidden" name="section_no" value="<?=$test['section_no'];?>">
            <input type="hidden" name="subject_nam" value="<?=$test['subject_nam']; ?>">
				 <button type='submit' class='btn btn-success btn-sm'>&nbsp;Open Copy</button>
			</form>
			<?php
				}else{
				echo "<button type='button' disabled='disabled' class='btn btn-danger btn-sm'>&nbsp;Open Copy</button>";
				}
				?>
         </td>
      </tr>
      <?php  } ?>
    </table>
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
