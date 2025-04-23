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
      <div class="panel-heading">Late Submission Report</div>
      <div class="panel-body" style="background-color:white;">
	  <form method="post" action="<?=base_url('e_exam/homework/CopyCorrection/stulist');?>">
	  <div class="row">
      <div class="col-sm-3">
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
      <div class="col-sm-3">
      <label>Section</label><select class='form-control' id='section_id' name="section_id" onchange='section_sec(this.value)' >
        <option value=''>Select</option>
      </select>
      </div>
      </div><br />
      </form>   
      </div>
	</div><br />
	
	<div class="panel panel-primary" style='background:#fff;'>
		 <div id="load"></div>
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
			url: "<?php echo base_url('e_exam/homework/LateHomeworkSubmission/Class_sec'); ?>",
			type: "POST",
			data: {class_code:class_code},
			success: function(ret){
				$("#section_id").html(ret);
			}
		});
	}
	
	function section_sec(sec_no){
		$("#load").html('');
		$("body").css({"opacity": "0.5"});
		var class_code = $('#classes').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/homework/LateHomeworkSubmission/getReport'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code},
			success: function(ret){
				$("body").css({"opacity": ""});
				$("#load").html(ret);
			}
		});
	}
</script>