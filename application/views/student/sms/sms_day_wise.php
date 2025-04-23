<style type="text/css">
 
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url('punching/manualpunch'); ?>">SMS Panel</a> <i class="fa fa-angle-right"></i> SMS Day Wise</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
   <div class="col-sm-3">
   <?php
     if($this->session->flashdata('success')){
		 ?>
		    <div class="alert alert-success">
			  <strong><?php echo $this->session->flashdata('success'); ?></strong>
			</div>
		 <?php
	 }
   ?>
    <table class="table">
	    <tr>
		  <th>Date</th>
		  <td><input type='text' value="<?php echo $date; ?>" name='dt' id='dt' class='form-control dt' onchange='dtt()' data-date-end-date=""></td>
		</tr>
		
	    <tr>
		  <th>Class</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" onchange="classes(this.value)" name='classs' id="classs">
			  <option value=''>Select</option>
			  <?php
			    if(isset($class_data)){
					foreach($class_data as $data){
						if($log_cls_no == $data->class_code){
						?>
						  <option value="<?php echo $data->class_code; ?>"><?php echo $data->class_nm; ?></option>
						<?php
						}
					}
				}
			  ?>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Sec</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" name="sec" id="sec" onchange='secc()'>
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr style='display:none;' id='period_row'>
		  <th>period</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" name="period" id="period">
			  <option value=''>Select</option>
			  <option value='1'>1</option>
			  <option value='2'>2</option>
			  <option value='3'>3</option>
			  <option value='4'>4</option>
			  <option value='5'>5</option>
			  <option value='6'>6</option>
			  <option value='7'>7</option>
			  <option value='8'>8</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Attendance Status</th>
		  <td>
		    <select class='form-control' id='att_sta' onchange="submit()">
			  <option value=''>Select</option>
			  <option value='P'>Present</option>
			  <option value='A'>Absent</option>
			  <option value='HD'>Half Day</option>
		    </select>
		  </td>
		</tr>
		
		<tr>
		  <td colspan='2' align='center'><button type='submit' form='formm' class='btn btn-success btn-xs' id='sms_send_btn'disabled>SEND SMS</button></td>
		</tr>
		
		<input type="hidden" name="att_type" id="att_type">
	  </table>
   </div>
   
   <div class='col-sm-9'>
    <form id="formm" action="<?php echo base_url('student/sms/Sms/sendsms'); ?>" method='POST'> 
	<input type='hidden' name='dtt' id='dtt'>
	<input type='hidden' name='att_stas' id='att_stas'>
     <div id="load_data" style='height:350px; overflow:auto;'> 
	    <h3><center>No Data Found</center></h3>
	 </div>
	</form> 
   </div>
  </div>
</div>
<br /><br />


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true });
	
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  
  function classes(val){
  $("#sms_send_btn").prop('disabled',true);
  var dt = $('#dt').val();
  $("#dtt").val(dt);
  $.post("<?php echo base_url('student/sms/Sms/classes'); ?>",{val:val,dt:dt},function(data){
	  var fill = $.parseJSON(data);
	  $("#sec").html(fill[0]);
	  $("#att_type").val(fill[1]);
	  });
  }
  
  function secc(){
	  var att_type = $("#att_type").val();
	  if(att_type == 2){
		$("#period_row").show();
		var att_sta = "<option value=''>Select</option><option value='P'>Present</option><option value='A'>Absent</option>";
		$("#att_sta").html(att_sta);
	  }else{
		$("#period_row").hide();
        var att_sta = "<option value=''>Select</option><option value='P'>Present</option><option value='A'>Absent</option><option value='HD'>Half Day</option>";
		$("#att_sta").html(att_sta);		
	  }
  }
  
  function dtt(){
	  $("#classs option[value='']").prop('selected',true);
	  $("#sec option[value='']").prop('selected',true);
	  $("#load_data").html('');
  }
  
  function submit(){
	  $('body').css('opacity','0.5');
	  var dt       = $("#dt").val();
	  var classs   = $("#classs").val();
	  var sec      = $("#sec").val();
	  var att_sta  = $("#att_sta").val();
	  $("#att_stas").val(att_sta);
	  var att_type = $("#att_type").val();
	  var period   = $("#period").val();
	  $.post("<?php echo base_url('student/sms/Sms/sms_fetchdata'); ?>",{dt:dt,classs:classs,sec:sec,att_sta:att_sta,att_type:att_type,period:period},function(data){
		  $("#load_data").html(data);
		  $('body').css('opacity','100');
		  $("#sms_send_btn").prop('disabled',false);
	  });
  }
</script>