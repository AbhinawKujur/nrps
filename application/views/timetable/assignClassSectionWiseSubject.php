<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Class Wise Subject Allocation</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="padding-left: 25px; background-color: white;padding-top: 5px;padding-top: 20px;">
  <div class="row">
  <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4">
              <form role="form" action="<?php echo base_url('timetable/assignclasswisesubject'); ?>" method="post" id="createForm">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Assign Class Section Wise Subject</p><hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                        <?php if($this->session->flashdata('msg'))
                        {
                          echo $this->session->flashdata('msg');
                        } ?>
                          <div class="form-group">
                            <label class="control-label">Class</label><span class="req"> *</span>
                            <select class="form-control" name="class_id" id="class_id" onchange="getSectionByClassID();clearAllSelection();" required="">
                              <option value="">Select</option>
                              <?php foreach ($classList as $key => $value) { ?>
                                <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label class="control-label">Section</label><span class="req"> *</span>
                            <select class="form-control" name="section_id" id="section_id" required="" onchange="clearAllSelection();showTable()">
                              
                            </select>
                          </div>

                          <div class="form-group">
                            <label class="control-label">Subject</label><span class="req"> *</span>
                            <select class="form-control select2" name="subject_id" id="subject_id" onchange="getCombinedSubjectList()" required="">
                              <option value="">Select</option>
                              <?php foreach ($subjectList as $key => $value) { ?>
                                <option value="<?php echo $value['SubCode']; ?>"><?php echo $value['SubName']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label class="control-label">Total Period in Week</label><span class="req"> *</span>
                            <select class="form-control" name="total_period" id="total_period" required="">
                              <option value="">Select</option>
                              <?php for ($i=1; $i<=10;$i++) { ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label class="control-label">Required Support Teacher</label>
                            <select class="form-control" name="required_support_teacher" id="required_support_teacher" onchange="hideCombinedSubject()">
                              <option value="0">No</option>
                              <option value="1">Yes</option>
                            </select>
                          </div>

                          <div class="form-group" id="combined_subject_field">
                            <label class="control-label">Combined Subject</label>
                            <select class="form-control select2" name="combined_subject[]" id="combined_subject" multiple="">
                              
                            </select>
                          </div>


                          <button type="button" class="btn btn-success pull-right" name="save" onclick="createNewClassSectionSubject()">Save</button>
                        </div>
                      </div>
              </form>
            </div>


            <div class="col-sm-8">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <p class="box-title" style="font-weight: bold;">Class Section Wise Subject List &nbsp; &nbsp; &nbsp;  <b><i>Note : </i></b>
                      <span style="padding: 0px 10px;background: #ccd7e6 !important;"></span> &nbsp; Support Teacher Required &nbsp; &nbsp; &nbsp;
                      <span style="padding: 0px 10px;background: #e89c84 !important;"></span> &nbsp; Combined Subject
                    </p><hr>
                    <button class="btn btn-primary" type="button" data-keyboard="false" data-backdrop="static" data-toggle="modal" data-target="#periodUpdationModal"><i class="fa fa-edit" style="color:white !important;"></i> Period Updation</button>
                    <button class="btn btn-black" type="button" onclick="openCreateNewClassSecModal()"><i class="fa fa-exchange" style="color:white !important;"></i> Copy &amp; Create New Class / Section </button>
                    <hr>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" id="classSecSubjectList">
                     
                  </div>
                </div>
            </div>
          </div>
          <!-- /.box -->
        </section>

      </div>
    </div>
  </div>
</div><br><br>

<div class="modal fade" id="periodUpdationModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> Close</button>
        <h4 class="modal-title">Period Updation By Selected Class</h4>
      </div>
      <?php echo form_open('#',array('id'=>'editForm')); ?>
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-12">
              <div class="form-group">
                <label>Class</label><span class="req"> *</span>
                <select class="form-control" name="class_id" id="class_id_period_updation" onchange="getPeriodUpdationSubjectList()" required="">
                  <option value="">Select</option>
                  <?php foreach ($classList as $key => $value) { ?>
                    <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                  <?php } ?>
                </select>
              </div>   
               
            </div>
          </div>
          <div class="row"> 
            <div class="col-sm-12" id="periodUpdationModalData">
              
            </div>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="copyAndCreateNewClassSec">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span> Close</button>
        <h4 class="modal-title">Copy &amp; Create New Class / Section</h4>
      </div>
      <?php echo form_open('#',array('id'=>'createNewClassSectionForm')); ?>
        <div class="modal-body">
          <div class="row"> 
            <div class="col-sm-4">
              <div class="form-group">
                <label>Class</label><span class="req"> *</span>
                <select class="form-control select2" name="class_id" id="class_id_copy_creation" onchange="getSubjectByClassSectionCode()" required="" style="width: 100%;">
                  <option value="">Select Class - Section</option>
                  
                </select>
              </div>   
               
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Creation Class</label><span class="req"> *</span>
                <select class="form-control" name="class_id" id="class_id_copy_creation_for_sec" onchange="getSectionByClassIDAtClassCopy()" required="">
                  <option value="">Select Class</option>
                  <?php foreach ($classList as $key => $value) { ?>
                    <option value="<?php echo $value['Class_No']; ?>"><?php echo $value['CLASS_NM']; ?></option>
                  <?php } ?>
                </select>
              </div>               
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label>Uncreated Section</label><span class="req"> *</span>
                <select class="form-control select2" name="section_id[]" id="uncreatedSection" required="" style="width: 100%;" multiple="">
                  
                </select>
              </div>               
            </div>
            <div class="col-sm-2">
                <br>
                <button type="button" class="btn btn-success createBtn" onclick="createCopyClassSectionSubject()"><i class="fa fa-plus-circle" style="color: white !important;"></i> Create</button>            
                <button type="button" class="btn btn-success processingBtn" onclick="createCopyClassSectionSubject()" style="display: none;"><i class="fa fa-circle-o-notch fa-spin" style="color: white !important;"></i></button>            
            </div>
          </div>
          <div class="row"> 
            <div class="col-sm-12" id="copyAndCreateNewClassSecModalData">
              
            </div>
          </div>
        </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



  <script type="text/javascript">

$('.select2').select2();

function showTable(class_id=null,section_id=null)
{
  if(class_id==null || section_id == null)
  {
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
  }

  $.ajax({
    url: '<?= base_url('timetable/assignclasswisesubject/getSubjectDataByClassSection'); ?>',
    data:{class_id:class_id,section_id:section_id},
    method:"POST",
    success:function(response)
    {
      $('#classSecSubjectList').html(response);
    }
  });
}

function getPeriodUpdationSubjectList(class_id=null)
{
  if(class_id==null)
  {
    var class_id = $('#class_id_period_updation').val();
  }

  $.ajax({
    url: '<?= base_url('timetable/assignclasswisesubject/getSubjectDataByClass'); ?>',
    data:{class_id:class_id},
    method:"POST",
    success:function(response)
    {
      $('#periodUpdationModalData').html(response);
    }
  });
}

function getSubjectByClassSectionCode(class_sec_id=null)
{
  if(class_sec_id==null)
  {
    var class_sec_id = $('#class_id_copy_creation').val();
  }

  $.ajax({
    url: '<?= base_url('timetable/assignclasswisesubject/getSubjectByClassSectionCode'); ?>',
    data:{class_sec_id:class_sec_id},
    method:"POST",
    success:function(response)
    {
      $('#copyAndCreateNewClassSecModalData').html(response);
    }
  });
}


 $( document ).ajaxComplete(function() {
      $('.dataTable').DataTable({
          'paging'      : false,
          'lengthChange': false,
          'searching'   : true,
          'ordering'    : false,
          'info'        : true,
          'autoWidth'   : true,
          'pageLength'  : 25,
          "destroy": true,
        });
  });


$('.select2').select2();
     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin 
        rules: {
            subject_id: {
              remote: {
                url: '<?php echo base_url('timetable/assignclasswisesubject/checkSubjectAlreadyExist'); ?>',
                type: "post",
                data: {
                  class_id: function() {
                    return $( "#class_id" ).val();
                  },
                  section_id: function() {
                    return $( "#section_id" ).val();
                  },
                  subject_id: function() {
                    return $( "#subject_id" ).val();
                  }
                }
              },
            },
        },
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

$(".select2").on("select2:close", function (e) {  
        $(this).valid(); 
    });


     //validation
$(document).ready(function () {

    $('#editForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});

function createNewClassSectionSubject()
{
  $('#createForm').validate();
  if($('#createForm').valid())
  {
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    var subject_id = $('#subject_id').val();
    $.ajax({
      url:'<?php echo base_url('timetable/assignclasswisesubject/checkSubjectAlreadyExist'); ?>',
      data:{class_id:class_id,subject_id:subject_id,section_id:section_id},
      method:"post",
      dataType:"json",
      beforeSend:function()
      {
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        if(response=='true')
        {
          $.ajax({
              url:'<?php echo base_url('timetable/assignclasswisesubject/createData'); ?>',
              data:$('#createForm').serialize(),
              method:"post",
              dataType:"json",
              success:function(response)
              {
                if(response==1)
                {
                  $.toast({
                        heading: 'Success',
                        text: 'Created Successfully',
                        showHideTransition: 'slide',
                        icon: 'success',
                        position: 'top-right',
                    });
                  $('#createForm')[0].reset();
                  $("#subject_id").val(null).trigger("change");
                  $("#combined_subject").val(null).trigger("change");
                  showTable(class_id,section_id);
                }else{
                  $.toast({
                        heading: 'Error',
                        text: 'Failed !',
                        showHideTransition: 'slide',
                        icon: 'error',
                        position: 'top-right',
                    });
                }
              }
            });
        }else{
          $.toast({
                heading: 'Warning',
                text: 'Subject already available in this class section',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
        }
      }
    });
  }
}

function getSectionByClassID()
{
  var class_id = $('#class_id').val();
  var div_data = '<option value="">Select</option>';
  if(class_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/assignclasswisesubject/getSectionByClassID'); ?>',
      data:{class_id:class_id},
      method:"post",
      dataType:"json",
      success:function(response)
      {
        $.each(response, function(key,val){
          div_data += '<option value="'+val.SEC+'">'+val.DISP_SEC+'</option>';
        });
        $('#section_id').html(div_data);
      }
    }); 
  }
  else
  {
    $('#section_id').html(div_data);
  }

}

function getCombinedSubjectList()
{
  var subject_id = $('#subject_id').val();
  var class_id = $('#class_id').val();
  var section_id = $('#section_id').val();
  var div_data ='';
  if(subject_id != '' || class_id != '' || section_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/assignclasswisesubject/getCombinedSubjectListBySubjectID'); ?>',
      data:{subject_id:subject_id,class_id:class_id,section_id:section_id},
      method:"post",
      dataType:"json",
      success:function(response)
      {
        $.each(response, function(key,val){
          div_data += '<option value="'+val.SubCode+'">'+val.SubName+'</option>';
        });
        $('#combined_subject').html(div_data);
      }
    }); 
  }
  else
  {
     $('#combined_subject').html(div_data);
  }
}

function clearAllSelection()
{
  $("#subject_id").select2();
  $("#subject_id").val(null).trigger("change");
  $("#createForm").validate().resetForm();
}


function hideCombinedSubject()
{
  var support_teacher = $('#required_support_teacher').val();
  if(support_teacher==1)
  {
    $('#combined_subject_field').hide();
  }
  else
  {
    $('#combined_subject_field').show();
  }
}

function removeSubjectWithMergeCode(id)
{
  if(confirm('If you remove this subject then all subjects merged with this subject will be deleted?'))
  {
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    if(class_id == '' && section_id=='')
    {
      alert('Please select class and section first');
    }
    else
    {
      $.ajax({
          url:'<?php echo base_url('timetable/assignclasswisesubject/checkMarksEnteredorNot'); ?>',
          method:"POST",
          data:{id:id},
          dataType:"json",
          beforeSend:function()
          {
            showLoader();
          },
          success:function(response)
          {
            hideLoader();
            if(response.delete_status==1)
            {
                $.ajax({
                  url:'<?php echo base_url('timetable/assignclasswisesubject/removeSubjectWithMergeCode'); ?>',
                  method:"POST",
                  data:{id:id},
                  dataType:"json",
                  success:function(response)
                  {
                    if(response == 1)
                    {
                      showTable(class_id,section_id);
                      $.toast({
                            heading: 'Success',
                            text: 'Removed Successfully',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right',
                        });
                    }
                    else if(response == 2)
                    {
                      $.toast({
                            heading: 'Error',
                            text: 'Failed !',
                            showHideTransition: 'slide',
                            icon: 'error',
                            position: 'top-right',
                        });
                    }
                  }
                });
            }
            else
            {
              alert('Marks already entered thats why you are not able to delete this subject');
            }
          }
        });
    }
  }
}

function removeSubjectWithoutMergeCode(id)
{
  if(confirm('Do you want to remove this subject?'))
  {
    
    var class_id = $('#class_id').val();
    var section_id = $('#section_id').val();
    if(class_id == '' && section_id=='')
    {
      alert('Please select class and section first');
    }
    else
    {
       $.ajax({
          url:'<?php echo base_url('timetable/assignclasswisesubject/checkMarksEnteredorNot'); ?>',
          method:"POST",
          data:{id:id},
          dataType:"json",
          beforeSend:function()
          {
            showLoader();
          },
          success:function(response)
          {
            hideLoader();
            if(response.delete_status==1)
            {
              $.ajax({
                url:'<?php echo base_url('timetable/assignclasswisesubject/removeSubjectWithoutMergeCode'); ?>',
                method:"POST",
                data:{id:id},
                dataType:"json",
                success:function(response)
                {
                  if(response == 1)
                  {
                    showTable(class_id,section_id);
                    $.toast({
                          heading: 'Success',
                          text: 'Removed Successfully',
                          showHideTransition: 'slide',
                          icon: 'success',
                          position: 'top-right',
                      });
                  }
                  else if(response == 2)
                  {
                    $.toast({
                          heading: 'Error',
                          text: 'Failed !',
                          showHideTransition: 'slide',
                          icon: 'error',
                          position: 'top-right',
                      });
                  }
                }
              });
            }
            else
            {
              alert('Marks already entered thats why you are not able to delete this subject');
            }
          }
        });
    }
  }
}

function updatePeriod(class_id,subject_code)
{
  var total_period = $('#total_period_'+class_id+'_'+subject_code).val();
  $.ajax({
      url:'<?php echo base_url('timetable/assignclasswisesubject/updateClassWisePeriod'); ?>',
      method:"POST",
      data:{total_period:total_period,class_id:class_id,subject_code:subject_code},
      success:function(response)
      {
        if(response == 1)
        {
          getPeriodUpdationSubjectList(class_id);
          $.toast({
                heading: 'Success',
                text: 'Updated Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
        }
        else if(response == 2)
        {
          $.toast({
                heading: 'Error',
                text: 'Failed !',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
        }
      }
    });
}


function getSectionByClassIDAtClassCopy()
{
  var class_id = $('#class_id_copy_creation_for_sec').val();
  var div_data = '';
  if(class_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/assignclasswisesubject/getSectionByClassIDAtCopyCreation'); ?>',
      data:{class_id:class_id},
      method:"post",
      dataType:"json",
      success:function(response)
      {
        $.each(response, function(key,val){
          div_data += '<option value="'+val.SEC+'">'+val.DISP_SEC+'</option>';
        });
        $('#uncreatedSection').html(div_data);
      }
    }); 
  }
  else
  {
    $('#uncreatedSection').html(div_data);
  }
}

function createCopyClassSectionSubject()
{
  var class_sec_subcode = $('#class_id_copy_creation').val();
  var class_id_new = $('#class_id_copy_creation_for_sec').val();
  var section_id = $('#uncreatedSection').val();

  if(class_sec_subcode != '' && class_id_new != '' && section_id != '')
  {
    $('.createBtn').hide();
    $('.processingBtn').show();
    $.ajax({
      url:'<?php echo base_url('timetable/assignclasswisesubject/createCopyClassSectionSubject'); ?>',
      data:{class_sec_subcode:class_sec_subcode,class_id_new:class_id_new,section_id:section_id},
      method:"post",
      dataType:"json",
      success:function(response)
      {
        if(response == 1)
        {
          $.toast({
                heading: 'Success',
                text: 'Subject list copied successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
        }
        else if(response == 2)
        {
          $.toast({
                heading: 'Error',
                text: 'Subject already assigned to this class section !',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
        }
        $('.createBtn').show();
        $('.processingBtn').hide();
      }
    }); 
  }
  else
  {
    alert('Please select all field');
  }
}

$('#periodUpdationModal').on('hidden.bs.modal', function () {
   location.reload();
  });
$('#copyAndCreateNewClassSec').on('hidden.bs.modal', function () {
   location.reload();
  });


function openCreateNewClassSecModal()
{
  var div_data = '<option value="">Select</option>';
  $.ajax({
    url:'<?php echo base_url('timetable/assignclasswisesubject/getCreatedClassSection'); ?>',
    method:"post",
    dataType:"json",
    success:function(response)
    {
      $('#copyAndCreateNewClassSec').modal({
        backdrop:"static",
        keyboard:false,
      });
      $.each(response,function(key,val){
        div_data += '<option value="'+val.Class_Sec_SubCode+'">'+val.Class_name_Roman+'</option>';
      });
      $('#class_id_copy_creation').html(div_data);
    }
  });
}

  </script>
