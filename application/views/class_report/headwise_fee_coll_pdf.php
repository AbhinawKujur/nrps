<style>
    #table2 {
        border-collapse: collapse;
    }

    #img {
        float: left;
        height: 110px;
        width: 130px;
    }

    #tp-header {
        font-size: 25px;
    }

    #mid-header {
        font-size: 22px;
    }

    #last-header {
        font-size: 18px;
    }

    #last-header1 {
        font-size: 15px;
    }

    .th {
        background-color: #5785c3 !important;
        color: #fff !important;
    }
</style>
<img src="<?php echo $school_setting[0]->SCHOOL_LOGO; ?>" id="img">
<table width="100%" style="float:right;">
    <tr>
        <td id="tp-header">
            <center><?php echo $school_setting[0]->School_Name; ?></center>
        </td>
    </tr>
    <tr>
        <td id="mid-header">
            <center><?php echo $school_setting[0]->School_Address; ?></center>
        </td>
    </tr>
    <tr>
        <td id="last-header">
            <center>SESSION (<?php echo $school_setting[0]->School_Session; ?>)</center>
        </td>
    </tr>
    <tr>
        <td id="last-header1">
            <center>HEADWISE FEE COLLECTION CLASS REPORT <?php echo $data[0]->DISP_CLASS.'-'.$data[0]->DISP_SEC; ?></center>
        </td>
    </tr>
</table><br /><br /><br /><br /><br /><br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<hr>
<br />


<table width="100%" border="1" id="table2">
    <thead>
        <tr>
            <th class="th">Sl. No.</th>
            <th class="th">Adm. No.</th>
            <th class="th">Student Name</th>
            <th class="th">Roll No.</th>
            <th class="th">Amount Paid</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $grand_tot = 0;
        foreach ($data as $key => $value) {
            //if ($value->TOTAL > 0) {
                $vl = $key + 1;
        ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $value->ADM_NO; ?></td>
                    <td><?php echo $value->STU_NAME; ?></td>
                    <td><?php echo $value->ROLL_NO; ?></td>
                    <td><?php echo $value->TOTAL; ?></td>
                </tr>
        <?php
                $grand_tot = $grand_tot + $value->TOTAL;
            //}
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $grand_tot; ?></b></td>
        </tr>
    </tfoot>
</table>