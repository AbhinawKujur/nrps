  <style>
	 /*   .absent {
    background-color: #ff8793;
  }
  .present {
    background-color: #a3dba2;
  } */
  .holiday {
    background-color: #8dd85f;
  } 
  div.legend span {
    color: #1d1b1b !important;
    font-size: 20px !important;
    font-weight: normal !important;
	padding-right:10px;
}
ul.legend li {
    display: inline-block;
    height: 14px !important;
    width: 14px !important;
    margin-left: 5px;
}
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Holiday Calendar
        <!--<small>Control panel</small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Notice</li>
		<li class="active">Holiday Calendar</li>
      </ol>
    </section>
	<br />
	<div class='row'>
        <div class='col-md-1 col-sm-1 col-lg-1'></div>	
		<div class='col-md-10 col-sm-10 col-lg-10'>
			 <div class="full_calendar box box-primary"></div>
		</div>
		<div class='col-md-1 col-sm-1 col-lg-1'></div>	
	</div>
	
  </div>
  <!-- /.content-wrapper -->
  
  <script type="text/javascript">
  $(".full_calendar").zabuto_calendar({
      today: true,
      cell_border: true,
      weekstartson: 0,
      ajax: {
          url: "<?php echo base_url('Parentlogin/holiday_details'); ?>",
          modal: true,
      },
      nav_icon: {
        prev: '<i class="fa fa-chevron-circle-left"></i>',
        next: '<i class="fa fa-chevron-circle-right"></i>'
      },
      // limit months navigation to a specific range
        legend: [
        /*{
          type: "block",
          label: "Present",
          classname: "present"
        },*/
        {
          type: "block",
          label: "Holiday",
          classname: "holiday"
        },
      ], 
    });
</script>