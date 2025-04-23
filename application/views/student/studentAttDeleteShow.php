<form action='<?php echo base_url('student/StudentAttDelete/delete'); ?>' method='post'>
    <center>
        <input type="hidden" id="cls" name="cls" value="<?php echo $cls; ?>">
        <input type="hidden" id="sec" name="sec" value="<?php echo $sec; ?>">
        <input type="hidden" id="dt" name="dt" value="<?php echo $dt; ?>">
        <button class='btn btn-danger'></i>Delete</button>
    </center>
</form>
<br>

<table class='table' id='example'>
    <thead>
        <tr>
            <th style="background:#5785c3; color:#fff">Adm No.</th>
            <th style="background:#5785c3; color:#fff">Stu Name</th>
            <th style="background:#5785c3; color:#fff">Roll</th>
            <th style="background:#5785c3; color:#fff">Attendance</th>
            
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($getdata as $data) {
        ?>
            <tr>
                <td><?php echo $data['admno']; ?></td>
                <td><?php echo $data['FIRST_NM']; ?></td>
                <td><?php echo $data['ROLL_NO']; ?></td>

                <?php
                if ($data['att_status'] == 'P') {
                ?>
                    <td style="color:green;"><b><?php echo $data['att_status']; ?></b></td>
                <?php
                } else if ($data['att_status'] == 'A') {
                ?>
                    <td style="color:red;"><b><?php echo $data['att_status']; ?></b></td>
                <?php
                } else {
                ?>
                    <td style="color:orange; cursor:pointer"><b data-toggle="tooltip" data-placement="bottom" title='<?php echo $data->remarks; ?>'><?php echo $data['att_status']; ?></b></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }

        ?>
    </tbody>
</table>