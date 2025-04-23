<style type="text/css">
  .thead-color{
    background: #c7b9b7 !important;
    color: black !important;
  }
  .table{
    white-space: nowrap;
    font-size: 12px !important;
  }
</style>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Student Attendance</a> <i class="fa fa-angle-right"></i> Monthly Attendance Report</li>
</ol>
  <!-- Content Wrapper. Contains page content -->
  <div style="background-color: white;">
    <div class="row">
      <div class="col-sm-12">
        <div class="" style="padding-bottom: 20px;">
          <section class="content">
              <div class="panel panel-default" style="background: #edecec !important;color: black;font-size: 13px;border: 1px solid #337ab7;">
                <div class="panel-heading" style="background: #337ab7;color: white;"><i class="fa fa-search"></i> Search Criteria</div>
                <div class="panel-body">
                  <form id="searchForm" action="<?php echo base_url('student/report/report/monthly_wise'); ?>" method="post">
                    <div class="row">
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Class :</label><span class="req"> *</span>
                          <select class="form-control" name="class_id" id="class_id" required="" onchange="getSectionByClassID()">
                            <option value="">Select</option>
                            <?php foreach ($classList as $key => $value) { ?>
                              <option value="<?php echo $value['Class_No']; ?>" <?php if(set_value('class_id')==$value['Class_No']){ echo "selected"; } ?>><?php echo $value['CLASS_NM']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Section :</label><span class="req"> *</span>
                          <select class="form-control" name="section_id" id="section_id" required="">
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Month :</label><span class="req"> *</span>
                          <select class="form-control" name="month_id" id="month_id" required="">
                            <option value="">Select</option>
                            <?php foreach ($monthList as $key => $value) { ?>
                              <option value="<?php echo $value['month_code']; ?>" <?php if(set_value('month_id')==$value['month_code']){ echo "selected"; } ?>><?php echo $value['month_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-2">
                        <div class="form-group">
                          <label></label><br>
                          <button class="btn btn-black pull-right form-control" type="submit" name="search" onclick="showProcessing()"> <i class="fa fa-search"></i> Search</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <!-- /.box -->
          </section>
        </div>
      </div>

    <?php if(isset($resultList)): ?>
      <div class="col-sm-12">
        <div class="panel panel-default" style="background: #edecec !important;color: black;font-size: 13px;border: 1px solid #337ab7;">
          <div class="panel-heading" style="background: #337ab7;color: white;"><i class="fa fa-users"></i> Monthly Attendance Report</div>
          <div class="panel-body">
            <div class="table-responsive">

              <?php if($att_type==1){ ?>
                <table class="table table-striped table-bordered datatable" style="border: 1px solid #b2b9c4;">
                  <thead>
                    <tr>
                      <th class="thead-color text-center">ADM NO</th>
                      <th class="thead-color">Student Name</th>
                      <th class="thead-color text-center">Roll No</th>
                      <!--<th class="thead-color text-center">Class</th>
                      <th class="thead-color text-center">Sec</th>
                      <th class="thead-color text-center">Mobile</th>-->
                      <?php for ($i=1; $i <= $total_days; $i++){ 
                        $date = $current_year.'-'.$month.'-'.$i;
                        ?>
                        <th class="thead-color text-center"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($resultList as $key => $value){ ?>
                      <tr>
                        <td><?php echo $value['admno']; ?></td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['roll']; ?></td>
                        <!--<td><?php //echo $value['class']; ?></td>
                        <td><?php //echo $value['sec']; ?></td>
                        <td><?php //echo $value['mobile']; ?></td>-->
                        <?php for ($k=1; $k <= $total_days; $k++) { ?>
                          <td>
                            <?php 
                              if($value[$k]['status'] == 'H')
                              {
                                echo '<strong><span style="color:#ad7e44;">'.$value[$k]['status'].'</span></strong>'; 
                              }
                              elseif($value[$k]['status'] == 'P' || $value[$k]['status'] == 'HD')
                              {
                                echo '<strong><span style="color:green;">'.$value[$k]['status'].'</span></strong>';
                              }
                              elseif($value[$k]['status'] == 'A')
                              {
                                echo '<strong><span style="color:red;">'.$value[$k]['status'].'</span></strong>';
                              }else
                              {
                                echo '<strong>'.$value[$k]['status'].'</strong>';
                              }
                            ?></td>
                        <?php } ?> 
                      </tr>
                    <?php }
                    ?>
                  </tbody>
                </table>
              <?php } else { ?>
                <table class="table table-striped table-bordered datatable" style="border: 1px solid #b2b9c4;">
                  <thead>
                    <tr>
                      <th class="thead-color text-center">ADM NO</th>
                      <th class="thead-color">Student Name</th>
                      <th class="thead-color text-center">Roll No</th>
                      <!--<th class="thead-color text-center">Class</th>
                      <th class="thead-color text-center">Sec</th>
                      <th class="thead-color text-center">Mobile</th>-->
                      <th class="thead-color text-center">Period</th>
                      <?php for ($i=1; $i <= $total_days; $i++){ 
                        $date = $current_year.'-'.$month.'-'.$i;
                        ?>
                        <th class="thead-color text-center"><?php echo $i.'<br> '.date("D", strtotime($date)); ?></th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach($resultList as $key => $value){ 
                        for($i=1; $i<=8; $i++){
                          ?>
                          <tr>
                          <?php if($i == 1){ ?>
                            <td><?php echo $value['admno']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['roll']; ?></td>
                            <!--<td><?php //echo $value['class']; ?></td>
                            <td><?php //echo $value['sec']; ?></td>
                            <td><?php //echo $value['mobile']; ?></td>-->
                          <?php }else{ ?>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          <?php } ?>
                            <td><?php echo "<b>P-". $i ."</b>"; ?></td>
                            <?php for ($k=1; $k <= $total_days; $k++) { ?>
                              <td>
                                <?php 
                                  if($value[$k]['p'.$i] == 'H')
                                  {
                                    echo '<strong><span style="color:#ad7e44;">'.$value[$k]['p'.$i].'</span></strong>'; 
                                  }
                                  elseif($value[$k]['p'.$i] == 'P')
                                  {
                                    echo '<strong><span style="color:green;">'.$value[$k]['p'.$i].'</span></strong>';
                                  }
                                  elseif($value[$k]['p'.$i] == 'A')
                                  {
                                    echo '<strong><span style="color:red;">'.$value[$k]['p'.$i].'</span></strong>';
                                  }else
                                  {
                                    echo '<strong>'.$value[$k]['p'.$i].'</strong>';
                                  }
                                ?></td>
                            <?php } ?> 
                          </tr>  
                          <?php
                        }
                      }
                      ?>
                  </tbody>
                </table>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
    </div>
  </div><br><br>

<script type="text/javascript">
     //validation
$(document).ready(function () {

    $('#searchForm').validate({ // initialize the plugin
        submitHandler: function (form) { // for demo 
             if ($(form).valid()) 
                 form.submit(); 
             return false; // prevent normal form posting
        }
    });
});
  
  $(function(){
    getSectionByClassID(1);
  })
  function getSectionByClassID(autocall=null)
  {
    var class_id = $('#class_id').val();
    
    var section_id = (autocall==1)?'<?php echo set_value('section_id'); ?>':0;

    if(class_id != '')
    {
      $.ajax({
        url:'<?php echo base_url('student/report/report/getSectionByClassID'); ?>',
        data:{class_id:class_id},
        method:"post",
        dataType:"json",
        success:function(response)
        {
          var sel;
          var div_data = '<option value="">Select</option>';
          $.each(response, function( key, value ) {
          sel='';
            if(section_id == value.SEC)
            {
              sel = "selected";
            }
            div_data += '<option value="'+value.SEC+'"'+sel+'>'+value.DISP_SEC+'</option>';
          });
          $('#section_id').html(div_data);
        }
      });
    }
  }

  $('.datatable').dataTable( {
       "ordering": false,
       "bDestroy": true,
       "searching":true,
        "paging":false,
        dom: 'Bfrtip',
          buttons: [
              {
                extend: 'excelHtml5',
                title: 'Student Attendance Percentage',
                              
              },
              {
                extend: 'pdfHtml5',
                title: 'Student Attendance Percentage',
                              
              },
          ],
      });

  function showProcessing()
  {
    $('#searchForm').validate();
    if($('#searchForm').valid()==true)
    {
      showLoader();
    }
  }
</script>