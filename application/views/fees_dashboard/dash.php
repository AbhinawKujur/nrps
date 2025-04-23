<?php
	if(isset($total_student)){
		$total_student = $total_student;
	}
	if(isset($active_student))
	{
		$active_student = $active_student;
	}
	if(isset($unactive_student))
	{
		$unactive_student = $unactive_student;
	}
?>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Home</a> <i class="fa fa-angle-right"></i></li>
</ol>
<style type="text/css">
  body{
   font-family: 'Aldrich', sans-serif;
  }
</style>
<!--four-grids here-->
		<!-- <div class="four-grids">
					<div class="col-md-6 four-grid">
						<div class="four-agileits">
							<div class="icon">
								<i class="glyphicon glyphicon-user"></i>
							</div>
							<div class="four-text">
								<h3>User</h3>
								<h4> 24,420  </h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-6 four-grid">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Clients</h3>
								<h4>15,520</h4>

							</div>
							
						</div>
					</div>
					<div class="col-md-6 four-grid">
						<div class="four-w3ls">
							<div class="icon">
								<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Projects</h3>
								<h4>12,430</h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-6 four-grid">
						<div class="four-wthree">
							<div class="icon">
								<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>Old Projects</h3>
								<h4>14,430</h4>
								
							</div>
							
						</div>
					</div>
					<div class="clearfix"></div>
		</div>  -->     
        <!-- div class="clearfix"></div> -->
        <input type="hidden" name="" id="ts" value="79">
        <div class="row">
        	<div class="col-md-6">
        	<div id="chartContainer" style="height: 300px; width: 100%;"></div>
        </div>
        <div class="col-md-6">
        	
        </div>
        </div>
        
                   
	
<!-- script-for sticky-nav -->
		<script>
		/*$(document).ready(function() {
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
*/
		window.onload = function() {
     var ts = document.getElementById('ts').value;
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Student Information"
	},
	data: [{
		type: "pie",
		startAngle: 240,
		yValueFormatString: "##00\"\"",
		indexLabel: "{label} {y}",
		dataPoints: [
			{y: <?php echo $total_student; ?>, label: "Total Student"},
			{y: <?php echo $unactive_student; ?>, label: "Unactive Student"},
			{y: <?php echo $active_student; ?>, label: "Active Student"},
			/*{y: 4.91, label: "Yahoo"},
			{y: 1.26, label: "Others"}*/
		]
	}]
});
chart.render();

}
		</script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<br />
<!--inner block end here-->
<!--copy rights start here-->
