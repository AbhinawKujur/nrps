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
            <center>Cancelled Receipt Report from <?php echo date("d-m-Y", strtotime($single)); ?> To <?php echo date("d-m-Y", strtotime($double)); ?></center>
        </td>
    </tr>
</table><br /><br /><br /><br /><br /><br /><br />
<span style="text-align:left;">
    Collected By:- <?php
                    if ($collectioncounter == '%') {
                        echo    'All Users';
                    } else {
                        echo    $collectioncounter;
                    }
                    ?>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span style="text-align:right;">
    Collection At:- <?php
                    if ($collectiontype == 1) {
                        echo    'SCHOOL';
                    } else {
                        echo    'BANK';
                    }
                    ?>
</span>
<hr>
<br />

<table width="100%" border="1" id="table2">
    <thead>
        <tr>
            <th class="th">S.NO</th>
            <th class="th">Receipt No</th>
            <th class="th">Receipt Date</th>
            <th class="th">Adm No</th>
            <th class="th">Class </th>
            <th class="th">Sec</th>
            <th class="th">Operator ID</th>
        </tr>
    </thead>
    <tbody>
        <?php

        foreach ($data as $key => $value) {
            $vl = $key + 1;
        ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value['RECT_NO']; ?></td>
                <td><?php echo $value['RECT_DATE']; ?></td>
                <td><?php echo $value['ADM_NO']; ?></td>
                <td><?php echo $value['CLASS']; ?></td>
                <td><?php echo $value['SEC']; ?></td>
                <td><?php echo $value['User_Id']; ?></td>

            </tr>
        <?php

            $vl++;
        }

        ?>
    </tbody>

</table>