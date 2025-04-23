<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

.badge{
	background:#C0392B;
	color:#fff;
}

.card-body ul li{
	list-style:none;
	background:#eee;
	padding:6px;
	font-size:12px;
}

.card-body ul li:hover{
	list-style:none;
	background:#eee;
	padding:6px;
	font-size:12px;
	cursor:pointer;
	box-shadow:0px 1px 13px -4px #337ab7;
}

.rply_msg{
	list-style:none;
	background:#eee;
	padding:6px;
	font-size:12px;
}

.Rrply_msg{
	list-style:none;
	background:#52BE80;
	padding:6px;
	font-size:12px;
}

a {
    color: #191a1b;
}

a:hover{
	color: #191a1b;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inbox
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-envelope-o"></i> Home</a></li>
        <li class="active">Inbox</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class='row'>
		<div class='col-md-4 col-sm-4 col-lg-4'>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4><b>Unreplied Messages</b></h4>
				</div>
				<div class="box-body">
					<?php
						if($this->session->flashdata('sms')){
							?>
								<div class="alert alert-success">
								  <?php echo $this->session->flashdata('sms'); ?>
								</div>
							<?php
						}
					?>
				<div class="accordion md-accordion" id="accordionEx1" role="tablist" aria-multiselectable="true">
				<?php
					if(!empty($chatData)){
						foreach($chatData as $key => $val){
							$admno = $val['sender_id'];
				?>
				  <div class="card">
					<div class="card-header" role="tab" id="headingTwo1">
					  <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx1" href="#collapseTwo1_<?php echo $key; ?>"
						aria-expanded="false" aria-controls="collapseTwo1">
						<h5 class="mb-0">
						  <img src='<?php echo base_url('assets/student_photo/default.jpg'); ?>' class="rounded" style='width:30px;'> <?php echo $val['firstnm']; ?> <span class="badge pull-right"><?php echo $val['cnt']; ?></span>
						</h5>
					  </a>
					</div>

					<div id="collapseTwo1_<?php echo $key; ?>" class="collapse" role="tabpanel" aria-labelledby="headingTwo1"
					  data-parent="#accordionEx1">
					  <div class="card-body">
					   <!-- body -->
					  <?php
						$smsData = $this->alam->selectA('chat_msg','*',"sender_id='$admno' AND read_status = 'N' AND sender_user = 'E' AND reply_sms_chat_id = '0'");
						if(!empty($smsData)){
							foreach($smsData as $key1 => $val1){
								?>
									<ul onclick="reply(<?php echo $val1['id']; ?>,'<?php echo $val1['sender_id']; ?>',<?php echo $val1['class']; ?>,<?php echo $val1['sec']; ?>,'<?php echo $val1['receiver_id']; ?>','<?php echo $val1['sms_text']; ?>')">
										<li>
											<a href='#'><i class="fa fa-envelope-o"></i> <?php echo $val1['sms_text']; ?> <i style='color:#C0392B;'><?php echo date('d-M',strtotime($val1['sender_date'])); ?></i> &nbsp;<i class="fa fa-reply" ></i></a>
										</li>
									</ul>
								<?php
							}
						}
					  ?>
					  <!-- end body -->
					  </div>
					</div>
				  </div>
				<?php
					   }
					}
				?> 
				
				  <!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Reply &nbsp;<i class="fa fa-reply" ></i></h4>
						  </div>
						  <div class="modal-body">
							
						  </div>
						  <div class="modal-footer">
							<button type="submit" form='replyForm' class="btn btn-success btn-sm">SEND</button>
						  </div>
						</div>
					  </div>
					</div>
					<!-- end modal -->
					
				</div>					
				</div>
			</div>
		</div>	
		
		<div class='col-md-4 col-sm-4 col-lg-4'>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4><b>Replied Messages</b></h4>
				</div>
				<div class="box-body" style='height:400px; overflow:auto;'>
					<?php
						if(!empty($replyData)){
							foreach($replyData as $key => $val){
								?>
									<ul class='rply_msg'>
										<li>
											<a href='#'><img src='<?php echo base_url('assets/student_photo/default.jpg'); ?>' class="rounded" style='width:30px;'> <?php echo $val['firstnm']; ?><br /><br /><?php echo $val['sms_text']; ?> <i style='color:#C0392B;'><?php echo date('d-M-Y',strtotime($val['sender_date'])); ?></i>
											</a>
										</li>
									</ul>
									
									<ul class='Rrply_msg'>
										<li>
											<a href='#'><img src='<?php echo base_url('assets/student_photo/default.jpg'); ?>' class="rounded" style='width:30px;'> <?php echo $val['empnm']; ?><br /><br /><?php echo $val['Rsms_text']; ?> <i style='color:#C0392B;'><?php echo date('d-M-Y',strtotime($val['Rsender_date'])); ?></i>
											</a>
										</li>
									</ul>
								<?php
								}
						}
					?>							
				</div>
			</div>
		</div>
		
		<div class='col-md-4 col-sm-4 col-lg-4'>
			<div class="box box-primary">
				<div class="box-header with-border">
					<h4><b>My Messages</b></h4>
				</div>
				<div class="box-body" style='height:400px; overflow:auto;'>
					<?php
						if(!empty($MyreplyData)){
							foreach($MyreplyData as $key => $val){
								?>
									<ul class='rply_msg'>
										<li>
											<a href='#'><img src='<?php echo base_url('assets/student_photo/default.jpg'); ?>' class="rounded" style='width:30px;'> <?php echo $val['firstnm']; ?><br /><br /><?php echo $val['sms_text']; ?> <i style='color:#C0392B;'><?php echo date('d-M-Y',strtotime($val['sender_date'])); ?></i>
											</a>
										</li>
									</ul>
									
									<ul class='Rrply_msg'>
										<li>
											<a href='#'><img src='<?php echo base_url('assets/student_photo/default.jpg'); ?>' class="rounded" style='width:30px;'> <?php echo $val['empnm']; ?><br /><br /><?php echo $val['reply_sms_text']; ?> <i style='color:#C0392B;'><?php echo date('d-M-Y',strtotime($val['Rsender_date'])); ?></i>
											</a>
										</li>
									</ul>
								<?php
								}
						}
					?>							
				</div>
			</div>
		</div>	
	</div>	
    </section>
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	 $(".alert").fadeOut(3000);
	  function reply(id,sender_id,cls,sec,receiver_id,sms_text){
		  $.post("<?php echo base_url('sms/Inbox/loadModalData'); ?>",{id:id,sender_id:sender_id,cls:cls,sec:sec,receiver_id:receiver_id,sms_text:sms_text},function(data){
			 $(".modal-body").html(data);
			 $("#myModal").modal('show');
		  });
	  }
  </script>