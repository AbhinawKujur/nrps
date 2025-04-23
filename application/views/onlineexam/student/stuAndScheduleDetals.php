<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student's Deatils With Exam Schedule</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <style>
	body{
		background:azure;
	}
	p{
		font-family: Verdana,Geneva,sans-serif; 
	}
  </style>
</head>
<body>

<div class="container-fluid">
  <div class='row'>
	<div class='col-sm-7'><br />
		<h2 style='color:#ff4040;'><b><i class="fa fa-sticky-note"></i> GENERAL INSTRUCTIONS</b></h2><br /><br />
		<p style='font-size:20px; text-align:justify'>Click on Proceed to Exam Button for Class Assessment. <br />
		The question paper consists of 15 Questions of 1 Marks each. <br />
		You have to select the correct option/Write Answer of the questions and Click on “SAVE & NEXT” button in order to move to Next Question. After completing the Question Paper click on "SUBMIT PAPER" button. <br />
		On clicking “SUBMIT PAPER” button you will be redirected to Dashboard.<br />
		<span style='color:red'><b>NOTE:</b></span> Your answer script will be submitted automatically if not completed within stipulated time limit.</p>
	</div>
	<div class='col-sm-5' style='border-left:1px solid #000;'><br />
		<a href='<?php echo base_url('onlineexam/student/OnlineExamStu/logout'); ?>' style='color:#ff4040;' class='pull-right'><b>Logout <i class="fa fa-sign-out"></i></b></a>	
		<h2 style='color:#ff4040;'><b><i class="fa fa-user"></i> STUDENT'S DETAILS</b></h2> 
		<div class='table-responsive'>
			<table class='table table-striped'>
				<tr>
					<td><b>Name</b></td>
					<td><b>:</b></td>
					<td><?php echo $stuDetails[0]['FIRST_NM']; ?></td>
				</tr>
				<tr>
					<td><b>Admission No.</b></td>
					<td><b>:</b></td>
					<td><?php echo $stuDetails[0]['ADM_NO']; ?><input type='hidden' id='admno' value='<?php echo $stuDetails[0]['ADM_NO']; ?>'></td>
				</tr>
				<tr>
					<td><b>Class/Sec. </b></td>
					<td><b>:</b></td>
					<td><?php echo $stuDetails[0]['DISP_CLASS'].'/'.$stuDetails[0]['DISP_SEC']; ?></td>
				</tr>
				<tr>
					<td><b>Roll No.</b></td>
					<td><b>:</b></td>
					<td><?php echo $stuDetails[0]['ROLL_NO']; ?></td>
				</tr>
			</table>
		</div><br /><br />
		<?php
			if($this->session->userdata('msg')){
				?>
					<div class="alert alert-danger" role="alert">
					  <b><?php echo $this->session->userdata('msg'); ?></b>
					</div>
				<?php
			}
		?>
		<div class='table-responsive'>
			<table class='table table-striped'>
				<tr style='background:#b8e4a6;'>
					<th colspan='4' style='text-align:center'>EXAM SCHEDULE ( <span style='color:green'><?php echo date('d-M-Y'); ?></span> )</th>
				</tr>
				<tr style='background:#e2e2ec'>
					<th>SUBJECT</th>
					<th>EXAM TIME</th>
				</tr>
				<?php
					$cnt = count($getSchedule);
					foreach($getSchedule as $key => $val){
						?>
							<tr>
								<td><?php echo $val['subjnm']; ?></td>
								<td><?php echo $val['start_time'].' <b>to</b> '.$val['end_time']; ?></td>
							</tr>
						<?php
					}
				?>
				<?php
					if($cnt != 0){
				?>
				<tr>
					<td colspan='4' align='center'><button class='btn btn-danger' onclick='proceedExam()'>Proceed To Exam <i class="fa fa-sign-in"></i></button></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
  </div>
</div>

<!-- exam start warning Modal -->
<div id="ExamModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-sticky-note" style='color:#ff4040'></i> <span style='color:#ff4040'>NOTIFICATION</span></h4>
      </div>
      <div class="modal-body">
        <h3><i class="fa fa-thumbs-up" style='color:#ff4040; font-size:25px;'></i> Exams is going to start. Please wait for a while...!</h3>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- end exam start warning Modal -->

<!-- before exam start warning Modal -->
<div id="beforeExamModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-sticky-note" style='color:#ff4040'></i> <span style='color:#ff4040'>NOTIFICATION</span></h4>
      </div>
      <div class="modal-body">
        <h3 id='txt'></h3>
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end before exam start warning Modal -->
</body>
</html>
<?php


$starttime	=date('Y-m-d H:i:s');	
$endtime	=$startdatetime; 	
if($startdatetime!=0){
	
// Declare and define two dates 
$date1 = strtotime($starttime); 
$date2 = strtotime($endtime); 
// Formulate the Difference between two dates 
$diff = abs($date2 - $date1); 
// To get the year divide the resultant date into 
// total seconds in a year (365*60*60*24) 
$years = floor($diff / (365*60*60*24)); 
// To get the month, subtract it with years and 
// divide the resultant date into 
// total seconds in a month (30*60*60*24) 
$months = floor(($diff - $years * 365*60*60*24) 
							/ (30*60*60*24)); 
// To get the day, subtract it with years and 
// months and divide the resultant date into 
// total seconds in a days (60*60*24) 
$days = floor(($diff - $years * 365*60*60*24 - 
			$months*30*60*60*24)/ (60*60*24)); 
// To get the hour, subtract it with years, 
// months & seconds and divide the resultant 
// date into total seconds in a hours (60*60) 
$hours = floor(($diff - $years * 365*60*60*24 
	- $months*30*60*60*24 - $days*60*60*24) 
								/ (60*60)); 
								
// To get the minutes, subtract it with years, 
// months, seconds and hours and divide the 
// resultant date into total seconds i.e. 60 
$minutes = floor(($diff - $years * 365*60*60*24 
		- $months*30*60*60*24 - $days*60*60*24 
						- $hours*60*60)/ 60); 
// To get the minutes, subtract it with years, 
// months, seconds, hours and minutes 
$seconds = floor($diff - $years * 365*60*60*24 ); 

//echo $duration= $hours.':'.$minutes.':'.$seconds;
 $seconds;
}else{
	$seconds='';
}
?> 
<span id="countdown" class="timer" style="display:none;"></span>
<script>
var seconds = <?=$seconds;?>;
function secondPassed() {
	var admno = $("#admno").val();
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
    if (seconds == 0) {
       // clearInterval(countdownTimer);
        $("#ExamModal").modal({
			backdrop: 'static',
			keyboard: false	
		});
		$.ajax({
			url: "<?php echo base_url('onlineexam/student/OnlineExamStu/chkDateTimeAdm'); ?>",
			type: "POST",
			data: {admno:admno},
			success: function(res){
				setTimeout(function(){ 
					$("#ExamModal").modal('hide');
						window.location="<?php echo base_url('onlineexam/student/Questions'); ?>";	
					}, 5000);
			}
		});
		
    } else {
        seconds--;
    }
}
 
var countdownTimer = setInterval('secondPassed()', 1000);

	
	
	function proceedExam(){
		var admno = $("#admno").val();
		$.ajax({
			url: "<?php echo base_url('onlineexam/student/OnlineExamStu/proceedToExam'); ?>",
			type: "POST",
			data: {admno:admno},
			success:function(res){
				if(res == 1){
					window.location="<?php echo base_url('onlineexam/student/Questions'); ?>";
				}else if(res == 2){
					$("#txt").text('Dear Student, Please wait for a while. Your exam will start Shortly ..!');
					$("#beforeExamModal").modal({
						backdrop: 'static',
						keyboard: false	
					});
				}else if(res == 3){
					$("#txt").text('Your Exam is Over...!');
					$("#beforeExamModal").modal({
						backdrop: 'static',
						keyboard: false	
					});
				}else if(res == 4){
					$("#txt").text('MAC');
					$("#beforeExamModal").modal({
						backdrop: 'static',
						keyboard: false	
					});
				}else{
					$("#txt").text('Dear Student, Please wait for a while. Your exam will start Shortly ..!');
					$("#beforeExamModal").modal({
						backdrop: 'static',
						keyboard: false	
					});
				}
			}
		});
	}

	setInterval(function(){ 
		chkDateTimeAdmno();
	}, 5000);
</script>
