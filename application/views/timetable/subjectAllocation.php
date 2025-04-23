<style type="text/css">
 .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td 
  {
    color: black;
    padding: 5px !important;
    font-size: 12px;
  }

    .backgroundRed{
        color: #ebddb7;
    }
</style>
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">Timetable</a> <i class="fa fa-angle-right"></i> Allocate Subject Teacher for Class</li>
</ol>
<!-- Content Wrapper. Contains page content -->
<div style="padding-left: 25px; background-color: white;border-top: 3px solid #5785c3;padding-top: 20px;font-size: 12px !important;">
  <div class="row">
    <div class="col-sm-12">
      <div class="" style="padding-bottom: 20px;">
        <section class="content">
          <div class="row">
            <div class="col-sm-4"> <?php echo form_open('#',array('role'=>'form','id'=>'createForm')); ?>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Subject Allocation for Teacher and Class / Section</p>
                  <hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <?php if($this->session->flashdata('msg')){ 
                      echo $this->session->flashdata('msg');
                     } ?>
                  <div class="form-group">
                    <label>Subject</label>
                    <span class="req">*</span>
                    <select class="form-control" name="subject_id" required="" id="subject_id" onchange="getTeacherList();getClassWithTeacherDetails();clearCombinedClassList();clearCombinedSubject();">
                      <option value="">Select</option>
                      <?php foreach ($subjectsList as $key => $value) { ?>
                      <option value="<?php echo $value['SubCode']; ?>"><?php echo $value['SubName']; ?></option>
                      <?php } ?>
                    </select>
                    <span class="error"><?php echo form_error('subject_id'); ?></span> </div>
                  <div class="form-group">
                    <label>Teacher Option</label>
                    <span class="req">*</span>
                    <select class="form-control" name="teacher_option" required="" id="teacher_option" onchange="clearCombinedClassListTeacherOption();getClassWithTeacherDetails();">
                      <option value="1">Main Teacher</option>
                      <option value="2">Support Teacher</option>
                    </select>
                    <span class="error"><?php echo form_error('teacher_option'); ?></span> </div>
                  <div class="form-group">
                    <div class="form-inline">
                      <input type="radio" name="teacher_list_load" value="1" checked="" id="load_all" onclick="getTeacherList()">
                      <label for="load_all">Load All Teacher List</label>
                    </div>
                    <div class="form-inline">
                      <input type="radio" name="teacher_list_load" value="2" id="load_selected" onclick="getTeacherList()">
                      <label for="load_selected">Load Teacher By Subject Preferences</label>
                    </div>
                    <span class="error"><?php echo form_error('floor_name'); ?></span> </div>
                  <div class="form-group">
                    <label>Teacher</label>
                    <span class="req">*</span>
                    <select class="form-control select2" name="teacher_id" required="" id="teacher_id" onchange="getSubjectListinTable();getTotalBundleandTotalPeriod();">
                    </select>
                    <span class="error"><?php echo form_error('teacher_id'); ?></span> </div>
                  <div class="form-group">
                    <label>Class - Section</label>
                    <span class="req">*</span>
                    <select class="form-control select2" name="class_name_Roman" required="" id="class_name_Roman" style="width: 100%;" onchange="classWiseSubjectDetails();clearCombinedClassList();clearCombinedSubject();">
                    </select>
                    <span class="error"><?php echo form_error('class_name_Roman'); ?></span></div>
                  <input type="hidden" name="is_combined_subject" value="0" id="is_combined_subject">
                  <div class="combined_subject_area" style="display: none;">
                    <div class="form-group">
                      <label>Select Other Class - Section for Merged Subject</label>
                      <select class="form-control select2" multiple="" name="combined_class[]" id="combined_class_list" style="width: 100%;">
                      </select>
					 
                    </div>
                    <div class="form-group">
                      <label id="divtoBlink">Merged Subject List</label>
                      <select multiple="" class="form-control" id="merged_subject_list">
                      </select>
                    </div>
					
                  </div>
				   <div class="form-group">
                      <span id="sec_cls"></span>
                    </div>
                </div>
				
				
                <div class="box-footer">
                  <button type="button" class="btn btn-black pull-right" onclick="savedSubjectAllocation()">Save</button>
                </div>
              </div>
              <?php echo form_close(); ?> </div>
            <div class="col-sm-4">
               <div class="box box-primary"> 
			   <span style="font-size: 12px !important;"> 
			    <div class="row">
			    <div class="col-sm-6">
			   <span style="background: #c5c9d1 !important;">Total Bundles : <strong id="total_bundles_text"></strong></span></div>
			    <div class="col-sm-6">
                <span style="background: #c5c9d1 !important;">Total Periods : <strong id="total_periods_text"></strong> </span></span></div>
				</div>
                <hr>
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Teacher Subject Bundle</p>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered dataTable table-striped">
                    <thead style="background: #d2d6de;">
                      <tr>
                        <th style="background: #337ab7; color: white !important;width:38px">S.No.</th>
                        <th style="background: #337ab7; color: white !important;width:50px">Class</th>
                        <th style="background: #337ab7; color: white !important;">Subject</th>
                        <th style="background: #337ab7; color: white !important;width:38px">Periods</th>
                      </tr>
                    </thead>
                    <tbody id="teacher_subject_bundle">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="box box-primary"> <span style="font-size: 12px !important;"> <span style="background: #c5c9d1 !important;">Class Teacher of Class</span> : <strong id="class_teacher_of_class"></strong>
                <br>
                </span>
                <hr>
                <div class="box-header with-border">
                  <p class="box-title" style="font-weight: bold;">Class Wise Subject Details</p>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="class_wise_subject_details">
                  <table class="table table-bordered dataTable table-striped">
                    <thead style="background: #d2d6de;">
                      <tr>
                        <th style="background: #337ab7; color: white !important;">S.No.</th>
                        <th style="background: #337ab7; color: white !important;">Subject</th>
                        <th style="background: #337ab7; color: white !important;">Periods</th>
                        <th style="background: #337ab7; color: white !important;width:100px">Main Teacher</th>
                        <th style="background: #337ab7; color: white !important;">Support Teacher</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <hr>
                  <p class="box-title" style="font-weight: bold;">Class-Section Subject Details</p>
                  <hr>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive class_section_subject_details">
                    <table class="table table-bordered dataTable table-striped">
                      <thead style="background: #d2d6de;">
                        <tr>
                          <th style="background: #337ab7; color: white !important;">S.No.</th>
                          <th style="background: #337ab7; color: white !important;">Class</th>
                          <?php foreach ($sectionList as $key => $value) { ?>
                          <th style="background: #337ab7; color: white !important;"><?php echo $value['SECTION_NAME']; ?></th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
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
<br>
<br>
<div class="modal fade" id="removeSubjectTeacherModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background: #205dc1;color: white;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Remove Subject Teacher</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <input type="hidden" name="class_section_wise_subject_display" class="class_section_wise_subject_display">
            <div class="form-group">
              <label>Class</label>
              <input type="text" name="" value="" class="form-control class_display" readonly="">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Section</label>
              <input type="text" name="" value="" class="form-control section_display" readonly="">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Subject Name</label>
              <input type="text" name="" value="" class="form-control subject_display" readonly="">
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label>Teacher Name</label>
              <input type="text" name="" value="" class="form-control teacher_display" readonly="">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="removeSelectedTeacherButton()">Remove Selected Teacher</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script type="text/javascript">

  $(function () {
    $('.dataTable').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : true
    })
  });

     //validation
$(document).ready(function () {

    $('#createForm').validate({ // initialize the plugin
        rules: {
            room_no: {
                remote: {
                url: '<?php echo base_url('timetable/floorclassdistribution/checkRoomNo'); ?>',
                type: "post",
                data: {
                  floor_name: function() {
                    return $( "#floor_name" ).val();
                  },
                  wing_name: function() {
                    return $( "#wing_name" ).val();
                  },
                  room_no: function() {
                    return $( "#room_no" ).val();
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


$('.select2').select2();
$('.select3').select2();


/**************P Function***********/

function getCombinedClassList()
{
  var subject_id = $('#subject_id').val();
  var class_sec_subcode = $('#class_name_Roman').val(); 
  var teacher_option = $('#teacher_option').val();  
  if(subject_id != '' && class_sec_subcode != '' && teacher_option == 2)
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getCombinedClassList'); ?>',
      method:"POST",
      data:{subject_id:subject_id,class_sec_subcode:class_sec_subcode},           
      success:function(response)
      {		 
        $('#sec_cls').html(response); 
      }
    });
  }
}



/*********************************/


function getTeacherList()
{
  var subject_id = $('#subject_id').val();
  var teacher_list_load = $('input[name="teacher_list_load"]:checked').val();
  var div_data = '<option value="">Select</option>';
  if(subject_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getTeacherList'); ?>',
      method:"post",
      data:{subject_id:subject_id,teacher_list_load:teacher_list_load},
      dataType:"json",
      success:function(response)
      {
        $.each(response,function(key,val){
          div_data += '<option value="'+val.EMPID+'">'+val.EMPID+' - '+val.EMP_FNAME+' '+val.EMP_MNAME+' '+val.EMP_LNAME+'</option>';
        });
        $('#teacher_id').html(div_data);
      }
    });
  }
  else
  {
    $('#teacher_id').html(div_data);
  }
  getClassListBySubject();
}

function getSubjectListinTable()
{
  var teacher_id = $('#teacher_id').val();
  if(teacher_id != '')
  {
    getClassTeacherClassDetails(teacher_id);
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getSubjectListByTeacherinTable'); ?>',
      method:"POST",
      data:{teacher_id:teacher_id},
      success:function(response)
      {
        $('#teacher_subject_bundle').html(response);
      }
    });
  }
}

function getClassTeacherClassDetails(teacher_id)
{
  $.ajax({
    url:'<?php echo base_url('timetable/subjectallocation/getClassTeacherClassDetails'); ?>',
    method:"POST",
    data:{teacher_id:teacher_id},
    success:function(response)
    {
      $('#class_teacher_of_class').html(response);
    }
  });
}

function getClassListBySubject()
{
  var subject_id = $('#subject_id').val();
  var div_data = '<option value="">Select</option>';
  if(subject_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getClassListBySubject'); ?>',
      method:"POST",
      data:{subject_id:subject_id},
      dataType:"json",
      success:function(response)
      {
          $.each(response,function(key,val){
              div_data += '<option value="'+val.Class_Sec_SubCode+'">'+val.Class_name_Roman+'</option>';
            });
            $('#class_name_Roman').html(div_data);
      }
    });
  }
  else
  {
    $('#class_name_Roman').html(div_data);
  }
}

function classWiseSubjectDetails()
{
  var class_sec_subcode = $('#class_name_Roman').val();
  var subject_id = $('#subject_id').val();

  $.ajax({
    url: '<?= base_url('timetable/subjectallocation/getSubjectDataByClassSecSubcode'); ?>',
    data:{class_sec_subcode:class_sec_subcode,subject_id:subject_id},
    method:"POST",
    success:function(response)
    {
      $('#class_wise_subject_details').html(response);
      getCombinedSubjectClassList();
	  getCombinedClassList()
    }
  });
}

function getCombinedSubjectClassList()
{
  var subject_id = $('#subject_id').val(); 
  var class_sec_subcode = $('#class_name_Roman').val();
  var teacher_option = $('#teacher_option').val();
  var div_data = '';
  var combinedSubjectList = '';
  if(subject_id != '' && class_sec_subcode != '' && teacher_option == 1)
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getCombinedSubjectClassList'); ?>',
      method:"POST",
      data:{subject_id:subject_id,class_sec_subcode:class_sec_subcode},
      dataType:"json",
      beforeSend:function()
      {
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        $('#is_combined_subject').val(0);
       if(response.show == 'Yes')
       {
        $('#is_combined_subject').val(1);
        $('.combined_subject_area').show();
        $.each(response.subjectList,function(key,val){
            combinedSubjectList += '<option>'+val.SubName+'</option>';
          });
         $('#merged_subject_list').html(combinedSubjectList);
         $.each(response.classsectionlist,function(key,val){
            div_data += '<option value="'+val.Class_Sec_SubCode+'">'+val.Class_name_Roman+'</option>';
          });
       }
        $('#combined_class_list').html(div_data);
      }
    });
  }
}

function getClassWithTeacherDetails()
{
  var subject_id = $('#subject_id').val();
  var teacher_option = $('#teacher_option').val();
  $.ajax({
    url: '<?= base_url('timetable/subjectallocation/getClassWithTeacherDetails'); ?>',
    data:{subject_id:subject_id,teacher_option:teacher_option},
    method:"POST",
    success:function(response)
    {
      $('.class_section_subject_details').html(response);
    }
  });
}

   setInterval(function(){
        $("#divtoBlink").toggleClass("backgroundRed");
     },500)

function clearCombinedClassList()
{
  $('#combined_class_list').html('');
  $('.combined_subject_area').hide();
}

	function clearCombinedClassListTeacherOption()
	{
	  var teacher_option = $('#teacher_option').val();
	  if(teacher_option == 2)
	  {
		$('#combined_class_list').html('');
		$('.combined_subject_area').hide();
		$('#merged_subject_list').html('');
		getCombinedClassList();
	  }
	  else
	  {
		getCombinedSubjectClassList();
	  }
	}
function clearCombinedSubject()
{
  $('#merged_subject_list').html('');
  $('.combined_subject_area').hide();
}

function savedSubjectAllocation()
{
  $('#createForm').validate();
  if($('#createForm').valid())
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/savedSubjectAllocation'); ?>',
      data:$('#createForm').serialize(),
      method:"POST",
      dataType:"json",
      beforeSend:function()
      {
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        if(response.msg == 1)
        {
          $.toast({
              heading: 'Success',
              text: 'Teacher Assigned Successfully',
              showHideTransition: 'slide',
              icon: 'success',
              position: 'top-right',
          });
          $('#createForm')[0].reset();
          $("#teacher_id").val(null).trigger("change");
          $("#class_name_Roman").val(null).trigger("change");
          $("#combined_class_list").val(null).trigger("change");
        }
        else if(response.msg == 2)
        {
          $.toast({
              heading: 'Error',
              text: 'Teacher Already Assigned !',
              showHideTransition: 'slide',
              icon: 'error',
              position: 'top-right',
          });
        }
        else if(response.msg==3)
        {
          $.toast({
                heading: 'Error',
                text: 'Support Teacher Not Required for This Subject !',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
        }
      }
    });
  }
}

function getTotalBundleandTotalPeriod()
{
  var teacher_id = $('#teacher_id').val();
  if(teacher_id != '')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getTotalBundleandTotalPeriod'); ?>',
      method:"post",
      data:{teacher_id:teacher_id},
      dataType:"json",
      beforeSend:function()
      { 
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        $('#total_periods_text').html(response.total_period);
        $('#total_bundles_text').html(response.Bundle_Count);
      }
    });
  }
}

function removeSelectedTeacher(class_id,section_id)
{
  var subject_id = $('#subject_id').val();
  var teacher_option = $('#teacher_option').val();
  var removeText = $('.remove_'+class_id+'_'+section_id).text();
  if(removeText == null)
  {
    alert('yes');
  }

  if(class_id != '' && section_id != '' && subject_id != '' && removeText != 'X')
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/getClassDetailsByTeacher'); ?>',
      data:{class_id:class_id,section_id:section_id,subject_id:subject_id,teacher_option:teacher_option},
      dataType:"json",
      method:"post",
      beforeSend:function()
      {
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        $('.class_section_wise_subject_display').val(response.ID);
        $('.class_display').val(response.CLASS_NM);
        $('.section_display').val(response.SECTION_NAME);
        $('.subject_display').val(response.subj_nm);
        if(teacher_option == 1)
        {
          $('.teacher_display').val(response.EMP_NAME);
        }
        else
        {
          $('.teacher_display').val(response.EMP_NAME_SUPPORT);
        }
        $('#removeSubjectTeacherModal').modal({
          keyboard:false,
          backdrop:"static"
        });
      }
    });
  }
}

function removeSelectedTeacherButton()
{
  var class_wise_subject_allocation_id = $('.class_section_wise_subject_display').val();
  var teacher_option = $('#teacher_option').val();
  if(confirm('Do you want to remove this teacher?'))
  {
    $.ajax({
      url:'<?php echo base_url('timetable/subjectallocation/removeSelectedTeacherButton'); ?>',
      method:'POST',
      data:{id:class_wise_subject_allocation_id,teacher_option:teacher_option},
      dataType:"json",
      beforeSend:function()
      {
        showLoader();
      },
      success:function(response)
      {
        hideLoader();
        if(response == 1)
        {
          $.toast({
                heading: 'Success',
                text: 'Teacher Removed Successfully',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right',
            });
        }
        else
        {
          $.toast({
                heading: 'Error',
                text: 'Failed !',
                showHideTransition: 'slide',
                icon: 'error',
                position: 'top-right',
            });
        }
        $('#removeSubjectTeacherModal').modal('hide');
        getClassWithTeacherDetails();
      }
    });
  }
}

  </script>
