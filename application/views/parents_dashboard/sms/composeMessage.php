<style>
form i{
	color:blue;
}
</style>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Compose Message
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-envelope-o"></i> Home</a></li>
        <li class="active">Compose Message</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	<div class='row'>
		<div class='col-md-4 col-sm-4 col-lg-4'>
			<div class="box box-primary">
				<div class="box-header with-border">
				  <?php
				    if($this->session->flashdata('msg')){
				  ?>
				  <div class="alert alert-success">
					  <?php echo $this->session->flashdata('msg'); ?>
				  </div>
				  <?php } ?>
				</div>
				<div class="box-body">
					<form action="<?php echo base_url('parent_dashboard/sms/ComposeMessage/composeMsgSave'); ?>" autocomplete='off' method='POST'>
					  <div class="form-group">
						<label>Text Message:</label>
						<textarea class="form-control" name='text_msg' required></textarea>
					  </div>
					  <div class="form-group">
						<label>Send To:</label><br />
						
						<input type='checkbox' value='<?php echo $user_id; ?>' name='send_to[]' checked > Class Teacher &nbsp;(<i><?php echo $emp_name; ?></i>)<br />
						<!-- section incharge -->
						<?php
							if(!empty($SEC_EMPID)){
						?>
						<input type='checkbox' value='<?php echo $SEC_EMPID; ?>' name='send_to[]'> Section In-Charge &nbsp;(<i><?php echo $secInchagreNm; ?></i>)<br />
						<?php } ?>
						<!-- section incharge -->
						
						<!-- vice Principal -->
						<?php
							if(!empty($VICE_PRI_EMPID)){
						?>
						<input type='checkbox' value='<?php echo $VICE_PRI_EMPID; ?>' name='send_to[]'> Vice Principal &nbsp;(<i><?php echo $vicePrincipalNm; ?></i>)<br />
						<?php } ?>
						<!-- vice Principal -->
						
						<!-- Principal -->
						<?php
							if(!empty($PRI_EMPID)){
						?>
						<input type='checkbox' value='<?php echo $PRI_EMPID; ?>' name='send_to[]'> Principal &nbsp;(<i><?php echo $PrincipalNm; ?></i>)<br />
						<?php } ?>
						<!-- Principal -->
					  </div>
					  <center>
					    <button type="submit" class="btn btn-success">SEND</button>
					  </center>
					</form>						
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
	$(function () {
     $('#example2').DataTable()
    })
  </script>