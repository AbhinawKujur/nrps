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
   <?php if(!empty($result)){ $i=1; ?>
      <?php foreach ($result as $key => $value) { ?>
          <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $value['class_name']; ?></td>
            <?php foreach ($value['teachers'] as $keys => $val) { ?>
              <td><a onclick="removeSelectedTeacher('<?= $key; ?>','<?= $keys; ?>')" class="remove_<?php echo $key.'_'.$keys; ?>"><?php echo $val['name']; ?></a></td>
            <?php } ?>
          </tr>
      <?php } ?>
    <?php } ?>
  </tbody>
</table>   