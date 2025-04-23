<div class="table-responsive">
  <table class="table table-bordered dataTable table-striped">
    <thead style="background: #d2d6de;">
      <tr>
        <th style="background: #337ab7; color: white !important;">S.No.</th>
        <th style="background: #337ab7; color: white !important;">Subject</th>
        <th style="background: #337ab7; color: white !important;">Periods</th>
        <th style="background: #337ab7; color: white !important;">Main Teacher</th>
        <th style="background: #337ab7; color: white !important;">Support Teacher</th>
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
              <?php if($value['Main_Teacher_Required']==1)
              {
                echo $value['EMP_FNAME'].' '.$value['EMP_LNAME'].' '.$value['EMP_MNAME'];
              }
              else
              {
                echo "X";
              } ?>
            </td>
            <td>
              <?php if($value['Support_Teacher_Required']==1)
              {
                echo $value['EMP_FNAME_SUPPORT'].' '.$value['EMP_MNAME_SUPPORT'].' '.$value['EMP_LNAME_SUPPORT'];
              }
              else
              {
                echo "X";
              } ?>
            </td>

          </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
        <td style="background: #337ab7; color: white !important;" colspan="2" class="text-center"> Total Period</td>
        <td style="background: #337ab7; color: white !important;"><?php echo $totalSum; ?></td>
        <td style="background: #337ab7; color: white !important;" colspan="2"></td>
      </tr>
    </tfoot>
  </table>   
</div>