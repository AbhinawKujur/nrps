<style>
	form span{
		color:red;
	}
	form label{
		font-size:14px;
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
<ol class="breadcrumb" >
    <li class="breadcrumb-item"><a href="#">Class Assessment</a> <i class="fa fa-angle-right"></i> Update Exam Question </li>
	<a href="<?php echo base_url('onlineexam/teacher/addquestion/AddExamQuestion/addquestion/'.$question_list[0]['schedule_id'])?>">
		<button type="button" class="btn btn-danger btn-xs" style="float:right">Back</button></a>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
 <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-warning">
					   <?php 
					   		foreach($this->session->flashdata('msg') as $key => $val){
								echo $val."<br />";
							} 
					   ?>
					</div>
				  <?php
			  }
		?>   
	<form method="post" action="<?php echo base_url('onlineexam/teacher/addquestion/EditExamQuestion/examquestionUpdate'); ?>" enctype="multipart/form-data">
	<input type="hidden" class="form-control" name="schedule_id" value="<?=$question_list[0]['schedule_id']?>"  />
		 
		
		<div class='row'>
		<div class='col-sm-2'>
		<input type="hidden" name="qus_id" id="qus_id" class="form-control" value="<?=$question_list[0]['id']?>" readonly="" style="width:100%" />
		<input type="hidden" name="maxmark" id="maxmark" class="form-control" value="<?=$schedule[0]['max_marks']?>" readonly="" style="width:100%" />
			<label>Alloted Marks </label>
			<input type="text" name="alotmarks" id="alotmarks" class="form-control" value="<?=$allot_marks;?>" readonly="" style="width:100%" />
			
			</div>
			<div class='col-sm-2'>
				<label>Exam Pattern </label>
				<?php
				$anskey=$question_list[0]['ans_key'];
				$nooption=$question_list[0]['obj_no_option'];
				$exm_pt=$question_list[0]['exam_ptern_id'];
				if($exm_pt==1){
				?>
				<input type="text" class="form-control" value="Subjective" readonly="" style="width:100%" />				<?php
				}elseif($exm_pt==2){
				?>
				<input type="text" class="form-control" value="Objective" readonly="" style="width:100%" />				<?php
				}else{
				?>
				<select name="e_pt" id='e_pt' class="form-control" onchange="ex_pt(this.value)" style="width:100%">
					<option value="">--Select--</option>
					<option value="1">Subjective</option>
					<option value="2">Objective</option>
				</select>
				<?php } ?>
			</div>	
			
		
			<?php if($exm_pt==2){ ?>
			<div class='col-sm-2' >
			<label>No Of Option </label>
			<select name='no_option' id='no_option' class="form-control" onchange='no_options(this.value)' style="width:100%">
					<option value=''>Select</option>
					<option value='2' <?php if(isset($nooption)){if($nooption==2){echo 'selected';}} ?>>2</option>
					<option value='4' <?php if(isset($nooption)){if($nooption==4){echo 'selected';}} ?>>4</option>
					<option value='5' <?php if(isset($nooption)){if($nooption==5){echo 'selected';}} ?>>5</option>
				</select>
			</div>	
			<?php }?>
			
			
			</div><br />
		<input type="hidden" name="exam_pt" id="exam_pt" class="form-control" value="<?=$exm_pt;?>" />
		<div class='row' rows='2'>
		<div class='col-sm-9'>
			<label>Question <span>*</span></label>
				<textarea name="qustion" id="qustions" style="width:100%" required><?=$question_list[0]['question']?></textarea>
			</div>
			<br />
			<div class='col-sm-3'  >
			<label>Image </label>
				<input type="file" name="img" id="img" onchange="validateImage()" class="form-control" style="width:100%"/>
				<p style="color:#FF0000;font-size:10px" id="imgq">* Only JPEG,JPG,PNG,BMP Image.</p>
				<?php
				if(!empty($question_list[0]['qus_img'])){
				?>
				<p><a href="<?=base_url($question_list[0]['qus_img']);?>" target="_blank"><i class="fa fa-download"></i></a></p>
				<?php }?>
			</div>
			<div class='col-sm-3'>
			<label>Marks <span>*</span></label>
				<input type="number" name="marks" value="<?=$question_list[0]['marks']?>"  id='marks' required class="form-control" onkeyup="checknumber(this.value)" style="width:100%"/>
				<p id="marks_msg" style="color:red; font-size:12px"></p>
			</div>
			
					
		</div>
		<div class='row' id="opt1" style="display:none">
		<div class='col-sm-9'>
			<label>A <span>*</span></label>
				<textarea name="opt1" id="opti1" style="width:100%"><?=$question_list[0]['option_1']?></textarea>
			</div>
			
			<div class='col-sm-3'>
			<label>Image </label>
				<input type="file" name="img1" id="img1" onchange="validateImage1()" class="form-control" style="width:100%"/>
				<p style="color:#FF0000;font-size:10px" id="imgq1">* Only JPEG,JPG,PNG,BMP Image.</p>
				<?php
				if(!empty($question_list[0]['option_img_1'])){
				?>
				<p><a href="<?=base_url($question_list[0]['qus_img']);?>" download ><i class="fa fa-download"></i></a></p>
				<?php }?>
			</div>				
		</div>
		<div class='row' id="opt2" style="display:none">
		<div class='col-sm-9'>
			<label>B <span>*</span></label>
				<textarea name="opt2" id="opti2" style="width:100%"><?=$question_list[0]['option_2']?></textarea>
			</div>
			
			<div class='col-sm-3'>
			<label>Image </label>
				<input type="file" name="img2" id="img2" onchange="validateImage2()" class="form-control" style="width:100%"/>
				<p style="color:#FF0000;font-size:10px" id="imgq2"> * Only JPEG,JPG,PNG,BMP Image.</p>
				<?php
				if(!empty($question_list[0]['option_img_2'])){
				?>
				<p><a href="<?=base_url($question_list[0]['option_img_2']);?>" target="_blank"><i class="fa fa-download"></i></a></p>
				<?php }?>
			</div>				
		</div>
		<div class='row' id="opt3" style="display:none">
		<div class='col-sm-9'>
			<label>C <span>*</span></label>
				<textarea name="opt3" id="opti3" style="width:100%"><?=$question_list[0]['option_3']?></textarea>
			</div>
			
			<div class='col-sm-3' >
			<label>Image</label>
				<input type="file" name="img3" id="img3" onchange="validateImage3()" class="form-control" style="width:100%"/>
				<p style="color:#FF0000;font-size:10px" id="imgq3">* Only JPEG,JPG,PNG,BMP Image.</p>
				<?php
				if(!empty($question_list[0]['option_img_3'])){
				?>
				<p><a href="<?=base_url($question_list[0]['option_img_3']);?>" target="_blank"><i class="fa fa-download"></i></a></p>
				<?php }?>
			</div>				
		</div>
		<div class='row' id="opt4" style="display:none">
		<div class='col-sm-9'>
			<label>D <span>*</span></label>
				<textarea name="opt4" id="opti4" style="width:100%"><?=$question_list[0]['option_4']?></textarea>
			</div>
			
			<div class='col-sm-3'>
			<label>Image </label>
				<input type="file" name="img4" id="img4" onchange="validateImage4()" class="form-control" style="width:100%"/>
				<p style="color:#FF0000;font-size:10px" id="imgq4">* Only JPEG,JPG,PNG,BMP Image.</p>
				<?php
				if(!empty($question_list[0]['option_img_4'])){
				?>
				<p><a href="<?=base_url($question_list[0]['option_img_4']);?>" target="_blank"><i class="fa fa-download"></i></a></p>
				<?php }?>
			</div>				
		</div>
		<div class='row' id="opt5" style="display:none">
		<div class='col-sm-9'>
			<label>E <span>*</span></label>
				<textarea name="opt5" id="opti5" style="width:100%"><?=$question_list[0]['option_5']?></textarea>
			</div>
			
			<div class='col-sm-3' >
			<label>Image </label>
				<input type="file" name="img5" id="img5" onchange="validateImage5()" class="form-control" style="width:100%"/>
				<p style="color:#FF0000;font-size:10px" id="imgq5">* Only JPEG,JPG,PNG,BMP Image.</p>
				<?php
				if(!empty($question_list[0]['option_img_5'])){
				?>
				<p><a href="<?=base_url($question_list[0]['option_img_5']);?>" target="_blank"><i class="fa fa-download"></i></a></p>
				<?php }?>
			</div>				
		</div>
		<div class='row' id="ans" style="display:none">
		<div class='col-sm-3'>
		<lable>Answer Key</lable>
			<select name='ans_key' id='ans_key' class="form-control" style="width:100%">
					<option value=''>Select</option>
					<option id='ansa' value='A' <?php if(isset($anskey)){if($anskey=='A'){echo 'selected';}} ?>>A</option>
					<option id='ansb' value='B' <?php if(isset($anskey)){if($anskey=='B'){echo 'selected';}} ?>>B</option>					
					<option id='ansc' value='C' <?php if(isset($anskey)){if($anskey=='C'){echo 'selected';}} ?>>c</option>
					<option id='ansd' value='D' <?php if(isset($anskey)){if($anskey=='D'){echo 'selected';}} ?>>D</option>					
					<option id='anse' value='E' <?php if(isset($anskey)){if($anskey=='E'){echo 'selected';}} ?>>E</option>
					
				</select>				
		</div>
		</div>
		<div class='row'>
		<div class='col-sm-3'>		
				<button type="submit"  id="addbtn" class="btn btn-warning btn-sm" style="margin-top: 7px;"><i class="fa fa-plus">&nbsp;Update Question</i></button>	
		</div></div>		
		</form>
		<br /><br />	
		
	
	
</div><br />


	
<script type="text/javascript">
   $('.exam_date').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : true,
      aaSorting: [[0, 'asc']]
    })
  });
  
  $( document ).ready(function() {
    no_options(<?=$nooption;?>);
});
 // CKEDITOR.replace('qustion');
CKEDITOR.replace( 'qustions', { height: 120 } );

CKEDITOR.replace( 'opti1', { height: 50 } );
CKEDITOR.replace( 'opti2', { height: 50 } );
CKEDITOR.replace( 'opti3', { height: 50 } );
CKEDITOR.replace( 'opti4', { height: 50 } );
CKEDITOR.replace( 'opti5', { height: 50 } );
 
 	function no_options(n_opt){
	
	    if(n_opt==2){
			$('#opt1').show();
			$('#opt2').show();
			$('#ans').show();
			$('#opt3').hide();
			$('#opt4').hide();
			$('#opt5').hide();
			$('#ansc').show();
			$('#ansd').show();
			$('#ansc').hide();
			$('#ansd').hide();
			$('#anse').hide();
			
        } else if(n_opt==4){
		 	$('#opt1').show();
			$('#opt2').show();
			$('#opt3').show();
			$('#opt4').show();
			$('#ans').show();
			$('#opt5').hide();
			$('#ansc').show();
			$('#ansd').show();
			$('#ansc').show();
			$('#ansd').show();
			$('#anse').hide();
        }else if(n_opt==5){
			$('#opt1').show();
			$('#opt2').show();
			$('#opt3').show();
			$('#opt4').show();
			$('#opt5').show();
			$('#ans').show();
			$('#ansc').show();
			$('#ansd').show();
			$('#ansc').show();
			$('#ansd').show();
			$('#anse').show();
		}else{
			$('#opt1').hide();
			$('#opt2').hide();
			$('#opt3').hide();
			$('#opt4').hide();
			$('#opt5').hide();
			$('#ans').hide();
			
		}    
  }
  
  function ex_pt(exptt){
  	 document.getElementById("exam_pt").value = exptt;
  
  }
  
  
  
  /***************Check Allotement Marks*****************/    
       function checknumber(val){
	   if(val>0){	   
	   var	mark	=Number(val);
	   var alotmrk	=Number($('#alotmarks').val());
	   var maxmark	=Number($('#maxmark').val());
	   var tot=mark+alotmrk;
	   if(maxmark<tot){	   
	   $('#marks_msg').html("Sorry! You Can't Enter Marks for Selected Question Greater Than Max Marks!");
	   $('#marks').val('');
	   }else{
	   $('#addbtn').prop('disabled',false);
	   $('#marks_msg').html('');
	   }
	     
	   }else{
	   $('#marks_msg').html("Enter Marks Greater Than 0!");
	   $('#marks').val('');
	   } 
	   }
/*************Question Image Validation***************/	   
	   function validateImage() {
			var formData = new FormData(); 
			var file = document.getElementById("img").files[0]; 
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
				//alert('Please select a valid image file');
				$('#imgq').html("Sorry! You Can Upload '.jpg','.jpeg','.gif','.bmp' File Format Only/-");
				document.getElementById("img").value = '';
				return false;
			}
			if (file.size > 1024000) {
				//alert('Max Upload size is 1MB only');
				$('#imgq').html("Max Upload size is 1MB only");
				document.getElementById("img").value = '';
				return false;
			}
			return true;
		}
		
/*************A Image Validation***************/	   
	   function validateImage1() {
			var formData = new FormData(); 
			var file = document.getElementById("img1").files[0]; 
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
				//alert('Please select a valid image file');
				$('#imgq1').html("Sorry! You Can Upload '.jpg','.jpeg','.gif','.bmp' File Format Only/-");
				document.getElementById("img1").value = '';
				return false;
			}
			if (file.size > 1024000) {
				//alert('Max Upload size is 1MB only');
				$('#imgq1').html("Max Upload size is 1MB only");
				document.getElementById("img1").value = '';
				return false;
			}
			return true;
		}
/*************B Image Validation***************/	   
	   function validateImage2() {
			var formData = new FormData(); 
			var file = document.getElementById("img2").files[0]; 
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
			$('#imgq2').html("Sorry! You Can Upload '.jpg','.jpeg','.gif','.bmp' File Format Only/-");
				//alert('Please select a valid image file');
				document.getElementById("img2").value = '';
				return false;
			}
			if (file.size > 1024000) {
			$('#imgq2').html("Max Upload size is 1MB only");
				//alert('Max Upload size is 1MB only');
				document.getElementById("img2").value = '';
				return false;
			}
			return true;
		}
/*************C Image Validation***************/	   
	   function validateImage3() {
			var formData = new FormData(); 
			var file = document.getElementById("img3").files[0]; 
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
			$('#imgq3').html("Sorry! You Can Upload '.jpg','.jpeg','.gif','.bmp' File Format Only/-");
				//alert('Please select a valid image file');
				document.getElementById("img3").value = '';
				return false;
			}
			if (file.size > 1024000) {
			$('#imgq3').html("Max Upload size is 1MB only");
				//alert('Max Upload size is 1MB only');
				document.getElementById("img3").value = '';
				return false;
			}
			return true;
		}
/*************D Image Validation***************/	   
	   function validateImage4() {
			var formData = new FormData(); 
			var file = document.getElementById("img4").files[0]; 
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
			$('#imgq4').html("Sorry! You Can Upload '.jpg','.jpeg','.gif','.bmp' File Format Only/-");
				//alert('Please select a valid image file');
				document.getElementById("img4").value = '';
				return false;
			}
			if (file.size > 1024000) {
			$('#imgq4').html("Max Upload size is 1MB only");
				//alert('Max Upload size is 1MB only');
				document.getElementById("img4").value = '';
				return false;
			}
			return true;
		}
/*************E Image Validation***************/	   
	   function validateImage5() {
			var formData = new FormData(); 
			var file = document.getElementById("img5").files[0]; 
			formData.append("Filedata", file);
			var t = file.type.split('/').pop().toLowerCase();
			if (t != "jpeg" && t != "jpg" && t != "png" && t != "bmp" && t != "gif") {
			$('#imgq5').html("Sorry! You Can Upload '.jpg','.jpeg','.gif','.bmp' File Format Only/-");
				//alert('Please select a valid image file');
				document.getElementById("img5").value = '';
				return false;
			}
			if (file.size > 1024000) {
				//alert('Max Upload size is 1MB only');
				$('#imgq5').html("Max Upload size is 1MB only");
				document.getElementById("img5").value = '';
				return false;
			}
			return true;
		}
    
</script>