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
            <center>Advance Fee Collection Report from <?php echo date("d-m-Y", strtotime($start_date)); ?> To <?php echo date("d-m-Y", strtotime($end_date)); ?></center>
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
            <th class="th">Sl No.</th>
            <th class="th">Fee Head Name</th>
            <th class="th">Amount</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($feehead as $key => $value) {
            $vl = $key + 1;
        ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value->FEE_HEAD; ?></td>
                <td><?php echo $data[0]['Fee' . $vl]; ?></td>
            </tr>
        <?php

        }

        ?>
    </tbody>
    <tfoot>
        <tr>
            <td></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;">GRAND TOTAL</b></td>
            <td><b style="font-size:16px;color:red;font-weight: 900;"><?php echo $data[0]['TOT']; ?></b></td>

        </tr>
    </tfoot>
</table>