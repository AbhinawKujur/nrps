<style>
  table tr td,th{
	  color:#000!important;
  }
  table thead tr th{
	  background:#337ab7 !important;
	  color:#fff !important;
  }
  body{
	 font-family: 'Aldrich', sans-serif;
  }
</style>
<br>
<!--four-grids here-->
<div class="panel panel-primary">
      <div class="panel-heading">Consolidated Copy Correction Sheet</div>
      <div class="panel-body" style="background-color:white;">
	  <form method="post" action="<?=base_url('onlineexam/reports/Conso_correctionsheet/examDate');?>">
  <div class="row">
    
           <div class="col-md-3 form-group">
				<label id='ct'>Start Exam</label>
				<input type="date" name="strt_date" id="strt_date" class="form-control">
			</div>
			
			<div class="col-md-3 form-group">
				<label id='ct'>End Exam</label>
				<input type="date" name="end_date" id="end_date" class="form-control" onchange="corr_repo(this.value)">
			</div>
	 
    </div>

      
  
  <br>
  
   <hr><br>
   
   </form>   
</div>
<span id="load"></span>

</div>
	
	 

<br />
<br />
<div class="clearfix"></div>
<!--inner block start here-->
<div class="inner-block"> </div>
<!--inner block end here-->
<!--copy rights start here-->
<script>
	
	function corr_repo(subject_ids){
		var str_date 	= $('#strt_date').val();
		var end_date 		= $('#end_date').val();
		if(subject_ids!=""){
		$.ajax({
			url: "<?php echo base_url('onlineexam/reports/Conso_correctionsheet/examDate'); ?>",
			type: "POST",
			data: {str_date:str_date,end_date:end_date},
			success: function(ret){
				$("#load").html(ret);
			}
		});
		}else{
		$("#load").html("");
		}
	}
	
	function printDiv() { 
            var divContents = document.getElementById("GFG").innerHTML; 
            var a = window.open('', '', 'height=500, width=500'); 
            a.document.write('<html>'); 
            //a.document.write('<body > <h1>Div contents are <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
		
</script>

 