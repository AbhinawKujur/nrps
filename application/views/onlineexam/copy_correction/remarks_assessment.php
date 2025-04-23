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
$stunam	= $this->pawan->selectA('student','FIRST_NM,ROLL_NO',"ADM_NO='$selected_stu'");
 		 
?>
<!--four-grids here-->
<div class="panel panel-primary">
      <div class="panel-heading">Exam Copy Correction for <?=$stunam[0]['FIRST_NM'];?>,&nbsp;Roll No.: <?=$stunam[0]['ROLL_NO']?>
	  <form method="post" action="<?=base_url('onlineexam/copy_correction/CopyCorrection/stulist');?>">
	  		<input type="hidden" name="classess1" value="<?=$class_no; ?>">
			<input type="hidden" name="section_id" value="<?=$section_no; ?>">
			<input type="hidden" name="subject_nam" value="<?=$subject_nam; ?>">
			<input type="hidden" name="exam_datee" value="<?=$exam_datee; ?>">		  
			<input type="hidden" name="class_id" value="<?=$class_ids; ?>">
			<input type="hidden" name="sec_id" value="<?=$section_id; ?>">
			<input type="hidden" name="subject_id" value="<?=$subject_ids; ?>">
			<input type="hidden" name="exam_schedule_id" value="<?=$exam_schedule_id; ?>">
		  
	  
	  <button type="submit" style="float:right;margin-top: -22px; font-size:8px;"  class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back To Student List</button>
	  
	  </form>
	  </div>
      <div class="panel-body" style="background-color:white;">
	  <form method="post" action="<?=base_url('e_exam/homework/RemarksAssessment/student_exam_details');?>">
  <?php
  
	

 ?>
  
   <div class="table-responsive">
		 	<table class='table'>			
				<tr>					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Q. No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Question</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Answer</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Marks</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Remarks (if any)</strong></td>
				</tr>
				<?php
				$f=0;
				$st=0;
				$answer=$this->db->query("SELECT oea.remarks_id,oea.id,oea.ans,oea.stu_marks,oe.question,oe.qus_img,oe.marks,oea.comment,oea.teacher_final_copy_correction,oea.img,oea.img_status,oe.qus_no FROM `online_exam_answers` AS oea INNER JOIN online_exam_question AS oe ON oea.que_id=oe.id WHERE oea.`admno`= '$selected_stu' and oe.`schedule_id` = '$exam_schedule_id' and oe.`exam_ptern_id` = '1'")->result();				
				//$answer	= $this->pawan->selectA('online_exam_answers','*',"subj_id='$subject_ids' and admno='$selected_stu'  and exam_schedule_id='$exam_schedule_id' and exam_pattern='1'");
				//echo $this->db->last_Query();die;
				foreach($answer as $qus=>$vals){
				 $TST	=(!empty($vals->teacher_final_copy_correction))?$vals->teacher_final_copy_correction:'';
				 $ob	=$vals->stu_marks;
				 $q_image 	= (!empty($vals->qus_img))?$vals->qus_img:'';	
		
				?>				
				<tr>				
				<td style="border: 1px solid ;"><?=$vals->qus_no;?></td>
				<td style="border: 1px solid ;width: 230px;"><?=$vals->question;?>&nbsp;&nbsp;<span style="float:right;"><?php if($q_image){?><img src="<?=base_url().$q_image;?>" style="width:50px;height:50px;float:right;"><?php } ?></span>
					<br/>
					<span style="float:right;" class='label label-danger'>Max Marks:<?=$vals->marks;?></span>
					</td>
				<td style="border: 1px solid ;width: 450px;">
					<?=$vals->ans; ?>
					<?php
						if($vals->img_status == 1){
					?>
						<a href='<?php echo base_url($vals->img); ?>' target='_blank'><i class="fa fa-picture-o pull-right" style='font-size:22px; color:blue' title='VIEW IMAGE'></i></a>
				    <?php } ?>
				</td>
				<td style="border: 1px solid ;width:50px;">	
				<?php //if(!empty($vals->ans) || $vals->img_status>0){?>
				<input type="text" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66 || event.charCode == 13" onchange="marksd(this.value,'<?=$vals->id;?>')" maxlength='3' name="marks" id="marks_<?=$vals->id;?>" style="background-color:#f1b0b0; text-align:center" value="<?php if(!empty($ob)){echo $ob;}?>" class="form-control test">
					<input type="hidden" name="maxmarks" value="<?=$vals->marks; ?>" id="maxmarks_<?=$vals->id;?>">
					<?php //} ?>
					</td>
				<td style="border: 1px solid ;">
				<?php //if(!empty($vals->ans) || $vals->img_status>0){?>
					<select name="remarks" class='form-control' id='remarks_<?=$vals->id;?>' onchange="remarksd(this.value,'<?=$vals->id;?>')">
						<option>---Select---</option>
						<?php
						foreach($remark as $keys=>$val){
							?>
						<option value='<?=$val['id']; ?>'<?php if(isset($vals->remarks_id)){if($vals->remarks_id==$val['id']){echo 'selected';}}?>><?=$val['remarks']; ?></option>
						<?php } ?>
					</select>
					<br>
					<textarea name='comment' id='comment_<?=$vals->id;?>' onchange="commentrd(this.value,'<?=$vals->id;?>')" class='form-control'><?=$vals->comment; ?></textarea>
						<?php } ?>
				</td>
				</tr>
				<?php //} ?>
				

</table>				

   </div>
   </form>
<form method="post" action="<?=base_url('onlineexam/copy_correction/CopyCorrection/stulist1');?>">
	  
			<input type="hidden" name="classess1" value="<?=$class_no; ?>">
			<input type="hidden" name="section_id" value="<?=$section_no; ?>">
			<input type="hidden" name="subject_nam" value="<?=$subject_nam; ?>">
			<input type="hidden" name="exam_datee" value="<?=$exam_datee; ?>">		  
			<input type="hidden" name="class_id" value="<?=$class_ids; ?>">
			<input type="hidden" name="sec_id" value="<?=$section_id; ?>">
			<input type="hidden" name="subject_id" value="<?=$subject_ids; ?>">
			<input type="hidden" name="exam_schedule_id" value="<?=$exam_schedule_id; ?>">
			<input type="hidden" name="selected_stu" value="<?=$selected_stu; ?>">
	  
	  <?php 
	if(isset($TST)){
	if($TST==2){}else{?>
	  <button type="submit" style="float:right;margin-top: 10px;"  class="btn btn-success btn-sm">&nbsp;SAVE</button>
	<!--<span style="font-size:12px;font-family:Verdana;float:right;color:#000000;">Click SAVE button to .......... </span>-->  <?php } }?>
	  </form>
	  </div>

    </div>
	


<br />
<br />
<div class="clearfix"></div>
<!--copy rights start here-->
<script>
	jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(this) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});
	/******************************Marks Entry**************************/
	function marksd(value,qid){	
		var qid		=	qid;
		var marks	=	 Number($('#marks_'+qid).val());		
		var maxmarks=	 Number($('#maxmarks_'+qid).val());
		if(maxmarks>=marks){
		$.post("<?php echo base_url('onlineexam/copy_correction/RemarksAssessment/marks_entry'); ?>",{qid:qid,marks:marks},function(data){
			if(marks==""){			
			$('#marks_'+qid).val(0);
			}
			//sum(qid);
			alert_msg('','Marks Entered...!','success');
		});
		}else{			
			var marks=0;
			//$.post("<?php echo base_url('onlineexam/copy_correction/RemarksAssessment/marks_entry'); ?>",{qid:qid,marks:marks},function(data){				//$('#marks_'+qid).val(0);			
			//sum(qid);
			alert_msg('','Enter Valid Marks...!','error');			
			$('#marks_'+qid).val('0');
			$('#marks_'+qid).focus();
		//});
		}
		
	}
	
	/******************************remarks code**************************/
	function remarksd(value,qid){	
		var qid		=	qid;		
		var remarks	=	 $('#remarks_'+qid).val();		
		$.post("<?php echo base_url('onlineexam/copy_correction/RemarksAssessment/remarks_entry'); ?>",{qid:qid,remarks:remarks},				function(data){
		alert_msg('','Remarks Recorded...!','success');
		});
	}
	
	/******************************Comment code**************************/
	function commentrd(value,qid){	
		var qid		=	qid;		
		var comment	=	 $('#comment_'+qid).val();		
		$.post("<?php echo base_url('onlineexam/copy_correction/RemarksAssessment/comment_entry'); ?>",{qid:qid,comment:comment},				function(data){
		alert_msg('','Comment Recorded...!','success');
		});
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

 