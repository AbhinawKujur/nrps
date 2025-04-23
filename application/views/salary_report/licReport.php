<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Salary Report</a> <i class="fa fa-angle-right"></i> LIC Reports</li>
</ol>
  <div style="padding: 25px; background-color: white;border-top: 3px solid #5785c3;">
    
    <?php echo form_open('salary_report/licreport/generatePDF',array('id'=>'searchForm','target'=>'_blank')); ?>
        <div class="row">
          <div class="col-sm-2">
            <div class="form-group">
              <label>Month and Year</label><span class="req"> *</span>
              <input type="text" name="month_year" class="form-control datepicker" id="date" autocomplete="off" value="<?php echo set_value('month_year'); ?>" required="">
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label></label>
              <button type="submit" class="btn btn-success form-control" name="search"><i class="fa fa-search"></i> Search</button>
            </div>
          </div>
        </div>
    <?php echo form_close(); ?>
  </div>
<br><br>

<script type="text/javascript">
  
  $('.datepicker').datepicker({
      format: "M-yyyy",
      autoclose: true,
      startView: "months", 
    minViewMode: "months"
    });
</script>