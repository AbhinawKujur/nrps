<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Marks Entry</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding-left: 25px; background-color: white">
		<div class="row">
		<div class="four-grids">
			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('report_card_nur/Report_card_nur/report_card_stu_list'); ?>">
					<div class="four-agileits">
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>NUR</h3>
						</div>
					</div>
				</a>
			</div>
			
			<div class="col-md-2 four-grid">
				<a href="<?php echo base_url('report_card_preptofive/Report_card_prepTofive/report_card_stu_list/'); ?>">
					<div class="four-agileinfo">
						<div class="four-text">
							<center><img src="<?php echo base_url('assets/logo/marks_entry_icon.png'); ?>" class="img-responsive" style="width:30px;"></center>
							<h3>PREP - V</h3>
						</div>
					</div>
				</a>
			</div>
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
