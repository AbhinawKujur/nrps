<html>
  <head>
    <title>Subject Ananlysis</title>
	 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<style>
	.table > thead > tr > th,
	.table > tbody > tr > th,
	.table > tfoot > tr > th,
	.table > thead > tr > td,
	.table > tbody > tr > td,
	.table > tfoot > tr > td {
		white-space: nowrap !important;
		font-size:12px;
		padding:7px;
	 }
	
	 #footer { position: fixed; right: 8px; bottom: 20px; text-align: right;}
     #footer .page:after { content: counter(page, decimal); }
	</style>
  </head>
  
  <body>
    <?php
	  $school_nm      = $school_setting[0]['School_Name'];
	  $school_Address = $school_setting[0]['School_Address'];
	  $school_Code    = $school_setting[0]['School_Code'];
	  $school_AfftNo  = $school_setting[0]['School_AfftNo'];
	  $school_session = $school_setting[0]['School_Session'];
	  $class          = $topper_list[0]['classes'];
	  $sec            = $topper_list[0]['sec'];
	  $term           = $topper_list[0]['term'];
	  $photo_left     = $school_photo[0]['School_Logo'];
	  $photo_right    = $school_photo[0]['School_Logo_RT'];
	?>
	<div id="footer">
      <p class="page" style="float: right;">Page </p>
    </div>
    <div class='container'>
	  <div class='row'>
	    <div class='col-sm-12'>
		  <table class='table'>
		    <tr>
			  <td><center><img src='<?php echo base_url($photo_left); ?>' style='width:100px;'></center></td>
			  <th>
			  <center><h3>
			  <?php echo $school_nm; ?><br /><?php echo $school_Address; ?><br /><?php echo $school_session; ?>
			  </center></h3>
			  </th>
			  <td><center><img src='<?php echo base_url($photo_right); ?>' style='width:100px;'></center></td>
		    </tr>
			<tr>
			  <td colspan='2'>Affiliation No.:<?php echo $school_AfftNo; ?></td>
			  <td style='text-align:right'>School Code.:<?php echo $school_Code; ?></td>
			</tr>
			<tr>
			  <td>Class-Sec: <?php echo $class.'-'.$sec; ?></td>
			  <td><h3><center>Subject wise higest Marks</center><h3></td>
			  <td style='text-align:right'>Term: <?php echo $term; ?></td>
			</tr>
		  </table><br /><br />
		  
		  <div class='col-sm-2'></div>
		  <div class='col-sm-8'>
		    <div id="chart-container">
			  <canvas id="mycanvas"></canvas>
		    </div>
		  </div>
		  <div class='col-sm-2'></div>
		  
          <div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<center><button class="btn btn-primary" id="printing_button" onclick="printl()"><i class="fa fa-print"></i>&nbsp;PRINT</button>
			</div>
		  </div>		  
		   
		   
		</div>
	  </div><br /><br /><br /><br />
    </div>
  </body>
</html>
<script type="text/javascript" src="<?php echo base_url('assets/dash_js/Chart.min.js'
) ?>"></script>
<script>
  $.ajax({
    url: "<?php echo base_url('report_card/Higest_sub_graph/fetch_data'); ?>",
    method: "GET",
    dataType:"json",
    success: function(data) {
      var subject = [];
      var higest = [];

      $.each( data, function( key, value ) {
        subject.push(value.subj_nm);
        higest.push(value.higest_marks);
      });

      var chartdata = {
        labels: subject,
        datasets : [
          {
            label: 'Higest Marks',
            backgroundColor: ['#F39C12','#1ABC9C','#8E44AD','#A93226','#AF601A','#239B56','#8E44AD','#3498DB','#4A235A','#7B7D7D'],
            borderColor: '#DC7633',
            hoverBackgroundColor: '#E59866',
            hoverBorderColor: '#E59866',
            data: higest
          }
        ]
      };

      var ctx = $("#mycanvas");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
  
  function printl(){
	var printButton = document.getElementById("printing_button");
	printButton.style.visibility = 'hidden';
	window.print();
	printButton.style.visibility = 'visible';
  }
</script>