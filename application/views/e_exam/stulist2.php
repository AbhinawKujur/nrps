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
      <div class="panel-heading">Copy Correction List: <?=$cls[0]['CLASS_NM'];?>-<?=$sec[0]['SECTION_NAME'];?>,<span style="margin-left:10px"><?=$subnm[0]['SubName'];?></span><span style="float:right">Exam date &nbsp;: &nbsp;<?=date('d-M-Y',strtotime($exam_date));?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="<?=base_url('e_exam/CopyCorrection')?>"><button type="button" class="btn btn-danger btn-sm">Back</button></a> </span> </div>
      <div class="panel-body" style="background-color:white;">
	  
  <div class="row">
	 <input type="button" value="Print" class="btn btn-success btn-sm" onclick="printDiv()"><br><br>
		
  <div class="table-responsive" id="GFG">
	  
		 	<table class='table'>
			
				<tr>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'>&nbsp;<strong>Adm. No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Roll No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;'><strong>Status</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;border-right: 1px solid #d6cece;'><strong>Action</strong></td>
					
				</tr>
				<?php
				foreach($Student_list as $qus=>$vals){
				?>
				<tr>
				<td style="border: 1px solid #d6cece;border-left: 1px solid #d6cece;">&nbsp;<?=$vals['ADM_NO']?></td>
				<td style="border: 1px solid #d6cece;"><?=$vals['ROLL_NO'];?></td>
				<td style="border: 1px solid #d6cece;"><?=$vals['FIRST_NM'];?></td>
				<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;">
				
				<?php if(!empty($vals['appl'])) {if(!empty($vals['correct'])){echo "<span style='color:green'>Corrected</span>";}else{echo "<span style='color:red'>Uncorrected</span>";} }else{ echo "<span style='color:red'>Not Appeared</span>"; }?></td>
				<td style="border: 1px solid #d6cece;border-right: 1px solid #d6cece;">
				<form method="post" action="<?=base_url('e_exam/RemarksAssessment/student_exam_details');?>">
				<input type="hidden" name="adm_no" value="<?=$vals['ADM_NO']?>">
				<input type="hidden" name="classess1" value="<?=$class_no?>">
				<input type="hidden" name="section_id" value="<?=$section_no?>">
				<input type="hidden" name="subject_nam" value="<?=$subject_nam?>">
				<input type="hidden" name="exam_date" value="<?=$exam_date?>">
				<?php if(empty($vals['appl']) ){echo "<button type='button' class='btn btn-danger btn-sm'>Not Appeared</button>";}else{echo "<button type='submit' class='btn btn-info btn-sm'>Open Copy</button>";} ?>
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
		
		 function printDiv() { 
            var divContents = document.getElementById("GFG").innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write('<html>'); 
            //a.document.write('<body > <h1>Div contents are <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
		
		
</script>

 
 