<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Marks Entry</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding-left: 25px; background-color: white">
		<div class="row">
		<div class="four-grids">
		<?php
			if($t1 == 1){
		?>
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('Grade/cosoc/'. 1); ?>">
					<div class="four-agileits">
						<div class="icon">
							<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
						</div>
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>TERM 1</h3>
						</div>
						
					</div>
				</a>
			</div>
		<?php } ?>
        <?php
			if($t2 == 1){
		?>	
			<div class="col-md-3 four-grid">
				<a href="<?php echo base_url('Grade/cosoc/'. 2); ?>">
				<div class="four-agileinfo">
					<div class="icon">
						<i class="fas fa-rupee-sign" style="font-size:30px; color: #fff;"></i>
					</div>
					<div class="four-text">
					     <center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
						<h3>TERM 2</h3>
					</div>
					
				</div></a>
			</div>
		<?php } ?>		
			<div class="clearfix"></div>
		</div>
		</div>
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
<!--inner block end here-->
<!--copy rights start here-->

<script>
$(document).ready( function () {
    $('#class_table').DataTable();
} );
</script>
