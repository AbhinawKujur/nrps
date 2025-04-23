<style>
  table tr td,th{
	  color:#000 !important;
	  padding-top:0px !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>

<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Co-Scholastic Grade Entry Report</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding-left: 25px; background-color: white"><br/><br/>
  <div class="row">
	<div class="col-sm-12">
	  <table class='table'>
		<tr>
			<th style='background:#337ab7; color:#fff !important'>Class</th>
			<th style='background:#337ab7; color:#fff !important'>Section</th>
			<th style='background:#337ab7; color:#fff !important'>Co-Scolastic Grade Entry Status</th>
			<th style='background:#337ab7; color:#fff !important'>Class Teacher</th>
		</tr>
		<?php
			foreach($classData as $key => $val){
				$class = $val['Class_No'];
				$sec   = $val['section_no'];
				$entryData = $this->alam->selectA('co_scholastic_grade','count(*)cnt',"Class='$class' AND Sec='$sec'");
				$cnt = $entryData[0]['cnt'];
				$loginDetails = $this->alam->selectA('login_details','emp_name',"Class_No='$class' AND Section_No='$sec'");
				$emp_name = $loginDetails[0]['emp_name'];
				?>
					<tr>
						<td><?php echo $val['classnm']; ?></td>
						<td><?php echo $val['secnm']; ?></td>
						<?php
							if($cnt == 0){
								?>
									<td><label class='label label-danger'>Not Entry</label></td>
								<?php
							}else{
								?>
									<td><label class='label label-success'>Entry Done</label></td>
								<?php
							}
						?>
						<td><label class='label label-success'><?php echo $emp_name; ?><label></td>
					</tr>
				<?php
			}
		?>
	  </table>
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
  
</script>
