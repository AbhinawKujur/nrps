<?php
class Custom_lib
{
	public function getApplicableFor()
	{
		return array(
			'1'	=> 'Vacational Staff',
			'2'	=> 'Non Vacational Staff',
			'3'	=> 'All',
		);
	}

	public function getGender()
	{
		return array(
			'1'	=> 'MALE',
			'2'	=> 'FEMALE',
			'3'	=> 'NOT ALLOWED',
		);
	}

	public function getEmployeeType()
	{
		return array(
			'1'	=> 'Vacational Staff',
			'2'	=> 'Non Vacational Staff',
		);
	}

	public function getStaffType()
	{
		return array(
			'1'	=> 'Teaching',
			'2'	=> 'Non Teaching',
		);
	}

	public function getTASlab()
	{
		return array(
			'1'	=> 'Slab 1',
			'2'	=> 'Slab 2',
			'3'	=> 'Slab 3',
		);
	}

	public function leaveType()
	{
		return array(
			'1'	=> 'CASUAL LEAVE',
			'2'	=> 'MEDICAL LEAVE',
			'3'	=> 'EARNED LEAVE',
			'4'	=> 'HALF PAID LEAVE',
		);
	}

	public function leaveRequestLiveType()
	{
		return array(
			'1'	=> 'CASUAL LEAVE',
			'2'	=> 'MEDICAL LEAVE',
			'3'	=> 'EARNED LEAVE',
			'4'	=> 'LEAVE WITHOUT PAY(LWP)',
			'5'	=> 'DEFFERED DAY LEAVE',
			'6'	=> 'HALF PAID LEAVE',
		);
	}

	public function shortLeaveRequestType()
	{
		return array(
			'1'	=> 'CL',
			'2'	=> 'ML',
			'3'	=> 'EL',
			'4'	=> 'LWP',
			'5'	=> 'DDL',
			'6'	=> 'HPL',
		);
	}

	public function getRelationType()
	{
		return array(
			'1'	=> 'Father',
			'2'	=> 'Mother',
			'3'	=> 'Spouse',
			'4'	=> 'Son',
			'5'	=> 'Daughter'
		);
	}

	public function getLeaveReason()
	{
		return array(
			'1'	=> 'OD',
			'2'	=> 'Hospital',
			'3'	=> 'Examination',
			'4'	=> 'Medical',
			'5'	=> 'Miscellaneous',
			'6'	=> 'Deferred Day Leave',
			'7'	=> 'Others'
		);
	}

	public function getEmpLevel()
	{
		return array(
			'1'	=> 'Basic',
			'2'	=> 'Senior',
			'3'	=> 'Selection',
		);
	}

	public function getTeacherType()
	{
		return array(
			'TGT'	=> 'TGT',
			'PGT'	=> 'PGT',
			'PRT'	=> 'PRT',
			'PRIMARY TEACHER'=> 'PRIMARY TEACHER',
			'OTHER'	=> 'OTHER',
		);
	}

	public function getEmployeeSeparatedStatus()
	{
		return array(
			'1'		=> 'On Roll',
			'2'		=> 'Resigned',
			'3'		=> 'Death',
			'4'		=> 'End of contract period',
			'5'		=> 'Volunteer Retirement',
			'6'		=> 'Suspended',
		);
	}

	//time calculation

	function CalculateTime($time1, $time2) {
      $time1 = date('H:i:s',strtotime($time1));
      $time2 = date('H:i:s',strtotime($time2));
      $times = array($time1, $time2);
      $seconds = 0;
      foreach ($times as $time)
      {
        list($hour,$minute,$second) = explode(':', $time);
        $seconds += $hour*3600;
        $seconds += $minute*60;
        $seconds += $second;
      }
      $hours = floor($seconds/3600);
      $seconds -= $hours*3600;
      $minutes  = floor($seconds/60);
      $seconds -= $minutes*60;
      if($seconds < 9)
      {
      $seconds = "0".$seconds;
      }
      if($minutes < 9)
      {
      $minutes = "0".$minutes;
      }
        if($hours < 9)
      {
      $hours = "0".$hours;
      }
      return "{$hours}:{$minutes}:{$seconds}";
    }

    public function retirementDate($d_o_b,$retirement_year=60)
	{
		$date_of_birth = date('Y-m-d',strtotime($d_o_b));
		$day = date('d',strtotime($date_of_birth));
		$month = date('m',strtotime($date_of_birth));
		$year = date('Y',strtotime($date_of_birth));
		$total_days_in_month = date('t',mktime(0,0,0,$month,$day,$year));
		$final_retirement_year = $year+$retirement_year;
		$retirement_date = $final_retirement_year.'-'.$month.'-'.$day;
		$retirement_date = date('Y-m-d',strtotime($retirement_date));

		if($day==1 || $day == 01)
		{
		    $retirement_date = date('Y-m-d',mktime (0, 0, 0, $month, $day - 1, $final_retirement_year));
		}
		else
		{
		    $retirement_date = date('Y-m-t', strtotime($retirement_date));
		}
		return $retirement_date;
	}


	public function checkNoofPresentDays($current_month_total_days=0,$absent_days=0,$prev_month_total_days=0)
	{
		$present_days = 0;
		$diff = $current_month_total_days - $prev_month_total_days;
		if($diff==0)
		{
			$present_days = $current_month_total_days - $absent_days;
		}
		elseif($diff > 0)
		{
			if($absent_days == $prev_month_total_days)
			{
				$present_days = 0;
			}
			elseif($absent_days > $prev_month_total_days)
			{
				$present_days = $current_month_total_days - ($absent_days + $diff);
			}
			else
			{
				$present_days = $current_month_total_days - $absent_days;
			}
		}
		elseif($diff < 0)
		{
			$second_cond = $current_month_total_days - $absent_days;
			if($second_cond > 0)
			{
				$present_days = $second_cond;
			}
			elseif($second_cond == 0 || $second_cond < 0)
			{
				$present_days = $current_month_total_days - ($absent_days + ($diff));
			}
		}
		return $present_days;
	}

	function getIndianCurrency(float $number)
	{
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $decimal_part = $decimal;
	    $hundred = null;
	    $hundreds = null;
	    $digits_length = strlen($no);
	    $decimal_length = strlen($decimal);
	    $i = 0;
	    $str = array();
	    $str2 = array();
	    $words = array(0 => '', 1 => 'one', 2 => 'two',
	        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
	        7 => 'seven', 8 => 'eight', 9 => 'nine',
	        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
	        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
	        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
	        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
	        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
	        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	    $digits = array('', 'hundred','thousand','lakh', 'crore');

	    while( $i < $digits_length ) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str[] = null;
	    }

	    $d = 0;
	    while( $d < $decimal_length ) {
	        $divider = ($d == 2) ? 10 : 100;
	        $decimal_number = floor($decimal % $divider);
	        $decimal = floor($decimal / $divider);
	        $d += $divider == 10 ? 1 : 2;
	        if ($decimal_number) {
	            $plurals = (($counter = count($str2)) && $decimal_number > 9) ? 's' : null;
	            $hundreds = ($counter == 1 && $str2[0]) ? ' and ' : null;
	            @$str2 [] = ($decimal_number < 21) ? $words[$decimal_number].' '. $digits[$decimal_number]. $plural.' '.$hundred:$words[floor($decimal_number / 10) * 10].' '.$words[$decimal_number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str2[] = null;
	    }

	    $Rupees = implode('', array_reverse($str));
	    $paise = implode('', array_reverse($str2));
	    $paise = ($decimal_part > 0) ? $paise . ' Paise' : '';
	    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
	}

	public function getDifferenceBetweenTwoDates($first_date,$second_date)
	{
		$first_date = date('Y-m-d',strtotime($first_date));
		$second_date = date('Y-m-d',strtotime($second_date));
		$ts1 = strtotime($first_date);
		$ts2 = strtotime($second_date);

		$year1 = date('Y', $ts1);
		$year2 = date('Y', $ts2);

		$month1 = date('m', $ts1);
		$month2 = date('m', $ts2);

		$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
		return $diff; //it returns no of month between two date
	}

	function dateDiffInDays($date1, $date2)  
	{ 
	    $diff = strtotime($date2) - strtotime($date1); 
	    return abs(round($diff / 86400)); 
	} 
	
	function getDatesFromRange($start, $end, $format = 'Y-m-d') { 
      
		// Declare an empty array 
		$array = array();     
		$interval = new DateInterval('P1D'); 
	  
		$realEnd = new DateTime($end); 
		$realEnd->add($interval);  
		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
		
		foreach($period as $date) {                  
			$array[] = $date->format($format);  
		} 
	  
		// Return the array elements 
		return $array; 
    } 
	
	public function reportCardGardeColorOneTofive(){
		return array(
			'A+' => '#27AE60',
			'A'  => '#A9DFBF',
			'B'  => '#DC7633',
			'C'  => '#EDBB99',
			'D'  => '#F1C40F',
			'AB' => 'red',
			' '  => '#fff',
		);
	}
}