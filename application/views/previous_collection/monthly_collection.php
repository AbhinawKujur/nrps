<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.html">Monthly Collection</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white;  border-top:3px solid #5785c3;">
		<div class="row">
			<div class="col-md-6 col-xs-6 form-group">
				<label>Admission No:</label>
				<input type="text" name="adm_no" id="adm_no" autocomplete="off" placeholder="Enter Admission No" class="form-control">
			</div>
			<div class="col-md-3 col-sm-3 form-group">
				<br>
				<button class="btn btn-success btn-block" onclick="adm_function()"><i id="spd" class="fas fa-search"></i>&nbsp;<i class="fa fa-circle-o-notch fa-spin" style="display: none;" id="spnr_src"></i>&nbsp;Show Details</button>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-3 form-group">
				<br>
				<button onclick="show_student_details()" class="btn btn-success btn-block"><i class="far fa-eye" style="font-size: 16px;" id="eye"></i>&nbsp;<i class="fa fa-circle-o-notch fa-spin" style="display: none;" id="spnr_dsp"></i>&nbsp;All Student Details</button>
			</div>
		</div>
		<!-- load data from Monthly_collection through ajax call -->
		<div id="load_data">
			
		</div>
		<!-- end load data from ajax call -->

	<!-- The Modal -->
  <div class="modal fade" id="stu_details">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header" style="background: #5785c3; color: #fff; text-align: center;">
          <h4 class="modal-title">Student Details</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">×</button> -->
        </div>
        <style type="text/css">
        	.table,#thead,tr,td,th
        	{
        		text-align: center;
        		color: #000!important;
        	}
        </style>
        <!-- Modal body -->
        <div class="modal-body">
          <div style="overflow: auto; height: 350px;">
          	<div class="form-group">
          		<input type="text" name="" id="myInput" class="form-control" placeholder="search">
          	</div>
          	<table class="table" width="100%" id="myTable">
          		<thead id="thead">
          			<tr>
          				<th>SlNO.</th>
          				<th>Adm No</th>
          				<th>Name</th>
          				<th>Class/Sec</th>
          				<th>Father Name</th>
          				<th>Mother Name</th>
          			</tr>
          		</thead>
          		<tbody id="student_data">
          			
          		</tbody>
          </table>
          </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
</div><br>

<script type="text/javascript">
	function adm_function()
	{
		$("#spd").hide(1000);
		$("#spnr_src").show(1000);
		var val = $("#adm_no").val();
		if(val!="")
		{
			$("#adm_no").css("border", "1px solid black");
			$.ajax({
			url:"<?php echo base_url('Monthly_collection/monthly_adm_data'); ?>",
			type:"POST",
			data:{val:val},
			success:function(data)
			{
				var user = JSON.parse(data);
				var chkd = user[0];
				if(chkd == 1)
				{
					if(user[1] > 0){
						var stu_id = user[2];
						var r = confirm("This Student Has Previous Year Dues of Rs:-"+ user[1]+" If You Want To collect Then Press Ok Or You Can Cancel.");
						  if (r == true) {
							window.location="<?php echo base_url('Previous_collection/pre_details'); ?>"+"/"+stu_id;
						  } else {
							$.ajax({
							url:"<?php echo base_url('Monthly_collection/stu_data'); ?>",
							type:"POST",
							data:{val:val},
							success:function(adm)
								{
									$("#load_data").show(2000);
									$("#load_data").html(adm);
									$("#spd").show(1000);
									$("#spnr_src").hide(1000);
								}
							});
						  }
					}else{
							$.ajax({
							url:"<?php echo base_url('Monthly_collection/stu_data'); ?>",
							type:"POST",
							data:{val:val},
							success:function(adm)
							{
								$("#load_data").show(2000);
								$("#load_data").html(adm);
								$("#spd").show(1000);
								$("#spnr_src").hide(1000);
							}
						});
					}
				}
				else
				{
					alert("! Sorry No Data Found");
					$("#load_data").hide(2000);
					$("#adm_no").val("");
					$("#spd").show(1000);
					$("#spnr_src").hide(1000);
				}
			},
			error: function (error) {
    			alert("Please Check Your Internet Connection");
			}
			
		});
		}
		else
		{
			$("#adm_no").css("border", "1.5px solid red");
			$("#spd").show(1000);
		    $("#spnr_src").hide(1000);
		    $("#load_data").hide();
		}
		
	}
	function show_student_details()
	{
		$("#eye").hide(1000);
		$("#spnr_dsp").show(1000);
		$.ajax({
			url:"<?php echo base_url('Monthly_collection/show_student'); ?>",
			type:"POST",
			success:function(data)
			{
				var user = JSON.parse(data);
				var html ="";
				var i=1;
				for(var count=0; count < user.length; count++)
				{
					html +="<tr>";
					html +="<td style='cursor: pointer;' onclick='getamd("+user[count].ADM_NO+")'>"+i+"</td>";
					html +="<td style='cursor: pointer;' onclick='getamd("+user[count].ADM_NO+")'>"+user[count].ADM_NO+"</td>";
					html +="<td style='cursor: pointer;' onclick='getamd("+user[count].ADM_NO+")'>"+user[count].FIRST_NM+"</td>";
					html +="<td style='cursor: pointer;' onclick='getamd("+user[count].ADM_NO+")'>"+user[count].DISP_CLASS+"-"+user[count].DISP_SEC+"</td>";
					html +="<td style='cursor: pointer;' onclick='getamd("+user[count].ADM_NO+")'>"+user[count].FATHER_NM+"</td>";
					html +="<td style='cursor: pointer;' onclick='getamd("+user[count].ADM_NO+")'>"+user[count].MOTHER_NM+"</td>";
					html +="</tr>";
					i++;
				}
				$("#stu_details").modal();
				$("#student_data").html(html);
				$("#eye").show(1000);
				$("#spnr_dsp").hide(1000);
			}
		});
	}

	$("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
	function getamd(val){
		$("#stu_details").modal('hide');
		$("#adm_no").val(val);
		var val = $("#adm_no").val();
		$.ajax({
			url:"<?php echo base_url('Monthly_collection/monthly_adm_data'); ?>",
			type:"POST",
			data:{val:val},
			success:function(data)
			{
				var user = JSON.parse(data);
				var chkd = user[0];
				if(chkd == 1)
				{
					if(user[1] > 0){
						var stu_id = user[2];
						var r = confirm("This Student Has Previous Year Dues of Rs:-"+ user[1]+" If You Want To collect Then Press Ok Or You Can Cancel.");
						  if (r == true) {
							window.location="<?php echo base_url('Previous_collection/pre_details'); ?>"+"/"+stu_id;
						  } else {
							$.ajax({
							url:"<?php echo base_url('Monthly_collection/stu_data'); ?>",
							type:"POST",
							data:{val:val},
							success:function(adm)
								{
									$("#load_data").show(2000);
									$("#load_data").html(adm);
									$("#spd").show(1000);
									$("#spnr_src").hide(1000);
								}
							});
						  }
					}else{
							$.ajax({
							url:"<?php echo base_url('Monthly_collection/stu_data'); ?>",
							type:"POST",
							data:{val:val},
							success:function(adm)
							{
								$("#load_data").show(2000);
								$("#load_data").html(adm);
								$("#spd").show(1000);
								$("#spnr_src").hide(1000);
							}
						});
					}
					
				}
				else
				{
					alert("! Sorry No Data Found");
					$("#load_data").hide(2000);
					$("#adm_no").val("");
					$("#spd").show(1000);
					$("#spnr_src").hide(1000);
				}
			},
			error: function (error) {
    			alert("Please Check Your Internet Connection");
			}
			
		});
		
	}
</script>