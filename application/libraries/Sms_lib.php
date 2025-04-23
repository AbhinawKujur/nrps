<?php 

class Sms_lib
{
	private $_CI;
	public function __construct()
	{
	    $this->_CI = & get_instance();
        $this->_CI->load->model('Sumit','sumit');
	}

	public function sendSMS($mobile,$message,$template_id)
	{
		$schoolData = $this->_CI->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		//Your authentication key
		$authKey = $schoolData['auth_key'];

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = $schoolData['sender_id'];

		$message = urlencode($message);

		//Define route 
		$route = "default";
		//Prepare you post parameters
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobile,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);

		//API URL
		$url="http://www.smsmica.com/api/sendhttp.php?authkey=1179AFsheCY8h3zo626138d7P37&mobiles=".$mobile."&message=".$message."&sender=DAVNRP&route=4&country=91&DLT_TE_ID=".$template_id;

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
		));


		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


		//get response
		$output = curl_exec($ch);

		//Print error if any
		if(curl_errno($ch))
		{
			echo 'error:' . curl_error($ch);
		}

		curl_close($ch);

		$output;
	}
}