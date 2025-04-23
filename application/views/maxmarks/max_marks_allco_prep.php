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
	<li class="breadcrumb-item">
	  <a href="#">PREP</a> <i class="fa fa-angle-right"></i>
	</li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
		  <div class="row">
		    <div class="col-sm-4">
			  <table class='table'>
			    <tr>
				  <th colspan='4' style="background:#5785c3; color:#fff!important;"><center>Examination Maximum Marks Allocation <i id="emode"></i></center></th>
			    </tr>
			    <tr>
				  <th>Class</th>
				  <td>
				   <select name="class" id="class" class="form-control" onchange="classes(this.value)">
				   <option value="">Select</option>
				   <?php
				    if(isset($classes)){
						foreach($classes as $data){
							if($data->class_group == $class_grp){
							 echo "<option value='".$data->Class_No."'>".$data->CLASS_NM."</option>";
							}
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
				    <select name="subject" id="subject" class="form-control" onchange="getsubject(this.value)">
					  <option value="">Select</option>
				    </select>
				  </td>
				</tr>
				
				<tr>
				 <th>Skill</th>
				  <td>
				    <select name="subject" id="skill" class="form-control" onchange="skilll(this.value)">
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
	 $.post("<?php echo base_url('maxmarks/MaxmarksPrep/chk_classes_exam_mode'); ?>",{classes:classes},function(data){
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
	 $.post("<?php echo base_url('maxmarks/MaxmarksPrep/term'); ?>",{classes:classes,board:board,term:term},function(data){
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

	$.post("<?php echo base_url('maxmarks/MaxmarksPrep/examination'); ?>",{exammode:exammode,classcode:classcode,term:term,examcode:examcode},function(data){
		var fill = $.parseJSON(data);
		$("#subject").html(fill[0]);
		$("#max_data_view").html(fill[1]);
	});
 }
 
 function getsubject(subject){
	 $("#skill").prop('disabled',false);
	 var subj_nm    = $("#subject option:selected").text();
	 var class_code = $("#class").val();
	 var term       = $("#term").val();
	 $.post("<?php echo base_url('maxmarks/MaxmarksPrep/fetchskill'); ?>",{subject:subject,subj_nm:subj_nm,class_code:class_code,term:term},function(data){
		$("#skill").html(data); 
	 });
 }
 
 function skilll(subject){
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
	 var classcode = $("#class").val();
	 var classnm   = $("#class option:selected").text();
	 var term      = $("#term").val();
	 var examcode  = $("#examination").val();
	 var subcode   = $("#subject").val();
	
	 var max_marks = $("#max_marks").val();
	 var skill     = $("#skill").val();
	 if(max_marks != '' && subcode != ''){
		 $.ajax({
			 url: "<?php echo base_url('maxmarks/MaxmarksPrep/save_upd_max_marks'); ?>",
			 type: "POST",
			 data:{classcode:classcode,classnm:classnm,term:term,examcode:examcode,subcode:subcode,max_marks:max_marks,skill:skill},
			 success: function(data){
				 alert(data);
				 examination();
				 $("#load").hide();
				 $("#skill").val('');
				 $("#skill").prop('disabled',true);
				 $("#max_marks").val('');
				 $("#max_marks").prop('disabled',true);
			 }
		 });
	 }else{
		 alert('Enter Max Marks or select subject skill');
		 $("#load").hide();
	     $("#max_btn_save").prop('disabled',false);
		 $("#max_marks").focus();
	 }
 }
</script>
