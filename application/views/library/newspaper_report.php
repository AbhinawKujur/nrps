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
<style>
#example2 {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#example2 td, #example2 th {
  border: 1px solid #ddd;
  padding: 8px;
}

#example2 tr:nth-child(even){background-color: #f2f2f2;}

#example2 tr:hover {background-color: #ddd;}

#example2 th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">News Paper Reports</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
	<form class="nur_form">
		<div class='col-sm-3'>
		 <input type="date" name="from_date" class="form-control" required>
		</div>
		<div class='col-sm-1'>
		<center>To</center>
		</div>
		<div class='col-sm-3'>
		<input type="date" name="to_date" class="form-control" required>
		</div>
		<div class='col-sm-3'>
		<select class="form-control" name="news_type" required>
		<option value="All">All</option>
		<option value="NewsPaper">NewsPaper</option>
		<option value="Magazine">Magazine</option>
		<option value="Journal">Journal</option>
		<option value="Jeneral">Jeneral</option>
		
		</select>
		</div>
		<div class='col-sm-2'>
		<input type="submit" value="Search" class='btn btn-info'>
		</div>
		</form>
	 <?php
			  if($this->session->flashdata('success')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('success'); ?>
					</div>
				  <?php
				  
				  
			  }
			  $date= date("D");
			  $dateT= date("d-m-y");
			?>
			
			
			
		<form >
		<br/>
		<br/>
		<div class='col-sm-12' style='padding-right:20px;'>
		    <div class='table-responsive' id="data_view">
		
			</div>
		</div>
		</form>
	</div><br />
</div><br />
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

 $(".nur_form").on("submit", function (event) {
		
    event.preventDefault();
	//$("#sv_btn").prop('',true);
		//$("#loading").click();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('library/NewsMagazineMaster/report_journal_entry'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				
				$("#data_view").html(data);
			// $('#loa').html("<p style='font-size:17px;color:green'>Record updated successfully...!!!</p>");
			 
				 // swal("Good job!", "Record updated successfully!", "success");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				//window.location="";
			}
		});
	
	 });
	 
$(".alert").fadeOut(3000);
$('#example').DataTable({
	"paging":   false,
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
	
	function newsMagazineMasterEdit(ItemID){
		$.post("<?php echo base_url('library/NewsMagazineMaster/edit'); ?>",{ItemID:ItemID},function(data){
			$("#load").html(data);
		});
	}
	
	function qntPrice(vl,id){
	
		var d_price=parseFloat($("#dp"+id).val());
		var ttl=d_price*parseFloat(vl);
		$("#"+id).val(ttl);
		
	}
</script>