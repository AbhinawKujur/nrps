<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
								<ul id="menu" >
									<li><a href="<?php echo base_url(); ?>Login/fees_dashboard"><i class="fas fa-tachometer-alt"></i> <span>Fees Dashboard</span><div class="clearfix"></div></a></li>
									
									<li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Master Entry</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
									     <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/class_master'); ?>">Class Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/section_master'); ?>">Section Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/book_master'); ?>">Book Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/book_stock_modification'); ?>">Book Stock Modification</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/fee_head_master'); ?>">Fee Head Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Feegeneration/fee_generation_gui'); ?>">Fee Generation</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/bus_master'); ?>">Bus No Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Employee Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/house_master') ?>">House Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/Category_master'); ?>">Category Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Account Group Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/ward_master') ?>">Ward Type Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_master/religion_master') ?>">Religion Master</a></li>
									  </ul>
									</li>
									<li id="menu-academico" ><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span> Student Details</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Student_details/student_master'); ?>">Student Master</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Student_details/Scholarship'); ?>">Scholarship</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Bulk Updation</a></li>
									  </ul>
									</li>
									<li id="menu-academico" ><a href="#" title="Click For Fee Collection"><i class="fa fa-inr" aria-hidden="true"></i><span> Fees Collection</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Fees_collection/school_collection'); ?>" title="Click For Fee Collection">School Collection</a></li>
										<!--  <li id="menu-academico-avaliacoes" ><a href="icons.html">Book Sales</a></li> -->
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Cancel/Re-Print Fee Reciepts </a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Cancel/Re-Print Book Reciepts</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Transfer Cash Payment to Card Swip</a></li>
									  </ul>
									</li>
									<li id="menu-academico" ><a href="#" title="Reports"><i class="fa fa-file" aria-hidden="true"></i><span> Reports</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
										 <li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/typeofreports'); ?>" title="Click For Reports">Fee Reports</a></li>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/Fee_Defaulter_List'); ?>">Fee Defaulter List</a></li>
										<li id="menu-academico-avaliacoes" ><a href="<?php echo base_url('Report/Fee_head_Defaulter_List'); ?>">Fee Head Wise Defaulter List</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Class Reports</a></li>
										 <!--<li id="menu-academico-avaliacoes" ><a href="icons.html">Cancel/Re-Print Book Reciepts</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Transfer Cash Payment to Card Swip</a></li>-->
									  </ul>
									</li>
									<li id="menu-academico" ><a href="#"><i class="fa fa-database" aria-hidden="true"></i><span> Database Management</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Back Up</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Change Financial Year</a></li>
									  </ul>
									</li>
									<li id="menu-academico" ><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i><span> User Account</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Create User</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Create/Change Password</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Create Financial Year</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Promote Student</a></li>
										 <li id="menu-academico-avaliacoes" ><a href="icons.html">Import Counter</a></li>
									  </ul>
									</li>
								</ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="<?php echo base_url(); ?>assets/dash_js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="<?php echo base_url(); ?>assets/dash_js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   
<!-- morris JavaScript -->	
<script src="<?php echo base_url(); ?>assets/dash_js/raphael-min.js"></script>
<script src="<?php echo base_url(); ?>assets/dash_js/morris.js"></script>
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2014 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2014 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2014 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2014 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2015 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2015 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2015 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2015 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2016 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
				{period: '2016 Q2', iphone: 8442, ipad: 5723, itouch: 1801}
			],
			lineColors:['#ff4a43','#a2d200','#22beef'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
</body>
</html>

<script>
$("#msg").fadeOut(6000);
$(document).ready( function () {
    $('#class_table').DataTable();
} );
</script>
