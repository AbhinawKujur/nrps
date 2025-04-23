<?php
	if(!empty($classWiseQuestions[0]['examTime'])){
?>
<div class='container'>
<div class='row'>
	<div class='col-sm-7 col-md-7'>
	<input type='hidden' value='<?php echo $endtime; ?>' id='timer'>
	<input type='hidden' value='<?php echo $subjCode; ?>' id='subjCode'>
		
        <label style="margin-left: 29px;font-size: 12px;color: red;">
           Remaining Time: 
		</label>
		<div id="demo" style="margin-left: 29px;font-size: 25px;color: red;"></div>
		<script>
			var timer = $("#timer").val();
			// Set the date we're counting down to
			var countDownDate = new Date(timer).getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get today's date and time
			  var now = new Date().getTime();
				
			  // Find the distance between now and the count down date
			  var distance = countDownDate - now;
				
			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				
			  // Output the result in an element with id="demo"
			  document.getElementById("demo").innerHTML = hours + ":"
			  + minutes + ":" + seconds + "";
				
			  // If the count down is over, write some text 
			  if (distance < 0) {
				clearInterval(x);
				//document.getElementById("demo").innerHTML = "EXPIRED";
				$("#demo").html('');
				$("#finalNotification").modal({
					backdrop: 'static',
					keyboard: false
				});
			  }
			}, 1000);
		</script>

		<!-- final exam time Modal -->
		<div id="finalNotification" class="modal fade" role="dialog">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title">Notification</h4>
			  </div>
			  <div class="modal-body">
				<h3>Your Exam Duration is over..!</h3>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-success" onclick="saveStatus('modal')">SUBMIT</button>
			  </div>
			</div>
		  </div>
		</div>
		<!-- end final exam time Modal -->
	</div>

	<div class='col-sm-5 col-md-5'>
		<label>Exam Time:- <?php echo (!empty($classWiseQuestions[0]['examTime']))?$classWiseQuestions[0]['examTime']:''; ?></label>,&nbsp;&nbsp
		<label>Exam Duration:- <?php echo (!empty($classWiseQuestions[0]['examTimeDuration']))?$classWiseQuestions[0]['examTimeDuration']."Min":''; ?></label> <br />
		<button class='btn btn-warning btn-xs'>Active</button>
		<button class='btn btn-success btn-xs'>Answered</button>
		<button class='btn btn-danger btn-xs'>Unanswered</button>
	</div>
</div>

<div id='loadNxtQue'>
<div class='row'>
	<div class='col-sm-1 col-md-1'></div>
	<div class='col-sm-5 col-md-5'>
		<h3>Subjective (Click on Question No. to open)</h3>
		<?php
			$subjTotal = array();
			foreach($subjective as $key => $val){
				if($val['que_no'] == 1){
				?>
					<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php
				}else{
				?>
					<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php	
				}
			}
		?>
	</div>
	<div class='col-sm-5 col-md-5'>
		<h3>Objective</h3>
		<?php
			foreach($objective as $key => $val){
				if($val['que_no'] == 1){
				?>
					<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php
				}else{
				?>
					<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php	
				}
			}
		?>
	</div>
	<div class='col-sm-1 col-md-1'></div>
</div><br /><br />

<div class='row'>
	<div class='col-sm-1 col-md-1'></div>
	<div class='col-sm-10 col-md-10'>
			<?php
				foreach($classWiseQuestions as $key => $val){
					if($val['que_no'] == 1){
						?>
							<span style='font-size:20px;'>Q<?php echo $val['que_no']; ?>. </span>
							<span style='font-size:18px;'><?php echo $val['question']; ?></span>
					    <?php
						?>
							<br /><span style='font-size:20px;'>Ans. </span><textarea class='form-control' id='ans' rows='6'></textarea><br />
							<center><button class='btn btn-success' onclick="saveAns(<?php echo $val['id']; ?>,<?php echo $val['subject']; ?>,<?php echo $val['que_no'] + 1; ?>,<?php echo $mxno; ?>)">SAVE</button><button class='btn btn-info pull-right' onclick="saveStatus('top')" style='background:#3c8dbc;'>SUBMIT PAPER</button></center>
							
						<?php
					}
				}
			?>	
			<b style='color:red'>Note: <br />1. Click on Question No. to give the answer and click on Save Button. </b><br />
			<b style='color:red'>2. After completion of all the answers, click on "SUBMIT PAPER" Button. </b><br />
			<b style='color:red'>3. If Exam time is started, you can't go through other menu. </b>
	</div>
	<div class='col-sm-1 col-md-1'></div>
</div><br /><br />
</div>
<?php }else{ ?>
	<center><h2>Dear Student, Please wait for a while. Your exam will start Shortly</h2></center>
<?php } ?>
</div>

<script>
	function queClick(questionId,subj_id){
		$("#loadNxtQue").html('');
		$.ajax({
			url: "<?php echo base_url('parent_dashboard/e_exam/Questions/fetchQuestionsById'); ?>",
			type: "POST",
			data: {questionId:questionId,subj_id:subj_id},
			success: function(ret){
				$("#loadNxtQue").html(ret);
				$("#ans").focus();
			}
		});
	}
	
	function saveAns(qusId,subj_id,que_no,mxno){
		let ans     = $("#ans").val();
		if(ans != ''){
			$.ajax({
			url: "<?php echo base_url('parent_dashboard/e_exam/Questions/saveAnsByQues'); ?>",
			type: "POST",
			data: {qusId:qusId,subj_id:subj_id,ans:ans},
			success: function(ret){
				$("#ans").val('');
				$("#loadNxtQue").html(ret);
				
				toastr.success('Answer saved..!!!');
				queClick(qusId,subj_id);
				// if(mxno == que_no){
					// saveStatus('top');
				// }
			}
		});
		}else{
			toastr.error('Please write answer first..!!!');
		}
	}
	
	function saveStatus(val){
		var subjCode = $("#subjCode").val();
		if(val == 'top'){
			var cnf = confirm("Are you sure you want to submit your paper?");
			if(cnf == true){
				$.ajax({
					url: "<?php echo base_url('parent_dashboard/e_exam/Questions/exm_status'); ?>",
					type: "POST",
					data: {subjCode:subjCode},
					success: function(ret){
						window.location="<?php echo base_url('Parentlogin/parent_dashboard'); ?>";
					}
				});
			}
		}else{
			$.ajax({
				url: "<?php echo base_url('parent_dashboard/e_exam/Questions/exm_status'); ?>",
				type: "POST",
				data: {subjCode:subjCode},
				success: function(ret){
					window.location="<?php echo base_url('Parentlogin/parent_dashboard'); ?>";
				}
			});
		}
	}
</script>