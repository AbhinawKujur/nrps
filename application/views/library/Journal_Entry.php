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
<?php $dateT= date("d-m-y");?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">News Paper Journal Entry</a> <i class="fa fa-angle-right"></i></li>

	   <li class="breadcrumb-item" ><a href="#" >Choose Date <input type="text" id="change_date" onchange="change_date(this.value)" readonly> </a>
	</li>
</ol>

<div style="padding-top:20px; padding-left: 25px; background-color: white; border-top:3px solid #337ab7;">
	<div class='row'>
	 <?php
			  if($this->session->flashdata('success')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('success'); ?>
					</div>
				  <?php
				  
				  
			  }
			  $date= date("D");
			  
			?>
	
		
		<div class='col-sm-12' style='padding-right:20px;'>
		    <div class='table-responsive' id="data_view">
				<form class="nur_form">
			<table class='table' id='example'>
			<thead>
				<tr>
					<th style='background:#337ab7; color:#fff !important;'>Name</th>
					<th style='background:#337ab7; color:#fff !important;'>Type</th>
					<th style='background:#337ab7; color:#fff !important;'>Price as <b>'<?php echo $date;?>'<br/><center><sup>(<?php echo $dateT;?>)</sup></center><input type="hidden" value="<?php echo $date;?>" name="day"></b></th>
					<th style='background:#337ab7; color:#fff !important;'>Qnt</th>
					<th style='background:#337ab7; color:#fff !important;'>Total</th>
					
		
				</tr>
			</thead>	
			<tbody>	
				<?php
			
				$i=1;
					foreach($newsMagazineMasterData as $key => $val){
						?>
							<tr>
								<td><?php echo $val['ItemName']; ?>
								<input type="hidden" value="<?php echo $val['ItemID']; ?>" name="itemid[]">
								<input type="hidden" value="<?php echo $val['update_id']; ?>" name="update_id[]">
								<input type="hidden" value="<?php echo $val['ItemName']; ?>" name="nm[]"></td>
								<td><?php echo $val['ItemType']; ?><input type="hidden" value="<?php echo $val['ItemType']; ?>" name="type[]"></td>
									<?php if ($val['ItemType'] == 'Magazine') { ?>
										<td> <?php echo $val['amount']; ?><input type="hidden" value="<?php echo $val['amount']; ?>" id="dp<?php echo $i; ?>" name="day_price[]"></td>
									<?php } else { ?>
										<td> <?php echo $val['d_pay']; ?><input type="hidden" value="<?php echo $val['d_pay']; ?>" id="dp<?php echo $i; ?>" name="day_price[]"></td>
									<?php } ?>
								
								<td><input type="number" min=0 value="<?php echo $val['qty']; ?>" name="qnt[]" onkeyup="qntPrice(this.value,<?php echo $i;?>)"></td>
								<td><input type="number" min=0  value="<?php echo $val['total_pay']; ?>" id="<?php echo $i;?>" name="total[]" readonly></td>
							</tr>
						<?php
						
						$i++;
					}
				?>
			</tbody>	
			</table>
			<input type='submit' class="btn btn-success" value='Save'>
				</form>
			</div>
		</div>
	
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
$( "#change_date" ).datepicker({
endDate: new Date()
}
);
function change_date(date){
		$.post("<?php echo base_url('library/NewsMagazineMaster/Journal_Entry_change'); ?>",{'date':date},function(data){
			$("#data_view").html(data);
		});
}
 $(".nur_form").on("submit", function (event) {
		
    event.preventDefault();
	//$("#sv_btn").prop('',true);
		$("#loading").click();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('library/NewsMagazineMaster/save_journal_entry'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
			 $('#loa').html("<p style='font-size:17px;color:green'>Record updated successfully...!!!</p>");
				 // swal("Good job!", "Record updated successfully!", "success");
				//window.location="<?php echo base_url('adm_nur/Adm_nur/payNow'); ?>";
				window.location="";
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