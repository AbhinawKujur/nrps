<style>
  table tr td,th{
	  color:#000 !important;
	  padding-top:0px !important;
  }
  table thead tr th{
	  background:#337ab7 !important;
	  color: #fff !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
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

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Class Promotion</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 25px; background-color: white">
  <div class='row'>	
	<div class='col-sm-4'>
		<label>Select Class</label>
		<select class='form-control' id='class_id' onchange="loadClassesSec('class')">
			<option value=''>Select</option>
			<?php
				foreach($classes as $key => $val){
			?>
			<option value='<?php echo $val['Class_No']; ?>'><?php echo $val['CLASS_NM']; ?></option>
			<?php
				}
			?>
		</select>
	</div>
	
	<div class='col-sm-4'>
		<label>Select Section</label>
		<select class='form-control' id='sec_id' onchange="loadClassesSec('sec')">
			<option value=''>Select</option>
			<?php
				foreach($sections as $key => $val){
			?>
			<option value='<?php echo $val['section_no']; ?>'><?php echo $val['SECTION_NAME']; ?></option>
			<?php
				}
			?>
		</select>
	</div>
  </div><br />	
  <div class="row">
	<div class='col-sm-12'>
		<div id='load'></div>
	</div>
  </div>
</div><br />
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
function loadClassesSec(text){
	$("body").css({"opacity": "0.5"});
	var class_id = $("#class_id").val();
	var sec_id   = $("#sec_id").val();
	if(text == 'class'){
		$("#sec_id").val('');
	}
	if(class_id != ''){
		$.ajax({
			url: "<?php echo base_url('promotion/Promotion/LoadSelectedClass'); ?>",
			type: "POST",
			data:{text:text,class_id,class_id,sec_id:sec_id},
			success: function(data){
				$("body").css({"opacity": "1"});
				$("#load").html(data);
			}
		});
	}else{
		$("body").css({"opacity": "1"});
		$.toast({
			heading: 'Error',
			text: 'Choose Class First',
			showHideTransition: 'slide',
			icon: 'error',
			position: 'top-right',
		});
	}
}
 
function savePromotion(val,admno,curr_class_id,curr_sec_id){
	var ids = val.id;
	var splt = ids.split("_");
	var finid = splt[1];
	var value = $("#admno_"+finid).prop('checked') ? 1: 0;
	var promotedClass = $("#promotedClass_"+finid).val();
	var status = $("#status_"+finid).val();
	var promotedSection = $("#promotedSection_"+finid).val();
	$.ajax({
		url: "<?php echo base_url('promotion/Promotion/SavePromotionData'); ?>",
		type: "POST",
		data:{admno:admno,curr_class_id:curr_class_id,curr_sec_id:curr_sec_id,value:value,promoted_section:promoted_section,promotedClass:promotedClass,status:status},
		success: function(data){
			$("body").css({"opacity": "1"});
			$("#load").html(data);
		}
	});
} 
</script>
