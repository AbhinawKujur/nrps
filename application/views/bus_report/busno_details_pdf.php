<?php
// echo '<pre>';
// print_r($getBusNoData);
// die;
?>

<style>
    table {
        border-collapse: collapse;
    }

    * {
        font-size: 10px;
        font-weight: bold;
    }

    table tr th,
    td {
        font-size: 10px !important;
        padding: 5px !important;
        border: #000 1px solid;
    }

    @page {
        margin: 15px 30px 0px 30px;
    }
</style>
<div>
    <p style='float:right; font-size:14px;'>Report Generation Date:<?php echo date('d-M-Y'); ?></p><br /><br>
    <center>
        <p style='font-size:24px; position:relative; top:-5px;'><?php echo $school_name; ?></p>
        <p style='font-size:20px; position:relative; top:-25px;'><?php echo $school_address; ?></p>
        <p style='font-size:20px; position:relative; top:-35px;'>Session (<?php echo $school_session; ?>)</p>
    </center>
</div>

<table class="table" id="example" style="margin-top: 0px;">
    <caption style="margin-top: -30px;font-size:16px;">Bus No. Wise Report</caption>
    <thead>
        <tr>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Sl No.</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Stoppage Name</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Admission No.</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Student Name</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Father's Name</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Class</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Section</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Contact No.</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Amt.</th>
            <th style="background-color: lightblue !important;border-top: 1px solid #000;">Bus NO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sum = 0;
        $tot_stu = 0;
        $grand_tot_stu = 0;
        $grand_tot_amt = 0;
        $i = 1;
        $j = 1;
        $chk = $getBusNoData[0]->STOPNO;
        foreach ($getBusNoData as $key => $value) {
            if ($chk != $value->STOPNO) {
        ?>
                <tr>
                    <td colspan="2" style="text-align: right; color: red;font-weight:700">NO. OF STUDENT</td>
                    <td style="text-align: right; color: red;font-weight:700"><?php echo $tot_stu; ?></td>
                    <td colspan="5" style="text-align: right; color: red;font-weight:700">TOTAL</td>
                    <td style="text-align: right; color: red;font-weight:700"><?php echo $sum; ?></td>
                    <td></td>
                </tr>

            <?php
                $grand_tot_stu += $tot_stu;
                $grand_tot_amt += $sum;
                $tot_stu = 0;
                $sum = 0;
                $i++;
                $j = 1;
            }
            ?>
            <tr>
                <td><?php echo $i . '.' . $j; ?></td>
                <td><?php echo $value->stoppage; ?></td>
                <td><?php echo $value->ADM_NO; ?></td>
                <td><?php echo $value->FIRST_NM; ?></td>
                <td><?php echo $value->FATHER_NM; ?></td>
                <td><?php echo $value->DISP_CLASS; ?></td>
                <td><?php echo $value->DISP_SEC; ?></td>
                <td><?php echo $value->C_MOBILE; ?></td>
                <td><?php echo $value->AMT; ?></td>
                <td><?php echo $value->Bus_No; ?></td>
            </tr>
        <?php
            $sum = $sum + $value->AMT;
            $chk = $value->STOPNO;
            $tot_stu++;
            $j++;
        }
        ?>
        <tr>
            <?php
            $grand_tot_stu += $tot_stu;
            $grand_tot_amt += $sum;
            ?>
            <td colspan="2" style="text-align: right; color: red;font-weight:700">NO. OF STUDENT</td>
            <td style="text-align: right; color: red;font-weight:700"><?php echo $tot_stu; ?></td>
            <td colspan="5" style="text-align: right; color: red;font-weight:700">TOTAL</td>
            <td style="text-align: right; color: red;font-weight:700"><?php echo $sum; ?></td>
            <td></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2" style="text-align: right; color: red;font-weight:700">TOTAL STUDENTS</td>
            <td style="text-align: right; color: red;font-weight:700"><?php echo $grand_tot_stu; ?></td>
            <td colspan="5" style="text-align: right; color: red;font-weight:700">TOTAL BUS AMT.</td>
            <td style="text-align: right; color: red;font-weight:700"><?php echo $grand_tot_amt; ?></td>
            <td></td>
        </tr>
    </tfoot>
</table>