 <html>
<head>
  <style>
    @page { margin: 120px 25px 50px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px;}
    #footer { position: fixed; right: 0px; bottom: 10px; text-align: right;}
        #footer .page:after { content: counter(page, decimal); }

        .table {
          border-collapse: collapse;
          font-size: 10px;
          white-space: nowrap;
        }

        .table, th, td {
          border: 1px solid #abb5c4;
        }
        .name {
          text-align: left;
        }
        .text-center{
          text-align: center;
          font-weight: bold;
        }
        .text-right{
          text-align: right;
        }
        .thead-color{
          background: #abb0ac !important;
        }
        .late-in{
          background-color: #d9534f !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;
        }
        .before-in{
          background-color: #f0ad4e !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;
        }
        .right-time{
          background-color: #5cb85c !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;
        }
  </style>
</head>
<body>
  <header id="header">
    <div style="text-align: center;">
      <span style="font-size: 25px;font-weight: bold;"><?php echo $school_setting['School_Name'] ?> </span>
      <br><span><?php echo $school_setting['School_Address'] ?> </span><br>
    </div>
    <div style="text-align: center;">Daily Punching Report(<?php echo date('d-F-Y',strtotime($date)); ?>)</div>
  </header>
   <div id="footer">
      <p class="page">Page </p>
    </div> 
  <div id="content">
    <div>
    <center>
      <div style="font-size: 12px;">
        <span style="font-weight: bold !important;margin-right: 20px !important;">Total No. Of Emp. = <?php echo $total_emp; ?></span>
        <span style="font-weight: bold !important;margin-right: 20px !important;color: green !important;"> Total Present =  <?php echo $total_pre; ?></span>
        <span style="font-weight: bold !important;color: red !important;"> Total Absent =  <?php echo $total_emp - $total_pre; ?></span>
        <hr>
        <label>
          <label class="late-in">Late IN / Before OUT</label>
          <label class="before-in">Before IN / After OUT</label>
          <label class="right-time">Right Time</label>
        </label>
      </div><hr>
    </center>
      <div class="table-responsive">
        <table class="table" width="100%">
          <thead style="background: #d2d6de;">
            <tr>
              <th style="background: #337ab7 !important; color: white !important;">EMP ID</th>
              <th style="background: #337ab7 !important; color: white !important;">EMP Name</th>
              <th style="background: #337ab7 !important; color: white !important;">Shift Time</th>
              <th style="background: #337ab7 !important; color: white !important;">In Time</th>
              <th style="background: #337ab7 !important; color: white !important;">IN Status</th>
              <th style="background: #337ab7 !important; color: white !important;">Out Time</th>
              <th style="background: #337ab7 !important; color: white !important;">Out Status</th>
              <th style="background: #337ab7 !important; color: white !important;">Shift <br> Duration</th>
              <th style="background: #337ab7 !important; color: white !important;">Work <br> Duration (W.D)</th>
              <th style="background: #337ab7 !important; color: white !important;">Total W.D</th>
              <th style="background: #337ab7 !important; color: white !important;">Punch Type</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($attendanceList as $keys => $val) {
              $tot_dur = "00:00:00";
            foreach ($val as $key => $value) { ?>
              <tr>
                <td><?php echo $value['EMPID']; ?></td>
                <td><?php echo $value['EMP_FNAME'].' '.$value['EMP_MNAME'].' '.$value['EMP_LNAME']; ?></td>
                <td><?php echo $value['SHIFT_IN_TIME'].' - '.$value['SHIFT_OUT_TIME']; ?></td>
                <td><?php echo date('H:i:s',strtotime($value['IN_TIME'])); ?></td>
                <td><?php if($value['IN_CHECK_DIFFER'][0] == '-') { ?>

                  <label  style="background-color: #f0ad4e !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $value['IN_CHECK_DIFFER']; ?></label>

               <?php } else if(strcmp($value['IN_CHECK_DIFFER'], "00:00:00") == 0) { ?>

                  <label  style="background-color: #5cb85c !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $value['IN_CHECK_DIFFER']; ?></label>

               <?php } else if($value['IN_CHECK_DIFFER'] == '') { ?>

                  <label></label>

              <?php } else {  ?>

                 <label  style="background-color: #d9534f !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $value['IN_CHECK_DIFFER']; ?></label>

               <?php } ?>
              </td>
              <td><?php echo date('H:i:s',strtotime($value['OUT_TIME'])); ?></td>
                <td><?php if($value['OUT_CHECK_DIFFER'][0] == '-') { ?>

                  <label  style="background-color: #f0ad4e !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $value['OUT_CHECK_DIFFER']; ?></label>

               <?php } else if(strcmp($value['OUT_CHECK_DIFFER'], "00:00:00") == 0) { ?>

                  <label  style="background-color: #5cb85c !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $value['OUT_CHECK_DIFFER']; ?></label>

                <?php } else if($value['OUT_CHECK_DIFFER'] == '') { ?>

                  <label></label>

                <?php  } else { ?>

                   <label  style="background-color: #d9534f !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $value['OUT_CHECK_DIFFER']; ?></label>
                <?php } ?></td>
                 <td><?php echo $value['SHIFT_DURATION']; ?></td>
                 <td><?php echo $value['TOTAL_DURATION']; ?></td>

                 <td><?php 
                  $tot_dur = $this->custom_lib->CalculateTime($value['TOTAL_DURATION'],$tot_dur);

                 $shift_tot_dur = $this->sumit->getTimeDiff($value['SHIFT_DURATION'],$tot_dur);

                 if($shift_tot_dur['time_diff'][0] == '-') { ?>

                  <i data-toggle="tooltip" title="<?php echo $value['REMARKS'] ?>" data-placement="auto"><span  style="background-color: #f0ad4e !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $tot_dur; ?></span></i>

               <?php } else if(strcmp($shift_tot_dur['time_diff'], "00:00:00") == 0) { ?>

                  <i data-toggle="tooltip" title="<?php echo $value['REMARKS'] ?>" data-placement="auto"><span  style="background-color: #5cb85c !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $tot_dur; ?></span></i>

                <?php } else if($shift_tot_dur['time_diff'] == '') { ?>

                  <label></label>

                <?php  } else { ?>

                  <i data-toggle="tooltip" title="<?php echo $value['REMARKS'] ?>" data-placement="auto"> <span  style="background-color: #d9534f !important;padding: 4px 6px !important; border: none !important;text-shadow: none !important;font-weight: 300 !important;border-radius: 4px !important;display: inline !important; padding: .2em .6em .3em !important; font-size: 75% !important;font-weight: bold !important;    line-height: 1 !important; color: #fff !important;text-align: center !important; white-space: nowrap !important;    vertical-align: baseline !important;"><?php echo $tot_dur; ?></span></i>
                <?php } ?></td>
                <td><?php if($value['PUNCH_TYPE']==1){
                  echo "Manual";
                 }else{
                  echo "Machine";
                 } ?></td>
              </tr>
            <?php } } ?>

          </tbody>
        </table>   
      </div> 
    </div>
  </div>
  </body>
</html>