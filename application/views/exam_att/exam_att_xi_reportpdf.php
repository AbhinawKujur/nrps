   <?php 
   if($sec=='1')
   {
    $sec_NM='A';
   }
   elseif($sec=='2')
   {
    $sec_NM='B';
   }
   elseif($sec=='3')
   {
    $sec_NM='c';
   }
   elseif($sec=='4')
   {
    $sec_NM='D';
   }
   elseif($sec=='5')
   {
    $sec_NM='E';
   }
   elseif($sec=='6')
   {
    $sec_NM='F';
   }
   elseif($sec=='7')
   {
    $sec_NM='G';
   }
   elseif($sec=='8')
   {
    $sec_NM='H';
   }
   elseif($sec=='9')
   {
    $sec_NM='I';
   }
   elseif($sec=='10')
   {
    $sec_NM='J';
   }
   elseif($sec=='11')
   {
    $sec_NM='K';
   }
   elseif($sec=='12')
   {
    $sec_NM='M';
   }
   elseif($sec=='13')
   {
    $sec_NM='N';
   }
   elseif($sec=='14')
   {
    $sec_NM='P';
   }
   else{
    $sec_NM=$sec;
   }
   ?>
   <style>
       table {
           font-family: arial, sans-serif;
           border-collapse: collapse;
       }

       td,
       th {
           border: 1px solid #dddddd;
       }
   </style>

<br>
   <table style="width:100%; border:none;">
       <tr>
           <td style="border:none;">
               <center><img src="assets/school_logo/cbse_logo.jpg" style="margin-left:5%; width:83px;"></center>
           </td>
           <td style="border:none;">
               <center>
                   <h1><span style="font-size:24px !important;">JAWAHAR VIDYA MANDIR</span></h1>Shyamali Colony, Doranda, Ranchi-834002<br />Session- ( 2023-2024 )<br />ATTENDANCE SHEET <br>  Class-Sec <?php if($class == '13'){ echo 'XI';}else{ echo 'XII';}; ?>-<?php echo $sec_NM; ?>
               </center>
           </td>
           <td style="border:none;">
               <center><img src="assets/school_logo/jvm.png" style="margin-left:5%; width:83px;"></center>
           </td>
       </tr>
   </table>

   <br><hr>

   <table>
       <tr>
           
		   <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
		   <th style='background:#5785c3; color:#fff!important;'>Adm. No.</th>
           <th style='background:#5785c3; color:#fff!important;'>Name</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 1 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 1 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 2 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 2 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 3 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 3 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 4 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 4 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 5 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 5 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 6 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 6 pd</th>

          <!-- <th style='background:#5785c3; color:#fff!important;'>Sheet 7 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 7 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 8 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 8 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 9 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 9 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 10 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 10 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 11 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 11 pd</th>

           <th style='background:#5785c3; color:#fff!important;'>Sheet 12 wd</th>
           <th style='background:#5785c3; color:#fff!important;'>Sheet 12 pd</th> -->

           <th style='background:#5785c3; color:#fff!important;'>TOTAL WD</th>
           <th style='background:#5785c3; color:#fff!important;'>TOTAL PD</th>
		   <th style='background:#5785c3; color:#fff!important;'>PERCENTAGE</th>

       </tr>
       <?php
        foreach ($get as $key => $val) {
        ?>
           <tr>
               <td><?php echo $val['ROLL_NO']; ?></td>
			   <td><?php echo $val['adm_no']; ?></td>
               <td><?php echo $val['FIRST_NM']; ?></td>

               <td><?php echo $val['sheet_1_wd']; ?></td>
               <td><?php echo $val['sheet_1_pd']; ?></td>

               <td><?php echo $val['sheet_2_wd']; ?></td>
               <td><?php echo $val['sheet_2_pd']; ?></td>

               <td><?php echo $val['sheet_3_wd']; ?></td>
               <td><?php echo $val['sheet_3_pd']; ?></td>

               <td><?php echo $val['sheet_4_wd']; ?></td>
               <td><?php echo $val['sheet_4_pd']; ?></td>

               <td><?php echo $val['sheet_5_wd']; ?></td>
               <td><?php echo $val['sheet_5_pd']; ?></td>

               <td><?php echo $val['sheet_6_wd']; ?></td>
               <td><?php echo $val['sheet_6_pd']; ?></td>

              <!-- <td><?php echo $val['sheet_7_wd']; ?></td>
               <td><?php echo $val['sheet_7_pd']; ?></td>

               <td><?php echo $val['sheet_8_wd']; ?></td>
               <td><?php echo $val['sheet_8_pd']; ?></td>

               <td><?php echo $val['sheet_9_wd']; ?></td>
               <td><?php echo $val['sheet_9_pd']; ?></td>

               <td><?php echo $val['sheet_10_wd']; ?></td>
               <td><?php echo $val['sheet_10_pd']; ?></td>

               <td><?php echo $val['sheet_11_wd']; ?></td>
               <td><?php echo $val['sheet_11_pd']; ?></td>

               <td><?php echo $val['sheet_12_wd']; ?></td>
               <td><?php echo $val['sheet_12_pd']; ?></td> -->

               <td><?php echo $val['toa_wd']; ?></td>
               <td><?php echo $val['toa_pd']; ?></td>
			   <td><?php echo round(($val['toa_pd']/$val['toa_wd'] * 100),2); ?></td>

           </tr>
       <?php
        }
        ?>
   </table>