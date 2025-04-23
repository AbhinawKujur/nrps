<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reconcilation_ledger extends MY_Controller{
	public function __construct(){
		parent:: __construct();
		$this->loggedOut();
	    $this->load->model('Mymodel','dbcon');
	}
	public function index(){
		$class = $this->dbcon->select('classes','*');
		$sec = $this->dbcon->select('sections','*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('class_report/reconcilation',$array);
	}
	public function find_sec(){
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student','DISP_SEC,SEC',"CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		  <option value=''>Select Section</option>
		<?php
		foreach($data as $dt){
			?>
			  <option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
			<?php
		}
	}
	public function find_detailsstudentinformation(){
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$short_by 	= "ADM_NO";
		$studentdata = $this->dbcon->select('student','*',"CLASS='$class' AND SEC='$sec' AND Student_Status='ACTIVE' ORDER BY $short_by");
		$data['data'] = $studentdata;
		$class_name = $studentdata[0]->DISP_CLASS;
		$sec_name = $studentdata[0]->DISP_SEC;
		$this->session->set_userdata('class_name',$class_name);
		$this->session->set_userdata('sec_name',$sec_name);
		$data['feehead'] = $this->dbcon->select('feehead','*');
		$data['class'] = $class;
		$data['sec'] = $sec;
		$data['short_by'] = $short_by;
		$fee1_feegeneration = 0;
		$fee2_feegeneration = 0;
		$fee3_feegeneration = 0;
		$fee4_feegeneration = 0;
		$fee5_feegeneration = 0;
		$fee6_feegeneration = 0;
		$fee7_feegeneration = 0;
		$fee8_feegeneration = 0;
		$fee9_feegeneration = 0;
		$fee10_feegeneration = 0;
		$fee11_feegeneration = 0;
		$fee12_feegeneration = 0;
		$fee13_feegeneration = 0;
		$fee14_feegeneration = 0;
		$fee15_feegeneration = 0;
		$fee16_feegeneration = 0;
		$fee17_feegeneration = 0;
		$fee18_feegeneration = 0;
		$fee19_feegeneration = 0;
		$fee20_feegeneration = 0;
		$fee21_feegeneration = 0;
		$fee22_feegeneration = 0;
		$fee23_feegeneration = 0;
		$fee24_feegeneration = 0;
		$fee25_feegeneration = 0;
		$feetotal = 0;
		$total_feegeneration_amount = 0;
		$total_daycoll_tempdaycoll_amount = 0;
		foreach($data['data'] as $key=>$value){
			$daycolll = $this->dbcon->select('daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25,SUM(TOTAL)TOTAL',"ADM_NO='$value->ADM_NO'");
			if(!empty($daycolll)){
					$fee1_daycolll = $daycolll[0]->Fee1;
					$fee2_daycolll = $daycolll[0]->Fee2;
					$fee3_daycolll = $daycolll[0]->Fee3;
					$fee4_daycolll = $daycolll[0]->Fee4;
					$fee5_daycolll = $daycolll[0]->Fee5;
					$fee6_daycolll = $daycolll[0]->Fee6;
					$fee7_daycolll = $daycolll[0]->Fee7;
					$fee8_daycolll = $daycolll[0]->Fee8;
					$fee9_daycolll = $daycolll[0]->Fee9;
					$fee10_daycolll = $daycolll[0]->Fee10;
					$fee11_daycolll = $daycolll[0]->Fee11;
					$fee12_daycolll = $daycolll[0]->Fee12;
					$fee13_daycolll = $daycolll[0]->Fee13;
					$fee14_daycolll = $daycolll[0]->Fee14;
					$fee15_daycolll = $daycolll[0]->Fee15;
					$fee16_daycolll = $daycolll[0]->Fee16;
					$fee17_daycolll = $daycolll[0]->Fee17;
					$fee18_daycolll = $daycolll[0]->Fee18;
					$fee19_daycolll = $daycolll[0]->Fee19;
					$fee20_daycolll = $daycolll[0]->Fee20;
					$fee21_daycolll = $daycolll[0]->Fee21;
					$fee22_daycolll = $daycolll[0]->Fee22;
					$fee23_daycolll = $daycolll[0]->Fee23;
					$fee24_daycolll = $daycolll[0]->Fee24;
					$fee25_daycolll = $daycolll[0]->Fee25;
					$TOTAL_DAYCOLL  = $daycolll[0]->TOTAL;
				}
				else{
					$fee1_daycolll = 0;
					$fee2_daycolll = 0;
					$fee3_daycolll = 0;
					$fee4_daycolll = 0;
					$fee5_daycolll = 0;
					$fee6_daycolll = 0;
					$fee7_daycolll = 0;
					$fee8_daycolll = 0;
					$fee9_daycolll = 0;
					$fee10_daycolll = 0;
					$fee11_daycolll = 0;
					$fee12_daycolll = 0;
					$fee13_daycolll = 0;
					$fee14_daycolll = 0;
					$fee15_daycolll = 0;
					$fee16_daycolll = 0;
					$fee17_daycolll = 0;
					$fee18_daycolll = 0;
					$fee19_daycolll = 0;
					$fee20_daycolll = 0;
					$fee21_daycolll = 0;
					$fee22_daycolll = 0;
					$fee23_daycolll = 0;
					$fee24_daycolll = 0;
					$fee25_daycolll = 0;
					$TOTAL_DAYCOLL  = 0;
				}
				$temp_daycoll = $this->dbcon->select('temp_daycoll','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25,SUM(TOTAL)TOTAL',"ADM_NO='$value->ADM_NO' AND SEC='Z'");
				if(!empty($temp_daycoll))
				{
					$fee1_temp_daycoll = $fee1_daycolll+$temp_daycoll[0]->Fee1;
					$fee2_temp_daycoll = $fee2_daycolll+$temp_daycoll[0]->Fee2;
					$fee3_temp_daycoll = $fee3_daycolll+$temp_daycoll[0]->Fee3;
					$fee4_temp_daycoll = $fee4_daycolll+$temp_daycoll[0]->Fee4;
					$fee5_temp_daycoll = $fee5_daycolll+$temp_daycoll[0]->Fee5;
					$fee6_temp_daycoll = $fee6_daycolll+$temp_daycoll[0]->Fee6;
					$fee7_temp_daycoll = $fee7_daycolll+$temp_daycoll[0]->Fee7;
					$fee8_temp_daycoll = $fee8_daycolll+$temp_daycoll[0]->Fee8;
					$fee9_temp_daycoll = $fee9_daycolll+$temp_daycoll[0]->Fee9;
					$fee10_temp_daycoll = $fee10_daycolll+$temp_daycoll[0]->Fee10;
					$fee11_temp_daycoll = $fee11_daycolll+$temp_daycoll[0]->Fee11;
					$fee12_temp_daycoll = $fee12_daycolll+$temp_daycoll[0]->Fee12;
					$fee13_temp_daycoll = $fee13_daycolll+$temp_daycoll[0]->Fee13;
					$fee14_temp_daycoll = $fee14_daycolll+$temp_daycoll[0]->Fee14;
					$fee15_temp_daycoll = $fee15_daycolll+$temp_daycoll[0]->Fee15;
					$fee16_temp_daycoll = $fee16_daycolll+$temp_daycoll[0]->Fee16;
					$fee17_temp_daycoll = $fee17_daycolll+$temp_daycoll[0]->Fee17;
					$fee18_temp_daycoll = $fee18_daycolll+$temp_daycoll[0]->Fee18;
					$fee19_temp_daycoll = $fee19_daycolll+$temp_daycoll[0]->Fee19;
					$fee20_temp_daycoll = $fee20_daycolll+$temp_daycoll[0]->Fee20;
					$fee21_temp_daycoll = $fee21_daycolll+$temp_daycoll[0]->Fee21;
					$fee22_temp_daycoll = $fee22_daycolll+$temp_daycoll[0]->Fee22;
					$fee23_temp_daycoll = $fee23_daycolll+$temp_daycoll[0]->Fee23;
					$fee24_temp_daycoll = $fee24_daycolll+$temp_daycoll[0]->Fee24;
					$fee25_temp_daycoll = $fee25_daycolll+$temp_daycoll[0]->Fee25;
					$temp_daycoll_total = $TOTAL_DAYCOLL+$temp_daycoll[0]->TOTAL;
				}
				else{
					$fee1_temp_daycoll = $fee1_daycolll+0;
					$fee2_temp_daycoll = $fee2_daycolll+0;
					$fee3_temp_daycoll = $fee3_daycolll+0;
					$fee4_temp_daycoll = $fee4_daycolll+0;
					$fee5_temp_daycoll = $fee5_daycolll+0;
					$fee6_temp_daycoll = $fee6_daycolll+0;
					$fee7_temp_daycoll = $fee7_daycolll+0;
					$fee8_temp_daycoll = $fee8_daycolll+0;
					$fee9_temp_daycoll = $fee9_daycolll+0;
					$fee10_temp_daycoll = $fee10_daycolll+0;
					$fee11_temp_daycoll = $fee11_daycolll+0;
					$fee12_temp_daycoll = $fee12_daycolll+0;
					$fee13_temp_daycoll = $fee13_daycolll+0;
					$fee14_temp_daycoll = $fee14_daycolll+0;
					$fee15_temp_daycoll = $fee15_daycolll+0;
					$fee16_temp_daycoll = $fee16_daycolll+0;
					$fee17_temp_daycoll = $fee17_daycolll+0;
					$fee18_temp_daycoll = $fee18_daycolll+0;
					$fee19_temp_daycoll = $fee19_daycolll+0;
					$fee20_temp_daycoll = $fee20_daycolll+0;
					$fee21_temp_daycoll = $fee21_daycolll+0;
					$fee22_temp_daycoll = $fee22_daycolll+0;
					$fee23_temp_daycoll = $fee23_daycolll+0;
					$fee24_temp_daycoll = $fee24_daycolll+0;
					$fee25_temp_daycoll = $fee25_daycolll+0;
					$temp_daycoll_total = $TOTAL_DAYCOLL+0;
				}
				$feegeneration = $this->dbcon->select('feegeneration','sum(Fee1)Fee1,sum(Fee2)Fee2,sum(Fee3)Fee3,SUM(Fee4)Fee4,SUM(Fee5)Fee5,SUM(Fee6)Fee6,SUM(Fee7)Fee7,SUM(Fee8)Fee8,SUM(Fee9)Fee9,SUM(Fee10)Fee10,SUM(Fee11)Fee11,SUM(Fee12)Fee12,sum(Fee13)Fee13,sum(Fee14)Fee14,sum(Fee15)Fee15,SUM(Fee16)Fee16,SUM(Fee17)Fee17,SUM(Fee18)Fee18,SUM(Fee19)Fee19,SUM(Fee20)Fee20,SUM(Fee21)Fee21,SUM(Fee22)Fee22,SUM(Fee23)Fee23,SUM(Fee24)Fee24,SUM(Fee25)Fee25,SUM(TOTAL)TOTAL',"ADM_NO='$value->ADM_NO'");
						if(!empty($feegeneration)){
							$fee1_feegeneration = $feegeneration[0]->Fee1;
							$fee2_feegeneration = $feegeneration[0]->Fee2;
							$fee3_feegeneration = $feegeneration[0]->Fee3;
							$fee4_feegeneration = $feegeneration[0]->Fee4;
							$fee5_feegeneration = $feegeneration[0]->Fee5;
							$fee6_feegeneration = $feegeneration[0]->Fee6;
							$fee7_feegeneration = $feegeneration[0]->Fee7;
							$fee8_feegeneration = $feegeneration[0]->Fee8;
							$fee9_feegeneration = $feegeneration[0]->Fee9;
							$fee10_feegeneration = $feegeneration[0]->Fee10;
							$fee11_feegeneration = $feegeneration[0]->Fee11;
							$fee12_feegeneration = $feegeneration[0]->Fee12;
							$fee13_feegeneration = $feegeneration[0]->Fee13;
							$fee14_feegeneration = $feegeneration[0]->Fee14;
							$fee15_feegeneration = $feegeneration[0]->Fee15;
							$fee16_feegeneration = $feegeneration[0]->Fee16;
							$fee17_feegeneration = $feegeneration[0]->Fee17;
							$fee18_feegeneration = $feegeneration[0]->Fee18;
							$fee19_feegeneration = $feegeneration[0]->Fee19;
							$fee20_feegeneration = $feegeneration[0]->Fee20;
							$fee21_feegeneration = $feegeneration[0]->Fee21;
							$fee22_feegeneration = $feegeneration[0]->Fee22;
							$fee23_feegeneration = $feegeneration[0]->Fee23;
							$fee24_feegeneration = $feegeneration[0]->Fee24;
							$fee25_feegeneration = $feegeneration[0]->Fee25;
							$feetotal 			 = $feegeneration[0]->TOTAL;
						}else{
							$fee1_feegeneration = 0;
							$fee2_feegeneration = 0;
							$fee3_feegeneration = 0;
							$fee4_feegeneration = 0;
							$fee5_feegeneration = 0;
							$fee6_feegeneration = 0;
							$fee7_feegeneration = 0;
							$fee8_feegeneration = 0;
							$fee9_feegeneration = 0;
							$fee10_feegeneration = 0;
							$fee11_feegeneration = 0;
							$fee12_feegeneration = 0;
							$fee13_feegeneration = 0;
							$fee14_feegeneration = 0;
							$fee15_feegeneration = 0;
							$fee16_feegeneration = 0;
							$fee17_feegeneration = 0;
							$fee18_feegeneration = 0;
							$fee19_feegeneration = 0;
							$fee20_feegeneration = 0;
							$fee21_feegeneration = 0;
							$fee22_feegeneration = 0;
							$fee23_feegeneration = 0;
							$fee24_feegeneration = 0;
							$fee25_feegeneration = 0;
							$feetotal = 0;
						}
						//--------------//
						$total_feegeneration_amount += $feetotal;
						$total_daycoll_tempdaycoll_amount += $temp_daycoll_total;
						
						$diffrent_amount = ($feetotal-$temp_daycoll_total);
						if($diffrent_amount<0)
						{
							$s26 = "(Extra)";
							$fees_26 = abs($diffrent_amount);
						}elseif($diffrent_amount>0){
							$s26 = "(Remains)";
							$fees_26 = abs($diffrent_amount);
						}else{
							$s26 ="";
							$fees_26 = abs($diffrent_amount);
						}
						//---------------//
						$cal_fee1 = ($fee1_feegeneration-$fee1_temp_daycoll);
						if($cal_fee1<0)
						{
							$s1 = "(Extra)";
							$fees_1 = abs($cal_fee1);
						}elseif($cal_fee1>0){
							$s1 = "(Remains)";
							$fees_1 = abs($cal_fee1);
						}else{
							$s1 ="";
							$fees_1 = abs($cal_fee1);
						}
						$cal_fee2 = ($fee2_feegeneration-$fee2_temp_daycoll);
						if($cal_fee2<0)
						{
							$s2 = "(Extra)";
							$fees_2 = abs($cal_fee2);
						}elseif($cal_fee2>0){
							$s2 = "(Remains)";
							$fees_2 = abs($cal_fee2);
						}else{
							$s2 ="";
							$fees_2 = abs($cal_fee2);
						}
						$cal_fee3 = ($fee3_feegeneration-$fee3_temp_daycoll);
						if($cal_fee3<0)
						{
							$s3 = "(Extra)";
							$fees_3 = abs($cal_fee3);
						}elseif($cal_fee3>0){
							$s3 = "(Remains)";
							$fees_3 = abs($cal_fee3);
						}else{
							$s3 ="";
							$fees_3 = abs($cal_fee3);
						}
						$cal_fee4 = ($fee4_feegeneration-$fee4_temp_daycoll);
						if($cal_fee4<0)
						{
							$s4 = "(Extra)";
							$fees_4 = abs($cal_fee4);
						}elseif($cal_fee4>0){
							$s4 = "(Remains)";
							$fees_4 = abs($cal_fee4);
						}else{
							$s4 ="";
							$fees_4 = abs($cal_fee4);
						}
						$cal_fee5 = ($fee5_feegeneration-$fee5_temp_daycoll);
						if($cal_fee5<0)
						{
							$s5 = "(Extra)";
							$fees_5 = abs($cal_fee5);
						}elseif($cal_fee5>0){
							$s5 = "(Remains)";
							$fees_5 = abs($cal_fee5);
						}else{
							$s5 ="";
							$fees_5 = abs($cal_fee5);
						}
						$cal_fee6 = ($fee6_feegeneration-$fee6_temp_daycoll);
						if($cal_fee6<0)
						{
							$s6 = "(Extra)";
							$fees_6 = abs($cal_fee6);
						}elseif($cal_fee6>0){
							$s6 = "(Remains)";
							$fees_6 = abs($cal_fee6);
						}else{
							$s6 ="";
							$fees_6 = abs($cal_fee6);
						}
						$cal_fee7 = ($fee7_feegeneration-$fee7_temp_daycoll);
						if($cal_fee7<0)
						{
							$s7 = "(Extra)";
							$fees_7 = abs($cal_fee7);
						}elseif($cal_fee7>0){
							$s7 = "(Remains)";
							$fees_7 = abs($cal_fee7);
						}else{
							$s7 ="";
							$fees_7 = abs($cal_fee7);
						}
						$cal_fee8 = ($fee8_feegeneration-$fee8_temp_daycoll);
						if($cal_fee8<0)
						{
							$s8 = "(Extra)";
							$fees_8 = abs($cal_fee8);
						}elseif($cal_fee8>0){
							$s8 = "(Remains)";
							$fees_8 = abs($cal_fee8);
						}else{
							$s8 ="";
							$fees_8 = abs($cal_fee8);
						}
						$cal_fee9 = ($fee9_feegeneration-$fee9_temp_daycoll);
						if($cal_fee9<0)
						{
							$s9 = "(Extra)";
							$fees_9 = abs($cal_fee9);
						}elseif($cal_fee9>0){
							$s9 = "(Remains)";
							$fees_9 = abs($cal_fee9);
						}else{
							$s9 ="";
							$fees_9 = abs($cal_fee9);
						}
						$cal_fee10 = ($fee10_feegeneration-$fee10_temp_daycoll);
						if($cal_fee10<0)
						{
							$s10 = "(Extra)";
							$fees_10 = abs($cal_fee10);
						}elseif($cal_fee10>0){
							$s10 = "(Remains)";
							$fees_10 = abs($cal_fee10);
						}else{
							$s10 ="";
							$fees_10 = abs($cal_fee10);
						}
						$cal_fee11 = ($fee11_feegeneration-$fee11_temp_daycoll);
						if($cal_fee11<0)
						{
							$s11 = "(Extra)";
							$fees_11 = abs($cal_fee11);
						}elseif($cal_fee11>0){
							$s11 = "(Remains)";
							$fees_11 = abs($cal_fee11);
						}else{
							$s11 ="";
							$fees_11 = abs($cal_fee11);
						}
						$cal_fee12 = ($fee12_feegeneration-$fee12_temp_daycoll);
						if($cal_fee12<0)
						{
							$s12 = "(Extra)";
							$fees_12 = abs($cal_fee12);
						}elseif($cal_fee12>0){
							$s12 = "(Remains)";
							$fees_12 = abs($cal_fee12);
						}else{
							$s12 ="";
							$fees_12 = abs($cal_fee12);
						}
						$cal_fee13 = ($fee13_feegeneration-$fee13_temp_daycoll);
						if($cal_fee13<0)
						{
							$s13 = "(Extra)";
							$fees_13 = abs($cal_fee13);
						}elseif($cal_fee13>0){
							$s13 = "(Remains)";
							$fees_13 = abs($cal_fee13);
						}else{
							$s13 ="";
							$fees_13 = abs($cal_fee13);
						}
						$cal_fee14 = ($fee14_feegeneration-$fee14_temp_daycoll);
						if($cal_fee14<0)
						{
							$s14 = "(Extra)";
							$fees_14 = abs($cal_fee14);
						}elseif($cal_fee14>0){
							$s14 = "(Remains)";
							$fees_14 = abs($cal_fee14);
						}else{
							$s14 ="";
							$fees_14 = abs($cal_fee14);
						}
						$cal_fee15 = ($fee15_feegeneration-$fee15_temp_daycoll);
						if($cal_fee15<0)
						{
							$s15 = "(Extra)";
							$fees_15 = abs($cal_fee15);
						}elseif($cal_fee15>0){
							$s15 = "(Remains)";
							$fees_15 = abs($cal_fee15);
						}else{
							$s15 ="";
							$fees_15 = abs($cal_fee15);
						}
						$cal_fee16 = ($fee16_feegeneration-$fee16_temp_daycoll);
						if($cal_fee16<0)
						{
							$s16 = "(Extra)";
							$fees_16 = abs($cal_fee16);
						}elseif($cal_fee16>0){
							$s16 = "(Remains)";
							$fees_16 = abs($cal_fee16);
						}else{
							$s16 ="";
							$fees_16 = abs($cal_fee16);
						}
						$cal_fee17 = ($fee17_feegeneration-$fee17_temp_daycoll);
						if($cal_fee17<0)
						{
							$s17 = "(Extra)";
							$fees_17 = abs($cal_fee17);
						}elseif($cal_fee17>0){
							$s17 = "(Remains)";
							$fees_17 = abs($cal_fee17);
						}else{
							$s17 ="";
							$fees_17 = abs($cal_fee17);
						}
						$cal_fee18 = ($fee18_feegeneration-$fee18_temp_daycoll);
						if($cal_fee18<0)
						{
							$s18 = "(Extra)";
							$fees_18 = abs($cal_fee18);
						}elseif($cal_fee18>0){
							$s18 = "(Remains)";
							$fees_18 = abs($cal_fee18);
						}else{
							$s18 ="";
							$fees_18 = abs($cal_fee18);
						}
						$cal_fee19 = ($fee19_feegeneration-$fee19_temp_daycoll);
						if($cal_fee19<0)
						{
							$s19 = "(Extra)";
							$fees_19 = abs($cal_fee19);
						}elseif($cal_fee19>0){
							$s19 = "(Remains)";
							$fees_19 = abs($cal_fee19);
						}else{
							$s19 ="";
							$fees_19 = abs($cal_fee19);
						}
						$cal_fee20 = ($fee20_feegeneration-$fee20_temp_daycoll);
						if($cal_fee20<0)
						{
							$s20 = "(Extra)";
							$fees_20 = abs($cal_fee20);
						}elseif($cal_fee20>0){
							$s20 = "(Remains)";
							$fees_20 = abs($cal_fee20);
						}else{
							$s20 ="";
							$fees_20 = abs($cal_fee20);
						}
						$cal_fee21 = ($fee21_feegeneration-$fee21_temp_daycoll);
						if($cal_fee21<0)
						{
							$s21 = "(Extra)";
							$fees_21 = abs($cal_fee21);
						}elseif($cal_fee21>0){
							$s21 = "(Remains)";
							$fees_21 = abs($cal_fee21);
						}else{
							$s21 ="";
							$fees_21 = abs($cal_fee21);
						}
						$cal_fee22 = ($fee22_feegeneration-$fee22_temp_daycoll);
						if($cal_fee22<0)
						{
							$s22 = "(Extra)";
							$fees_22 = abs($cal_fee22);
						}elseif($cal_fee22>0){
							$s22 = "(Remains)";
							$fees_22 = abs($cal_fee22);
						}else{
							$s22 ="";
							$fees_22 = abs($cal_fee22);
						}
						$cal_fee23 = ($fee23_feegeneration-$fee23_temp_daycoll);
						if($cal_fee23<0)
						{
							$s23 = "(Extra)";
							$fees_23 = abs($cal_fee23);
						}elseif($cal_fee23>0){
							$s23 = "(Remains)";
							$fees_23 = abs($cal_fee23);
						}else{
							$s23 ="";
							$fees_23 = abs($cal_fee23);
						}
						$cal_fee24 = ($fee24_feegeneration-$fee24_temp_daycoll);
						if($cal_fee24<0)
						{
							$s24 = "(Extra)";
							$fees_24 = abs($cal_fee24);
						}elseif($cal_fee24>0){
							$s24 = "(Remains)";
							$fees_24 = abs($cal_fee24);
						}else{
							$s24 ="";
							$fees_24 = abs($cal_fee24);
						}
						$cal_fee25 = ($fee25_feegeneration-$fee25_temp_daycoll);
						if($cal_fee25<0)
						{
							$s25 = "(Extra)";
							$fees_25 = abs($cal_fee25);
						}elseif($cal_fee25>0){
							$s25 = "(Remains)";
							$fees_25 = abs($cal_fee25);
						}else{
							$s25 ="";
							$fees_25 = abs($cal_fee25);
						}
			$cal_data[] = array(
				'ADM_DATE' => $value->ADM_DATE,
				'ADM_NO'   => $value->ADM_NO,
				'FIRST_NM' => $value->FIRST_NM,
				'ROLL_NO' => $value->ROLL_NO,
				'COLL_FEE1' => $fee1_temp_daycoll,
				'COLL_FEE2' => $fee2_temp_daycoll,
				'COLL_FEE3' => $fee3_temp_daycoll,
				'COLL_FEE4' => $fee4_temp_daycoll,
				'COLL_FEE5' => $fee5_temp_daycoll,
				'COLL_FEE6' => $fee6_temp_daycoll,
				'COLL_FEE7' => $fee7_temp_daycoll,
				'COLL_FEE8' => $fee8_temp_daycoll,
				'COLL_FEE9' => $fee9_temp_daycoll,
				'COLL_FEE10' => $fee10_temp_daycoll,
				'COLL_FEE11' => $fee11_temp_daycoll,
				'COLL_FEE12' => $fee12_temp_daycoll,
				'COLL_FEE13' => $fee13_temp_daycoll,
				'COLL_FEE14' => $fee14_temp_daycoll,
				'COLL_FEE15' => $fee15_temp_daycoll,
				'COLL_FEE16' => $fee16_temp_daycoll,
				'COLL_FEE17' => $fee17_temp_daycoll,
				'COLL_FEE18' => $fee18_temp_daycoll,
				'COLL_FEE19' => $fee19_temp_daycoll,
				'COLL_FEE20' => $fee20_temp_daycoll,
				'COLL_FEE21' => $fee21_temp_daycoll,
				'COLL_FEE22' => $fee22_temp_daycoll,
				'COLL_FEE23' => $fee23_temp_daycoll,
				'COLL_FEE24' => $fee24_temp_daycoll,
				'COLL_FEE25' => $fee25_temp_daycoll,
				'COLL_FEE26' => $temp_daycoll_total,
				'FEEGEN_1' => $fee1_feegeneration,
				'FEEGEN_2' => $fee2_feegeneration,
				'FEEGEN_3' => $fee3_feegeneration,
				'FEEGEN_4' => $fee4_feegeneration,
				'FEEGEN_5' => $fee5_feegeneration,
				'FEEGEN_6' => $fee6_feegeneration,
				'FEEGEN_7' => $fee7_feegeneration,
				'FEEGEN_8' => $fee8_feegeneration,
				'FEEGEN_9' => $fee9_feegeneration,
				'FEEGEN_10' => $fee10_feegeneration,
				'FEEGEN_11' => $fee11_feegeneration,
				'FEEGEN_12' => $fee12_feegeneration,
				'FEEGEN_13' => $fee13_feegeneration,
				'FEEGEN_14' => $fee14_feegeneration,
				'FEEGEN_15' => $fee15_feegeneration,
				'FEEGEN_16' => $fee16_feegeneration,
				'FEEGEN_17' => $fee17_feegeneration,
				'FEEGEN_18' => $fee18_feegeneration,
				'FEEGEN_19' => $fee19_feegeneration,
				'FEEGEN_20' => $fee20_feegeneration,
				'FEEGEN_21' => $fee21_feegeneration,
				'FEEGEN_22' => $fee22_feegeneration,
				'FEEGEN_23' => $fee23_feegeneration,
				'FEEGEN_24' => $fee24_feegeneration,
				'FEEGEN_25' => $fee25_feegeneration,
				'FEEGEN_26' => $feetotal,
				's1' => $s1,
				's2' => $s2,
				's3' => $s3,
				's4' => $s4,
				's5' => $s5,
				's6' => $s6,
				's7' => $s7,
				's8' => $s8,
				's9' => $s9,
				's10' => $s10,
				's11' => $s11,
				's12' => $s12,
				's13' => $s13,
				's14' => $s14,
				's15' => $s15,
				's16' => $s16,
				's17' => $s17,
				's18' => $s18,
				's19' => $s19,
				's20' => $s20,
				's21' => $s21,
				's22' => $s22,
				's23' => $s23,
				's24' => $s24,
				's25' => $s25,
				's26' => $s26,
				'fees_1' => $fees_1,
				'fees_2' => $fees_2,
				'fees_3' => $fees_3,
				'fees_4' => $fees_4,
				'fees_5' => $fees_5,
				'fees_6' => $fees_6,
				'fees_7' => $fees_7,
				'fees_8' => $fees_8,
				'fees_9' => $fees_9,
				'fees_10' => $fees_10,
				'fees_11' => $fees_11,
				'fees_12' => $fees_12,
				'fees_13' => $fees_13,
				'fees_14' => $fees_14,
				'fees_15' => $fees_15,
				'fees_16' => $fees_16,
				'fees_17' => $fees_17,
				'fees_18' => $fees_18,
				'fees_19' => $fees_19,
				'fees_20' => $fees_20,
				'fees_21' => $fees_21,
				'fees_22' => $fees_22,
				'fees_23' => $fees_23,
				'fees_24' => $fees_24,
				'fees_25' => $fees_25,
				'fees_26' => $fees_26
			);
		}
		$total_dues_extra = ($total_feegeneration_amount-$total_daycoll_tempdaycoll_amount);
		if($total_dues_extra<0)
		{
			$final_commnet = "(Extra)";
			$final_amount = abs($total_dues_extra);
		}elseif($total_dues_extra>0){
			$final_commnet = "(Remains)";
			$final_amount = abs($total_dues_extra);
		}else{
			$final_commnet ="";
			$final_amount = abs($total_dues_extra);
		}
		$fin_data = array(
			'total_feegen_amount' => number_format($total_feegeneration_amount,2),
			'total_daycoll_amount' => number_format($total_daycoll_tempdaycoll_amount,2),
			'final_amount' => number_format($final_amount,2),
			'final_commnet' => $final_commnet
		);
		$data['cal_data'] = $cal_data;
		$this->session->set_userdata('cal_data',$cal_data);
		$this->session->set_userdata('fin_data',$fin_data);
		// echo "<pre>";
		// print_r($data['fin_data']);
		// exit;
		if(!empty($data['cal_data'])){
			$this->load->view('class_report/reconcilationdetails',$data);
		}
		else{
			echo "<center><h1>Sorry No Data Found</h1></center>";
		}
		
		
	}
	public function download_studentinformation(){
		$data['cal_data'] = $this->session->userdata('cal_data');
		$data['fin_data'] = $this->session->userdata('fin_data');
		$data['school_setting'] = $this->dbcon->select('school_setting','*');
		$data['feehead'] = $this->dbcon->select('feehead','*');
		$data['class_name'] = $this->session->userdata('class_name');
		$data['sec_name'] = $this->session->userdata('sec_name');
		$this->load->view('class_report/reconcilationPdf',$data);
		
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Reconcilation_ledger.pdf", array("Attachment"=>0));
	}
}