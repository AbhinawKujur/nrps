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

<!--four-grids here-->
<div class="panel panel-primary">
<div class="panel-heading">Copy Correction </div>	  
      <div class="panel-body" style="background-color:white;">
<div style="padding: 10px; background-color:white; border-top:3px solid #5785c3; padding:15px;">
<form method="post" action="<?=base_url('e_exam/homework/HomeworkReport/generateMarksReport');?>">
  <div class="row">
    <div class="col-sm-3">
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
	<div class='col-sm-3'>
      <label>Subject</label>
	  
      <select class='form-control' id='subject_nam'  name="subject_nam" onchange="subject_ids(this.value)" >
	  <option value="">---Select---</option>
       
      </select> 
    </div>
	
    <div class="col-sm-3">
      <label>Created Date</label>
      <select required class='form-control' id='cre_date' name="cre_date" onchange='cre_dates(this.value)' >
        <option value=''>Select</option>
      </select>
    </div>
	<div class="col-sm-3">
      <label>Target Date</label>
      <select required class='form-control' id='tar_date' name="tar_date" onchange='target_dates(this.value)' >
        <option value=''>Select</option>
      </select>
    </div>
	
   
    
  </div>
   </form>
</div>
</div>
<span id="load"></span>
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
		
		var class_code 	= $('#classes').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/homework/HomeworkReport1/stusubject'); ?>",
			type: "POST",
			data: {class_code:class_code},
			success: function(ret){
				$("#subject_nam").html(ret);
			}
		});		
	}
	
	
	function subject_ids(subject_ids){
		var class_code 	= $('#classes').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/homework/HomeworkReport1/Class_creat'); ?>",
			type: "POST",
			data: {class_code:class_code,subject_ids:subject_ids},
			success: function(ret){
				$("#cre_date").html(ret);
			}
		});
	}
	
	function cre_dates(cr_dat){
		var class_code 	= $('#classes').val();
		var subject_nam	=	 $('#subject_nam').val();
		$.ajax({
			url: "<?php echo base_url('e_exam/homework/HomeworkReport1/target_dt'); ?>",
			type: "POST",
			data: {cr_dat:cr_dat,class_code:class_code,subject_nam:subject_nam},
			success: function(ret){
				$("#tar_date").html(ret);
			}
		});
	}
	
	function target_dates(t_date){
		var class_code 	= 	$('#classes').val();
		var subject_nam	=	 $('#subject_nam').val();
		var cr_dat		=	 $('#cre_date').val();
		
		$.ajax({
			url: "<?php echo base_url('e_exam/homework/HomeworkReport1/target_dt1'); ?>",
			type: "POST",
			data: {t_date:t_date,cr_dat:cr_dat,class_code:class_code,subject_nam:subject_nam},
			success: function(ret){
				$("#load").html(ret);
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

 