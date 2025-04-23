<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Bus Route Master</a> <i class="fa fa-angle-right"></i> Assign Bus Route</li>
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
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <form role="form" action="<?php echo base_url('Add_bus_route/savedata'); ?>" method="post" id="createForm">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Assign Route Stoppage Wise</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                          <div class="form-group">
                            <label class="control-label">Select Vehicle No.</label><span class="req"> *</span>
                            <select class="form-control" name="vehicleno" id="vehicleno" onchange="gettripmaster()" required="true">
                              <option value="">Select</option>
                              <?php foreach ($busnomaster as $key => $value) {
									if($value->BusNo != '-'){
									?>
									<option value="<?php echo $value->BusCode; ?>"><?php echo $value->BusNo; ?></option>
									<?php									
									}
									
							  ?>
                                
                              <?php } ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Select Trip</label><span class="req"> *</span>
                            <select class="form-control" name="trip_id" id="tripid" required onchange="getpreference()">
								
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Select Preference</label><span class="req"> *</span>
                            <select class="form-control" name="preference" id="preference" onchange="getstoppage()" required="true">
                              
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="control-label">Select Stoppage</label><span class="req"> *</span>
                            <select class="form-control" name="stoppage" id="stoppage" required="true">
                              
                            </select>
                          </div>

                          <button type='submit' class="btn btn-success pull-right" name="save">Save</button>
                        </div>
                      </div>
              </form>
            </div>


            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" id="showbusdetails">
                    
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
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
	load_data();
    $('#createForm').validate({ // initialize the plugin 
        
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

function load_data(){
	var vehicleno = $('#vehicleno').val();
	var preference = $("#preference").val();
	var trip_id = $("#tripid").val();
	$.ajax({
		url: '<?php echo base_url('Add_bus_route/getallbusdetails'); ?>',
		data:{preference:preference,vehicleno:vehicleno,trip_id:trip_id},
		method:"post",
		success:function(secondresponse){
			$("#showbusdetails").html(secondresponse);
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
		load_data();
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
		load_data();
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
				if(val.STOPPAGE != "NONE"){
						div_data += '<option value="'+val.STOPNO+'">'+val.STOPPAGE+'</option>';
				}
			
			});
			$('#stoppage').html(div_data);
			load_data();
		}
		});
	}else{
		$('#stoppage').html(div_data);
	}
}

  </script>
