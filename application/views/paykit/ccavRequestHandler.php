<html>
<head>
<title> Non-Seamless-kit</title>
</head>
<body>
<center>

<?php include('Crypto.php')?>
<?php 

	error_reporting(0);
	
	$merchant_data='260186';
	$working_key='7F0876900816421A9BAC221F7FACE121';//Shared by CCAVENUES
	$access_code='AVBI92HE42CJ30IBJC';//Shared by CCAVENUES
	
	
	$merchant_data.='tid='.$this->session->userdata('adm_no').'&';
	$merchant_data.='merchant_id='.$this->session->userdata('merchant_id').'&';
    $merchant_data.='order_id='.$this->session->userdata('tid').'&';
    $merchant_data.='amount='.$this->session->userdata('total_amountt').'&';
    $merchant_data.='currency=INR'.'&';
    $merchant_data.='redirect_url='.$this->session->userdata('redirect_url').'&';
    $merchant_data.='cancel_url='.$this->session->userdata('cancel_url').'&';
    $merchant_data.='language='.$this->session->userdata('language').'&';
	
	 $merchant_data.='billing_name='.$this->session->userdata('ffms').'&';
	
	$encrypted_data=encrypt($merchant_data,$working_key); // Method for encrypting the data.

	//https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction
?>
<form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
	
?>
</form>
</center>
<script language='javascript'>
	document.redirect.submit();
	</script>
</body>
</html>

