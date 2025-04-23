
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
 
 .tab1{
 	border:1px solid #dddddd;
 }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Book Barcode Generate</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--==================================================================-->
<form action="<?php echo base_url('library/Barcode/generate'); ?>" method="post" autocomplete="off" target="_blank">
	<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
		<div class='row' style="margin-right: 0px;">
			<span class="btn btn-danger" style="float:right" id="print"><i class="fa fa-barcode" aria-hidden="true"></i> Print Barcode <i class="fa fa-print" aria-hidden="true"></i></span><br/>
			<div>
			  	<div class="row justify-content-md-center">
				    <div class="col col-lg-2">
						<input type='radio' name="barcode" value="all" class="br " checked onclick='barcodes(this.value)'>  All
						<input type='radio' name="barcode" value="selected" class="br " onclick='barcodes(this.value)'>  Selected
				    </div>
				    <div class="col col-lg-4">
						<textarea name='selected_bnm' class='form-control' id='selected' disabled required onkeyup='checkcomma()'></textarea>
				    </div>
			 	</div>

			  	<hr/>

			  	<!-- <div class="row justify-content-md-center">
			    	<div class="col col-lg-2">
						<input type='radio' name="barcode" value="subject" class="br"> Subject Wise
			    	</div>
			    	<div class="col-md-auto">
						<select class='form-control ok' id='subj_id' name='subj_id'  style="width:200px" disabled>
							<option value=''>--Select--</option>
							<?php
							foreach($subjectname as $key => $val){
							?>
							<option value="<?=$val['id']?>"><?=$val['book_name']?></option>
							<?php }?>						
						</select>
			    	</div>
			    
			  	</div> -->
			  	<hr/>
			    	
			  	<!-- <div class="row justify-content-md-center">
			    	<div class="col col-lg-2">
						<input type='radio' name="barcode" value="accno" class="br"> Accession No.
			    	</div>
			    	<div class="col-md-auto">
						<input type='number' style="width:200px" placeholder="From..." class="st ot" name="from"> To 
						<input type="number" class="st ot" name="to" placeholder="To..." style="width:200px">
			    	</div>
			 	</div> -->
			<hr/>
			</div>
		</div>	
	</div>
	<input type="submit" id="sub" name="search" style="display:none">
</form>	
<!--===============================================================================-->

<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<script>

$(".br").change(function(){
	
	var radioValue = $("input[name='barcode']:checked"). val();
	if(radioValue !="subject"){
		$('.ok').attr("disabled",true);
		
	}else{
			$('.ok').attr("disabled",false);
			
	}
	if(radioValue =="subject"){
		$('.ok').attr("required",true);
				$('.ot').attr("required",false);
	}else if(radioValue =="accno"){
			$('.ok').attr("required",false);
			$('.ot').attr("required",true);
			
	}else{
		$('.st').attr("required",false);
	}
});
$("#print").click(function(){
	$("#sub").click();
});
$(".alert").fadeOut(3000);	
$("#subj_id").select2();
$('.datepicker').datepicker({
		  format: 'dd-M-yyyy',
		  autoclose: true,
		  orientation: "bottom",
		  todayHighlight: true,
	});

$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			
			{
                extend: 'excelHtml5',
				title: 'Book Issued Reports',
                
            },			
			{
                extend: 'pdfHtml5',
				title: 'Book Issued Reports',
                
            },
        ]
    });
function barcodes(val){
		if(val == 'selected'){
			$("#selected").prop('disabled',false);
		}else{
			$("#selected").prop('disabled',true);
		}
	}
	
	function checkcomma(){
		var count = ($("#selected").val().match(/,/g)||[]).length < 21;
		if(count == false){
			alert('Enter Valid Entry..!');
			$("#print").prop('disabled',true);
		}else{
			$("#print").prop('disabled',false);
		}
	}
	
</script>