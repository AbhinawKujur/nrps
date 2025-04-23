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
    <li class="breadcrumb-item"><a href="index.html">Report Card Student List</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class="row">
	<div class='col-sm-3'>
	<form id="stu_form" method="post" autocomplete='off'>
	 <table class="table" style='margin-top:-40px;'>
	    <tr>
		  <th>Class</th>
		  <td>
		    <select class="form-control" onchange="classes(this.value)" name='classs' id="classs" required>
			  <option value=''>Select</option>
			  <option value='1'>NURSERY</option>
		    </select>
		  </td>
	    </tr>
		
	    <tr>
		  <th>Sec</th>
		  <td>
		    <select class="form-control" name="sec" id="sec" required>
			  <option value=''>Select</option>
		    </select>
		  </td>
		</tr>
		<tr>
		  <td colspan='11'><br /></td>
		</tr>
	    <br />
	    <br />
		<br />
		
		<tr>
		  <td colspan='11' align='center'><button type="submit" class='btn btn-sm btn btn-success buttonload'>
		  <i class="fa fa-circle-o-notch fa-spin" style='color:#fff; display:none' id='btnload'></i>
		  SUBMIT</button></td>
		</tr>
	  </table>
	  </form>
	</div>
	
	<div class='col-sm-9' style="overflow-y:auto;">
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
			<input type='radio' name='r_card' value='2'> Generate Tabulation Sheet
			<br />
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
  $.post("<?php echo base_url('report_card_nur/Report_card_nur/getSec'); ?>",{val:val},function(data){
	  var fill = $.parseJSON(data);
	  $("#sec").html(fill[0]);
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
		url: "<?php echo base_url('report_card_nur/Report_card_nur/make_report_card'); ?>",
		type: "POST",
		data: $("#stu_form").serialize(),
		success: function(data){
			$("#btnload").hide();
			$("#load_data").html(data);
		    }
	    });  
	  }else if(radioValue == 2){
		alert('tabulation sheet');
	  }
 }
</script>