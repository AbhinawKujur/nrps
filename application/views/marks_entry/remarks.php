<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<style>
  table tr td,th{
	  color:#000 !important;
	  padding:0px !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Remarks</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white">
  <div class="row">
	<div class="col-sm-12">
	  <table class="table">
	    <tr>
		  <th style="width:135px;">Class</th>
		  <th style="width:135px;">Sec</th>
		  <th>Remarks</th>
	    </tr>
	    <tr style='display:none'>
		  <td>
		    <select class="form-control" id="trm" disabled>
			  <option value='1' <?php if($trm == 1){ echo 'selected'; }?>>TERM-1</option>
			  <option value='2' <?php if($trm == 2){ echo 'selected'; }?>>TERM-2</option>
			</select>
		  </td>
	    </tr>
		
	    <tr>
		  <td>
		    <select class="form-control" onchange="classes(this.value)" id="classs">
			  <option value=''>Select</option>
			  <?php
			    if(isset($class_data)){
					foreach($class_data as $data){
						if($data->Class_No == $log_cls_no){
						?>
						  <option value="<?php echo $data->Class_No; ?>"><?php echo $data->CLASS_NM; ?></option>
						<?php
						}
					}
				}
			  ?>
		    </select>
		  </td>
	    
		 
		  <td>
		    <select class="form-control" name="sec" id="sec" onchange="secc(this.value)">
			  <option value=''>Select</option>
		    </select>
		  </td>
	   
		  
		  <td>
		    <select class="form-control" name="remarks" id="remarks" onchange="remarkss(this.value)" disabled>
			  <option value=''>Select</option>
			  <?php
			    if($remarks_data_mstr){
					foreach($remarks_data_mstr as $remarks_data){
						if($remarks_data->Remarks != ''){
						?>
						  <option value="<?php echo $remarks_data->Remarks; ?>"><?php echo $remarks_data->Remarks; ?></option>
						<?php
						}
					}
				}
			  ?>
		    </select>
		  </td>
	    </tr>
	  </table>
	</div>
	
	<div class="col-sm-12">
	  <div class="row">
	    <div class="col-sm-12">
	    </div>
	    <div class="col-sm-12">
	      <center><h4><b><div id="view_max_marks" style="display:none;"></div></b></h4></center>
	    </div>
	  </div>
	
	  <div class="row">
	  <div class="col-sm-12">
		  <center><img src="<?php echo base_url('assets/preloader/loading2.gif'); ?>" style="width:120px; display:none;" id="loading2"></center>
	    <div id="stu_list" style="height:400px; overflow:auto;">
		</div>
	  </div>
	  </div>
	</div>

  </div>
</div><br /><br />
<div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
  $("#remarks").select2({
	  allowClear: true,
      width: "resolve"
  });
  function classes(val){
	  $.post("<?php echo base_url('Remarks/classess'); ?>",{val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
	  });
  }
  
  function secc(val){
	  $("#remarks option[value='']").prop('selected',true);
	  if(val != ''){
		  $("#remarks").prop('disabled',false);
	  }else{
		  $("#remarks").prop('disabled',true);
	  }
	$("#loading2").show(); 
    $("#stu_list").html('');
    var classs = $("#classs").val();	
    var disp_classs = $("#classs option:selected").text();
    var sec    = $("#sec").val();
    var trm    = $("#trm").val();
	$.post("<?php echo base_url('Remarks/stu_list'); ?>",{classs:classs,disp_classs:disp_classs,sec:sec,trm:trm},function(data){
		$("#loading2").hide();
		$("#stu_list").html(data);
	});
  }
  
  function checkAll(){
	 var val = $("input[name='chkall']").is(":checked");
	 if(val == true){
		$("input[name='adm_no[]']").each( function () {
		  $("input[name='adm_no[]']").prop('checked', true); 
	    });
	 }else{
		$("input[name='adm_no[]']").each( function () {
		  $("input[name='adm_no[]']").prop('checked', false); 
	    });
	 }   
 }
 
 function remarkss(val){
	  if(val != ''){
		$("input[name='adm_no[]']").each( function () {
		  $("input[name='adm_no[]']").prop('disabled', false); 
	    });  
	  }else{
		$("input[name='adm_no[]']").each( function () {
		  $("input[name='adm_no[]']").prop('disabled', true); 
	    });   
	  }
 }
 
 function chk_one(val){
	 var rmrks = $("#remarks").val();
	 var id = val.id;
	 var str = id.split("_");
	 var finid = str[1];
	 var admno = $("#admno_"+finid).val();
	 var hremarks = $("#hremarks_"+finid).val();
	 var trm      = $("#trm").val();
	 
	 var isChecked = $("#admno_"+finid+":checked").val()?true:false;
	 
	 if(isChecked == true){
		$("#rmrks_"+finid).val(rmrks);
        $.post("<?php echo base_url('Remarks/save_upd'); ?>",{chk_sta:'chk',admno:admno,trm:trm,rmrks:rmrks},function(data){
			// alert(data);
			$.toast({
                heading: 'Success',
                text: 'Saved Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
		});		
	 }else{
		 $("#rmrks_"+finid).val(hremarks);
		 $.post("<?php echo base_url('Remarks/save_upd'); ?>",{chk_sta:'unchk',admno:admno,trm:trm,hremarks:hremarks},function(data){
			// alert(data);
			$.toast({
                heading: 'Success',
                text: 'Saved Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
		});
	 }

 }
</script>
