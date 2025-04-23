<style>
  table tr td,th{
	  color:#000 !important;
	  padding-right:0px !important;
  }
  .table > thead > tr > th,
  .table > tbody > tr > th,
  .table > tfoot > tr > th,
  .table > thead > tr > td,
  .table > tbody > tr > td,
  .table > tfoot > tr > td {
    white-space: nowrap !important;
	font-size:12px;
	padding:2px !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Annual Report Card</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class="row">
	<div class='col-sm-12'>
	<form id="stu_form" method="post" autocomplete='off'>
	 <table class="table" style='margin-top:-40px;'>
	    <tr>
		  <th>Class</th>
		  <td>
		    <select class="form-control" onchange="classes(this.value)" name='classs' id="classs" required>
			  <option value=''>Select</option>
			  <?php
			    if(isset($class_data)){
					foreach($class_data as $data){
						?>
						  <option value="<?php echo $data->Class_No; ?>"><?php echo $data->CLASS_NM; ?></option>
						<?php
					}
				}
			  ?>
		    </select>
		  </td>
	    
		  <th>Sec</th>
		  <td>
		    <select class="form-control" name="sec" id="sec" onchange="secc(this.value)" required>
			  <option value=''>Select</option>
		    </select>
		  </td>
		  
		  <!--
		  <th>Date</th>
		  <td>
		    <input type='text' name='date' id="date" class="form-control datepicker" data-date-end-date='0d'>
		  </td>
		 -->
		  <th>Round Off</th>
		  <td><input type="radio" name="round" value='1'></td>
		  
		  <th>No Round Off</th>
		  <td><input type="radio" name="round" value='2' checked></td>
		</tr>
		<tr>
		  <td colspan='11'><br /></td>
		</tr>
		<input type="hidden" name="class_code" id="class_code"><br />
		<input type="hidden" name="pt_type" id="pt_type"><br />
		<input type="hidden" name="exam_type" id="exam_type"><br />
		
		<tr>
		  <td colspan='11' align='center'><button type="submit" class='btn btn-success buttonload'>
		  <i class="fa fa-circle-o-notch fa-spin" style='color:#fff; display:none' id='btnload'></i>
		  SUBMIT</button></td>
		</tr>
	  </table>
	  </form>
	</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-12' style="overflow-y:auto;">
		   <div id='load_data'></div>
		</div>
	</div>
	
	<!-- modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog modal-sm">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Choose Any One</h4>
		  </div>
		  <div class="modal-body">
			<input type='radio' name='r_card' value='1' checked> Generate Report Card<br />
			<input type='radio' name='r_card' value='2'> Generate Tabulation Sheet<br />
			<!--<input type='radio' name='r_card' value='3'> Generate Proclamation Sheet<br />-->
			<input type='radio' name='r_card' value='4'> Internal report for CBSE<br />
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-success btn-sm" data-dismiss="modal" onclick='generate()'>Select</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- end modal -->
	
</div><br />

<div class="clearfix"></div>
<!-- script-for sticky-nav -->
<script>
$('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
      todayHighlight: true,
});

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
function classes(val){
  $.post("<?php echo base_url('report_card/Annual_report_card/classess_report_card'); ?>",{val:val},function(data){
	  var fill = $.parseJSON(data);
	  $("#sec").html(fill[0]);
	  $("#class_code").val(fill[1]);
	  $("#pt_type").val(fill[2]);
	  $("#exam_type").val(fill[3]);
  });
}

$("#stu_form").on("submit", function (event) {
    event.preventDefault();
	$("#myModal").modal('show');
 });
 
 function generate(){
	  $("#btnload").show();
	  $("#load_data").html('');
	  var radioValue = $("input[name='r_card']:checked").val();
	  if(radioValue == 1){
		$.ajax({
		url: "<?php echo base_url('report_card/Annual_report_card/make_report_card'); ?>",
		type: "POST",
		data: $("#stu_form").serialize(),
		success: function(data){
			$("#btnload").hide();
			$("#load_data").html(data);
		    }
	    });  
	  }else if(radioValue == 2){
		  $.ajax({
		  url: "<?php echo base_url('report_card/Annual_tabulation_report_card'); ?>",
		  type: "POST",
		  data: $("#stu_form").serialize(),
		  success: function(data){
			    $("#btnload").hide();
				$("#load_data").html(data);
				}
		  });  
	  }else if(radioValue == 4){
		  $.ajax({
		  url: "<?php echo base_url('report_card/InternalReportForCbse'); ?>",
		  type: "POST",
		  data: $("#stu_form").serialize(),
		  success: function(data){
			    $("#btnload").hide();
				$("#load_data").html(data);
				}
		  });
	  }
 }
</script>