<style type="text/css">
  .table-header{
      background: #c3c7c4;
    }
    @media only screen and (max-width: 800px) {
  
  /* Force table to not be like tables anymore */
  #no-more-tables table, 
  #no-more-tables thead, 
  #no-more-tables tbody, 
  #no-more-tables th, 
  #no-more-tables td, 
  #no-more-tables tr { 
    display: block; 
  }
 
  /* Hide table headers (but not display: none;, for accessibility) */
  #no-more-tables thead tr { 
    position: absolute;
    top: -9999px;
    left: -9999px;
  }
 
  #no-more-tables tr { border: 1px solid #ccc; }
 
  #no-more-tables td { 
    /* Behave  like a "row" */
    border: none;
    border-bottom: 1px solid #eee; 
    position: relative;
    padding-left: 50%; 
    white-space: normal;
    text-align:left;
  }
 
  #no-more-tables td:before { 
    /* Now like a table header */
    position: absolute;
    /* Top/left values mimic padding */
    top: 6px;
    left: 6px;
    width: 45%; 
    padding-right: 10px; 
    white-space: nowrap;
    text-align:left;
    font-weight: bold;
  }
 
  /*
  Label the data
  */
  #no-more-tables td:before { content: attr(data-title); }
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Submitted Homework
      </h1>
      <!--<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-clipboard"></i> Home</a></li>
        <li class="active">Submitted Homework</li>
      </ol>-->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body" >
          <div class='row'>
	<div class='col-sm-7 col-md-7'>
	</div>

	<div class='col-sm-5 col-md-5'>

	</div>
</div>

<div id='loadNxtQue'>
<div class='row'>
	<div class='col-sm-9'></div>
	<div class='col-sm-3'>
		<button class='btn btn-warning btn-xs'>Active</button>
		<button class='btn btn-success btn-xs'>Answered</button>
		<button class='btn btn-danger btn-xs'>Unanswered</button>
	</div>
</div>
<div class='row'>
	<div class='col-sm-1 col-md-1'></div>
	<div class='col-sm-5 col-md-5'>
		<h3>Subjective (Click on Question No. to open)</h3>
		<?php
			foreach($subjective as $key => $val){
				
				$ansData = $this->alam->selectA('e_exam_answers_hw','id,que_id',"que_id='".$val['id']."' AND admno='$admno' AND ans_status='1'");
				$que_idd = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
				if($que_idd == $val['id']){
				?>
					<button class='btn btn-success btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php	
				}elseif($val['que_no'] == 1){
				?>
					<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php
				}else{
				?>
					<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php	
				}
			}
		?>
	</div>
	<div class='col-sm-5 col-md-5'>
		<h3>Objective</h3>
		<?php
			foreach($objective as $key => $val){
				
				$ansData = $this->alam->selectA('e_exam_answers_hw','id,que_id',"que_id='".$val['id']."' AND admno='$admno' AND ans_status='1'");
				$que_idd = (!empty($ansData[0]['que_id']))?$ansData[0]['que_id']:0;
				
				if($que_idd == $val['id']){
				?>
					<button class='btn btn-success btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php	
				}elseif($val['que_no'] == 1){
				?>
					<button class='btn btn-warning btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
				<?php
				}else{
				?>
					<button class='btn btn-danger btn-sm' onclick="queClick(<?php echo $val['e_exam_questions_hw_id']; ?>,<?php echo $val['id']; ?>,<?php echo $val['que_no']; ?>)"><?php echo "Q. ".($val['que_no']); ?></button>
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
						$img = $val['img'];
						?>
							<span style='font-size:20px;'>Q<?php echo $val['que_no']; ?>. </span>
							<span style='font-size:18px;'><?php echo $val['question']; ?></span>
					    <?php
						?>
							<br /><span style='font-size:20px;'>Ans. </span><textarea class='form-control' id='ans' rows='6' readonly><?php echo $val['ans']; ?></textarea>
		<?php if($img != ''){ ?>
							<a href='<?php echo base_url($img); ?>' target='_blank'><img src='<?php echo base_url($img); ?>' class='img-responsive' style='width:100px; height:100px;'></a><br />
							<?php } ?>
							<?php
								if($val['ans'] != ''){
							?>
							<div class='pull-right'><i><label class='label label-success'>Answered date & Time:- <?php echo date('d-M-y h:i',strtotime($val['answered_date'])); ?></label></i></div>
							<?php } ?>
							<br /><span style='font-size:20px;'>Teacher Remarks</span><textarea class='form-control' id='ans' rows='6' readonly><?php echo $val['remarks']; ?></textarea>
							
							<?php
								if($val['remarks'] == ''){
							?>
							
							<?php }else{
							?>
							<div class='pull-right'><i><label class='label label-success'>Remarks date & Time:- <?php echo date('d-M-y h:i',strtotime($val['updated_on'])); ?></label></i></div>
							<?php							
							} ?>
						<?php
					}
				}
			?>	
	</div>
	<div class='col-sm-1 col-md-1'></div>
</div><br /><br />
</div>
</div>
</div>
</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<script>
	function queClick(homeworkId,que_id,que_no){
		$("#loadNxtQue").html('');
		$.ajax({
			url: "<?php echo base_url('parent_dashboard/e_exam/homework/ViewYourHW/fetchQuestionsById'); ?>",
			type: "POST",
			data: {homeworkId:homeworkId,que_id:que_id,que_no:que_no},
			success: function(ret){
				$("#loadNxtQue").html(ret);
				$("#ans").focus();
			}
		});
	}
	
	function saveAns(qusId){
		let ans     = $("#ans").val();
		if(ans != ''){
			$.ajax({
			url: "<?php echo base_url('parent_dashboard/e_exam/homework/ViewYourHW/saveAnsByQues'); ?>",
			type: "POST",
			data: {qusId:qusId,ans:ans},
			success: function(ret){
				location.reload();
			}
		});
		}else{
			toastr.error('Please write answer first..!!!');
		}
	}
	
	function saveStatus(homework_id){
		var subjCode = $("#subjCode").val();
		var cnf = confirm("Are you sure you want to submit your homework?");
		if(cnf == true){
			$.ajax({
				url: "<?php echo base_url('parent_dashboard/e_exam/homework/ViewYourHW/exm_status'); ?>",
				type: "POST",
				data: {homework_id:homework_id},
				success: function(ret){
					window.location="<?php echo base_url('parent_dashboard/e_exam/homework/ViewYourHW'); ?>";
				}
			});
		}
	}
</script>