<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Parents Login Credential</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    font-size: 0.9em;
    color: #080808;
    border-top: none !important;
    padding-top: 5px !important;
}
  body{
   font-family: Verdana,Geneva,sans-serif; 
  }
  .box.box-primary {
    border-top-color: #faa21c;
    box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24);
}
.box-header.with-border {
    border-bottom: 4px solid #f4f4f4;
	background-color: #a7a7a7;
}
.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
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

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
	<div class="row">
		<div class="col-md-12">
			<?php
			   if($this->session->flashdata('msg')){
				?>
				<div class="alert alert-success" role="alert" id="msg" style="padding: 6px 0px;">
					<center><strong><?php echo $this->session->flashdata('msg'); ?></strong></center>
				</div>
				<?php
			   }
			?>
		</div>
	</div>
<div class="loader" style="display:none;"></div>
	<div class="row">
		<div class='col-md-12 col-sm-12 col-lg-12'>
			<div class="box box-primary">
				<div class='box-header with-border'>
					<h3 class='box-title'><i class='fa fa-search'></i>Search Criteria</h3>
				</div>
				<div class='box-body'>
					<div class='row'>
						<form id='form'>
						<div class='col-md-6 col-sm-6 col-lg-6'>
							<div class='form-group'>
								<label>Class<span class='req'>*</span></label>
								<select name='class' class='form-control' onchange="selectsec(this.value)" id='class' required>
									<option value=''>Select</option>
									<?php
										foreach($class as $key=>$value){
											?>
											<option value='<?php echo $value->Class_No; ?>'><?php echo $value->CLASS_NM; ?></option>
											<?php
										}
									?>
								</select>
							</div>
						</div>
						<div class='col-md-6 col-sm-6 col-lg-6'>
							<div class='form-group'>
								<label>Sec<span class='req'>*</span></label>
								<select name='sec' class='form-control' id='sec' required>
								</select>
							</div>
						</div>
						<div class='col-sm-12 col-md-12 col-lg-12'>
							<div class="form-group">
								<center><button class='btn btn-success'>Submit</button></center>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div></br></br>
	<div class='row'>
		<div class="col-md-12 col-lg-12 col-sm-12">
			<div id='load_data' class="table-responsive">
				<table class="table table-bordered" id="example">
					<thead>
					  <tr>
						<th>Sl no.</th>
						<th>Student Id</th>
						<th>Admission No</th>
						<th>Student Name</th>
						<th>Class</th>
						<th>Sec</th>
						<th>Father Name</th>
						<th>Mother Name</th>
						<th>Password</th>
						<th>Action</th>
					  </tr>
					</thead>
					<tbody>
					 <?php
						if($student){
							$i = 1;
							foreach($student as $student_data){
								?>
								  <tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $student_data->STUDENTID; ?></td>
									<td><?php echo $student_data->ADM_NO; ?></td>
									<td><?php echo $student_data->FIRST_NM; ?></td>
									<td><?php echo $student_data->DISP_CLASS; ?></td>
									<td><?php echo $student_data->DISP_SEC; ?></td>
									<td><?php echo $student_data->FATHER_NM; ?></td>
									<td><?php echo $student_data->MOTHER_NM; ?></td>
									<td><?php echo $student_data->Parent_password; ?></td>
									<td><i title="Change Password" style='cursor: pointer; color:black;' onclick="recall('<?php echo $student_data->STUDENTID; ?>','<?php echo $student_data->ADM_NO; ?>')" class="fa fa-bars" aria-hidden="true"></i></td>
								  </tr>
								<?php
								$i++;
							}
						}
					  ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
  <div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
	
	  <!-- Modal content-->
	  <div class="modal-content">
		<div class="modal-header" style='background-image: linear-gradient(141deg, #9fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);'>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"><CENTER>Change Password</CENTER></h4>
		</div>
		<div class="modal-body">
			<input type='hidden' name='adm' id='adm'>
			<input type='hidden' name='stuid' id='stuid'>
			<table class='table table-bordered'>
				<tr>
					<td>Student Name</td>
					<td><span id='sn'></span></td>
				</tr>
				<tr>
					<td>Father Name</td>
					<td><span id='fn'></span></td>
				</tr>
				<tr>
					<td>User Name</td>
					<td><span id='un'></span></td>
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
		function selectsec(val){
		$.ajax({
			url: "<?php echo base_url('Student_report/find_sec'); ?>",
			type: "POST",
			data: {val:val},
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#sec").html(data);
			},
		});
	}
	function recall(val,adm){
		$('#myModal').modal();
		$.ajax({
			url: "<?php echo base_url('Parentslogincredential/active_student'); ?>",
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
				$('#sn').text(user[0].FIRST_NM);
				$('#fn').text(user[0].FATHER_NM);
				$('#un').text(user[0].ADM_NO);
				
			},
		});
		
	}
	function change_pass(){
		var adm = $('#adm').val();
		var id = $('#stuid').val();
		var pss = $('#c_p').val();
		if(pss == ''){
			$('#show').text('Please Enter Password');
		}else{
			$('#show').text('');
			$.ajax({
			url: "<?php echo base_url('Parentslogincredential/change_password'); ?>",
			method: "POST",
			data:{adm:adm,id:id,pss:pss},
			beforeSend:function(){
				$('#sv').text('Processing..');
			},
			success:function(data){
				//alert(data);
				if(data == 1){
					$('#sv').text('Password Changed Successfully');
					//alert('Successfully Change');
					//location.reload();
					window.setTimeout(function() {
						window.location.href = '';
					}, 2000);
				}else{
					$('#sv').text('Save');
					alert('Password Not Changed');
				}
				
				
			},
		});
			
		}
		
	}
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block"></div>

   <script type="text/javascript">
   $("#form").on("submit", function (event) {
	event.preventDefault();
		$.ajax({
			url: "<?php echo base_url('Parentslogincredential/getdata'); ?>",
			type: "POST",
			data: $('#form').serialize(),
			beforeSend:function(){
				$('.loader').show();
				$('body').css('opacity', '0.5');
			},
			success: function(data){
				$('.loader').hide();
				$('body').css('opacity', '1.0');
				$("#load_data").html(data);
			},
		});
	});
   	$("#msg").fadeOut(8000);
    $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			// {
                // extend: 'copyHtml5',
				// title: 'Student Details',
                // exportOptions: {
                    // columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                // }
            // },
			{
                extend: 'excelHtml5',
				title: 'Parents Login Credential Details',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 , 6, 7, 8]
                }
            },
			// {
                // extend: 'csvHtml5',
				// title: 'Student Details',
                // exportOptions: {
                    // columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
                // }
            // },
			// {
                // extend: 'pdfHtml5',
				// title: 'Student Details',
                // exportOptions: {
                    // columns: [ 0, 1, 2, 3, 4, 5 , 6, 7]
                // }
            // },
        ]
    });
 });

    </script>
