<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Update_student_table_daycoll extends MY_Controller 
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Alam','alam');

	}
	public function index()
	{
		
		$list = $this->alam->get_data_from_daycoll(); 
		$i=0;
		foreach($list as $l)
		{
			$tmp='';
			$rec='';
			$i=$i+1;

			if( strpos($l->PERIOD, ',') !== false ) 
			{
				$tmp=explode(',',$l->PERIOD);
				$rec=$l->RECT_NO;
				$adm_no=$l->ADM_NO;

				foreach($tmp as $t){
					//echo $t.'_'.$rec.'_'.$adm_no;echo '<br>';
					if($t=='JUN'){ $t='JUNE_FEE'; }
					else if($t=='JUL'){ $t='JULY_FEE'; }
					else {$t=$t.'_FEE';}
					$this->alam->update_student_table($t,$rec,$adm_no); 
				}
				
		    }
			else if(strpos($l->PERIOD, '-') !== false ) 
			{
				$tmp=explode('-',$l->PERIOD);
				$rec=$l->RECT_NO;
				$adm_no=$l->ADM_NO;

				foreach($tmp as $t){
					//echo $t.'_'.$rec.'_'.$adm_no;echo '<br>';
					if($t=='JUN'){ $t='JUNE_FEE'; }
					else if($t=='JUL'){ $t='JULY_FEE'; }
					else {$t=$t.'_FEE';}
					$this->alam->update_student_table($t,$rec,$adm_no); 
				}
				
			}
			else
			{
				$rec=$l->RECT_NO;
				$tmp=$l->PERIOD;
				$adm_no=$l->ADM_NO;
				
				//echo $tmp.'_'.$rec.'_'.$adm_no;echo '<br>';
				if($tmp=='JUN'){ $tmp='JUNE_FEE'; }
					else if($tmp=='JUL'){ $tmp='JULY_FEE'; }
					else {$tmp=$tmp.'_FEE';}
				$this->alam->update_student_table($tmp,$rec,$adm_no); 
				
				
			}
			

			
			

		}

		echo $i.'Records upladed';
	}
		
}
