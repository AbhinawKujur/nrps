

    <div class='table-responsive'>

        <table class='table'>
            <tr>
                <th style='background:#5785c3; color:#fff!important;'>Adm. No.</th>
                <th style='background:#5785c3; color:#fff!important;'>Name</th>
                <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
                <th style='background:#5785c3; color:#fff!important;'>Attendance</th>
                <th style='background:#5785c3; color:#fff!important;'>Working Days</th>
            </tr>
            <?php
            foreach ($get as $key => $val) {
                
                if ($sheet == 'Sheet-1') {
                    $tot_present=$val['sheet_1_pd'];
                    $tot_work=$val['sheet_1_wd'];
                }
                elseif($sheet == 'Sheet-2'){
                    $tot_present=$val['sheet_2_pd'];
                    $tot_work=$val['sheet_2_wd'];
                }
                elseif($sheet == 'Sheet-3'){
                    $tot_present=$val['sheet_3_pd'];
                    $tot_work=$val['sheet_3_wd'];
                }
                elseif($sheet == 'Sheet-4'){
                    $tot_present=$val['sheet_4_pd'];
                    $tot_work=$val['sheet_4_wd'];
                }
                elseif($sheet == 'Sheet-5'){
                    $tot_present=$val['sheet_5_pd'];
                    $tot_work=$val['sheet_5_wd'];
                }
                elseif($sheet == 'Sheet-6'){
                    $tot_present=$val['sheet_6_pd'];
                    $tot_work=$val['sheet_6_wd'];
                }
                elseif($sheet == 'Sheet-7'){
                    $tot_present=$val['sheet_7_pd'];
                    $tot_work=$val['sheet_7_wd'];
                }
                elseif($sheet == 'Sheet-8'){
                    $tot_present=$val['sheet_8_pd'];
                    $tot_work=$val['sheet_8_wd'];
                }
                elseif($sheet == 'Sheet-9'){
                    $tot_present=$val['sheet_9_pd'];
                    $tot_work=$val['sheet_9_wd'];
                }
                elseif($sheet == 'Sheet-10'){
                    $tot_present=$val['sheet_10_pd'];
                    $tot_work=$val['sheet_10_wd'];
                }
                elseif($sheet == 'Sheet-11'){
                    $tot_present=$val['sheet_11_pd'];
                    $tot_work=$val['sheet_11_wd'];
                }
                elseif($sheet == 'Sheet-12'){
                    $tot_present=$val['sheet_12_pd'];
                    $tot_work=$val['sheet_12_wd'];
                }
                else{
                    $tot_present='';
                    $tot_work='';
                }
                ?>

                <tr>
                    <td><?php echo $val['adm_no']; ?>
                        <input type="hidden" name="adm_no[]" id="adm_no" value="<?php echo $val['ADM_NO']; ?>">
                    </td>

                    <td><?php echo $val['FIRST_NM']; ?>

                    </td>

                    <td><?php echo $val['ROLL_NO']; ?>

                    </td>

                    <td>
                        <input value="<?php echo $tot_present ?>" onchange="totPresentByStu(this.value,'<?php echo $val['adm_no']; ?>','<?php echo $session; ?>','<?php echo $sheet; ?>','presentDays')" type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='attendance' class='attendance'>
                    </td>

                    <td>
                        <input value="<?php echo $tot_work ?>" type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' name='workingDays' class='workingDays' onchange="totWorkingByStu(this.value,'<?php echo $val['adm_no']; ?>','<?php echo $session; ?>','<?php echo $sheet; ?>','workingDays')">
                    </td>

                </tr>
            <?php
            }
            ?>
        </table>

        <br>
        <button class="btn btn-success" onclick="save()">SAVE</button>
    </div>

<script>
    function totPresentByStu(val, admno, session, sheet, types) {
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/totPresentDays'); ?>",
            type: "POST",
            data: {
                val: val,
                admno: admno,
                session: session,
                sheet: sheet,
                types: types
            },
            success: function(ret) {
                //alert(ret);
            }
        });
    }
	
	function totWorkingByStu(val, admno, session, sheet, types) {
        $.ajax({
            url: "<?php echo base_url('ExamAtt_XI/totWorkingByStu'); ?>",
            type: "POST",
            data: {
                val: val,
                admno: admno,
                session: session,
                sheet: sheet,
                types: types
            },
            success: function(ret) {
                //alert(ret);
            }
        });
    }
	
    function save()
    {
        alert("Saved Successfully");
    }
</script>