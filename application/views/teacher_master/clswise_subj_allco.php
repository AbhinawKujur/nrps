<style>
  table tr td,th{
	  color:#000!important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Classwise Subject Allocation</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
		  <div class="row">
		    <div class="col-sm-4">
			  <table class="table">
			    <tr>
				  <th>Class</th>
				  <td>
				   <select name="class[]" id="class" class="form-control" onchange="clswisallo(this.value)">
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
				  <td colspan='2' align='right'>
				    <button type="button" class='btn btn-success btn-xs' onclick='add_more()'>Add More</button>
				  </td>
				</tr>
			  </table>
			</div>
		    <div class="col-sm-8">
			<form action="<?php echo base_url('Teacher_master/classes_save'); ?>" method="post" id="class_from">
			 <div id="view_alloc" style="height:400px; overflow:auto;"></div>
			</form> 
			</div>
		  </div>
		</div><br /><br />
        <div class="clearfix"></div>
                 
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
$(document).ready( function () {
    $('#class_table').DataTable();
} );

function clswisallo(val){
	$("#view_alloc").html('');
	if(val != ''){
		$("#upd").prop('disabled',false);
	}else{
		$("#upd").prop('disabled',true);
	}
	$.ajax({
		url: "<?php echo base_url('Teacher_master/classwiseallco'); ?>",
		type: "POST",
		data: {val:val},
		success: function(data){
			$("#view_alloc").html(data);
		}
	});
}

function add_more(){
	var count = $("#ad_mor tr").length;
	var classs = $("#class").val();
	$.post("<?php echo base_url('Teacher_master/apnd'); ?>",{classs:classs,count:count},function(data){
		$("#ad_mor").append(data);
	});
	count ++;
}

function rv(abc){
	var str         = abc.id;
    var strid       = str.split("_");
    var finid       = strid[1];
	var classs      = $("#class option:selected").text(); 
	var classsid      = $("#class option:selected").val(); 
	var subjectcode = $("#subjectcode_"+finid).val();
	var subjname = $("#subjname_"+finid).val();
	var cnf     = confirm("Are You Sure Want To delete ?");
	if(cnf == true){
		$.post("<?php echo base_url('Teacher_master/chk_del'); ?>",{classs:classs,subjectcode:subjectcode,classsid:classsid},function(data){
			if(data == 'N'){
				alert(subjname+' Marks entry has been already done in class - '+classs+' can not proceed');
			}else if(data == 'Y'){
				$("#subjname_"+finid).prop('disabled',true);
                $("#optcode_"+finid).prop('disabled',true);
                $("#row_"+finid).hide();
			}
		})
	}
}

function edit(val){
	var str = val.id;
	var strid = str.split("_");
	var finid = strid[1];
	$("#optcode_"+finid).prop('disabled',false);
	$("#optcode_"+finid).css('border','3px solid green');
	$("#save_"+finid).prop('disabled',false);
}

function chk_sub(val){
	var subj     = val.id;
	var str      = subj.split("_");
	var subid    = str[1]; 
	var subjname = $("#subjname_"+subid).find(":selected").text();
	var classs   = $("#class").val();
	$.post("<?php echo base_url('Teacher_master/chk_subject'); ?>",{subjname:subjname,classs:classs},function(data){
		if(data == 1){
			alert("Already Selected");
			$("#subjname_"+subid+" option[value='']").prop('selected', true);
		}
	});
}

function class_upd(val){
	var str          = val.id;
	var strid        = str.split("_");
	var finid        = strid[1];
	
	var opt_code     = $("#optcode_"+finid).val();
	var classno      = $("#classno_"+finid).val();
	var subjectcode  = $("#subjectcode_"+finid).val();
	
	$.post("<?php echo base_url('Teacher_master/class_upd'); ?>",{opt_code:opt_code,classno:classno,subjectcode:subjectcode},function(data){
		alert(data);
		$("#optcode_"+finid).css('border','1px solid #000');
	    $("#save_"+finid).prop('disabled',true);
	});
}

function new_upd(val){
	var str         = val.id;
	var strid       = str.split("_");
	var finid       = strid[1];
	
	var sort        =  $('#ad_mor tr:visible').length - 1;
	var optcode     = $("#optcode_"+finid).val();
	var subcode     = $("#subjname_"+finid).val();
	var class_no    = $("#class").val();
	if(subcode != '' && optcode != ''){
		$.post("<?php echo base_url('Teacher_master/new_sub_upd'); ?>",{sort:sort,optcode:optcode,subcode:subcode,class_no:class_no},function(data){
			alert(data);
			clswisallo(class_no);
		});
	}else{
		alert('Select Subject or Subject Type');
	}
}
</script>
