<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_fun extends CI_model{

	function get_month_actual($month)
	{
					if($month==1)
									{
										$m=4;
									}elseif($month==2)
									{
										$m=5;
									}elseif($month==3)
									{
										$m=6;
									}
									elseif($month==4)
									{
										$m=7;
									}elseif($month==5)
									{
										$m=8;
									}elseif($month==6)
									{
										$m=9;
									}elseif($month==7)
									{
										$m=10;
									}
									elseif($month==8)
									{
										$m=11;
									}
									elseif($month==9)
									{
										$m=12;
									}
									elseif($month==10)
									{
										$m=1;
									}
									elseif($month==11)
									{
										$m=2;
									}
									elseif($month==12)
									{ 
										$m=3;
									}

									return $m;			
	}
	
	function admn_no_by_StudentID($id){

		$sql="SELECT a.* FROM student a WHERE a.ADM_NO='".$id."' ;";
		$query = $this->db->query($sql);
		if($query->num_rows() == 0)	return FALSE;
			return $query->result();
	}

		function find_day_difference($data1){

			$timestamp = $data1;
			$datetime = explode(" ",$timestamp);
			$datetime1 = $datetime[0];
			$datetime2 = date('Y-m-d');
	 		// difference
	 		$dateDifference = abs(strtotime($datetime2) - strtotime($datetime1));

	 		
	$days = abs(round($dateDifference / 86400));	

	return $days;

}
	
}