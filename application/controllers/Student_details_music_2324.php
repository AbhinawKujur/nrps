<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_details extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	public function Student_master()
	{
		$data = $this->dbcon->select('student', 'STUDENTID,ADM_NO,DISP_CLASS,ROLL_NO,DISP_SEC,DISP_SEC,FATHER_NM,MOTHER_NM,FIRST_NM,C_MOBILE', "Student_Status='ACTIVE' order by Class, sec, Roll_no asc");
		$array = array('data' => $data);
		$this->fee_template('student_details/student_master', $array);
	}


	public function show_strenght_religion()
	{
		$religion = $this->input->post('religion');
		$sec = $this->input->post('SECC');
		if ($sec != 'All') {
			$seccc = " AND SEC='$sec'";
		} else {
			$seccc = "";
		}
		$cls = $this->input->post('langOpt');
		// echo"<pre>", print_r($cls);die;
		$clsss = $cls;
		$cls = implode("','", $cls);
		if ($sec != 'All') {
			$data = $this->dbcon->select('student', "*,(select CAT_ABBR from category where CAT_CODE=student.CATEGORY)CATEGORY_NM,(select HOUSENAME from house where HOUSENO=student.HOUSE_CODE)HOUSE_NM,(select HOUSENAME from eward where HOUSENO=student.EMP_WARD)WARD_NM,(select STOPPAGE from stoppage where STOPNO=student.STOPNO)STOP_NM,(select regn_no from busnomaster where BusCode=student.BUS_NO)BUS_NO_C,(select Rname from religion where RNo=student.religion)religion_nm", "Student_Status='ACTIVE' AND religion=$religion and CLASS in ('$cls') and sec in('$sec')");
		} else {
			$data = $this->dbcon->select('student', "*,(select CAT_ABBR from category where CAT_CODE=student.CATEGORY)CATEGORY_NM,(select HOUSENAME from house where HOUSENO=student.HOUSE_CODE)HOUSE_NM,(select HOUSENAME from eward where HOUSENO=student.EMP_WARD)WARD_NM,(select STOPPAGE from stoppage where STOPNO=student.STOPNO)STOP_NM,(select regn_no from busnomaster where BusCode=student.BUS_NO)BUS_NO_C,(select Rname from religion where RNo=student.religion)religion_nm", "Student_Status='ACTIVE' AND religion=$religion and CLASS in ('$cls')");
		}



		if (sizeof($data) != 0) {
			$rel = $data[0]->religion_nm;
		} else {
			$rel = '';
		}
		$array = array('religion' => $religion, 'sec' => $sec, 'cls' => $clsss, 'data' => $data, 'wardt' => $rel);
		// echo "<pre>";print_r($array);die;

		$this->load->view('student_details/student_relig_w', $array);
	}
	public function show_strenght_religion_pdf()
	{
		$religion = $this->input->post('religion');
		$sec = $this->input->post('secc');
		// echo $sec;
		if ($sec != 'All') {
			$seccc = " AND SEC='$sec'";
		} else {
			$seccc = "";
		}
		$cls = $this->input->post('langOpt');
		// echo"<pre>", print_r($cls);die;
		$clsss = $cls;
		$cls = implode("','", $cls);
		if ($sec != 'All') {
			$data = $this->dbcon->select('student', "*,(select CAT_ABBR from category where CAT_CODE=student.CATEGORY)CATEGORY_NM,(select HOUSENAME from house where HOUSENO=student.HOUSE_CODE)HOUSE_NM,(select HOUSENAME from eward where HOUSENO=student.EMP_WARD)WARD_NM,(select STOPPAGE from stoppage where STOPNO=student.STOPNO)STOP_NM,(select regn_no from busnomaster where BusCode=student.BUS_NO)BUS_NO_C,(select Rname from religion where RNo=student.religion)religion_nm", "Student_Status='ACTIVE' AND religion=$religion and CLASS in ('$cls') and sec in('$sec')");
		} else {
			$data = $this->dbcon->select('student', "*,(select CAT_ABBR from category where CAT_CODE=student.CATEGORY)CATEGORY_NM,(select HOUSENAME from house where HOUSENO=student.HOUSE_CODE)HOUSE_NM,(select HOUSENAME from eward where HOUSENO=student.EMP_WARD)WARD_NM,(select STOPPAGE from stoppage where STOPNO=student.STOPNO)STOP_NM,(select regn_no from busnomaster where BusCode=student.BUS_NO)BUS_NO_C,(select Rname from religion where RNo=student.religion)religion_nm", "Student_Status='ACTIVE' AND religion=$religion and CLASS in ('$cls')");
		}

		if (sizeof($data) != 0) {
			$rel = $data[0]->religion_nm;
		} else {
			$rel = '';
		}
		$school_setting = $this->dbcon->select('school_setting', '*');

		$array = array('school_setting' => $school_setting, 'religion' => $religion, 'sec' => $sec, 'cls' => $clsss, 'data' => $data, 'wardt' => $rel);
		// echo "<pre>";print_r($array);die;

		$this->load->view('student_details/student_relig_w_PDF', $array);
		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Head_Wise_Summary_Report.pdf", array("Attachment" => 0));
	}




	public function show_student_details($id)
	{
		//echo $id;
		$data = $this->dbcon->show_student_new($id);
	//$str=$this->db->last_query();
		//echo $str;
		//die;


		$adm = $data[0]->ADMISSION_NO;

		$father = $this->dbcon->select('parents', '*', "STDID='$id' AND PTYPE='F'");
		$mother = $this->dbcon->select('parents', '*', "STDID='$id' AND PTYPE='M'");
		$sibling_details = $this->dbcon->select('childhist', '*', "StId='$id' AND AdmNo='$adm'");
		$temp_daycoll = $this->dbcon->select('temp_daycoll', '*', "ADM_NO='$adm' AND SEC='Z' ORDER BY RECT_DATE");
		$daycoll = $this->dbcon->select('daycoll', '*', "ADM_NO='$adm' ORDER BY RECT_DATE");
		$feehead = $this->dbcon->select('feehead', '*');
		$arr_mrg = array_merge($temp_daycoll, $daycoll);
		$array = array(
			'student_detail' => $data,
			'father_detail'  => $father,
			'mother_detail'  => $mother,
			'sibling_details' => $sibling_details,
			'arr_mrg' => $arr_mrg,
			'feehead' => $feehead
		);
		// print_r("<pre>");print_r($array);exit();
		$this->fee_template('student_details/show_student_details', $array);
	}
	public function add_student()
	{
		$class = $this->dbcon->select('classes', '*');
		$section = $this->dbcon->select('sections', '*');
		$category = $this->dbcon->select('category', '*');
		$house = $this->dbcon->select('house', '*');
		$ward = $this->dbcon->select('eward', '*');
		$month = $this->dbcon->select('month_master', '*');
		$stopage = $this->dbcon->select('stoppage', '*');
		$religion = $this->dbcon->select('religion', '*');
		$subject = $this->dbcon->select('subjects', '*');
		$adm_no = $this->dbcon->select('adm_no', '*');
		$array = array(
			'class' => $class,
			'section' => $section,
			'category' => $category,
			'house' => $house,
			'eward' => $ward,
			'stopage' => $stopage,
			'religion' => $religion,
			'subject' => $subject,
			'admission' => $adm_no,
			'month' => $month
		);
		$this->fee_template('student_details/add_new_student', $array);
	}
	public function stopage()
	{
		$value = $this->input->post('value');
		$data  = $this->dbcon->gettripdetails($value);
		echo json_encode($data);
	}
	public function getvehicleno()
	{
		$trip 		= $this->input->post('val');
		$stopno = $this->input->post('busstopage');
		$data  = $this->dbcon->getvehicle($trip, $stopno);
		echo json_encode($data);
	}
	public function getpreference()
	{
		$stopno      = $this->input->post('busstopage');
		$trip        = $this->input->post('trip');
		$vechilecode = $this->input->post('val');
		$data = $this->dbcon->select('bus_route_master', 'Prefer_ID', "BusCode='$vechilecode' AND Trip_ID='$trip' AND STOPNO='$stopno'");
?>
		<option value=''>Select</option>
		<?php
		foreach ($data as $key => $value) {
			if ($value->Prefer_ID == 1) {
				$genderNm = 'BOY';
			} else if ($value->Prefer_ID == 2) {
				$genderNm = 'GIRLS';
			} else {
				$genderNm = 'CO.ED';
			}
		?>
			<option value="<?php echo $value->Prefer_ID ?>"><?php echo $genderNm; ?></option>
<?php
		}
		//echo json_encode($data);
	}
	public function getrouteId()
	{
		$busstopage = $this->input->post('busstopage');
		$trip = $this->input->post('trip');
		$vechicleno = $this->input->post('vechicleno');
		$preference = $this->input->post('val');
		$data = $this->dbcon->select('bus_route_master', 'Route_Id', "BusCode='$vechicleno' AND Trip_ID='$trip' AND Prefer_ID='$preference' AND STOPNO='$busstopage'");
		if (!empty($data)) {
			echo $val = $data[0]->Route_Id;
		} else {
			echo $val = 0;
		}
	}
	public function add_record()
	{
		$fname      = $this->input->post('sfn');
		$full_name  = $fname;
		$class_code = $this->input->post('admclass');
		$current_class = $this->input->post('curtclass');
		$sec_code   = $this->input->post('admsec');
		$cur_sec   = $this->input->post('curtsec');
		$adm_no     = $this->input->post('std_adn');
		$std_id     = $this->input->post('std_id');
		$FREESHIP   = $this->input->post('radio3');
		$FREESHIP_TYPE   = $this->input->post('freeshipType');
		$handicap   = $this->input->post('radio4');
		$handi_type = strtoupper($this->input->post('handicap'));
		$status = "ACTIVE";
		$pf = 'F';
		$pm = 'M';
		$nation = 'INDIA';
		if (!empty($_FILES['upload_img']['name'])) {
			$image              = $_FILES['upload_img']['name'];
			$expimage           = explode('.', $image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count - 1];
			$image_name         = $std_id . '.' . $image_ext;
			$imagepath          = "assets/student_photo/" . $image_name;

			move_uploaded_file($_FILES["upload_img"]["tmp_name"], $imagepath);
		} else {
			$imagepath  = '';
		}
		$data = $this->dbcon->max_no('student_transport_facility', 'ID');
		$max_no = $data[0]->ID + 1;
		// $config['upload_path'] = '/assets/student_photo/';
		// $config['allowed_types'] = 'png|jpg|jpeg';
		// $config['max_size'] = '500';
		// $config['overwrite'] = TRUE;
		// $config['file_name'] = $std_id;

		// $this->load->library('upload', $config);

		//getting data from class tables as class_name varidable
		$class = $this->dbcon->select('classes', '*', "Class_No='$current_class'");
		$class_name = $class[0]->CLASS_NM;
		// ending fetch data from the back end of the table
		//Getting data from the section table from the back end
		$section = $this->dbcon->select('sections', '*', "section_no='$cur_sec'");
		$section_name = $section[0]->SECTION_NAME;
		//ending fetch data from the back end of the table
		//geting data from adm_no tables
		$get_adm = $this->dbcon->select('adm_no', '*');
		/*$get_adm = $this->dbcon->select('adm_no','*',"adm_no='$adm_no'");*/
		$dft = $get_adm[0]->adm_no;
		// ending fetch data from adm_no tables

		if ($FREESHIP == 1) {
			$FREESHIP_letterno = strtoupper($this->input->post('freeship'));
			$FREESHIP_type     = strtoupper($this->input->post('freeshipType'));
			$FREESHIP_t = 'FREESHIP';
		} else {
			$FREESHIP_letterno = "N/A";
			$FREESHIP_t = 'N/A';
			$FREESHIP_type = 'N/A';
		}

		if ($handicap == 1) {
			$handicap_nature = $handi_type;
		} else {
			$handicap_nature = "N/A";
		}
		$User_Id = $this->session->userdata('user_id');
		//================CHECKING ADMISSION IN MID SESSION==================//
		$adm_mid_ses = $this->input->post('midses');
		$month1 = $this->input->post('admfrom');
		if (!empty($month1)) {
			$va = $month1;
		} else {
			$va = 1;
		}
		$get_mon_data = $this->dbcon->select('month_master', '*');
		if ($adm_mid_ses == 1) {
			foreach ($get_mon_data as $key => $value) {
				if ($month1 > $value->id) {
					if ($value->month_name == "JUN") {
						$month_status['JUNE_FEE'] = "ADMITTED";
					} else if ($value->month_name == "JUL") {
						$month_status['JULY_FEE'] = "ADMITTED";
					} else {
						$month_status[$value->month_name . '_FEE'] = "ADMITTED";
					}
				} else {
					if ($value->month_name == "JUN") {
						$month_status['JUNE_FEE'] = "N/A";
					} else if ($value->month_name == "JUL") {
						$month_status['JULY_FEE'] = "N/A";
					} else {
						$month_status[$value->month_name . '_FEE'] = "N/A";
					}
				}
			}
		} else {
			if ($FREESHIP == 1) {
				foreach ($get_mon_data as $key => $value) {
					if ($value->month_name == "JUN") {
						$month_status['JUNE_FEE'] = "FREESHIP";
					} else if ($value->month_name == "JUL") {
						$month_status['JULY_FEE'] = "FREESHIP";
					} else {
						$month_status[$value->month_name . '_FEE'] = "FREESHIP";
					}
				}
			} else {
				foreach ($get_mon_data as $key => $value) {
					if ($value->month_name == "JUN") {
						$month_status['JUNE_FEE'] = "N/A";
					} else if ($value->month_name == "JUL") {
						$month_status['JULY_FEE'] = "N/A";
					} else {
						$month_status[$value->month_name . '_FEE'] = "N/A";
					}
				}
			}
		}
		//===================================================================//

		$session_master = $this->dbcon->select('session_master', '*', "Active_Status='1'");
		$session_year = $session_master[0]->Session_Year;
		// $datas = $this->upload->data();
		// $image = 'assets/student_photo/'.$datas['orig_name'];
		$student_details = array(
			'STUDENTID'     => $std_id,
			'ADM_DATE'      => $this->input->post('std_adm_date'),
			'ADM_NO'        => $adm_no,
			'BIRTH_DT'      => $this->input->post('dob'),
			'FIRST_NM'      => strtoupper($full_name),
			'BLOOD_GRP'     => $this->input->post('blood_group'),
			'CATEGORY'      => $this->input->post('category'),
			'SEX'           => strtoupper($this->input->post('sex')),
			'NATION'        => $nation,
			'EMP_WARD'      => $this->input->post('ward'),
			'FATHER_NM'     => strtoupper($this->input->post('fathername')),
			'MOTHER_NM'     => strtoupper($this->input->post('mothername')),
			'LAST_SCH'      => strtoupper($this->input->post('lsn')),
			'LSCH_ADD'      => strtoupper($this->input->post('lsa')),
			'ADM_CLASS'     => $this->input->post('admclass'),
			'ADM_SEC'       => $this->input->post('admsec'),
			'PERM_ADD'      => strtoupper($this->input->post('peradd')),
			'P_CITY'        => strtoupper($this->input->post('percity')),
			'P_STATE'       => $this->input->post('perstate'),
			'P_NATION'      => $this->input->post('percountry'),
			'P_PIN'         => $this->input->post('perpin'),
			'P_PHONE1'      => $this->input->post('perphone'),
			'P_PHONE2'      => $this->input->post('perphone2'),
			'P_FAXNO'       => $this->input->post('perfax'),
			'P_MOBILE'      => $this->input->post('permobile'),
			'P_EMAIL'       => $this->input->post('peremail'),
			'CORR_ADD'      => strtoupper($this->input->post('crossaddress')),
			'C_CITY'        => strtoupper($this->input->post('crosscity')),
			'C_STATE'       => $this->input->post('crossstate'),
			'C_NATION'      => $this->input->post('crosscountry'),
			'C_PIN'         => $this->input->post('crosspin'),
			'C_PHONE1'      => $this->input->post('crossphone'),
			'C_PHONE2'      => $this->input->post('crossphone2'),
			'C_FAXNO'       => $this->input->post('crossfax'),
			'C_MOBILE'      => $this->input->post('crossmoblile'),
			'C_EMAIL'       => $this->input->post('crossemail'),
			'HOUSE_CODE'    => $this->input->post('house'),
			'CLASS'         => $this->input->post('curtclass'),
			'DISP_CLASS'    => $class_name,
			'SEC'           => $this->input->post('curtsec'),
			'DISP_SEC'      => $section_name,
			'ROLL_NO'       => $this->input->post('roll'),
			'STOPNO'        => $this->input->post('busstopage'),
			'religion'      => $this->input->post('religion'),
			'Fee_Book_No'   => $this->input->post('account'),
			'Bus_Book_No'   => $this->input->post('aadhar'),
			'CBSE_REG'      => $this->input->post('cbse_reg'),
			'CBSE_ROLL'     => $this->input->post('cbse_roll'),
			'SUBJECT1'      => $this->input->post('first_subject'),
			'SUBJECT2'      => $this->input->post('second_subject'),
			'SUBJECT3'      => $this->input->post('third_subject'),
			'SUBJECT4'      => $this->input->post('fourth_subject'),
			'SUBJECT5'      => $this->input->post('fifth_subject'),
			'SUBJECT6'      => $this->input->post('sixth_subject'),
			'Student_Status' => $status,
			'BUS_NO'        => $this->input->post('sciencefee'),
			'HOSTEL'        => $this->input->post('radio1'),
			'COMPUTER'      => $this->input->post('radio2'),
			'FREESHIP'      => $FREESHIP,
			'LETTERNO'      => $FREESHIP_letterno,
			'math_lab'      => $handicap,
			'oldadmno'      => $handicap_nature,
			'APR_FEE'       => $FREESHIP_t,
			'MAY_FEE'       => $FREESHIP_t,
			'JUNE_FEE'      => $FREESHIP_t,
			'JULY_FEE'      => $FREESHIP_t,
			'AUG_FEE'       => $FREESHIP_t,
			'SEP_FEE'       => $FREESHIP_t,
			'OCT_FEE'       => $FREESHIP_t,
			'NOV_FEE'       => $FREESHIP_t,
			'DEC_FEE'       => $FREESHIP_t,
			'JAN_FEE'       => $FREESHIP_t,
			'FEB_FEE'       => $FREESHIP_t,
			'MAR_FEE'       => $FREESHIP_t,
			'SESSIONID'     => $session_year,
			'student_image' => $imagepath,
			'Parent_password' => $adm_no,
			'route_id' 		=> $this->input->post('route_id'),
			'student_transport_facility_id' => $max_no,
			'mid_session_admission_status' => $adm_mid_ses,
			'Admission_month' => $va,
			'FREESHIP_TYPE' => $FREESHIP_type,
		);

		$month = $this->input->post('applicablemonth');
		$getmonth = $this->dbcon->select('month_master', '*', "month_name='$month'");
		$month_code = $getmonth[0]->id;
		$student_transport_facility = array(
			'ID' 			=> $max_no,
			'ADM_NO' 		=> $adm_no,
			'OLD_STOPNO' 	=> $this->input->post('busstopage'),
			'NEW_STOPNO' 	=> $this->input->post('busstopage'),
			'FROM_APPLICABLE_MONTH'      => $this->input->post('applicablemonth'),
			'TO_APPLICABLE_MONTH'        => 'MAR',
			'FROM_APPLICABLE_MONTH_CODE' => $month_code,
			'TO_APPLICABLE_MONTH_CODE'   => 12,
			'USER_ID'   => $User_Id,
		);
		$parent_father = array(
			'STDID'      => $std_id,
			'ED_QUA'     => strtoupper($this->input->post('father_qualification')),
			'OCCUPATION' => strtoupper($this->input->post('father_occupation')),
			'DESIG'      => strtoupper($this->input->post('father_designation')),
			'MTH_INCOME' => $this->input->post('father_income'),
			'MOBILE'     => $this->input->post('father_mobile'),
			'ADDRESS'    => strtoupper($this->input->post('father_address')),
			'CITY'       => strtoupper($this->input->post('father_city')),
			'PIN'        => $this->input->post('father_pin'),
			'STATE'      => strtoupper($this->input->post('father_state')),
			'PTYPE'      => $pf
		);

		$parent_mother = array(
			'STDID'      => $std_id,
			'ED_QUA'     => strtoupper($this->input->post('medu')),
			'OCCUPATION' => strtoupper($this->input->post('moccupation')),
			'DESIG'      => strtoupper($this->input->post('mdesignation')),
			'MTH_INCOME' => $this->input->post('mincome'),
			'MOBILE'     => $this->input->post('mmoblie'),
			'ADDRESS'    => strtoupper($this->input->post('maddress')),
			'CITY'       => strtoupper($this->input->post('mcity')),
			'PIN'        => $this->input->post('mpin'),
			'STATE'      => strtoupper($this->input->post('mstate')),
			'PTYPE'      => $pm
		);

		$sibling_history = array(
			'StId'   => $std_id,
			'AdmNo'  => $adm_no,
			'Name1'  => strtoupper($this->input->post('sibling1')),
			'DOB1'   => $this->input->post('siblingdob'),
			'Sex1'   => strtoupper($this->input->post('sibling_gender')),
			'Adm1'   => $this->input->post('siblingadmission'),
			'Name2'  => strtoupper($this->input->post('sibling2')),
			'DOB2'   => $this->input->post('second_sibling_dob'),
			'Sex2'   => strtoupper($this->input->post('second_sibling_gender')),
			'Adm2'   => $this->input->post('second_sibling_adm'),
			'Name3'  => strtoupper($this->input->post('sibling3')),
			'DOB3'   => $this->input->post('third_sibling_dob'),
			'Sex3'   => strtoupper($this->input->post('third_sibling_gender')),
			'Adm3'   => $this->input->post('third_sibling_adm'),
			'Name4'  => strtoupper($this->input->post('sibling4')),
			'DOB4'   => $this->input->post('fourth_sibling_dob'),
			'Sex4'   => strtoupper($this->input->post('fourth_sibling_gender')),
			'Adm4'   => $this->input->post('fourth_sibling_adm')
		);
		// echo "<pre>";
		// print_r($student_details);
		// print_r($parent_father);
		// print_r($parent_mother);
		// print_r($sibling_history);
		// print_r($student_transport_facility);
		// print_r($month_status);
		// exit;
		$new_id = $dft + 1;

		$new_adm = array('adm_no' => $new_id);
		if ($this->dbcon->insert('student', $student_details) && $this->dbcon->insert('student_transport_facility', $student_transport_facility) && $this->dbcon->insert('parents', $parent_father) && $this->dbcon->insert('parents', $parent_mother) && $this->dbcon->insert('childhist', $sibling_history) && $this->dbcon->update('adm_no', $new_adm, "ID='1'")) {
			$this->dbcon->update('student', $month_status, "ADM_NO='$adm_no'");
			$this->session->set_flashdata('msg', "Successfully Added");
			
			
			if($this->input->post('b_certificate') == 'on'){
				$b_certificate = '1';
			}else{
				$b_certificate = '0';
			} 
			if($this->input->post('tc') == 'on'){
				$tc = '1';
			}else{
				$tc = '0';
			}
			if($this->input->post('rc') == 'on'){
				$rc = '1';
			}else{
				$rc = '0';
			} 	
			if($this->input->post('ac') == 'on'){
				$ac = '1';
			}else{
				$ac = '0';
			} 
			if($this->input->post('m_certificate') == 'on'){
				$m_certificate = '1';
			}else{
				$m_certificate = '0';
			} 				
			
			$certificate_ins = array(
				'admno' => $adm_no,
				'b_certificate' => $b_certificate,
				'tc' => $tc,
				'report_card' => $rc,
				'adhar_card' => $ac,
				'migr_certificate' => $m_certificate,
			);
			
			$this->dbcon->insert('certificate_details',$certificate_ins);
			
			
			redirect('Student_details/Student_master');
		} else {
			$this->session->set_flashdata('msg', "Student Record Not Added");
			redirect('Student_details/Student_master');
		}
	}

	public function update_fee_details()
	{
		$adm_no = $this->input->post('adn');
		$details =  $this->dbcon->select('student', '*', "ADM_NO='$adm_no'");
		$id = $details[0]->STUDENTID;
		$update = array(
			'APR_FEE'  => strtoupper($this->input->post('april')),
			'MAY_FEE'  => strtoupper($this->input->post('may')),
			'JUNE_FEE' => strtoupper($this->input->post('june')),
			'JULY_FEE' => strtoupper($this->input->post('july')),
			'AUG_FEE'  => strtoupper($this->input->post('august')),
			'SEP_FEE'  => strtoupper($this->input->post('september')),
			'OCT_FEE'  => strtoupper($this->input->post('october')),
			'NOV_FEE'  => strtoupper($this->input->post('november')),
			'DEC_FEE'  => strtoupper($this->input->post('december')),
			'JAN_FEE'  => strtoupper($this->input->post('january')),
			'FEB_FEE'  => strtoupper($this->input->post('february')),
			'MAR_FEE'  => strtoupper($this->input->post('march'))

		);
		$this->dbcon->update('student', $update, "ADM_NO='$adm_no'");
		$this->session->set_flashdata('msg', "Fee Details update Successfull");
		redirect(base_url('Student_details/show_student_details/' . $id));
	}
	public function update_student_details($id)
	{
		$data = $this->dbcon->show_student_new($id);
		$adm = $data[0]->ADMISSION_NO;
		$student_data = $this->dbcon->select('student', '*', "ADM_NO='$adm'");
		$student_transport_facility_id = $student_data[0]->student_transport_facility_id;
		$transport_details = $this->dbcon->select('student_transport_facility', '*', "ID='$student_transport_facility_id'");
		if (!empty($transport_details)) {
			$APPLY_MONTH_CODE = $transport_details[0]->FROM_APPLICABLE_MONTH_CODE;
		} else {
			$APPLY_MONTH_CODE = 0;
		}


		$father = $this->dbcon->select('parents', '*', "STDID='$id' AND PTYPE='F'");
		$mother = $this->dbcon->select('parents', '*', "STDID='$id' AND PTYPE='M'");
		$calss = $this->dbcon->select('classes', '*');
		$section = $this->dbcon->select('sections', '*');
		$category = $this->dbcon->select('category', '*');
		$house = $this->dbcon->select('house', '*');
		$ward = $this->dbcon->select('eward', '*');
		$stopage = $this->dbcon->data_orderby('stoppage',  "stoppage");
		//$stopage = $this->dbcon->select('stoppage', '*');
		$stopamt = $this->dbcon->select('stop_amt', '*');
		$religion = $this->dbcon->select('religion', '*');
		$state = $this->dbcon->select('state', '*');
		$subject = $this->dbcon->select('subjects', '*');
		$month = $this->dbcon->select('month_master', '*', "id>'$APPLY_MONTH_CODE'");
		$sibling_details = $this->dbcon->select('childhist', '*', "StId='$id' AND AdmNo='$adm'");
		$array = array(
			'student_detail' => $data,
			'father_detail'  => $father,
			'mother_detail'  => $mother,
			'sibling_details' => $sibling_details,
			'class' => $calss,
			'section' => $section,
			'category' => $category,
			'house' => $house,
			'eward' => $ward,
			'stoppage' => $stopage,
			'religion' => $religion,
			'state' => $state,
			'subject' => $subject,
			'month'  => $month,
		);
		$this->render_template('student_details/update_student', $array);
	}
	public function re_update()
	{
		$cur_class_code = $this->input->post('curclass');
		$cur_sec_code = $this->input->post('cursec');
		$student_id = $this->input->post('sti');
		$student_admission = $this->input->post('adn');
		$current_class = $this->dbcon->select('classes', '*', "Class_No='$cur_class_code'");
		$class_name = $current_class[0]->CLASS_NM;

		$current_sec = $this->dbcon->select('sections', '*', "section_no='$cur_sec_code'");
		$section_name = $current_sec[0]->SECTION_NAME;

		$freeship = $this->input->post('radio3');
		$freeship_type = $this->input->post('freeship');
		$User_Id = $this->session->userdata('user_id');
		//=student details =//
		//===========================================//
		$student_data = $this->dbcon->select('student', '*', "ADM_NO='$student_admission'");
		$APR_FEE = $student_data[0]->APR_FEE;
		$MAY_FEE = $student_data[0]->MAY_FEE;
		$JUNE_FEE = $student_data[0]->JUNE_FEE;
		$JULY_FEE = $student_data[0]->JULY_FEE;
		$AUG_FEE = $student_data[0]->AUG_FEE;
		$SEP_FEE = $student_data[0]->SEP_FEE;
		$OCT_FEE = $student_data[0]->OCT_FEE;
		$NOV_FEE = $student_data[0]->NOV_FEE;
		$DEC_FEE = $student_data[0]->DEC_FEE;
		$JAN_FEE = $student_data[0]->JAN_FEE;
		$FEB_FEE = $student_data[0]->FEB_FEE;
		$MAR_FEE = $student_data[0]->MAR_FEE;
		$imge_path = $student_data[0]->student_image;
		//= end of fetching student details ==/
		//===========================================//
		$route_id = $this->input->post('route_id');
		$bus_facility_id = $this->input->post('bus_facility_id');
		$applicablemonth = $this->input->post('applicablemonth');
		$stopno = $this->input->post('busstopage');

		if (!empty($applicablemonth)) {
			$applicabemonth_code = $this->dbcon->select('month_master', '*', "month_name='$applicablemonth'");
			$get_month_code = $applicabemonth_code[0]->id;

			$getStudentTransportDetails = $this->dbcon->select('student_transport_facility', '*', "ID='$bus_facility_id'");
			$old_stop_no = isset($getStudentTransportDetails[0]->NEW_STOPNO) ? $getStudentTransportDetails[0]->NEW_STOPNO : 0;



			if ($old_stop_no == $stopno) {
				$max_no = $bus_facility_id;
			} else {
				$getmaxno = $this->dbcon->max_no('student_transport_facility', 'ID');
				$max_no = $getmaxno[0]->ID + 1;
				if (empty($getStudentTransportDetails)) {
					$student_transport_facility = array(
						'ID' => $max_no,
						'ADM_NO' => $student_admission,
						'OLD_STOPNO' => $stopno,
						'NEW_STOPNO' => $stopno,
						'FROM_APPLICABLE_MONTH' => $applicablemonth,
						'TO_APPLICABLE_MONTH' => 'MAR',
						'FROM_APPLICABLE_MONTH_CODE' => $get_month_code,
						'TO_APPLICABLE_MONTH_CODE' => 12,
						'USER_ID' => $User_Id
					);
					$this->dbcon->insert('student_transport_facility', $student_transport_facility);
				} else {
					$finalOldMonthCode = $get_month_code - 1;

					$forUpdateCode = $this->dbcon->select('month_master', '*', "id='$finalOldMonthCode'");
					$forUpdateCodee = isset($forUpdateCode[0]->id) ? $forUpdateCode[0]->id : 1;
					$forUpdateCodeMonth = isset($forUpdateCode[0]->month_name) ? $forUpdateCode[0]->month_name : "APR";
					$student_transport_facility = array(
						'ID' => $max_no,
						'ADM_NO' => $student_admission,
						'OLD_STOPNO' => $old_stop_no,
						'NEW_STOPNO' => $stopno,
						'FROM_APPLICABLE_MONTH' => $applicablemonth,
						'TO_APPLICABLE_MONTH' => 'MAR',
						'FROM_APPLICABLE_MONTH_CODE' => $get_month_code,
						'TO_APPLICABLE_MONTH_CODE' => 12,
						'USER_ID' => $User_Id
					);
					$student_transport_facility_update = array(
						'TO_APPLICABLE_MONTH' => $forUpdateCodeMonth,
						'TO_APPLICABLE_MONTH_CODE' => $forUpdateCodee,

					);
					$this->dbcon->insert('student_transport_facility', $student_transport_facility);
					$this->dbcon->update('student_transport_facility', $student_transport_facility_update, "ID='$bus_facility_id'");
				}
			}
		} else {
			$max_no = $bus_facility_id;
		}

		if ($freeship == 1) {
			if ($freeship_type == 'APR') {
				$apr = 'FREESHIP';
				$may = 'FREESHIP';
				$jun = 'FREESHIP';
				$jul = 'FREESHIP';
				$aug = 'FREESHIP';
				$sep = 'FREESHIP';
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'MAY') {
				$apr = $APR_FEE;
				$may = 'FREESHIP';
				$jun = 'FREESHIP';
				$jul = 'FREESHIP';
				$aug = 'FREESHIP';
				$sep = 'FREESHIP';
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'JUN') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = 'FREESHIP';
				$jul = 'FREESHIP';
				$aug = 'FREESHIP';
				$sep = 'FREESHIP';
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'JUL') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = 'FREESHIP';
				$aug = 'FREESHIP';
				$sep = 'FREESHIP';
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'AUG') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = 'FREESHIP';
				$sep = 'FREESHIP';
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'SEP') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = 'FREESHIP';
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'OCT') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = 'FREESHIP';
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'NOV') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = $OCT_FEE;
				$nov = 'FREESHIP';
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'DEC') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = $OCT_FEE;
				$nov = $NOV_FEE;
				$dec = 'FREESHIP';
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'JAN') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = $OCT_FEE;
				$nov = $NOV_FEE;
				$dec = $DEC_FEE;
				$jan = 'FREESHIP';
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'FEB') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = $OCT_FEE;
				$nov = $NOV_FEE;
				$dec = $DEC_FEE;
				$jan = $JAN_FEE;
				$feb = 'FREESHIP';
				$mar = 'FREESHIP';
			} elseif ($freeship_type == 'MAR') {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = $OCT_FEE;
				$nov = $NOV_FEE;
				$dec = $DEC_FEE;
				$jan = $JAN_FEE;
				$feb = $FEB_FEE;
				$mar = 'FREESHIP';
			} else {
				$apr = $APR_FEE;
				$may = $MAY_FEE;
				$jun = $JUNE_FEE;
				$jul = $JULY_FEE;
				$aug = $AUG_FEE;
				$sep = $SEP_FEE;
				$oct = $OCT_FEE;
				$nov = $NOV_FEE;
				$dec = $DEC_FEE;
				$jan = $JAN_FEE;
				$feb = $FEB_FEE;
				$mar = $MAR_FEE;
			}
		} else {
			$apr = $APR_FEE;
			$may = $MAY_FEE;
			$jun = $JUNE_FEE;
			$jul = $JULY_FEE;
			$aug = $AUG_FEE;
			$sep = $SEP_FEE;
			$oct = $OCT_FEE;
			$nov = $NOV_FEE;
			$dec = $DEC_FEE;
			$jan = $JAN_FEE;
			$feb = $FEB_FEE;
			$mar = $MAR_FEE;
			$freeship_type = 'N/A';
		}

		$FREE = $this->input->post('radio4');
		$FREE_TYPE = strtoupper($this->input->post('handicap'));

		if ($FREE == 1) {
			$FREE_TYPE1 = $FREE_TYPE;
		} else {
			$FREE_TYPE1 = 'N/A';
		}


		if (!empty($_FILES['reupload']['name'])) {
			$image              = $_FILES['reupload']['name'];
			$expimage           = explode('.', $image);
			$count              = count($expimage);
			$image_ext          = $expimage[$count - 1];
			$image_name         = $student_id . '.' . $image_ext;
			$imagepath          = "assets/student_photo/" . $image_name;

			move_uploaded_file($_FILES["reupload"]["tmp_name"], $imagepath);
		} else {
			$imagepath  = $imge_path;
		}


		$student_details = array(
			'ADM_DATE'       => $this->input->post('ad'),
			'FIRST_NM' 	  	 => strtoupper($this->input->post('sfn')),
			'ADM_CLASS'      => $this->input->post('admclass'),
			'ADM_SEC'        => $this->input->post('admsec'),
			'CLASS'          => $cur_class_code,
			'DISP_CLASS'     => $class_name,
			'SEC'            => $cur_sec_code,
			'DISP_SEC'       => $section_name,
			'EMP_WARD' 		 => $this->input->post('ward'),
			'ROLL_NO'        => $this->input->post('roll'),
			'SEX'            => $this->input->post('sex'),
			'BIRTH_DT'       => $this->input->post('dob'),
			'CATEGORY'       => $this->input->post('category'),
			'HOUSE_CODE'     => $this->input->post('house'),
			'HOUSE_CODE'     => $this->input->post('ward'),
			'STOPNO'         => $this->input->post('busstopage'),
			'BLOOD_GRP'      => $this->input->post('blood_group'),
			'Fee_Book_No'    => $this->input->post('account_number'),
			'Bus_Book_No'    => $this->input->post('aadhar_no'),
			'religion'       => $this->input->post('religionn'),
			'BUS_NO'         => $this->input->post('SCIENCE_FEE'),
			'HOSTEL'         => $this->input->post('radio1'),
			'COMPUTER'       =>  $this->input->post('radio2'),
			'FREESHIP'       => $freeship,
			'LETTERNO'       => $freeship_type,
			'APR_FEE'        => $apr,
			'MAY_FEE'        => $may,
			'JUNE_FEE'       => $jun,
			'JULY_FEE'       => $jul,
			'AUG_FEE'        => $aug,
			'SEP_FEE'        => $sep,
			'OCT_FEE'        => $oct,
			'NOV_FEE'        => $nov,
			'DEC_FEE'        => $dec,
			'JAN_FEE'        => $jan,
			'FEB_FEE'        => $feb,
			'MAR_FEE'        => $mar,
			'math_lab'       => $this->input->post('radio4'),
			'oldadmno'       => $FREE_TYPE1,
			'LAST_SCH'       => strtoupper($this->input->post('lsn')),
			'LSCH_ADD'       => strtoupper($this->input->post('lsa')),
			'FATHER_NM'      => strtoupper($this->input->post('fname')),
			'MOTHER_NM'      => strtoupper($this->input->post('mname')),
			'SUBJECT1'       => $this->input->post('first_subject'),
			'SUBJECT2'       => $this->input->post('second_subject'),
			'SUBJECT3'       => $this->input->post('third_subject'),
			'SUBJECT4'       => $this->input->post('fourth_subject'),
			'SUBJECT5'       => $this->input->post('fifth_subject'),
			'SUBJECT6'       => $this->input->post('sixth_subject'),
			'PERM_ADD'       => strtoupper($this->input->post('peradd')),
			'P_CITY'         => strtoupper($this->input->post('percity')),
			'P_STATE'        => strtoupper($this->input->post('perstate')),
			'P_NATION'       => strtoupper($this->input->post('pernation')),
			'P_PIN'          => $this->input->post('per_pin'),
			'P_PHONE1'       => $this->input->post('phone_1'),
			'P_PHONE2'       => $this->input->post('phone_2'),
			'P_MOBILE'       => $this->input->post('per_mobile'),
			'P_FAXNO'        => $this->input->post('per_fax'),
			'P_EMAIL'        => $this->input->post('per_email'),
			'CORR_ADD'       => strtoupper($this->input->post('cross_add')),
			'C_CITY'         => strtoupper($this->input->post('cross_city')),
			'C_PIN'          => $this->input->post('cross_pin'),
			'C_STATE'        => strtoupper($this->input->post('crossstate')),
			'C_NATION'       => strtoupper($this->input->post('cross_nation')),
			'C_MOBILE'       => $this->input->post('cross_mobile'),
			'C_PHONE1'       => $this->input->post('cross_phone1'),
			'C_PHONE2'       => $this->input->post('cross_phone2'),
			'C_FAXNO'        => $this->input->post('cross_fax'),
			'C_EMAIL'        => $this->input->post('cross_email'),
			'CBSE_REG'       => strtoupper($this->input->post('cbsereg')),
			'CBSE_ROLL'      => strtoupper($this->input->post('cbseroll')),
			'student_image'  => $imagepath,
			'route_id' 		 => $this->input->post('route_id'),
			'student_transport_facility_id' => $max_no

		);

		// echo "<pre>";
		// print_r($student_details);
		// exit;
		$student_father = array(
			'STDID' => $student_id,
			'ED_QUA' => strtoupper($this->input->post('fedu')),
			'OCCUPATION' => strtoupper($this->input->post('foccupation')),
			'DESIG' => strtoupper($this->input->post('fdesignation')),
			'MTH_INCOME' => $this->input->post('fincome'),
			'MOBILE' => $this->input->post('fmobile'),
			'ADDRESS' => strtoupper($this->input->post('faddress')),
			'CITY' => strtoupper($this->input->post('fcity')),
			'STATE' => strtoupper($this->input->post('fstate')),
			'PIN' => $this->input->post('fpin'),
			'PTYPE' => "F"
		);

		$student_mother = array(
			'STDID' => $student_id,
			'ED_QUA' => strtoupper($this->input->post('medu')),
			'OCCUPATION' => strtoupper($this->input->post('moccu')),
			'DESIG' => strtoupper($this->input->post('mdesignation')),
			'MTH_INCOME' => $this->input->post('mincome'),
			'MOBILE' => $this->input->post('mmobile'),
			'ADDRESS' => strtoupper($this->input->post('maddress')),
			'CITY' => strtoupper($this->input->post('mcity')),
			'STATE' => strtoupper($this->input->post('mstate')),
			'PIN' => $this->input->post('mpin'),
			'PTYPE' => "M"
		);

		$childhist = array(
			'StId' => $student_id,
			'AdmNo' => $student_admission,
			'Name1' => strtoupper($this->input->post('first_name')),
			'DOB1' => $this->input->post('first_dob'),
			'Sex1' => $this->input->post('first_sex'),
			'Adm1' => $this->input->post('first_adm'),
			'Name2' => strtoupper($this->input->post('second_name')),
			'DOB2' => $this->input->post('second_dob'),
			'Sex2' => $this->input->post('second_sex'),
			'Adm2' => $this->input->post('second_adm'),
			'Name3' => strtoupper($this->input->post('third_name')),
			'DOB3' =>  $this->input->post('third_dob'),
			'Sex3' =>  $this->input->post('third_sex'),
			'Adm3' =>  $this->input->post('third_adm'),
			'Name4' => $this->input->post('fourth_name'),
			'DOB4' =>  $this->input->post('fourth_dob'),
			'Sex4' =>  $this->input->post('fourth_sex'),
			'Adm4' =>  $this->input->post('fourth_adm')
		);

		$this->dbcon->update('student', $student_details, "ADM_NO='$student_admission'");
		$father_details = $this->dbcon->select('parents', '*', "STDID='$student_id' AND PTYPE='F'");
		$f_cnt = count($father_details);
		if ($f_cnt == 1) {
			$this->dbcon->update('parents', $student_father, "STDID='$student_id' AND PTYPE='F'");
		} else {
			$this->dbcon->insert('parents', $student_father);
		}
		$mother_details = $this->dbcon->select('parents', '*', "STDID='$student_id' AND PTYPE='F'");
		$m_cnt = count($father_details);
		if ($m_cnt == 1) {
			$this->dbcon->update('parents', $student_mother, "STDID='$student_id' AND PTYPE='M'");
		} else {
			$this->dbcon->insert('parents', $student_mother);
		}
		$child_details = $this->dbcon->select('childhist', '*', "StId='$student_id' AND AdmNo='$student_admission'");
		$c_cnt = count($child_details);
		if ($c_cnt == 1) {
			$this->dbcon->update('childhist', $childhist, "StId='$student_id' AND AdmNo='$student_admission'");
		} else {
			$this->dbcon->insert('childhist', $childhist);
		}
		$this->session->set_flashdata('msg', "Successfully Updated Student Details");
		redirect(base_url('Student_details/show_student_details/' . $student_id));
	}

	public function Scholarship()
	{
		$data = $this->dbcon->select('scholarship', '*');
		$fee_head1 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='1'");
		$fee_head2 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='2'");
		$fee_head3 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='3'");
		$fee_head4 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='4'");
		$fee_head5 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='5'");
		$fee_head6 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='6'");
		$fee_head7 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='7'");
		$fee_head8 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='8'");
		$fee_head9 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='9'");
		$fee_head10 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='10'");
		$fee_head11 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='11'");
		$fee_head12 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='12'");
		$fee_head13 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='13'");
		$fee_head14 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='14'");
		$fee_head15 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='15'");
		$fee_head16 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='16'");
		$fee_head17 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='17'");
		$fee_head18 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='18'");
		$fee_head19 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='19'");
		$fee_head20 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='20'");
		$fee_head21 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='21'");
		$fee_head22 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='22'");
		$fee_head23 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='23'");
		$fee_head24 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='24'");
		$fee_head25 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='25'");
		$scholarship = array(
			'scholarship' => $data,
			'fee_head1' => $fee_head1,
			'fee_head2' => $fee_head2,
			'fee_head3' => $fee_head3,
			'fee_head4' => $fee_head4,
			'fee_head5' => $fee_head5,
			'fee_head6' => $fee_head6,
			'fee_head7' => $fee_head7,
			'fee_head8' => $fee_head8,
			'fee_head9' => $fee_head9,
			'fee_head10' => $fee_head10,
			'fee_head11' => $fee_head11,
			'fee_head12' => $fee_head12,
			'fee_head13' => $fee_head13,
			'fee_head14' => $fee_head14,
			'fee_head15' => $fee_head15,
			'fee_head16' => $fee_head16,
			'fee_head17' => $fee_head17,
			'fee_head18' => $fee_head18,
			'fee_head19' => $fee_head19,
			'fee_head20' => $fee_head20,
			'fee_head21' => $fee_head21,
			'fee_head22' => $fee_head22,
			'fee_head23' => $fee_head23,
			'fee_head24' => $fee_head24,
			'fee_head25' => $fee_head25
		);
		$this->fee_template('student_details/scholarship_master', $scholarship);
	}

	public function scholarship_student($val)
	{
		$month = $this->dbcon->select('month_master', '*');
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$fee_head1 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='1'");
		$fee_head2 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='2'");
		$fee_head3 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='3'");
		$fee_head4 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='4'");
		$fee_head5 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='5'");
		$fee_head6 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='6'");
		$fee_head7 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='7'");
		$fee_head8 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='8'");
		$fee_head9 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='9'");
		$fee_head10 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='10'");
		$fee_head11 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='11'");
		$fee_head12 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='12'");
		$fee_head13 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='13'");
		$fee_head14 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='14'");
		$fee_head15 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='15'");
		$fee_head16 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='16'");
		$fee_head17 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='17'");
		$fee_head18 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='18'");
		$fee_head19 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='19'");
		$fee_head20 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='20'");
		$fee_head21 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='21'");
		$fee_head22 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='22'");
		$fee_head23 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='23'");
		$fee_head24 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='24'");
		$fee_head25 = $this->dbcon->select('feehead', 'FEE_HEAD', "ACT_CODE='25'");
		$scholarship = $this->dbcon->select('scholarship', '*', "STUDENTID='$val'");
		$data = array(
			'month' => $month,
			'class' => $class,
			'sec'   => $sec,
			'fee_head1' => $fee_head1,
			'fee_head2' => $fee_head2,
			'fee_head3' => $fee_head3,
			'fee_head4' => $fee_head4,
			'fee_head5' => $fee_head5,
			'fee_head6' => $fee_head6,
			'fee_head7' => $fee_head7,
			'fee_head8' => $fee_head8,
			'fee_head9' => $fee_head9,
			'fee_head10' => $fee_head10,
			'fee_head11' => $fee_head11,
			'fee_head12' => $fee_head12,
			'fee_head13' => $fee_head13,
			'fee_head14' => $fee_head14,
			'fee_head15' => $fee_head15,
			'fee_head16' => $fee_head16,
			'fee_head17' => $fee_head17,
			'fee_head18' => $fee_head18,
			'fee_head19' => $fee_head19,
			'fee_head20' => $fee_head20,
			'fee_head21' => $fee_head21,
			'fee_head22' => $fee_head22,
			'fee_head23' => $fee_head23,
			'fee_head24' => $fee_head24,
			'fee_head25' => $fee_head25,
			'scholarship' => $scholarship
		);
		$this->fee_template('student_details/scholarship_details', $data);
	}

	public function scholarship_update()
	{
		$studentid = $this->input->post('stu_id1');
		$admno = $this->input->post('admno1');
		$update_scholarship = array(
			'ADM_NO' => $admno,
			'Apply_From' => $this->input->post('saf'),
			'Owned_By' => $this->input->post('sgb'),
			'S1' => $this->input->post('regform'),
			'S2' => $this->input->post('af'),
			'S3' => $this->input->post('adf'),
			'S4' => $this->input->post('rs'),
			'S5' => $this->input->post('bf'),
			'S6' => $this->input->post('ef'),
			'S7' => $this->input->post('hqf'),
			'S8' => $this->input->post('pf'),
			'S9' => $this->input->post('asf'),
			'S10' => $this->input->post('tf'),
			'S11' => $this->input->post('sf'),
			'S12' => $this->input->post('cf'),
			'S13' => $this->input->post('tb'),
			'S14' => $this->input->post('ic'),
			'S15' => $this->input->post('lf'),
			'S16' => $this->input->post('srf'),
			'S17' => $this->input->post('dry'),
			'S17' => $this->input->post('dry'),
			'S18' => $this->input->post('blt'),
			'S19' => $this->input->post('tie'),
			'S20' => $this->input->post('cdbf'),
			'S21' => $this->input->post('misc'),
			'S22' => $this->input->post('others'),
			'S23' => $this->input->post('books'),
			'S24' => $this->input->post('feeopt'),
			'S25' => $this->input->post('feeopt1'),
			'app_no' => $this->input->post('app_no'),
			'recomm' =>$this->input->post('recomm'),
		);
		$this->dbcon->update('scholarship', $update_scholarship, "ADM_NO='$admno'");
		$this->session->set_flashdata('msg', 'Successfully Updated');
		redirect(base_url('Student_details/scholarship_student/' . $studentid));
	}

	public function add_scholarship()
	{
		$adm = $this->dbcon->select('student', 'ADM_NO', "Student_Status='ACTIVE'");
		
		//$adm = $this->dbcon->select('student', 'ADM_NO', "STUDENT_STATUS=ACTIVE");
		$month = $this->dbcon->select('month_master', '*');
		$feehead = $this->dbcon->select('feehead', '*');
		// $fee_head1 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='1'");
		// $fee_head2 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='2'");
		// $fee_head3 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='3'");
		// $fee_head4 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='4'");
		// $fee_head5 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='5'");
		// $fee_head6 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='6'");
		// $fee_head7 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='7'");
		// $fee_head8 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='8'");
		// $fee_head9 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='9'");
		// $fee_head10 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='10'");
		// $fee_head11 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='11'");
		// $fee_head12 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='12'");
		// $fee_head13 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='13'");
		// $fee_head14 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='14'");
		// $fee_head15 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='15'");
		// $fee_head16 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='16'");
		// $fee_head17 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='17'");
		// $fee_head18 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='18'");
		// $fee_head19 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='19'");
		// $fee_head20 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='20'");
		// $fee_head21 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='21'");
		// $fee_head22 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='22'");
		// $fee_head23 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='23'");
		// $fee_head24 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='24'");
		// $fee_head25 = $this->dbcon->select('feehead','FEE_HEAD',"ACT_CODE='25'");
		$array = array(
			'admno' => $adm,
			'month' => $month,
			'feehead' => $feehead
			// 'fee_head1' => $fee_head1,
			// 'fee_head2' => $fee_head2,
			// 'fee_head3' => $fee_head3,
			// 'fee_head4' => $fee_head4,
			// 'fee_head5' => $fee_head5,
			// 'fee_head6' => $fee_head6,
			// 'fee_head7' => $fee_head7,
			// 'fee_head8' => $fee_head8,
			// 'fee_head9' => $fee_head9,
			// 'fee_head10' => $fee_head10,
			// 'fee_head11' => $fee_head11,
			// 'fee_head12' => $fee_head12,
			// 'fee_head13' => $fee_head13,
			// 'fee_head14' => $fee_head14,
			// 'fee_head15' => $fee_head15,
			// 'fee_head16' => $fee_head16,
			// 'fee_head17' => $fee_head17,
			// 'fee_head18' => $fee_head18,
			// 'fee_head19' => $fee_head19,
			// 'fee_head20' => $fee_head20,
			// 'fee_head21' => $fee_head21,
			// 'fee_head22' => $fee_head22,
			// 'fee_head23' => $fee_head23,
			// 'fee_head24' => $fee_head24,
			// 'fee_head25' => $fee_head25
		);
		$this->fee_template('student_details/add_scholarship', $array);
	}

	public function Scholarship_add()
	{
		$data = $this->input->post('value');
		$student_data = $this->dbcon->select('student', '*', "ADM_NO='$data' AND Student_Status='ACTIVE'");
		$adm = $this->dbcon->select('scholarship', 'ADM_NO', "ADM_NO='$data'");
		$name = $student_data[0]->FIRST_NM;
		$class = $student_data[0]->DISP_CLASS;
		$sec = $student_data[0]->DISP_SEC;
		$roll = $student_data[0]->ROLL_NO;
		$classcode = $student_data[0]->CLASS;
		$clssec = $class . "-" . $sec;
		$cnt = count($adm);
		$array = array($data, $cnt, $name, $clssec, $roll, $adm, $classcode);
		echo json_encode($array);
	}

	public function save_scholarship()
	{
		$admission = $this->input->post('admission');
		$student = $this->dbcon->select('student', '*', "ADM_NO='$admission'  AND Student_Status='ACTIVE'");
		$std_id = $student[0]->STUDENTID;
		$classec = $this->input->post('clssec');
		$septrater = explode("-", $classec);
		$class = $septrater[0];
		$sec = $septrater[1];
		$fee1 = $this->input->post('feehead1');
		$fee2 = $this->input->post('feehead2');
		$fee3 = $this->input->post('feehead3');
		$fee4 = $this->input->post('feehead4');
		$fee5 = $this->input->post('feehead5');
		$fee6 = $this->input->post('feehead6');
		$fee7 = $this->input->post('feehead7');
		$fee8 = $this->input->post('feehead8');
		$fee9 = $this->input->post('feehead9');
		$fee10 = $this->input->post('feehead10');
		$fee11 = $this->input->post('feehead11');
		$fee12 = $this->input->post('feehead12');
		$fee13 = $this->input->post('feehead13');
		$fee14 = $this->input->post('feehead14');
		$fee15 = $this->input->post('feehead15');
		$fee16 = $this->input->post('feehead16');
		$fee17 = $this->input->post('feehead17');
		$fee18 = $this->input->post('feehead18');
		$fee19 = $this->input->post('feehead19');
		$fee20 = $this->input->post('feehead20');
		$fee21 = $this->input->post('feehead21');
		$fee22 = $this->input->post('feehead22');
		$fee23 = $this->input->post('feehead23');
		$fee24 = $this->input->post('feehead24');
		$fee25 = $this->input->post('feehead25');
		$awarded = $this->input->post('saf');
		if ($awarded == 'APR') {
			$awarded_val = '1';
		} elseif ($awarded == 'MAY') {
			$awarded_val = '2';
		} elseif ($awarded == 'JUN') {
			$awarded_val = '3';
		} elseif ($awarded == 'JUL') {
			$awarded_val = '4';
		} elseif ($awarded == 'AUG') {
			$awarded_val = '5';
		} elseif ($awarded == 'SEP') {
			$awarded_val = '6';
		} elseif ($awarded == 'OCT') {
			$awarded_val = '7';
		} elseif ($awarded == 'NOV') {
			$awarded_val = '8';
		} elseif ($awarded == 'DEC') {
			$awarded_val = '9';
		} elseif ($awarded == 'JAN') {
			$awarded_val = '10';
		} elseif ($awarded == 'FEB') {
			$awarded_val = '11';
		} elseif ($awarded == 'MAR') {
			$awarded_val = '12';
		}


		$array = array(
			'ADM_NO' => $admission,
			'STU_NAME' => strtoupper($this->input->post('name')),
			'STUDENTID' => $std_id,
			'CLASS' => $class,
			'SEC' => $sec,
			'ROLL_NO' => $this->input->post('roll'),
			'S1' => $this->input->post('feehead1'),
			'S2' => $this->input->post('feehead2'),
			'S3' => $this->input->post('feehead3'),
			'S4' => $this->input->post('feehead4'),
			'S5' => $this->input->post('feehead5'),
			'S6' => $this->input->post('feehead6'),
			'S7' => $this->input->post('feehead7'),
			'S8' => $this->input->post('feehead8'),
			'S9' => $this->input->post('feehead9'),
			'S10' => $this->input->post('feehead10'),
			'S11' => $this->input->post('feehead11'),
			'S12' => $this->input->post('feehead12'),
			'S13' => $this->input->post('feehead13'),
			'S14' => $this->input->post('feehead14'),
			'S15' => $this->input->post('feehead15'),
			'S16' => $this->input->post('feehead16'),
			'S17' => $this->input->post('feehead17'),
			'S18' => $this->input->post('feehead18'),
			'S19' => $this->input->post('feehead19'),
			'S20' => $this->input->post('feehead20'),
			'S21' => $this->input->post('feehead21'),
			'S22' => $this->input->post('feehead22'),
			'S23' => $this->input->post('feehead23'),
			'S24' => $this->input->post('feehead24'),
			'S25' => $this->input->post('feehead25'),
			'Apply_From' => $this->input->post('saf'),
			'Owned_By' => $this->input->post('sgb'),
			'AWARDED' => $awarded_val,
			'recomm' =>$this->input->post('recomm'),
			'app_no' => $this->input->post('app_no')
		);
		$array1 = array(
			'SCHOLAR' => 1
		);
		if ($fee1 > 0 || $fee2 > 0 || $fee3 > 0 || $fee4 > 0 || $fee5 > 0 || $fee6 > 0 || $fee7 > 0 || $fee8 > 0 || $fee9 > 0 || $fee10 > 0 || $fee11 > 0 || $fee12 > 0 || $fee13 > 0 || $fee14 > 0 || $fee15 > 0 || $fee16 > 0 || $fee17 > 0 || $fee18 > 0 || $fee19 > 0 || $fee20 > 0 || $fee21 > 0 || $fee22 > 0 || $fee23 > 0 || $fee24 > 0 || $fee25 > 25) {
			$this->dbcon->update('student', $array1, "ADM_NO='$admission'");
			$this->dbcon->insert('scholarship', $array);
			$this->session->set_flashdata('msg', "Scholarship Given Successfully");
			redirect('Student_details/Scholarship/');
		} else {
			$this->session->set_flashdata('msg', "Please Enter Amount in any One Head");
			redirect('Student_details/add_scholarship');
		}
	}


	public function checkadm()
	{
		$adm = $this->input->post('val');
		$data = $this->dbcon->select('student', '*', "ADM_NO='$adm'");
		$cnt = count($data);
		echo $cnt;
	}
	public function delete_student_details($id)
	{
		$data = $this->dbcon->select('student', 'ADM_NO,FIRST_NM,MIDDLE_NM,TITLE_NM,DISP_CLASS,DISP_SEC,', "STUDENTID='$id'");
		$adm_no=$data[0]->ADM_NO;
		$stu_name=$data[0]->FIRST_NM." ".$data[0]->MIDDLE_NM." ".$data[0]->TITLE_NM;
		$classs=$data[0]->DISP_CLASS;
		$seccc=$data[0]->DISP_SEC;
		$del_date=date('Y-m-d');

		$del_arr = array (
			'Adm_no'	=> $adm_no,
			'Stu_name'	=> $stu_name,
			'cl'		=> $classs,
			'sec'		=> $seccc,
			'del_date'	=> $del_date,
			'operator_id'	=>'COUNTER1'
		);

		$arr = array(
			'Student_Status' => 'UNACTIVE'
		);
		if ($this->dbcon->update('student', $arr, "STUDENTID='$id'")) {
			$this->dbcon->insert('Deleted_Student_Details',$del_arr);
			$this->session->set_flashdata('msg', "Student Deleted Successfully");
			redirect('Student_details/Student_master');
		} else {
			$this->session->set_flashdata('msg', "Student Not Deleted Successfully");
			redirect('Student_details/Student_master');
		}
	}
}
