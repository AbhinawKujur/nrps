<style>
  table tr td,th{
	  color:#000 !important;
	  padding-top:0px !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
    white-space: nowrap !important;
	padding:3px !important;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Grade Entry</a> <i class="fa fa-angle-right"></i></li>
	<li class="breadcrumb-item"><a href="#">Term <?php echo $trm; ?></a> <i class="fa fa-angle-right"></i></li>
</ol>
<input type='hidden' id='trm' value='<?php echo $trm; ?>'>
<div style="padding-left: 25px; background-color: white"><br/><br/>
  <div class="row">
	<div class="col-sm-3">
	  <table class="table">
	    <tr>
		  <th>Class</th>
		  <td>
		    <select class="form-control" onchange="classes(this.value)" id="classs">
			  <option value=''>Select</option>
			  <?php
			    if(isset($class_data)){
					foreach($class_data as $data){
						if($Class_No == $data['Class_no']){
						?>
						  <option value="<?php echo $data['Class_no']; ?>"><?php echo $data['classnm']; ?></option>
						<?php
						}
					}
				}
			  ?>
		    </select>
		  </td>
	    </tr>
		
		<input type="hidden" name="trm" id="trm" value='<?php echo $trm; ?>'>
		<input type="hidden" name="Class_No" id="Class_No" placeholder="Class_No">
		<input type="hidden" name="ExamMode" id="ExamMode" placeholder="ExamMode">
		<input type="hidden" name="view_max_markss" id="view_max_markss" placeholder="subcode">
		
		<tr>
		  <th>Sec</th>
		  <td>
		    <select class="form-control" name="sec" id="sec" onchange="secc(this.value)">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Exam Type</th>
		  <td>
		    <select class="form-control" id="exm_typ" id="exm_typ" onchange="exam_type(this.value)">
			  <option value=''>Select</option>
			  <?php
				foreach($examData as $key => $val){
					?>
						<option value='<?php echo $val['examcode']; ?>'><?php echo $val['examname']; ?></option>
					<?php
				}
			  ?>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Subject</th>
		  <td>
		    <select class="form-control" id="sub" name="sub" onchange="subjectt()">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Sort By</th>
		  <td>
		    <select class="form-control" id="sortby" name="sortby" onchange="sorybyview(this.value)">
			  <option value=''>Select</option>
			  <option value='adm_no'>Admission No</option>
			  <option value='stu_name'>Student Name</option>
			  <option value='roll_no'>Roll No</option>
		    </select>
		  </td>
	    </tr>
	  </table>
	</div>
	
	<div class="col-sm-9">
	  <div class="row">
	    <div class="col-sm-9">
	    </div>
	    <div class="col-sm-3">
	      <center><h4><b><div id="view_max_marks" style="display:none; background:red; color:#fff; border-radius:5px;"></div></b></h4></center>
	    </div>
	  </div>
	
	  <div class="row">
	  <div class="col-sm-12">
		  <center><img src="<?php echo base_url('assets/preloader/loading2.gif'); ?>" style="width:120px; display:none;" id="loading2"></center>
		  <form id='form'>
	       <div id="stu_list" style="height:400px; overflow:auto;">
		   </div>
		  </form>
	  </div>
	  </div>
	</div>
	
  </div>
</div><br /><br />
<div class="clearfix"></div>

<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
  function classes(val){
	  $.post("<?php echo base_url('cosoco_grd/CosocoGrd/classess'); ?>",{val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
		  $("#Class_No").val(fill[1]);
		  $("#ExamMode").val(fill[2]);
	  });
  }
  
  function exam_type(){
	var classs = $("#classs").val();
	var sec    = $("#sec").val();
	$.ajax({
		url: "<?php echo base_url('cosoco_grd/CosocoGrd/getSubject'); ?>",
		type: "POST",
		data: {classs:classs,sec:sec},
		success: function(data){
			$("#sub").html(data);
		} 
	});	
  }
  
  function subjectt(){
	  $("#sortby option[value='']").prop('selected', true);
  }
  
  function sorybyview(val){
	  $("#loading2").show();
	  $("#stu_list").html('');
	  var sortval  = val;
	  var sub = $("#sub").val();
	  var Class_No = $("#Class_No").val();
	  var sec      = $("#sec").val();
	  var exm_code = $("#exm_typ").val();
	  var trm      = $("#trm").val();
	 
	  $.post("<?php echo base_url('cosoco_grd/CosocoGrd/stu_list'); ?>",{sortval:sortval,sub:sub,Class_No:Class_No,sec:sec,exm_code:exm_code,trm:trm},function(data){
		  $("#loading2").hide();
		  $("#stu_list").html(data);
	  });
  }
  
  $("#form").on("submit", function (event) {	
    event.preventDefault();
	$("#process").show();
	var classs  = $("#classs").val();
	var sec     = $("#sec").val();
	var sub     = $("#sub").val();
	var trm     = $("#trm").val();
	
		$.ajax({
			url: "<?php echo base_url('cosoco_grd/CosocoGrd/save_upd_validate'); ?>",
			type: "POST",
			data: $("#form").serialize()+ "&classs=" + classs + "&sec=" + sec  + "&sub=" + sub + "&trm=" + trm,
			success: function(data){
				$("#process").hide();
				$.toast({
					heading: 'Success',
					text: 'Grade Save Successfully',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
			}
		});
  });
</script>