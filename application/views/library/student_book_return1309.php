<style>
label{
	font-size:12px;
	font-weight: bold !important;
}
table{
	padding-right:20px;
}
button.dt-button, div.dt-button, a.dt-button {
	line-height:0.66em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
.table > thead > tr > th,
.table > tbody > tr > th,
.table > tfoot > tr > th,
.table > thead > tr > td,
.table > tbody > tr > td,
.table > tfoot > tr > td {
    white-space: nowrap !important;
 }
 

</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Book Return</a> <i class="fa fa-angle-right"></i></li>
</ol>
<div id="refresh">
<form action="<?php echo base_url('library/StudentBookReturn'); ?>" method="post" autocomplete="off" id="myForm">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">

		 <div class="row">
		<div class='col-sm-6'>
		<div class="card-body">
			<div class="form-group" >
				<label style="font-size:15px">Book Details</label>
			  </div>
			 
			 <div class="row" id="here">
			    <div class="col-sm-6">
				  <div class="form-group">
				  	<input type="hidden" id='accnn'>
					<label>Accession NO.:</label>
					<select class='form-control' id='accno' name='accno' onchange='acce_no(this.value)' required>
					<option value=''>Select</option>
					<?php
						foreach($issuedbok as $key => $val){
							?>
								<option value='<?php echo $val['BookID']; ?>'><?php echo $val['BookID']; ?></option>
							<?php
						}
					?>
				</select>
				  </div>
				</div>
				<input type="hidden" class="form-control" name="id" id="ids" >
				<input type="hidden" class="form-control" name="reisucount" id="reisucount" >
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Admission No.:</label>
					<input type="text" class="form-control" id="Admno" name="Admno" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>				
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Student Name:</label>
					<input type="text" class="form-control" name="stuname" id="stuname" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Father Name:</label>
					<input type="text" class="form-control" id="father" name="author_name" readonly="">
				  </div>
				</div>				
			  </div>
			  <div class="row">			    
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Class:</label>
					<input type="text" class="form-control" name="class" id="class" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Book Name:</label>
					<input type="text" class="form-control" name="bname" id="bname" style="text-transform: uppercase;" readonly="">					
				  </div>
				</div>
				</div>
				
				<div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Due Date:</label>
					<input type="text" class="form-control" name="duedate" id="duedate" style="text-transform: uppercase;" readonly="">					
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Return Date:</label>
					<input type="text" class="form-control" name="rdate" id="rdate" value="<?=date('d-M-Y')?>" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				</div>
				
				<div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Total Late Days:</label>
					<input type="text" class="form-control" name="lateday" id="lateday" style="text-transform: uppercase;" readonly>
					
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Fine Applicable:</label>
					<input type="text" class="form-control" name="fineamt" id="fineamt" style="text-transform: uppercase;" >
				  </div>
				</div>
				</div>
				<div class="row">			    
				<div class="col-sm-6" style="text-align:center">
				  <div class="form-group">
					<button type="button" onclick="returned()" id="retrn" disabled class="btn btn-danger">Return</button>
				  </div>
				</div>
				<div class="col-sm-6" style="text-align:center">
				  <div class="form-group">
					<button type="button" onclick="reisu()" id="reisud" disabled class="btn btn-success">Re-Issue</button>
				  </div>
				</div>
				</div>				
			  </div>
			  </div>
<!---------------------------**********************-------------------------->			  
		<div class='col-sm-6' style="border-left: 2px solid #b1acac;border-right: 2px solid #b1acac;">
			<div class="card-body">
			<div class="row">
				<div class='col-sm-12'>
					<div class='table-responsive'>
						<table class='table' id='example'style="font-size: 12px;">
						<thead>
							<tr>
								<th style='background:#337ab7; color:#fff !important;border:1px solid'>Book Name</th>
								<th style='background:#337ab7; color:#fff !important;border:1px solid'>Book<br> CODE</th>
								<th style='background:#337ab7; color:#fff !important;border:1px solid'>Adm<br> No.</th>
								<th style='background:#337ab7; color:#fff !important;border:1px solid'>Issued<br>date</th>
								<th style='background:#337ab7; color:#fff !important;border:1px solid'>Due<br>Date</th>
								<th style='background:#337ab7; color:#fff !important;border:1px solid'>Name</th>
								
							</tr>
						</thead>	
						<tbody>	
							<?php
	$id=1;
								foreach($issuedbok as $key => $val){
									?>
										<tr id="a<?php echo $id;?>" onclick="acce_no('<?php echo $val['BookID']; ?>','a<?php echo $id;?>')" class='al' style="cursor:pointer">
											<td style='border:1px solid #dddddd;'><?php echo $val['BName']; ?></td>
											<td style='border:1px solid #dddddd;'><?php echo $val['BookID']; ?></td>
											<td style='border:1px solid #dddddd;'><?php echo $val['Admno']; ?></td>
											<td style='border:1px solid #dddddd;'><?php echo $val['IDate']; ?></td>
											<td style='border:1px solid #dddddd;'><?php echo $val['Due_date']; ?></td>
											<td style='border:1px solid #dddddd;'>
														<td>
															<?php
															$studentNames = array(
																$val['stu_nm1'],
																$val['stu_nm2'],
																$val['stu_nm3'],
																$val['stu_nm4']
															);

															foreach ($studentNames as $studentName) {
																if (!empty($studentName)) {
																	echo $studentName;
																	break; // Stop the loop after the first non-empty name is found.
																}
															}
															?>
														</td>
														</td>
										</tr>
									<?php
									$id++;
								}
							?>
						</tbody>	
						</table>
					</div>
				</div>
			</div>		
				
				<div class="row" style="border-bottom: 2px solid #b1acac;" id="det">	
				
				</div>
					
			</div>	
			</div>
</div>
</form>	
</div>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style='display:none' id='loading'>Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" and data-keyboard="false">
  <div >

    <!-- Modal content-->
    <div >
    
      <div class="modal-body">
	  <br/>
	  <br/>
	  <br/>
	  <br/>
	  <br/>
     <center style="color:white"><h3>Please Wait...</h3></center>
      </div>
    
    </div>

  </div>
</div>

<br />

<script>
$(".alert").fadeOut(3000);	
$('#adm_no').select2();
$('#accno').select2();
$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Book Issued Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Book Issued Reports',
                
            },
        ]
    });
	
//**********************Re-Isuued*****************************************
	function reisu(){
	var accno 			= $('#accnn').val();
		var duedate 		= $('#duedate').val();
		var ids 			= $('#ids').val();
		var reisucount 		= $('#reisucount').val();
		var Admno 	= $('#Admno').val();
		Admno = Admno.replace("/", "-");
		if(reisucount==2){
			$.toast({
				heading: 'Alert!',
				text: 'Only Two Times Re-Issue Is Allowed',
				showHideTransition: 'slide',
				icon: 'alert',
				position: 'top-right',
			});
		}else{

var cnf		= confirm('Are You Sure');
		

		if(cnf==true){	
			if(duedate!="" && ids!=""){
				$.post("<?php echo base_url('library/StudentBookReturn/bookreisu'); ?>",{duedate:duedate,ids:ids},function(data){
						//location.reload(true);	
var latfine=$("#lateday").val();
	var pr = false;
		if(latfine !=0 ){
			
			 pr=confirm('Do you want to print your late fine Receipt ?');
		}
		if(pr==true){
			$("#loading").click();
		window.location="<?php echo base_url('library/StudentBookReturn/print_receipt/"+Admno+"/"+accno+"/"+ids+"'); ?>";
		}						
						$.toast({
							heading: 'Success',
							text: 'Book Reissued Successfully',
							showHideTransition: 'slide',
							icon: 'success',
							position: 'top-right',
						});
							
						//acce_no(accno);										
				});
			}
		
		}
		}
	}

//**********************Return*****************************************
	function returned(){
	var ids = $('#ids').val();

			var accno 			= $('#accno').val();
		var Admno 	= $('#Admno').val();
		Admno = Admno.replace("/", "-");
		
		var cnf		= confirm('Are You Sure');
		if(cnf==true){	
		var duedate 		= $('#duedate').val();
			var rdate	 		= $('#rdate').val();
			
			var fineamt 		= $('#fineamt').val();			 		
	 		if(duedate!="" && ids!=""){
				$.post("<?php echo base_url('library/StudentBookReturn/bookreturn'); ?>",{'duedate':duedate,'ids':ids,'rdate':rdate,'accno':accno,'fineamt':fineamt},function(data){		

	var latfine=$("#lateday").val();
	var pr = false;
		if(latfine !=0 ){
			
			 pr=confirm('Do you want to print your late fine Receipt ?');
		}
		if(pr==true){
			$("#loading").click();
		window.location="<?php echo base_url('library/StudentBookReturn/print_receipt/"+Admno+"/"+accno+"/"+ids+"'); ?>";
		}
		
				$.toast({
							heading: 'success',
							text: 'Book Return Successfully',
							showHideTransition: 'slide',
							icon: 'success',
							position: 'top-right',
						});
						$('#retrn').prop('disabled',true);
						$('#reisud').prop('disabled',true);	
						//$("#myForm").trigger("reset");
						//$("#accno").select2("val", "");
						//location.reload(true);
						$("#refresh").load(" #refresh");								
				});
			} 	
		}
 
	}
		function acce_no(acce_no,accno_id){	
	
		$('#accnn').val(acce_no);
		var accno = $('#accnn').val();
		
		$('.al').css("background-color",'white');
		$('#'+accno_id).css("background-color",'#00e6ac');
			
		var accno = $('#accno').val();
			
		var rdate = $('#rdate').val();
			
		$.post("<?php echo base_url('library/StudentBookReturn/bookDetails'); ?>",{acce_no:acce_no},
		
		function(data){			
			$fillData1 = $.parseJSON(data);
			if($fillData1[9]==""){
				alert('No Record Found');
				$('#retrn').prop('disabled',true);
			}else{
				$('#retrn').prop('disabled',false);						
				$("#stuname").val($fillData1[0]);
				$("#father").val($fillData1[1]);
				$("#class").val($fillData1[2]);
				$("#bname").val($fillData1[3]);
				$("#duedate").val($fillData1[4]);
				$("#bookid").val($fillData1[5]);
				$("#lateday").val($fillData1[6]);
				$("#fineamt").val($fillData1[7]);
				$("#Admno").val($fillData1[8]);
				$("#ids").val($fillData1[9]);
				$("#det").html($fillData1[10]);
				$("#reisucount").val($fillData1[11]);
				if($fillData1[7]>0){
					$('#reisud').prop('disabled',true);
				}else{
					$('#reisud').prop('disabled',false);
				}
			}
			
		});
	}

</script>
