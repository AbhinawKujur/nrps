<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
	<link rel="shortcut icon" href="<?php echo site_url('assets_nur/img/favicon.ico') ?>" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet"> 
    <link href="<?php echo site_url() ?>assets_nur/css/style.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo site_url() ?>assets_nur/css/media.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css"/>
	<link href='https://fonts.googleapis.com/css?family=Bungee+Inline:400' rel='stylesheet' type='text/css'>
	
	<style>
		.login-div .full input {
			margin-right: 17px !important;
		}
		a:hover{
			color:red;
			text-decoration: underline;
			font-weight:bold;
		}
		.heading-div p{
			font-family: 'Bungee Inline', cursive;
		}
		body{
			background-image: url(<?php echo base_url('assets_nur/image/jvm_bgg.jpg'); ?>);
			background-repeat: no-repeat;
            background-size: 100% 100%;
		}
		html {
			height: 100%
		}
		.login-div {
			opacity: 0.9 !important;
		}
	</style>
</head>

<body>
    <div class="wrapper">
       <div class="clearfix"></div>
       <div class="login-div">
          <div class="log-div"><img src="<?php echo site_url() ?>assets_nur/image/jvm1.png" height="100px"></div>
          <div class="heading-div">           
            <p style='font-size:30px;'>LOGIN</p>
          </div>
		  <form id="form" autocomplete='off'>
          <div class="form-div clearfix">
            <div class="field">
				<div class="form-field">
				<label class="id" for="id"></label>
				<input type="text" name="username" id="username" maxlength="50" placeholder="Username" required class="validate" onchange='usernamee(this.value)'>
				</div>
            </div>
            <div class="field">
				<div class="form-field">
				<label class="pass" for="pass"></label>
				<input type="password" name="password" id="password" required placeholder="Password" class="validate" onchange='uname()' maxlength='10'>
				</div>
            </div>
			<div class="field" id="otp" style='display:none;'>
				<div class="form-field">
				<label class="pass" for="otp"></label>
				<input disabled type="text" name="otp" maxlength="20" required placeholder="OTP" id='otp_text' maxlength='6'>
				</div>
            </div>
          </div>
          <div class="full">
            <div class="full">
				<input type="submit" value="Login">
			</div><br />
			<!--<center><span style='font-size:16px !important; color:red'>New Applicant <a href='<?php echo base_url('adm_three/Adm_nur'); ?>'>Click Here<a/></span></center>-->
          </div>
		  </form>
       </div>
    </div>
    <script src="<?php echo site_url() ?>assets_nur/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"></script>
</body>
</html>

<script>
$("#form").on("submit", function (event) {
    event.preventDefault();
    $.ajax({
		url: "<?php echo base_url('adm_three/Admin/login'); ?>",
		type: "POST",
		data: $("#form").serialize(),
		success: function(data){
			if(data == 0){
				$.toast({
					heading: 'Error',
					text: 'Useranme or Password Incorrect',
					showHideTransition: 'slide',
					icon: 'error',
					position: 'top-right',
				});	
				$("#username").val('');
				$("#password").val('');
				$("#otp_text").val('');
			}else{
				window.location.href="<?php echo base_url('adm_three/Admin/dashboard'); ?>";
			}
		}
	});
 });
 
 function usernamee(username){
	 if(username != 'admin' && username != 'admin1' && username != 'admin2'){
		 $("#otp").show();
		 $("#otp_text").prop('disabled',false); 
	 } 
 }
 
 function uname(){
	 var username = $("#username").val();
	 var password = $("#password").val();
	 if(username != 'admin' && username != 'admin1' && username != 'admin2'){
		 $.ajax({
			 url : "<?php echo base_url('adm_three/Admin/chkThenOtp'); ?>",
			 type: "POST",
			 data: {username:username,password:password},
			 success :function(data){
				 if(data == 1){
					 alert('OTP sent to your Registered Mobile Number');
					 $("#otp").show();
					 $("#otp_text").prop('disabled',false);
					 
				 }else{
					 $.toast({
						heading: 'Error',
						text: 'Useranme or Password Incorrect',
						showHideTransition: 'slide',
						icon: 'error',
						position: 'top-right',
					});	
					$("#username").val('');
					$("#password").val('');
					$("#otp_text").val('');
					$("#otp").hide();
					$("#otp_text").prop('disabled',true);
				 }
			 }
		 });
	 }
 }
</script>