<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
span.man{
	color:red;
	font-size:10px;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">e-Learning</a> <i class="fa fa-angle-right"></i> Upload/View e-Content </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-4'>
	    <?php
			  if($this->session->flashdata('msg')){
				  ?>
				    <div class="alert alert-success">
					   <?php echo $this->session->flashdata('msg'); ?>
					</div>
				  <?php
			  }
		?>
		<div id='load'>
		<form id='eLearningForm' method='post' enctype='multipart/form-data'>
		<table class='table'>
		<!--<input type='hidden' name='class' value='<?php //echo $clasa_no; ?>'>
		<input type='hidden' name='sec' value='<?php //echo $sec_no; ?>'>-->
		<input type='hidden' name='date' value='<?php echo $date; ?>'>
			<tr>
				<th>Class <span class='man'>*</span></th>
				<td>
					<select class='form-control' name='class' id='cls' required onchange='clses(this.value)'>
						<option value=''>Select</option>
						<?php
							if($classData){
								foreach($classData as $key => $val){
									?>
										<option value='<?php echo $val['Class_no']; ?>'><?php echo $val['classnm']; ?></option>
									<?php
								}
							}
						?>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Section <span class='man'>*</span></th>
				<td>
					<select class='form-control' name='sec' id='section' required onchange='sectn(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Subject <span class='man'>*</span></th>
				<td>
					<select class='form-control' name='subject' required id='subj' onchange='getChapter(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Chapter <span class='man'>*</span></th>
				<td>
					<select class='form-control' name='chapter' id='chapter' required onchange='getTopic(this.value)'>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Topic <span class='man'>*</span></th>
				<td>
					<select class='form-control' name='topic' id='topic' required>
						<option value=''>Select</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th>Remarks <span class='man'>*</span></th>
				<td>
					<textarea class='form-control' name='notice' id='notice' required rows='5'></textarea>
				</td>
			</tr>
			
			<tr>
				<th>YouTube Link</th>
				<td>
					<input type='text' class='form-control' name='link' id='link'>
				</td>
			</tr>
			
			<tr>
				<th>Attachment </th>
				<td>
					<input type='file' name='img[]' id='img' multiple class='form-control'>
					<span style='color:red; font-size:12px;'>
					File size must be less than 3000kb and only allowed jpg,jpeg,png,doc,docx,pdf,txt,ppt format<br />
					<b>Note:-</b><p>Use Multiple file select with CTRL button</p>
					</span>
				</td>
			</tr>
			
			<tr style='display:none;'>
				<th>All Students </th>
				<td>
					<input type='radio' value='1' name='selectAll' onclick='SelectAll(this.value)' id='rad1' checked>YES
					&nbsp;&nbsp;&nbsp;
					<input value='0' name='selectAll' type='radio' onclick='SelectAll(this.value)' id='rad2'>NO
			    </td>
			</tr>
			
			<tr id='dropdown' style='display:none;'>
				<td colspan='2'>
					<select id="multiselect" multiple="multiple" class='form-control' style='width:100%' name='selectParticultStu[]' disabled>
						<option value="">Select</option>
						<?php
							foreach($stuData as $key => $val){
								?>
									<option value='<?php echo $val['STUDENTID']; ?>'><?php echo $val['ADM_NO'].' ('.$val['FIRST_NM'].')'?></option>
								<?php
							}
						?>
                    </select>
				</td>
			</tr>
			
			<tr>
				<td colspan='2'><center><button id='btn' class='btn btn-success btn-sm'><i class="fa fa-circle-o-notch fa-spin" id='process' style='color:#fff; display:none'></i> Send </button></center></td>
			</tr>
		</table>
		</form>
		</div>
	</div>
	
    <div class='col-sm-8'>
    <div class='table-responsive' id='loadTopic'>
	<table class='table dataTable'>
	<thead>
		<tr>
			<th style='color:#fff !important; background:#5785c3;'>Date of Upload</th>
			<th style='color:#fff !important; background:#5785c3;'>Class</th>
			<th style='color:#fff !important; background:#5785c3;'>Sec</th>
			<th style='color:#fff !important; background:#5785c3;'>Subject</th>
			<th style='color:#fff !important; background:#5785c3;'>Chapter</th>
			<th style='color:#fff !important; background:#5785c3;'>Topic</th>
			<th style='color:#fff !important; background:#5785c3;'>Remarks</th>
			<th style='color:#fff !important; background:#5785c3;'>Files</th>
		</tr>
	</thead>	
	<tbody>
		<?php
		    $tDate = strtotime(date('Y-m-d'));
			foreach($eLearningData as $key => $val){
				if($val['emp_id'] == $login_id){
				?>
					<tr>
						<td><?php echo date(('d-M'),strtotime($val['date'])) ?></td>
						<td><?php echo $val['disp_class']; ?></td>
						<td><?php echo $val['disp_sec']; ?></td>
						<td><?php echo $val['subjectnm']; ?></td>
						<td><?php echo $val['chapternm']; ?></td>
						<td><?php echo $val['topic']; ?></td>
						<td><?php echo $val['remarks']; ?></td>
						<td>
							<?php 
								$imgData = unserialize($val['img']); 
								foreach($imgData as $key => $val){
									?>
										<br /><span style='font-size:10px;'>FILE</span> <?php echo $key + 1; ?><a download href='<?php echo base_url($val); ?>'> <i class="fa fa-download" style='color:red'></i></a>
									<?php
								}
							?>
						</td>
					</tr>
				<?php
				}
			}
		?>
	</tbody>	
	</table>
	</div>
	</div>
	</div>
	</div><br />
	
<script type="text/javascript">
   $(".alert").fadeOut(3000);
   $('.dt').datepicker({ format: 'dd-M-yyyy',autoclose: true, startDate:new Date() });
   $("#multiselect").select2();
	
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
  function SelectAll(value){
	  if(value == 0){
		$("#dropdown").show();
		$("#multiselect").prop('disabled',false);
		$("#multiselect").prop('required',true);
	  }else{
		$("#dropdown").hide();    
		$("#multiselect").prop('disabled',true);
		$("#multiselect").prop('required',false);
	  }
  }

  function edit(id){
	  $.post("<?php echo base_url('e_learning/Elearning/noticeEdit'); ?>",{id:id},function(data){
		  $("#load").html(data);
	  });
  }
  
  function clses(val){
	  $.post("<?php echo base_url('e_learning/Elearning/loadSec'); ?>",{class_id:val},function(data){
		  $("#section").html(data);
	  });
  }
  
  function sectn(val){
	  var cls = $("#cls").val();
	  $.post("<?php echo base_url('e_learning/Elearning/loadSubj'); ?>",{sec_id:val,cls:cls},function(data){
		  $("#subj").html(data);
	  });
  }
   
   $("#img").change(function(){
		var file_size = $('#img')[0].files[0].size;
		var ext = $('#img').val().split('.').pop().toLowerCase();
			let extensions = ['png', 'pdf', 'jpg', 'jpeg', 'doc', 'docx', 'pptx', 'mp4'];
			if(file_size > 52428800){
				alertMessage('Error', 'File size must be less than 50MB', 'error');
				$("#img").val('');
			}else if(extensions.indexOf(ext) < 0){
				alertMessage('Error', 'File type must be jpg,jpeg,png,doc,docx,pdf,txt,ppt format', 'error');
				$("#img").val('');
			}
		return true;
	});
   
   function expired(){
   $.toast({
		heading: 'Warning',
		text: 'Submission Date Expired',
		showHideTransition: 'slide',
		icon: 'warning',
		position: 'top-right',
	});
   }
   
   function disabled(){
		$(".btn").attr('disabled',true);
	}
	
	function sub_date(){
	   $(".btn").attr('disabled',false);
   }
   
   function getChapter(val){
	   var cls = $("#cls").val();
	   var sec = $("#section").val();
	   
	   $.post("<?php echo base_url('e_learning/Elearning/getChapterTopic'); ?>",{cls:cls,sec:sec,val:val},function(data){
		  var fill = $.parseJSON(data);
		  $("#chapter").html(fill[0]);
	  });
   }
   
   function getTopic(value){
	   $.post("<?php echo base_url('e_learning/Elearning/getTopicData'); ?>",{chapterId:value},function(data){
		  $("#topic").html(data);
	  });
   }
   
   $("#eLearningForm").on("submit", function (event) {
    event.preventDefault();
	$("#btn").prop('disabled',true);
	$("#process").show();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('e_learning/Elearning/saveHomework'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				$("#btn").prop('disabled',false);
				$.toast({
					heading: 'success',
					text: 'Topic Successfully Sent',
					showHideTransition: 'slide',
					icon: 'success',
					position: 'top-right',
				});
				$("#process").hide();
				$("#eLearningForm").trigger("reset");
				$("#rad1").prop("checked", true);
				$("#multiselect").empty();
				$("#loadTopic").html(data);
			}
		});
	 });
	 
	 function alertMessage(heading, text, icon){
		 $.toast({
			heading: heading,
			text: text,
			showHideTransition: 'slide',
			icon: icon,
			position: 'top-right',
		});
	 }
</script>