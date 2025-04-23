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
    <?php $i = 1;
    foreach ($subjectData as $key => $value) { ?>
      <?php if($value['Merged_WithSubCode'] != 0){ ?>
        <tr style="background: #e89c84 !important; color: white !important;">
      <?php }elseif($value['Support_Teacher_Required'] != 0){ ?>
        <tr style="background: #ccd7e6 !important; color: white !important;">
      <?php }else{  ?>
        <tr>
      <?php } ?>
          <td class="text-center"><?php echo $i++; ?></td>
          <td><?php echo $value['subj_nm']; ?></td>
          <td><?php echo $value['Total_Period_inWeek']; ?></td>
          <td>
            <?php if($value['Merged_WithSubCode'] == 0) { ?>
              <a href="#" class="btn-xs btn-black" onclick="removeSubjectWithoutMergeCode('<?php echo $value['ID']; ?>')"><i class="fa fa-trash" style="color: white;"></i> Remove Subject</a>
            <?php }else{ ?>
              <a href="#" class="btn-xs btn-black" onclick="removeSubjectWithMergeCode('<?php echo $value['ID']; ?>')"><i class="fa fa-trash" style="color: white;"></i> Remove Subject</a>
            <?php } ?>
          </td>
        </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <td style="background: #337ab7; color: white !important;" colspan="2" class="text-center"> Total Period</td>
      <td style="background: #337ab7; color: white !important;"><?php echo $totalSum; ?></td>
      <td style="background: #337ab7; color: white !important;" ></td>
    </tr>
  </tfoot>
</table>   