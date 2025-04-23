<?php 
if ($this->session->flashdata('success')) {?>

        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('success'); ?></strong>
        </div>
   	<?php	}

 if ($this->session->flashdata('error')) { ?>

        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>
  
	<?php	} ?>
 <br><br><br>
<?php if($status=='scholarship') {?>
    <center>
<button onClick="window.location.href = '<?php echo base_url();?>Student_details/Scholarship';return false;" class="btn btn-primary" style="width: 100px;">OK</button>
</center>

<?php } ?>
<?php if($status!='scholarship') {?>
<center>
<button onClick="window.location.href = '<?php echo base_url();?>Cancel_reprint/cancel_reprintt';return false;" class="btn btn-primary" style="width: 100px;">OK</button>
</center>
<?php } ?>
