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
  <li class="breadcrumb-item"><a href="#">Objective Tabulation Sheet </a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
<form method="post" >
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
		<button type='button'  onclick='btn_submit()' class="btn btn-success">Display</button>
	</div>
    
  </div>
	
   </form>
   <div class="clearfix"></div><br><br>
   
	<div id='tab'></div>
	
	
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
			url: "<?php echo base_url('onlineexam/reports/MarksReportstudentanskey/Class_sec'); ?>",
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
			url: "<?php echo base_url('onlineexam/reports/MarksReportstudentanskey/subject_nam'); ?>",
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
			url: "<?php echo base_url('onlineexam/reports/MarksReportstudentanskey/examDate'); ?>",
			type: "POST",
			data: {sec_no:sec_no,class_code:class_code,subject_ids:subject_ids},
			success: function(ret){
				$("#exam_date").html(ret);
			}
		});
	}
	
	
	
	
	
	
	function btn_submit(){
	$("body").css({"opacity": "0.5"});
		var classes	=	 $('#classes').val();
		var section_id	=	 $('#section_id').val(); 
		var subject	=	 $('#subject_nam').val();
		var exam_date	=	 $('#exam_date').val();
		//alert(exam_date);
		$.ajax({
			url: "<?php echo base_url('onlineexam/reports/MarksReportstudentanskey/generateMarksReport'); ?>",
			type: "POST",
			data: {classes:classes,section_id:section_id,subject:subject,exam_date:exam_date},
			success: function(ret){
			$("body").css({"opacity": ""});

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
	
	$(document).ready(function(e) {
				
				$("#myButton").click(function(e){
					$(".table2excel").table2excel({
						exclude: ".noExl",
						name: "Excel Document Name",
						filename: "Day_Wise_Attendance_Report",
						fileext: ".xls",
						exclude_img: true,
						exclude_links: true,
						exclude_inputs: true
					});
				});
			});
     
</script>

 