<div class='table-responsive'>
    <table class='table dataTable'>
        <thead>
            <tr>
                <th style='background:#5785c3; color:#fff !important;'>Adm No.</th>
                <th style='background:#5785c3; color:#fff !important;'>Name</th>
                <th style='background:#5785c3; color:#fff !important;'>Roll<br>No.</th>
                <?php
                if ($opt_code['opt_code'] == 2) { ?>
                    <th style='background:#5785c3; color:#fff !important;'>Oral</th>
                    <th style='background:#5785c3; color:#fff !important;'>Written</th>
                <?php } else if ($opt_code['opt_code'] == 1) { ?>
                    <th style='background:#5785c3; color:#fff !important;'>Oral</th>
                <?php } else { ?>
                    <th style='background:#5785c3; color:#fff !important;'>Grade</th>
                <?php }
                ?>
            </tr>
        </thead>
        <input type='hidden' value='<?php echo $opt_code['opt_code']; ?>' name='opt_code'>
        <input type='hidden' value='<?php echo $exm_code['exm_code']; ?>' name='exm_code'>
        <tbody>
            <?php

            if (!empty($skillData)) {
                foreach ($skillData as $key => $val) {
                    $admno = $val['ADM_NO'];
            ?>
                    <tr>
                        <td><?php echo $val['ADM_NO']; ?><input type='hidden' value='<?php echo $val['ADM_NO']; ?>' name='admno[]'></td>
                        <td><?php echo $val['STU_NAME']; ?><input type='hidden' value='<?php echo $trm; ?>' name='trm'></td>
                        <td><?php echo $val['ROLL_NO']; ?><input type='hidden' value='<?php echo $val['ROLL_NO']; ?>' name='rollno[]'></td>

                        <?php if ($opt_code['opt_code'] == 2) { ?>
                            <td>
                                <select class='form-select' name='subskill_<?php echo $key; ?>[]'>
                                    <option value="">SELECT</option>
                                    <option value='A' <?php if ('A' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>A</option>
                                    <option value='B' <?php if ('B' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>B</option>
                                    <option value='C' <?php if ('C' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>C</option>
                                    <option value='D' <?php if ('D' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>D</option>
                                    <option value='AB' <?php if ('AB' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>AB</option>
                                    <option value='-' <?php if ('-' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>-</option>
                                </select>
                            </td>

                            <td>
                                <select class='form-select' name='subskill_<?php echo $key; ?>[]'>
                                    <option value="">SELECT</option>
                                    <option value='A' <?php if ('A' == $val['WRITTEN']) {
                                                            echo "selected";
                                                        } ?>>A</option>
                                    <option value='B' <?php if ('B' == $val['WRITTEN']) {
                                                            echo "selected";
                                                        } ?>>B</option>
                                    <option value='C' <?php if ('C' == $val['WRITTEN']) {
                                                            echo "selected";
                                                        } ?>>C</option>
                                    <option value='D' <?php if ('D' == $val['WRITTEN']) {
                                                            echo "selected";
                                                        } ?>>D</option>
                                    <option value='AB' <?php if ('AB' == $val['WRITTEN']) {
                                                            echo "selected";
                                                        } ?>>AB</option>
                                    <option value='-' <?php if ('-' == $val['WRITTEN']) {
                                                            echo "selected";
                                                        } ?>>-</option>
                                </select>
                            </td>
                        <?php } else if ($opt_code['opt_code'] == 1) { ?>
                            <td>
                                <select class='form-select' name='subskill_<?php echo $key; ?>[]'>
                                    <option value="">SELECT</option>
                                    <option value='A' <?php if ('A' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>A</option>
                                    <option value='B' <?php if ('B' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>B</option>
                                    <option value='C' <?php if ('C' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>C</option>
                                    <option value='D' <?php if ('D' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>D</option>
                                    <option value='AB' <?php if ('AB' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>AB</option>
                                    <option value='-' <?php if ('-' == $val['ORAL']) {
                                                            echo "selected";
                                                        } ?>>-</option>
                                </select>
                            </td>
                        <?php } else { ?>
                            <td>
                                <select class='form-select' name='subskill_<?php echo $key; ?>[]'>
                                    <option value="">SELECT</option>
                                    <option value='A' <?php if ('A' == $val['GRADE']) {
                                                            echo "selected";
                                                        } ?>>A</option>
                                    <option value='B' <?php if ('B' == $val['GRADE']) {
                                                            echo "selected";
                                                        } ?>>B</option>
                                    <option value='C' <?php if ('C' == $val['GRADE']) {
                                                            echo "selected";
                                                        } ?>>C</option>
                                    <option value='D' <?php if ('D' == $val['GRADE']) {
                                                            echo "selected";
                                                        } ?>>D</option>
                                    <option value='AB' <?php if ('AB' == $val['GRADE']) {
                                                            echo "selected";
                                                        } ?>>AB</option>
                                    <option value='-' <?php if ('-' == $val['GRADE']) {
                                                            echo "selected";
                                                        } ?>>-</option>
                                </select>
                            </td>
                        <?php }
                        ?>

                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<br />

<button type='submit' class='btn btn-success'><i class="fa fa-spinner fa-spin" id='process' style='display:none'></i> SAVE</button>
<br /><br />

<script>
    $(".dataTable").dataTable({
        "searching": true,
        "paging": false,
        "ordering": false,
        "info": false,
        "destroy": true,
    });
</script>