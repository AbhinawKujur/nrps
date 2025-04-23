<style>
  table tr td,th{
	  color:#000!important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Studentwise Subject Allocation</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
		  <div class="row">
		    <div class="col-sm-4">
			  <table class="table">
			    <tr>
				  <th>Class</th>
				  <td>
				   <select name="class" id="class" class="form-control" onchange="clswisallo()">
				   <option value="">Select</option>
				   <?php
				    if(isset($classes)){
						foreach($classes as $data){
							echo "<option value='".$data->Class_No."'>".$data->CLASS_NM."</option>";
						}
					} 
				   ?>	 
				   </select>
				  </td>
			    </tr>
				
				<tr>
				  <th>Sec</th>
				  <td>
				   <select name="sec" id="sec" class="form-control" onchange="sec()">
				   <option value="">Select</option> 
				   </select>
				  </td>
				</tr>
				
				<tr>
				  <th>Subject</th>
				  <td>
				   <select name="subject" id="subject" class="form-control" onchange="subject()">
				   <option value="">Select</option> 
				   </select>
				  </td>
				</tr>
				
				<tr>
				  <td colspan='2' align='center'><button type="submit" class="btn btn-success" id="btn_sub" disabled form="stu_allco_subj"><i class="fa fa-circle-o-notch fa-spin" id="btn_load" style="color:#fff; display:none"></i> SAVE</button></td>
				</tr>
				
			  </table>
			</div>
			
			<div class='col-sm-8'>
				<form method="post" id="stu_allco_subj">
				  <div id="stu_view" style="height:400px; overflow:auto">
				    <img src="<?php echo base_url('assets/preloader/preloader.gif'); ?>" style="width:80px; height:80px; position:absolute; top:40%; left:43%; display:none; z-index:9999;" id="loder">
				  </div>
				</form>
		    </div>
			
		  </div>
		</div>
		    <br /><br />
        <div class="clearfix"></div>
                 
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
 function clswisallo(val){
	 var classs = $("#class option:selected").text();
	 $.post("<?php echo base_url('Teacher_master/classsec'); ?>",{classs:classs},function(data){
		$("#sec").html(data);
	 });
 }
 
 function sec(){
	 var classs = $("#class option:selected").val();
	 $.post("<?php echo base_url('Teacher_master/section'); ?>",{classs:classs},function(data){
		$("#subject").html(data);
	 });
 }
 
 function subject(){
	$("#loder").show();
	var classs    = $("#class option:selected").val(); 
	var sec       = $("#sec option:selected").val(); 
	var subj_code = $("#subject option:selected").val(); 
	$.post("<?php echo base_url('Teacher_master/allco_stu_list'); ?>",{classs:classs,sec:sec,subj_code:subj_code},function(data){
		$("#stu_view").html(data);
		$("#loder").hide();
	});
 }
 
 function checkAll(){
	 var val = $("input[name='chkall']").is(":checked");
	 if(val == true){
		$("input[name='adm_no[]']").each( function () {
		  $("input[name='adm_no[]']").prop('checked', true); 
		  $("#btn_sub").prop('disabled',false);
	    });
	 }else{
		$("input[name='adm_no[]']").each( function () {
		  $("input[name='adm_no[]']").prop('checked', false); 
		  $("#btn_sub").prop('disabled',true);
	    });
	 }   
 }
 
 function chk_one(){
	 var val = $("input[name='adm_no[]']").is(":checked");
	 if(val == true){
		$("#btn_sub").prop('disabled',false); 
	 }else{
		$("#btn_sub").prop('disabled',true); 
	 }
 }
 
 $("#stu_allco_subj").on("submit", function (event) {
	$("#btn_sub").prop('disabled',true); 
	$("#btn_load").show();
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('Teacher_master/save_and_upd'); ?>",
		type: "POST",
		data: $("#stu_allco_subj").serialize(),
		success: function(data){
		    if(data == 'upd'){
				alert("Data Update Successfully");
			}else{
				alert("Data Insert Successfully");
			}
			subject();
			$("#btn_load").hide();
		}
	});
 });
</script>
