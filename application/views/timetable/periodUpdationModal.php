<hr>
<table class="table" style="font-size: 14px; font-weight: bold;">
  <tr>
    <td style="width: 200px;">
      Total Period : 
      <?php echo $totalSum; ?>
    </td>
    <td>
      <b>Section : </b>
      <?php foreach ($sectionList as $key => $value) { ?>
       <?php echo $value['Class_name_Roman'].', '; ?>
      <?php } ?>
    </td>
  </tr>
</table>
<hr>
<table class="table table-bordered dataTable table-striped">
  <thead style="background: #d2d6de;">
    <tr>
      <th style="background: #337ab7; color: white !important;" class="text-center">S. No</th>
      <th style="background: #337ab7; color: white !important;">Subject Name</th>
      <th style="background: #337ab7; color: white !important;">Total Period</th>
      <th style="background: #337ab7; color: white !important;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $sno = 1;
    foreach ($subjectData as $key => $value) { ?>
      <?php if($value['Merged_WithSubCode'] != 0){ ?>
        <tr style="background: #e89c84 !important; color: white !important;">
      <?php }elseif($value['Support_Teacher_Required'] != 0){ ?>
        <tr style="background: #ccd7e6 !important; color: white !important;">
      <?php }else{  ?>
        <tr>
      <?php } ?>
          <td class="text-center"><?php echo $sno++; ?></td>
          <td><?php echo $value['subj_nm']; ?></td>
          <td>
            <select class="form-control" name="total_period" required="" id="total_period_<?php echo $value['Class_No'].'_'.$value['subject_code']; ?>">
              <?php for ($i=1; $i<=10;$i++) { ?>
                <option value="<?php echo $i; ?>" <?php if($value['Total_Period_inWeek']==$i){ echo "selected"; } ?>><?php echo $i; ?></option>
              <?php } ?>
            </select>
          </td>
          <td>
            <button class="btn btn-primary" type="button" onclick="updatePeriod('<?php echo $value['Class_No']; ?>','<?php echo $value['subject_code']; ?>')"><i class="fa fa-edit" style="color: white !important;"></i> Update</button>
          </td>
        </tr>
    <?php } ?>
  </tbody>
</table>   