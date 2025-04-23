<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
  }
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
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">General Setting </a> <i class="fa fa-angle-right"></i> Session Setting</li>
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
                    <a href="#" class="btn btn-black" onclick="addSession()"><i class="fa fa-plus"></i> Create New Session</a><br><br>
                    <table class="table table-bordered dataTable">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">Sr. No</th>
                          <th style="background: #337ab7; color: white !important;">Session</th>
                          <th style="background: #337ab7; color: white !important;">Year</th>
                          <th style="background: #337ab7; color: white !important;">Status</th>
                          <th style="background: #337ab7; color: white !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; foreach ($sessionData as $key => $value) { ?>
                          <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['Session_Nm']; ?></td>
                            <td><?php echo $value['Session_Year']; ?></td>
                            <td><?php if($value['Active_Status'] == 1)
                            {
                              echo "<label class='label label-success'>Active</label>";
                            } ?></td>
                            <td>
                              <?php if($value['Active_Status'] != 1){ ?>
                                <!-- <a href="#" class="btn-xs btn-black" data-toggle="tooltip" title="Edit" onclick="editSessionData('<?php echo $value['Session_ID']; ?>')"><i class="fa fa-pencil-square-o"></i> </a> -->
                              <?php } ?>
                            </td>
                          </tr>
                        <?php $i++; } ?>
                      </tbody>
                    </table>    
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

<!--create modal-->
<div class="modal fade" id="createSession">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Session</h4>
      </div>
      <form id="addNewSession">
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Session</label><span class="req">*</span>
                <input type="text" name="name" class="form-control" placeholder="YYYY-YYYY" autocomplete="off" id="name">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="save_btn">Save</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Edit Modal -->
<div class="modal fade" id="editSessionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Session</h4>
      </div>
      <form id="editSession">
        <input type="hidden" name="id" id="Session_ID">
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Session</label><span class="req">*</span>
                <input type="text" name="name" class="form-control" placeholder="YYYY-YYYY" autocomplete="off" id="editName">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update_btn">Update</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="loader"></div>
 <script type="text/javascript">
$('.loader').hide();

     $(function () {
    $('.dataTable').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true,
      'pageLength'  : 25
    })
  });


function addSession()
{
  $('#createSession').modal({
    backdrop: 'static',
    keyboard: false
  });
}

function editSessionData(id)
{
  $('#Session_ID').val(id);
  $.ajax({
      url: "<?php echo base_url('school_master/setting/getSingleSession'); ?>",
      type: "POST",
      data: {id:id},
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        $('#editSessionModal').modal({
          backdrop: 'static',
          keyboard: false
        });
        $('#editName').val(response.Session_Nm);
      }
    });
}

//validation of new shift creation
$(document).ready(function () {
    $('#addNewSession').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
                regex: /^[0-9-]{1,40}$/,
                remote: {
                    url: "<?php echo base_url('school_master/setting/checkSession'); ?>",
                    type: "post",
                    data: {
                      name: function() {
                        return $("#name").val();
                      }
                    }
                  },
            },
        },
        messages:{
          name:{
            remote:'Session name already exist'
          }
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

//edit session validation
$(document).ready(function () {
    $('#editSession').validate({ // initialize the plugin
        rules: {
            name: {
                required: true,
                regex: /^[0-9-]{1,40}$/,
                remote: {
                    url: "<?php echo base_url('school_master/setting/checkSession'); ?>",
                    type: "post",
                    data: {
                      name: function() {
                        return $("#editName").val();
                      }
                    }
                  },
            },
        },
        messages:{
          name:{
            remote:'Session name already exist'
          }
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
        "It accept digits and dash symbol only"
);

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

//creating new shift
 $("#save_btn").on("click", function(event){
  $("#addNewSession").validate();
  if ($('#addNewSession').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('school_master/setting/createSession'); ?>",
      type: "POST",
      data: $("#addNewSession").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#addNewSession')[0].reset();
          $('#createSession').modal('hide');
          swal({title: "Session Created Successfully", text: "Session Created Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal({title: "Session creation Failed", text: "Session creation Failed", type: "error"});
        }
      }
    });
   }
});


  //updating shift data
 $("#update_btn").on("click", function(event){
  $("#editSession").validate();
  if ($('#editSession').valid())
  {
    event.preventDefault();
     $.ajax({
      url: "<?php echo base_url('school_master/setting/updateSession'); ?>",
      type: "POST",
      data: $("#editSession").serialize(),
      dataType: 'json',
       beforeSend:function()
        {
          $('.loader').show();
          $('body').css('opacity', '0.5');
        },
      success: function(response){
        $('.loader').hide();
        $('body').css('opacity', '1.0');
        if(response.msg == 1)
        {
          $('#editSession')[0].reset();
          $('#editSessionModal').modal('hide');
          swal({title: "Session Updated Successfully", text: "Session Updated Successfully", type: "success"},
             function(){ 
                 location.reload();
             }
          );          
        }
        else
        {
          swal({title: "Session Updation Failed", text: "Session Updation Failed", type: "error"});
        }
      }
    });
   }
});
  </script>