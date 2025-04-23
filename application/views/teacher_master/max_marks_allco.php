<style>
  table tr td,th{
	  color:#000!important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item">
	  <a href="#">Maximum Marks Allocation</a> <i class="fa fa-angle-right"></i>
	</li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
		  <div class="row">
		    <div class="col-sm-4">
			  <table class='table'>
			    <tr>
				  <th colspan='4' style="background:#5785c3; color:#fff!important;"><center>Examination Maximum Marks Allocation </center></th>
			    </tr>
			    <tr>
				  <th>Class</th>
				  <td>
				   <select name="class" id="class" class="form-control" onchange="classes(this.value)">
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
				  <input type="hidden" id="board">
			    </tr>
				
				<tr>
				  <th>Term</th>
				  <td>
				    <select name="term" id="term" class="form-control" onchange="term(this.value)" disabled>
					  <option value="">Select</option>
					  <?php
						if($t1 == 1){
					  ?>
					  <option value="T1">Term-1</option>
					  <?php } ?>
					  <?php
						if($t2 == 1){
					  ?>
					  <option value="T2">Term-2</option>
					  <?php } ?>
				    </select>
				  </td>
				</tr>
				
				<tr>
				  <th>Examination</th>
				  <td>
				    <select name="examination" id="examination" class="form-control" onchange="examination()">
					  <option value="">Select</option>
				    </select>
				  </td>
				</tr>
				
				<tr>
				 <th>Subject</th>
				  <td>
				    <select name="subject" id="subject" class="form-control" onchange="subject(this.value)">
					  <option value="">Select</option>
				    </select>
				  </td>
				</tr>
				
				<tr>
				  <th>Max Marks</th>
				  <td>
				    <input type="number" name="max_marks" id="max_marks" class="form-control" oninput="maxmrk(this.value)" disabled>
				  </td>
				</tr>
				
				<tr>
				  <td colspan='4' align='center'><button type="button" id="max_btn_save" class="btn btn-success" disabled onclick="max_marks_save_upd()"><i class="fa fa-circle-o-notch fa-spin" style='color:#fff; display:none;' id='load'></i> &nbsp;SAVE</button></td>
				</tr>
			  </table>
			</div>
			
			<div class="col-sm-8">
			  <div id="max_data_view"  style="height:400px; overflow:auto"></div>
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
 function classes(classes){
	 if(classes != ''){
	    $("#term").prop('disabled',false);
	 }else{
		$("#term").prop('disabled',true); 
	 }
	 $("select#term").val('');	 
	 $("select#examination").val('');	 
	 $("select#subject").val('');
     $("#max_marks").prop('disabled',true);	
     $("#max_marks").val('');	 
	 $.post("<?php echo base_url('Teacher_master/chk_classes_exam_mode'); ?>",{classes:classes},function(data){
		 if(data == 1){
			$("#emode").text('(as per CBSE)');
            $("#board").val(data);			
		 }else{
			$("#emode").text('(as per CMC)'); 
			$("#board").val(data);
		 }
	 });
 }
 
 function term(term){
	 var classes = $("#class").val();
	 var board   = $("#board").val();
	 $.post("<?php echo base_url('Teacher_master/term'); ?>",{classes:classes,board:board,term:term},function(data){
		 var fill = $.parseJSON(data);
		 $("#examination").html(fill[0]);
		 $("#max_data_view").html(fill[1]);
	 });
 }
 
 function examination(){
	var exammode  = $("#board").val(); 
	var classcode = $("#class").val();
	var term      = $("#term").val();
	var examcode  = $("#examination").val();

	$.post("<?php echo base_url('Teacher_master/examination'); ?>",{exammode:exammode,classcode:classcode,term:term,examcode:examcode},function(data){
		var fill = $.parseJSON(data);
		$("#subject").html(fill[0]);
		$("#max_data_view").html(fill[1]);
	});
 }
 
 function subject(subject){
	 $("#max_marks").val('');
	 if(subject != ''){
		 $("#max_marks").prop('disabled',false);
	 }else{
		 $("#max_marks").prop('disabled',true);
	 }
 }
 
 function maxmrk(val){
	 if(val != ''){
		if(val <= 0){
			alert('Invalid Input Number');
			$("#max_marks").val('');
	    }
        $("#max_btn_save").prop('disabled',false);		
	 }else{
		$("#max_btn_save").prop('disabled',true);
        $("#max_marks").val('');		
	 }
 }
 
 function max_marks_save_upd(){
	 $("#load").show();
	 $("#max_btn_save").prop('disabled',true);
	 var exammode  = $("#board").val();
	 var classcode = $("#class").val();
	 var classnm   = $("#class option:selected").text();
	 var term      = $("#term").val();
	 var examcode  = $("#examination").val();
	 var subcode   = $("#subject").val();
	 var max_marks = $("#max_marks").val();
	 if(max_marks != ''){
		 $.ajax({
			 url: "<?php echo base_url('Teacher_master/save_upd_max_marks'); ?>",
			 type: "POST",
			 data:{exammode:exammode,classcode:classcode,classnm:classnm,term:term,examcode:examcode,subcode:subcode,max_marks:max_marks},
			 success: function(data){
				 alert(data);
				 examination();
				 $("#load").hide();
				 $("#max_marks").val('');
				 $("#max_marks").prop('disabled',true);
			 }
		 });
	 }else{
		 alert('Enter Max Marks');
		 $("#max_marks").focus();
	 }
 }
</script>
