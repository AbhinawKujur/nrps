<?php 



$conn = odbc_connect( 'Data_Punch','sa','Mica$007');

if( $conn ) {
     echo "Connection established.<br />";
}else{
	$ss = "select * from STARDC_RAWDATA";
	$DD= odbc_execute($conn,$ss);
	$res = odbc_result($DD,1);
	print_r($res);
     echo "Connection could not be established.<br />";
     //die( print_r( sqlsrv_errors(), true));
}




?>