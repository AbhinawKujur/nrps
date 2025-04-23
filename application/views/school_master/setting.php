 <style type="text/css">
   .error{
    color: red;
   }
 </style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">General Setting </a> <i class="fa fa-angle-right"></i> School Setting</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
<div style="background-color: white;padding: 20px;border-top: 3px solid #5785c3;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="box box-primary">
              <!-- /.box-header -->
              <div class="box-body">
                <?php if($this->session->flashdata('msg')){ 
                  echo $this->session->flashdata('msg');
                 } ?>
                <form id="setting_form" method="post" action="<?php echo base_url('school_master/setting/update'); ?>" enctype="multipart/form-data">
                  <div class="row"> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Name</label><span class="req">*</span>
                          <input type="text" name="name" class="form-control" value="<?php echo $singleData['School_Name']; ?>" style="text-transform: uppercase;" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Short Name</label><span class="req">*</span>
                          <input type="text" name="short_name" class="form-control" value="<?php echo $singleData['short_nm']; ?>" style="text-transform: uppercase;" autocomplete="off">
                        </div>
                      </div>   
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Email</label><span class="req">*</span>
                          <input type="email" name="email" class="form-control" value="<?php echo $singleData['School_Email']; ?>" autocomplete="off">
                        </div>
                      </div> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Website URL</label>
                          <input type="text" name="website" class="form-control" value="<?php echo $singleData['School_Webaddress']; ?>" autocomplete="off">
                        </div>
                      </div> 
                    </div>
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Phone</label>
                          <input type="text" name="phone" class="form-control" value="<?php echo $singleData['School_PhoneNo']; ?>" autocomplete="off">
                        </div>
                      </div> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Mobile</label><span class="req">*</span>
                          <input type="text" name="mobile" class="form-control" value="<?php echo $singleData['School_MobileNo']; ?>" autocomplete="off">
                        </div>
                      </div>   
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>School Code</label>
                          <input type="text" name="sch_code" class="form-control" value="<?php echo $singleData['School_Code']; ?>" autocomplete="off">
                        </div>
                      </div>     
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>School Affiliation No</label>
                          <input type="text" name="sch_afft_no" class="form-control" value="<?php echo $singleData['School_AfftNo']; ?>" autocomplete="off">
                        </div>
                      </div>   
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Auth Key</label><span class="req">*</span>
                          <input type="text" name="auth_key" class="form-control" value="<?php echo $singleData['auth_key']; ?>" autocomplete="off" required="">
                        </div>
                      </div>  
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>Sender ID</label><span class="req">*</span>
                          <input type="text" name="sender_id" class="form-control" value="<?php echo $singleData['sender_id']; ?>" autocomplete="off" maxLength="6" style="text-transform: uppercase;"required="">
                        </div>
                      </div>  
                    </div>
                    <div class="row"> 
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Session</label><span class="req">*</span>
                          <select class="form-control" name="session">
                            <option value="">Select Session</option>
                            <?php foreach ($session as $key => $value) { ?>
                              <option value="<?php echo $value['Session_Nm']; ?>" <?php if(set_value('session',$singleSession['Session_Nm']) == $value['Session_Nm']){
                                echo "selected"; 
                              } ?>><?php echo $value['Session_Nm']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>    
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Change Logo</label>
                          <input type="file" name="logo" class="form-control">
                        </div>
                      </div>    
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label>School Address</label><span class="req">*</span>
                          <textarea class="form-control" name="address" autocomplete="off"><?php echo $singleData['School_Address']; ?></textarea>
                        </div>
                      </div>        
                  </div> 
                  <div class="row">
                    <div class="col-sm-3">
						<div class="form-group">
                          <label>Board</label><span class="req">*</span>
                          <input type="text" class="form-control" value="<?php echo $singleData['board']; ?>" name="board" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-sm-3">
                      <img src="<?php echo base_url($singleData['SCHOOL_LOGO']); ?>" width="100px" height="100px">
                    </div>
                  </div>
                  <button class="btn btn-primary pull-right">Update</button>
                </form> 
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
      </div>
    </div>
  </div>
</div>
<br><br>
   <script type="text/javascript">

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      "pageLength": 50,
      "bSortCellsTop": true,
      dom: 'Bfrtip',
          buttons: [
              'copy', 'excel',
          ],
    })
  });



//validation code
$(document).ready(function () {
    $('#setting_form').validate({ // initialize the plugin
        rules: {
            name: {
				regex: /^[a-zA-Z 0-9-,]{2,}$/,
                required: true
            },
            short_name: {
                required: true
            },
            email:{
              required: true
            },
            phone:{
              digits: true
            },
            mobile:{
              digits: true,
              required: true
            },
            sch_code:{
              digits: true
            },
            session:{
              required: true
            },
            address:{
              regex: /^[a-zA-Z0-9\s,/-]{1,40}$/,
              required: true
            },
            logo: {
              extension: "jpg|jpeg|png"
            },
			board: {
				regex: /^[a-zA-Z]{2,}$/,
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

//validation of regex
$.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            if (regexp.constructor != RegExp)
                regexp = new RegExp(regexp);
            else if (regexp.global)
                regexp.lastIndex = 0;
            return this.optional(element) || regexp.test(value);
        },
        "It accept alphanumeric and , / - only"
);
  </script>