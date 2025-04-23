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
      <div class="panel-heading">Copy Correction</div>
      <div class="panel-body" style="background-color:white;">
	  <form method="post" action="<?=base_url('e_exam/CopyCorrection/stulist');?>">
  <div class="row">  
    <div class="col-sm-2">
      <label>Class</label><select class='form-control' id='classes' name="classess1" onchange='classess(this.value)'>
        <option value=''>Select</option>
        <?php
		foreach($class_no as $key => $val){
		?>
        <option value='<?php echo $val['Class_No']; ?>'><?php echo $val['CLASS_NM']; ?></option>
        <?php
		}
		?>
      </select>
    </div>
    <div class="col-sm-2">
      <label>Section</label><select class='form-control' id='section_id' name="section_id" onchange='section_sec(this.value)' >
        <option value=''>Select</option>
      </select>
    </div>    
	<div class='col-sm-3'>
      <label>Subject</label>
      <select class='form-control' id='subject_nam' name="subject_nam" onchange="subject_ids(this.value)" >
        <option value=''>Select</option>
      </select> 
    </div>
	<div class='col-sm-3'>
      <label>Exam Date</label>
      <select class='form-control' id='exam_date' name="exam_date"  >
        <option value=''>Select</option>
      </select> 
    </div>
	<div class="col-sm-2"><br />
		<button type="submit" style="float:right" name="submit" class="btn btn-success" >Display</button>
	</div> 
    </div>

      
  </div>
  <br>
  
   <hr><br>
   
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

 