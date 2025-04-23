<style>
  table tr td,th{
	  color:#000!important;
  }
  table thead tr th{
	  background:#337ab7 !important;
	  color:#fff !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>
<?php $t=""; ?>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Consolidated Marksheet </a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
<form method="post" action="<?=base_url('e_exam/MarksReportstu/generateMarksReport');?>">
  <div class="row">
    <div class="col-sm-2">
      <label>Class</label>
      <select required class='form-control' id='classes' name="classes" onchange='classess(this.value)'>
        <option value=''>Select</option>
        <?php
		foreach($class_no as $key => $val){
		?>
        <option value='<?php echo $val['Class_No']; ?>'><?php echo $val['CLASS_NM']; ?></option>
        <?php
		}
		?>
      </select>
    </div>
    <div class="col-sm-2">
      <label>Section</label>
      <select required class='form-control' id='section_id' name="section_id" onchange='section_sec(this.value)' >
        <option value=''>Select</option>
      </select>
    </div>
	<div class='col-sm-3'>
      <label>Subject</label>
      <select required class='form-control' id='subject_nam' name="subject" onchange="subject_ids(this.value)" >
        <option value=''>Select</option>
      </select> 
    </div>
	<div class='col-sm-3'>
      <label>Exam Date</label>
      <select class='form-control' id='exam_date' name="exam_date"  >
        <option value=''>Select</option>
      </select> 
    </div>
    <div class="col-sm-2"><br />
		<button type="submit" name="submit" class="btn btn-success">Display</button>
	</div>
    
  </div>
   </form>
   <div class="clearfix"></div><br><br>
   <?php
	if(!empty($stuList)){
		?>
		<input type="button" value="Print" class="btn btn-success btn-sm" onclick="printDiv()"><br><br>
		<div id="GFG">
		<table class='table' width="100%" cellspacing="0">
			<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid"><img src='<?php echo base_url('assets/school_logo/dps.png'); ?>' class='img-responsive'></td><td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid" colspan="3"><center style="font-size:30px"><strong>Delhi Public School, Ranchi</strong><center></td>
					</tr>
					<tr>					
					<td style="background:#5785c3; color:#fff!important;border-left: 1px solid;border-bottom:1px solid" colspan="2">Class : <?=$classes;?>-<?=$section;?>&nbsp;&nbsp;</td>
					<td style="background:#5785c3; color:#fff!important;border-bottom:1px solid;text-align:center">
					<?=$Sujects;?></td>
					<td style="background:#5785c3; color:#fff!important;border-right: 1px solid;border-bottom:1px solid"><span style="float: right;">Exam Date:&nbsp;<?=date('d-M-Y',strtotime($exam_date));?></span>
					</td>
					</tr>
				<tr>					
					
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Adm. No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Roll No.</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Name of Student</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Marks Obtained</strong></td>
				</tr>
				<?php
				$c=0;
				foreach($stuList as $key=>$val){
				?>
				<tr>				
				
				<td style="border: 1px solid ;"><?=$val['ADM_NO'];?></td>
				<td style="border: 1px solid ;"><?=$val['ROLL_NO'];?></td>
				<td style="border: 1px solid ;"><?=$val['FIRST_NM'];?></td>
				<td style="border: 1px solid ;"><?if(!empty($val['obt_marks'])){echo $val['obt_marks'];}else{ echo "<span style='color:red'>Not Appeared</span>";}?></td>
				</tr>
	<?php	}?>
</table>
<?php	}

  ?>
  
</div>
<br />
<br />
<div class="clearfix"></div>
<!--inner block start here-->
<div class="inner-block"> </div>
<!--inner block end here-->
<!--copy rights start here-->
<script>
	function classess(class_code){
		
		$.ajax({
			url: "<?php echo base_url('e_exam/MarksReportstu/Class_sec'); ?>",
			type: "POST",
			data: {class_code:class_code},
			success: function(ret){
				$("#section_id").html(ret);
			}
		});
	}
	
	function section_sec(sec_no){
		var class_code = $('#classes').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/MarksReportstu/subject_nam'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code},
			success: function(ret){
				$("#subject_nam").html(ret);
			}
		});
	}
	
	
	
	function subject_ids(subject_ids){
		var class_code 	= $('#classes').val();
		var sec_no 		= $('#section_id').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/MarksReportstu/examDate'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code,subject_ids:subject_ids},
			success: function(ret){
				$("#exam_date").html(ret);
			}
		});
	}
	
	
	
	
	
	
	function btn_submit(){
		var class_id	=	 $('#classes').val();
		var section_id	=	 $('#section_id').val(); 
		var subject_nam	=	 $('#subject_nam').val();
		
		$.ajax({
			url: "<?php echo base_url('e_exam/MarksReportstu/generateMarksReport'); ?>",
			type: "POST",
			data: {class_id:class_id,section_id:section_id,subject_nam:subject_nam},
			success: function(ret){
				$("#tab").html(ret);
			}
		});
	}
	
	function alert_msg(head,text,icon){
		$.toast({
			heading: head,
			text: text,
			showHideTransition: 'slide',
			icon: icon,
			position: 'top-right',
		});
	}
	
	
	
        function printDiv() { 
            var divContents = document.getElementById("GFG").innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write('<html>'); 
            //a.document.write('<body > <h1>Div contents are <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
     
</script>

 