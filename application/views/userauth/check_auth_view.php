<?php error_reporting(0); ?>



<ol class="breadcrumb"> 
    <li class="breadcrumb-item"><a href="#">Authorization</a> <i class="fa fa-angle-right"></i></li>
</ol>
<?php if ($this->session->flashdata('error')) {?>

        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong><?php echo $this->session->flashdata('error'); ?></strong>
        </div>
    <?php  } ?>
 
<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
      <form role="form" action="<?php echo base_url('userauth/check_auth/authorize_user'); ?>" method="post" > 
      <div class="row">
      <input type="hidden" name="receiptNo" value="<?php echo $receiptNo;?>">
      <input type="hidden" name="module_name" value="<?php echo $module_name;?>"> 
      <input type="hidden" name="canreason" value="<?php echo $reason;?>">
      </div> 
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Admin Password</b></td>
			  <td><input type="password" id="adminpass" name="adminpass" class="form-control" autocomplete="off" required></td>
			</tr>  
      <tr>
        <td><b>Superadmin Password</b></td>
        <td><input type="password" id="prinpass" name="prinpass" class="form-control" autocomplete="off" required></td>
      </tr>
      <tr> 
        <td><b>User Password</b></td>
        <td><input type="password" id="userpass" name="userpass" class="form-control" autocomplete="off" required></td>
      </tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="category_save" value="submit" class="btn btn-success">&nbsp;<input type="reset" name="reset" value="reset" class="btn btn-danger" onclick="reset()"></td>
			</tr>
		  </table>
		  </form>
		</div><br /><br />
        <div class="clearfix"></div>

         
  <script type="text/javascript">
          
          function reset()
          {
            $("#adminpass").val("");
            $("#prinpass").val("");
            $("#userpass").val("");
          }
        </script>