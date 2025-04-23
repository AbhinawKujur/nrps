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
    <li class="breadcrumb-item"><a href="#">Student Book Issue</a> <i class="fa fa-angle-right"></i></li>
</ol>
<form action="<?php echo base_url('library/StudentBookIssue/IsuueBook'); ?>" method="post" autocomplete="off">
<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row' style="margin-right: 0px;">
<div class="row">
	
		<div class='col-sm-6'>
		    <?php
			  if($this->session->flashdata('success')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('success'); ?>
					</div>
				  <?php
			  }
			?>
			
			
			<div class="card-body">
			<div class="form-group">
				<label style="font-size:15px">Student Details</label>
			  </div>
				<label>  SEARCH BY : </label>
										<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Adm. No. <input type="checkbox" id="adm_no" onchange="searchchange('1')"></label> &nbsp;&nbsp;&nbsp;
									<label>Student Name <input type="checkbox" id="stu_name" onchange="searchchange('2')"></label> </br>
									<select class='col-md-12' id='sel_adm_no' name='adm_no' onchange='admis_no(this.value)' required>
										<option value=''>Select</option>
										<?php
										foreach ($StudentAdmno as $key => $val) {
										?>
											<option value='<?php echo $val['ADM_NO']; ?>'><?php echo $val['ADM_NO']; ?></option>
										<?php
										}
										?>
									</select>
									<select class='col-md-12' id='sel_stu_name' name='stu_name' onchange='admis_no(this.value)' required>
										<option value=''>Select</option>
										<?php
										foreach ($StudentAdmno as $key => $val) {
										?>
											<option value='<?php echo $val['ADM_NO']; ?>'><?php echo $val['FIRST_NM']." (".$val['DISP_CLASS']."-".$val['DISP_SEC'].")"; ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<hr style="border:1px solid black;">
			  <div class="row">
			  <div class="col-sm-4">
			  <div class="form-group">
				<label>Admission No:</label>
				<input type="text" class="form-control" id="adm_nooo" name="adm_nooo" style="text-transform: uppercase;" readonly="">
			</div>
			  </div>
			  <div class="col-sm-8">
			  <div class="form-group">
				<label>Student Name:</label>
				<input type="text" class="form-control" id="stuname" name="stuname" style="text-transform: uppercase;"  readonly="">
			  </div>
			  </div>
			  </div>			  
			  <div class="row">
			    <div class="col-sm-4">
				  <div class="form-group">
					<label>Class:</label>
					<input type="text" class="form-control" id="stuClass" name="stuClass"   readonly="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Section:</label>
					<input type="text" class="form-control" id="stusec" name="stusec"   readonly="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Roll No.:</label>
					<input type="text" class="form-control" id="sturoll" name="sturoll"   readonly="">
				  </div>
				</div>
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Issue Date:</label>
					<input type="text"  class="form-control " onchange="datechang(this.value)" value="<?=date('d-M-Y')?>" maxlength="10" name="issue_dt" id="issue_dt" readonly>
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Due Date:</label>
					<input type="text" class="form-control" name="datepi" id="datepi" value="<?=date('d-M-Y', strtotime(date('Y-m-d'). ' + 14 days'))?>" required="" readonly="">
				  </div>
				</div>				
			  </div>
			  <input type="hidden" class="form-control" id="book_cont" name="book_cont" >
			  <input type="hidden" class="form-control" id="maxbooks" name="maxbooks" >
			  </div>		  
			
		</div>
		<div class='col-sm-6' style='padding-right:20px;'>
			<div class="card-body">
			<div class="form-group" >
				<label style="font-size:15px">Issued Book Details</label>
			</div>
			<div id='load' class='table-responsive' style="height: 130px;"></div>	
			<div id='adv' class='table-responsive'></div>	
			</div>
		</div>
		</div>
		
		<hr/ style="border:1px solid">
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
					<label>Accession No.:</label>
					<select class='form-control' id='accno' name='accno' onchange='acce_no(this.value)' required>
					<option value=''>Select</option>
					<?php
						foreach($BookDetail as $key => $val){
							?>
								<option value='<?php echo $val['accno']; ?>'><?php echo $val['accno']; ?></option>
							<?php
						}
					?>
				</select>
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Subject Name:</label>
					<input type="text" class="form-control" id="subname" name="subname" style="text-transform: uppercase;" >
				  </div>
				</div>				
			  </div>
			  <div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Book Name:</label>
					<input type="text" class="form-control" name="book_name" id="book_name" style="text-transform: uppercase;">
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Author Name:</label>
					<input type="text" class="form-control" id="author_name" name="author_name" readonly="">
				  </div>
				</div>				
			  </div>
			  <div class="row">
			    <div class="col-sm-3">
				  <div class="form-group">
					<label>Edition:</label>
					<input type="text" class="form-control" name="edition" id="edition" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				<div class="col-sm-3">
				  <div class="form-group">
					<label>Book Code</label>
					<input type="text" class="form-control" name="B_Code" id="B_Code" readonly="" >
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Book No.:</label>
					<input type="text" class="form-control" name="book_no" id="book_no" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				</div>
				<div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Rack Name:</label>
					<input type="text" class="form-control" name="racname" id="racname" style="text-transform: uppercase;" readonly="">
					
				  </div>
				</div>
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Rack No.:</label>
					<input type="text" class="form-control" name="rackno" id="rackno" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				</div>				
			  </div>
			  </div>
			  
		<div class='col-sm-6' style='padding-right:20px;'>
			<div class="card-body">
				<div class="form-group" >
					<label style="font-size:15px;margin-bottom:8px;">Remaining Book</label>
				</div>
				<div class="row" style="margin-bottom:8px;">
					<div class="col-sm-4">
					  <b>Total Set :</b> <span id="totbook"></span>
					</div>
					<div class="col-sm-4">
					 <b> Total Issued :</b> <span id="isu_no"></span>
					</div>
					<div class="col-sm-4">
					  <b>Total Stock :</b> <span id="stock"></span>
					</div>
				</div>				
				<div class="row" >
				 <div class="col-sm-10">
				<div id="rboklist" class='table-responsive' style="height:275px"></div>
				 </div>
					<div class="col-sm-2" style="text-align:right">
					  <button type="button" onclick="isuuebook()" id="btnid" disabled class="btn btn-success btn-xs">Issue</button>
					</div>
				</div>	
			</div>
		</div>		
		</div>	
	</div><br/>
</div>
</form>	
<br />
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Book</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

$(".alert").fadeOut(3000);
	$('#sel_adm_no').select2();
	$('#sel_stu_name').select2();
	$('#accno').select2();
	$('#sel_stu_name').next(".select2-container").hide();
	$("#adm_no").prop("checked", true);
	
	function searchchange(type) {
		var serch_type = type;
		if (serch_type == 1) {
			$('#sel_adm_no').next(".select2-container").show();
			$('#sel_stu_name').next(".select2-container").hide();
			$("#adm_no").prop("checked", true);
			$('#stu_name').prop("checked", false);
		}else{
			$('#sel_adm_no').next(".select2-container").hide();
			$('#sel_stu_name').next(".select2-container").show();
			$("#adm_no").prop("checked", false);
			$('#stu_name').prop("checked", true);
		}
	}
	
	
function isuuebook_adv(adv_id){
	var adm=$('#adm_nooo').val();	

	
	var book_cont = $('#book_cont').val();
	if(book_cont !="")
		
	{
			
		var maxbooks 		= $('#maxbooks').val();

		//alert(acces_no);
		if(book_cont >= maxbooks){
			$.toast({
				heading: 'Sorry',
				text: 'Maximum Two book Issued',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
		}else{
	
	
		$.post("<?php echo base_url('library/StudentBookIssue/issuebook_adv');?>",{'adv_id':adv_id},function(data){
			
if(data ==1){				
					$.toast({
						heading: 'success',
						text: 'Book Issued Successfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
					
					admis_no(adm);
					
}else{
		$.toast({
						heading: 'Sorry',
						text: 'Book is not in stock',
						showHideTransition: 'slide',
						icon: 'error',
						position: 'top-right',
					});
}
					$('#btnid').prop('disabled',true);					
			});
		}
		}
	
	
	
}
function isuuebook(){	
	var book_cont = $('#book_cont').val();
	if(book_cont !="")
		
	{
		var maxbooks 		= $('#maxbooks').val();
		var admission_no 	= $('#adm_nooo').val();	
		var stu_class	 	= $('#stuClass').val();		
		var issue_dt	 	= $('#issue_dt').val();
		var due_date	 	= $('#datepi').val();
		var acces_no	 	= $('#accnn').val();	
		var book_name	 	= $('#book_name').val();		
		var B_Code			= $('#B_Code').val();
		//alert(acces_no);
		if(book_cont >= maxbooks){
			$.toast({
				heading: 'Sorry',
				text: 'Maximum Two book Issued',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
		}else{
			$.post("<?php echo base_url('library/StudentBookIssue/issuebook'); ?>",{admission_no:admission_no,stu_class:stu_class,issue_dt:issue_dt,due_date:due_date,book_name:book_name,acces_no:acces_no,B_Code:B_Code},function(data){		
					
					$.toast({
						heading: 'success',
						text: 'Book Issued Successfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
					admis_no(admission_no);
					$('#btnid').prop('disabled',true);					
			
			});
	
	}
	}
	else{
		$.toast({
			heading: 'Sorry',
			text: 'Please Select Admission No.',
			showHideTransition: 'slide',
			icon: 'error',
			position: 'top-right',
		});
	
}
}

//***************************************************************
function isue_ref(val){	
//alert(val);
	var book_cont 		= $('#book_cont').val();
	if(book_cont!="")
	{
		var maxbooks 		= $('#maxbooks').val();
		var admission_no 	= $('#adm_nooo').val();	
		var stu_class	 	= $('#stuClass').val();		
		var issue_dt	 	= $('#issue_dt').val();
		var due_date	 	= $('#datepi').val();
		var acces_no	 	= '';	
		var book_name	 	= $('#book_name').val();		
		var B_Code			= val;
		alert(book_cont);
		if(book_cont == maxbooks){
			$.toast({
				heading: 'Error',
				text: 'Maximum Two book Issued',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
		}else{
			$.post("<?php echo base_url('library/StudentBookIssue/issuebook'); ?>",{admission_no:admission_no,stu_class:stu_class,issue_dt:issue_dt,due_date:due_date,book_name:book_name,acces_no:acces_no,B_Code:B_Code},function(data){		
					$.toast({
						heading: 'success',
						text: 'Book Issued Successfully',
						showHideTransition: 'slide',
						icon: 'success',
						position: 'top-right',
					});
					admis_no(admission_no);
					$('#btnid').prop('disabled',true);
					$('#myModal').modal('hide');					
					
			});
		}
	}else{
		$.toast({
			heading: 'Error',
			text: 'Please Select Admission No.',
			showHideTransition: 'slide',
			icon: 'error',
			position: 'top-right',
		});
	}	
	
}

//***************************************************************
	function datechang(dateval){	
			$.post("<?php echo base_url('library/StudentBookIssue/get_dates'); ?>",{dateval:dateval},function(data){
				$fillData = $.parseJSON(data);			
				$("#datepi").val($fillData[0]);			
		});
	}

	$('.datepicker').datepicker({
		  format: 'dd-M-yyyy',
		  autoclose: true,
		  orientation: "bottom",
		  todayHighlight: true,	
		  daysOfWeekDisabled: [0]
	});

		function admis_no(student_id){
	
		$.post("<?php echo base_url('library/StudentBookIssue/student_details'); ?>",{student_id:		
		
		student_id},function(data){
	
			$fillData = $.parseJSON(data);	
			$("#load").html($fillData[0]);
			$("#adm_nooo").val($fillData[1]);
			$("#stuname").val($fillData[2]);
			$("#stuClass").val($fillData[3]);
			$("#stusec").val($fillData[4]);
			$("#sturoll").val($fillData[5]);
			$("#book_cont").val($fillData[6]);
			$("#maxbooks").val($fillData[7]);		
			$("#adv").html($fillData[8]);		
			
		});
	}
	
function acce_no(acce_no){
	$('#accnn').val(acce_no);
		var r=$("#accn").val();
		//alert(acce_no);
$.post("<?php echo base_url('library/StudentBookIssue/bookDetails'); ?>",{acce_no:acce_no},function(data){
			$fillData1 = $.parseJSON(data);	
			$("#book_name").val($fillData1[0]);
			$("#author_name").val($fillData1[1]);
			$("#publisnm").val($fillData1[2]);
			$("#edition").val($fillData1[3]);
			$("#racname").val($fillData1[4]);		
			$("#rackno").val($fillData1[5]);
			$("#subname").val($fillData1[6]);		
			$("#book_no").val($fillData1[7]);		
			$("#isu_no").html($fillData1[8]);		
			$("#totbook").html($fillData1[9]);			
			$("#B_Code").val($fillData1[12]);
			
			if($fillData1[13]>1){
				$('.modal-body').html($fillData1[14]);
				$('#myModal').modal('show');				
			}else{
			$("#stock").html($fillData1[9]-$fillData1[8]);
			$("#rboklist").html($fillData1[11]);							
				if($fillData1[10]==0){
					$('#btnid').prop('disabled',false);					
				}else{
					$.toast({
					text: 'Book Is already Issued',
						showHideTransition: 'slide',
						icon: 'error',
						position: 'top-right',
					});
					$('#btnid').prop('disabled',true);
					
				}
				
			}	
			if(r!=acce_no){
				
		//$("#accno").val(acce_no).trigger('change');	
			}
		});
		
	}
	
	$( window ).on( "load", function() {
        var issue_dt = $("#issue_dt").val();
        var due_date = $("#datepi").val();
		$.ajax({
			url: "<?php echo base_url('library/StudentBookIssue/chkHoliday'); ?>",
			type: "POST",
			data: {issue_dt:issue_dt,due_date:due_date},
			success: function(data){
			
			}
		});
    });
</script>