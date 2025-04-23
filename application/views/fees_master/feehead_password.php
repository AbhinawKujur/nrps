<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Fee Head Password</a> <i class="fa fa-angle-right"></i></li>
</ol>

<div style="padding: 10px; background-color: white; border-top:3px solid #5785c3;">
        
		  <table class="table table-bordered" id="class_table">
			<tr>
			  <td><b>Enter Password:</b></td>
			  <td><input type="password" id="password" name="password" class="form-control" autocomplete="off"></td>
			</tr>
			<tr>
			  <td colspan='2' align='center'><input type="submit" name="category_save" value="submit" class="btn btn-success" onclick="return validation()" >&nbsp;<input type="reset" name="reset" value="reset" class="btn btn-danger" onclick="reset()"></td>
			</tr>
		  </table>
		  <!-- </form> -->
		</div><br /><br />
        <div class="clearfix"></div>

         <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p id="first"></p>
          <p id="second"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

        <script type="text/javascript">
        	function validation() {
        		var pass = $("#password").val();
        		if(pass!="")
        		{
        			$.ajax({
        				url: "<?php echo base_url('Fees_master/fees_head_password'); ?>",
        				type:"POST",
        				data:{password:pass},
        				success:function(data)
        				{
        					if(data==1)
                  {
                    window.location="<?php echo base_url('Fees_master/fees_head'); ?>";
                    
                  }
                  else
                  {
                    $("#myModal").modal();
                    $('#myModal').find('.modal-header').css({"color":"red","text-align":"center","font-size":"30px"});
                    $('#myModal').find('.modal-header').html("Warning !");
                    $('#myModal').find('.modal-body').html("Wrong Password !"); 
                  }
        				}
        			});
        		}
        		else
        		{
        			$("#myModal").modal();
        			$('#myModal').find('.modal-header').css({"color":"red","text-align":"center","font-size":"30px"});
					$('#myModal').find('.modal-header').html("Warning !");
					$('#myModal').find('.modal-body').html("Please Enter Password !");
					return false;
        		}
        	}
        	function reset()
        	{
        		$("#password").val("");
        	}
        </script>