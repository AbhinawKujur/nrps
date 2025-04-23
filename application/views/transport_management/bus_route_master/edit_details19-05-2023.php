<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Bus Route Master</a> <i class="fa fa-angle-right"></i>Edit Bus Route</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;padding-top: 5px;padding-top: 20px;">
<?php
	if($this->session->flashdata('msg')):
?>
	<div class="alert alert-success" role="alert" id="msg">
		<strong><?php echo $this->session->flashdata('msg'); ?></strong>
	</div>  
<?php endif; ?>	
  <div class="row">
  <div class="col-sm-12">
  <form method='POST' action="<?php echo base_url('Add_bus_route/saveupdate'); ?>">
		<input type='hidden' id='BusCode' value='<?php echo $bus_route_details[0]->BusCode; ?>'>
		<input type='hidden' id='Trip_ID' value='<?php echo $bus_route_details[0]->Trip_ID; ?>'>
		<input type='hidden' id='Prefer_ID' value='<?php echo $bus_route_details[0]->Prefer_ID; ?>'>
    <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Vehicle No.</b></td>
			  <td><?php echo $bus_route_details[0]->BusNo; ?></td>
			</tr>
			<tr>
			  <td><b>Trip</b></td>
			  <td>
				<select name='trip' id='trip' class='form-control' required>
					<option value=''>select</option>
					<?php
						foreach($trip_master as $key1=>$value1){
							?>
							<option <?php if($value1->Trip_ID == $bus_route_details[0]->Trip_ID){echo "selected";} ?> value='<?php echo $value1->Trip_ID; ?>'><?php echo $value1->Trip_Nm; ?></option>
							<?php
						}
					?>
				</select>
			  </td>
			</tr>
			<tr>
			  <td><b>Preference</b></td>
			  <td>
				<select name='preference' id='preference' required class='form-control'>
					<option value=''>select</option>
					<option <?php if($bus_route_details[0]->Prefer_ID == 1){echo "selected";} ?> value='1'>Boys</option>
					<option <?php if($bus_route_details[0]->Prefer_ID == 2){echo "selected";} ?> value='2'>Girls</option>
					<option <?php if($bus_route_details[0]->Prefer_ID == 3){echo "selected";} ?> value='3'>Co.Ed</option>
				</select>
			  </td>
			</tr>
			<tr>
			  <td><b>Stoppage</b></td>
			  <td>
				<select name='stoppage' required id='stoppage' onchange='checkstoppagesameornot(this.value)' class='form-control'>
					<option value=''>select</option>
					<?php
						foreach($stoppage as $key=>$value){
							?>
							<option <?php if($value->STOPNO == $bus_route_details[0]->STOPNO){echo "selected";} ?> value='<?php echo $value->STOPNO; ?>'><?php echo $value->STOPPAGE; ?></option>
							<?php
						}
					?>
				</select>
			  </td>
			</tr>
			<tr>
			  <input type="hidden" name="id" value="<?php echo $bus_route_details[0]->Route_Id; ?>">
			</tr>
			<tr>
			  <td colspan='2' align='center'><a href='<?php echo base_url('Add_bus_route/index'); ?>' class='btn btn-danger'>BACK</a>&nbsp;<input type="submit" name="class_save" value="UPDATE" class="btn btn-success"></td>
			</tr>
	</table>
	</form>
  </div>
  </div>
</div><br><br>



<script type="text/javascript">
 $( document ).ajaxComplete(function() {
      $('.dataTable').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          'pageLength'  : 25,
          "destroy": true,
        });
  });
$(document).ready(function () {
    $('#createForm').validate({ // initialize the plugin 
        
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
function checkstoppagesameornot(val){
	var BusCode = $('#BusCode').val();
	var Trip_ID = $('#Trip_ID').val();
	var Prefer_ID = $('#Prefer_ID').val();
	$.ajax({
      url:'<?php echo base_url('Add_bus_route/getdetailsmatch'); ?>',
      data:{BusCode:BusCode,Trip_ID:Trip_ID,Prefer_ID:Prefer_ID,val:val},
      method:"post",
      //dataType:"json",
      success:function(response)
      {
		if(response>=1){
			alert("This stoppage is already assign in selected trip and selected preference");
			$('#stoppage option[value=""]').prop('selected',true);
		}
      }
    });
}
function gettripmaster()
{
  var vehicleno = $('#vehicleno').val();
  var div_data = '<option value="">Select</option>';
  if(vehicleno != '')
  {
    $.ajax({
      url:'<?php echo base_url('Add_bus_route/gettripid'); ?>',
      data:{vehicleno:vehicleno},
      method:"post",
      dataType:"json",
      success:function(response)
      {
        $.each(response, function(key,val){
          div_data += '<option value="'+val.Trip_ID+'">'+val.Trip_Nm+'</option>';
        });
        $('#tripid').html(div_data);
      }
    }); 
  }
  else
  {
    $('#tripid').html(div_data);
  }
}
function getpreference(){
	var trip_id = $("#tripid").val();
	var div_data = '<option value="">Select</option>';
	if(trip_id != ''){
		div_data += '<option value="1">Boys</option>';
		div_data += '<option value="2">Girls</option>';
		div_data += '<option value="3">Co.Ed</option>';
		$('#preference').html(div_data);
	}else{
		 $('#preference').html(div_data);
	}
}
function getstoppage(){
	var vehicleno = $('#vehicleno').val();
	var preference = $("#preference").val();
	var trip_id = $("#tripid").val();
	var div_data = '<option value="">Select</option>';
	if(preference != ''){
		$.ajax({
		url:'<?php echo base_url('Add_bus_route/getbusstoppage'); ?>',
		data:{preference:preference},
		method:"post",
		dataType:"json",
		success:function(response)
		{
			$.each(response, function(key,val){
			div_data += '<option value="'+val.STOPNO+'">'+val.STOPPAGE+'</option>';
			});
			$('#stoppage').html(div_data);
			$.ajax({
				url: '<?php echo base_url('Add_bus_route/getallbusdetails'); ?>',
				data:{preference:preference,vehicleno:vehicleno,trip_id:trip_id},
				method:"post",
				success:function(secondresponse){
					$("#showbusdetails").html(secondresponse);
				}
			});
		}
		});
	}else{
		$('#stoppage').html(div_data);
	}
}

  </script>
