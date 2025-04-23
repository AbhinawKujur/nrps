<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bus_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
		$this->load->model('Mymodel', 'dbcon');
	}
	public function show_report()
	{
		$this->fee_template('bus_report/show_report');
	}

	public function stoppage_wise()
	{
		$stoppage = $this->db->query("SELECT distinct(stu.STOPNO),(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname FROM `student` as stu where stu.Student_status='ACTIVE'")->result();

		$array = array(
			'stoppage' => $stoppage,

		);
		$this->fee_template('bus_report/stoppage', $array);
	}

	public function student_busfacility()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec
		);
		$this->fee_template('bus_report/stu_busfacility', $array);
	}

	public function stu_buslist()
	{
	
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');

		if ($class == 'All' && $sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();

		} elseif ($sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		} else {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		}
		


		$array = array(
			'data' => $data,
			'class' => $class,
			'sec' => $sec,
		);

		if (!empty($data)) {
			$this->load->view('bus_report/student_listshow', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	public function stoppage_details()
	{
		$stoppage		= $this->input->post('stoppage_name');
		$amt		= $this->input->post('amt');
		$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO from student where STOPNO='$stoppage' AND Student_status='ACTIVE' order by FIRST_NM")->result();
		$array = array(
			'stoppage' => $stoppage,
			'data' => $data,
			'amt' => $amt,
		);

		if (!empty($data)) {
			$this->load->view('bus_report/stoppage_details', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	public function download_busreport()
	{
		$stoppage		= $this->input->post('stoppage');
		$amt		= $this->input->post('amt');
		$stop_name = $this->db->query("select STOPPAGE from stoppage where STOPNO='$stoppage'")->result();
		$stoppagae_name = $stop_name[0]->STOPPAGE;
		$school_setting = $this->dbcon->select('school_setting', '*');
		$data = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO from student where STOPNO='$stoppage' AND Student_status='ACTIVE' order by FIRST_NM")->result();

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'stoppagae_name' => $stoppagae_name,
			'amt' => $amt,
		);

		$this->load->view('bus_report/stoppage_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_Stoppage.pdf", array("Attachment" => 0));
	}
	
	public function download_bus_stulistreport()
	{
		$class		= $this->input->post('classs');
		$sec		= $this->input->post('secc');

		$school_setting = $this->dbcon->select('school_setting', '*');

		if ($class == 'All' && $sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		} elseif ($sec == 'All') {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		} else {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();
		}

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,
			'class' => $class,
			'sec' => $sec,
		);

		$this->load->view('bus_report/bus_stulist_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Bus_FacilityList.pdf", array("Attachment" => 0));
	}

	public function stoppage_summary()
	{

		$this->fee_template('bus_report/stoppage_summary');
	}

	public function stoppage_summary_data()
	{

		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where stu.Student_status='ACTIVE' AND stu.STOPNO>1")->result();
		$array = array(

			'data' => $data,

		);

		if (!empty($data)) {
			$this->load->view('bus_report/stoppage_summary_details', $array);
		} else {
			echo "<center><h1>Sorry No Student</h1></center>";
		}
	}

	public function stoppage_summary_pdf()
	{

		$school_setting = $this->dbcon->select('school_setting', '*');
		$data = $this->db->query("SELECT distinct STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.STOPNO>1 AND Student_Status='ACTIVE')TOTALSTUDENT,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=1 AND student.STOPNO>1 AND Student_Status='ACTIVE')MALE,(SELECT COUNT(*) FROM student WHERE student.STOPNO=stu.STOPNO AND student.sex=2 AND student.STOPNO>1 AND Student_Status='ACTIVE')FEMALE FROM `student` stu where stu.Student_status='ACTIVE' AND stu.STOPNO>1")->result();

		$array = array(
			'school_setting' => $school_setting,
			'data' => $data,

		);

		$this->load->view('bus_report/stoppage_summary_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A3', 'landscape');
		$this->dompdf->render();
		$this->dompdf->stream("Stoppage_Summary.pdf", array("Attachment" => 0));
	}

	public function find_sec()
	{
		$val = $this->input->post('val');
		$data = $this->dbcon->select_distinct('student', 'DISP_SEC,SEC', "CLASS='$val' AND Student_Status='ACTIVE'");
		?>
		<option value=''>Select</option>
		<option value='All'>All Section</option>
		<?php
		foreach ($data as $dt) {
		?>
			<option value='<?php echo $dt->SEC; ?>'><?php echo $dt->DISP_SEC; ?></option>
		<?php
		}
	}

	public function student_bus_card()
	{
		$class = $this->dbcon->select('classes', '*');
		$sec = $this->dbcon->select('sections', '*');
		$bus = $this->dbcon->select('busnomaster', '*');
		$array = array(
			'class' => $class,
			'sec' => $sec,
			'bus'	=> $bus,
		);
		// echo "<pre>";
		// print_r($array);die;
		$this->fee_template('bus_report/stu_buspasscard', $array);
	}

	public function stu_bus_pass_list()
	{
		$class		= $this->input->post('class_name');
		$sec 		= $this->input->post('sec_name');
		$bus_number = $this->input->post('bus_number');
		$bus_pass   = $this->input->post('bus_pass');
		$buss_code = $this->db->query("select BusCode from busnomaster where BusNo='$bus_number'")->result();
		$busCode = $buss_code[0]->BusCode;
		if ($bus_pass == 1) {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.stopno='$busCode' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();

			// echo "<pre>"; print_r($data);die;

			$array = array(
				'data' => $data,
				'class' => $class,
				'sec' => $sec,
			);
			if (!empty($data)) {
				$this->load->view('bus_report/stu_buspasslist', $array);
			} else {
				echo "<center><h1>Sorry No Student</h1></center>";
			}
		}
		if ($bus_pass == 2) {
			$data = $this->db->query("select stu.ADM_NO,stu.FIRST_NM,stu.FATHER_NM,stu.C_MOBILE,stu.DISP_CLASS,stu.DISP_SEC,stu.ROLL_NO,stu.STOPNO,(select STOPPAGE from stoppage where stu.STOPNO=STOPNO) stopname,stu.STOPNO,(SELECT AMT from stop_amt where stu.STOPNO=STOP_NO) stp_amt from student as stu where stu.CLASS='$class' AND stu.SEC='$sec' AND stu.STOPNO>1 AND stu.Student_status='ACTIVE' order by FIRST_NM")->result();

			$array = array(
				'data' => $data,
				'class' => $class,
				'sec' => $sec,
			);
			if (!empty($data)) {
				$this->load->view('bus_report/stu_buspasslist', $array);
			} else {
				echo "<center><h1>Sorry No Student</h1></center>";
			}
		}
	}
	
	public function busno_wise(){
		// $data['busno'] = $this->db->query("SELECT DISTINCT(bus_no) FROM stoppage order by bus_no asc")->result();

		$data['busno'] = $this->db->query("SELECT DISTINCT (BusNo)  as  BusNo , BusCode as bus_no FROM `busnomaster` ORDER BY BusCode;")->result();
		
		$this->render_template('bus_report/busno',$data);
	}

	public function bus_amt()
	{
		$val = $this->input->post('val');
		
		
		$data = $this->db->query("SELECT AMT FROM `stop_amt` where STOP_NO='$val'")->result();
		?>
		<?php
		foreach ($data as $dt) {
		?>
			<option value='<?php echo $dt->AMT; ?>'><?php echo $dt->AMT; ?></option>
		<?php
		}
	}

	public function busno_details()
	{
		$buscode = $this->input->post('stoppage_name');
		//$section	= $this->input->post('sections'); //9 j , 8 s

		// echo $section; 
		// $stoppages = $this->db->query("SELECT stopno FROM `stoppage`where bus_no='".$buscode."' order by  STOPNO ASC")->result();

		if ($buscode == 'All') {

			$data = $this->db->query("SELECT
			student.ADM_NO ,
			student.FIRST_NM  ,
			student.FATHER_NM  ,
			student.DISP_CLASS  ,
			student.DISP_SEC  ,
			student.C_MOBILE,
			student.STOPNO,
			stoppage.STOPPAGE AS stoppage,
			(SELECT AMT FROM STOP_AMT WHERE STOP_AMT.STOP_NO = STUDENT.STOPNO) AS AMT,
			(SELECT BUSNO FROM busnomaster WHERE BUSCODE = bus_route_master.BusCode) AS Bus_No
		  FROM
			(((((((student
			LEFT JOIN classes ON student.ADM_CLASS = classes.Class_No)
			LEFT JOIN sections ON student.ADM_SEC = sections.section_no)
			LEFT JOIN category ON student.CATEGORY = category.CAT_CODE)
			LEFT JOIN house ON student.HOUSE_CODE = house.HOUSENO)
			LEFT JOIN eward ON student.EMP_WARD = eward.HOUSENO)
			LEFT JOIN stoppage ON student.STOPNO = stoppage.STOPNO)
			LEFT JOIN bus_route_master ON bus_route_master.STOPNO = stoppage.STOPNO)
           WHERE
			student.sec not in (21,22,23,24) AND
            student.STOPNO <> 1 AND
			Student_Status = 'ACTIVE'
		  ORDER BY
			Bus_No,student.STOPNO;
		  ")->result();
		} else {

			$data = $this->db->query("SELECT
			student.ADM_NO ,
			student.FIRST_NM  ,
			student.FATHER_NM  ,
			student.DISP_CLASS  ,
			student.DISP_SEC  ,
			student.C_MOBILE,
			student.STOPNO,
			stoppage.STOPPAGE AS stoppage,
			(SELECT AMT FROM STOP_AMT WHERE STOP_AMT.STOP_NO = STUDENT.STOPNO) AS AMT,
			(SELECT BUSNO FROM busnomaster WHERE BUSCODE = bus_route_master.busCode) AS Bus_No
		  FROM
			(((((((student
			LEFT JOIN classes ON student.ADM_CLASS = classes.Class_No)
			LEFT JOIN sections ON student.ADM_SEC = sections.section_no)
			LEFT JOIN category ON student.CATEGORY = category.CAT_CODE)
			LEFT JOIN house ON student.HOUSE_CODE = house.HOUSENO)
			LEFT JOIN eward ON student.EMP_WARD = eward.HOUSENO)
			LEFT JOIN stoppage ON student.STOPNO = stoppage.STOPNO)
			LEFT JOIN bus_route_master ON bus_route_master.STOPNO = stoppage.STOPNO)
           WHERE
			student.sec not in (21,22,23,24) AND
            student.STOPNO <> 1 AND
			Student_Status = 'ACTIVE' AND
            bus_route_master.BusCode = $buscode
		  ORDER BY
			student.STOPNO;
		  ")->result();

			// echo $this->db->last_query();


		}




		$array = [
			//'bus_no' => $bus_no,
			'buscode' => $buscode,
			//'section' => $section,
			'getBusNoData' => $data
		];

		// echo "<pre>";
		// print_r($array);die;
		// $data = $this->db->query("SELECT busnomaster.BusCode, busnomaster.BusNo FROM bus_route_master LEFT JOIN busnomaster ON bus_route_master.BusCode = busnomaster.BusCode WHERE bus_route_master.STOPNO = '$stopno' ")->result();

		$this->load->view('bus_report/busno_details', $array);
	}

	public function download_busnoreport()
	{
		$buscode = $this->input->post('buscode');

		if ($buscode == 'All') {

			$data = $this->db->query("SELECT
			student.ADM_NO ,
			student.FIRST_NM  ,
			student.FATHER_NM  ,
			student.DISP_CLASS  ,
			student.DISP_SEC  ,
			student.C_MOBILE,
			student.STOPNO,
			stoppage.STOPPAGE AS stoppage,
			(SELECT AMT FROM STOP_AMT WHERE STOP_AMT.STOP_NO = STUDENT.STOPNO) AS AMT,
			(SELECT BUSNO FROM busnomaster WHERE BUSCODE = bus_route_master.BusCode) AS Bus_No
		  FROM
			(((((((student
			LEFT JOIN classes ON student.ADM_CLASS = classes.Class_No)
			LEFT JOIN sections ON student.ADM_SEC = sections.section_no)
			LEFT JOIN category ON student.CATEGORY = category.CAT_CODE)
			LEFT JOIN house ON student.HOUSE_CODE = house.HOUSENO)
			LEFT JOIN eward ON student.EMP_WARD = eward.HOUSENO)
			LEFT JOIN stoppage ON student.STOPNO = stoppage.STOPNO)
			LEFT JOIN bus_route_master ON bus_route_master.STOPNO = stoppage.STOPNO)
           WHERE
			student.sec not in (21,22,23,24) AND
            student.STOPNO <> 1 AND
			Student_Status = 'ACTIVE'
		  ORDER BY
			Bus_No,student.STOPNO;
		  ")->result();
		} else {

			$data = $this->db->query("SELECT
			student.ADM_NO ,
			student.FIRST_NM  ,
			student.FATHER_NM  ,
			student.DISP_CLASS  ,
			student.DISP_SEC  ,
			student.C_MOBILE,
			student.STOPNO,
			stoppage.STOPPAGE AS stoppage,
			(SELECT AMT FROM STOP_AMT WHERE STOP_AMT.STOP_NO = STUDENT.STOPNO) AS AMT,
			(SELECT BUSNO FROM busnomaster WHERE BUSCODE = bus_route_master.busCode) AS Bus_No
		  FROM
			(((((((student
			LEFT JOIN classes ON student.ADM_CLASS = classes.Class_No)
			LEFT JOIN sections ON student.ADM_SEC = sections.section_no)
			LEFT JOIN category ON student.CATEGORY = category.CAT_CODE)
			LEFT JOIN house ON student.HOUSE_CODE = house.HOUSENO)
			LEFT JOIN eward ON student.EMP_WARD = eward.HOUSENO)
			LEFT JOIN stoppage ON student.STOPNO = stoppage.STOPNO)
			LEFT JOIN bus_route_master ON bus_route_master.STOPNO = stoppage.STOPNO)
           WHERE
			student.sec not in (21,22,23,24) AND
            student.STOPNO <> 1 AND
			Student_Status = 'ACTIVE' AND
            bus_route_master.BusCode = $buscode
		  ORDER BY
			student.STOPNO;
		  ")->result();
		}


		$school_setting = $this->db->query('SELECT * FROM school_setting')->result();
		$school_name = $school_setting[0]->School_Name;
		$school_address = $school_setting[0]->School_Address;
		$school_session = $school_setting[0]->School_Session;

		$array = [
			//'bus_no' => $bus_no,
			'buscode' => $buscode,
			//'section' => $section,
			'getBusNoData' => $data,
			'school_name' => $school_name,
			'school_address' => $school_address,
			'school_session' => $school_session
		];


		$this->load->view('bus_report/busno_details_pdf', $array);

		$html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->stream("BusNoReport.pdf", array("Attachment"=>0));
	}

	
	public function student_busno_summary()
	{
		$data = $this->dbcon->select('STOPPAGE', 'DISTINCT(BUS_NO)BUS_NO,count(STOPPAGE)cnt,', "BUS_NO!='' and BUS_NO!='-' group by BUS_NO");
		$alldata = array();
		foreach ($data as $key) {
			$bsno = $key->BUS_NO;
			$stop = '';
			$data2 = $this->dbcon->select('STOPPAGE', 'STOPNO', "BUS_NO='$bsno'");
			foreach ($data2 as $Key2) {
				$stop .= "'" . $Key2->STOPNO . "',";
			}
			$stop .= "'0'";
			$group_a = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and DISP_CLASS in ('VI','VII','VIII') and Student_status='ACTIVE'");
			$group_b = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and DISP_CLASS in ('IX','X') and Student_status='ACTIVE'");
			$group_c = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and DISP_CLASS in ('XI','XII') and Student_status='ACTIVE'");
			$group_m = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and SEX='1' and Student_status='ACTIVE'");
			$group_f = $this->dbcon->select('student', 'count(ADM_NO)cnt', "1='1' and STOPNO in ($stop) and SEX='2' and Student_status='ACTIVE'");
			$group_a = (sizeof($group_a) != 0) ? $group_a[0]->cnt : 0;
			$group_b = (sizeof($group_b) != 0) ? $group_b[0]->cnt : 0;
			$group_c = (sizeof($group_c) != 0) ? $group_c[0]->cnt : 0;
			$group_m = (sizeof($group_m) != 0) ? $group_m[0]->cnt : 0;
			$group_f = (sizeof($group_f) != 0) ? $group_f[0]->cnt : 0;
			$tot_stu = $group_a + $group_b + $group_c;
			$mrg = array('bus_no' => $bsno, 'stoppage' => $key->cnt, 'tot_stu' => $tot_stu, 'group_a' => $group_a, 'group_b' => $group_b, 'group_c' => $group_c, 'group_m' => $group_m, 'group_f' => $group_f);

			$alldata[] = $mrg;
		}
		$all['alldata'] = $alldata;
		$all['school_setting'] = $this->dbcon->select('school_setting', '*');
		$this->render_template('bus_report/stu_busno_summary', $all);
	}

	public function student_busno()
	{
		$data['BUS_NO'] = $this->dbcon->select('STOPPAGE', 'DISTINCT(BUS_NO)BUS_NO', "BUS_NO!=''");
		$this->render_template('bus_report/stu_busno', $data);
	}

	public function stu_data_bus()
	{
		$bno = $this->input->post('b_no');
		$data = $this->dbcon->select('STOPPAGE', 'STOPPAGE,STOPNO', "BUS_NO ='$bno'");
		foreach ($data as $key) {
			$stop_nm = $key->STOPPAGE;
			$stop_no = $key->STOPNO;
			$data = $this->dbcon->select('student', 'FIRST_NM,TITLE_NM,MIDDLE_NM,ADM_NO,DISP_CLASS,DISP_SEC,C_MOBILE', "STOPNO ='$stop_no' and Student_status='ACTIVE'");
			$ddl = array('stop_nm' => $stop_nm, 'stu_data' => $data);
			$record[$stop_no] = $ddl;
		}
		$mydata['school_setting'] = $this->dbcon->select('school_setting', '*');
		$mydata['stu_busno'] = $record;
		$mydata['bs_no'] = $bno;


		$this->load->view('bus_report/stu_busno_data', $mydata);
	}

	public function updateBusByStu()
	{
		$bus_code = $this->input->post('val');
		$type     = $this->input->post('type');
		$admno    = $this->input->post('admno');
		if ($type == 1) {
			$upd = array(
				'arrival_bus_code' => $bus_code
			);
		} else {
			$upd = array(
				'departure_bus_code' => $bus_code
			);
		}

		$this->dbcon->update('student', $upd, "ADM_NO='$admno'");
	}

	public function getBusReport($bus_code)
	{
		$data['data'] = $this->db->query("select ADM_NO,FIRST_NM,FATHER_NM,C_MOBILE,DISP_CLASS,DISP_SEC,ROLL_NO,arrival_bus_code,(select BusNo from busnomaster where BusCode=student.arrival_bus_code)arrival,departure_bus_code,(select BusNo from busnomaster where BusCode=student.departure_bus_code)departure from student where STOPNO='$bus_code' AND Student_status='ACTIVE' order by DISP_CLASS,DISP_SEC,ROLL_NO")->result_array();
		$this->load->view('bus_report/bus_report_new', $data);
	}

	public function generate_bus_pass()
	{
		echo "<script> window.print();</script>";
		$chekedstudent = $this->input->post('chekedstudent');
		// echo "<pre>";print_r($chekedstudent);die;
		$cnt_adm = '';
		foreach ($chekedstudent as $key) {
			$cnt_adm .= "'$key',";
		}
		$cnt_adm .= "'0'";
		$data['schoolData'] = $this->alam->selectA('school_setting', '*');
		$data['getData'] = $this->alam->selectA('student', 'student_image,ADM_NO,FIRST_NM,DISP_CLASS,DISP_SEC,FATHER_NM,BLOOD_GRP,(select STOPPAGE from stoppage where STOPNO=student.STOPNO)STOPNO,(select bus_no from bus_no_naster where id=student.arrival_bus_code)arrival_bus_code,(select bus_no from bus_no_naster where id=student.departure_bus_code)departure_bus_code,C_MOBILE,P_MOBILE,CORR_ADD,C_CITY,C_STATE,C_PIN', "ADM_NO in ($cnt_adm) order by (FIRST_NM)");
		// echo"<pre>";
		// print_r($data);die;
		$this->load->view('bus_report/stu_buspass', $data);

		// $html = $this->output->get_output();
		// $this->load->library('pdf');
		// $this->dompdf->loadHtml($html);
		// $this->dompdf->setPaper('A4', 'portrait');
		// $this->dompdf->render();
		// $this->dompdf->stream("Student-icard.pdf", array("Attachment"=>0));
	}

}
