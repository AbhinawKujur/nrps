<style>
label{
	font-size:12px;
	font-weight: bold !important;
}
table{
	padding-right:20px;
}
button.dt-button, div.dt-button, a.dt-button {
	line-height:0.66em;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
	line-height:0.66em;
}
.pad{
    margin:10px;
 }
</style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div style="padding:10px;border:2px dotted black;height:650px;">
<table style="width:100%;" >
 <tr class="pad"><td><img src="<?php echo $school[0]['SCHOOL_LOGO'];?>" style='width:90px;'></td>
 <td style='padding-right:100px' ><center><h2 ><?php echo $school[0]['School_Name'];?></h2><p><?php echo $school[0]['School_Address'];?></p></center></td> <td></td></tr></table>

<center><h4><u>LIBRARY FINE RECEIPT</u></h4></center> 
<br/>
<div class="container-fluid">
 <table style="width:100%; text-transform: capitalize;" class="table">
 <tr class="pad"><td><b>Adm No.</b>: &nbsp; <?php echo $StuDetail[0]['ADM_NO'];?></td>
 <td><b>Class-Sec.</b>: &nbsp; <?php echo $StuDetail[0]['DISP_CLASS'];?> - <?php echo $StuDetail[0]['DISP_SEC'];?></td></tr>
 
  <tr><td colspan="2"><b>Student Name</b>: &nbsp; <?php echo $StuDetail[0]['FIRST_NM'];?></td></tr>
  <tr><td colspan="2"><b>Father's Name</b>: &nbsp; <?php echo $StuDetail[0]['FATHER_NM'];?></td></tr>
 
  <tr><td><b>Acc No</b>: &nbsp; <?php echo $BookDetail[0]['accno'];?></td>
 <td><b>Book Issue Date.</b>: &nbsp; <?php 
 $date1=date_create($Applied_data[0]['IDate']);
$date1= date_format($date1,"d-m-Y");
 echo $date1;?></td></tr>
 
  <tr><td><b>Due Date</b>
  : &nbsp; <?php 
 $date1=date_create($Applied_data[0]['Due_date']);
$date1= date_format($date1,"d-m-Y");
 echo $date1;?></td>
 <td><b>Book Return Date</b>: &nbsp; <?php echo date('d-m-Y');?></td></tr>
 
  <tr><td colspan="2"><b>Book Name</b>: &nbsp; <?php echo $BookDetail[0]['BNAME'];?></td></tr>
  <tr><td colspan="2"><b>Author Name</b>: &nbsp; <?php echo $BookDetail[0]['AUTHOR'];?></td></tr>
  <tr><td colspan="2"><b>Publisher Name</b>: &nbsp; <?php echo $BookDetail[0]['PUBLISHER'];?></td></tr>
  <tr><td colspan="2"><b>Fine Amount</b>: &nbsp; &#8377; <?php echo $Applied_data[0]['Fine'];?></td></tr>
  <tr><td colspan="2"><b>Receipt No.: _______________<br/><br/><sup>(From Office)</sup></b></td></tr>

 </table>
<br>
<table style="width:100%;margin-left:60px">
 <tr ><td><b>&nbsp;Library</b>
 <br/>
 <br/>
 <sup>(Signature)</sup></td>
 <td> <b>&nbsp;Accounts</b>
 <br/>
 <br/>
 <sup>(Signature)</sup></td>
 
 <td><b>&nbsp;Student</b>
 <br/>
 <br/>
 <sup>(Signature)</sup></td></tr></table>
</div>

</div>


