<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Exam Wise Student List</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
	  }
	.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  margin: 0px auto;
  z-index:999;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}
</style>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<form id='form'>
		
		<div class='row'>
			<div class="col-md-3 form-group">
				<label id='ct'>Exam Date</label>
				<input type="date" name='exam_date' id='exam_date' class="form-control exam_date" required onchange='subjectt(this.value)'>
			</div>
			<div class='col-md-3 form-group'>
				<label id='fct'>Subject</label>
				<select name='subject' id='subject' class='form-control' required onchange='classs(this.value)'>
					<option value=''>Select</option>
				</select>
			</div>
			<div class='col-md-2 form-group'>
				<label id='fct'>Class</label>
				<select name='classd' id='classd' class='form-control' required onchange='section(this.value)'>
					<option value=''>Select</option>
				</select>
			</div>
			<div class='col-md-2 form-group'>
				<label id='fct'>Section</label>
				<select name='sec' id='sec' class='form-control' required onchange='st_time(this.value)'>
					<option value=''>Select</option>
				</select>
			</div>
			<div class='col-md-2 form-group'>
				<label id='fct'>Start Time</label>
				<select name='strt_time' id='strt_time' class='form-control' required>
					<option value=''>Select</option>
				</select>
			</div>
			<div class="row">
			<center>
				<button class="btn btn-success">Display</button>
			</center>
		</div>
			
		<br />
		</div>
	</form>
	
	
</div><br />
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
	<div class='table-responsive' id='load_page'>
		
	</div>
</div><br />
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header" style='background-image: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);'>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"><CENTER>Change Student Information</CENTER></h4>
		</div>
		<div class="modal-body">
			<input type='hidden' name='adm' id='adm'>
			<input type='hidden' name='stuid' id='stuid'>
			<table class='table table-bordered'>
				<tr>
					<td>Admission No.</td>
					<td><span id='un'></span></td>
				</tr>
				<tr>
					<td>Student Name</td>
					<td><span id='sn'></span></td>
				</tr>
				<tr>
					<td>Roll No.</td>
					<td><input type="text" name="rn" id="rn" class="form-control"></td>
				</tr>
				<tr>
					<td>Contact No.</td>
					<td><input type="text" name="fn" id="fn" class="form-control"></td>
				</tr>
				
				<tr>
					<td>Change Password<span class='req'>*</span></td>
					<td><input type="text" id='c_p' class='form-control' name='con_pass' required></td>
				</tr>
				<tr>
					<td colspan='2'><center><span class='req' id='show'></span></center></td>
				</tr>
			</table>
		</div>
		<div class="modal-footer">
		   <button type="button" onclick='change_pass()' id='sv' class="btn btn-primary">Save</button><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	  
	</div>
</div>
<script>
	
	function subjectt(val){
	  $.post("<?php echo base_url('onlineexam/student_master/Student_details/online_subject'); ?>",{val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#subject").html(fill[0]);
	  });
      }
	
	function classs(val){
	  var exam_date = $('#exam_date').val();
	  $.post("<?php echo base_url('onlineexam/student_master/Student_details/online_class'); ?>",{val:val,exam_date:exam_date},function(data){
		  var fill = $.parseJSON(data);
		  $("#classd").html(fill[0]);
	  });
      }
	
	function section(val){
	  var exam_date = $('#exam_date').val();
	  var subject = $('#subject').val();
	  $.post("<?php echo base_url('onlineexam/student_master/Student_details/online_sec'); ?>",{val:val,exam_date:exam_date,subject:subject},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
	  });
      }
	
	function st_time(val){
	  var exam_date = $('#exam_date').val();
	  var subject = $('#subject').val();
	  var classd =  $('#classd').val();
	  $.post("<?php echo base_url('onlineexam/student_master/Student_details/online_time'); ?>",{val:val,exam_date:exam_date,subject:subject,classd:classd},function(data){
		  var fill = $.parseJSON(data);
		  $("#strt_time").html(fill[0]);
	  });
      }
	
	
	$("#form").on("submit", function (event) {
    event.preventDefault();
	    var exam_date = $('#exam_date').val();
		var subject = $('#subject').val();
		var classd =  $('#classd').val();
		var section = $('#sec').val();
		$.ajax({
			url:"<?php echo base_url('onlineexam/student_master/Student_details/student_data'); ?>",
		    type: "POST",
			data:{exam_date:exam_date,subject:subject,classd:classd,section:section},
			success:function(data)
			{
				$('#load_page').html(data);
            	$('#exam_date').val(exam_date);
				$('#subject').val(subject);
                $('#classd').val(classd);
				$('#sec').val(section);
			}
		});
	});
	
	function recall(val,adm){
		$('#myModal').modal();
		$.ajax({
			url: "<?php echo base_url('onlineexam/student_master/Student_details/active_student'); ?>",
			method: "POST",
			data:{val:val,adm:adm},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success:function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				var user = JSON.parse(data);
				
				$('#myModal').modal();
				$('#adm').val(adm);
				$('#stuid').val(val);
				$('#fn').val(user[0].C_MOBILE);
				$('#sn').text(user[0].FIRST_NM);
				$('#rn').val(user[0].ROLL_NO);
				$('#un').text(user[0].ADM_NO);
				
			},
		});
		
	}
	
	function change_pass(){
		var adm = $('#adm').val();
		var id = $('#stuid').val();
		var rn = $('#rn').val();
		var fn = $('#fn').val();
		var pss = $('#c_p').val();
		if(pss == ''){
			$('#show').text('Please Enter Password');
		}else{
			$('#show').text('');
			$.ajax({
			url: "<?php echo base_url('onlineexam/student_master/Student_details/change_password'); ?>",
			method: "POST",
			data:{adm:adm,id:id,rn:rn,fn:fn,pss:pss},
			beforeSend:function(){
				$('#sv').text('Processing..');
			},
			success:function(data){
				//alert(data);
				if(data == 1){
					$('#sv').text('Changed Successfully');
					//alert('Successfully Change');
					//location.reload();
					window.setTimeout(function() {
						window.location.href = '';
					}, 2000);
				}else{
					$('#sv').text('Save');
					alert('Not Changed');
				}
				
				
			},
		});
			
		}
		
	}
</script>