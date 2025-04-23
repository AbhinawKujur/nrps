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
    <li class="breadcrumb-item"><a href="#">Marks Entry</a> <i class="fa fa-angle-right"></i></li>
	<li class="breadcrumb-item"><a href="#">NUR</a> <i class="fa fa-angle-right"></i></li>
	<li class="breadcrumb-item"><a href="#">Term <?php echo $trm; ?></a> <i class="fa fa-angle-right"></i></li>
</ol>

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
						?>
						  <option value="<?php echo $data['Class_no']; ?>"><?php echo $data['classnm']; ?></option>
						<?php
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
 
<!-- modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Verify Grade</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="confirm()">Confirm</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick='cls()'>Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal --> 
	
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
	  $.post("<?php echo base_url('marksentry/Marksentry_nur/classess'); ?>",{val:val},function(data){
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
		url: "<?php echo base_url('marksentry/Marksentry_nur/getSubject'); ?>",
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
	 
	  $.post("<?php echo base_url('marksentry/Marksentry_nur/stu_list'); ?>",{sortval:sortval,sub:sub,Class_No:Class_No,sec:sec,exm_code:exm_code,trm:trm},function(data){
		  $("#loading2").hide();
		  $("#stu_list").html(data);
	  });
  }
  
  $("#form").on("submit", function (event) {	
    event.preventDefault();
	var classs  = $("#classs").val();
	var sec     = $("#sec").val();
	var exm_typ = $("#exm_typ").val();
	var sub     = $("#sub").val();
	var sortby  = $("#sortby").val();
	
	$("#process").show();
		$.ajax({
			url: "<?php echo base_url('marksentry/Marksentry_nur/save_nd_upd_prep'); ?>",
			type: "POST",
			data: $("#form").serialize()+ "&classs=" + classs + "&sec=" + sec + "&exm_typ=" + exm_typ + "&sub=" + sub + "&sortby=" + sortby,
			success: function(data){
				$("#process").hide();
				$(".modal-body").html(data);
				$("#myModal").modal('show');
			}
		});
	 });
  
  function confirm(){
		 var class_code = $("#class_code").val();
		 var sec_code   = $("#sec_code").val();
		 var exam_code  = $("#exam_code").val();
		 var sub        = $("#sub").val();
		 var trm        = $("#trm").val();
		 var sortby     = $("#sortby").val();
		 
		 $.ajax({
			 url: "<?php echo base_url('marksentry/Marksentry_nur/confirm'); ?>",
			 type: "POST",
			 data: {class_code:class_code,sec_code:sec_code,exam_code:exam_code,sub:sub,trm:trm,sortby:sortby},
			 success: function(data){
				 $.toast({
					heading: 'Success',
					text: 'Saved Successfully',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
				$("#myModal").modal('hide');
				sorybyview(sortby);
			 }
		 });
	 }
	 
	 function skillUpd(skill,id){
		 $.ajax({
			 url: "<?php echo base_url('marksentry/Marksentry_nur/skill_upd'); ?>",
			 type: "POST",
			 data: {skill:skill,id:id},
			 success: function(data){
				 $.toast({
					heading: 'Success',
					text: 'Saved Successfully',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
			 }
		 });
	 }
	 
	 function cls(){
		 var sortby = $("#sortby").val();
		 sorybyview(sortby);
	 }
</script>
