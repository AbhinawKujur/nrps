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
  <li class="breadcrumb-item" onclick=" window.history.back();"><a href="#" ><i class="fa fa-angle-double-left"></i> BACK</a></li>
    <li class="breadcrumb-item"><a href="#">Book Master Edit</a> <i class="fa fa-angle-right"></i></li>
</ol>
<?php
  $bname = $bMData[0]['BNAME'];
?>
<form id='nur_form'  autocomplete='off'>
<div style="padding-top:20px; padding-left: 25px; padding-right: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Subject Name:</label>
				<select class='form-control' name='subj_nm'  required>
				
					<?php
						foreach($subjectsData as $key => $val){
							//if($val['id'] == $bMData[0]['SUB_ID']){
							?>
								<option <?php  if($val['id'] == $bMData[0]['SUB_ID']){ echo "selected"; }  ?> value='<?php echo $val['id']; ?>'><?php echo $val['book_name']; ?></option>						
							<?php
							//break;
						//}
						}
					
					?>
				</select>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Refrence No.:</label>
				<input type="text" class="form-control" id='ref_no' name="ref_no" value="<?=$bMData[0]['ID_NO']?>" style='text-transform: uppercase;'>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Accession No.:</label>
				<input type="text" class="form-control" id='accno' name="accno" style='text-transform: uppercase;' value="<?=$bMData[0]['accno']?>" max='99999' required>
				<input type="hidden" name="id" id="editid" value="<?=$bMData[0]['id']?>">
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Type of Book:</label>
				<select class='form-control' id='book_type' name='book_type' onchange='book_typee(this.value)' required>
					<option value=''>Select</option>
					<?php
						foreach($booktypeData as $key => $val){
							?>
								<option <?php if($val['id'] == $bMData[0]['com']){ echo 'selected'; } ?> value='<?php echo $val['id']; ?>'><?php echo $val['book_type']; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Book Name:</label>
				<input type="text" class="form-control" name="book_nm" id="book_nm" style='text-transform: uppercase;' value="<?=$bMData[0]['BNAME']?>" required>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Set of Book:</label>
				<input type="number" class="form-control" name="set_of_no" id="set_of_no" style='text-transform: uppercase;' value="<?=$bMData[0]['BOOKSET']?>" min='1' readonly>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Author Name:</label>
				<input type="text" class="form-control" id="author" value="<?=$bMData[0]['AUTHOR']?>" name="author"  style='text-transform: uppercase;' required>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Edition:</label>
				<select class='form-control' name='edition'>
					<option value=''>Select</option>
					<?php
					$date=date('Y');
					
						for($i=1960; $i<=$date; $i++){
					?>
					<option <?php if($i == $bMData[0]['EDITION']){ echo 'selected'; } ?> value='<?php echo $i; ?>'><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Publisher:</label>
				<input type="text" class="form-control" value="<?=$bMData[0]['PUBLISHER']?>" name="publisher" id="publisher" style='text-transform: uppercase;' required>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Language:</label>
				<select class='form-control' name='language' id="language">
					<option value=''>Select</option>
					<option value='Hindi'<?php if('Hindi'== $bMData[0]['Med']){ echo 'selected'; } ?>>Hindi</option>
					<option value='English'<?php if('English'== $bMData[0]['Med']){ echo 'selected'; } ?>>English</option>
					<option value='Sanskrit'<?php if('Sanskrit'== $bMData[0]['Med']){ echo 'selected'; } ?>>Sanskrit</option>
					<option value='Others'<?php if('Others'== $bMData[0]['Med']){ echo 'selected'; } ?>>Others</option>
				</select>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Total Page:</label>
				<input type="text" class="form-control" name="tot_page" style='text-transform: uppercase;' value="<?=$bMData[0]['TPage']?>">
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Price:</label>
				<input type="text" class="form-control" value="<?=$bMData[0]['PRICE']?>" name="price_no" style='text-transform: uppercase;'>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>CD Exists with Book:</label>
				<select class='form-control' name='cd_exist'>
					<option value=''>Select</option>
					<option value='YES'>YES</option>
					<option value='NO' selected>NO</option>
				</select>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Call No.:</label>
				<input type="text" class="form-control" name="call_no" id="call_no" value="<?=$bMData[0]['CallNo']?>" style='text-transform: uppercase;'>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Bill No.:</label>
				<input type="text" class="form-control" value="<?=$bMData[0]['BillNo']?>" name="bill_no" style='text-transform: uppercase;'>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Collection No.:</label>
				<input type="text" class="form-control" name="collection_no" value="<?=$bMData[0]['CollectionNo']?>" style='text-transform: uppercase;'>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>ISBN No.:</label>
				<input type="text" class="form-control" value="<?=$bMData[0]['isbnno']?>" name="isbn" style='text-transform: uppercase;'>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Order Date:</label>
				<input type="text" value="<?php $dd=$bMData[0]['ODate'];$date=date_create("$dd"); echo date_format($date,"Y-m-d");?>" class="form-control datepicker" name="order_dt" style='text-transform: uppercase;' readonly>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Bill Date:</label>
				<input type="text" value="<?=$bMData[0]['bdate']?>" class="form-control datepicker" name="bill_dt" readonly>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Purchased From:</label>
				<input type="text" class="form-control" value="<?=$bMData[0]['PURCHASED']?>" name="PURCHASED" style='text-transform: uppercase;' readonly>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Library Name:</label>
				<input type="text" value="<?=$bMData[0]['LibName']?>" class="form-control" name="library_nm" style='text-transform: uppercase;'>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Almirah Name:</label>
				<select class='form-control' name='almirah_nm' onchange='rackNm(this.value)' required>
					<option value=''>Select</option>
					<?php
						foreach($rackMasterData as $key => $val){
							?>
								<option <?php if($val['RackNo'] == $bMData[0]['racname']){ echo 'selected'; } ?> value='<?php echo $val['RackNo']; ?>'><?php echo $val['RackName']; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Rack No.:</label>
				<select class='form-control' name='rack_no' id='rack_no' required>
					<option value='<?php echo $bMData[0]['racnoto']; ?>'><?php echo $bMData[0]['racnoto']; ?></option>
				</select>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Class:</label>
				<select class='form-control' name='class'>
					<option value=''>Select</option>
					<?php
						foreach($classesData as $key => $val){
							?>
								<option value='<?php echo $val['Class_No']; ?>' <?php if($val['Class_No'] == $bMData[0]['CLASS']){ echo 'selected'; } ?>><?php echo $val['CLASS_NM']; ?></option>
							<?php
						}
					?>
				</select>
			</div>
		</div>
	</div>
	
	<div class='row'>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Accession Date:</label>
				<input type="text"  class="form-control datepicker" value="<?php echo $bMData[0]['accession_date']; ?>" name="accession_dt" readonly>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Wing:</label>
				<select class='form-control' name='wing'>
					<option value=''>Select</option>
					<option value='Junior'<?php if('Junior' == $bMData[0]['ser']){ echo 'selected'; } ?>>Junior</option>
					<option value='Middle'<?php if('Middle' == $bMData[0]['ser']){ echo 'selected'; } ?>>Middle</option>
					<option value='Senior' <?php if('Senior' == $bMData[0]['ser']){ echo 'selected'; } ?>>Senior</option>
					<option value='General'<?php if('General' == $bMData[0]['ser']){ echo 'selected'; } ?>>General</option>
				</select>
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Sub Almirah Name:</label>
				<input type="text" value="<?=$bMData[0]['book_no']?>"  class="form-control" name="book_no" id="bookno">
			</div>
		</div>
		<div class='col-sm-3'>
			<div class="form-group">
				<label>Book Status:</label>
				<select class="form-control" name="bookstatus" id="bookstatus">
					<option>--Select--</option>
					<option value="L"<?php if('L' == $bMData[0]['book_status']){ echo 'selected'; } ?>>LOST</option>
					<option value="D"<?php if('D' == $bMData[0]['book_status']){ echo 'selected'; } ?>>DAMAGE</option>
					<option value="W"<?php if('W' == $bMData[0]['book_status']){ echo 'selected'; } ?>>WRITTEN OFF</option>
				</select>
			</div>
		</div>
	</div>
	<div class='row'>
	 <div class='col-sm-12'>
		<div class="form-group">
			<button type="submit" id='btn' class='btn btn-warning pull-right'>Update</button>
		</div>
	 </div>
	</div><br />
</div>
</form>
<br />
 <button type="button"  data-toggle="modal" data-target="#myModal" id='loading' style="display:none"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    
      <div class="modal-body" id='loa'>
       <p style="font-size:17px">Please Wait...</p>
      </div>
    
    </div>

  </div>
</div>
<script>

  	$("#nur_form").on("submit", function (event) {
    event.preventDefault();
	//$("#sv_btn").prop('',true);
	$("#loading").click();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('library/BookMaster/updatedata');?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				//alert("success...");
				  $('#loa').html("<p style='font-size:17px;color:green'>Successfully Updated record...!!!</p>");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				setTimeout(function(){ $("#loading").click(); }, 1000);
				window.location="<?php echo base_url('library/BookMaster');?>";
		}
	 });
	 });
$('#subj_nm').select2();
$(".alert").fadeOut(3000);
$('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
      todayHighlight: true,
	  endDate: "today"
});
function rackNm(rack_id){	
	$.post("<?php echo base_url('library/BookMaster/loadRackNo'); ?>",{rack_id:rack_id},function(data){
		$("#rack_no").html(data);
	});
}

function subject(subject_id){	
	$.post("<?php echo base_url('library/BookMaster/countSubject'); ?>",{subject_id:subject_id},function(data){
		$fillData = $.parseJSON(data);
		$("#ref_no").val($fillData[0]);
		$("#accno").val($fillData[1]);
		$("#bookno").val($fillData[2]+'-'+$fillData[1]);
		$("#call_no").val($fillData[2]);
	});
}

function book_typee(book_type_id){
	var accno    = $("#accno").val();
	var bookTxt = $("#book_type option:selected").text();
	$.post("<?php echo base_url('library/BookMaster/chkAccession_no'); ?>",{book_type_id:book_type_id,accno:accno},function(data){
		//alert(data);
		if(data > 0){
			alert('Accession no.'+ accno + ' has already been saved as a '+bookTxt+ ' Type.');
			$("#btn").prop('disabled',true);
		}else{
			$("#btn").prop('disabled',false);
		}
	});
}

$('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
			/* {
                extend: 'copyHtml5',
				title: 'Daily Collection Reports',
               
            }, */
			{
                extend: 'excelHtml5',
				title: 'Daily Collection Reports',
                
            },
			/* {
                extend: 'csvHtml5',
				title: 'Daily Collection Reports',
                
            }, */
			{
                extend: 'pdfHtml5',
				title: 'Daily Collection Reports',
                
            },
        ]
    });
</script>