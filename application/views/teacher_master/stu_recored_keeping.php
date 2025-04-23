<style>
  table tr td,th{
	  color:#000 !important;
	  padding-top:0px !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Record Keeping</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
		  <div class="row">
		  
		    <div class="col-sm-6">
			<form id="form" method="post">
			  <table class="table">
			    <tr>
				  <th>Adm No.</th>
				  <td><input type="number" name="adm_no" id="adm_no" class="form-control" oninput="adm(this.value)"></td>
			    </tr>
				
				<tr>
				  <th>Class Name</th>
				  <td><input type="text" name="class_nm" id="class_nm" class="form-control" readonly></td>
			    </tr>
				
				<tr>
				  <th>Student Name</th>
				  <td><input type="text" name="stu_nm" id="stu_nm" class="form-control" readonly></td>
			    </tr>
				
				<tr>
				  <th>Section</th>
				  <td><input type="text" name="sec" id="sec" class="form-control" readonly></td>
			    </tr>
				
				<tr>
				  <th>Father's Name</th>
				  <td><input type="text" name="f_nm" id="f_nm" class="form-control" readonly></td>
			    </tr>
				
				<tr>
				  <th>Contact No.</th>
				  <td><input type="text" name="cont" id="cont" class="form-control" readonly></td>
			    </tr>
				
				<tr>
				  <th>Remarks for student</th>
				  <td><textarea name="remarks" id="remarks" class="form-control" required></textarea></td>
			    </tr>
				
				<tr>
				  <td colspan='2' align='center'><button type="submit" class="btn btn-success">SAVE</button></td>
				</tr>
			  </table>
			</form>  
			</div>
			
			<div class='col-sm-6'>
              <div id="record_view" style="height:380px; overflow:auto;"></div>
		    </div>
			
		  </div>
		</div>
		<br /><br />

        <div class="clearfix"></div>
        
		<div class="inner-block">
           
		</div>
		
		<!-------------------Remarks Modal------------------->  
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Remarks</h4>
			  </div>
			  <form id="remarks_form" method="post">
				  <div class="modal-body">
					<div id="remarks_view"></div>
				  </div>
				  <div class="modal-footer">
					<button type="submit" class="btn btn-success btn-sm">Update</button>
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				  </div>
			  </form>  	
			</div>
		  </div>
		</div>
        <!-------------------End remarks Modal------------------->  
		
	
<script>
 function adm(adm_no){
	 $.post("<?php echo base_url('Teacher_master/stu_adm_no'); ?>",{adm_no:adm_no},function(data){
		 var fill = $.parseJSON(data);
		 $("#class_nm").val(fill[0]);
		 $("#stu_nm").val(fill[1]);
		 $("#sec").val(fill[2]);
		 $("#f_nm").val(fill[3]);
		 $("#cont").val(fill[4]);
		 $("#record_view").html(fill[5]);
	 });
 }
 
 $("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('Teacher_master/save_stu_keeping_record'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			 $("#record_view").html(data);
			 $("#remarks").val('');
		}
	});
 });
 
 function remarks(id,type){
	 $.post("<?php echo base_url('Teacher_master/remarks'); ?>",{id:id,type:type},function(data){
		$("#remarks_view").html(data);
        $("#myModal").modal('show');		
	 });
 }
 
 $("#remarks_form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('Teacher_master/save_remarks'); ?>",
		type: "POST",
		data: $("#remarks_form").serialize(),
		success: function(data){
			$("#remarks").val('');
			$("#myModal").modal('hide');
			 alert(data);
		}
	});
 });
</script>