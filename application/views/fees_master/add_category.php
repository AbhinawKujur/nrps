<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Add Category</a> <i class="fa fa-angle-right"></i></li>
</ol>
<!--four-grids here-->
		<div style="padding: 10px; background-color: white">
        <div class='col-sm-12'>		
		  <a href="<?php echo base_url('Fees_master/Category_master'); ?>" class='btn btn-danger pull-right'>BACK</a><br /><br /><br />
        </div>
		  <form action="<?php echo base_url('Fees_master/category_save'); ?>" method="post" onsubmit="return validation()">
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Category Name</b></td>
			  <td><input type="text" id="category" name="category" class="form-control" autocomplete="off"></td>
			</tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="category_save" value="SAVE" class="btn btn-success"></td>
			</tr>
		  </table>
		  </form>
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
		function validation()
		{
			var name=document.getElementById('category').value;
			var valsec=/^[a-zA-Z]{1,}$/;
			if(valsec.test(name)){

			}
			else{
				alert('Please Fill Category And Should Not Contain Numeric Value');
				return false;
			}
		}
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->

<script>
$(document).ready( function () {
    $('#class_table').DataTable();
} );
</script>
