<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assignclasswisesubject extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function index()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		
		$data['classList'] =$this->sumit->fetchAllData('*','classes',array());
		$data['subjectList'] =$this->sumit->fetchAllData('*','subjects',array());
		$data['createdClassSection'] = $this->sumit->fetchDataGroupByWhere('Class_Sec_SubCode,Class_name_Roman','class_section_wise_subject_allocation',array(),"Class_name_Roman,Class_Sec_SubCode");
		$data['resultList'] = array();
		$this->render_template('timetable/assignClassSectionWiseSubject',$data);
	}

	public function createData()
	{
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');
		$subject_id = $this->input->post('subject_id');
		$combined_subject = $this->input->post('combined_subject[]');
		$required_support_teacher = $this->input->post('required_support_teacher');
		$total_period = $this->input->post('total_period');
		$getClassSecSubCode = $this->sumit->fetchSingleData('Class_Sec_SubCode','class_section_wise_subject_allocation',"Class_No='$class_id' AND section_no='$section_id'");

		$getMaxClassSecSubCode = $this->sumit->fetchSingleData('max(Class_Sec_SubCode)max_code','class_section_wise_subject_allocation',array());

		$classSecSubCode = empty($getClassSecSubCode)?($getMaxClassSecSubCode['max_code']+1):$getClassSecSubCode['Class_Sec_SubCode'];

		$classDetails = $this->sumit->fetchSingleData('*','classes',"Class_No='$class_id'");
		$sectionDetails = $this->sumit->fetchSingleData('*','sections',"section_no='$section_id'");
		$combined_subject = !empty($combined_subject)?implode(",", $combined_subject):0;

		$combined_subject = ($required_support_teacher==1)?0:$combined_subject;

		$insertingData = array();

		if($combined_subject == 0)
		{
			$subjectDetails = $this->sumit->fetchSingleData('*','subjects',"SubCode='$subject_id'");

			$insertingData[] = array(
				'Class_Sec_SubCode' 	=> $classSecSubCode,
				'Class_No'				=> $class_id,
				'section_no'			=> $section_id,
				'subject_code'			=> $subject_id,
				'Total_Period_inWeek'	=> $total_period,
				'Subject_option'		=> 0,
				'Main_Teacher_Required'	=> 1,
				'Support_Teacher_Required'=> $required_support_teacher,
				'Merged_WithSubCode'	=> $combined_subject,
				'Subject_Name_Dispaly'	=> $subjectDetails['SubSName'],
				'Class_name_Roman'		=> $classDetails['CLASS_NM'].'-'.$sectionDetails['SECTION_NAME'],
				'subj_nm'				=> $subjectDetails['SubName'],
				'display_subnm_rp'		=> $subjectDetails['SubName'],
			);
		}else{

			$combined_subject = $subject_id.','.$combined_subject;
			$combined_subject_arr = explode(',', $combined_subject);
			$combined_subject_arr_imp = implode("', '", $combined_subject_arr);
			$combinedSubjectDetails = $this->sumit->fetchAllData('*','subjects',"SubCode IN ('$combined_subject_arr_imp')");

			$combinedSubjectDisplay = '';
			$totalCount = count($combinedSubjectDetails);
			foreach ($combinedSubjectDetails as $key => $value) {
				
				$combinedSubjectDisplay .= $value['SubSName'];
				if(($key+1) < $totalCount)
				{
					$combinedSubjectDisplay .='+';
				}
			}
			foreach ($combined_subject_arr as $key => $value) {

				$subjectDetails = $this->sumit->fetchSingleData('*','subjects',"SubCode='$value'");

				$insertingData[] = array(
					'Class_Sec_SubCode' 	=> $classSecSubCode,
					'Class_No'				=> $class_id,
					'section_no'			=> $section_id,
					'subject_code'			=> $value,
					'Total_Period_inWeek'	=> $total_period,
					'Subject_option'		=> 0,
					'Main_Teacher_Required'	=> 1,
					'Support_Teacher_Required'=> $required_support_teacher,
					'Merged_WithSubCode'	=> $combined_subject,
					'Subject_Name_Dispaly'	=> $combinedSubjectDisplay,
					'Class_name_Roman'		=> $classDetails['CLASS_NM'].'-'.$sectionDetails['SECTION_NAME'],
					'subj_nm'				=> $subjectDetails['SubName'],
					'display_subnm_rp'		=> $subjectDetails['SubName'],
				);
			}
		}
		$create = $this->sumit->createMultiple('class_section_wise_subject_allocation',$insertingData);
		if($create)
		{
			echo json_encode(1);
		}
		else
		{
			echo json_encode(2);	
		}
	}

	public function checkSubjectAlreadyExist()
	{
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');
		$subject_id = $this->input->post('subject_id');
		$check = $this->sumit->checkData('*','class_section_wise_subject_allocation',array('Class_No'=>$class_id,'section_no'=>$section_id,'subject_code'=>$subject_id));
		if($check)
		{
			echo json_encode('Subject already exist in this class section');
		}
		else
		{
			echo json_encode('true');
		}
	}

	

	public function getSectionByClassID()
	{
		$class_id = $this->input->post('class_id');
		$getSection = $this->sumit->fetchAllData("DISTINCT(SEC),DISP_SEC",'student',"CLASS='$class_id' ORDER BY DISP_SEC");
		echo json_encode($getSection);
	}

	public function getSectionByClassIDAtCopyCreation()
	{
		$class_id = $this->input->post('class_id');
		$getSection = $this->sumit->fetchDataGroupByWhereOrderBy("SEC,DISP_SEC",'student',"CLASS='$class_id' AND SEC NOT IN (SELECT section_no FROM class_section_wise_subject_allocation WHERE Class_No='$class_id')",'SEC,DISP_SEC','SEC,DISP_SEC');
		echo json_encode($getSection);
	}

	public function getCombinedSubjectListBySubjectID()
	{
		$subject_id = $this->input->post('subject_id');
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');

		$getSubject = $this->sumit->fetchAllData('*','subjects',"SubCode NOT IN (SELECT subject_code FROM class_section_wise_subject_allocation WHERE Class_No='$class_id' AND section_no='$section_id') AND SubCode!='$subject_id'");
		echo json_encode($getSubject);
	}

	public function getSubjectDataByClassSection()
	{
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');

		$getSubjectList = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"Class_No='$class_id' AND section_no='$section_id' ORDER BY ID");

		$totalPeriodSumWithoutMerge = $this->sumit->fetchSingleData('SUM(Total_Period_inWeek)total_sum','class_section_wise_subject_allocation',"Class_No='$class_id' AND section_no='$section_id' AND Merged_WithSubCode=0");
		$totalPeriodSumWithMerge = $this->sumit->fetchAllData('Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_No='$class_id' AND section_no='$section_id' AND Merged_WithSubCode != '0' GROUP BY Total_Period_inWeek,Merged_WithSubCode");
		
		$total = 0;
		if(!empty($totalPeriodSumWithMerge))
		{
			foreach ($totalPeriodSumWithMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}

		$totalPeriodSumWithoutMerge = isset($totalPeriodSumWithoutMerge['total_sum'])?$totalPeriodSumWithoutMerge['total_sum']:0;
		$data['totalSum'] = $totalPeriodSumWithoutMerge + $total;
		$data['subjectData'] = $getSubjectList;
		$this->load->view('timetable/displayClassSectionWiseSubject',$data);
	}

	function removeSubjectWithMergeCode()
	{
		$id = $this->input->post('id');
		$getDetails = $this->sumit->fetchSingleData('*','class_section_wise_subject_allocation',"ID='$id'");
		$mergedSub = $getDetails['Merged_WithSubCode'];
		$delete = $this->sumit->delete('class_section_wise_subject_allocation',"Class_No='".$getDetails['Class_No']."' AND section_no='".$getDetails['section_no']."' AND subject_code IN ($mergedSub)");
		if($delete)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

	function removeSubjectWithoutMergeCode()
	{
		$id = $this->input->post('id');
		$delete = $this->sumit->delete('class_section_wise_subject_allocation',"ID='$id'");
		if($delete)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

	public function getSubjectDataByClass()
	{
		$class_id = $this->input->post('class_id');

		$getSubjectList = $this->sumit->fetchDataGroupByWhere('Merged_WithSubCode,Support_Teacher_Required,subj_nm,Class_No,subject_code,Total_Period_inWeek','class_section_wise_subject_allocation',"Class_No='$class_id'",'Merged_WithSubCode,Support_Teacher_Required,subj_nm,Class_No,subject_code,Total_Period_inWeek');

		$totalPeriodSumWithoutMerge = $this->sumit->fetchDataGroupByWhere('subject_code,Total_Period_inWeek,Class_No','class_section_wise_subject_allocation',"Class_No='$class_id' AND Merged_WithSubCode=0",'subject_code,Total_Period_inWeek,Class_No');

		$totalPeriodSumWithMerge = $this->sumit->fetchDataGroupByWhere('subject_code,Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_No='$class_id' AND Merged_WithSubCode!=0",'subject_code,Total_Period_inWeek,Merged_WithSubCode');

		$total = 0;
		if(!empty($totalPeriodSumWithMerge))
		{
			foreach ($totalPeriodSumWithMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}

		if(!empty($totalPeriodSumWithoutMerge))
		{
			foreach ($totalPeriodSumWithoutMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}

		$data['totalSum'] = $total;

		$data['sectionList'] = $this->sumit->fetchAllData('Class_name_Roman','class_section_wise_subject_allocation',"Class_No='$class_id' GROUP BY Class_name_Roman");
		$data['subjectData'] = $getSubjectList;
		$this->load->view('timetable/periodUpdationModal',$data);
	}

	public function getSubjectByClassSectionCode()
	{
		$class_sec_id = $this->input->post('class_sec_id');

		$getSubjectList = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_id' ORDER BY ID");
		$data['subjectData'] = $getSubjectList;

		$totalPeriodSumWithoutMerge = $this->sumit->fetchAllData('subject_code,Total_Period_inWeek,Class_No,subject_code','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_id' AND Merged_WithSubCode=0");

		$totalPeriodSumWithMerge = $this->sumit->fetchDataGroupByWhere('subject_code,Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_id' AND Merged_WithSubCode!=0",'subject_code,Total_Period_inWeek,Merged_WithSubCode');

		$total = 0;
		if(!empty($totalPeriodSumWithMerge))
		{
			foreach ($totalPeriodSumWithMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}

		if(!empty($totalPeriodSumWithoutMerge))
		{
			foreach ($totalPeriodSumWithoutMerge as $key => $value) {
				
				$total += $value['Total_Period_inWeek'];
			}
		}
		
		$data['totalSum'] = $total;

		$this->load->view('timetable/displayClassSectionCodeWiseSubject',$data);
	}

	public function updateClassWisePeriod()
	{
		$class_id = $this->input->post('class_id');
		$subject_code = $this->input->post('subject_code');
		$total_period = $this->input->post('total_period');

		$checkMergedCode = $this->sumit->fetchSingleData('*','class_section_wise_subject_allocation',"Class_No='$class_id' AND subject_code='$subject_code'");

		if($checkMergedCode['Merged_WithSubCode'] != 0)
		{
			$subject_code = $checkMergedCode['Merged_WithSubCode'];
		}

		$updateData = array(
			'Total_Period_inWeek'	=> $total_period
		);
		$update = $this->sumit->update('class_section_wise_subject_allocation',$updateData,"Class_No='$class_id' AND subject_code IN ($subject_code)");
		if($update)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}

	public function createCopyClassSectionSubject()
	{
		$class_sec_subcode = $this->input->post('class_sec_subcode');
		$class_id_new = $this->input->post('class_id_new');
		$section_id = $this->input->post('section_id');
		
		$classDetails = $this->sumit->fetchSingleData('*','classes',"Class_No='$class_id_new'");
		$getSubjectDetails = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode'");
		$alreadyCreated = false;
		foreach ($section_id as $key => $value) 
		{
			$alreadyCreated = $this->sumit->checkData('*','class_section_wise_subject_allocation',"Class_No='$class_id_new' AND section_no='$value'");
			if($alreadyCreated == false)
			{
				$getMaxClassSecSubCode = $this->sumit->fetchSingleData('max(Class_Sec_SubCode)max_code','class_section_wise_subject_allocation',array());
				$classSecSubCode = $getMaxClassSecSubCode['max_code']+1;
				$sectionDetails = $this->sumit->fetchSingleData('*','sections',"section_no='$value'");
				$insertingData = array();
				foreach ($getSubjectDetails as $keys => $val) 
				{
					$insertingData[] = array(
						'Class_Sec_SubCode' 	=> $classSecSubCode,
						'Class_No'				=> $class_id_new,
						'section_no'			=> $value,
						'subject_code'			=> $val['subject_code'],
						'Total_Period_inWeek'	=> $val['Total_Period_inWeek'],
						'Subject_option'		=> $val['Subject_option'],
						'Main_Teacher_Required'	=> $val['Main_Teacher_Required'],
						'Support_Teacher_Required'=> $val['Support_Teacher_Required'],
						'Merged_WithSubCode'	=> $val['Merged_WithSubCode'],
						'Subject_Name_Dispaly'	=> $val['Subject_Name_Dispaly'],
						'Class_name_Roman'		=> $classDetails['CLASS_NM'].'-'.$sectionDetails['SECTION_NAME'],
						'subj_nm'				=> $val['subj_nm'],
						'display_subnm_rp'		=> $val['display_subnm_rp'],
					);
				}
				$this->sumit->createMultiple('class_section_wise_subject_allocation',$insertingData);
			}
		}
		if($alreadyCreated == true)
		{
			echo 2;
		}
		else
		{
			echo 1;
		}
	}

	function getCreatedClassSection()
	{
		$createdClassSection = $this->sumit->fetchDataGroupByWhere('Class_Sec_SubCode,Class_name_Roman','class_section_wise_subject_allocation',array(),"Class_name_Roman,Class_Sec_SubCode");
		echo json_encode($createdClassSection);
	}

	function checkMarksEnteredorNot()
	{
		$res = array();
		$id = $this->input->post('id');
		$getDetails = $this->sumit->fetchSingleData('*','class_section_wise_subject_allocation',"ID='$id'");
		$checkMaxMarks = $this->sumit->checkData('*','maxmarks',"ClassCode='".$getDetails['Class_No']."' AND teacher_code='".$getDetails['subject_code']."'");
		if($checkMaxMarks)
		{
			$res['delete_status'] = 0; //Not able to delelete
		}
		else
		{
			$res['delete_status'] = 1; //Deleted
		}
		echo json_encode($res);
	}
}
