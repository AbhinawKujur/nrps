
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report Card
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-book"></i> Home</a></li>
        <li class="active"> REPORT CARD</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        
        <!-- /.box-header -->
        <div class="box-body" >	
			<?php $adm_no = $this->session->userdata('adm');?>
				<iframe src="<?=base_url();?>assets/reportcard/<?=$adm_no;?>.pdf" width="1000" height="800"></iframe>
          <div class="row">
            <div class="col-sm-12">
				
				<!--<span style="font-size:50px;color:yellow;margin-left: 500px;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
				<h1 style="font-size: 150px; text-align:center">UNDER<br> MAINTENANCE</h1>
				<h1 style=" text-align:center">------------WE WILL BE BACK SOON--------------</h1>-->
			  
				
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
	
</script>