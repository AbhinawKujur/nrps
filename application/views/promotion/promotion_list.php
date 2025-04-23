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
    <li class="breadcrumb-item"><a href="#">Promotion List</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 25px; background-color: white">
  <div class="row">
	<a href='<?php echo base_url('promotion/Promotion/classPromote'); ?>' class='btn btn-success'>Promotion</a>
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
