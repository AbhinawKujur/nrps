<style type="text/css">
  .error{
    color: red;
   }
.loader {
  position: fixed;
  top: 50%;
  left: 50%;
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
  z-index: 999;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media print {
  .hide-print {
    display: none;
  }
}

</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-angle-right"></i> Auto Punch</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                  <!-- /.box-header -->
                  <div class="box-body">
                    <form id="createForm">
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Month</label><span class="req">*</span>
                            <select class="form-control" name="month">
                              <option value="">Select Month</option>
                              <?php foreach ($month as $key => $value) { ?>
                                <option value="<?php echo $value['month_code']; ?>"><?php echo $value['month_name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label></label>
                            <button class="btn btn-success form-control" id="save_btn" type="button"><i class="fa fa-save"></i> Generate</button>
                          </div>
                        </div>
                      </div><hr>
                    </form>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
<div class="loader"></div>
 <script type="text/javascript">
$('.loader').hide();

//validation
$(document).ready(function () {
    $('#createForm').validate({ // initialize the plugin
        rules: {
            month: {
                required: true
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//creating new shift
 $("#save_btn").on("click", function(event){
  $("#createForm").validate();
  if ($('#createForm').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('punching/autopunching/createPunching'); ?>",
      type: "POST",
      data: $("#createForm").serialize(),
      dataType: 'json',
      beforeSend:function()
      {
        showLoader();
      },
      success: function(response){
        hideLoader();
        if(response.msg == 1)
        {
          alert('Attendance Generated Successfully');
          $('#createForm')[0].reset();

        }
        else if(response.msg==2)
        {
          swal("Failed !");
        }
        else if(response.msg==3)
        {
          swal("Attendance Already Generated");
        }
      }
    });
   }
});

</script>