<?php
	$directoryURI = $_SERVER['REQUEST_URI'];
	$path = parse_url($directoryURI, PHP_URL_PATH);
	$components = explode('/', $path);
	$first_part = $components[3];
?>
<style>
#menu ul li a.active{
    color: #ffffff !important;
    background-color: #5785c3 !important;
    border-left: 4px solid #4A4A4A !important;
}
</style>
<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo1">
						<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> 
					</header>
						<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
                           <div class="menu">
								<ul id="menu" >
									<li><a href="<?php echo base_url('Login/teacher_dashboard'); ?>"><i class="fa fa-tachometer"></i> <span>Teacher Dashboardd</span><div class="clearfix"></div></a></li>
									
									<li id="menu-academico" ><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span> Master Entry</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
									     <li><a class='<?php if($first_part == 'clswise_subj_allco'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/clswise_subj_allco'); ?>">Classwise Subject Allocation</span><div class="clearfix"></div></a></li>
										 
										 <li id="menu-academico-avaliacoes" ><a class='<?php if($first_part == 'stuwise_subj_allco'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/stuwise_subj_allco'); ?>">Studentwise Subject Allocation</a></li>
										 
										 <li id="menu-academico-avaliacoes" ><a class='<?php if($first_part == 'max_marks_allco'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/max_marks_allco'); ?>">Maximum Marks Allocation</a></li>
										 <li id="menu-academico-avaliacoes" ><a class='<?php if($first_part == 'stu_recored_keeping'){ echo "active"; } ?>' href="<?php echo base_url('Teacher_master/stu_recored_keeping'); ?>">Student Record Keeping</a></li>
									  </ul>
									</li>
									
									<li id="menu-academico" ><a href="#"><i class="fa fa-pencil-square" aria-hidden="true"></i><span> Marks Entry</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
									     <li><a class='<?php if($first_part == 'index'){ echo "active"; } ?>' href="<?php echo base_url('Marks_entry/index'); ?>">Main Subject</span><div class="clearfix"></div></a></li>
										 
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/index'); ?>">Co-Scholastic grade Entry</a></li>
										 
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/discipline_term'); ?>">Discipline Grade</a></li>
										 
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Grade/discipline_grade_skill_wise_term'); ?>">Discipline Grade Skill Wise</a></li>
										 
										 <li id="menu-academico-avaliacoes" ><a class='' href="<?php echo base_url('Remarks/index'); ?>">Remarks Allocation</a></li>
									  </ul>
									</li>
									
									<li id="menu-academico" ><a href="#"><i class="fa fa-address-card-o"></i><span> Report Master</span> <span class="fa fa-angle-right" style="float: right"></span><div class="clearfix"></div></a>
									   <ul id="menu-academico-sub" >
									     <li><a class='' href="<?php echo base_url('report_card/Report_card/index'); ?>">Term Wise Report Card</span><div class="clearfix"></div></a></li>
									  </ul>
									</li>
                                    <!--<li><a href="<?php //echo base_url(); ?>Login/dashboard"><i class="fa fa-circle-o"></i> <span>Exam Marks</span><div class="clearfix"></div></a></li>
									
									<li><a href="<?php //echo base_url(); ?>Login/dashboard"><i class="fa fa-circle-o"></i> <span>Grade Marks</span><div class="clearfix"></div></a></li>
									
                                    <li><a href="<?php //echo base_url('Teacher_master/clswise_subj_allco'); ?>"><i class="fa fa-circle-o"></i> <span>Classwise Subject Allocation</span><div class="clearfix"></div></a></li>
									
									<li><a href="<?php //echo base_url(); ?>Login/dashboard"><i class="fa fa-circle-o"></i> <span>Maximum Marks Allocation</span><div class="clearfix"></div></a></li>
									
									<li><a href="<?php //echo base_url(); ?>Login/dashboard"><i class="fa fa-circle-o"></i> <span>Studentwise Subject Allocation</span><div class="clearfix"></div></a></li>-->
									
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