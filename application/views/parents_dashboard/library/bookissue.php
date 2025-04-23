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
 
 <?php
 $first_name = $StuDatas[0]['FIRST_NM'];
		$mid_name 	= $StuDatas[0]['MIDDLE_NM'];
		$stuClass   = $StuDatas[0]['CLASS_NM'];
		$stusec     = $StuDatas[0]['SECTION_NAME'];
		$ADM_NO    = $StuDatas[0]['ADM_NO'];
		$sturoll    = $StuDatas[0]['ROLL_NO'];
		$maxbooks   = $fine_data[0]['maxbooks'];
		$full_name  = $first_name .' '. $mid_name;
		
 ?>
</style>
  <div class="content-wrapper">
   <section class="content">
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Advance Book Issue</a> <i class="fa fa-angle-right"></i></li>
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
			
			
			<div class="card-body" style="display:none">
			<div class="form-group">
				<label style="font-size:15px">Student Details</label>
			  </div>
			  <div class="row">
			  <div class="col-sm-4">
			  <div class="form-group">
				<label>Admission No:</label>
					<input type="text" class="form-control" name='adm_no'  id="adm_no" value="<?php echo $ADM_NO;?>" style="text-transform: uppercase;"  readonly="">
					
			  </div>
			  </div>
			  <div class="col-sm-8">
			  <div class="form-group">
				<label>Student Name:</label>
				<input type="text" class="form-control" id="stuname" name="stuname" value="<?php echo $full_name;?>" style="text-transform: uppercase;"  readonly="">
			  </div>
			  </div>
			  </div>			  
			  <div class="row">
			    <div class="col-sm-4">
				  <div class="form-group">
					<label>Class:</label>
					<input type="text" class="form-control" id="stuClass" name="stuClass"  value="<?php echo $stuClass;?>" readonly="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Section:</label>
					<input type="text" class="form-control" id="stusec" name="stusec"   value="<?php echo $stusec;?>" readonly="">
				  </div>
				</div>
				<div class="col-sm-4">
				  <div class="form-group">
					<label>Roll No.:</label>
					<input type="text" class="form-control" id="sturoll" name="sturoll"  value="<?php echo $sturoll;?>"  readonly="">
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
		
			  </div>	

			  	<div class="card-body">
			<div class="form-group" >
				<label style="font-size:15px">Issued Book Details</label>
			</div>
			<div id='load' class='table-responsive' style="height: 130px;">
			<?php


			if(sizeof($issued)!=0){
				?>
			<table class='table' style='font-size: 12px;' class='example'>
			<thead><tr><th style='background:#337ab7; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Issued Date</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Due Date</th></tr></thead>
			 <tbody>
			<?php
			$i=1;
			 foreach($issued as $key => $val){
				 
				 ?>
				
		<tr><td style='border:1px solid #dddddd;'><?php echo $i;?></td><td style='border:1px solid #dddddd;'><?php echo $val['BName'];?></td><td style='border:1px solid #dddddd;'><?php echo $val['BookID'];?></td><td style='border:1px solid #dddddd;'><?php echo date('d-M-y',strtotime($val['IDate']));?></td><td style='border:1px solid #dddddd;'><?php echo $val['Due_date'];?></td></tr>
		
		<?php $i++; }
		
		?>
		<tbody></table>
		<?php
		
		}else
		{  ?>
		
		
		
			<div style='text-align: center;margin-top: 50px;'>No Book Issued</div>
			
		
		<?php }?>
			
			</div>	
			
			</div>
			
		</div>
		<div class='col-sm-6' style='padding-right:20px;'>
			<div class="card-body">
			<div class="form-group" >
				<label style="font-size:15px">Issued Book For Advance		  <input type="hidden" class="form-control" id="book_cont" name="book_cont" >
			  <input type="hidden" class="form-control" id="maxbooks" name="maxbooks" ></label>
			</div>
			<div id='adv' class='table-responsive' style="height: 130px;">
			<?php


			if(sizeof($adv_issue)!=0){
				?>
			<table class='table' style='font-size: 12px;' class='example'>
			<thead><tr><th style='background:#337ab7; color:#fff !important;border:1px solid;'></th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Book Name</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Acc.No</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Apply Date</th><th style='background:#337ab7; color:#fff !important;border:1px solid;'>Booking Date</th></tr></thead>
			 <tbody>
			<?php
			$u=1;
			 foreach($adv_issue as $key => $val){
				 
				 ?>	
		<tr><td style='border:1px solid #dddddd;'><?php echo $u;?></td><td style='border:1px solid #dddddd;'><?php echo $val['BName'];?></td><td style='border:1px solid #dddddd;'><?php echo $val['BookID'];?></td><td style='border:1px solid #dddddd;'><?php echo date('d-M-y',strtotime($val['IDate']));?></td><td style='border:1px solid #dddddd;'><?php echo $val['BookingDate'];?></td></tr>
		
		<?php
$u++;
		}
		
		?>
		<tbody></table>
		<?php
		
		}else
		{  ?>
		
			<div style='text-align: center;margin-top: 50px;'>No Book Issued</div>
			
		
		<?php }?>
			
			</div>		
			</div>
		</div>
		</div>
		
		<hr/ style="border:1px solid">
		 <div class="row">
		<div class='col-sm-6'>
		<div class="card-body">
			<div class="form-group" >
				<label style="font-size:15px"><u> Search Your book</u></label>
			  </div>
			  
				
			  <div class="row">
			  	<div class="col-sm-3">
				  <div class="form-group">
					<input type="radio" checked id="accno" value="accno" name="srh" class='srh'> <label> By Accession No.:</label>
					
				  </div>
				  </div>
				    	<div class="col-sm-3">
				  <div class="form-group">
					<input type="radio" id="bname" value="bname" name="srh" class='srh'> <label> Book Name:</label>
				
				  </div>
				  </div>
				    	<div class="col-sm-3">
				  <div class="form-group">
					<input type="radio" id="author" value="author" name="srh" class='srh'> <label> By Subject:</label>
				
				  </div>
				  </div>
				    	<div class="col-sm-3">
				  <div class="form-group">
					<input type="radio"  id="publiser" value="class" name="srh" class='srh'> <label> By Class:</label>
			
				  </div>
				  </div>
								
			  </div>
			  
			  	<div class="row">
			    <div class="col-sm-12">
				  <div class="form-group">
					<label id='srv'>Enter Accession No.</label>
					<select class='form-control select2' id='vl' name='sr_vl' onchange='searchh(this.value)' required>
					<option value=''>Select</option>
					<?php
						foreach($BookDetail as $key => $val){
							?>
								<option value='<?php echo $val['accno']; ?>'><?php echo $val['accno']; ?></option>
							<?php
						}
					?>
				</select>
				<select  id='acce_no_s' style="display:none">
					<option value=''>Select</option>
					<?php
						foreach($BookDetail as $key => $val){
							?>
								<option value='<?php echo $val['accno']; ?>'><?php echo $val['accno']; ?></option>
							<?php
						}
					?>
				</select>
				
						<select id='bname_s'  style='display:none' >
					<option value=''>Select</option>
					<?php
						foreach($BookDetail as $key => $val){
							?>
								<option value='<?php echo $val['accno']; ?>'><?php echo $val['BNAME']; ?></option>
							<?php
						}
					?>
				</select>
					<select id='author_s'  style='display:none' >
					<option value=''>Select</option>
					<?php
						foreach($BookDetail as $key => $val){
							?>
								<option value='<?php echo $val['accno']; ?>'><?php echo $val['subject']; ?></option>
							<?php
						}
					?>
				</select>
				<select id='class_s' style='display:none'>
					
					<option value=''>Select</option>
					<?php
						foreach($BookDetail as $key => $val){
							?>
								<option value='<?php echo $val['accno']; ?>'><?php echo $val['class']; ?>:-<?php echo $val['BNAME']; ?></option>
							<?php
						}
					?>
				</select>
				</div>
				</div>
			
				</div>
					<div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Booking Date: <sup style="color:red">*</sup></label>
					<input type="text" class="form-control" id="appointment_adate" placeholder="00/00/00">
				</div>
				</div>
				 
				</div>
			  <div class="row" id="here">
			    <div class="col-sm-6">
				<div class="form-group">
					<label>Edition:</label>
					<input type="text" class="form-control" name="edition" id="edition" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				
				<div class="col-sm-6">
				  <div class="form-group">
					<label>Class:</label>
					<input type="text" class="form-control" id="subname" name="subname" style="text-transform: uppercase;" readonly="">
				  </div>
				  </div>
				  </div>
				<div class="row">
			    <div class="col-sm-6">
				  <div class="form-group">
					<label>Book Name:</label>
					<input type="text" class="form-control" name="book_name" id="book_name" style="text-transform: uppercase;" readonly="">
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
							
			
			 
				<div class="col-sm-6" style='display:none'>
				  <div class="form-group">
					<label>Book Code</label>
					<input type="text" class="form-control" name="B_Code" id="B_Code" readonly="" >
				  </div>
				</div>
				<div class="col-sm-6" style='display:none'>
				  <div class="form-group">
					<label>Book No.:</label>
					<input type="text" class="form-control" name="book_no" id="book_no" style="text-transform: uppercase;" readonly="">
				  </div>
				</div>
				</div>
				<div class="row" style='display:none'>
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
					<label style="font-size:15px;margin-bottom:8px;">Book In Advance</label>
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
					  <button type="button" onclick="isuuebook()" id="btnid" disabled class="btn btn-success btn-xs">Book Now</button>
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
</div>
</section>

<script>

//$(".alert").fadeOut(3000);	
//$('#adm_no').select2();
//$('#acce_no_s').select2();
//$('#author').select2();
//$('#publiser').select2();
//$('#accno').select2();

$(function() {
    $("#appointment_adate").datepicker({
      format: 'yyyy-mm-d',
        autoclose: true,
        startDate: '+1d'    
    });
});
$(".srh").change(function(){
var selectedOption = $("input:radio[name=srh]:checked").val();

if(selectedOption =="accno"){
	var ht=$("#acce_no_s").html();
	$("#vl").html(ht);
	$('#srv').html("Enter Accession No");
	
}else if(selectedOption =="author"){
		$('#srv').html("Enter Author Name");
			var ht=$("#author_s").html();
	$("#vl").html(ht);
	
}else if(selectedOption =="class"){
		$('#srv').html("Enter Publiser Name");
			var ht=$("#class_s").html();
	$("#vl").html(ht);
}else{
		$('#srv').html("Enter Book Name");
			var ht=$("#bname_s").html();
	$("#vl").html(ht);
}

});

		function isuuebook()
		{	
	var	bdate=$("#appointment_adate").val();
	if(bdate!=""){
		var book_cont= $('#book_cont').val();
		if(book_cont!="")
		{
		var maxbooks 		= $('#maxbooks').val();
		var admission_no 	= $('#adm_no').val();	
		var stu_class	 	= $('#stuClass').val();		
		var issue_dt	 	= $('#issue_dt').val();
		var due_date	 	= $('#datepi').val();
		var acces_no	 	= $('#accno').val();	
		var book_name	 	= $('#book_name').val();		
		var B_Code			= $('#B_Code').val();
		
		//alert(acces_no);
		if(book_cont == maxbooks){
			$.toast({
				heading: 'Error',
				text: 'Maximum Two book Issued',
				showHideTransition: 'slide',
				icon: 'error',
				position: 'top-right',
			});
		}else{
			$.post("<?php echo base_url('parent_dashboard/library/bookissue/issuebook'); ?>",{admission_no:admission_no,stu_class:stu_class,issue_dt:issue_dt,due_date:due_date,book_name:book_name,acces_no:acces_no,B_Code:B_Code,'bdate':bdate},function(data){	
		
				
					swal("Booked!", "Successfully Applied Advance booking!", "success");
					$("#appointment_adate").val("");
					admis_no(admission_no);
					$('#btnid').prop('disabled',true);					
			});
		}
	}
	}else{
		
					swal("Please Select your booking date!!");
		
	}
}
	function searchh(acce_no){
		//alert(acce_no);
		//var r=$("#accno").val();
		var feild = $("input:radio[name=srh]:checked").val();
		var admission_no = $('#adm_no').val();	
		   //alert(acce_no);
			$.post("<?php echo base_url('parent_dashboard/library/bookissue/bookDetails'); ?>",{'value':acce_no,'feild':feild,'adm':admission_no},function(data){
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
			
			$("#book_cont").val($fillData1[9]);	
			
			if($fillData1[13]>1){
				$('.modal-body').html($fillData1[14]);
				$('#myModal').modal('show');				
			}else{
				$("#stock").html($fillData1[9]-$fillData1[8]);
				$("#rboklist").html($fillData1[11]);							
				if($fillData1[10]==0){
					$('#btnid').prop('disabled',false);					
				}else{
						$('#btnid').prop('disabled',true);
						
						swal("Allready Booked in Advance!");	
				}
				
			}	
			/* if(r!=acce_no){
				
		$("#accno").val(acce_no).trigger('change');	
			} */
		});
		
	}

//***************************************************************
function isue_ref(val){	
//alert(val);
	var book_cont 		= $('#book_cont').val();
	if(book_cont!="")
	{
		var maxbooks 		= $('#maxbooks').val();
		var admission_no 	= $('#adm_no').val();	
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
					swal("Booked!", "Successfully Applied Advance booking!", "success");
					$('.toast').toast('show');
					
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
		$.post("<?php echo base_url('parent_dashboard/library/bookissue/student_details'); ?>",{student_id:student_id},function(data){
			$fillData = $.parseJSON(data);	
			$("#load").html($fillData[0]);
			$("#stuname").val($fillData[1]);
			$("#stuClass").val($fillData[2]);
			$("#stusec").val($fillData[3]);
			$("#sturoll").val($fillData[4]);
			$("#book_cont").val($fillData[5]);
			$("#maxbooks").val($fillData[6]);		
			$("#adv").html($fillData[7]);		
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>