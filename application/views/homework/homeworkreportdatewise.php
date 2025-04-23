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
  .download-file-color-change{
    -webkit-animation: color-change 1s infinite;
    -moz-animation: color-change 1s infinite;
    -o-animation: color-change 1s infinite;
    -ms-animation: color-change 1s infinite;
    animation: color-change 1s infinite;
}

@-webkit-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-moz-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-ms-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@-o-keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
@keyframes color-change {
    0% { color: red; }
    50% { color: blue; }
    100% { color: red; }
}
</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Date wise Homework Report  </a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
   
<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;"> 
<form method="post" action="<?=base_url('homework/Homeworkreport/homeworkreportlist')?>">
  <div class="table-responsive">
   
  <div class="col-sm-3"><label>Homework Date</label>
  <input type="text" value="<?php if(isset($_POST['hwdate'])){echo $_POST['hwdate'];}else{ echo date('d-M-Y');}?>" name="hwdate" readonly class="form-control datepicker">
  </div>  
  <div class="col-sm-3"><br>
  <button type="submit" style="border-radius: 9px;margin-top: 3px;" class="btn btn-danger">Submit</button></div>
 </div>
 </form>
 <hr>
 <?php
 if(!empty($hwdetails)){
 ?>
		 	<table class='table'>
			<tr>
			<td></td>
			</tr>
				<tr>
				<td style='background:#5785c3; color:#fff!important;border: 1px solid;'>#</strong></td>
										
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Teacher Name</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Class-Sec</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'>Subject</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'>Homework Date</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Submission date</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Remarks</strong></td>
					<td style='background:#5785c3; color:#fff!important;border: 1px solid;'><strong>Attachment</strong></td>
										
				</tr>
				<?php
				
				$c=0;
				foreach($hwdetails as $key=>$vals){
					 $hwdate	= $vals['date'];
					 $emp_id	= $vals['emp_id'];
					 $employee	= $this->alam->selectA('employee','*',"EMPID='$emp_id'");
					 $sub_id	= $vals['subject'];
					 $subject	= $this->alam->selectA('subjects','*',"SubCode='$sub_id'");		 
					 $submission_date= $vals['submission_date'];
					 $Class_No		= $vals['class'];
					 $section_no	= $vals['sec'];
					 $class	= $this->alam->selectA('classes','*',"Class_No='$Class_No'");
					 $sec	= $this->alam->selectA('sections','*',"section_no='$section_no'");
					 $remarks	= $vals['remarks'];
					 $img	= $vals['img'];
				?>
				<tr>
					<td style='border: 1px solid #d6cece;'><?=++$c;?></td>						
					<td style='border: 1px solid #d6cece;'><?=$employee[0]['EMP_FNAME']?></td>
					<td style='border: 1px solid #d6cece;'><?=$class[0]['CLASS_NM']?>-<?=$sec[0]['SECTION_NAME']?></td>
					<td style='border: 1px solid #d6cece;'><?=$subject[0]['SubName']?></td>
					<td style='border: 1px solid #d6cece;'><?=date('d-M-Y',strtotime($hwdate))?></td>
					<td style='border: 1px solid #d6cece;'><?=date('d-M-Y',strtotime($submission_date))?></td>
					<td style='border: 1px solid #d6cece;'><?=$remarks?></td>					
					<td style='border: 1px solid #d6cece;'><?php 
								$imgList = unserialize($img);
								if(!empty($imgList)){
								foreach($imgList as $key => $val){
								 ?> 
								    <br />
									<a href="<?php echo base_url($val); ?>" class="download-file-color-change" target="_blank"><span>File <?php echo $key + 1; ?></span> <i class="fa fa-download" title='DOWNLOAD FILE'></i></a>
								<?php }  }else{echo "No Attachment";}
								
								?></td>					
				</tr>
						
				<?php
				}
				
				?>
				
			</table> 
    <?php
				
				}else{
				echo "<span class='download-file-color-change'><center>NO RECORD FOUND.....</center></span>";
					
				}
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
	
	$('.datepicker').datepicker({
      format: 'dd-M-yyyy',
      autoclose: true,
      orientation: "bottom",
      todayHighlight: true,
});

	

	
	
</script>
