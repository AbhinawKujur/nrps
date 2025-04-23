<style type="text/css">
 .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
	 color: #000;
	 white-space: nowrap !important;
 }
 .thead-color
  {
    background: #337ab7 !important;
    color: white !important;
  }
</style>
<?php $date = date('d-M-Y'); ?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Academics</a> <i class="fa fa-angle-right"></i> Assign Class Teacher </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 15px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
   <div class="col-sm-5">
   <?php echo form_open('#',array('id'=>'form')); ?>
    <table class='table'>
	  <tr>
	    <th>Teacher</th>
		<td>
		  <select class='form-control select2' name='teacher' id='teacher' required="" onchange="getSubjectPreferencesData()">
		    <option value=''>Select</option>
			<?php
			  foreach($teacher_data as $data){
				  ?>
				   <option value='<?php echo $data->EMPID; ?>'><?php echo $data->EMP_FNAME ." ". $data->EMP_MNAME ." ". $data->EMP_LNAME?></option>
				  <?php
			  }
			?>
		  </select>
		</td>
	  </tr>
	  <tr>
	    <th>Class Teacher</th>
		<td>
		  <input type='radio' name='class_teacher' value='Y' onclick='cls_tchr(this.value)'> Yes
           &nbsp;&nbsp;		  
		  <input type='radio' name='class_teacher' value='N' checked onclick='cls_tchr(this.value)'> No
		</td>
	  </tr>
	  <tr class="subjectlist">
	  	<th>Subjects</th>
	  	<td>
	  		<select class='form-control select2' name="subjects[]" id="subjects" required multiple="">
			<?php
			  foreach($subjectList as $key => $value){
				  ?>
				   <option value='<?php echo $value['SubCode']; ?>'><?php echo $value['SubName']; ?></option>
				  <?php
			  }
			?>
		  </select>
	  	</td>
	  </tr>
	  <tr class='class_sec' style="display:none;">
	    <th>Class</th>
		<td>
		  <select class='form-control' name='classs' id="classs" onchange='cls()' required disabled>
		    <option value=''>Select</option>
			<?php
			  foreach($class_data as $data){
				  ?>
				   <option value='<?php echo $data->Class_No; ?>'><?php echo $data->CLASS_NM; ?></option>
				  <?php
			  }
			?>
		  </select>
		</td>
	  </tr>
	  <tr class='class_sec' style="display:none;">
	    <th>Sec</th>
		<td>
		  <select class='form-control' name='sec' id='sec' required disabled>
		    <option value=''>Select</option>
		  </select>
		</td>
	  </tr>
	  <tr>
	    <td colspan='2' align='center'><button type='button' class='btn btn-success' onclick='assign_class_teacher_save()'>SAVE</button></td>
	  </tr>
    </table>
	<?php echo form_close(); ?>
   </div>
   
   <div class='col-sm-7'>
     <div id="load_data" style='height:350px; overflow:auto;'>
	    
	 </div>
   </div>
  </div>
</div>
<br /><br />


<!-- /.modal -->
<div class="loader"></div>
<script type="text/javascript">
	
$( document ).ajaxComplete(function() {
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
});
   
  
  function cls(){
	  var classs = $("#classs").val();
	  $.post("<?php echo base_url('teacher/Assign_class_teacher/section'); ?>",{classs:classs},function(data){
		  $("#sec").html(data);
	  });
  }
  
  function cls_tchr(val){
	 if(val == 'Y'){
		 $(".class_sec").show();
		 $("#classs").prop('disabled',false);
		 $("#sec").prop('disabled',false);
		 $('.subjectlist').hide();
	 }else{
		 $(".class_sec").hide();
		 $("#classs").prop('disabled',true);
		 $("#sec").prop('disabled',true);
		 $('.subjectlist').show();
	 }
  }

  $(document).ready(function () {
    $('#form').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
  
  function assign_class_teacher_save(){
	  $('#form').validate();
	  if($('#form').valid())
	  {
		  var emp_id     = $("#teacher").val();
		  var class_teac = $("input[name='class_teacher']:checked").val();
		  var class_id   = $("#classs").val();
		  var sec_id     = $("#sec").val();
		  if(class_teac == 'N')
		  {	
		  	var subjects = $("#subjects").val();
		  }
		  else
		  {
		  	var subjects = '';
		  }
		  $.post("<?php echo base_url('teacher/Assign_class_teacher/save_assign_class_teacher'); ?>",{emp_id:emp_id,class_teac:class_teac,class_id:class_id,sec_id:sec_id,subjects:subjects},function(data){
			  alert(data);
			  if(class_teac=='Y')
			  {
			  	$('#classs').val('');
			  	$('#sec').val('');
			  }
			  else
			  {
			  	$('#form')[0].reset();
			  }
			  $(".select2").val('').trigger('change');
		  });
	  }
  }

  $('.select2').select2();

  $('.teacher').select2();

  function getSubjectPreferencesData()
  {
  	$('#load_data').show();
  	var teacher_id = $('#teacher').val();
  	var class_teacher = $('input[name="class_teacher"]:checked').val();
  	if(teacher_id !='' && class_teacher == 'N')
  	{
  		$.ajax({
  			url:'<?php echo base_url('teacher/assign_class_teacher/getSubjectPreferencesData'); ?>',
  			method:'POST',
  			data:{teacher_id:teacher_id},
  			success:function(response)
  			{
  				$('#load_data').html(response);
  			}
  		});
  	}
  	else
  	{
  		$('#load_data').hide();
  	}
  }

</script>