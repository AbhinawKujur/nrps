<style type="text/css">
 
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">Student</a> <i class="fa fa-angle-right"></i> Daily Wise </li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
	<div class='row'>
	  <div class='col-sm-3'>
	     <table class='table'>
		    <!--<tr>
			  <td colspan='2'>
			   <input type='radio' name='class' value='1' checked onclick='cls(1)'> <b>Class/Sec</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			   <input type='radio' name='class' value='2' onclick='cls(2)'> <b>Class</b>
			  </td>
		    </tr>-->
			<tr>
			  <th>Date</th>
			  <td><input type='text' value="<?php echo $date; ?>" name='dt' id='dt' class='form-control dt' data-date-end-date="0d"></td>
			</tr>

			<!--<tr>
			  <th>Attendance Type</th>
			  <td>
			    <select name='att_type' id='att_type' class='form-control' onchange='att_typee(this.value)'>
				  <option value=''>Select</option>
				  <option value='1'>Day Wise</option>
				  <option value='2'>Period Wise</option>
			    </select>
			  </td>
			</tr>-->
			
			<tr>
			  <th>Class</th>
			  <td>
			    <select name='classs' id='classs' class='form-control' onchange='classes(this.value)'>
				  <option value=''>Select</option>
				  <?php
				  if($ROLE_ID != 4){
				    if(isset($class_data)){
						foreach($class_data as $data){
							if($data->class_code == $log_cls_no){
							  ?>
							  <option value='<?php echo $data->class_code; ?>'><?php echo $data->class_nm; ?></option>
							  <?php	
							}
						}
					}
				  }else{ //for principal
				  if(isset($class_data)){
						foreach($class_data as $data){
							  ?>
							  <option value='<?php echo $data->class_code; ?>'><?php echo $data->class_nm; ?></option>
							  <?php	
						}
					}
				  }
				  ?>
			    </select>
			  </td>
			</tr>
			
			<tr id="sec_id">
			  <th>Section</th>
			  <td>
			    <select name='sec' id='sec' class='form-control' onchange='section(this.value)'>
				  <option value=''>Select</option>
			    </select>
			  </td>
			</tr>
			
			<tr>
			  <th>Report Type</th>
			  <td>
			    <select name='report_type' id='report_type' class='form-control' onchange="rpt_typ(this.value)" disabled>
				  <option value=''>Select</option>
				  <option value='P'>Present</option>
				  <option value='A'>Absent</option>
				  <option value='HD'>Half Day</option>
				  <option value='all'>All</option>
			    </select>
			  </td>
			</tr>
		 </table>
	  </div>
	  <div class='col-sm-9'>
	    <div id='day_report_data' class='table-responsive'></div>
	  </div>
	</div>
</div>
<br /><br />


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose:true });
	
   // $(function () {
    // $('.dataTable').DataTable({
      // 'paging'      : true,
      // 'lengthChange': false,
      // 'searching'   : true,
      // 'ordering'    : false,
      // 'info'        : true,
      // 'autoWidth'   : true,
      // aaSorting: [[0, 'asc']]
    // })
  // });
  
  function cls(val){
	 if(val == 2){
		 $("#sec_id").hide();
		 $("#sec_id").prop('disabled',true);
	 }else{
		 $("#sec_id").show();
		 $("#sec_id").prop('disabled',false);
	 } 
  }
  
  function section(val){
	  if(val != ''){
		$("#report_type").prop('disabled',false);  
	  }else{
		$("#report_type").prop('disabled',true);
	  }
  }
  
  function classes(val){
  $.post("<?php echo base_url('student/report/Report/classes'); ?>",{val:val},function(data){
	  var fill = $.parseJSON(data);
	   $("#sec").html(fill[0]);
	   $("#report_type").html(fill[1]);
	  });
  }
  
  function rpt_typ(val){
	 $('body').css('opacity','0.5'); 
	 var dt       = $("#dt").val();
	 var att_type = $("#att_type").val();
	 var classs   = $("#classs").val();
	 var sec      = $("#sec").val();
	 var rpt_typ  = val;
	 
	 $.ajax({
		 url: "<?php echo base_url('student/report/Report/fetch_daily_wise'); ?>",
		 type: "POST",
		 data: {dt:dt,att_type:att_type,classs:classs,sec:sec,rpt_typ:rpt_typ},
		 success: function(data){
			 $("#day_report_data").html(data);
			 $('body').css('opacity','100');
		 }
	 });
  }
</script>