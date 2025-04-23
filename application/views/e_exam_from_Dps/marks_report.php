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
<?php $t=""; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Remarks Assessment </a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
<form method="post" action="<?=base_url('e_exam/MarksReport/generateMarksReport');?>">
  <div class="row">
    <div class="col-sm-2">
      <label>Class</label>
      <select required class='form-control' id='classes' name="classes" onchange='classess(this.value)'>
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
      <label>Section</label>
      <select required class='form-control' id='section_id' name="section_id" onchange='section_sec(this.value)' >
        <option value=''>Select</option>
      </select>
    </div>
	<div class='col-sm-3'>
      <label>Subject</label>
      <select required class='form-control' id='subject_nam' name="subject" onchange="subject_ids(this.value)">
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
		<button type="submit" name="submit" class="btn btn-success">OPEN</button>
	</div>
    
  </div>
   </form>
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
			url: "<?php echo base_url('e_exam/MarksReport/Class_sec'); ?>",
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
			url: "<?php echo base_url('e_exam/MarksReport/subject_nam'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code},
			success: function(ret){
				$("#subject_nam").html(ret);
			}
		});
	}
	
	function btn_submit(){
		var class_id	=	 $('#classes').val();
		var section_id	=	 $('#section_id').val(); 
		var subject_nam	=	 $('#subject_nam').val();
		var exam_date	=	 $('#exam_date').val();
		
		$.ajax({
			url: "<?php echo base_url('e_exam/MarksReport/generateMarksReport'); ?>",
			type: "POST",
			data: {class_id:class_id,section_id:section_id,subject_nam:subject_nam,exam_date:exam_date},
			success: function(ret){
				$("#tab").html(ret);
			}
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
</script>

 