<!DOCTYPE html>
<html lang="en">
<head>
  <title>Questions</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
	.btn-dangers {
		color: red;
		background-color: #eee;
		border-color: red;
		font-weight: 800;
	}
	
	.size{
		width:50px;
	}
  </style>
</head>
<body>

<nav class="navbar navbar-default" style='border-bottom:1px solid red;'>
  <div class="container-fluid">
    <ul class="nav navbar-nav pull-left">
	  <li><a href='#'><button class='btn btn-dangers'>Exam : <?php echo $examnm; ?></button></a></li>	
      <li><a href='#'><button id="countdown" class='btn btn-dangers'>00:00:00</button></a></li>
    </ul>
	<ul class="nav navbar-nav pull-right">
      <li><a href='<?php echo base_url('onlineexam/student/Questions/finalSave'); ?>' onClick="return confirm('Are you sure?')"><button class='btn btn-success btn-sm'>SUBMIT PAPER</button></a></li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
<input type='hidden' value='<?php echo $timer; ?>' id='timer'>
<!--<input type='hidden' id='start_time'  value='<?php echo date('M d, Y H:i:s'); ?>'>-->
<!-- main -->
<div id='loadQue'>	
<div class='row'>
	    <div class='col-sm-3' style='border-right:1px solid #000;'>
		<label><u>Subject : <?php echo $subjnm; ?></u></label><br />
		<!--<button class='btn btn-warning btn-xs'>Active</button>-->
		<button class='btn btn-success btn-xs'>Answered</button>
		<button class='btn btn-danger btn-xs'>Unanswered</button><br /><br />
		
		<input type='hidden' id='demo1' value=''>
		<?php
			if($exam_pattern == 2){ //MCQ
				echo "<label><u>MCQ</u></label><br />";
				foreach($getQueAndAns as $key => $val){
					if($val['exam_ptern_id'] == 2){
						if($val['qus_no'] == 1){
						?>
						<?php
							if($val['ans_status'] != 1){
						?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-warning size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
						<?php
							}else{
								?>
								<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
							}
						?>	
						<?php
						}else{
						?>
							<?php
								if($val['ans_status'] != 1){
							?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
								}else{
									?>
										<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
									<?php
								}
							?>
						<?php	
						}
					}
				}
			}else if($exam_pattern == 1){ //subjective
				echo "<label><u>SUBJECTIVE</u></label><br />";
				foreach($getQueAndAns as $key => $val){
					if($val['exam_ptern_id'] == 1){
						if($val['qus_no'] == 1){
						?>
						<?php
							if($val['ans_status'] != 1){
						?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-warning size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
						<?php
							}else{
								?>
								<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
							}
						?>	
						<?php
						}else{
						?>
							<?php
								if($val['ans_status'] != 1){
							?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
								}else{
									?>
										<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
									<?php
								}
							?>
						<?php	
						}
					}
				}
			}else if($exam_pattern == 3){ //both
				echo "<label><u>MCQ</u></label><br />";
				foreach($getQueAndAns as $key => $val){
					if($val['exam_ptern_id'] == 2){
						if($val['qus_no'] == 1){
						?>
						<?php
							if($val['ans_status'] != 1){
						?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-warning size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
						<?php
							}else{
								?>
								<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
							}
						?>	
						<?php
						}else{
						?>
							<?php
								if($val['ans_status'] != 1){
							?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
								}else{
									?>
										<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
									<?php
								}
							?>
						<?php	
						}
					}
				}
				echo "<br /><br /><label><u>SUBJECTIVE</u></label><br />";
				foreach($getQueAndAns as $key => $val){
					if($val['exam_ptern_id'] == 1){
						if($val['qus_no'] == 1){
						?>
						<?php
							if($val['ans_status'] != 1){
						?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-warning size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
						<?php
							}else{
								?>
								<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
							}
						?>	
						<?php
						}else{
						?>
							<?php
								if($val['ans_status'] != 1){
							?>
							<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-danger size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
							<?php
								}else{
									?>
										<button id='btn_<?php echo $val['qus_no']; ?>' class='btn btn-success size' onclick='showQueAns(<?php echo $val['id']; ?>,<?php echo $val['qus_no']; ?>)'><?php echo $val['qus_no']; ?></button>
									<?php
								}
							?>
						<?php	
						}
					}
				}
			}
		?>
	</div>
	<form id='ansSave' method='post' enctype='multipart/form-data'>
	<div class='col-sm-9'>
		<!--- view questions -->
			<?php
				// echo "<pre>";
				// print_r($getQueAndAns);die;
				foreach($getQueAndAns as $key => $val){
					if($val['qus_no'] == 1){
						?>
						<div class='row'>
							<div class='col-sm-10'>
								<table>
									<tr>
										<td valign="top"><h3><?php echo "Q. ".$val['qus_no']; ?>&nbsp;&nbsp;</h3></td>
										<td valign="top"><h3><?php echo $val['question']; ?></h3>
										&nbsp;&nbsp;<span style="float:right;" class='label label-danger'><?php echo "Max Marks:".$val['marks'];?></span>
										</td>
									</tr>
								</table>
							</div><!-- for question -->
							<div id="mdb-lightbox-ui"></div>
							
								<?php
									if(!empty($val['qus_img'])){
								?>
								<a href="<?php echo base_url($val['qus_img']); ?>" data-size="1600x1067">	
							<div class='col-sm-2 mdb-lightbox no-margin'>
								<img src="<?php echo base_url($val['qus_img']); ?>" class='img-responsive' style='width:100px; height:100px;'>
								</div><!-- for image -->
							</a>
								<?php } ?>
							
						</div>
						<input type='hidden' value='<?php echo $val['ans_id']; ?>' name='ans_id'>
						<input type='hidden' value='<?php echo $val['exam_ptern_id']; ?>' name='exam_pattern'>
						<input type='hidden' value='<?php echo $val['marks']; ?>' name='que_max_marks'>
						<input type='hidden' value='<?php echo $val['ans_key']; ?>' name='ans_key'>
						<input type='hidden' value='<?php echo $val['ans_status']; ?>' name='ans_status'>
						<input type='hidden' value='<?php echo $val['qus_no']; ?>' name='qus_no'>
						<?php
							if($val['exam_ptern_id'] == 2){ //MQC
								$opt_val = '';
								for($i=1; $i<=$val['obj_no_option']; $i++){
									if($i == 1){
										$opt_val = 'A';
									}else if($i == 2){
										$opt_val = 'B';
									}else if($i == 3){
										$opt_val = 'C';
									}else if($i == 4){
										$opt_val = 'D';
									}else if($i == 5){
										$opt_val = 'E';
									}
						?>
						<div class='row'>
							<div class='col-sm-6'>
								<table>
									<tr>
										<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='radio' name='opt_radio' value='<?php echo $opt_val; ?>' <?php if($opt_val == $val['ans']){echo "checked";} ?> required>&nbsp;&nbsp;</td>
										<td valign="top"><?php echo $val['option_'.$i]; ?></td>
									</tr>
								</table>
							</div><!-- for question -->
						
								
							
								<?php
									if(!empty($val['option_img_'.$i])){
								?>
								<a href="<?php echo base_url($val['option_img_'.$i]); ?>" data-size="1600x1067">
								<div class='col-sm-6 mdb-lightbox no-margin'>
								<img src='<?php echo base_url($val['option_img_'.$i]); ?>' style='width:100px; height:100px;'>
								</div><!-- for image -->
							</a>
								<?php } ?>
							
						</div>
						<?php } ?>	
						<?php 
						}else{ //subjective
							?>
							<div class='row'>
								<div class='col-sm-10'>
								
									<textarea rows='7' required name='subjectiveAns' class='form-control'><?php echo $val['ans']; ?></textarea><br />
									<input type='file' name='subjectiveImg' onchange='validateImage4()' id='img4'>
									<label id='imgq4' style='color:red; font-size:10px;'>* Only JPEG,JPG,PNG,BMP Image and file size 5 MB.</label>	
									
								</div><!-- for question -->
							
								
									<?php
										if(!empty($val['img'])){										
									?>
									<a href="<?php echo base_url($val['img']); ?>" data-size="1600x1067">	
								<div class='col-sm-2 mdb-lightbox no-margin'>
									<img src='<?php echo base_url($val['img']); ?>' style='width:100px; height:100px;'>
									</div><!-- for image -->
								</a>
									<?php } ?>
								
							</div>
							<?php
						} 
						?>	
						<?php
					}
				}
			?>
			<br />
			<div class='row'>
				<div class='col-sm-12'>
					<center><button id='btn' type='submit' class='btn btn-success'><i class="fa fa-circle-o-notch fa-spin" id='process' style='display:none'></i> SAVE & NEXT <i class="fa fa-angle-double-right"></i> </button></center>
				</div>
			</div><br /><br />
			</form>
			
		<!--- view questions -->
	</div>
</div>
</div>
<!-- main -->	
	
<!-- final exam time Modal -->
<div id="finalNotification" class="modal fade" role="dialog">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<h4 class="modal-title">Notification</h4>
	  </div>
	  <div class="modal-body">
		<h3>Your Exam is over...!</h3>
	  </div>
	  <div class="modal-footer">
		<a href='<?php echo base_url('onlineexam/student/Questions/finalSave'); ?>' class="btn btn-success"> SUBMIT PAPER</a>
	  </div>
	</div>
  </div>
</div>
<!-- end final exam time Modal -->
	
</div>

</body>
</html>
<?php
$starttime=date('Y-m-d H:i:s');	
$endtime=$timer;	

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
?> 
<span id="countdown" class="timer"></span>


<script>
var seconds = <?=$seconds;?>;
function secondPassed() {
	var hours = Math.floor(seconds / 60 / 60);
    var minutes = Math.floor(seconds / 60) - (hours * 60);
    var remainingSeconds = seconds % 60;
	
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = hours + ":" + minutes + ":" + remainingSeconds;
    if (seconds == 0) {
       // clearInterval(countdownTimer);
        $("#demo").html('');
		$("#finalNotification").modal({
			backdrop: 'static',
			keyboard: false
		});
		setTimeout(function(){ 
			window.location="<?php echo base_url('onlineexam/student/Questions/finalSave'); ?>";
		}, 5000);
    } else {
        seconds--;
    }
} 
var countdownTimer = setInterval('secondPassed()', 1000);

    /*function start_time(){
		$.ajax({
			url: "<?php echo base_url('onlineexam/student/Questions/getOnlyStartTime'); ?>",
			type: "POST",
			success: function(res){
				$("#start_time").val(res);
			}
		});	
	}*/
	
	
	//var timer = $("#timer").val();
//	
//	// Set the date we're counting down to
//	var countDownDate = new Date(timer).getTime();
//    
//	// Update the count down every 1 second
//	var x = setInterval(function() {
//		//start_time();
//		//var statTime = $("#start_time").val();
//	  // Get today's date and time
//	  var now = new Date().getTime();
//		
//	  // Find the distance between now and the count down date
//	  var distance = countDownDate - now;
//		
//	  // Time calculations for days, hours, minutes and seconds
//	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
//	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
//		
//	  // Output the result in an element with id="demo"
//	  document.getElementById("demo").innerHTML = hours + ":"
//	  + minutes + ":" + seconds + "";
//		
//	  // If the count down is over, write some text 
//	  if (distance < 0) {
//		clearInterval(x);
//		//document.getElementById("demo").innerHTML = "EXPIRED";
//		$("#demo").html('');
//		$("#finalNotification").modal({
//			backdrop: 'static',
//			keyboard: false
//		});
//		setTimeout(function(){ 
//			window.location="<?php echo base_url('onlineexam/student/Questions/finalSave'); ?>";
//		}, 5000);
//	  }
//	}, 1000);
	
	$(function () {
		$("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
	});
	
	function showQueAns(que_id,que_no){
		var demo = $("#demo1").val();
		$("#btn_1").css('background-color', '');
		$("#btn_"+demo).css('background-color', '');
		$("#btn_"+que_no).css('background-color', '#f0ad4e');
		$("#demo1").val(que_no);
		$.ajax({
			url: "<?php echo base_url('onlineexam/student/Questions/showQueAns'); ?>",
			type: "POST",
			data: {que_id:que_id,que_no:que_no},
			success: function(res){
				$("#loadQue").html(res);
			}
		});
	}
	
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
		if (file.size > 5120000) {
		$('#imgq4').html("Max Upload size is 5MB only");
			//alert('Max Upload size is 1MB only');
			document.getElementById("img4").value = '';
			return false;
		}
		return true;
	}
	
	
	$("#ansSave").on("submit", function (event) {
    event.preventDefault();
	$("#btn").prop('disabled',true);
	$("#process").show();
	let ans = $("#ans").val();
	var formData = new FormData(this);
    $.ajax({
			url: "<?php echo base_url('onlineexam/student/Questions/saveAns'); ?>",
			type: "POST",
			data:formData,
            cache:false,
            contentType: false,
            processData: false,
			success: function(data){
				$("#btn").prop('disabled',false);
				$("#process").hide();
				$("#addQuestionForm").trigger("reset");
				$("#loadQue").html(data);
			}
		});
	 });
</script>