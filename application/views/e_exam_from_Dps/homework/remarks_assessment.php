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
      <div class="panel-heading">Homework Copy Correction for <?=$stunam[0]['FIRST_NM'];?>,&nbsp;Roll No.: <?=$stunam[0]['ROLL_NO']?>
	  <form method="post" action="<?=base_url('e_exam/homework/CopyCorrection/stulist');?>">
	  
			<input type="hidden" name="classess1" value="<?=$class_no?>">
			<input type="hidden" name="section_id" value="<?=$section_no?>">
			<input type="hidden" name="subject_nam" value="<?=$subject_nam?>">
			<input type="hidden" name="submition_dt" value="<?=$submition_dt?>">
			<input type="hidden" name="created_at" value="<?=$created_at?>">
	  
	  <button type="submit" style="float:right;margin-top: -22px;" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back To Student List</button>
	  
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
					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Remarks (if any)</strong></td>
				</tr>
				<?php
				$f=0;
				$st=0;
				
				$question	= $this->pawan->selectA('e_exam_answers_hw','*',"subj_id='$subject_nam' and admno='$selected_stu' and target_date='$submition_dt' and homework_id='$homwrkid'");
				
				//echo $this->db->last_query();
				foreach($question as $qus=>$vals){
				$TST	=$vals['teacher_final_copy_correction'];
				$qi	=$vals['que_id'];
				$q_img	=$this->pawan->selectA('e_exam_questions_hw_append','*',"id='$qi' and que_img!=''");
				//echo $this->db->last_Query();die;
				$q_image 	= (!empty($q_img[0]['que_img']))?$q_img[0]['que_img']:'';	
		
				?>
				
				<tr>
				
				<td style="border: 1px solid ;"><?=++$f;?></td>
				<td style="border: 1px solid ;width: 230px;"><?=$vals['question'];?>&nbsp;&nbsp;<span style="float:right;"><?php if($q_image){?><img src="<?=base_url().$q_image;?>" style="width:50px;height:50px;float:right;"><?php } ?></span></td>
				<td style="border: 1px solid ;width: 450px;">
					<?=$vals['ans']?>
					<?php
						if($vals['img_status'] == 1){
					?>
						<a href='<?php echo base_url($vals['img']); ?>' target='_blank'><i class="fa fa-picture-o pull-right" style='font-size:22px; color:blue' title='VIEW IMAGE'></i></a>
				    <?php } ?>
				</td>
				
				
				<td style="border: 1px solid ;">				
				<input type="text" name="remarks" <?php if($TST==2){ echo 'readonly';}else{}?> style="background-color:#e6f2fd" value="<?php echo $vals['remarks']; ?>" placeholder="----" id="remarks_<?=$vals['id']?>" onchange="remarksd(this.value,'<?=$vals['id'];?>')" class="form-control" >				
				</td>
				</tr>
				<?php } ?>
				

</table>				

   </div>
   </form>
<form method="post" action="<?=base_url('e_exam/homework/CopyCorrection/stulist1');?>">
	  
			<input type="hidden" name="classess1" value="<?=$class_no?>">
			<input type="hidden" name="section_id" value="<?=$section_no?>">
			<input type="hidden" name="subject_nam" value="<?=$subject_nam?>">
			<input type="hidden" name="submition_dt" value="<?=$submition_dt?>">
			<input type="hidden" name="created_at" value="<?=$created_at?>">
			<input type="hidden" name="homwrkid" value="<?=$homwrkid?>">
	  		<input type="hidden" name="selected_stu" value="<?=$selected_stu?>">
	  
	  <?php if($TST==2){}else{?>
	  <button type="submit" style="float:right;margin-top: 10px;"  class="btn btn-success btn-sm">&nbsp;SAVE</button>
	<!--<span style="font-size:12px;font-family:Verdana;float:right;color:#000000;">Click SAVE button to .......... </span>-->  <?php }?>
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
	
	
	
	function remarksd(value,qid){	
		var qid		=	qid;		
		var remarks	=	 $('#remarks_'+qid).val();		
		$.post("<?php echo base_url('e_exam/homework/RemarksAssessment/remarks_entry'); ?>",{qid:qid,remarks:remarks},				function(data){
		alert_msg('','Remarks Recorded...!','success');
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

 