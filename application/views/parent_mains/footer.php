  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Powered By : <span class='text-info'>Soft Solution</span> Version</b> 2.0.1
    </div>
    <strong>&copy; All Rights Reserved | Design by <a href="http://micaeduco.com/" target="_blank">MICA EDUCATIONAL COMPANY PVT. LTD.  
</a>.</strong>
  </footer>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<div class="modal fade" id="changePasswordModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #209cc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <form id="changePasswordForm" >
      	<input type="hidden" name="studentid" id="studentid">
        <div class="modal-body">
          <div class="row">
			<div class="col-sm-12">
              <div class="form-group">
                <label>Old Password</label><span class="req">*</span>
                <input type="password" name="oldpassword" class="form-control" autocomplete="off" required="" id="myInput" oninput="matchpass()">
				<input type="checkbox" onclick="myFunction()">Show Password
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Password</label><span class="text-danger">* Passowrd Must Contain Atleast 8 Character</span>
                <input type="password" readonly name="password" class="form-control" autocomplete="off" required="" id="password">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Confirm Password</label><span class="req">*</span>
                <input type="password" readonly name="confirm_password" class="form-control" autocomplete="off" required="" id="conf_password">
				<input type="checkbox" onclick="myFunction1()">Show Confirm Password
              </div>
            </div>   
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" onclick="saveChangePassword()">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
	  <!--<button onclick="clidk()">pop toster</button>-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
	function matchpass()
	{
		var oldpassword = $('#myInput').val();
		var studentid = $('#studentid').val();
		$.ajax({
			url: "<?php echo base_url('Parentpassword_change/oldpassverify'); ?>",
			type: "POST",
			data: {oldpassword:oldpassword,studentid:studentid},
			success:function(data){
				if(data==1){
					$('#password').prop('readonly',false);
					$('#conf_password').prop('readonly',false);
					Command: toastr["info"]("You Can Change Password According Your Choise", "Password Match")

					toastr.options = {
					  "closeButton": false,
					  "debug": false,
					  "newestOnTop": false,
					  "progressBar": true,
					  "positionClass": "toast-top-right",
					  "preventDuplicates": false,
					  "onclick": null,
					  "showDuration": "300",
					  "hideDuration": "1000",
					  "timeOut": "5000",
					  "extendedTimeOut": "1000",
					  "showEasing": "swing",
					  "hideEasing": "linear",
					  "showMethod": "fadeIn",
					  "hideMethod": "fadeOut"
					}
				}
				else{
					$('#password').prop('readonly',true);
					$('#conf_password').prop('readonly',true);
				}
			},
		});
	}
	function saveChangePassword(){
		var pass = $('#password').val();
		var con_pass = $('#conf_password').val();
		
		var checkpass = /^[a-zA-Z0-9 @#.!]{8,}$/;
		
		if(checkpass.test(pass)){
			
		}else{
			Command: toastr["warning"]("Password Must Contain Atleast 8 Character", "Alert")

			toastr.options = {
			  "closeButton": false,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "300",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
			return false;
		}
		if(con_pass == pass){
			
		}else{
			Command: toastr["error"]("Password Not Match", "Error")
			toastr.options = {
			  "closeButton": false,
			  "debug": false,
			  "newestOnTop": false,
			  "progressBar": false,
			  "positionClass": "toast-top-right",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "300",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}
			return false;
		}
		$.ajax({
			url: "<?php echo base_url('Parentpassword_change/changepassword'); ?>",
			type: "POST",
			data: $("#changePasswordForm").serialize(),
			success: function(data){
					if(data == 1){
						Command: toastr["success"]("Redirecting Login page", "Password Changed Successfully")

						toastr.options = {
						  "closeButton": false,
						  "debug": false,
						  "newestOnTop": false,
						  "progressBar": false,
						  "positionClass": "toast-top-right",
						  "preventDuplicates": false,
						  "onclick": null,
						  "showDuration": "300",
						  "hideDuration": "1000",
						  "timeOut": "5000",
						  "extendedTimeOut": "1000",
						  "showEasing": "swing",
						  "hideEasing": "linear",
						  "showMethod": "fadeIn",
						  "hideMethod": "fadeOut"
						}
						window.setTimeout(function() {
						window.location.href = "<?php echo base_url('Parentlogin/logout') ?>";
						}, 3000);
					}else{
						Command: toastr["error"]("Can't Complete Your Request", "Failed")

						toastr.options = {
						  "closeButton": false,
						  "debug": false,
						  "newestOnTop": false,
						  "progressBar": false,
						  "positionClass": "toast-top-right",
						  "preventDuplicates": false,
						  "onclick": null,
						  "showDuration": "300",
						  "hideDuration": "1000",
						  "timeOut": "5000",
						  "extendedTimeOut": "1000",
						  "showEasing": "swing",
						  "hideEasing": "linear",
						  "showMethod": "fadeIn",
						  "hideMethod": "fadeOut"
						}
					}
				}
			});
		
	}
	function myFunction() {
		var x = document.getElementById("myInput");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
	function myFunction1() {
		var x = document.getElementById("conf_password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
	function clidk(){
		Command: toastr["success"]("Passowrd Change Successfully", "Success")

		toastr.options = {
		  "closeButton": false,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
	}
	function changePassword(empid)
	{
	  $('#changePasswordModal').modal({
	    backdrop: 'static',
	    keyboard: false
	  });
	  $('#studentid').val(empid);
	}
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
