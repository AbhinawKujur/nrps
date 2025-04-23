<table class="table table-bordered dataTable table-striped">
  <thead style="background: #d2d6de;">
    <tr>
      <th style="background: #337ab7; color: white !important;" class="text-center">S. No</th>
      <th style="background: #337ab7; color: white !important;">Subject Name</th>
      <th style="background: #337ab7; color: white !important;">Total Period</th>
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
        </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <tr>
      <th style="background: #337ab7; color: white !important;" class="text-center" colspan="2">Total Period</th>
      <th style="background: #337ab7; color: white !important;"><?php echo $totalSum; ?></th>
    </tr>
  </tfoot>
</table>   