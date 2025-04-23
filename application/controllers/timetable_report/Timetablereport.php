<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetablereport extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->loggedOut();
	}
	public function teacherDetailsAllotedPeriod()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['title'] = 'Teacher Details Alloted Period';
		if(isset($_POST['search']))
		{
			$order_by = $this->input->post('order_by');
			$teacherList = array();
			if($order_by == 1)
			{
				$teacherList = $this->timetable_model->getTeacherDetailswithAllotedPeriod("e.STAFF_TYPE=1 AND e.STATUS=1 ORDER BY e.EMP_FNAME,e.EMP_MNAME,e.EMP_LNAME");
			}
			elseif($order_by == 2)
			{
				$teacherList = $this->timetable_model->getTeacherDetailswithAllotedPeriod("e.STAFF_TYPE=1 AND e.STATUS=1 ORDER BY L.Class_No,L.Section_No");
			}

			$result = array();
			foreach ($teacherList as $keys => $values) {

				$periodNBundle = $this->timetable_model->getTotalBundleAndPeriodTeacherWise($values['EMPID']);
				$total_period= 0;$total_bundle = 0;
				foreach ($periodNBundle as $key => $value) {
					$total_period += $value['Total_Period_inWeek'];
					$total_bundle += $value['Bundle_Count'];
				}
				$result[] =array(
					'empid'			=> $values['EMPID'],
					'name'			=> $values['EMP_FNAME'].' '.$values['EMP_MNAME'].' '.$values['EMP_LNAME'],
					'class_section'	=> $values['class_name'].' - '.$values['section_name'],
					'total_period'	=> $total_period,
					'Bundle_Count'	=> $total_bundle
				);
			}
			$data['result'] = $result;
		}
		$this->render_template('timetable_report/teacherDetailsWithAllotedPeriod',$data);
	}

	public function teacherWiseSubjectAllocation()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$data['teacherList'] = $this->sumit->fetchAllData('*','employee',"STAFF_TYPE=1 AND STATUS=1");
		if(isset($_POST['search']))
		{
			$resultList = array();
			$select_type = $this->input->post('select_type');
			if($select_type == 1)
			{
				$teacherList = $this->timetable_model->getTeacherDetailswithAllotedPeriod("e.STAFF_TYPE=1 AND e.STATUS=1 ORDER BY e.EMP_FNAME,e.EMP_MNAME,e.EMP_LNAME");
				foreach ($teacherList as $key => $value) {

					$periodNBundle = $this->timetable_model->getTotalBundleAndPeriodTeacherWise($value['EMPID']);
					$total_period= 0;$total_bundle = 0;
					foreach ($periodNBundle as $keys => $val) {
						$total_period += $val['Total_Period_inWeek'];
						$total_bundle += $val['Bundle_Count'];
					}

					$getAllotedClass = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"Main_Teacher_Code='".$value['EMPID']."' OR Support_Teacher_Code='".$value['EMPID']."'"); 
					$resultList[$key] = $value;
					$resultList[$key]['total_bundle'] = $total_bundle;
					$resultList[$key]['total_period'] = $total_period;
					$resultList[$key]['allocatedClass'] = $getAllotedClass;
				}
			}
			else
			{
				$teacher_id = $this->input->post('teacher_id');
				$teacherList = $this->timetable_model->getTeacherDetailswithAllotedPeriod("e.EMPID='$teacher_id' ORDER BY e.EMP_FNAME,e.EMP_MNAME,e.EMP_LNAME");
				foreach ($teacherList as $key => $value) {

					$periodNBundle = $this->timetable_model->getTotalBundleAndPeriodTeacherWise($value['EMPID']);
					$total_period= 0;$total_bundle = 0;
					foreach ($periodNBundle as $keys => $val) {
						$total_period += $val['Total_Period_inWeek'];
						$total_bundle += $val['Bundle_Count'];
					}

					$getAllotedClass = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"Main_Teacher_Code='".$value['EMPID']."' OR Support_Teacher_Code='".$value['EMPID']."'"); 
					$resultList[$key] = $value;
					$resultList[$key]['total_bundle'] = $total_bundle;
					$resultList[$key]['total_period'] = $total_period;
					$resultList[$key]['allocatedClass'] = $getAllotedClass;
				}
			}
			$data['resultList'] = $resultList;
		}
		$this->render_template('timetable_report/teacherWiseSubjectAllocated',$data);
	}

	public function subjectWiseAllocatedTeacher()
	{
		// if(!in_array('viewDesignation', permission_data))
		// {
		// 	redirect('payroll/dashboard/dashboard');
		// }
		$subjectList = $this->timetable_model->getSubjectList();
		if(isset($_POST['search']))
		{
			$resultList = array();
			$select_type = $this->input->post('select_type');
			$teacher_type = $this->input->post('teacher_type');

			$sectionList = $this->sumit->fetchAllData('*','sections',array());

			if($select_type == 1)
			{
				$classList = array();
				foreach ($subjectList as $key2 => $val) 
				{
					if($teacher_type == 1)
					{
						$classList = $this->timetable_model->getClassListBySubjectModel("cs.subject_code = '".$val['subject_code']."' AND cs.Main_Teacher_Required = 1");
					}
					elseif($teacher_type==2)
					{
						$classList = $this->timetable_model->getClassListBySubjectModel("cs.subject_code = '".$val['subject_code']."' AND cs.Support_Teacher_Required = 1");
					}

					$result = array();
					foreach ($classList as $key => $value) 
					{
						$result[$value['Class_No']]['class_name'] = $value['CLASS_NM'];
						$result[$value['Class_No']]['subject'] = $val['subj_nm'];
						foreach ($sectionList as $keys => $values) {
							if($teacher_type == 1)
							{
								$checkExist = $this->timetable_model->getClassSectionSubjectWiseTeacher("c.Class_No='".$value['Class_No']."' AND c.section_no='".$values['section_no']."' AND c.subject_code='".$val['subject_code']."' AND c.Main_Teacher_Required=1",$value['Class_No'],$values['section_no'],$val['subject_code']);

								if(!empty($checkExist))
								{
									
									$emp_name = $checkExist['EMP_FNAME'].' '.$checkExist['EMP_MNAME'].' '.$checkExist['EMP_LNAME'];
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => $emp_name,
									);
								}
								else
								{
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => 'X',
									);
								}
							}
							elseif($teacher_type==2)
							{
								$checkExist = $this->timetable_model->getClassSectionSubjectWiseTeacher("c.Class_No='".$value['Class_No']."' AND c.section_no='".$values['section_no']."' AND c.subject_code='".$val['subject_code']."' AND c.Support_Teacher_Required=1",$value['Class_No'],$values['section_no'],$val['subject_code']);

								if(!empty($checkExist))
								{
									$emp_name = $checkExist['EMP_FNAME_SUPPORT'].' '.$checkExist['EMP_MNAME_SUPPORT'].' '.$checkExist['EMP_LNAME_SUPPORT'];
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => $emp_name,
									);
								}
								else
								{
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => 'X',
									);
								}
							}
						}
					}
					$resultList[$key2] = $result;
					$data['result'] = $result;
					$data['sectionList'] = $sectionList;
				}
			}
			else
			{
				$subject_id = $this->input->post('subject_id');
				$singleSubject = $this->sumit->fetchAllData('SubCode as subject_code,SubName as subj_nm','subjects',"SubCode='$subject_id'");
				$classList = array();
				foreach ($singleSubject as $key2 => $val) 
				{
					if($teacher_type == 1)
					{
						$classList = $this->timetable_model->getClassListBySubjectModel("cs.subject_code = '".$val['subject_code']."' AND cs.Main_Teacher_Required = 1");
					}
					elseif($teacher_type==2)
					{
						$classList = $this->timetable_model->getClassListBySubjectModel("cs.subject_code = '".$val['subject_code']."' AND cs.Support_Teacher_Required = 1");
					}

					$result = array();
					foreach ($classList as $key => $value) 
					{
						$result[$value['Class_No']]['class_name'] = $value['CLASS_NM'];
						$result[$value['Class_No']]['subject'] = $val['subj_nm'];
						foreach ($sectionList as $keys => $values) {
							if($teacher_type == 1)
							{
								$checkExist = $this->timetable_model->getClassSectionSubjectWiseTeacher("c.Class_No='".$value['Class_No']."' AND c.section_no='".$values['section_no']."' AND c.subject_code='".$val['subject_code']."' AND c.Main_Teacher_Required=1",$value['Class_No'],$values['section_no'],$val['subject_code']);

								if(!empty($checkExist))
								{
									
									$emp_name = $checkExist['EMP_FNAME'].' '.$checkExist['EMP_MNAME'].' '.$checkExist['EMP_LNAME'];
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => $emp_name,
									);
								}
								else
								{
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => 'X',
									);
								}
							}
							elseif($teacher_type==2)
							{
								$checkExist = $this->timetable_model->getClassSectionSubjectWiseTeacher("c.Class_No='".$value['Class_No']."' AND c.section_no='".$values['section_no']."' AND c.subject_code='".$val['subject_code']."' AND c.Support_Teacher_Required=1",$value['Class_No'],$values['section_no'],$val['subject_code']);

								if(!empty($checkExist))
								{
									$emp_name = $checkExist['EMP_FNAME_SUPPORT'].' '.$checkExist['EMP_MNAME_SUPPORT'].' '.$checkExist['EMP_LNAME_SUPPORT'];
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => $emp_name,
									);
								}
								else
								{
									$result[$value['Class_No']]['teachers'][$values['section_no']] = array(
										'name' => 'X',
									);
								}
							}
						}
					}
					$resultList[$key2] = $result;
					$data['result'] = $result;
					$data['sectionList'] = $sectionList;
				}
				
			}
			$data['resultList'] = $resultList;
		}
		$data['subjectList'] = $subjectList;
		$this->render_template('timetable_report/subjectWiseAllotedTeacher',$data);
	}

}
