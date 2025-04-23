<style type="text/css">
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}

.chat{
	border:1px solid #000;
	padding:10px;
	box-shadow:0px 1px 8px 2px;
}
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">SMS</a> <i class="fa fa-angle-right"></i> Compose Message </li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div class='mainb' style="padding: 15px; background-color: white; border-top: 3px solid #5785c3;">
  <div class="row">
    <div class='col-sm-4'>
	
	<?php
	  if($this->session->flashdata('msg')){
    ?>
    <div class="alert alert-success">
	  <?php echo $this->session->flashdata('msg'); ?>
    </div>
    <?php } ?>
	
	<div class='chat'>
	<form action="<?php echo base_url('sms/Compose_msg/composeMsgSave'); ?>" autocomplete='off' method='POST'>
		<div class="form-group">
			<label>Text Message:</label>
			<textarea class="form-control" name='text_msg' required></textarea>
			<input type='hidden' name='user_id' value='<?php echo $user_id; ?>'>
	    </div>
		
		<div class="form-group">
			<label>Send To:</label><br />
			<select name='send_to[]' id="multiselect" class='form-control' multiple required>
				<option value=''>Select</option>
				<?php
					if(!empty($stuData)){
						foreach($stuData as $key => $val){
							?>
								<option value='<?php echo $val['ADM_NO']; ?>'><?php echo $val['ADM_NO'].' ('.$val['FIRST_NM'] .')' ?></option>
							<?php
						}
					}
				?>
			</select>
	    </div>
		
		<center>
			<button type="submit" class="btn btn-success btn-xs">SEND</button>
	    </center>
	</form>	
	</div>
	</div>
	
    <div class='col-sm-7' id='load'>
	
    </div>
</div> 
</div><br />	
<script type="text/javascript">
$("#multiselect").select2();
</script>