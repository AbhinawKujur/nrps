<style type="text/css">

</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Attendance</a> <i class="fa fa-angle-right"></i></li>
</ol>
  
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;font-size: 12px;">
  <div class="row">
    <div class="col-sm-3">
	  <label>Session</label>
	  <select class="form-control" id="session" onchange='sess(this.value)'>
		  <option value=''>Select</option>
		  <option value='2021'>2023-2024</option>
	  </select>
    </div>
	
	<div class="col-sm-3">
	  <label>Class</label>
	  <select class="form-control" id="classs" onchange='getSec(this.value)'>
		  <option value=''>Select</option>
	  </select>
    </div>
   
    <div class="col-sm-3">
	  <label>Sec</label>
	  <select class="form-control" name="sec" id="sec">
		  <option value=''>Select</option>
	  </select>
    </div>

	<div class="col-sm-3">
	  <label>Term</label>
	  <select class="form-control" onchange="term(this.value)" id="term">
		  <option value=''>Select</option>
		  <option value='1'>TERM-1</option>
		  <option value='2'>TERM-2</option>
	  </select>
    </div>
	
	<div class="col-sm-3" style='display:none' id='totWorkDays'>
	  <label>Set Total Working Days</label>	
	  <input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='setTotWorkDays' id='setTotWorkDays' class='form-control'>
	  <button class='btn btn-success btn-sm' onclick='totWorkDay()' id='setBtn'>SET</button>
    </div>
  </div>
  
  <div class='row'><br /><br />
	<div class='col-sm-12'>
		<div id='load'></div>
	</div>
  </div>
</div><br />
	
<script type="text/javascript">
   function sess(val){
	   $("#load").html('');
	   $("#classs").val('');
	   $("#sec").val('');
	   $("#term").val('');
	   
	    $.ajax({
		   url: "<?php echo base_url('examatt/getClass'); ?>",
		   type: "POST",
		   data: {val:val},
		   success: function(ret){
			   $("#classs").html(ret);
		   }
	   });
   }
	
   function getSec(val){
	   $("#load").html('');
	   var session = $("#session").val();
	   $.ajax({
		   url: "<?php echo base_url('examatt/getSection'); ?>",
		   type: "POST",
		   data: {session:session,val:val},
		   success: function(ret){
			   $("#sec").html(ret);
		   }
	   });
   }	
	
   function term(val){
	   var session = $("#session").val();
	   var classs  = $("#classs").val();
	   var sec     = $("#sec").val();
	   $("body").css('opacity','0.5');
	   if(session != ''){
		   $.ajax({
			   url: "<?php echo base_url('examatt/getStu'); ?>",
			   type: "POST",
			   data: {val:val,session:session,classs:classs,sec:sec},
			   success: function(ret){
				   $("#totWorkDays").show();
				   $("#load").html(ret);
				   $("body").css('opacity','');
			   }
		   });
	   }else{
		  alert('Select Session First');
		  $("body").css('opacity','');	
	   }
   }
   
   function totPresentByStu(val,admno,session,term,types){
	  $.ajax({
		   url: "<?php echo base_url('examatt/totPresentDays'); ?>",
		   type: "POST",
		   data: {val:val,admno:admno,session:session,term:term,types:types},
		   success: function(ret){
			   //alert(ret);
		   }
	   }); 
   }
   
   function totWorkDay(){
	   var setTotWorkDays = $("#setTotWorkDays").val();
	   var session = $("#session").val();
	   var classs  = $("#classs").val();
	   var sec     = $("#sec").val();
	   var term    = $("#term").val();
	   $("#setBtn").prop('disabled',true);
	   $.ajax({
		   url: "<?php echo base_url('examatt/totWorkingDays'); ?>",
		   type: "POST",
		   data: {session:session,classs:classs,sec:sec,val:setTotWorkDays,term:term},
		   success: function(ret){
			   $(".workingDays").val(setTotWorkDays);
			   $("#setBtn").prop('disabled',false);
			   //alert(ret);
		   }
	   });
   }
</script>