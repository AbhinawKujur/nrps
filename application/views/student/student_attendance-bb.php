<style type="text/css">
 
</style>
<?php
$date = date('d-M-Y');
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Student <i class="fa fa-angle-right"></i> Student Attendance </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
   <div class="col-sm-3">
    <table class="table">
	    <tr>
		  <th>Date</th>
		  <td><input type='text' value="<?php echo $date; ?>" name='dt' id='dt' class='form-control dt' onchange='dtt()' data-date-end-date="0d" readonly></td>
		</tr>
		
	    <tr>
		  <th>Class</th>
		  <td colspan='3' align='center'>
		    <select class="form-control" onchange="classes(this.value)" name='classs' id="classs">
			  <option value=''>Select</option>
			  <?php
			    if(isset($class_data)){
					foreach($class_data as $data){
						if($data->Class_No == $log_cls_no){
						?>
						  <option value="<?php echo $data->Class_No; ?>"><?php echo $data->CLASS_NM; ?></option>
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
		    <select class="form-control" name="sec" id="sec" onchange="submit()">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<input type="hidden" name="att_type" id="att_type">
		<!--<tr>
		  <td colspan='2' align='center'><button type="button" class='btn btn-success btn-xs' onclick='submit()'>Submit</button></td>
		</tr>-->
	  </table>
   </div>
   
   <div class='col-sm-9'>
    <form id="form"> 
     <div id="load_data" style='height:350px; overflow:auto;'>
	    <h3><center>No Data Found</center></h3>
	 </div>
	</form> 
   </div>
  </div>
  
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  <center>
		<div class="modal-content modal-sm">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Verify Absent Student List</h4>
		  </div>
		  <div class="modal-body">
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-success btn-xs" onclick='att_sv_upd()'>CONFIRM 1</button>
			<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">CLOSE</button>
		  </div>
		</div>
	  </center>	
	  </div>
	</div>
	
	<div id="myModalp" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  <center>
		<!-- this is for period wise attaendance entry -->
		<div class="modal-content modal-sm">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Verify  Absent Student List</h4>
		  </div>
		  <div class="modal-bodyp">
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-success btn-xs" onclick='att_sv_upd_pwa()'>CONFIRM  </button>
			<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">CLOSE</button>
		  </div>
		</div>
	  </center>	
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
  var dt = $('#dt').val();
  $.post("<?php echo base_url('student/Student_attendance/classes'); ?>",{val:val,dt:dt},function(data){
	  var fill = $.parseJSON(data);
	  $("#sec").html(fill[0]);
	  $("#att_type").val(fill[1]);
	  });
  }
  
  function submit(){
	$('body').css('opacity','0.5');
	var classs   = $("#classs").val();  
	var sec      = $("#sec").val();
	var dt       = $("#dt").val();
	var att_type = $("#att_type").val();
    if(classs != '' && sec != ''){	
    $.ajax({
		url : "<?php echo base_url('student/Student_attendance/fetchData'); ?>",
		type: "POST",
		data: {classs:classs,sec:sec,dt:dt,att_type:att_type},
		success: function(data){
			$('body').css('opacity','100');
			$("#load_data").html(data);
		}
	});	
	}else{
		alert('Choose First');
	}
  }
  
  function hd(rad_type,key){
	  if(rad_type == 'HD'){
		$("#key_"+key).show();  
	  }else{
		$("#key_"+key).hide();  
	  }
  }
  
  function att_sv_upd(){
	  $("#dwa_btn").prop('disabled',true);
	  $.ajax({
		  url: "<?php echo base_url('student/Student_attendance/att_sv_upd'); ?>",
		  type: "POST",
		  data: $("#form").serialize(),
		  success: function(data){
			alert('Attendance Succcessfully updated');  
			$("#dwa_btn").prop('disabled',false);
			$("#myModal").modal('hide');
			submit();  
		  }
	  });
  }
  
  function att_sv_upd_pwa(){
	  var period = $("#period").val();
	  if(period != ''){
	  $("#pwa_btn").prop('disabled',true);
	  $.ajax({
		  url: "<?php echo base_url('student/Student_attendance/att_sv_upd_periodwise'); ?>",
		  type: "POST",
		  data: $("#form").serialize(),
		  success: function(data){
			alert('Attendance Succcessfully updated'); 
			$("#myModalp").modal('hide');	
			$("#dwa_btn").prop('disabled',false);
			submit();  
		  }
	  });
	  }else{
		  alert('Choose Period First');
	  }
  }
  
  function cls_period(cls_period){
	var classs = $("#classs").val();  
	var sec    = $("#sec").val();
	var dt     = $("#dt").val();
	$.ajax({
		url: "<?php echo base_url('student/Student_attendance/fetch_period'); ?>",
		type: "POST",
		data: {cls_period:cls_period,classs:classs,sec:sec,dt:dt},
		success: function(data){
			$('body').css('opacity','100');
			$("#load_data").html(data);
		}
	});
  }
  
  function dtt(){
	  $("#classs option[value='']").prop('selected',true);
	  $("#sec option[value='']").prop('selected',true);
	  $("#load_data").html('');
  }
  
  function att_temp_save(){
	  $.ajax({
		  url: "<?php echo base_url('student/Student_attendance/att_temp_save'); ?>",
		  type: "POST",
		  data: $("#form").serialize(),
		  success: function(data){
			$(".modal-body").html(data);
			$("#myModal").modal('show');
		  }
	  });  
  }
  
  function att_temp_save_period(){
	  var period = $("#period").val();
	  if(period != ''){
		  $.ajax({
			  url: "<?php echo base_url('student/Student_attendance/att_temp_save_period'); ?>",
			  type: "POST",
			  data: $("#form").serialize(),
			  success: function(data){
				$(".modal-bodyp").html(data);
				$("#myModalp").modal('show');
			  }
		  }); 
	  }else{
		  alert('Select Period First');
	  }		  
  }
</script>