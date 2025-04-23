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
    <li class="breadcrumb-item"><a href="#">Half Yearly</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white"><br/><br/>
  <div class="row">
	<div class="col-sm-3">
	  <table class="table">
	    <tr>
		  <th>Class</th>
		  <td>
		    <select class="form-control" onchange="classes(this.value)" id="classs">
			  <option value=''>Select</option>
			  <?php
			    if(isset($class_data)){
					foreach($class_data as $data){
						?>
						  <option value="<?php echo $data['Class_no']; ?>"><?php echo $data['classnm']; ?></option>
						<?php
					}
				}
			  ?>
		    </select>
		  </td>
	    </tr>
		
		<input type="hidden" name="Class_No" id="Class_No" placeholder="Class_No">
		<input type="hidden" name="ExamMode" id="ExamMode" placeholder="ExamMode">
		<input type="hidden" name="view_max_markss" id="view_max_markss" placeholder="subcode">
		
		<tr>
		  <th>Sec</th>
		  <td>
		    <select class="form-control" name="sec" id="sec" onchange="secc(this.value)">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Exam Type</th>
		  <td>
		    <select class="form-control" id="exm_typ" id="exm_typ" onchange="exam_type(this.value)">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Subject</th>
		  <td>
		    <select class="form-control" id="sub" name="sub" onchange="subjectt()">
			  <option value=''>Select</option>
		    </select>
		  </td>
	    </tr>
		
		<tr>
		  <th>Sort By</th>
		  <td>
		    <select class="form-control" id="sortby" name="sortby" onchange="sorybyview(this.value)">
			  <option value=''>Select</option>
			  <option value='adm_no'>Admission No</option>
			  <option value='stu_name'>Student Name</option>
			  <option value='roll_no'>Roll No</option>
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
	      <center><h4><b><div id="view_max_marks" style="display:none; background:red; color:#fff; border-radius:5px;"></div></b></h4></center>
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
	
	
	<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Verify Marks</h4>
			  </div>
			  <div class="modal-body">
			  </div>
			  <div class="modal-footer">
				<a onclick='alert("Marks Saved Successfully")' class="btn btn-success btn-xs" data-dismiss="modal">Save</a>
				<button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Close</button>
			  </div>
			</div>
		  </div>
		</div>
	<!-- endmodal -->
	
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
  function classes(val){
	  $.post("<?php echo base_url('Marks_entry/classess'); ?>",{val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#sec").html(fill[0]);
		  $("#Class_No").val(fill[1]);
		  $("#ExamMode").val(fill[2]);
	  });
  }
  
  function secc(val){
	  var Class_No = $("#Class_No").val();
	  $.post("<?php echo base_url('Marks_entry/section'); ?>",{val:val,Class_No:Class_No},function(data){
		  $("#exm_typ").html(data);
	  });
  }
  
  function exam_type(ExamCode){
	 var Class_No = $("#Class_No").val();
	 var sec      = $("#sec").val();
	 var ExamMode = $("#ExamMode").val();
	 $.post("<?php echo base_url('marks_entry/subject'); ?>",{ExamCode:ExamCode,Class_No:Class_No,sec:sec,ExamMode:ExamMode},function(data){
		 var fill = $.parseJSON(data);
		 $("#sub").html(fill[0]);
		 $("#view_max_markss").val(fill[1]);
	 });
  }
  
  function subjectt(){
	  $("#sortby option[value='']").prop('selected', true);
  }
  
  function sorybyview(val){
	  $("#loading2").show();
	  $("#stu_list").html('');
	  var sortval  = val;
	  var opt_code = $("#sub").val();
	  var Class_No = $("#Class_No").val();
	  var sec      = $("#sec").val();
	  var exm_code = $("#exm_typ").val();
	  var ExamMode = $("#ExamMode").val();
	  var subcode = $("#sub").find(':selected').attr('data-id');
	 
	  $.post("<?php echo base_url('Marks_entry/stu_list'); ?>",{sortval:sortval,opt_code:opt_code,Class_No:Class_No,sec:sec,exm_code:exm_code,ExamMode:ExamMode,subcode:subcode},function(data){
		  $("#loading2").hide();
		  var fill = $.parseJSON(data);
		  $("#stu_list").html(fill[0]);
		  $("#view_max_marks").text(fill[1]);
		  $("#view_max_marks").show();
	  });
  }
  
  function marks(value){
	var val = value.id;
	var splt= val.split("_");
	var spltval = splt[1];
	
	var vall = $("#marks_"+spltval).val(); 
	var mxmrks = $("#view_max_marks").text();
    var splt =  mxmrks.split(" ");
	var MaxMarks = Number(splt[2]);
	
	if((MaxMarks >= vall) || (vall == 'ab') || (vall == 'AB')){
		var adm_no = $("#adm_"+spltval).val();
		var exm_typ = $("#exm_typ").val();
		var subcode = $("#sub").find(':selected').attr('data-id');
		var classs = $("#classs").val();
		var sec = $("#sec").val();
		var entr_val = $("#marks_"+spltval).val();
		var mxm = splt[2];
		$.post("<?php echo base_url('Marks_entry/sv_nd_upd'); ?>",{adm_no:adm_no,exm_typ:exm_typ,subcode:subcode,classs:classs,sec:sec,entr_val:entr_val,mxm:mxm},function(data){
			//alert(data);
		});
	}else{
		alert('Invalid Entry');
		var tmrk = $("#tmarks_"+spltval).val();
		$("#marks_"+spltval).val(tmrk);
	}
  }
  
  function approve(Class_No,sec,sorting,exm_code,subcode,trm,opt_code){
	  $.ajax({
		  url : "<?php echo base_url('Marks_entry/verifyMarks'); ?>",
		  type: "POST",
		  data: {Class_No:Class_No,sec:sec,sorting:sorting,exm_code:exm_code,subcode:subcode,trm:trm,opt_code:opt_code},
		  success:function(data){
			  $(".modal-body").html(data);
			  $("#myModal").modal({
				   backdrop: 'static',
                   keyboard: false
			  });
		  }
	  });
  }
</script>
