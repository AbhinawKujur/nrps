<?php
	$monthin = array("JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC");
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Update Fine Master</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
		<div class="col-sm-3"></div>
		<div class='col-sm-6'>
		   <?php
		     if($this->session->flashdata('msg')):
		   ?>
		    <div class="alert alert-success" role="alert" id="msg">
			  <strong><?php echo $this->session->flashdata('msg'); ?></strong>
			</div>  
		   <?php endif; ?>	  
		</div>
        <div class='col-sm-3'>		
		  <a href="<?php echo base_url('Late_finemaster/late_fine'); ?>" class='btn btn-warning pull-right'>BACK</a><br /><br /><br />
        </div>
		<form method="post" action="<?php echo base_url('Late_finemaster/update_save'); ?>">
		  <table class="table table-bordered" id="example">
			<thead>
			  <tr>
				<th>Sl no.</th>
				<th>Month Applicable from</th>
				<th>Applied Date</th>
				<th>Late Fine Amount</th>
				<th>Type of Fine</th>
				<th>Status</th>
			  </tr>
			</thead>
			<tbody>
			  <tr>
				<td><?php echo $late_fine[0]->ID; ?></td>
				<td>
					<select class="form-control" name="month" required>
						<?php
							foreach($month as $monthkey){
								?>
								<option value="<?php echo $monthkey->month_code; ?>" <?php if($monthkey->month_code == $late_fine[0]->month_applied){echo "selected";} ?> ><?php echo $monthkey->month_name; ?></option>
								<?php
							}
						?>
					</select>
				</td>
				<td>
					<select class="form-control" name="days" required>
						<option value=''>select</option>
						<?php
							for($i=1;$i<=31;$i++){
								?>
								<option value="<?php echo $i; ?>" <?php if($i ==$late_fine[0]->date_applied){echo "selected";} ?> ><?php echo $i; ?></option>
								<?php
							}
						?>
					</select>
				</td>
				<td><input type="number" name="amount" value="<?php echo $late_fine[0]->late_amount; ?>"></td>
				<td>
					<select class="form-control" name="moc" required>
						<option value="">Select</option>
						<option value="1" <?php if($late_fine[0]->collection_mode == 1){echo "selected";} ?>>MONTHLY</option>
						<option value="2" <?php if($late_fine[0]->collection_mode == 2){echo "selected";} ?> >DAILY</option>
					</select>
				</td>
				<td>
					<select class="form-control" name="status" required>
						<option value="">Select</option>
						<option value="1" <?php if($late_fine[0]->status == 1){echo "selected";} ?>>ACTIVE</option>
						<option value="0" <?php if($late_fine[0]->status == 0){echo "selected";} ?> >UNACTIVE</option>
					</select>
				</td>
			  </tr>
			</tbody>
		  </table>
		  <div class="row">
			<div class="col-md-12">
				<center><input type="submit" name="submit" value='submit' class="btn btn-primary"></center>
			</div>
		  </div>
		</form>
		</div><br /><br />
        <div class="clearfix"></div>
                   
	
<!-- script-for sticky-nav -->
		<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>

		   <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
           <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
           <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
           <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
           <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
           <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
           <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
           <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
           <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" />

  <script type="text/javascript">
   	$("#msg").fadeOut(6000);
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','excel','pdf','print'
        ]
    } );
 });

    </script>
