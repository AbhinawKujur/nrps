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
    <li class="breadcrumb-item"><a href="#">Discipline Grade</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white"><br/><br/>
  <div class="row">
	<div class="col-sm-3">
	  <table class="table">
	    <tr>
		  <th>Term</th>
		  <td>
		    <select class="form-control" id="trm" onchange="term(this.value)" disabled>
			  <option value=''>Select</option>
			  <option value='1' <?php if($trm == 1){ echo 'selected'; } ?>>TERM-1</option>
			  <option value='2' <?php if($trm == 2){ echo 'selected'; } ?>>TERM-2</option>
		    </select>
		  </td>
	    </tr>
		
	    <tr>
		  <th>Class</th>
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
	    </tr>
		
		<tr>
		  <th>Sec</th>
		  <td>
		    <select class="form-control" name="sec" id="sec" onchange="secc(this.value)">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
	  </table>
	</div>
	
	<div class="col-sm-9">
	  <div class="row">
	    <div class="col-sm-9">
	    </div>
	    <div class="col-sm-3">
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
  function term(val){
	  $("#classs option[value='']").prop('selected',true);
	  $("#sec option[value='']").prop('selected',true);
	  if(val != ''){
		$("#classs").prop('disabled',false);  
	  }else{
		$("#classs").prop('disabled',true);    
	  }
  }
  
  function classes(val){
	  $.post("<?php echo base_url('Grade/classess_discipline'); ?>",{val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
	  });
  }
  
  function secc(val){
	$("#loading2").show(); 
    $("#stu_list").html('');
    var classs = $("#classs").val();	
    var disp_classs = $("#classs option:selected").text();
    var sec    = $("#sec").val();
    var trm    = $("#trm").val();
	$.post("<?php echo base_url('Grade/stu_list_discipline'); ?>",{classs:classs,disp_classs:disp_classs,sec:sec,trm:trm},function(data){
		$("#loading2").hide();
		$("#stu_list").html(data);
	});
  }
  
  function discipline_grd(adm_no,grade){
	var classs = $("#classs").val(); 
	var sec    = $("#sec").val(); 
	var trm    = $("#trm").val();
	$.post("<?php echo base_url('Grade/save_upd_discipline'); ?>",{adm_no:adm_no,classs:classs,sec:sec,grade:grade,trm:trm},function(data){
		//alert(data);
	});
  }
</script>
