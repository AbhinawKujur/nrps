<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjectallocation extends MY_Controller {

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

		$data['subjectsList'] =$this->sumit->fetchAllData('*','subjects',array());
		$data['sectionList'] =$this->sumit->fetchAllData('*','sections',array());
		$data['wingList'] =$this->sumit->fetchAllData('*','wing_master',array());
	$data['buildingList'] = $this->sumit->fetchAllData('*,(SELECT Campus_Name FROM campus_master WHERE Campus_ID=w.CAMPUS_MASTER_ID)CAMPUS_NAME','wing_master w',array());
		$this->render_template('timetable/subjectAllocation',$data);
	}
	// public function update()
	// {
	// 	$id = $this->input->post('wing');
	// 	$data = array(
	// 		'CAMPUS_MASTER_ID'	=> $this->input->post('campus'),
	// 	);

	// 	$updated = $this->sumit->update('wing_master',$data,array('ID'=>$id));
	// 	if($updated)
	// 	{
	// 		$this->session->set_flashdata('msg','<div class="alert alert-success">Record Updated Successfully</div>');
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('msg','<div class="alert alert-warning">Updation Failed!</div>');
	// 	}
	// 	redirect('timetable/buildingmaster');
	// }

	// public function getSingleData()
	// {
	// 	$id = $this->input->post('id');
	// 	$data = $this->sumit->fetchSingleData('*','wing_master',array('ID'=>$id));
	// 	echo json_encode($data);
	// }

	public function getTeacherList()
	{
		$subject_id = $this->input->post('subject_id');
		$teacher_list_load = $this->input->post('teacher_list_load');
		if($teacher_list_load == 1)
		{
			$teacherList = $this->sumit->fetchAllData('e.EMPID,e.EMP_FNAME,IFNULL(e.EMP_MNAME,"")EMP_MNAME,IFNULL(e.EMP_LNAME,"")EMP_LNAME','employee e',"STATUS=1 AND role_Id=2");			
		}
		else
		{
			$teacherList = $this->sumit->fetchTwoJoin('s.*,e.EMPID,e.EMP_FNAME,IFNULL(e.EMP_MNAME,"")EMP_MNAME,IFNULL(e.EMP_LNAME,"")EMP_LNAME','subject_preferences s','employee e',"e.EMPID=s.teacher_id","s.subject_code='$subject_id' AND e.role_Id=2");

		}
		echo json_encode($teacherList);
	}

	public function getSubjectListByTeacherinTable()
	{
		$teacher_id = $this->input->post('teacher_id');
		$data['subjectList'] = $this->sumit->fetchAllData('subj_nm,Class_name_Roman,Total_Period_inWeek','class_section_wise_subject_allocation',"Main_Teacher_Code='$teacher_id' OR Support_Teacher_Code='$teacher_id'");
		$this->load->view('timetable/teacherSubjectBundleTable',$data);
	}

	public function getClassTeacherClassDetails()
	{
		$teacher_id = $this->input->post('teacher_id');
		$loginDetails = $this->sumit->fetchSingleData('Class_tech_sts,Class_No,Section_No','login_details',"user_id='$teacher_id'");
		if($loginDetails['Class_tech_sts'] == 1)
		{
			$class_sec_details = $this->sumit->fetchSingleData("(SELECT SECTION_NAME FROM `sections` WHERE section_no='".$loginDetails['Section_No']."')SECTION, CLASS_NM",'classes',"Class_No='".$loginDetails['Class_No']."'");
			echo  ($class_sec_details['CLASS_NM'].' - '.$class_sec_details['SECTION']);
		}
		else
		{
			echo "";
		}
	}

	public function getClassListBySubject()
	{
		$subject_id = $this->input->post('subject_id');
		$classList = $this->sumit->fetchAllData('*','class_section_wise_subject_allocation',"subject_code='$subject_id' ORDER BY Class_No,section_no");
		echo json_encode($classList);
	}

	public function getSubjectDataByClassSecSubcode()
	{
		$class_sec_subcode = $this->input->post('class_sec_subcode');
		$subject_id = $this->input->post('subject_id');

		$getSubjectList = $this->sumit->fetchAllData('*,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.'),"")EMP_FNAME,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.'),"")EMP_MNAME,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=cs.Main_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.'),"")EMP_LNAME,IFNULL((SELECT EMP_FNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.'),"")EMP_FNAME_SUPPORT,IFNULL((SELECT EMP_MNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.'),"")EMP_MNAME_SUPPORT,IFNULL((SELECT EMP_LNAME FROM employee WHERE EMPID=cs.Support_Teacher_Code AND Class_Sec_SubCode='.$class_sec_subcode.'),"")EMP_LNAME_SUPPORT','class_section_wise_subject_allocation cs',"Class_Sec_SubCode='$class_sec_subcode'");

		$totalPeriodSumWithoutMerge = $this->sumit->fetchSingleData('SUM(Total_Period_inWeek)total_sum','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND Merged_WithSubCode=0");
		$totalPeriodSumWithMerge = $this->sumit->fetchAllData('Total_Period_inWeek,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND Merged_WithSubCode != '0' GROUP BY Total_Period_inWeek,Merged_WithSubCode");
		
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
		$this->load->view('timetable/classWiseSubjectinSubjectAllocation',$data);
	}


	public function getClassWithTeacherDetails()
	{
		$subject_id = $this->input->post('subject_id');
		$teacher_option = $this->input->post('teacher_option');

		$sectionList = $this->sumit->fetchAllData('*','sections',array());
		$classList = array();
		if($teacher_option == 1)
		{
			$classList = $this->timetable_model->getClassListBySubjectModel("cs.subject_code = '$subject_id' AND cs.Main_Teacher_Required = 1");
		}
		elseif($teacher_option==2)
		{
			$classList = $this->timetable_model->getClassListBySubjectModel("cs.subject_code = '$subject_id' AND cs.Support_Teacher_Required = 1");
		}

		$result = array();
		foreach ($classList as $key => $value) 
		{
			$result[$value['Class_No']]['class_name'] = $value['CLASS_NM'];
			foreach ($sectionList as $keys => $values) {
				if($teacher_option == 1)
				{
					$checkExist = $this->timetable_model->getClassSectionSubjectWiseTeacher("c.Class_No='".$value['Class_No']."' AND c.section_no='".$values['section_no']."' AND c.subject_code='$subject_id' AND c.Main_Teacher_Required=1",$value['Class_No'],$values['section_no'],$subject_id);

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
				elseif($teacher_option==2)
				{				
					$checkExist = $this->timetable_model->getClassSectionSubjectWiseTeacher("c.Class_No='".$value['Class_No']."' AND c.section_no='".$values['section_no']."' AND c.subject_code='$subject_id' AND c.Support_Teacher_Required=1",$value['Class_No'],$values['section_no'],$subject_id);

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
		$data['result'] = $result;
		$data['sectionList'] = $sectionList;
		$this->load->view('timetable/subjectWiseClassDetails',$data);
	}

	public function getCombinedSubjectClassList()
	{
		$subject_id = $this->input->post('subject_id');
		$class_sec_subcode = $this->input->post('class_sec_subcode');
		$classNo = $this->sumit->fetchSingleData('Class_No,Merged_WithSubCode','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND subject_code='$subject_id'");
		$classSectionList = 0;
		$subjectList = array();
		$show = 'No';
		if($classNo['Merged_WithSubCode'] != '0')
		{
			$classSectionList = $this->sumit->fetchAllData('Class_Sec_SubCode,Class_name_Roman','class_section_wise_subject_allocation',"Class_No='".$classNo['Class_No']."' AND Merged_WithSubCode='".$classNo['Merged_WithSubCode']."' AND Class_Sec_SubCode <> '$class_sec_subcode' GROUP BY Class_Sec_SubCode,Class_name_Roman");
			$combinedsubjectid = implode("','",explode(',', $classNo['Merged_WithSubCode']));
			$subjectList = $this->sumit->fetchAllData('*','subjects',"SubCode IN ('$combinedsubjectid')");
			$show = 'Yes';
		}
		$final_result = array(
			'show'	=> $show,
			'subjectList'		=> $subjectList,
			'classsectionlist'	=> $classSectionList,
		);
		echo json_encode($final_result);
	}
	
	public function getCombinedClassList()
	{
		$subject_id = $this->input->post('subject_id');
		$class_sec_subcode = $this->input->post('class_sec_subcode');
		$classNo = $this->sumit->fetchSingleData('Class_No,Support_Teacher_Required','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND subject_code='$subject_id'");		
		
		if($classNo['Support_Teacher_Required'] != '0')
		{
			$classSectionList = $this->sumit->fetchAllData('Class_Sec_SubCode,Class_name_Roman','class_section_wise_subject_allocation',"Class_No='".$classNo['Class_No']."' AND Support_Teacher_Required='1' AND Class_Sec_SubCode <> '$class_sec_subcode' GROUP BY Class_Sec_SubCode,Class_name_Roman");
		?>
		 <label>Select Other Class - Section for Merged Subject1</label>
			<select name="class_sec[]" class="form-control select3" id="clas_cod" multiple="" >
			<option value="">--Select--</option>
			<?php
			foreach($classSectionList as $key=>$value){
			?>
			<option value="<?=$value['Class_Sec_SubCode']?>"><?=$value['Class_name_Roman']?></option>
			<?php
			}
			?>
			</select>	
		<?php
		
		}
				
	}

	public function savedSubjectAllocation()
	{
		$subject_id 			= $this->input->post('subject_id');
		$teacher_id 			= $this->input->post('teacher_id');
		$teacher_option 		= $this->input->post('teacher_option');
		$class_sec_subcode 		= $this->input->post('class_name_Roman');
		$combined_class 		= $this->input->post('combined_class[]');
		$is_combined_subject 	= $this->input->post('is_combined_subject');
		$combined_class_sup 	= $this->input->post('class_sec[]');
		$comobid_class_code		=(!empty($combined_class_sup))?$combined_class_sup:0;		
		$Support_Teacher_Code 	= ($teacher_option==2)?$teacher_id:0;
		if($teacher_option == 1)
		{
			$combined_class_str = ($is_combined_subject==1 && !empty($combined_class))?implode(',', $combined_class).','.$class_sec_subcode:$class_sec_subcode;

			$updateData = array(
				'Main_Teacher_Code'				=> $teacher_id,
				'Teacher_Merge_Class_Status'	=> $is_combined_subject,
				'Teacher_Merge_Class_Details'	=> $combined_class_str,
			);
			$check_already_assigned = $this->sumit->checkData('*','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND subject_code='$subject_id' AND Main_Teacher_Code <> ''");
			if($check_already_assigned == FALSE)
			{
				$class_sec_subcode_imp = implode("','", explode(',', $combined_class_str));
				$update = $this->sumit->update('class_section_wise_subject_allocation',$updateData,"Class_Sec_SubCode IN ('$class_sec_subcode_imp') AND subject_code='$subject_id'");
				

				$res['msg'] = 1; //assigned successfully
			}
			else
			{
				$res['msg'] = 2; //already assigned
			}
		}
		elseif($teacher_option == 2)
		{
			$check_support_teacher_required = $this->sumit->checkData('*','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND subject_code='$subject_id' AND Support_Teacher_Required=1");
		
			if($check_support_teacher_required)
			{ 
				if($comobid_class_code>0)
				{
				
									
				$combined_class_suport	=	implode(',', $combined_class_sup);
				$combined_class_suports	=	$class_sec_subcode.','.$combined_class_suport;
				$arr	=explode(",",$combined_class_suports);			
				$count_arra	=count($arr);
					for($i=0; $i<$count_arra; $i++){
						$classseccode		=$arr[$i];				
						$updateData = array(
							'Support_Teacher_Code'	=> $Support_Teacher_Code,
							'Merge_Class_Status'	=> '1',
							'Merge_Class_Details'	=> $combined_class_suports,
						);
						$check_already_assigned = $this->sumit->checkData('*','class_section_wise_subject_allocation',"Class_Sec_SubCode='$classseccode' AND subject_code='$subject_id' AND Support_Teacher_Code <> ''");
						if($check_already_assigned == FALSE)
							{
								$update = $this->sumit->update('class_section_wise_subject_allocation',$updateData,"Class_Sec_SubCode='$classseccode' AND subject_code='$subject_id'");					
								$res['msg'] = 1; //assigned successfully
							}
							else
							{
								$res['msg'] = 2; //already assigned
							}
					}
				
				}else{
				
				
					$updateData = array(
						'Support_Teacher_Code'	=> $Support_Teacher_Code,
					);
					
					$check_already_assigned = $this->sumit->checkData('*','class_section_wise_subject_allocation',"Class_Sec_SubCode='$class_sec_subcode' AND subject_code='$subject_id' AND Support_Teacher_Code <> ''");
					if($check_already_assigned == FALSE)
					{
						$update = $this->sumit->update('class_section_wise_subject_allocation',$updateData,"Class_Sec_SubCode='$class_sec_subcode' AND subject_code='$subject_id'");					
						$res['msg'] = 1; //assigned successfully
					}
					else
					{
						$res['msg'] = 2; //already assigned
					}
				
				
				}			
			}
			else
			{
				$res['msg'] = 3;//support teacher not required for this subject
			}
		}
		echo json_encode($res);
	}

	public function getTotalBundleandTotalPeriod()
	{
		$teacher_id 		= $this->input->post('teacher_id');
		$periodNBundle 		= $this->timetable_model->getTotalBundleAndPeriodTeacherWise($teacher_id);
		
		$total_period		= 0;$total_bundle = 0;
		foreach ($periodNBundle as $key => $value) {
			$total_period += $value['Total_Period_inWeek'];
			$total_bundle += $value['Bundle_Count'];
		}
		$res =array(
			'total_period'	=> $total_period,
			'Bundle_Count'	=> $total_bundle
		);
		echo json_encode($res);
	}

	public function getClassDetailsByTeacher()
	{
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');
		$subject_id = $this->input->post('subject_id');
		$teacher_option = $this->input->post('teacher_option');

		$result = $this->timetable_model->getTeacherDetailsByClassSectionSubject($class_id,$section_id,$subject_id);
		echo json_encode($result);

	}

	public function removeSelectedTeacherButton()
	{
		$id = $this->input->post('id');
		$teacher_option = $this->input->post('teacher_option');
		$updateData = array();
		if($teacher_option ==1)
		{
			$updateData = array('Main_Teacher_Code'=>'');
		}
		else
		{
			$updateData = array('Support_Teacher_Code'=>'');
		}
		$update = $this->sumit->update('class_section_wise_subject_allocation',$updateData,"ID='$id'");
		if($update)
		{
			echo 1;
		}
		else
		{
			echo 2;
		}
	}
}
