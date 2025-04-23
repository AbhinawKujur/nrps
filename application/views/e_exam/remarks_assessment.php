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
      <div class="panel-heading">Copy Correction for <?=$stunam[0]['FIRST_NM'];?>&nbsp;Roll No.: <?=$stunam[0]['ROLL_NO']?>
	  <form method="post" action="<?=base_url('e_exam/CopyCorrection/stulist');?>">
	  
			<input type="hidden" name="classess1" value="<?=$class_no?>">
			<input type="hidden" name="section_id" value="<?=$section_no?>">
			<input type="hidden" name="subject_nam" value="<?=$subject_nam?>">
			<input type="hidden" name="exam_date" value="<?=$exam_date?>">
	  
	  <button type="submit" style="float:right;margin-top: -22px;" class="btn btn-danger btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back To Student List</button>
	  
	  </form>
	  </div>
      <div class="panel-body" style="background-color:white;">
	  <form method="post" action="<?=base_url('e_exam/RemarksAssessment/student_exam_details');?>">
  <?php
  
	

 ?>
  
   <div class="row" style="padding: 20px;font-size: 13px;">
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
				
				$question	= $this->pawan->question_det($class_no,$section_no,$subject_nam,$selected_stu,$exam_date);
				
				
				foreach($question as $qus){
					$st=$st+$qus->ob_marks;
				?>
				<tr>
				
				<td style="border: 1px solid ;"><?=++$f;?></td>
				<td style="border : 1px solid ;width: 230px;"><?=$qus->question;?>&nbsp;&nbsp;<span style="color:red;float: right;">(MM : <?=$qus->maxmarks;?>)</span></td>
				<td style="border : 1px solid ;width: 310px;"><?=$qus->ans?></td>
				<td style="border : 1px solid ;width: 50px;">
				<?php
				
					
					$ob=$qus->ob_marks;
				
				?>
				<input type="text" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57 || event.charCode == 46 || event.charCode == 97 || event.charCode == 98 || event.charCode == 65 || event.charCode == 66 || event.charCode == 13" onchange="marksd(this.value,'<?=$qus->qid?>')" maxlength='3' name="marks" id="marks_<?=$qus->qid;?>" style="background-color:#f1b0b0; text-align:center" value="<?php if(!empty($qus->ob_marks)){echo $ob;}?>" class="form-control test">
				
				</td>
				
				<td style="border: 1px solid ;">
				<input type="hidden" name="maxmarks" value="<?=$qus->maxmarks;?>" id="maxmarks_<?=$qus->qid;?>">
				<input type="text" name="remarks" style="background-color:#e6f2fd" value="<?php echo $qus->remarks; ?>" placeholder="----" id="remarks_<?=$qus->qid?>" onchange="remarksd(this.value,'<?=$qus->qid;?>')" class="form-control" >				
				</td>
				</tr>
				<?php } ?>
				<tr><td colspan="3" style="border: 1px solid;font-size:16px;text-align:right"><b>Total Marks&nbsp;&nbsp;</b></td><td style="border: 1px solid ;"><b><input type="text" disabled style="width:57px;border: 1px solid;font-size:16px;text-align:center"  id="demo" value="<?=$st;?>"></b></td><td style="border: 1px solid ;"></td></tr>

</table>				

   </div>
   </form>
<form method="post" action="<?=base_url('e_exam/CopyCorrection/stulist');?>">
	  
			<input type="hidden" name="classess1" value="<?=$class_no?>">
			<input type="hidden" name="section_id" value="<?=$section_no?>">
			<input type="hidden" name="subject_nam" value="<?=$subject_nam?>">
			<input type="hidden" name="exam_date" value="<?=$exam_date?>">
	  
	  <button type="submit" style="float:right;margin-top: 10px;" class="btn btn-success btn-sm">&nbsp;Save & Submit</button>
	  
	  </form>
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
	
	
	function marksd(value,qid){	
		var qid		=	qid;
		var marks	=	 Number($('#marks_'+qid).val());		
		var maxmarks=	 Number($('#maxmarks_'+qid).val());

		if(maxmarks>=marks){
		$.post("<?php echo base_url('e_exam/RemarksAssessment/marks_entry'); ?>",{qid:qid,marks:marks},function(data){
			if(marks==""){			
			$('#marks_'+qid).val(0);
			}
			sum(qid);
			alert_msg('','Marks Entered...!','success');
		});
		}else{
			
			var marks=0;
			$.post("<?php echo base_url('e_exam/RemarksAssessment/marks_entry'); ?>",{qid:qid,marks:marks},function(data){					
			//$('#marks_'+qid).val(0);			
			sum(qid);
			alert_msg('','Enter Valid Marks...!','error');
			
			$('#marks_'+qid).val('0');
			$('#marks_'+qid).focus();
		});
		}
		
	}
	
	function remarksd(value,qid){	
		var qid		=	qid;
		
		var remarks	=	 $('#remarks_'+qid).val();		
		$.post("<?php echo base_url('e_exam/RemarksAssessment/remarks_entry'); ?>",{qid:qid,remarks:remarks},function(data){
			alert_msg('','Remarks Recorded...!','success');
		});
		
		
	}
	
	function sum(qid){	
		//alert(qid);
		$.post("<?php echo base_url('e_exam/RemarksAssessment/sum_mark'); ?>",{qid:qid},function(data){
			//alert(data);
			document.getElementById("demo").value = data;
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
		
		$(".test").on("input", function() {
  			if (/^0/.test(this.value)) {
    		this.value = this.value.replace(/^0/, "")
  			}
		})
	
</script>

 